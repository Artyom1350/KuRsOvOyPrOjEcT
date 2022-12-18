@extends('layouts.main')

@section('title',"Главная")

@section('content')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

<div class="container">
    <?echo $user['name']." (Ето имя юзера выведенного)". $user['id']." и его id"; ?>
    <?echo $calendar->getMonth(date('n'), date('Y'));?>
</div>
@endsection