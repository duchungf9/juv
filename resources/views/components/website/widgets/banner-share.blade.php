<div class="mb-5 border-t-2 border-t-[#202124] shadow-[0_0_6px_rgba(0,0,0,0.2)] bg-white">
    <h2 class="border-gray-300 px-[20px] font-bold uppercase text-lg leading-[28px]"><span class="inline-block py-[14px] line relative">{{$banner->title}}</span></h2>
    <div class="relative block w-full">
        <a class="block w-full h-[300px]" href="{{$banner->link}}" title="{{$banner->title}}"><img class="object-cover w-full h-full" src="{{ImgHelper::get_cached($banner->image, ['w' => 400, 'h' =>250, 'c' => 'cover', 'q' => 80]) }}" alt="{{$banner->title}}" /></a>
        <div class="flex flex-col justify-end absolute px-[20px] py-[40px] w-full h-[100%] top-0 left-0">
            <h3 class="mb-[16px] text-white font-bold text-[24px] leading-[26px]">{!!$banner->description!!}</h3>
            <a href="" title="" class="flex items-center justify-center w-[164px] h-[36px] rounded-[4px] bg-red text-[#fff] font-bold text-sm">{{$banner->btn_title}} <i class="block ml-[7px] w-[19px] h-[8px] bg-[url('../images/icon-ar.svg')]"></i></a>
        </div>
    </div>
</div>

