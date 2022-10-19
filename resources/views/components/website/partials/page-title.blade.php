@if(isset($subtitle))
    <h2 class="text-accent">{{ $subtitle }}</h2>
@endif
<h1 class="text-blue-600">{{ $slot }}</h1>
