 <button @click="open = !open" class="text-white md:hidden">
          <i class="fa fa-bars"></i>
        </button>

        <div class="hidden md:flex items-center">
          <a
            class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700"
            href="{{ route('monstres.index') }}"
            >Monstres</a
          >
          <a
            class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700"
            href="{{ route('users.index') }}"
            >Créateurs</a
          >
          @guest
          <a
            class="text-gray-300 hover:text-white px-3 py-2 hover:bg-gray-700"
            href="{{ route('login') }}"
            >Se connecter</a
          >
          @endguest

          @auth
          <!-- Utilisation d'un bouton pour ouvrir le menu déroulant de l'utilisateur -->
          <div class="relative" x-data="{ userMenuOpen: false }">
            <button @click="userMenuOpen = !userMenuOpen" class="text-white">
              <img src="{{asset('/images/user.webp')}}" alt="" class="w-16" />
            </button>

            <div
              x-show="userMenuOpen"
              @click.away="userMenuOpen = false"
              class="absolute right-0 mt-2 w-48 bg-gray-100 rounded-md shadow-lg pb-1 z-50"
            >
              <div class="text-gray-200 px-4 py-2 bg-gray-400 text-center">
                Username
              </div>
              <a
                href="{{ route('users.profile') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                >Mon Profil</a
              >
              <a
                href="{{ route('users.deck') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                >Mon Deck</a
              >
              <a
                href="{{ route('liste.perso') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                >Mes monstres</a
              >
              <a
                href="{{ route('monstres.ajout') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                >Ajouter un Monstre</a
              >
              <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
              </form>
            </div>
          </div>
          @endauth
        </div>
      </nav>

      <!-- Menu pour mobile -->
      <div x-show="open" class="md:hidden p-8">
        <a
          class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
          href="#"
          >Monstres</a
        >
        <a
          class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
          href="#"
          >Créateurs</a
        >
        <a
          class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
          href="#"
          >Se connecter</a
        >
        <a
          class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
          href="#"
          >Mon Profil</a
        >
        <a
          class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
          href="#"
          >Mon Deck</a
        >
        <a
          class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
          href="#"
          >Ajouter un Monstre</a
        >
        <a
          class="block bg-gray-900 text-white px-4 py-2 hover:bg-gray-700"
          href="#"
          >Se Déconnecter</a
        >
      </div>