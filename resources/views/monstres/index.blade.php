@extends('templates.index')

@section('title')
    Monsters
@stop

@section('content')
@include('monstres._index', [
    'monstres' => \App\Models\Monster::orderBy('created_at', 'ASC')->limit(9)->get(),
])
@stop