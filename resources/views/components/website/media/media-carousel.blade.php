<div {{ $attributes->merge(['class' => 'swiper-container '.$carousel_identifier]) }}>
    <div class="swiper-wrapper">
        <x-website.media.media-carousel-item :image="$item->image" class="swiper-slide-{{$carousel_identifier}}" />
        @foreach (  $gallery()  as  $index => $item )
           <x-website.media.media-carousel-item :image="$item->file_name" class="max-w-full h-auto swiper-slide-{{$carousel_identifier}}" />
       @endforeach
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination {{$carousel_identifier}}-swiper-pagination"></div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev {{$carousel_identifier}}-button-prev"></div>
    <div class="swiper-button-next {{$carousel_identifier}}-button-next"></div>
</div>

<!--Grid column-->
@once
    @push('scripts')
        <script type="text/javascript">
            let {{Str::camel($carousel_identifier)}} = new Swiper('.{{$carousel_identifier}}',{
                // Optional parameters
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                slidesPerGroup: 1,
                // If we need pagination
                pagination: {
                    el: '.{{$carousel_identifier}}-swiper-pagination',
                    clickable: true
                },// Navigation arrows
                navigation: {
                    nextEl: '.{{$carousel_identifier}}-button-next',
                    prevEl: '.{{$carousel_identifier}}-button-next',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                        slidesPerGroup: 1,
                    },
                    768: {
                        slidesPerView: 1,
                        spaceBetween: 40,
                        slidesPerGroup: 1,
                    },
                    1024: {
                        slidesPerView: 1,
                        spaceBetween: 50,
                        slidesPerGroup: 1,
                    },
                },
                // Navigation arrows
            });
        </script>
    @endpush
@endonce