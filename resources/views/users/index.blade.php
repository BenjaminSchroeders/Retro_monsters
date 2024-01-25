@extends('templates.index')

@section('title')
    Monsters
@stop

@section('content')
@include('users._index', [
    'utilisateurs' => \App\Models\User::orderBy('created_at', 'ASC')->get(),
])
@stop