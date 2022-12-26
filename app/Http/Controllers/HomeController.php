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
        //applacationsAnswer отвечает за ответы на заявку
        $application=[
            ['id' => 1, 'name' => 'Установка ПО', 'applacationsAnswer'=>['idAppl'=>1, 'nameUser'=>'Truehero']],
            ['id' => 2, 'name' => 'Установка новогодней ёлки'],
            ['id' => 3, 'name' => 'Отчёт о проведённых ежегодных экскурсий'],
        ];
        return view('application/myAppl',['myApplData'=>$application]);
    }

    public function incApplication(){
        //входящие
        //логика получения из бд тех заявок, на которые нужно ответить пользователю
        $application=[
            ['id' => 1, 'name' => 'Установка ПО'],
            ['id' => 2, 'name' => 'Установка новогодней ёлки'],
            ['id' => 3, 'name' => 'Отчёт о проведённых ежегодных экскурсий'],
        ];
        return view('application/incAppl',['incAplData'=>$application]);
    }

    public function allApplication(){
        //комбо myApplication() и incApplication()
        //передача в 2 переменные

        $application1=[
            ['id' => 1, 'name' => 'Установка ПО', 'applacationsAnswer'=>['idAppl'=>1, 'nameUser'=>'Truehero'], 'decript'=>'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem '],
            ['id' => 2, 'name' => 'Установка новогодней ёлки'],
            ['id' => 3, 'name' => 'Отчёт о проведённых ежегодных экскурсий'],
        ];

        $application2=[
            ['id' => 1, 'name' => 'Установка ПО часть 2'],

        ];

        return view('application/allAppl',['myApplData'=>$application1,'incAplData'=>$application2]);
    }

    public function doApplication(){

        return view('applications/createApplication');
    }

    public function viewApplic($idAppl){

        // тип БД
        $ApplicGlobal=[
            ['id' => 1, 'name' => 'Установка ПО',
            'applacationsAnswer'=>['idAppl'=>1, 'nameUser'=>'Truehero'], 
            'decript'=>'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem ',
            'data'=>"2022-12-30",
            'groupSelect'=>[
                "Учебная часть",
            ],
            'peopleSelect'=>[
                "Аристова Елена Генадьевна",
                "Багина Ксения Евгеньевна"
            ],
            'file'=>"какой-то.pdf",
        ],
            ['id' => 2, 'name' => 'Установка новогодней ёлки'],
            ['id' => 3, 'name' => 'Отчёт о проведённых ежегодных экскурсий'],
        ];

        // sql запрос
        // работа...
        // sql выдача передаётся в applic

        // проверка на то, что пользователь создатель
        // передаётся через trigerCreater
        return view('applications/viewApplication',[ 'applic'=> $ApplicGlobal[$idAppl], 'trigerCreater'=>true]);
    }
}
