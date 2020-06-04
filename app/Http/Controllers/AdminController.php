<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordSentEmail;
use Illuminate\Http\Request;
use App\UserProfile;
use App\User;
use Mail;

class AdminController extends Controller
{
  	public function index(){

        return view('pages.dashboard-ecommerce');
    }

    public function edit(Request $request,$id)
    {
    	// return dd($id);
        $user = User::with(['profile'])->where('id',$id)->latest()->first();
        
        return view('pages.edit',compact('user'));
    }

     public function update(Request $request, $id)
    {
        $password = $request->password;
        $hash_password = Hash::make($password);

        $user = User::find($id);

        if($request->hasFile('photo')){
            // storing image
            $originalImage= $request->file('photo');
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $filename = $request['picture'];

        }
        else{
            $filename = $user->profile->photo;
        } 
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $hash_password;
        $user->role = 'admin';
        $user->save();

        Mail::to($user)->send(new PasswordSentEmail($password));

        if($user){

            $profile = UserProfile::where('user_id' ,$id)->first();

                $profile->address   = $request->address;
                $profile->city      = $request->city;
                $profile->country   = $request->country;
                $profile->phone     = $request->phone;
                $profile->photo     = $filename;
                $profile->save();

            // $profile = $user->profile()->save($profile);
            if($profile){
                Session::flash('message', 'Account Settings Updated Successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('dashboard-ecommerce'); 
            }      
        }
    }
}
