@extends('layouts.main')

@section('title',"Заявка")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">
    <div class="container">
        <view-appl :applic='@json($applic)'></view-appl>
    </div>
    
@endsection