<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;

class AdminViewController extends Controller
{
    public function  index()
    {
        $name = auth()->user()->name;
        return view('admin_panel/home_admin', ['name' => $name]);
    }
    public function  userPage()
    {
        $data = array();
        $items = User::whereKeyNot(auth()->id())->get()->where('role', 0);
        foreach ($items as $item) {
            array_push($data, ['id' => $item['id'], 'name' => $item['name']]);
        }
        return view('admin_panel/user_admin', ['userInfo' => $data, 'token'=>auth()->user()->tokens->first()->token]);
    }
    public function  groupPage()
    {
        $data = array();
        $items = Department::all();
        foreach ($items as $item) {
            array_push($data, ['id' => $item['id'], 'name' => $item['name']]);
        }
        return view('admin_panel/group_user', ['groups' => $data, 'token'=>auth()->user()->tokens->first()->token]);
    }
    public function downloadTemplateUser(){
        return response()->download(storage_path('\app/templates/Шаблон_пользователей.xlsx'), 'Шаблон_пользователей.xlsx');
    }
    public function downloadTemplateDP(){
        return response()->download(storage_path('\app/templates/Шаблон_подразделений_и_должностей.xlsx'), 'Шаблон_подразделений_и_должностей.xlsx');
    }

}
