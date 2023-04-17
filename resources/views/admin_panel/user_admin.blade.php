@extends('layouts.main_admin')

@section('title',"Административная панель. Пользователи")

@section('content')

<div class="container mb-3">
    <user-view-admin :users='@json($userInfo)' :token='@json($token)'></user-view-admin>
</div>
@endsection
