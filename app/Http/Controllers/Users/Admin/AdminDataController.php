<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentPart;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDataController extends Controller
{
    /** Получение одного пользователя на редактирование */
    public function getOneUser(Request $request)
    {
        $item = User::find($request->post('id'));
        $department = DepartmentPart::where('id', $item->department_part_id)->first()->department()->first()->id;
        return response()->json(['user' => $item, 'department' => $department]);
    }
    /** Получение всех структурных подразделений */
    public function getAllDepartments(Request $request)
    {
        $item = Department::all();
        return response()->json(['departments' => $item]);
    }
    /** Получение всех должностей структурного подразделения */
    public function getDepartmentParts(Request $request)
    {
        $item = DepartmentPart::where('department_id', $request->post('id'))->get();
        return response()->json(['departmentParts' => $item]);
    }
    /** Получение должности структурного подразделения */
    public function getPostGroup(Request $request)
    {
        $posts = DepartmentPart::where('department_id', $request->post('id'))->get();
        return response()->json($posts);
    }
    
}
