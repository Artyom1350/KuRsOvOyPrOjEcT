@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
        {{-- @foreach($record as $records)
            <div class="application">
                <h3>{{$record->title}}</h3>
                <img src="../image/icons/arrowdown.svg" alt="Развернуть">
            </div>
            @if(isset($record->answers))
                <ul>
                    @foreach($answer as $record->answers)
                        <li>
                            <h4>{{$answer->user->name}}</h4>
                            <a href="{{$answer->user->document}}"></a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach --}}
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
        <div class="application d-flex justify-content-between " onclick="slideAppl(2)">
            <h3>Заголовок</h3>
            <img class=" rounded float-end " src="../image/icons/arrowdown.svg" alt="Развернуть">
        </div>
        <ul class="applicationSlide application2-slide">
            <li>
                <div class="answer d-flex justify-content-between">
                    <h4>Ответ от пользователя</h4>
                    <a href="#"><button class="btn btn-primary">Ссылка на скачивание</button></a>
                    
                </div>
            </li>
            <li>
                <div class="answer d-flex justify-content-between">
                    <h4>Ответ от пользователя</h4>
                    <a href="#"><button class="btn btn-primary">Ссылка на скачивание</button></a>
                    
                </div>
            </li>
        </ul>
        <div class="createApplic d-flex flex-row-reverse ">
            <a href="#"><button class="btn btn-primary">Создание заявки</button></a>
        </div>
    </div>
    
@endsection