<section class="py-2 md:py-6">
    <div class="container mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            @foreach ($posts($attributes['tag']) as $post)
                <div class="w-full sm:w-1/2 pr-4 pl-4 lg:w-1/3 pr-4 pl-4 mb-4">
                    <x-website.news.item :post="$post"></x-website.news.item>
                </div>
            @endforeach
        </div>
        {{ $paginate() }}
    </div>
</section>