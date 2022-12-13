@extends('layouts.main')

@section('title',"Главная")

@section('content')
<div class="container">
    <?echo $calendar->getMonth(date('n'), date('Y'));?>
</div>
@endsection