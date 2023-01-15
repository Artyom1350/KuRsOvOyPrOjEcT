@extends('layouts.main')

@section('title',"Создание Заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">
<!--:users='json($users)'-->
    <div class="container">
        <do-applic></do-applic>
    </div>
    
@endsection