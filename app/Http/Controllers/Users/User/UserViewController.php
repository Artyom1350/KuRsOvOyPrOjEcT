<?php

namespace App\Http\Controllers\Users\User;

use App\Http\Controllers\Controller;
use App\Models\AccessUser;
use App\Models\Calendar;
use App\Models\Document;

class UserViewController extends Controller
{
    /** Календарь */
    public function index()
    {
        $calendar = new Calendar();
        //ВАЖНО!!!!!!!!!!!!!!!!
        //получение событий из БД
        //для примера можно добавить всякие праздники и т.д.
        $events = array('31.1.2023' => 'Последний день января...');
        $da = auth()->user()->access_users()->get();
        foreach ($da as $accessDoc) {
            $doc = $accessDoc->document()->first();
            $arr = array(date("d.m.Y", strtotime($doc['dateAppl'])) => $doc['title']);
            $events += $arr;
        }
        $name = auth()->user()->name;
        return view('home', ['calendar' => $calendar, 'events' => $events, 'name' => $name]);
    }

    /**Исходящие заявки */
    public function myApplication()
    {
        //вытягивание из БД тех заявок, на которые должны дать ответ другие пользователи
        //applacationsAnswer отвечает за ответы на заявку
        $application = array();
        $documents = auth()->user()->documents()->orderBy('created_at', 'DESC')->/*dd()*/get();
        foreach ($documents as $item) {
            $visible = true;
            $visibleProv = $item->access_users()->get();
            foreach ($visibleProv as $access) {
                if ($access['status'] > 0) {
                    $visible = false;
                    break;
                }
            }
            array_push($application, array('id' => $item['id'], 'name' => $item['title'], 'visible' => $visible));
        }
        return view('application/myAppl', ['myApplData' => $application, 'token'=>auth()->user()->tokens->first()->token]);
    }

    /**Входящие заявки */
    public function incApplication()
    {
        $user = "";
        $application = array(); //создал массив для хранения переменных
        $access = auth()->user()->access_users()->orderBy('created_at', 'DESC')->get(); //да, получил все доступные доки(их id)
        foreach ($access as $item) {
            $documents = $item->document()->orderBy('created_at', 'DESC')->get(); //выборка доступных доков
            foreach ($documents as $document) {
                $user = $document->user()->get(); //Кто создал?

                $id = $document['id'];
                $title = $document['title'];
            }
            //ниже массив для пуша
            $itemToArray = array('userName' => $user->first()["name"], 'userId' => $user->first()["id"], 'title' => $title, 'idDocument' => $id);
            array_push($application, $itemToArray);
        }

        return view('application/incAppl', ['incAplData' => $application, 'token'=>auth()->user()->tokens->first()->token]);
    }


    /**Все заявки */
    public function allApplication()
    {
        //исходящие
        $application = array();
        $documents = auth()->user()->documents()->orderBy('created_at', 'DESC')->get();
        foreach ($documents as $item) {
            $visible = true;
            $visibleProv = $item->access_users()->get();
            foreach ($visibleProv as $access) {
                if ($access['status'] > 0) {
                    $visible = false;
                    break;
                }
            }
            array_push($application, array('id' => $item['id'], 'name' => $item['title'], 'visible' => $visible));
        }
        //входящие
        $user = "";
        $application1 = array(); //создал массив для хранения переменных
        $access = auth()->user()->access_users()->orderBy('created_at', 'DESC')->get(); //да, получил все доступные доки(их id)
        //просто да(перебор)
        foreach ($access as $item) {
            $documents = $item->document()->orderBy('created_at', 'DESC')->get(); //выборка доступных доков
            foreach ($documents as $document) {
                $user = $document->user()->get(); //Кто создал?

                $id = $document['id'];
                $title = $document['title'];
            }
            //ниже массив для пуша
            $itemToArray = array('userName' => $user->first()["name"], 'userId' => $user->first()["id"], 'title' => $title, 'idDocument' => $id);
            array_push($application1, $itemToArray);
        }

        return view('application/allAppl', ['myApplData' => $application, 'incAplData' => $application1 ,'token'=>auth()->user()->tokens->first()->token]);
    }

    /** Входящая одна заявка */
    public function viewOne($id)
    {
        if(auth()->user()->access_users()->where('document_id', $id)->first()){
            $document = auth()->user()->access_users()->where('document_id', $id)->first()->document()->get();
            $title = $document->first()['title'];
            $user = $document->first()->user()->first()['name'];
            $description = $document->first()['description'];
            $dateAppl = $document->first()['dateAppl'];
            $status = auth()->user()->access_users()->where('document_id', $id)->first()['status'];
            $application = array('userName' => $user, 'fileName' => $document->first()->file, 'description' => $description, 'dateAppl' => $dateAppl, 'title' => $title, 'doc_id' => $id, 'status' => $status);
            return view('application/OneAppl', ['applic' => $application, 'token'=>auth()->user()->tokens->first()->token]);
        }
        return redirect()->route('home');
    }


    /** Страница создания заявки */
    public function doApplication()
    {
        return view('applicationsDo/createApplication', ['token'=>auth()->user()->tokens->first()->token]);
    }

    /** Страница редактирования заявки */
    public function changeAppl($id)
    {
        $document = Document::where('id', $id)->get();
        $access = AccessUser::where('document_id', $id)->get();
        $users = array();
        foreach ($access as $acc) {
            $ac = $acc->user()->get();
            foreach ($ac as $a) {
                array_push($users, $a);
            }
        }
        return view('applicationsDo/changeApplication', ['doc' => $document, 'users' => $users, 'token'=>auth()->user()->tokens->first()->token]);
    }
}
