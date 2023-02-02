<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DBApiController extends Controller
{
    public function getGroupsPeop(){
        
    }
    /*public function getUsers1(Request $request){
        //простая логика получения всех юзеров кроме нашего
        $token=PersonalAccessToken::findToken($request->post('token'));
        $user;
        foreach($token as $item){
            $user=$token->tokenable;
        }
        $users=User::whereKeyNot($user->id)->get()->where('role',0);
        return response()->json(['users'=>$users,'token'=>$request->input('token')]);
    }*/
}
