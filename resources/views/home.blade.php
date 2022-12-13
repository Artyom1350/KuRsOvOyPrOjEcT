@extends('layouts.main')

@section('title',"Главная")

@section('content')
<div class="container">
    <?$text= $calendar->getMonth(date('n'), date('Y'));
    echo $text;?>
</div>
@endsection