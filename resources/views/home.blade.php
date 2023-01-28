@extends('layouts.main')

@section('title',"Главная")

@section('content')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

<div class="container">
    
    <?echo $calendar->getMonth(date('n'), date('Y'),$events);?>
</div>
@endsection