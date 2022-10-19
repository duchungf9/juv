<section class="py-2 md:py-6">
    <div class="container mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            @foreach ($categories_sorted() as $category)
                <div class="w-full sm:w-1/2 pr-4 pl-4 lg:w-1/3 pr-4 pl-4 mb-2">
                    <x-website.categories.item :category="$category"></x-website.categories.item>
                </div>
            @endforeach
        </div>
    </div>
</section>