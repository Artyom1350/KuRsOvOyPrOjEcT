<?php

namespace App\Http\Controllers\Users\User;

use App\Http\Controllers\Controller;
use App\Models\AccessUser;
use App\Models\Department;
use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Str;

class UserDataController extends Controller
{
    /** Получение пользователей для добавления/редактирования заявки */
    public function getUsers(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        $user = $token->tokenable;
        $users = User::whereKeyNot($user->id)->get()->where('role', 0);
        return response()->json(['users' => $users]);
    }

    /** Получение всех структурных подразделений для добавления/педактирования заявки */
    public function getDepartment(Request $request)
    {
        $department = Department::all();
        return response()->json(['department' => $department]);
    }

    /** Получение ответов пользователей на исходящую заявку */
    public function getUnswersUsers(Request $request)
    {
        $access = AccessUser::where('document_id', $request->post('id_doc'))->get();
        $appl = array();
        foreach ($access as $acc) {
            $user = $acc->user()->get();
            array_push($appl, ['name' => $user->first()['name'], 'status' => $acc['status']]);
        }
        return response()->json(['users' => $appl]);
    }

    /** Скачивание файла, прикрепленного к заявке */
    public function downloadAppl($id){
        //загрузка документа из хранлища по id из get
        $doc=Document::where('id',$id)->first();
        try{
            return Storage::download($doc->path,$doc->file);
        }
        catch(\Exception $e){
            return response()->json('File not found!');
        }
    }

    /** Скачивание файла, прикрепленного к заявке */
    public function downloadApplTest(Request $request){
        $doc=Document::where('id',$request->post('id'))->first();
        try{

            $headers = [
                'Content-Description' => 'File Transfer',
                'Content-Type' => 'application/pdf',
                'filename'=>substr(Str::slug($doc->file),0,-3),
            ];

            return response()->download(storage_path('app/'.$doc->path),$doc->file, $headers);
        }
        catch(\Exception $e){
            return response()->json('File not found!');
        }
    }
    

}
