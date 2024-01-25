@extends('templates.index')

@section('title')
    User - Deck
@stop

@section('content')
<div class="container mx-auto pt-4 pb-12">
          <h1 class="text-4xl font-bold creepster text-center mb-8">
            Mon Deck
          </h1>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Monster Item -->
            @foreach ($monstres as $monstre )
            <article
              class="relative bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 monster-card"
              data-monster-type="terrestre"
            >
              <img
                class="w-full h-48 object-cover rounded-t-lg"
                src="/images/{{ $monstre->monster->image_url }}"
                alt="AbyssalRevenant"
              />
              <div class="p-4">
                <h3 class="text-xl font-bold">{{ $monstre->monster->name }}</h3>
                <h4 class="mb-2">
                  <a href="#" class="text-red-400 hover:underline"
                    >Alex Smith</a
                  >
                </h4>
                <p class="text-gray-300 text-sm mb-2">
                  {{ $monstre->monster->description }}
                </p>
                <div class="flex justify-between items-center mb-2">
                  <div>
                    <span class="text-yellow-400">★★★★☆</span>
                    <span class="text-gray-300 text-sm">(4.0/5.0)</span>
                  </div>
                  <span class="text-sm text-gray-300">Type: {{ $monstre->monster->types->name }}</span>
                </div>
                <div class="flex justify-between items-center mb-4">
                  <span class="text-sm text-gray-300">PV: {{ $monstre->monster->pv }}</span>
                  <span class="text-sm text-gray-300">Attaque: {{ $monstre->monster->attack }}</span>
                </div>
                <div class="text-center">
                  <a
                    href="{{ route('monstres.show', [
                'id' => $monstre->monster->id,
                'slug' => \Illuminate\Support\Str::slug($monstre->monster->name, '-'),
            ]) }}"
                    class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
                    >Plus de détails</a
                  >
                </div>
              </div>
              <div class="absolute top-4 right-4">
                <button
                  class="text-white bg-gray-400 hover:bg-red-700 rounded-full p-2 transition-colors duration-300"
                  style="
                    width: 40px;
                    height: 40px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                  "
                >
                  <i class="fa fa-bookmark"></i>
                </button>
              </div>
            </article>
            @endforeach           
          </div>
        </div>
@stop