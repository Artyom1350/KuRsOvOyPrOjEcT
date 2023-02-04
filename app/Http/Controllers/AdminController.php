<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\DepartmentPart;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function  index(){
        
        return view('admin_panel/home_admin');
    }
    public function  userPage(){
        $data=array();
        $items=User::whereKeyNot(auth()->id())->get()->where('role',0);
        foreach($items as $item){
            array_push($data,['id' => $item['id'], 'name' => $item['name']]);
        }
        return view('admin_panel/user_admin',['userInfo'=>$data]);
    }
    public function  groupPage(){
        $data=array();
        $items=Department::all();
        foreach($items as $item){
            array_push($data,['id'=>$item['id'],'name'=>$item['name']]);
        }
        return view('admin_panel/group_user',['groups'=>$data]);
    }

    public function getAdminToken(){
        $userToken;
        foreach(auth()->user()->tokens as $item){
            $userToken=$item['token'];
        }
        return response()->json(['token'=>$userToken]);
    }


    //api
    //страница юзеров
    //получение 1 юзера на редактирование
    public function getOneUser(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $item=User::find($request->id);

            $department=DepartmentPart::where('id',$item->department_part_id)->first()->department()->first()->id;
            
            return response()->json(['user'=>$item,'department'=>$department]);
        }
        else return response('Неа, доступ запрещен!');
    }
    //получение всех департаментов
    public function getAllDepartments(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $item=Department::all();
            return response()->json(['departments'=>$item]);
        }
        else return response('Неа, доступ запрещен!');
    }
    //получение должностей по департаменту
    public function getDepartmentParts(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $item=DepartmentPart::where('department_id',$request->post('id'))->get();
            return response()->json(['departmentParts'=>$item]);
        }
        else return response('Неа, доступ запрещен!');
    }
    //добавление нового пользователя
    public function addUser(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $user=new User();
            $user->name=$request->post('name');
            $user->email=$request->post('email');
            $user->password=Hash::make($request->post('password'));
            $user->department_part_id=$request->post('department_part');
            $user->save();
            return response()->json($user);
        }
        else return response('Неа, доступ запрещен!');
    }
    //Изменение пользователя
    public function changeUser(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $user=User::find($request->post('id'));
            $user->name=$request->post('name');
            $user->email=$request->post('email');
            if($request->post('password')!='') $user->password=Hash::make($request->post('password'));
            $user->department_part_id=$request->post('department_part');
            $user->save();
            return response()->json($user);
        }
        else return response('Неа, доступ запрещен!');
    }
    public function destroyUser(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $user=User::find($request->post('id'));
            $user->delete();
            return response()->json('da');
        }
        else return response('Неа, доступ запрещен!');
    }

    //страница групп
    public function getPostGroup(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $posts=DepartmentPart::where('department_id',$request->post('id'))->get();
            return response()->json($posts);
        }
        else return response('Неа, доступ запрещен!');
    }
    public function addGroup(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $group=new Department();
            $group->name=$request->post('name');
            $group->save();
            return response()->json($group);
        }
        else return response('Неа, доступ запрещен!');
    }
    public function destroyGroup(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $group=Department::find($request->post('id'));
            $group->delete();
            return response()->json('Запись удалена!');
        }
        else return response('Неа, доступ запрещен!');
    }
    public function changeGroup(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $group=Department::find($request->post('id'));
            $group->name=$request->post('name');
            $group->save();
            return response()->json($group);
        }
        else return response('Неа, доступ запрещен!');
    }
    public function addPost(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $post=new DepartmentPart();
            $post->name=$request->post('name');
            $post->department_id=$request->post('id');
            $post->save();
            return response()->json($post);
        }
        else return response('Неа, доступ запрещен!');
    }
    public function changePost(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $post=DepartmentPart::find($request->post('id'));
            $post->name=$request->post('name');
            $post->save();
            return response()->json($post);
        }
        else return response('Неа, доступ запрещен!');
    }
    public function destroyPost(Request $request){
        $token = PersonalAccessToken::where('token', $request->post('token'))->first();
        if($token!=null){
            $post=DepartmentPart::find($request->post('id'));
            $post->delete();
            return response('Запись удалена!');
        }
        else return response('Неа, доступ запрещен!');
    }
}
