<div class="p-4 mb-3 bg-body-tertiary"> 
<a href="https://github.com/HaroldoWTSilva" target="_blank" rel="noopener noreferrer" class="avatar d-inline-block text-decoration-none">
    <img 
        src="https://github.com/HaroldoWTSilva.png" 
        alt="Foto de perfil do Haroldo"
        width="160"
        height="160"
        class="rounded-circle shadow transition-all"
        style="object-fit: cover; border: 3px solid #f8f9fa;"
    >
</a>
	<h4 class="fst-italic">Sobre</h4> 
	<p class="mb-0">{{ $page->description}}</p>
</div>

<div class="p-4">
<h4>Artigos recentes</h4>
<ul class="list-unstyled">
 @foreach($posts as $post)
	<li class="py-3 border-top " >
		<a class=" text-decoration-none"  href="{{$post->getUrl()}}">
		<div class="col-lg-8"> 
			<h6 class="mb-0"> {{$post->title}} </h6> 
			<small class="text-body-secondary">{{$post->date }}</small> 
		</div>	
		</a>
	</li>
@endforeach
</ul>
</div>
