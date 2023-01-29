@extends('layouts.main_admin')

@section('title',"Административная панель. Группы")

@section('content')
<div class="container">
    <h2 class="text-center">Отделения</h2>
    <group-view-admin :groupInfo='@json($groupInfo)'></group-view-admin>
</div>
@endsection