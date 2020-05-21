<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\User;

class ChangePasswordController extends Controller
{
    public function change(Request $request){
    	
    	$validator = Validator::make($request->all(), [ 
            'old_password' => 'required', 
            'password' => 'required|confirmed', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $old_password = $request->old_password;
        $password = $request->password;

         
        $hashed_password = User::select('password')->where('id', auth()->user()->id)->first();

        if (Hash::check($old_password, $hashed_password->password))
		{
		    $user =  DB::table('users')
            ->where('id', auth()->user()->id)
            ->update(['password' => bcrypt($password) ]);

            if($user){

                return response(['message' => 'Your password is changed!']);
            }
		}
		else{
			return response(['message' => 'Sorry! Invalid Old Password']);
		}

    }
}
