<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //return $next($request);
        if(Auth::check() && Auth::user()->IsBan){

            $banned = AUth::user()->IsBan=='1';
            Auth::logout();

            if($banned ==1){
                $message ='Your account has been banned.Please contact the admin';

            }
            return redirect()->route('login')->with('status',$message)->withErrors(['email'=>'your account has been banned, please contact the admin ']);
        }
        if(Auth::check()){
            $expiredAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online'.Auth::user()->id, true,$expiredAt);
        }
        return $next($request);
    }
}
