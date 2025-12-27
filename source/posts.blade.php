---
pagination:
  collection: posts
  perPage: 6
---

@extends('_layouts.default')

@section('content')
<section class="container">

	<div class="row">
	    <div class="col" >
		<h1>Postagens</h1>
		<p>	
		Página {{ $pagination->currentPage }} de {{ $pagination->totalPages }}
		</p>
		<ul class="nav">
			@if ($previous = $pagination->previous)
			    <li class="nav-item"><a class="nav-link" href="{{ $pagination->first }}">Primeira</a></li>
			    <li class="nav-item"><a class="nav-link" href="{{ $previous }}">Anterior</a></li>
			@else
			    <li class="nav-item"><a class="nav-link disabled">Primeira</a></li>
			@endif

			@if ($next = $pagination->next)
			    <li class="nav-item"><a class="nav-link" href="{{ $next }}">Próxima</a></li>
			    <li class="nav-item"><a class="nav-link" href="{{ $pagination->last }}">Última</a></li>
			@else
			    <li class="nav-item"><a class="nav-link disabled">Última</a></li>
			@endif
		</ul>
    @foreach ($pagination->items as $post)
			<p>
			<time> {{ date('d/m/Y', $post->date) }}</time> 
			<a href="{{ $post->getUrl() }}">
				{{ $post->title }}
			</a>
			</p>
    
    @endforeach
		</div>
	</div>
</section>
@endsection

