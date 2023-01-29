@extends('layouts.main_admin')

@section('title',"Административная панель. Пользователи")

@section('content')
<div class="container">
    <h2 class="text-center">Пользователи</h2>
    <user-view-admin :userInfo='@json($userInfo)'></user-view-admin>
</div>
@endsection