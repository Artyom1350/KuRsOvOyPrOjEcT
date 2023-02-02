<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /*protected function redirectTo(){
        if(auth()->user()->role==1){
            //dd(auth()->user());
            return redirect('home_admin');
        }
        return redirect('home');
    }*/

    protected function authenticated(){
        if(auth()->user()->role==1){
            return redirect(route('login_admin'));
        }
        else{
            return redirect(route('login_user'));
        }

    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
