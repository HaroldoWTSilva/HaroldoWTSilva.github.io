---
pagination:
  collection: posts
  perPage: 6
---

@extends('_layouts.default')

@section('content')
<section>
	<h1>Postagens</h1>
	<p>	
	Página {{ $pagination->currentPage }} de {{ $pagination->totalPages }}
	</p>
	<nav>
		@if ($previous = $pagination->previous)
		    <a href="{{ $pagination->first }}">Primeira</a>
		    <a href="{{ $previous }}">Anterior</a>
		@else
		    <a role="button" disabled>Primeira</a>
		@endif

		@if ($next = $pagination->next)
		    <a href="{{ $next }}">Próxima</a>
		    <a href="{{ $pagination->last }}">Última</a>
		@else
		    <a role="button" disabled>Última</a>
		@endif
	</nav>
	<article>
		@foreach ($pagination->items as $post)
			<article>
				<time>{{ date('d/m/Y', $post->date) }}</time> 
				<a href="{{ $post->getUrl() }}">
					{{ $post->title }}
				</a>
			</article>
		@endforeach
	</article>
</section>
@endsection

