@extends('layouts.main')

@section('title',"Изменение заявки")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">
<!--:users='json($users)'-->
    <div class="container">
        <change-appl :doc='@json($doc)' :fileName='@json($fileName)' :users='@json($users)'  :path='@json($file)'></change-appl>
    </div>
    
@endsection