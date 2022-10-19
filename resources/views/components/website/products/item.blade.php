<page class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 box-shadow products__card mb-3">
    <img class="w-full rounded rounded-t" src="{{ ImgHelper::get($product->image, config('fromSky.image.defaults'),'products') }}" alt="{{ $product->title }}">
    <div class="flex-auto p-6 bg-color-3">
        <h4 class="mb-3 text-blue-600"><span class="uppercase">{{ $product->title }}</span> <span class="card-code text-gray-700"> - {{ trans('store.product.sku') }}: {{ $product->code }}</span> </h4>
        @if(StoreFeatures::showPrice())
        <div class="card-price">
            <x-fromsky_store-product-display-price  :product="$product" :type="'card'"/>
        </div>
        @endif
        <a href="{{ $product->getPermalink() }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  btn-outline-accent mt-2 stretched-link">
            {{ trans('website.see') }} {{ icon('fas fa-caret-right') }}
        </a>
    </div>
    <x-website.products.on-sale-badge :product="$product"/>
</page>
