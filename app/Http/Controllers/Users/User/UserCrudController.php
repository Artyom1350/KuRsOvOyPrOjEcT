<?php

namespace App\Http\Controllers\Users\User;

use App\Http\Controllers\Controller;
use App\Models\AccessUser;
use App\Models\Department;
use App\Models\Document;
use App\Models\User;
use App\Models\EmailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\PersonalAccessToken;

class UserCrudController extends Controller
{

    /** Добавление новой заявки */
    public function addApplication(Request $request)
    {
        //переменные для работы
        $users = array();
        $group = array();
        $arrProv = array();
        $arrProv1 = array();
        $path = 'documents';
        $current_user=PersonalAccessToken::where('token', $request->post('token'))->first()->tokenable->id;

        //получение юзеров из запроса
        if ($request->post('peopleSelect') != null) {
            $users = explode(',', $request->post('peopleSelect'));
        }
        if ($request->post('groupSelect') != null) {
            $groups = explode(',', $request->post('groupSelect'));
        }

        //работа с файлом
        $file = $request->file('file');
        $storePath = Storage::disk('local')->put('documents', $file);
        $fileName = basename($storePath);
        $filePath = $path . '/' . $fileName;
        //создание документа
        try{
            $doc = Document::create([
                'user_id' => $current_user,
                'file' => $request->post('fileName'),
                'title' => $request->post('nameAppl'),
                'path' => $filePath,
                'dateAppl' => $request->post('dateAppl'),
                'description' => $request->post('descriptionAppl'),
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error','Ошибка создания документа']);
        }

        //перебор юзеров, проверка на совпадение полученных id_user и занесение в массив
        if ($request->post('groupSelect') != null) {
            foreach ($groups as $index) {
                $group = Department::find($index)->departmentsParts()->get();
                foreach ($group as $parts) {
                    $userPart = $parts->users()->get();
                    array_push($arrProv, $userPart);
                }
            }
            foreach ($arrProv as $item) {
                if (isset($item->first()['id'])) {
                    if ($item->first()['id'] != $current_user) {
                        array_push($arrProv1, $item->first()['id']);
                    }
                }
            }
            $users = array_unique(array_merge($users, $arrProv1));
        }

        //запись в AccessUser
        foreach ($users as $user) {
            AccessUser::create([
                'user_id' => $user,
                'document_id' => $doc['id'],
                'status' => 0
            ]);
            EmailSender::sendEmailForUsers($request->post('nameAppl'),User::find($user)->email,$doc['id']);
        }

        //ответ
        return response()->json(['success',"Заявка успешно создана"]);
    }

    /** Редактирование заявки */
    public function changeApplSend(Request $request)
    {
        //переменные для работы
        $users = array();
        $group = array();
        $arrProv = array();
        $arrProv1 = array();
        $path = 'documents';
        $current_user=PersonalAccessToken::where('token', $request->post('token'))->first()->tokenable->id;

        //получение групп и юзеров
        if ($request->post('peopleSelect') != null) {
            $users = explode(',', $request->post('peopleSelect'));
        }

        if ($request->post('groupSelect') != null) {
            $groups = explode(',', $request->post('groupSelect'));
        }

        //работа с документом
        $docEdit = Document::find($request->post('doc_id'));
        try{
            $docEdit->title = $request->post('nameAppl');
            $docEdit->dateAppl = $request->post('dateAppl');
            $docEdit->description = $request->post('descriptionAppl');    
        }
        catch(\Exception $e){
            return response()->json('error','Ошибка при редактировании!');            
        }

        //если есть файл удаляем старый и записываем новый
        if ($request->file('file') != null) {
            $file = $request->file('file');
            try{
                Storage::delete($docEdit->path);
            }
            catch(\Exception $e){}
            $storePath = Storage::disk('local')->put('documents', $file);
            $fileName = basename($storePath);
            $filePath = $path . '/' . $fileName;
            $docEdit->path = $filePath;
            $docEdit->file = $request->post('fileName');
        }
        $docEdit->save();

        //удаляем старые данные из AccessUser, чтобы записать новые
        $accForDelete = AccessUser::where('document_id', $request->post('doc_id'))->get();
        foreach ($accForDelete as $acc) {
            $acc->delete();
        }

        //Совмещаем user и user из групп + создаем их массив
        if ($request->post('groupSelect') != null) {
            foreach ($groups as $index) {
                $group = Department::find($index)->departmentsParts()->get();
                foreach ($group as $parts) {
                    $userPart = $parts->users()->get();
                    array_push($arrProv, $userPart);
                }
            }
            foreach ($arrProv as $item) {
                if (isset($item->first()['id'])) {
                    if ($item->first()['id'] != $current_user) {
                        array_push($arrProv1, $item->first()['id']);
                    }
                }
            }
            $users = array_unique(array_merge($users, $arrProv1));
        }

        //записываем новый набор юзеров в AccessUser
        foreach ($users as $user) {
            AccessUser::create([
                'user_id' => $user,
                'document_id' => $docEdit['id'],
                'status' => 0
            ]);
        }
        //Ответ
        return response()->json('success','Заявка успешно изменена!');
    }

    /** Обновление статуса входящей заявки */
    public function updateStatusDocument(Request $request){
        $current_user=PersonalAccessToken::where('token', $request->post('token'))->first()->tokenable->id;
        $doc=AccessUser::where('document_id',$request->post('doc_id'))->where('user_id',$current_user)->first();
        $doc->status=$request->post('status');
        $doc->save();

        $accAll=AccessUser::where('document_id',$request->post('doc_id'))->get();
        $bool=true;
        foreach($accAll as $user){
            if($user->status!=3){
                $bool=false;
                break;
            }
        }

        $docTitle=Document::find($request->post('doc_id'))->title;
        if($bool){
            EmailSender::sendEmail($docTitle, 'cursovoyusertest@gmail.com');
        }

        return response()->json(['reg'=>$request->post('doc_id')]);
    }

    /** Удаление заявки */
    public function deleteDocument(Request $request){
        Document::find($request->post('id'))->delete();
        return response('da');
    }


}
