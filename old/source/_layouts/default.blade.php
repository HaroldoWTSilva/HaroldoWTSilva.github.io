<!doctype html>
<html lang="pt-br">
  @include('_partials.head')  
  <body>
    <header>
      @include('_partials.header')
    </header>
    <main>
      @yield('content')
    </main>
    <footer>
      @include('_partials.footer')
    </footer> 
  </body>
</html>

