@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
        <div class="application d-flex justify-content-between">
            <h3>Заголовок</h3>
            <a href="#"><button class="btn btn-primary">Дать ответ на заявку</button></a>
        </div>
        <div class="application d-flex justify-content-between">
            <h3>Заголовок</h3>
            <a href="#"><button class="btn btn-primary">Дать ответ на заявку</button></a>
        </div>
        <div class="application d-flex justify-content-between">
            <h3>Заголовок</h3>
            <a href="#"><button class="btn btn-primary">Дать ответ на заявку</button></a>
        </div>
    </div>
    
@endsection