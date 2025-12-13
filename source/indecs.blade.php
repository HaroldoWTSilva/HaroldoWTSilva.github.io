---
pagination:
  collection: posts
  perPage: 12
---

@extends('_layouts.default')

@section('content')
<section class="container">

    {{-- Post em destaque --}}
    @foreach ($posts as $post)
        @if ($post->slug === $page->featured)
            <div class="row rounded text-body-emphasis bg-body-secondary chamada-destaque">
                <div class="col-lg-6 px-0">
                    <small>Em destaque</small>
                    <h1 class="display-4 fst-italic">{{ $post->title }}</h1>
                    <p class="lead my-3">{{ $post->excerpt }}</p>
                    <p class="lead mb-0">
                        <a href="{{ $post->getUrl() }}" class="text-body-emphasis fw-bold">
                            Continue lendo...
                        </a>
                    </p>
                </div>

                <div class="col-lg-6">
                    <a href="{{ $post->getUrl() }}">
                        <img class="thumb" src="/img/{{ $post->coverimg }}" />
                    </a>
                </div>
            </div>
        @endif
    @endforeach


    {{-- Post mais recente --}}
    @php
        $ultimo = $pagination->items->first();
    @endphp

    <div class="row g-5">
        <div class="col-md-8">
            <article class="postagem">
                @if ($ultimo)
                    <small>Postagem mais recente:</small>
                    <time>{{ $ultimo->date }}</time>

                    <a href="{{ $ultimo->getUrl() }}">
                        <h3 class="pb-4 mb-4 border-bottom">{{ $ultimo->title }}</h3>
                    </a>

                    @if ($ultimo->coverimg)
                        <img src="/img/{{ $ultimo->coverimg }}" />
                    @endif

                    {!! $ultimo->getContent() !!}
                @endif
            </article>
        </div>

        <div class="col-md-4">
            @include('_partials.sidebar')
        </div>
    </div>

</section>
@endsection

