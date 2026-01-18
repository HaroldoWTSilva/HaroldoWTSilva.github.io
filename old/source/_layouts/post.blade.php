@extends('_layouts.default')

@section('content')
<article class="postagem">
    <header>
        <h1>{{ $page->title }}</h1>

        @if ($page->date)
            <time>{{ date('d/m/Y', $page->date)}}</time>
        @endif

        @if ($page->coverimg)
            <img src="/img/{{ $page->coverimg }}" alt="{{ $page->title }}" />
        @endif
    </header>

    @yield('postContent')
</article>

<aside>
    @include('_partials.sidebar')
</aside>
@endsection
