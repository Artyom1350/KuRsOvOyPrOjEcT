<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function  index(){
        
        return view('admin_panel/home_admin');
    }
    public function  userPage(){
        $data[]="";
        return view('admin_panel/user_admin',['userInfo'=>$data]);
    }
    public function  groupPage(){
        $data[]="";
        return view('admin_panel/group_user',['groupInfo'=>$data]);
    }
}
