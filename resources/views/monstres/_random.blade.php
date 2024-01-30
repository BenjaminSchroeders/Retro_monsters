<!-- Section Monstre Aléatoire -->
    <section class="mb-20">
        @foreach ($monstres as $monstre)
            @php
                $isFavorited = auth()->user() && auth()->user()->favoriteMonsters->contains($monstre->id);
            @endphp
            <div class="bg-gray-700 rounded-lg shadow-lg monster-card" data-monster-type="{{ strtolower($monstre->types->name) }}">
                <div class="md:flex">
                    <!-- Image du monstre -->
                    <div class="w-full md:w-1/2 relative">
                        <img class="w-full h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none" src="/images/{{ $monstre->image_url }}" alt="{{ $monstre->name }}" />
                        <div class="absolute top-4 right-4">
                            <button class="toggle-favorite-btn text-white {{ $isFavorited ? 'bg-yellow-500' : 'bg-red-500' }} hover:bg-red-700 rounded-full p-2 transition-colors duration-300" style="width: 40px; height: 40px; display: flex; justify-content: center; align-items: center;" data-monster-id="{{ $monstre->id }}">
                                <i class="fa fa-bookmark"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Détails du monstre -->
                    <div class="p-6 md:w-1/2">
                        <h2 class="text-3xl font-bold mb-2 creepster">{{ $monstre->name }}</h2>
                        <p class="text-gray-300 text-sm mb-4">{{ $monstre->description }}</p>
                        <div class="mb-4">
                            <strong class="text-white">Créateur:</strong>
                            <span class="text-red-400">{{ $monstre->user->name }}</span>
                        </div>
                        <div class="mb-4">
                            <div><strong class="text-white">Type:</strong><span class="text-gray-300">{{ $monstre->types->name }}</span></div>
                            <div><strong class="text-white">PV:</strong><span class="text-gray-300">{{ $monstre->pv }}</span></div>
                            <div><strong class="text-white">Attaque:</strong><span class="text-gray-300">{{ $monstre->attack }}</span></div>
                            <div><strong class="text-white">Défense:</strong><span class="text-gray-300">{{ $monstre->defense }}</span></div>
                        </div>
                        <div class="mb-4">
                            <span class="text-yellow-400">★★★★☆</span>
                            <span class="text-gray-300 text-sm">(4.0/5.0)</span>
                        </div>
                        <div class="">
                            <a href="{{ route('monstres.show', ['id' => $monstre->id, 'slug' => \Illuminate\Support\Str::slug($monstre->name, '-')]) }}" class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300">Plus de détails</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <script>
        document.querySelectorAll('.toggle-favorite-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var monsterId = this.getAttribute('data-monster-id');
                var btn = this;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/toggle-favorite-monster', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                var data = 'monster_id=' + encodeURIComponent(monsterId);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.isFavorited) {
                            btn.classList.replace('bg-red-500', 'bg-yellow-500');
                        } else {
                            btn.classList.replace('bg-yellow-500', 'bg-red-500');
                        }
                    } else {
                        console.error('Erreur lors de la requête : ', xhr.responseText);
                    }
                };

                xhr.send(data);
            });
        });
    </script>