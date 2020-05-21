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


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->ajax()){
            $user = User::select(['id', 'name', 'email', 'password', 'created_at', 'updated_at'])->with('scans')->withCount('scans');
            dd($user);
            return Datatables::of($user)
                ->addColumn('action', function ($user) {
                    return view('admin.actions.actions_user',compact('user'));
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        // }
       return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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

        
        $password = Str::random(8);
        $hash_password = Hash::make($password);

        
        // $thumbnailImage = Image::make($originalImage);

        // $thumbnailPath = public_path().'/thumbnail/';
        // $originalPath = public_path().'/images/';

        // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());

        // $thumbnailImage->resize(150,150);

        // $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
    
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->role = $request->role;
        $user->save();

        Mail::to($user)->send(new PasswordSentEmail($password));

        if($user){
            $profile = new UserProfile([
                'user_id' => $user->id,
                'address'  => $request->address,
                'city'  => $request->city,
                'country'   => $request->country,
                'phone' =>  $request->phone,
                'image' => $filename,
            ]);

            $profile = $user->profile()->save($profile);
            if($profile){
                Session::flash('message', 'User Created Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/users');  
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
        return view('admin.user.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $user = User::with(['profile'])->where('id',$id)->latest()->first();
        // dd($user->profile->image);
        return view('admin.user.edit',compact('user'));
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

        $user = User::find($id);

        if($request->hasFile('photo')){
            // storing image
            $originalImage= $request->file('photo');
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            $filename = $request->file('photo')->hashName();
            
            // $originalImage= $request->file('photo');
            // $thumbnailImage = Image::make($originalImage);

            // $thumbnailPath = public_path().'/thumbnail/';
            // $originalPath = public_path().'/images/';

            // $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());

            // $thumbnailImage->resize(150,150);

            // $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());

            // $filename = time().$originalImage->getClientOriginalName();

        }
        else{
            $filename = $user->profile->image;
        } 
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $hash_password;
        $user->role = $request->role;
        $user->save();

        Mail::to($user)->send(new PasswordSentEmail($password));

        if($user){

            $profile = UserProfile::where('user_id' ,$id)->first();

                $profile->address   = $request->address;
                $profile->city      = $request->city;
                $profile->country   = $request->country;
                $profile->phone     = $request->phone;
                $profile->image     = $filename;
                $profile->save();

            // $profile = $user->profile()->save($profile);
            if($profile){
                Session::flash('message', 'User Updated Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/users'); 
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
        $user = User::find($id)->delete();
        if($user){
            return view('admin.user.index');
        }
    }
}
