@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
    @if($myApplData)
        <h2 class="text-center">Исходящие заявки</h2>
        <my-applic :mydata='@json($myApplData)'></my-applic>
    @endif
    @if($incAplData)
        <h2 class="mt-3 text-center">Входящие заявки</h2>
        <inc-applic :incdata='@json($incAplData)'></inc-applic>
    @endif
        
    </div>
    
@endsection