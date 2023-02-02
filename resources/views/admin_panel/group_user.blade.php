@extends('layouts.main_admin')

@section('title',"Административная панель. Группы")

@section('content')
<div class="container">
    <group-view-admin :groupInfo='@json($groups)'></group-view-admin>
</div>
@endsection