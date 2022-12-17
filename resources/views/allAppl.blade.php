@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">

        <my-applic :data='@json($data)'></my-applic>

        <inc-applic :data='@json($data)'></inc-applic>
        

    </div>
    
@endsection