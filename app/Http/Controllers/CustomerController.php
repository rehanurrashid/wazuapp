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

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $customer)
    {
        if($request->ajax()){

            $customer = User::customer()->select('users.*')->with('scans')->withCount('scans');
            // dd($customer->scans_count);
            return Datatables::of($customer)
                ->addColumn('action', function ($customer) {
                    return view('manage.actions.actions_customer',compact('customer'));
                    })
                ->addColumn('scans', function ($customer) {
                    return view('manage.actions.user_scans_list',compact('customer'));
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
       return view('manage.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('manage.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        
        $customer = new User;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = $hash_password;
        $customer->role = 'customer';
        $customer->save();

        Mail::to($customer)->send(new PasswordSentEmail($password));

        if($customer){
            $profile = new UserProfile([
                'user_id' => $customer->id,
                'address'  => $request->address,
                'city'  => $request->city,
                'country'   => $request->country,
                'phone' =>  $request->phone,
                'photo' => $filename,
            ]);

            $profile = $customer->profile()->save($profile);
            if($profile){
                Session::flash('message', 'Customer Created Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('customers');  
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
        $customer = User::with(['profile'])->where('id',$id)->latest()->first();
        // dd($customer->profile->image);
        return view('manage.customer.edit',compact('customer'));
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
        $customer = User::find($id);
        $customer->status = $request->status;
        $customer->save();

        if($customer){
            Session::flash('message', 'Customer Updated Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('customers');      
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
        $customer = User::find($id)->delete();
        if($customer){
            return view('manage.customer.index');
        }
    }
}
