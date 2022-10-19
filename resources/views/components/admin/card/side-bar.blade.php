@props(['id'])
<div @if($id!='') id="{{$id}}" @endif {{ $attributes->merge(['class' =>'card'])}}>
    <div class="side-bar-card-title d-flex justify-content-between">
        <h3>{!! $title !!}</h3>
        {!! $action??null !!}
    </div>
    <hr/>
    {{ $slot }}
</div>