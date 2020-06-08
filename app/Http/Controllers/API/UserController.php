<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\UserProfile;
use App\Message;
use Validator;
use App\User;
use DB;

class UserController extends Controller
{
public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {


            if (auth()->user()->status != 1){
                return response()->json(['message'=>'User can not Login'], 401);
            }
            if (auth()->user()->role != 'customer'){
                return response()->json(['message'=>'You are not authorized. Only customers can login.'], 401);
            }

            $token = auth()->user()->createToken('Web')->accessToken;

            return response()->json(['token' => $token,'user'=> Auth::user()], 200);
        } else {
            return response()->json(['error' => 'Login Credentials were wrong '], 401);
        }
    }
/**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc|unique:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()], 401);
            }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role'=>'customer',
        ]);

        $profile = new UserProfile([
                'user_id' => $user->id,
            ]);

        $profile = $user->profile()->save($profile);

        $success['token'] =  $user->createToken('mobile')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json([
            'message' => 'Logout successfully'
        ],200);
    }

    public function update(Request $request){

         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.auth()->user()->id,
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user = DB::table('users')
              ->where('id', auth()->user()->id)
              ->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

        $profile = DB::table('user_profiles')
              ->where('user_id', auth()->user()->id)
              ->update([
                'photo' => $request->image,
            ]);

        if($profile){
            return response()->json(['success'=>'User profile updated successfully'], $this->successStatus);
        }
        else{
            return response()->json(['success'=>'Unable to update user profile'], 401);
        }

    }

/**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    public function product_detail($slug){
        $prodcut = Product::where('slug',$slug)->first();
        dd($prodcut);
    }


    public function store_history(Request $request){

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()], 401);
        }

        $history =  DB::table('history')->insert([
                    'user_id'   => auth()->user()->id,
                    'product_id' => $request->product_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),

                ]);

        if($history){
            return response(['message' => 'Store in history']);
        }

    }

    public function show_history(Request $request){

        $history = User::with('history')->where('id', auth()->user()->id )->get();

        if(!empty($history[0])){
            return response(['message' => $history]);
        }
        else{
            return response(['message' => 'No History Found!']); 
        }
    }

    public function messages()
    {
        $messages = Message::where('receiver_id','=', auth()->user()->id)->get();

        if(!empty($messages[0])){
            return response(['notifications' => $messages]); 
        }
        else{
            return response(['notifications' => 'No Notifications Found!']); 
        }
    }

    public function read_message($id){

        $message = Message::find($id);
        $message->read_at = date("Y-m-d H:i:s");
        $message->save();

        if($message){
            return response(['message' => 'true']); 
        }
        else{
            return response(['message' => 'false']); 
        }

    }

    public function read_all_message(){

        $messages = Message::where('receiver_id','=', auth()->user()->id)->get();

        foreach ($messages as $message) {
            $message->read_at = date("Y-m-d H:i:s");
            $message->save();
        }
        
        if($message){
            return response(['message' => 'true']); 
        }
        else{
            return response(['message' => 'false']); 
        }
    }
}
