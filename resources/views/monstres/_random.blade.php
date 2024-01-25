        <!-- Section Monstre Aléatoire -->
        <section class="mb-20">
        @foreach ($monstres as $monstre )

          <div
            class="bg-gray-700 rounded-lg shadow-lg monster-card"
            data-monster-type="{{strtolower($monstre->types->name)}}"
          >
            <div class="md:flex">
              <!-- Image du monstre -->
              <div class="w-full md:w-1/2 relative">
                <img
                  class="w-full h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none"
                  src="images/{{ $monstre->image_url }}"
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
                  {{$monstre->name}}
                </h2>
                <p class="text-gray-300 text-sm mb-4">
                  {{ $monstre->description }}
                  
                </p>
                <div class="mb-4">
                  <strong class="text-white">Créateur:</strong>
                  <span class="text-red-400">{{$monstre->user->name}}</span>
                </div>
                <div class="mb-4">
                  <div>
                    <strong class="text-white">Type:</strong>
                    <span class="text-gray-300">{{$monstre->types->name}}</span>
                  </div>
                  <div>
                    <strong class="text-white">PV:</strong>
                    <span class="text-gray-300">{{$monstre->pv}}</span>
                  </div>
                  <div>
                    <strong class="text-white">Attaque:</strong>
                    <span class="text-gray-300">{{$monstre->attack}}</span>
                  </div>
                  <div>
                    <strong class="text-white">Défense:</strong>
                    <span class="text-gray-300">{{$monstre->defense}}</span>
                  </div>
                </div>
                <div class="mb-4">
                  <span class="text-yellow-400">★★★★☆</span>
                  <span class="text-gray-300 text-sm">(4.0/5.0)</span>
                </div>
                <div class="">
                  <a
                    href="{{ route('monstres.show', [
                'id' => $monstre->id,
                'slug' => \Illuminate\Support\Str::slug($monstre->name, '-'),
            ]) }}"
                    class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
                    >Plus de détails</a
                  >
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </section>
