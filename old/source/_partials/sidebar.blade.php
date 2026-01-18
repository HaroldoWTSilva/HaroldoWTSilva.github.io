<nav>
  <h3>Postagens recentes</h3>
  <ul>
    @foreach($posts->take(6) as $post)
    <li>
      <small>{{ date('d/m/Y' ,$post->date) }}</small>
      <a href="{{$post->getUrl()}}">
          {{$post->title}}
      </a>
    </li>
    @endforeach
  </ul>
</nav>

<section class="sobre">
  <h3>Sobre</h3>  
  <a href="https://github.com/HaroldoWTSilva" target="_blank" rel="noopener noreferrer" class="avatar">
    <img 
      src="https://github.com/HaroldoWTSilva.png" 
      alt="Foto de perfil do Haroldo"
      class="transition-all"
    >
  </a>
  <p>{{ $page->description}}</p>
</section>

