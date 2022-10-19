<div class="border-t-[2px] border-[#202124] bg-[#F1F3F4] rounded-b-[4px]">
    <h2 class="pl-[20px]"><span class="inline-block mt-[-2px] py-[12px] text-lg leading-[28px] font-bold border-t-[4px] border-[#D72E22] tracking-[-0.04em]">{{__('website.good_news')}}</span></h2>
    <ul class="px-[20px]">
        @foreach($news() as $k=>$post)
            <li class="flex items-center py-[10px] border-t-[1px] border-[#DADCE0] border-solid shadow-[0_-1px_0_rgba(255,255,255,1)]">
                <span class="flex items-center justify-center w-[64px] h-[64px] text-[48px] text-red font-medium">{{$k+1}}</span>
                <h3 class="flex-1"><a href="{{$post->getPermalink()}}" class="text-sm leading-[23px]" title="{{$post->title}}">{{$post->title}}</a></h3>
            </li>
        @endforeach
    </ul>
</div>