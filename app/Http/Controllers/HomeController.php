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

    public function myApplication(){
        //исходящие
        //вытягивание из БД тех заявок, на которые должны дать ответ другие пользователи
        //applacationsAnswer отвечает за ответы на заявку

        $application=array();
        $documents=auth()->user()->documents()->get();
        
        //$array;
        foreach($documents as $item){
            array_push($application,array('id' => $item['id'], 'name' => $item['title']));
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
        // $documentName="";
        // $user="";
        // $description="";
        // $dateCreate="";
        // $file="";

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

            array_push($application1,array('id' => $item['id'], 'name' => $item['title']));
        }

        return view('application/allAppl',['myApplData'=>$application1,'incAplData'=>$application2]);
    }

    public function viewOne($id){
         //входящая 1 заявка

        $document=auth()->user()->access_users()->where('document_id',$id)->first()->document()->get();

        $title=$document->first()['title'];
        $user=$document->first()->user()->first()['name'];
        $description=$document->first()['description'];
        $dateAppl=$document->first()['dateAppl'];

        $application=array('userName'=>$user,'fileName'=>$document->first()->file,'description'=>$description,'dateAppl'=>$dateAppl,'title'=>$title, 'doc_id'=>$id);
        return view('application/OneAppl',[ 'applic'=> $application]);
    }

    public function doApplication(){
        return view('applicationsDo/createApplication');
    }

    public function addApplication(Request $request){
        $users=array();
        $group=array();
       
        if($request->post('peopleSelect')!=null){
            $users=explode(',',$request->post('peopleSelect'));
        }
        if($request->post('groupSelect')!=null){
            $groups=explode(',',$request->post('groupSelect'));
        }

        $file=$request->file('file');

        $path='documents';
        $storePath=Storage::disk('local')->put('documents', $file);
        $fileName=basename($storePath);
        $filePath = $path . '/' . $fileName;

        $arrProv=array();
        $arrProv1=array();
        if($request->post('groupSelect')!=null){
            foreach($groups as $index){
                //$group=Department::find($index)->departmentsParts()->first()->users()->get();
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
        //dd($users);

        $doc=Document::create([
            'user_id'=>/*auth()->id()*/1,
            'file'=>$request->post('fileName'),
            'title'=>$request->post('nameAppl'),
            'path'=>$filePath,
            'dateAppl'=>$request->post('dateAppl'),
            'description'=>$request->post('descriptionAppl'),
        ]);

        $us=array();
        foreach($users as $user){
            array_push($us,$user);
            //dd($user);
            $acc=AccessUser::create([
                'user_id'=>$user,
                'document_id'=>$doc['id'],
            ]); 
        }
        

        
        return response(auth()->id());
    }

    public function getUsers(){
        $users=User::whereKeyNot(auth()->id())->get();
        return response()->json(['users'=>$users]);
    }

    public function downloadAppl($id){
        $doc=Document::where('id',$id)->get();
        foreach($doc as $docs){
            return Storage::download($docs["path"],$docs['file']);
        } 
    }

    public function changeAppl($id){

        $doc=Document::where('id',$id)->get();
        $access=AccessUSer::where('document_id',$id)->get();
        $users=array();
        foreach($access as $acc){
            $ac=$acc->user()->get();
            foreach($ac as $a){
                array_push($users,$a);
            }

        }
        //есть лишние переменные!!! т.к. не заработал адекватно блоб, нужно будет чистить если сойдет и то решение
        $path='';
        $docName='';
        foreach($doc as $do){
           // dd($do);
            $path=$do['path'];
            $docName=$do['file'];
        }
       // $path1=file();
       $file=Storage::get($path);
       //dd($file);
       
        //dd($users);
        return view('applicationsDo/changeApplication',['doc'=>$doc, 'users'=>$users, 'file'=>$path,'fileName'=>[$docName]]);
    }
    public function getDocument(Request $request){
        $path=$request->post('path');
        //$path=$path."da";
        //dd(Storage::get($path));
        $data=file_get_contents(Storage::get($path));
        return response($data);
    }


    public function changeApplSend(Request $request){
        
        $path='documents';

        $docEdit=Document::find($request->post('doc_id'));

        $docEdit->title=$request->post('nameAppl');
        $docEdit->dateAppl=$request->post('dateAppl');
        $docEdit->description=$request->post('descriptionAppl');

        if(empty($request->post('file'))){
            $file=$request->file('file');
            Storage::delete($docEdit->path);
            $storePath=Storage::disk('local')->put('documents', $file);
            $fileName=basename($storePath);
            $filePath = $path . '/' . $fileName;

            $docEdit->path=$filePath;
            $docEdit->file=$request->post('fileName');
        }
        $docEdit->save();

        

        $accForDelete=AccessUser::where('document_id',$request->post('doc_id'))->get();
        foreach($accForDelete as $acc){
            $acc->delete();
        }

        $users=explode(',',$request->post('peopleSelect'));
        foreach($users as $user){
            $acc=AccessUser::create([
                'user_id'=>$user,
                'document_id'=>$request->post('doc_id'),
            ]); 
        }

        
        return response()->json($request);
    }
    public function getDepartment(){
        $department=Department::all();
        return response()->json(['department'=>$department]);
    }
}
