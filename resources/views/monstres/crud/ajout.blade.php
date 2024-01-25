@extends('templates.index')

@section('title')
    Créez votre monstre
@stop

@section('content')
<form action="{{ route('ajout.add') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf <!-- Token CSRF pour la sécurité -->

    <div class="mb-4">
        <label for="name" class="block text-white text-sm font-bold mb-2">Nom du Monstre :</label>
        <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="mb-4">
        <label for="description" class="block text-white text-sm font-bold mb-2">Description :</label>
        <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" rows="3" required></textarea>
    </div>

    <div class="mb-4">
    <label for="rarety" class="block text-white text-sm font-bold mb-2">Rareté :</label>
    <select id="rarety" name="rarety" class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        @foreach($rareties as $rarete)
            <option value="{{ $rarete->id }}">{{ $rarete->name }}</option>
        @endforeach
    </select>
    </div>


    <div class="mb-4">
    <label for="type" class="block text-white text-sm font-bold mb-2">Type :</label>
    <select id="type" name="type" class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        @foreach($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endforeach
    </select>
</div>


    <div class="flex mb-4">
        <div class="w-1/3 mr-2">
            <label for="pv" class="block text-white text-sm font-bold mb-2">PV (0-200) :</label>
            <input type="number" id="pv" name="pv" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="0" max="200" required>
        </div>
        <div class="w-1/3 mr-2">
            <label for="attack" class="block text-white text-sm font-bold mb-2">Attaque (0-200) :</label>
            <input type="number" id="attack" name="attack" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="0" max="200" required>
        </div>
        <div class="w-1/3">
            <label for="defense" class="block text-white text-sm font-bold mb-2">Défense (0-200) :</label>
            <input type="number" id="defense" name="defense" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="0" max="200" required>
        </div>
    </div>

    <div class="mb-6">
        <label for="image_url" class="block mb-1">Image du monstre</label>
        <input 
            type="file" 
            id="image_url" 
            name="image_url" 
            class="w-full border rounded px-3 py-2 text-gray-700"
            accept="image/*">
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Ajouter le Monstre</button>
    </div>
</form>

@stop