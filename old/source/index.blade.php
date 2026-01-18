---
featured: 2025-08-22-tutorial-stable-diffusion-cpp
---
@extends('_layouts.default')

@section('content')
    {{-- Post em destaque --}}
    @foreach ($posts as $post)
        @if ($post->getFilename() === $page->featured)
            <section class="chamada-destaque">
                <p>Postagem em destaque</p>
                <p>
                    <strong>{{ $post->title }}</strong>
                </p>
                <p>{{ $post->excerpt }}</p>
                <a href="{{ $post->getUrl() }}">
                    <img class="thumb" src="/img/{{ $post->coverimg }}" 
                    alt="{{ $post->title }}" />
                </a>
                <p>
                    <a href="{{ $post->getUrl() }}" >
                        Continue lendo...
                    </a>
                </p>
                
            </section>
        @endif
    @endforeach


    {{-- Post mais recente --}}
    @php
        $ultimo = $posts->sortByDesc('date')->first();
    @endphp
    <article class="postagem">
        @if ($ultimo)
            <strong>Postagem mais recente:</strong>
            <time>{{ date('d/m/Y', $ultimo->date) }}</time>

            <a href="{{ $ultimo->getUrl() }}">
                <h1 >{{ $ultimo->title }}</h1>
            </a>

            @if ($ultimo->coverimg)
                <img src="/img/{{ $ultimo->coverimg }}" 
                alt="{{ $ultimo->title }}" />
            @endif

            {!! $ultimo->getContent() !!}
        @endif
    </article>

    <aside>
        @include('_partials.sidebar')
    </aside>
    
@endsection

