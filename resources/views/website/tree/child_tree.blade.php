@php $level++ @endphp
<li>{{ $child_category->title }}</li>
@if ($child_category->pages)
    <ul>
        @foreach ($child_category->pages as $childCategory)
            @include('website/tree/child_tree', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif
