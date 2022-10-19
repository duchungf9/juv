@if($route || $item->link)
<a {{ $attributes->merge(['class' => 'btn btn-lg text-uppercase']) }}
   href="{{$getLink}}">{{$getLabel}}
</a>
@endif