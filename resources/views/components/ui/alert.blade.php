<div {{ $attributes->merge(["class" => "alert"])}} role="alert">
    @if(Str::of($attributes['class'])->contains('dismissible'))
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
    {{$slot}}
</div>
