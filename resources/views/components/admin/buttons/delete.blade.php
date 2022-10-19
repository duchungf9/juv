{{--<x-admin.buttons.button
    type='delete'
    icon="trash"
    :class="$class??'btn-danger'"
    href="{{ma_get_admin_delete_url($page)}}"/>--}}

@props(['icon'=>'trash','type'=>'delete','page','title'=>'','label'])
<a class="btn {{$class??'btn-danger'}}"
   @if($title) title="{{trans($title) }}"
   data-bs-toggle="tooltip"
   data-placement="bottom" rel="tooltip"
   @endif href="{{ma_get_admin_delete_url($page)}}"
   data-role="{{$type}}-item">
    {{icon($icon??$type)}}
    @if (config('fromSky.admin.option.list.show-labels'))
        {!! trans('admin.label.'.$type)!!}
    @endif
    {{ $label ?? '' }}
</a>