<?php

namespace App\Http\Controllers\API;

use App\Notifications\PasswordResetNotification;
use App\Http\Controllers\Controller;
use App\Mail\SendResetPasswordCode;
use Illuminate\Http\Request;
use App\User;
use Mail;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request){

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if($user){

            $token = rand(100000,999999);
            DB::table('users')
            ->where('email', $email)
            ->update(['remember_token' => $token]);

            $email_sent = Mail::to($user)->send(new SendResetPasswordCode($token));

            return response(['message' => 'Check you email address we sent you a 6-digit token!']);
        }

        else{
            return response(['message' => 'Sorry! No user found with this email!']);
        }

    }
}
