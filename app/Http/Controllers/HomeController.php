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
        //ВАЖНО!!!!!!!!!!!!!!!!
        //получение событий из БД
        return view('home',['calendar'=>$calendar]);
    }

    public function myApplication(){
        //исходящие
        //вытягивание из БД тех заявок, на которые должны дать ответ другие пользователи
        return view('myAppl');
    }

    public function incApplication(){
        //входящие
        //логика получения из бд тех заявок, на которые нужно ответить пользователю
        return view('incAppl');
    }

    public function allApplication(){
        //комбо myApplication() и incApplication()
        //передача в 2 переменные
        return view('allAppl');
    }
}
