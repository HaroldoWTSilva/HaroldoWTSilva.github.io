<nav>
    <ul>
        <li>
            <a href="/">{{ $page->site_title }}</a>
        </li>
    </ul>
    <ul>
        @foreach($page->nav as $item)
        <li>
            <a href="{{ $item->url }}">{{ $item->label }}</a>
        </li>
        @endforeach
    </ul>
</nav>
<blockquote>Citação sábia</blockquote>



