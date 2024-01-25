@extends('templates.index')

@section('title')
    Users - Profile
@stop

@section('content')
<div class="container mx-auto pb-12">
          <div class="flex flex-wrap justify-center">
            <div class="w-full">
              <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4 text-center creepster">
                  Mon Profil
                </h2>
                <form class="space-y-6">
                  <div>
                    <label for="username" class="block mb-1"
                      >Nom d'utilisateur</label
                    >
                    <input
                      type="text"
                      id="username"
                      name="username"
                      class="w-full border rounded px-3 py-2 text-gray-700"
                      value="{{$utilisateur->name}}"
                    />
                  </div>
                  <div>
                    <label for="email" class="block mb-1">Email</label>
                    <input
                      type="email"
                      id="email"
                      name="email"
                      class="w-full border rounded px-3 py-2 text-gray-700"
                      value="{{$utilisateur->email}}"
                    />
                  </div>
                  <div>
                    <label for="new-password" class="block mb-1"
                      >Nouveau mot de passe</label
                    >
                    <input
                      type="password"
                      id="new-password"
                      name="new-password"
                      class="w-full border rounded px-3 py-2 text-gray-700"
                    />
                  </div>
                  <div>
                    <label for="confirm-password" class="block mb-1"
                      >Confirmer le nouveau mot de passe</label
                    >
                    <input
                      type="password"
                      id="confirm-password"
                      name="confirm-password"
                      class="w-full border rounded px-3 py-2 text-gray-700"
                    />
                  </div>
                  <div class="flex justify-between items-center">
                    <button
                      type="submit"
                      class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    >
                      Mettre à jour
                    </button>
                    
                    <a href="/" class="text-Blue-400 hover:text-red-500"
                      >Acceuil</a
                    >
                    <a href="#" class="text-red-400 hover:text-red-500"
                      >Supprimer le compte</a
                    >
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@stop