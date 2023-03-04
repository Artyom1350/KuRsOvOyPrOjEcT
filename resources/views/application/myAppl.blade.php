@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
        @if($myApplData)
        <h2 class="text-center mb-3">Исходящие заявки</h2>
        <a href="{{route('doApplacation') }}" class=" d-block ml-auto makeAppl">
            <input class="btn btn-primary" type="button" value="Создать заявку">
        </a>
        <my-applic :mydata='@json($myApplData)'></my-applic>
        @else
        <h2 class="text-center mb-3">Исходящих заявок пока нет</h2>
        <a href="{{route('doApplacation') }}" class=" d-block ml-auto makeAppl">
            <input class="btn btn-primary" type="button" value="Создать заявку">
        </a>
        @endif
    </div>
    
@endsection