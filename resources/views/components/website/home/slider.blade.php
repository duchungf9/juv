<header id="carousel">

    <div class="swiper-container header-carousel">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            @foreach ($slides() as $index => $slide)
                <div class="swiper-slide">
                    <img src="{{ ImgHelper::get_cached($slide->image, ['w' => 1920, 'h' => 600, 'c' => 'cover', 'q' => 70]) }}"
                         alt="" class="max-w-full h-auto">
                    <div class="swiper-slide-text">
                        <div class="container mx-auto sm:px-4">
                            <h2 class="text-blue-600">{{ $slide->title }}</h2>
                            <div class="text-xl font-light">{{ $slide->description }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination header-carousel-pagination"></div>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev header-carousel-button-prev"></div>
        <div class="swiper-button-next header-carousel-button-next"></div>

    </div>
</header>

@push('scripts')
    <script type="text/javascript">


        const headerCarousel = new Swiper('.header-carousel', {
            // Optional parameters
            loop: true,

            // If we need pagination
            pagination: {
                el: '.header-carousel-pagination',
                clickable: true
            },

            // Navigation arrows
            navigation: {
                nextEl: '.header-carousel-button-next',
                prevEl: '.header-carousel-button-next',
            },
        });
    </script>
@endpush

