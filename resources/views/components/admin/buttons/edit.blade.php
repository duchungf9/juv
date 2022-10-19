{{--<x-admin.buttons.button type='edit' :class="$class??'btn-info'" href="{{ma_get_admin_edit_url($page)}}"/>--}}
@props(['icon','type'=>'edit','page','title'=>'','label'])
<a class="btn {{$class??'btn-info'}}"
   @if($title) title="{{trans($title) }}"
   data-bs-toggle="tooltip"
   data-placement="bottom" rel="tooltip"
   @endif href="{{ma_get_admin_edit_url($page)}}"
   data-role="{{$type}}-item">
        {{icon($icon??$type)}}
        @if (config('fromSky.admin.option.list.show-labels'))
            {!! trans('admin.label.'.$type)!!}
        @endif
        {{ $label ?? '' }}
</a>

