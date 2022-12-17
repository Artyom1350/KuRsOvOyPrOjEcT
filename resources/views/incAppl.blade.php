@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
        <inc-applic :incdata='@json($incAplData)'></inc-applic>
    </div>
    
@endsection