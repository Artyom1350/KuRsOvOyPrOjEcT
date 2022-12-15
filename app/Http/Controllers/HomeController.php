<?php

namespace App\Http\Controllers;
use App\Models\Calendar;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $calendar=new Calendar;
        return view('home',['calendar'=>$calendar]);
    }

    public function myApplication(){
        
        return view('myAppl');
    }
}
