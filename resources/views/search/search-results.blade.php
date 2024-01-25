@extends('templates.index')

@section('title')
    Résultats de Recherche
@stop

@section('content')
    @if ($monstres->isEmpty())
        <p>Aucun monstre trouvé pour la recherche : "{{ request('texte') }}".</p>
    @else
        @include('monstres._index', ['monstres' => $monstres])
    @endif
@stop