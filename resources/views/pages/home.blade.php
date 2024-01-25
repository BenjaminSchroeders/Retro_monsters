@extends('templates.index')

@section('title')
    Monsters
@stop

@section('content')
  @include('monstres._random', [
    'monstres' => \App\Models\Monster::inRandomOrder()->limit(1)->get(),
])
@include('monstres._index', [
    'monstres' => \App\Models\Monster::orderBy('created_at', 'DESC')->limit(3)->get(),
])
@auth
    @php
          $followedUsers = auth()->user()->following()->pluck('following_id');
          $monsters = \App\Models\Monster::whereIn('user_id', $followedUsers)->orderBy('created_at', 'DESC')->limit(3)->get();
        @endphp
        @include('monstres._index', [
          'monstres' => $monsters
        ])
@endauth
@stop