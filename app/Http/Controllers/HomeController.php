<?php

namespace App\Http\Controllers;
use App\Models\Calendar;
use App\Models\User;
use App\Models\Document;
use App\Models\Department;
use App\Models\AccessUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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


    //Просмотр заявок
    public function myApplication(){
        //исходящие
        //вытягивание из БД тех заявок, на которые должны дать ответ другие пользователи
        //applacationsAnswer отвечает за ответы на заявку

        $application=array();
        $documents=auth()->user()->documents()->get();
        foreach($documents as $item){
            array_push($application,array('id' => $item['id'], 'name' => $item['title']));
        }
        return view('application/myAppl',['myApplData'=>$application]);
    }

    public function incApplication(){
        //входящие
        //переменные(вдруг ошибки будут тип они за областью видимости)
        $user="";
        $application=array(); //создал массив для хранения переменных
        $access=auth()->user()->access_users()->get(); //да, получил все доступные доки(их id)
        //просто да(перебор)
        foreach($access as $item){
            $documents=$item->document()->get(); //выборка доступных доков
            foreach($documents as $document){
                $user=$document->user()->get(); //Кто создал?

                $id=$document['id'];
                $title=$document['title'];
            }
            //ниже массив для пуша
            $itemToArray=array('userName'=>$user->first()["name"],'userId'=>$user->first()["id"],'title'=>$title, 'idDocument'=>$id);
            array_push($application,$itemToArray);
        }

        return view('application/incAppl',['incAplData'=>$application]);
    }

    public function allApplication(){
        //исходящие
        $application=array();
        $documents=auth()->user()->documents()->get();
        foreach($documents as $item){
            array_push($application,array('id' => $item['id'], 'name' => $item['title']));
        }
        //входящие
        $user="";
        $application1=array(); //создал массив для хранения переменных
        $access=auth()->user()->access_users()->get(); //да, получил все доступные доки(их id)
        //просто да(перебор)
        foreach($access as $item){
            $documents=$item->document()->get(); //выборка доступных доков
            foreach($documents as $document){
                $user=$document->user()->get(); //Кто создал?

                $id=$document['id'];
                $title=$document['title'];
            }
            //ниже массив для пуша
            $itemToArray=array('userName'=>$user->first()["name"],'userId'=>$user->first()["id"],'title'=>$title, 'idDocument'=>$id);
            array_push($application1,$itemToArray);
        }

        return view('application/allAppl',['myApplData'=>$application,'incAplData'=>$application1]);
    }

    public function viewOne($id){
         //входящая 1 заявка

        $document=auth()->user()->access_users()->where('document_id',$id)->first()->document()->get();

        $title=$document->first()['title'];
        $user=$document->first()->user()->first()['name'];
        $description=$document->first()['description'];
        $dateAppl=$document->first()['dateAppl'];

        /*
            вывод из документа его статус в числовом эквиваленте
            покм п оумолчанию сделаю 0
            проверил с другими значениями
            всё работает
            */

        $status=0;
        $application=array('userName'=>$user,'fileName'=>$document->first()->file,'description'=>$description,'dateAppl'=>$dateAppl,'title'=>$title, 'doc_id'=>$id, 'status'=>$status);
        return view('application/OneAppl',[ 'applic'=> $application]);
    }

    //Открытие страниц операций

    public function doApplication(){
        return view('applicationsDo/createApplication');
    }

    public function changeAppl($id){
        $document=Document::where('id',$id)->get();
        $access=AccessUSer::where('document_id',$id)->get();
        $users=array();
        foreach($access as $acc){
            $ac=$acc->user()->get();
            foreach($ac as $a){
                array_push($users,$a);
            }
        }
        return view('applicationsDo/changeApplication',['doc'=>$document, 'users'=>$users]);
    }

    //Совершение операций (переписать на api)
    public function addApplication(Request $request){
        //переменные для работы
        $users=array();
        $group=array();
        $arrProv=array();
        $arrProv1=array();
        $path='documents';

       //получение юзеров из запроса
        if($request->post('peopleSelect')!=null){
            $users=explode(',',$request->post('peopleSelect'));
        }
        if($request->post('groupSelect')!=null){
            $groups=explode(',',$request->post('groupSelect'));
        }

        //работа с файлом
        $file=$request->file('file');
        $storePath=Storage::disk('local')->put('documents', $file);
        $fileName=basename($storePath);
        $filePath = $path . '/' . $fileName;

        //создание документа
        $doc=Document::create([
            'user_id'=>auth()->id(),
            'file'=>$request->post('fileName'),
            'title'=>$request->post('nameAppl'),
            'path'=>$filePath,
            'dateAppl'=>$request->post('dateAppl'),
            'description'=>$request->post('descriptionAppl'),
        ]);

        //перебор юзеров, проверка на совпадение полученных id_user и занесение в массив
        if($request->post('groupSelect')!=null){
            foreach($groups as $index){
                $group=Department::find($index)->departmentsParts()->get();
                foreach($group as $parts){
                    $userPart=$parts->users()->get();
                    array_push($arrProv,$userPart);
                }
            }
            foreach($arrProv as $item){
                if(isset($item->first()['id'])){
                    if($item->first()['id']!=auth()->id()){
                        array_push($arrProv1,$item->first()['id']);
                    }
                }
            }
            $users = array_unique (array_merge ($users, $arrProv1));
        }

        //запись в AccessUser
        foreach($users as $user){
            $acc=AccessUser::create([
                'user_id'=>$user,
                'document_id'=>$doc['id'],
            ]); 
        }

        //ответ
        return response(auth()->id());
    }
    public function changeApplSend(Request $request){

        //переменные для работы
        $users=array();
        $group=array();
        $arrProv=array();
        $arrProv1=array();
        $path='documents';
       
        //получение групп и юзеров
        if($request->post('peopleSelect')!=null){
            $users=explode(',',$request->post('peopleSelect'));
        }

        if($request->post('groupSelect')!=null){
            $groups=explode(',',$request->post('groupSelect'));
        }
    
        //работа с документом
        $docEdit=Document::find($request->post('doc_id'));
        
        $docEdit->title=$request->post('nameAppl');
        $docEdit->dateAppl=$request->post('dateAppl');
        $docEdit->description=$request->post('descriptionAppl');

        //если есть файл удаляем старый и записываем новый
        if($request->post('file')!=null){
            $file=$request->file('file');
            Storage::delete($docEdit->path);
            $storePath=Storage::disk('local')->put('documents', $file);
            $fileName=basename($storePath);
            $filePath = $path . '/' . $fileName;
            $docEdit->path=$filePath;
            $docEdit->file=$request->post('fileName');
        }
        $docEdit->save();

        //удаляем старые данные из AccessUser, чтобы записать новые
        $accForDelete=AccessUser::where('document_id',$request->post('doc_id'))->get();
        foreach($accForDelete as $acc){
            $acc->delete();
        }

        //Совмещаем user и user из групп + создаем их массив
        if($request->post('groupSelect')!=null){
            foreach($groups as $index){
                $group=Department::find($index)->departmentsParts()->get();
                foreach($group as $parts){
                    $userPart=$parts->users()->get();
                    array_push($arrProv,$userPart);
                }
            }
            foreach($arrProv as $item){
                if(isset($item->first()['id'])){
                    if($item->first()['id']!=auth()->id()){
                        array_push($arrProv1,$item->first()['id']);
                    }
                }
            }
            $users = array_unique (array_merge ($users, $arrProv1));
        }

        //записываем новый набор юзеров в AccessUser
        foreach($users as $user){
            $acc=AccessUser::create([
                'user_id'=>$user,
                'document_id'=>$docEdit['id'],
            ]); 
        }
        //Ответ
        return response()->json($request);
    }

    //то что тоже должно быть в api
    public function getUsers(){
        //простая логика получения всех юзеров кроме нашего
        $users=User::whereKeyNot(auth()->id())->get();
        return response()->json(['users'=>$users]);
    }

    public function downloadAppl($id){
        //загрузка документа из хранлища по id из get
        $doc=Document::where('id',$id)->get();
        foreach($doc as $docs){
            return Storage::download($docs["path"],$docs['file']);
        } 
    }

    public function getDepartment(){
        //Все департаменты юзеров
        $department=Department::all();
        return response()->json(['department'=>$department]);
    }



    //ненужная дичь(наверное)
    public function getDocument(Request $request){
        $path=$request->post('path');
        $data=file_get_contents(Storage::get($path));
        return response($data);
    }
}
