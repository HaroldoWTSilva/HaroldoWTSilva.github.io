@extends('_layouts.default')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8">
            <article class="postagem">
                <header class="row mb-3">
                    <div class="col">

                        <h2>{{ $page->title }}</h2>

                        @if ($page->date)
                            <time>{{ $page->date->format('d/m/Y') }}</time>
                        @endif

                        @if ($page->coverimg)
                            <img src="/img/{{ $page->coverimg }}" />
                        @endif
                    </div>
                </header>

                @yield('postContent')
            </article>
        </div>

        <div class="col-md-4">
            @include('_partials.sidebar')
        </div>

    </div>
</div>
@endsection
