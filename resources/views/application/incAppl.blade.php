@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
        @if ($incAplData)
            <h2 class="text-center mb-3">Входящие заявки</h2>
            <inc-applic :incdata='@json($incAplData)'></inc-applic>
        @else
            <h2 class="text-center">Нет входящих заявок</h2>
        @endif
    </div>
    
@endsection