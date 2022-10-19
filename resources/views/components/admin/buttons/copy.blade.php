{{--<x-admin.buttons.button
    type='copy'
    :class="$class??'btn-warning'"
    title="admin.label.copy"
    href="{{ma_get_admin_copy_url($page)}}"/>--}}

@props(['icon','type'=>'copy','page','title'=>'admin.label.copy','label'])
<a class="btn {{$class??'btn-warning'}}"
   @if($title) title="{{trans($title) }}"
   data-bs-toggle="tooltip"
   data-placement="bottom" rel="tooltip"
   @endif href="{{ma_get_admin_copy_url($page)}}"
   data-role="{{$type}}-item">
    {{icon($icon??$type)}}
    @if (config('fromSky.admin.option.list.show-labels'))
        {!! trans('admin.label.'.$type)!!}
    @endif
    {{ $label ?? '' }}
</a>