@extends('layouts.main')

@section('title',"Мои заявки")

@section('content')
    <div class="container">
        {{-- @foreach($record as $records)
            <div class="application">
                <h3>{{$record->title}}</h3>
                <img src="../../public/image/icons/arrowdown.svg" alt="Развернуть">
            </div>
            @if(isset($record->answers))
                <ul>
                    @foreach($answer as $record->answers)
                        <li>
                            <h4>{{$answer->user->name}}</h4>
                            <a href="{{$answer->user->document}}"></a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach --}}
        <div class="application">
            
        </div>
    </div>
@endsection