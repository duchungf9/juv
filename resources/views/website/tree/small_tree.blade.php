


        <li>{{ $child_page->title }} </li>
        @if ($pages->where('parent_id', $child_page->id))
            <ul>
                @foreach ($pages->where('parent_id', $child_page->id) as $child)
                    @include('website/tree/small_tree', ['child_page' => $child])
                @endforeach
            </ul>
        @endif
