@extends('layouts.main')

@section('title',"Заявка")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">

    <div class="container">
        <one-Incl :OneIncl='@json($app)'></one-Incl>
    </div>
    
@endsection