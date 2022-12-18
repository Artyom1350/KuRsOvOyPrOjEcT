<?php

namespace App\Http\Controllers;
use App\Models\Calendar;
use App\Models\User;

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
        $user=auth()->user();
        //ВАЖНО!!!!!!!!!!!!!!!!
        //получение событий из БД
        return view('home',['calendar'=>$calendar, 'user'=>$user]);
    }

    public function myApplication(){
        //исходящие
        //вытягивание из БД тех заявок, на которые должны дать ответ другие пользователи
        $documents=auth()->user()->documents()->get();

        return view('myAppl',['documents'=>$documents]);
    }

    public function incApplication(){
        //входящие
        //логика получения из бд тех заявок, на которые нужно ответить пользователю

        //$documents=
        return view('incAppl');
    }

    public function allApplication(){
        //комбо myApplication() и incApplication()
        //передача в 2 переменные
        return view('allAppl');
    }
}
