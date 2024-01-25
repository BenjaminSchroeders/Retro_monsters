<header
      class="bg-gray-900 shadow-lg relative top-8"
      x-data="{ open: false, loggedIn: true, userMenuOpen: false }"
    >

      <nav
        class="container mx-auto px-4 py-4 mb-16 flex justify-between items-center"
      >
        <div class="flex items-center">
          <a href="/">
            <img
              src="/images/Logo_RetroMonsters.png"
              alt="RetroMonsters Logo"
              class="h-32 mr-3 absolute"
              style="top: -28px"
            />
          </a>
          <a href="#" class="text-white font-bold text-xl hidden"
            >RetroMonsters</a
          >
        </div>

       @include('templates.partials._nav')
    </header>