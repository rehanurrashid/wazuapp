<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use OneSignal;
use App\Plan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        if (Auth::check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'vendor')) {
            return redirect('admin/dashboard');
        }
        else{
            return redirect('admin/login');
        }
    }

    public function home(Request $request)
    {   
        $plans = Plan::latest()->limit(3)->orderBy('id', 'desc')->get();

        // foreach ($posts as $post) {

        //     $created = new Carbon($post->created_at);
        //     $now = Carbon::now();
        //     $posted_on = ($created->diff($now)->days < 1)
        //     ? 'today'
        //     : (($created->diff($now)->days > 7) ? $created->format('M d Y') : $created->diffForHumans()) ;
        //     $post->posted_on = $posted_on;

        // }

        return view('user.pages.home', compact('plans'));
    }

    //privacy-policy
    public function privacy_policy()
    {
        $plans = Plan::latest()->limit(3)->orderBy('id', 'desc')->get();
        return view('user.pages.privacy-policy',compact('plans'));
    }

     //privacy-policy
    public function terms_conditions()
    {
        $plans = Plan::latest()->limit(3)->orderBy('id', 'desc')->get();
        return view('user.pages.terms_conditions',compact('plans'));
    }

    public function send_notification(){

        OneSignal::sendNotificationToAll(
            "Some Message", 
            $url = null, 
            $data = null, 
            $buttons = null, 
            $schedule = null
        );

    }

    
}
