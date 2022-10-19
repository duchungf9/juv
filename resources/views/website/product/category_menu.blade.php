<ul id="filters" class="unstyled list-inline">
    <li><button id="all-isotope" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default btn-full mb5 active " data-filter="*">ALL</button></li>
    @foreach (  $product_category->where('pub',1)->get()  as  $index => $item )
        <li><button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default mb5 " data-filter=".{{$item->slug}}">{{$item->title }}</button></li>
    @endforeach
</ul>