<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Notifications\MessageAdded;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Notification;
use App\Message;
use App\Product;
use App\User;
use DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          if($request->ajax()){

            $message = Message::select(['id', 'receiver_name','title','body','image','read_at' ,'created_at', 'updated_at'])->get();
            // dd($message);
            return Datatables::of($message)
                ->addColumn('action', function ($message) {
                    return view('manage.actions.actions_message',compact('message'));
                    })
                ->editColumn('read_at', function($message){
                    if($message->read_at==null){
                        return 'Not Read';
                    }
                    else{
                        return $message->read_at;
                    }
                })
                ->addColumn('image', function ($product) {
                        if($product->image != Null){
                            return '<img src="'.$product->image.'" width="200" height="200" class="img-thumbnail" style="max-width:170px">';
                        }else{
                            return '<b>No Image Yet!</b>';
                        }

                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->rawColumns(['user_name','image'])
                ->make(true);
        }
       return view('manage.message.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('manage.message.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = DB::select('SELECT DISTINCT  user_id,product_id FROM history WHERE product_id IN ( SELECT product_id FROM products WHERE user_id = ?) ', [auth()->user()->id]);


        foreach ($users as $user) {

            $message = new Message;
            $receiver = User::select('name','id')->where('id', $user->user_id)->first();
            $product = Product::select('image','id')->where('id', $user->product_id)->first();

            if(!empty($receiver) && !empty($product)){
                $check_message = Message::where('receiver_id','=',$receiver->id)
                    ->where('product_id','=', $product->id)
                    ->where('sender_id','=', auth()->user()->id)
                    ->first();
            }

            if(empty($check_message)){
                $message->sender_id = auth()->user()->id;
                $message->receiver_id = $receiver->id;
                $message->product_id = $product->id;
                $message->receiver_name = $receiver->name;
                $message->title = $request->title;
                $message->body = $request->body;
                $message->image = $product->image;
                $message = $message->save();
            }  
        }

        if($message){
            Session::flash('message', 'Message Created Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('messages');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);
        return view('manage.message.edit',compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Message::find($id);
        $message->title = $request->title;
        $message->body = $request->body;
        $message->save();

        if($message){
            Session::flash('message', 'Message Updated Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('messages');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id)->delete();
        if($message){
            return view('manage.message.index');
        }
    }
}
