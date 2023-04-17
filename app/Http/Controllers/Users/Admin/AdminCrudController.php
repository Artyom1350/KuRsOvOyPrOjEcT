<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentPart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AdminCrudController extends Controller
{
    public function addUser(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $user = new User();
            $user->name = $request->post('name');
            $user->email = $request->post('email');
            $user->password = Hash::make($request->post('password'));
            $user->department_part_id = $request->post('department_part');
            $user->save();
            return response()->json($user);
        } else return response('Неа, доступ запрещен!');
    }
    public function changeUser(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $user = User::find($request->post('id'));
            $user->name = $request->post('name');
            $user->email = $request->post('email');
            if ($request->post('password') != '') $user->password = Hash::make($request->post('password'));
            $user->department_part_id = $request->post('department_part');
            $user->save();
            return response()->json($user);
        } else return response('Неа, доступ запрещен!');
    }
    public function destroyUser(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $user = User::find($request->post('id'));
            $user->delete();
            return response()->json('da');
        } else return response('Неа, доступ запрещен!');
    }
    public function getPostGroup(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $posts = DepartmentPart::where('department_id', $request->post('id'))->get();
            return response()->json($posts);
        } else return response('Неа, доступ запрещен!');
    }
    public function addGroup(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $group = new Department();
            $group->name = $request->post('name');
            $group->save();
            return response()->json($group);
        } else return response('Неа, доступ запрещен!');
    }
    public function destroyGroup(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $group = Department::find($request->post('id'));
            $group->delete();
            return response()->json('Запись удалена!');
        } else return response('Неа, доступ запрещен!');
    }
    public function changeGroup(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $group = Department::find($request->post('id'));
            $group->name = $request->post('name');
            $group->save();
            return response()->json($group);
        } else return response('Неа, доступ запрещен!');
    }
    public function addPost(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $post = new DepartmentPart();
            $post->name = $request->post('name');
            $post->department_id = $request->post('id');
            $post->save();
            return response()->json($post);
        } else return response('Неа, доступ запрещен!');
    }
    public function changePost(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $post = DepartmentPart::find($request->post('id'));
            $post->name = $request->post('name');
            $post->save();
            return response()->json($post);
        } else return response('Неа, доступ запрещен!');
    }
    public function destroyPost(Request $request)
    {
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if ($token != null) {
            $post = DepartmentPart::find($request->post('id'));
            $post->delete();
            return response('Запись удалена!');
        } else return response('Неа, доступ запрещен!');
    }

}
