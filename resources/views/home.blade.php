@extends('layouts.main')

@section('title',"Главная")

@section('content')
<?php
?>
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

<div class="container">
    <h3 class="h3">С возвращением, <?php echo $name?>!</h3>
    <?echo $calendar->getInterval(date('n.Y'), date('n.Y', strtotime('+2 month')),$events);?>
</div>
@endsection