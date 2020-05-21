<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreUser;
use App\Mail\PasswordSentEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\UserProfile;
use App\User;
use Image;
use Mail;

class VendorController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){

            $vendor = User::vendor()->get();
            return Datatables::of($vendor)
                ->addColumn('action', function ($vendor) {
                    return view('manage.actions.actions_vendor',compact('vendor'));
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
       return view('manage.vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('manage.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        if ($request['photo']){
            $originalImage= $request->file('photo');
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            $filename = $request->file('photo')->hashName();
        }
        else{
            $filename = 'profileavatar.png';
        }
        
        $password = Str::random(8);
        $hash_password = Hash::make($password);
        
        $vendor = new User;
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->password = $hash_password;
        $vendor->role = 'vendor';
        $vendor->save();

        Mail::to($vendor)->send(new PasswordSentEmail($password));

        if($vendor){
            $profile = new UserProfile([
                'user_id' => $vendor->id,
                'address'  => $request->address,
                'city'  => $request->city,
                'country'   => $request->country,
                'phone' =>  $request->phone,
                'photo' => $filename,
            ]);

            $profile = $vendor->profile()->save($profile);
            if($profile){
                Session::flash('message', 'Vendor Created Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('manage_vendors');  
            }      
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = User::with(['profile'])->where('id',$id)->latest()->first();
        // dd($vendor->profile->photo);
        return view('manage.vendor.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function update(Request $request, $id)
    {
        $password = Str::random(8);
        $hash_password = Hash::make($password);

        $vendor = User::find($id);

        if($request->hasFile('photo')){
            // storing image
            $originalImage= $request->file('photo');
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            $filename = $request->file('photo')->hashName();

        }
        else{
            $filename = $vendor->profile->image;
        } 
        
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->password = $hash_password;
        $vendor->save();

        Mail::to($vendor)->send(new PasswordSentEmail($password));

        if($vendor){

            $profile = UserProfile::where('user_id' ,$id)->first();

                $profile->address   = $request->address;
                $profile->city      = $request->city;
                $profile->country   = $request->country;
                $profile->phone     = $request->phone;
                $profile->photo     = $filename;
                $profile->save();

            // $profile = $vendor->profile()->save($profile);
            if($profile){
                Session::flash('message', 'Vendor Updated Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('manage_vendors'); 
            }      
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = User::find($id)->delete();
        if($vendor){
            return view('manage.vendor.index');
        }
    }
}
