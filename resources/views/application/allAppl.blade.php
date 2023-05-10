@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
    @if($myApplData)
        <h2 class="text-center mb-3">Исходящие заявки</h2>
        <my-applic :mydata='@json($myApplData)' :token='@json($token)'></my-applic>
    @else
        <h2 class="text-center mb-4">Исходящих заявок не найдено</h2>
    @endif
    @if($incAplData)
        <h2 class="mt-3 text-center mb-3">Входящие заявки</h2>
        <inc-applic :incdata='@json($incAplData)' :token='@json($token)'></inc-applic>
    @else
        <h2 class="text-center mb-4">Входящий заявок не найдено</h2>
    @endif

    </div>

@endsection
