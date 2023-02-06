@extends('layouts.main_admin')


@section('title',"Административная панель")

@section('content')
<?php
   // dd(auth()->user()->createP);
?>
    <div class="container">
        <h1>С возвращением, <?php echo $name?>!</h1>
        <h2>Добро пожаловать на административную панель!</h2>
        <h3>Для CRUD операций перейдите во вкладки "Пользователи" или "Группы"</h3>
    </div>
@endsection