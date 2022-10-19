<section {{ $attributes->merge(['class' => 'p-0']) }} >
    <div class="container mx-auto sm:px-4">
        <div class="w-full">
            {{$slot}}
        </div>
    </div>
</section>