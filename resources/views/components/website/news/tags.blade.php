<aside class="mt-5 md:mt-0">
<h5 class="text-color-6 border-t pt-4 mb-3">Tags</h5>
    <ul class="tags list-inline">
        @foreach ( $tags() as $item )
            <li class="list-inline-item tags-item">
                <a href="tags/{{ $item->slug }}" target="_new" class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded tags-badge bg-color-4">
                    {{ $item->title }} ({{$item->news_count}})
                </a>
            </li>
        @endforeach
    </ul>
</aside>