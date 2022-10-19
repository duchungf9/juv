@foreach ($products() as $product)
    <div class="w-full sm:w-1/2 pr-4 pl-4 lg:w-1/3 pr-4 pl-4">
        <x-website.products.item :product="$product"></x-website.products.item>
    </div>
@endforeach