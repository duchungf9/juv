@if($video)
<div class="ratio ratio-{{ $ratio }} {{ $extra_class ?? '' }}">
    <iframe src="{{ $url }}" allowfullscreen></iframe>
</div>
@endif