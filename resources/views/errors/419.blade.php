
@if(auth()->user()->roll==1)
    @extends('layouts.main_admin')
@else
    @extends('layouts.main')
@endif

@section('title',"Страница не найдена.")

@section('content')

<div class="container text-center d-flex justify-content-center align-items-center">
    <div class="wrap m-auto h-auto">
        <h2>419</h2>
        <p>Доступ к данной странице ограничен.</p>
        @if(auth()->user()->roll==1)
            <p><small>Перейдите на <a href="{{ route('home_admin') }}">главную страницу.</a> </small></p>
        @else
            <p><small>Перейдите на <a href="{{ route('home') }}">главную страницу.</a> </small></p>
        @endif
    </div>
</div>
@endsection