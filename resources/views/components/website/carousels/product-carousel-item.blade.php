<div class="swiper-slide swiper-slide-product">
   <a href="{{$item ->getPermalink()}}">
      <img src="{{ ImgHelper::get_cached($item->image, ['w' => 300, 'h' => 200, 'q' => 70],'products') }}"
           alt="" class="max-w-full h-auto">
      <div class="caption text-center mt-2">
         <h6 class="text-blue-600 caption"><strong>{{$item->title }}</strong></h6>
      </div>
   </a>
</div>

