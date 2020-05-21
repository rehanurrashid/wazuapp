<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUser;
use App\Mail\PasswordSentEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\UserProfile;
use App\UserPlan;
use App\User;
use App\Plan;
use Mail;
use DB;

class UserActionController extends Controller
{
    public function register(StoreUser $request)
    {   
        if ($request['photo']){
            $originalImage= $request->file('photo');
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $filename = $request['picture'];
        }
        else{
            $filename = env('APP_URL').'profileavatar.png';
        }
        
        $password = $request->password;
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

            	$credentials = [
                    'email' => $request->email,
                    'password' => $password
                ];

                if (auth()->attempt($credentials)) {


                    if (auth()->user()->status != 1){
                        return response()->json(['message'=>'User can not Login'], 401);
                    }
                    $token = auth()->user()->createToken('Web')->accessToken;

                    Session::flash('message', 'Congratulations! Your are registered successfully.'); 
                    Session::flash('check', 'Password is sent to your email address. Please check you email!');
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->back();
                } else {
                    return response()->json(['error' => 'Login Credentials were wrong '], 401);
                }

            }      
        }
    }

    public function activate_plan(Request $request){

        $plan = Plan::find($request->plan_id);

        // check user and plan activated or not
        $user_plan = UserPlan::where('user_id','=',$request->user_id)
                                ->where('plan_id','=',$request->plan_id)
                                ->first();
        
        if(empty($user_plan)){

            // check user activated some other plan
            $user_plan = UserPlan::where('user_id','=', $request->user_id)->first();

            if(!empty($user_plan)){
                $user_plan->user_id = $request->user_id;
                $user_plan->plan_id = $request->plan_id;
                $user_plan->save();
            }
            else{
                $user_plan = new UserPlan;
                $user_plan->user_id = $request->user_id;
                $user_plan->plan_id = $request->plan_id;
                $user_plan->save();

            }
            if($user_plan){
                   Session::flash('plan', 'You have activated '.$plan->name.' package successfully!');
                    Session::flash('alert-class', 'alert-success');

                    return response(['status' => true, 'message' => 'Package activated successfully!'], 200); 
                }
                else{
                    return response(['status' => false, 'message' => 'Package failed to activate!']); 
                }
        }
        else{
            return response(['status' => false, 'message' => 'Package already activated!']);
        }
    }
}
