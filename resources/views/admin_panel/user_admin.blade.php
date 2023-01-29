@extends('layouts.main_admin')

@section('title',"Административная панель. Пользователи")

@section('content')
<div class="container">
    <user-view-admin :userInfo='@json($userInfo)'></user-view-admin>
</div>
@endsection