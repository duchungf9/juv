<page class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 box-shadow category__card">
    <img class="w-full rounded rounded-t" src="{{ ImgHelper::get($category->image, config('fromSky.image.defaults')) }}" alt="{{ $category->title }}">
    <div class="flex-auto p-6 bg-color-3">
        <h4 class="mb-3 text-blue-600">{{ $category->title }}</h4>
        <div class="mb-0">{!!   $category->description !!}</div>
        <a href="{{ $category->getPermalink() }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  btn-outline-accent mt-2 stretched-link">
            {{ trans('website.product.see_all') }} {{ icon('fas fa-caret-right') }}
        </a>
    </div>
</page>