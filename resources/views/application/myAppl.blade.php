@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
        <h2 class="text-center">Исходящие заявки</h2>
        
        <my-applic :mydata='@json($myApplData)'></my-applic>

    </div>
    
@endsection