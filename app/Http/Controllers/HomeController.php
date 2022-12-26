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

        $application=array();
        $documents=auth()->user()->documents()->get();
        
        //$array;
        foreach($documents as $item){
            //$access=$item->access_users()->get(); позже

            array_push($application,array('id' => 1, 'name' => $item['title']));
        }

        return view('application/myAppl',['myApplData'=>$application]);
    }

    public function incApplication(){
        //входящие

        // ['userName','userId','fileName','title','description','dateCreate']
        //переменные(вдруг ошибки будут тип они за областью видимости)
        $documentName="";
        $user="";
        $description="";
        $dateCreate="";
        $file="";

        $access=auth()->user()->access_users()->get(); //да, получил все доступные доки(их id)
        $application=array(); //создал массив для хранения дичи
        //просто да(перебор)

        foreach($access as $item){
            $documents=$item->document()->get(); //выборка доступных доков
            foreach($documents as $document){
                $documentName=$document['title']; //Название документа
                $user=$document->user()->get(); //Кто создал?

                $id=$document['id'];
                $file=$document['file'];
                $title=$document['title'];
                $description=$document['description']; //описание документа
                $dateCreate=$document['created_at']; //Когда создали
            }
            //ниже массив для пуша
            $itemToArray=array('userName'=>$user->first()["name"],'userId'=>$user->first()["id"],'fileName'=>$file,'description'=>$description,'dateCreate'=>$dateCreate,'title'=>$title, 'idDocument'=>$id);
            array_push($application,$itemToArray);
        }

        return view('application/incAppl',['incAplData'=>$application]);
    }

    public function allApplication(){
        //комбо myApplication() и incApplication()
        //передача в 2 переменные
        // ['userName','userId','fileName','title','description','dateCreate']
        //переменные(вдруг ошибки будут тип они за областью видимости)
        $documentName="";
        $user="";
        $description="";
        $dateCreate="";
        $file="";

        $access=auth()->user()->access_users()->get(); //да, получил все доступные доки(их id)
        $application2=array(); //создал массив для хранения дичи
        //просто да(перебор)

        foreach($access as $item){
            $documents=$item->document()->get(); //выборка доступных доков
            foreach($documents as $document){
                $documentName=$document['title']; //Название документа
                $user=$document->user()->get(); //Кто создал?

                $id=$document['id'];
                $file=$document['file'];
                $title=$document['title'];
                $description=$document['description']; //описание документа
                $dateCreate=$document['created_at']; //Когда создали
            }
            //ниже массив для пуша
            $itemToArray=array('userName'=>$user->first()["name"],'userId'=>$user->first()["id"],'fileName'=>$file,'description'=>$description,'dateCreate'=>$dateCreate,'title'=>$title, 'idDocument'=>$id);
            array_push($application2,$itemToArray);
        }

         //исходящие
        //вытягивание из БД тех заявок, на которые должны дать ответ другие пользователи
        //applacationsAnswer отвечает за ответы на заявку

        $application1=array();
        $documents=auth()->user()->documents()->get();
        
        //$array;
        foreach($documents as $item){
            //$access=$item->access_users()->get(); позже

            array_push($application1,array('id' => 1, 'name' => $item['title']));
        }



        return view('application/allAppl',['myApplData'=>$application1,'incAplData'=>$application2]);
    }

    public function viewOne($id){
        $application="";
        dd($application);
        return view('application/OneAppl',[ 'applic'=> $application]);
    }

    public function doApplication(){

        return view('applicationsDo/createApplication');
    }
}
