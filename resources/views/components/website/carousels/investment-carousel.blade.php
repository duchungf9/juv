<div class="{{$classList}}">
    <h2 class="text-lg font-bold uppercase pl-[20px] leading-[28px]"><span class="inline-block pt-[14px] pb-[10px] line relative">QUỸ ĐẦU TƯ</span></h2>
    <div class="slider-investment lg:px-[20px] pb-[20px] mx-[-5px]">
        @foreach ($slides() as $index => $slide)
            <div class="p-[5px]">
                <a class="flex items-center justify-center h-[100px] rounded-[4px] border-solid border-[1px] border-[#F1F3F4]" href="{{$slide->link}}" title="{{$slide->title }}" >
                    <img class="block mx-auto w-full h-full object-cover" src="{{ImgHelper::get_cached($slide->image, ['w' => 118, 'h' => 98, 'c' => 'cover', 'q' => 70]) }}" alt="{{$slide->title}}" >
                </a>
            </div>
        @endforeach
    </div>
</div>
