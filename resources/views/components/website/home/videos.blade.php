{{-- <section class="w-full bg-red-300">
    <template id="data_videos" data-videos='{!! json_encode($videos_collection) !!}'></template>
    <div class="container flex flex-wrap mx-auto" id="videos_container">

    </div>
</section> --}}

<!----------------------VIDEO---------------------->
<section class="w-full bg-[url('../images/bg-video.jpg')] bg-cover bg-no-repeat mt-[40px] lg:mt-[0px] hidden lg:block py-[40px] ">
    <div class="container mx-auto flex-wrap">
        <h2 class="mb-[12px] flex items-center text-[#fff] text-lg leading-[28px]"><i class="w-[32px] h-[32px] bg-[url('../images/icon-video.svg')] mr-[6px]"></i><span class="flex-1">VIDEO CLIP - LIVESTREAM BLOCKCHAIN</span></h2>
        <div class="flex" id="videos_container">
            <div class="flex-initial w-full lg:w-2/3">
                <iframe class="w-full min-h-[254px] lg:h-[540px] object-cover" width="auto" height="auto" src="" frameborder="0"></iframe>
            </div>
            <ul class="flex-initial list-video px-[17px] w-1/3 block list-none bg-[#202124] rounded-[4px] h-[540px] overflow-auto">
                @foreach($video_collections as $video)
                    <li class="flex py-[17px] hover:bg-slate-500 cursor-pointer border-solid border-b-[1px] border-[#393c3f]">
                        <a class="relative w-[40%]"><img class="w-full h-[85px] object-cover lozad" data-src="https://img.youtube.com/vi/{{$video->video}}/0.jpg" alt="" /></a>
                        <div class="w-[60%]">
                            <h4 class="block w-full pl-[6px] text-md leading-[23px] text-[#fff] font-bold mb-[6px]">{{$video->title}}</h4>
                            <div class="text-xs text-[#999] leading-[14px] pl-[6px]">{{$video->alt}}</div>
                        </div>
                    </li>
                @endforeach

                {{--<li class="relative flex py-[17px] hover:bg-slate-500 cursor-pointer border-solid border-t-[1px] border-b-[1px] border-t-[#000] border-b-[#393c3f]">
                    <a class="flex-initial w-48"><img class="w-full h-[85px] object-cover" src="images/thumb8.jpg" alt="" /></a>
                    <div class="flex-auto">
                        <h4 class="block w-full pl-[6px] text-md leading-[23px] text-[#fff] font-bold mb-[6px]">Cơ hội cho nhà đầu tư vào năm 2022 sẽ thay đổi ra sao?</h4>
                        <div class="text-xs text-[#999] leading-[14px] pl-[6px]">730 lượt xem</div>
                    </div>
                </li>
                <li class="relative flex py-[17px] hover:bg-slate-500 cursor-pointer border-solid border-t-[1px] border-b-[1px] border-t-[#000] border-b-[#393c3f]">
                    <a class="flex-initial w-48"><img class="w-full h-[85px] object-cover" src="images/thumb8.jpg" alt="" /></a>
                    <div class="flex-auto">
                        <h4 class="block w-full pl-[6px] text-md leading-[23px] text-[#fff] font-bold mb-[6px]">Cơ hội cho nhà đầu tư vào năm 2022 sẽ thay đổi ra sao?</h4>
                        <div class="text-xs text-[#999] leading-[14px] pl-[6px]">730 lượt xem</div>
                    </div>
                </li>
                <li class="relative flex py-[17px] hover:bg-slate-500 cursor-pointer border-solid border-t-[1px] border-b-[1px] border-t-[#000] border-b-[#393c3f]">
                    <a class="flex-initial w-48"><img class="w-full h-[85px] object-cover" src="images/thumb8.jpg" alt="" /></a>
                    <div class="flex-auto">
                        <h4 class="block w-full pl-[6px] text-md leading-[23px] text-[#fff] font-bold mb-[6px]">Cơ hội cho nhà đầu tư vào năm 2022 sẽ thay đổi ra sao?</h4>
                        <div class="text-xs text-[#999] leading-[14px] pl-[6px]">730 lượt xem</div>
                    </div>
                </li>
                <li class="relative flex py-[17px] hover:bg-slate-500 cursor-pointer border-solid border-t-[1px] border-b-[1px] border-t-[#000] border-b-[#393c3f]">
                    <a class="flex-initial w-48"><img class="w-full h-[85px] object-cover" src="images/thumb8.jpg" alt="" /></a>
                    <div class="flex-auto">
                        <h4 class="block w-full pl-[6px] text-md leading-[23px] text-[#fff] font-bold mb-[6px]">Cơ hội cho nhà đầu tư vào năm 2022 sẽ thay đổi ra sao?</h4>
                        <div class="text-xs text-[#999] leading-[14px] pl-[6px]">730 lượt xem</div>
                    </div>
                </li>
                <li class="relative flex py-[17px] hover:bg-slate-500 cursor-pointer border-solid border-t-[1px] border-b-[1px] border-t-[#000] border-b-[#393c3f]">
                    <a class="flex-initial w-48"><img class="w-full h-[85px] object-cover" src="images/thumb8.jpg" alt="" /></a>
                    <div class="flex-auto">
                        <h4 class="block w-full pl-[6px] text-md leading-[23px] text-[#fff] font-bold mb-[6px]">Cơ hội cho nhà đầu tư vào năm 2022 sẽ thay đổi ra sao?</h4>
                        <div class="text-xs text-[#999] leading-[14px] pl-[6px]">730 lượt xem</div>
                    </div>
                </li>
                <li class="relative flex py-[17px] hover:bg-slate-500 cursor-pointer border-solid border-t-[1px] border-b-[1px] border-t-[#000] border-b-[#393c3f]">
                    <a class="flex-initial w-48"><img class="w-full h-[85px] object-cover" src="images/thumb8.jpg" alt="" /></a>
                    <div class="flex-auto">
                        <h4 class="block w-full pl-[6px] text-md leading-[23px] text-[#fff] font-bold mb-[6px]">Cơ hội cho nhà đầu tư vào năm 2022 sẽ thay đổi ra sao?</h4>
                        <div class="text-xs text-[#999] leading-[14px] pl-[6px]">730 lượt xem</div>
                    </div>
                </li>--}}
            </ul>
        </div>
        <template class="hidden" id="data_videos" data-videos='{!! json_encode($video_collections) !!}'></template>
    </div>
