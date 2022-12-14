@props(['icon','type','title'=>'','label'])
<a {{ $attributes->merge(['class' => 'btn']) }}
   @if($title)
      title="{{trans($title) }}"
      data-bs-toggle="tooltip"
      data-placement="bottom" rel="tooltip"
   @endif
   data-role="{{$type}}-item">
   {{icon($icon??$type)}}
   @if (config('fromSky.admin.option.list.show-labels'))
      {!! trans('admin.label.'.$type)!!}
   @endif
   {{ $label ?? '' }}
</a>