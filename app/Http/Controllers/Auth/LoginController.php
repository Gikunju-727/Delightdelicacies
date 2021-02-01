<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    /*public function redirecTo(){
        //Admin login 1
        if(Auth::user()->role_as =='admin'){
            return 'dashboard';

        }

        //Vendor login
        if(Auth::user()->role_as =='vendor'){
            return 'vendor-dashboard';

        }

        //Normal user
        if(Auth::user()->role_as ==NULL){
            return 'home';

        }
        /*else
        {
            return 'home';
        }*/
    //}
    public function authenticated(){
        //Admin login 1
        if(Auth::user()->role_as =='admin'){
            return redirect('dashboard')->with('status','logged in ');

        }

        //Vendor login
        elseif(Auth::user()->role_as =='vendor'){
            return redirect('vendor-dashboard')->with('status','login');

        }

        //Normal user
        elseif(Auth::user()->role_as ==NULL){
            return redirect()->back()->with('status','Successfully login');

        }
        /*else
        {
            return 'home';
        }*/
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
