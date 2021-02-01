<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
use Validator;
use App\User;
use App\Plan;
use Mail;
use DB;

class UserActionController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard-ecommerce';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string',
            'email' => 'bail|required|unique:users',
            'address' => 'bail|required',
            'city' => 'bail|required|alpha_dash',
            'country' => 'bail|required|alpha_dash',
        ]);
        if ($validator->fails()) {
            Session::flash('sign-up-error', 'Session to show Signup modal on errors.'); 
            return redirect()->back()->withInput()->withErrors($validator);
        }

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

                    Session::flash('successfully-registered', 'Congratulations! Your are registered successfully.'); 
                    Session::flash('check', 'Password is sent to your email address. Please check you email address!');
                    Session::flash('alert-class', 'alert-success');
                    return redirect()->back();
                } else {
                    return response()->json(['error' => 'Login Credentials were wrong '], 401);
                }

            }


        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        Session::flash('sign-in-error', 'Session to show Signin modal on errors.'); 

        return $this->sendFailedLoginResponse($request);
    }

}
