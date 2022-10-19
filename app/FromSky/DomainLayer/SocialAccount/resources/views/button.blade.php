<a {{ $attributes->merge(['class' => 'btn btn-social ']) }}  href="{{ $getUrl()}}" class="btn btn-social btn-facebook ">
    {{ $icon??''}} {{$getLabel()}}
</a>