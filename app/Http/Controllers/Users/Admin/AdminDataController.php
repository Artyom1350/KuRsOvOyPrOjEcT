<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiHelper;
use App\Models\Department;
use App\Models\DepartmentPart;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDataController extends Controller
{
    public function getOneUser(Request $request)
    {
        if (!ApiHelper::tokenProv($request->post('token'))) {
            return response()->json(['message' => 'Access is denied'], 401);
        }
        $item = User::find($request->post('id'));
        $department = DepartmentPart::where('id', $item->department_part_id)->first()->department()->first()->id;

        return response()->json(['user' => $item, 'department' => $department]);
    }
    public function getAllDepartments(Request $request)
    {
        if (!ApiHelper::tokenProv($request->post('token'))) {
            return response()->json(['message' => 'Access is denied'], 401);
        }
        $item = Department::all();
        return response()->json(['departments' => $item]);
    }
    public function getDepartmentParts(Request $request)
    {
        if (!ApiHelper::tokenProv($request->post('token'))) {
            return response()->json(['message' => 'Access is denied'], 401);
        }
        $item = DepartmentPart::where('department_id', $request->post('id'))->get();
        return response()->json(['departmentParts' => $item]);
    }
}
