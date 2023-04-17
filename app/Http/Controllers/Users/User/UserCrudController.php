<?php

namespace App\Http\Controllers\Users\User;

use App\Http\Controllers\Controller;
use App\Models\AccessUser;
use App\Models\ApiHelper;
use App\Models\Department;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\PersonalAccessToken;

class UserCrudController extends Controller
{

    /** Добавление новой заявки */
    public function addApplication(Request $request)
    {
        if (!ApiHelper::tokenProv($request->post('token'))) {
            return response()->json(['message' => 'Access is denied'], 401);
        }
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
        $doc = Document::create([
            'user_id' => $current_user,
            'file' => $request->post('fileName'),
            'title' => $request->post('nameAppl'),
            'path' => $filePath,
            'dateAppl' => $request->post('dateAppl'),
            'description' => $request->post('descriptionAppl'),
        ]);

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
        }

        //ответ
        return response("Заявка успешно создана");
    }

    /** Редактирование заявки */
    public function changeApplSend(Request $request)
    {
        if (!ApiHelper::tokenProv($request->post('token'))) {
            return response()->json(['message' => 'Access is denied'], 401);
        }
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

        $docEdit->title = $request->post('nameAppl');
        $docEdit->dateAppl = $request->post('dateAppl');
        $docEdit->description = $request->post('descriptionAppl');

        //если есть файл удаляем старый и записываем новый
        if ($request->post('file') != null) {
            $file = $request->file('file');
            Storage::delete($docEdit->path);
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
        return response()->json($request);
    }

    /** Обновление статуса входящей заявки */
    public function updateStatusDocument(Request $request){
        if (!ApiHelper::tokenProv($request->post('token'))) {
            return response()->json(['message' => 'Access is denied'], 401);
        }
        $current_user=PersonalAccessToken::where('token', $request->post('token'))->first()->tokenable->id;
        $doc=AccessUser::where('document_id',$request->post('doc_id'))->where('user_id',$current_user)->first();
        $doc->status=$request->post('status');
        $doc->save();
        return response()->json(['reg'=>$request->post('doc_id')]);
    }

    /** Удаление заявки */
    public function deleteDocument(Request $request){
        if (!ApiHelper::tokenProv($request->post('token'))) {
            return response()->json(['message' => 'Access is denied'], 401);
        }
        Document::find($request->post('id'))->delete();
        return response('da');
    }


}
