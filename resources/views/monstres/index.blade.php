@extends('templates.index')

@section('title')
    Monsters
@stop

@section('content')
<section class="mb-20">
    <h2 class="text-2xl font-bold mb-4 creepster">
        Liste des monstres
    </h2>
@include('monstres._index', [
    'monstres' => \App\Models\Monster::orderBy('created_at', 'ASC')->limit(9)->get(),
])
</section>
@stop