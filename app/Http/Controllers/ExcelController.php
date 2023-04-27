<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\GroupsAndPosts;
use App\Imports\GroupsAndPostsImport;
use App\Imports\GroupsAndPostsImportHelper;
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
        $import->import($request->file('file'));
        
        return response()->json($import->errors());
    }
    public function importGroupsAndPosts(Request $request){
        
        Excel::import(new GroupsAndPostsImport,$request->file('file'));
        Excel::import(new GroupsAndPostsImportHelper,$request->file('file'));
        return response('da');
    }
}
