@if($doc)
    <a target="_new" {{ $attributes->merge(['class' => 'download '])}}
       href="{{ma_get_doc_from_repository($doc)}}" alt="{{$doc}}">
       <i class="fa fa-download" aria-hidden="true"></i>{!! trans("website.download") !!}
    </a>
@endif