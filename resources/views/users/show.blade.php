@extends('templates.index')

@section('title')
    Monsters
@stop

@section('content')
<section class="mb-20">
    <div class="max-w-4xl mx-auto bg-gray-700 rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold mb-6 text-center creepster">
            Détails de l'utilisateur
        </h2>
        <div class="mb-8">
            <h3 class="text-xl font-bold mb-2">Nom :</h3>
            <p class="text-gray-300">{{ $utilisateur->name }}</p>
        </div>
        <div class="mb-8">
            <h3 class="text-xl font-bold mb-2">E-mail :</h3>
            <p class="text-gray-300">{{ $utilisateur->email }}</p>
        </div>
        <div>
        @include('monstres._index', [
    'monstres' => \App\Models\User::find($utilisateur->id)->monsters()->orderBy('created_at', 'ASC')->limit(9)->get(),
])

        </div>
        <div class="text-center">
            {{-- <a href="{{ route('utilisateurs.edit', [
                'id' => $utilisateur->id,
            ]) }}" class="inline-block text-white bg-blue-500 hover:bg-blue-700 rounded-full px-6 py-2 transition-colors duration-300 mr-4">Modifier</a> --}}
            <a href="{{ route('users.index') }}" class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-6 py-2 transition-colors duration-300">Retour à la liste</a>
        </div>
    </div>
</section>

@stop