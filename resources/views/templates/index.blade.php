<!DOCTYPE html>
<html lang="fr">
  @include('templates.partials._head')

  <body class="bg-gray-800 text-white font-sans">
    <!-- Header -->
    @include('templates.partials._header')


    <!-- Main Content -->
    <div class="container mx-auto flex flex-wrap pt-4 pb-12">

      <main class="w-full md:w-3/4 p-4">
        @yield('content')
      </main>

      <!-- Sidebar -->
      <aside class="w-full md:w-1/4 p-4">
      @include('templates.partials._aside')
      </aside>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8">
      @include('templates.partials._footer')
    </footer>
  </body>
</html>
