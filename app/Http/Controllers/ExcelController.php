<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\GroupsAndPosts;
use App\Imports\GroupsImport;
use App\Imports\PostsImport;
use App\Imports\UsersImport;
use Excel;

class ExcelController extends Controller
{
    public function getUsers(Request $request){
        return Excel::download(new UsersExport, 'Пользователи.xlsx');
    }

    public function getGroupsAndParts(Request $request){
        return Excel::download(new GroupsAndPosts,'подразделения_и_должности.xlsx');
    }

    public function importUsers(Request $request){ 
        $import=new UsersImport();
        try{
            $import->import($request->file('file'));
        }
        catch(\Exception $e){
            return response()->json(['error','Ошибка в структуре файла!']);
        }
        return response()->json($import->errors());
    }

    public function importGroupsAndPosts(Request $request){
        $import=new GroupsImport();
        $import_1=new PostsImport();
        try{
            $import->import($request->file('file'));
        }
        catch(\Exception $e){
            return response()->json(['error','Ошибка в структуре файла! Структурные подразделения и должности не были импортированы!',$import->errors()]);
        }
        
        try{
            $import_1->import($request->file('file'));
        }
        catch(\Exception $e){
            return response()->json(['error','Ошибка в структуре файла! Должности не были импортированы!',$import->errors(),$import_1->errors()]);
        }
        return response([$import->errors(),$import_1->errors()]);
    }
}
