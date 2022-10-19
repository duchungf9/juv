{{--<page class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 box-shadow">
    <img class="w-full rounded rounded-t" src="{{ImgHelper::get_cached($post->image,config('fromSky.image.thumbnail'))}}" alt="{{ $post->title }}">
    <div class="flex-auto p-6 bg-color-3">
        <small class="text-accent">
            {{ Carbon::parse($post->date)->format('d/m/Y') }}
        </small>
        <h2 class="mb-3 text-blue-600 line-clamp-3">{{ $post->title }}</h2>
        <div class="mb-0">{{ $post->getExcerpt() }}</div>
        <a href="{{ $post->getPermalink() }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-1 px-2 leading-tight text-xs  btn-outline-color-4 mt-2 stretched-link">
            {{ trans('website.read_more') }} {{ icon('fas fa-caret-right') }}
        </a>
    </div>
</page>--}}
<div class="flex lg:px-0 flex-wrap py-[19px] border-b-[1px] border-[#DADCE0]">
    <h3 class="w-full mb-[10px] md:hidden"><a href="{{ $post->getPermalink() }}" class="text-md leading-[23px] font-bold">{{ $post->title }}</a></h3>
    <a href="{{ $post->getPermalink() }}" class="lg:w-[310px] md:w-1/3 w-1/2 pr-[10px] md:pr-[0] lg:h-[200px]"><img src="{{ImgHelper::get_cached($post->image,config('fromSky.image.thumbnail_post_list'))}}" class="object-cover rounded-[4px] w-full h-[120px] lg:h-full" alt="{{ $post->title }}"></a>
    <div class="lg:w-[550px] md:w-2/3 w-1/2 lg:p-[20px] md:pl-[20px]">
        <div class="flex items-center mb-[10px] hidden lg:flex">
            @foreach($post->getTags() as $tag)
                <a class="mr-[10px] px-[6px] py-[3px] bg-[#3474E0] rounded-[2px] text-xs text-sm text-[#fff]" href="{{$tag->getPermalink()}}">{{$tag->title}}</a>
            @endforeach
        </div>
        <h3 class="md:mb-[10px] mb-[6px] hidden md:flex"><a href="{{ $post->getPermalink() }}" class="text-md leading-[23px] font-bold">{{ $post->title }}</a></h3>
        <p class="md:mb-[10px] mb-[6px] text-sm leading-[23px] text-[#202124] tracking-[-0.015em]">{{ $post->getExcerpt() }}</p>
        <time class="text-xs leading-[14px] text-[#999]">{{ Carbon::parse($post->date)->format('d/m/Y') }}</time>
    </div>
</div>