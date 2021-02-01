<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorMiddleware
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
        if(Auth::user()->role_as == 'vendor')
        {
            if(Auth::check() && Auth::user()->IsBan){

                $banned = AUth::user()->IsBan=='1';
                Auth::logout();

                if($banned ==1){
                    $message ='Your account has been banned.Please contact the admin';

                }
                return redirect()->route('login')->with('status',$message)->withErrors(['email'=>'your account has been banned, please contact the admin ']);
            }

            return $next($request);
        }
        else
        {
            return redirect('/home')->with('status','You are not allowed to access the vendor dashboard');

        }
        //
    }
}
