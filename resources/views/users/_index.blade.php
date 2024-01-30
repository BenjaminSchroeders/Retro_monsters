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
                @auth
                    @php
                        $estAbonne = auth()->user()->following->contains($utilisateur->id);
                    @endphp
                    <a href="#" id="abonnement-btn-{{ $utilisateur->id }}" 
                    data-user-id="{{ $utilisateur->id }}" 
                    class="abonnement-btn inline-block text-white {{ $estAbonne ? 'bg-green-500' : 'bg-blue-500' }} hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300">
                        {{ $estAbonne ? 'Abonné' : "S'abonner" }}
                    </a>
                @endauth   
                </div>
            </article>
        @endforeach
    </div>
    <script>
    // Sélectionner tous les boutons d'abonnement
    document.querySelectorAll('.abonnement-btn').forEach(function(btn) {
        // Ajouter un gestionnaire d'événements de clic
        btn.addEventListener('click', function(e) {
            e.preventDefault(); // Empêcher le comportement par défaut du lien

            var userId = this.getAttribute('data-user-id'); // Récupérer l'ID de l'utilisateur
            var btn = this; // Référence au bouton cliqué

            // Créer la requête AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/route-abonnement', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            // Corps de la requête
            var data = 'user_id=' + encodeURIComponent(userId);

            // Gestionnaire pour la réponse
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    // Mettre à jour le bouton selon l'état d'abonnement
                    if (response.estAbonne) {
                        btn.textContent = 'Abonné';
                        btn.classList.replace('bg-blue-500', 'bg-green-500');
                    } else {
                        btn.textContent = "S'abonner";
                        btn.classList.replace('bg-green-500', 'bg-blue-500');
                    }
                } else {
                    console.error('Erreur lors de la requête : ', xhr.responseText);
                }
            };

            // Envoyer la requête
            xhr.send(data);
        });
    });
</script>

</section>
