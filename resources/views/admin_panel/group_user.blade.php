@extends('layouts.main_admin')

@section('title',"Административная панель. Группы")

@section('content')
<div class="container mb-3">
    <group-view-admin :groupInfo='@json($groups)' :token='@json($token)'></group-view-admin>
</div>
@endsection
