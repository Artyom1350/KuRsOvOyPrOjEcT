@extends('layouts.main')

@section('title',"Изменение заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">
<!--:users='json($users)'-->
    <div class="container">
        <change-appl :doc='@json($doc)' :users='@json($users)'></change-appl>
    </div>
    
@endsection