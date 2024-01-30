<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($monstres as $monstre)
        <article class="relative bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 monster-card" data-monster-type="{{ strtolower($monstre->types->name) }}">
            <img class="w-full h-48 object-cover rounded-t-lg" src="/images/{{ $monstre->image_url }}" alt="{{ $monstre->name }}" />
            <div class="p-4">
                <h3 class="text-xl font-bold">{{ $monstre->name }}</h3>
                <h4 class="mb-2">
                    <a href="#" class="text-red-400 hover:underline">{{ $monstre->user->name }}</a>
                </h4>
                <p class="text-gray-300 text-sm mb-2">
                    {{ $monstre->description }}
                </p>
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <span class="text-yellow-400">★★★★☆</span>
                        <span class="text-gray-300 text-sm">(4.0/5.0)</span>
                    </div>
                    <span class="text-sm text-gray-300">Type: {{ $monstre->types->name }}</span>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm text-gray-300">PV: {{ $monstre->pv }}</span>
                    <span class="text-sm text-gray-300">Attaque: {{ $monstre->attack }}</span>
                </div>
                <div class="text-center">
                    <a href="{{ route('monstres.show', ['id' => $monstre->id, 'slug' => \Illuminate\Support\Str::slug($monstre->name, '-')]) }}" class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300">Plus de détails</a>
                </div>
            </div>
            <div class="absolute top-4 right-4">
                @php
                    $isFavorited = auth()->user() && auth()->user()->favoriteMonsters->contains($monstre->id);
                @endphp
                <button class="toggle-favorite-btn text-white {{ $isFavorited ? 'bg-yellow-500' : 'bg-red-500' }} hover:bg-red-700 rounded-full p-2 transition-colors duration-300" style="width: 40px; height: 40px;" data-monster-id="{{ $monstre->id }}">
                    <i class="fa fa-bookmark"></i>
                </button>
            </div>
        </article>
    @endforeach
</div>

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

