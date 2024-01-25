@extends('templates.index')

@section('title')
    Monsters
@stop

@section('content')
<section class="w-full">
            <section class="mb-20">
              <div
                class="bg-gray-700 rounded-lg shadow-lg monster-card"
                data-monster-type="{{strtolower($monstre->types->name)}}"
              >
                <div class="md:flex">
                  <!-- Image du monstre -->
                  <div class="w-full md:w-1/2 relative">
                    <img
                      class="w-full h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none"
                      src="/images/{{ $monstre->image_url }}"
                      alt="Nom du Monstre"
                    />
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
                  </div>

                  <!-- Détails du monstre -->
                  <div class="p-6 md:w-1/2">
                    <h2 class="text-3xl font-bold mb-2 creepster">
                      {{ $monstre->name }}
                    </h2>
                    <p class="text-gray-300 text-sm mb-4">
                      {{ $monstre->description }}
                    </p>
                    <div class="mb-4">
                      <strong class="text-white">Créateur:</strong>
                      <span class="text-red-400">{{ $monstre->user->name }}</span>
                    </div>
                    <div class="mb-4">
                      <div>
                        <strong class="text-white">Type:</strong>
                        <span class="text-gray-300">{{ $monstre->types->name }}</span>
                      </div>
                      <div>
                        <strong class="text-white">PV:</strong>
                        <span class="text-gray-300">{{ $monstre->pv }}</span>
                      </div>
                      <div>
                        <strong class="text-white">Attaque:</strong>
                        <span class="text-gray-300">{{ $monstre->attack }}</span>
                      </div>
                      <div>
                        <strong class="text-white">Défense:</strong>
                        <span class="text-gray-300">{{ $monstre->defense }}</span>
                      </div>
                    </div>
                    <div class="mb-4">
                      <span class="text-yellow-400">★★★★☆</span>
                      <span class="text-gray-300 text-sm">(4.0/5.0)</span>
                    </div>
                    <div class="">
                      <a
                        href="monster.html"
                        class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
                        >Ajouter à mon deck</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Section d'évaluation -->
            <div class="mt-6">
              <h3 class="text-2xl font-bold mb-4">Évaluez ce Monstre</h3>
              <div id="rating-section" class="flex items-center">
                <span class="rating-star" data-value="1">&#9733;</span>
                <span class="rating-star" data-value="2">&#9733;</span>
                <span class="rating-star" data-value="3">&#9733;</span>
                <span class="rating-star" data-value="4">&#9733;</span>
                <span class="rating-star" data-value="5">&#9733;</span>
              </div>
            </div>
            <script>
              document.querySelectorAll(".rating-star").forEach((star) => {
                star.onclick = function () {
                  let rating = this.getAttribute("data-value");
                  document
                    .querySelectorAll(".rating-star")
                    .forEach((innerStar) => {
                      if (innerStar.getAttribute("data-value") <= rating) {
                        innerStar.classList.add("selected");
                      } else {
                        innerStar.classList.remove("selected");
                      }
                    });
                  // Envoyer la valeur 'rating' au serveur ou la traiter comme nécessaire
                };
              });
            </script>

          <div class="mt-6">
        <h3 class="text-2xl font-bold mb-4">Commentaires</h3>
        <div id="commentaires-section">
            @forelse ($monstre->comments as $commentaire)
                <div class="mb-4 bg-gray-800 rounded p-4">
                    <p class="font-bold text-red-400">{{ $commentaire->user->name }}</p>
                    <p class="text-sm text-gray-400">{{ $commentaire->created_at->format('d/m/Y') }}</p>
                    <p class="text-gray-300 mt-2">
                        {{ $commentaire->content }}
                    </p>
                </div>
            @empty
                <p class="text-gray-300">Aucun commentaire pour ce monstre pour le moment.</p>
            @endforelse
        </div>
    </div>
              <!-- Formulaire de commentaire -->
              <div class="bg-gray-800 rounded p-4">
                <h4 class="font-bold text-lg text-red-500 mb-2">
                  Laissez un commentaire
                </h4>
                <textarea
                  class="w-full p-2 bg-gray-900 rounded text-gray-300"
                  rows="4"
                  placeholder="Votre commentaire..."
                ></textarea>
                <button
                  class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full w-full"
                >
                  Envoyer
                </button>
              </div>
            </div>
          </section>
@stop