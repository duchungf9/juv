@props([
'caption',
'title'
])
<section {{ $attributes->merge(['class' => '']) }}>
    <div class="container mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="w-full text-center">
                @if(isset($caption))
                    <h5 {{ $caption->attributes->merge(['class'=>'']) }}>{{$caption}}</h5>
                @endif
                @if(isset($title))
                    <h1 {{ $title->attributes->class([]) }}>{{$title}}</h1>
                @endif
                {{$slot}}
            </div>
        </div>
    </div>
</section>