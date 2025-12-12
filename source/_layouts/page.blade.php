@extends('_layouts.default')

@section('content')
<article class="container">
    <header class="row mb-3">
        <div class="col">
            <h2>{{ $page->title }}</h2>
        </div>
    </header>

    <div class="row">
        <div class="col">
            @yield('pageContent')
        </div>
    </div>
</article>
@endsection
