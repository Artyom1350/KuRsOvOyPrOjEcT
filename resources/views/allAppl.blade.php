@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
        <div class="application d-flex justify-content-between">
            <h3>Заголовок</h3>
            <a href="#"><button class="btn btn-primary">Дать ответ на заявку</button></a>
        </div>

        <div class="application d-flex justify-content-between " onclick="slideAppl(1)">
            <h3>Заголовок</h3>
            <img class=" rounded float-end " src="../image/icons/arrowdown.svg" alt="Развернуть">
        </div>
        <ul class="applicationSlide application1-slide">
            <li>
                <div class="answer d-flex justify-content-between">
                    <h4>Ответ от пользователя</h4>
                    <a href="#"><button class="btn btn-primary">Ссылка на скачивание</button></a>
                </div>
            </li>
        </ul>

    </div>
    
@endsection