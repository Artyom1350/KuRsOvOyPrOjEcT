@extends('layouts.main_admin')

@section('title',"Административная панель. Пользователи")

@section('content')

<div class="container">
    <user-view-admin :users='@json($userInfo)'></user-view-admin>
</div>
@endsection