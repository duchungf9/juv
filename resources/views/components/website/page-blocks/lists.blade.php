<section class="py-1">
    <div class="container mx-auto sm:px-4 blocks">
        @foreach($items() as $block)
            <x-website.page-blocks.item :block="$block" type="blocks"/>
        @endforeach
    </div>
</section>

