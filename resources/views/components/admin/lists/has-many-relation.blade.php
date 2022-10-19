@forelse($data as $item)
    <span class="badge rounded-pill bg-info me-2">
    {{$item}}
</span>
@empty
@endforelse