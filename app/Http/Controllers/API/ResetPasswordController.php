<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use App\User;
use DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public function reset(Request $request){

        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email:rfc', 
            'password' => 'required|confirmed', 
            'token'     => 'required',

        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $email = $request->email;
        $password = $request->password;
        $token = $request->token;

        $user = User::where('email', $email)->where('remember_token', $token)->first();

        if($user){

           $user =  DB::table('users')
            ->where('email', $email)
            ->where('remember_token', $token)
            ->update(['password' => bcrypt($password),'remember_token' => null]);

            if($user){

                return response(['message' => 'Your password is changed!']);
            }
            
        }

        else{
            return response(['message' => 'Sorry! Invalid token']);
        }

    }

}
