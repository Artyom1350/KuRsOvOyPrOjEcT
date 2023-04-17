@extends('layouts.main')

@section('title',"Заявка")

@section('content')
<link href="{{ asset('css/application.css') }}" rel="stylesheet">
    <div class="container">
        <view-appl :applic='@json($applic)' :token='@json($token)'></view-appl>
    </div>

@endsection
