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
        $application=[
            ['id' => 1, 'name' => 'Admin', 'applacationsAnswer'=>['idAppl'=>1, 'nameUser'=>'Truehero']],
            ['id' => 2, 'name' => 'Truehero'],
            ['id' => 3, 'name' => 'Truecoder'],
        ];
        return view('myAppl',['myApplData'=>$application]);
    }

    public function incApplication(){
        //входящие
        //логика получения из бд тех заявок, на которые нужно ответить пользователю
        $application=[
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Truehero'],
            ['id' => 3, 'name' => 'Truecoder'],
        ];
        return view('incAppl',['incAplData'=>$application]);
    }

    public function allApplication(){
        //комбо myApplication() и incApplication()
        //передача в 2 переменные

        $application1=[
            ['id' => 1, 'name' => 'Admin', 'applacationsAnswer'=>['idAppl'=>1, 'nameUser'=>'Truehero']],
            ['id' => 2, 'name' => 'Truehero'],
            ['id' => 3, 'name' => 'Truecoder'],
        ];

        $application2=[
            ['id' => 1, 'name' => 'Admin2'],

        ];

        return view('allAppl',['myApplData'=>$application1,'incAplData'=>$application2]);
    }
}
