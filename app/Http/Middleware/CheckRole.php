<?php

namespace App\Http\Middleware;

use Closure;
use App\UserPlan;
use DB;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if(!in_array($request->user()->role, $role) ){
            auth()->logout();
            return redirect()->route('admin.login')->with('not-authorized','You are not Authorized!');
        }
        else if($request->user()->role == 'vendor'){

            $plan = UserPlan::where('user_id',auth()->user()->id)->first();
            if(empty($plan)){
                return redirect()->route('home')->with('not-authorized','You are not authorized to access dashboard without activating Package!');
            }
            else{
                return $next($request);
            }
        }
        return $next($request);
    }

}
