<div class="pt-[20px] lg:block lg:mb-5">
    <div class="container flex items-center justify-center mx-auto">
        <a class="block" href="{{$banner->link}}"><img class="object-cover w-full h-full"  src="{{ImgHelper::get_cached($banner->image, ['w' => 970, 'h' =>250, 'c' => 'cover', 'q' => 80]) }}" alt="{{$banner->image}}"></a>
    </div>
</div>
