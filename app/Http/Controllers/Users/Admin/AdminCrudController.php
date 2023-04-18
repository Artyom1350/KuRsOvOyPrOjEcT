<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentPart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminCrudController extends Controller
{
    /** Добавление пользователя */
    public function addUser(Request $request)
    {
        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->password = Hash::make($request->post('password'));
        $user->department_part_id = $request->post('department_part');
        $user->save();
        $user->createToken('user');
        return response()->json($user);
    }
    /** Изменение пользователя */
    public function changeUser(Request $request)
    {
        $user = User::find($request->post('id'));
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        if ($request->post('password') != '') $user->password = Hash::make($request->post('password'));
        $user->department_part_id = $request->post('department_part');
        $user->save();
        return response()->json($user);
    }
    /** Удаление пользователя */
    public function destroyUser(Request $request)
    {
        $user = User::find($request->post('id'));
        $user->tokens()->delete();
        $user->delete();
        return response()->json('da');
    }
    /** Добавление структурного подразделения */
    public function addGroup(Request $request)
    {
        $group = new Department();
        $group->name = $request->post('name');
        $group->save();
        return response()->json($group);
    }

    /** Удаление структурного подразделения */
    public function destroyGroup(Request $request)
    {
        $group = Department::find($request->post('id'));
        $group->delete();
        return response()->json('Запись удалена!');
    }

    /** Изменение структурного подразделения */
    public function changeGroup(Request $request)
    {
        $group = Department::find($request->post('id'));
        $group->name = $request->post('name');
        $group->save();
        return response()->json($group);
    }

    /** Добавление должности */
    public function addPost(Request $request)
    {
        $post = new DepartmentPart();
        $post->name = $request->post('name');
        $post->department_id = $request->post('id');
        $post->save();
        return response()->json($post);
    }

    /** Изменение должности */
    public function changePost(Request $request)
    {
        $post = DepartmentPart::find($request->post('id'));
        $post->name = $request->post('name');
        $post->save();
        return response()->json($post);
    }

    /** Удаление должности */
    public function destroyPost(Request $request)
    {
        $post = DepartmentPart::find($request->post('id'));
        $post->delete();
        return response('Запись удалена!');
    }

}