</section>
<!----------------------//VIDEO---------------------->


<!----------------------VIDEO MOBILE---------------------->
{{--<section class="w-full bg-[url('../images/bg-video.jpg')] bg-cover bg-no-repeat mt-[40px] lg:mt-[0px] lg:hidden">--}}
{{--    <div class="px-[35px] py-[40px] mx-auto flex-wrap">--}}
{{--        <h2 class="mb-[12px] flex items-center text-[#fff] text-lg leading-[28px]"><i class="w-[32px] h-[32px] bg-[url('../images/icon-video.svg')] mr-[6px]"></i><span class="flex-1">VIDEO CLIP - LIVESTREAM BLOCKCHAIN</span></h2>--}}
{{--        <div class="flex flex-wrap slider-video">--}}
{{--            <div class="flex-initial w-full h-[50vh] lg:w-2/3">--}}
{{--                <iframe class="w-full h-full min-h-[254px] lg:h-[540px] object-cover" width="auto" height="auto" src="https://www.youtube.com/embed/sH4hzS6dfOo" frameborder="0"></iframe>--}}
{{--            </div>--}}
{{--            <div class="flex-initial w-full lg:w-2/3">--}}
{{--                <iframe class="w-full min-h-[254px] lg:h-[540px] object-cover" width="auto" height="auto" src="https://www.youtube.com/embed/sH4hzS6dfOo" frameborder="0"></iframe>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!----------------------//VIDEO MOBILE---------------------->
