<div class="container mx-auto flex pt-14">
    <div class="w-full flex flex-wrap">
        <div class="flex-initial w-1/4">
            <aside class="border border-stone-600 rounded-[5px] p-3">
                <h2 class="mb-2 uppercase">Mục lục bài viết</h2>
                <ul class="list-none">
                    @foreach($menu->where("level", $menu->min("level"))->values() as $key => $item)
                        <li class="mb-3">
                            <a class="p-2 bg-slate-200 hover:bg-orange-200 block rounded-full relative pl-11" href="#" onclick="findElementByHeading('h{{$item->level}}','{!! $item->title !!}')">
                                <span class="absolute top-1/2 left-1 -translate-y-1/2  flex bg-slate-300 px-3 py-1 rounded-full items-center justify-center">{{$key + 1}}</span>
                                <span>{!! $item->title!!}</span>
                            </a>
                            @foreach($menu->where("parent_id",$item->id)->where("parent_id","!==",null)->values() as $child_key => $child)
                                <ul class="list-none pl-3 pt-3">
                                    <li class="mb-3">
                                        <a class="p-2  hover:bg-orange-200 block rounded-full relative pl-14" href="#" onclick="findElementByHeading('h{{$child->level}}','{!! $child->title !!}')">
                                            <span class="absolute top-1/2 left-1 -translate-y-1/2  flex bg-slate-300 px-3 py-1 rounded-full items-center justify-center">{!! $key + 1 !!}.{!! $child_key + 1 !!}</span>
                                            <span>{!! $child->title !!}</span>
                                        </a>
                                        @foreach($menu->where("parent_id",$child->id)->where("parent_id","!=",null)->values() as $_child_key => $_child)
                                            <ul class="list-none pl-3 pt-3">
                                                <li class="mb-3">
                                                    <a class="p-2  hover:bg-orange-200 block rounded-full relative pl-14" href="#" onclick="findElementByHeading('h{{$_child->level}}','{!! $_child ->title !!}')">
                                                        <span class="absolute top-1/2 left-1 -translate-y-1/2  flex bg-slate-300 px-3 py-1 rounded-full items-center justify-center">{!! $key + 1 !!}.{{$child_key+1}}.{!! $_child_key + 1 !!}</span>
                                                        <span>{!! $_child->title !!}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endforeach
                                    </li>
                                </ul>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>


        <div class="w-3/4">
            <div class="pl-10">
                <div class="mb-7 text-xl">
                    <a href="#">Trang chu</a> <span class="mx-1">|</span>
                    <a href="#">Review coin</a> <span class="mx-1">|</span>
                    <a href="#">Coin moi</a>
                </div>

                <article>
                    <header class="mb-10">
                        <h1 class="text-3xl">Công ty đứng sau ví điện tử TrueMoney vừa trở thành kỳ lân</h1>
                        <div class="">
                            <span class="mr-5">Viet boi: Admin</span>
                            <span class="">Ngay dang:  28/02/2021</span>
                        </div>
                    </header>

                    <section class="">
                        <figure class="text-center" contenteditable="false">
                            <img title="Monsinee-Nakapanant-Co-President-of-Ascend-Money.jpg" src="https://icdn.dantri.com.vn/thumb_w/660/2021/09/29/1632727807photo1monsineenakapanantcopresidentofascendmoney-1632891933853.jpg" alt="Monsinee-Nakapanant-Co-President-of-Ascend-Money.jpg" class="w-full object-cover h-96 mx-auto" />
                            <p class="text-sm">Nhấn để phóng to ảnh</p>
                            <figcaption>
                                <p>Ascend Money, công ty đứng sau ví điện tử TrueMoney vừa huy động được 150 triệu USD (Ảnh: Techinasia).</p>
                            </figcaption>
                        </figure>
                        <p>Ascend Money, công ty đứng sau ví điện tử TrueMoney vừa huy động được 150 triệu USD trong vòng Series C, nâng mức định giá công ty lên 1,5 tỷ USD.</p>
                        <p>Vòng gọi vốn mới của Ascend Money có các nhà đầu tư hiện tại bao gồm&nbsp;Charoen Pokphand Group, Ant Group&nbsp;và nhà đầu tư mới là Bow Wave Capital Management có trụ sở tại Mỹ.</p>
                        <p>Với số vốn mới, Ascend Money dự định sẽ dùng để phát triển ứng dụng ví điện tử TrueMoney Wallet và mở rộng các dịch vụ <a href="https://dantri.com.vn/kinh-doanh/tai-chinh.htm" data-auto-link-id="61327d4efb044100119a145b">tài chính</a> kỹ thuật số như cho vay kỹ thuật số, đầu tư kỹ thuật số, chuyển tiền xuyên biên giới ở khu vực Đông Nam Á.</p>
                        <p>Ascend Money được thành lập vào năm 2013 và có mặt tại 6 quốc gia là Thái Lan, Indonesia, Việt Nam, Myanmar, Campuchia và Philippines. Ứng dụng này đang có 50 triệu người dùng thông qua ứng dụng ví điện tử với hơn 88.000 đại lý.</p>
                        <p>"Kể từ khi dịch <a href="https://dantri.com.vn/suc-khoe/dai-dich-covid-19.htm" data-auto-link-id="5fed3436b00b7a0012bca1d1">Covid-19</a> bùng phát, hình thức thanh toán qua ví điện tử TrueMoney tăng trưởng theo cấp số nhân khi các quốc gia áp dụng các biện pháp giãn cách xã hội và khuyến cáo người dân giao dịch không tiền mặt", ông Tanyapong Thamavaranukupt, đồng chủ tịch của Ascend Money, nói.&nbsp;</p>
                        <p>Tính tới nay, lượng người dùng của TrueMoney ở Thái Lan đạt 20 triệu, tăng 3 triệu so với đầu năm. Trong đó, các giao dịch thanh toán của ví tăng hơn 75%.</p>
                        <p>Theo ông Tanyapong Thamavaranukup, sự tăng trưởng trong thanh toán điện tử cho thấy thói quen chi tiêu của người <a href="https://dantri.com.vn/kinh-doanh/tieu-dung.htm" data-auto-link-id="61327da4fb044100119a145c">tiêu dùng</a> Đông Nam Á thay đổi khi tiến tới&nbsp; nền kinh tế kỹ thuật số và xã hội không dùng tiền mặt.</p>
                        <p><strong>An Chi<br></strong>Theo<em> TechCrunch</em></p>
                    </section>

                </article>

            </div>
        </div>


    </div>
</div>