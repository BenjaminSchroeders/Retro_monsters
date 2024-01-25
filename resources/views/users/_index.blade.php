<section class="mb-20">
    <h2 class="text-2xl font-bold mb-4 creepster">
        Utilisateurs 
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($utilisateurs as $utilisateur)
            <article class="relative bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <div class="p-4">
                    <h3 class="text-xl font-bold">{{ $utilisateur->name }}</h3>
                    <p class="text-gray-300 text-sm">{{ $utilisateur->email }}</p>
                </div>
                <div class="p-4 text-center">
                    <a href="{{ route('users.show', [
                        'id' => $utilisateur->id,
                        'slug' => \Illuminate\Support\Str::slug($utilisateur->name, '-'),
                    ]) }}" class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300">Plus de détails</a>
                </div>
            </article>
        @endforeach
    </div>
</section>
