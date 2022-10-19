<div id="counter" class="flex flex-wrap justify-between mt-3 counter">
    @foreach($getItems() as $counter)
        <div class="w-full pl-4 pr-4 counter-item sm:w-1/4">
            <div class="counter-number running" id="counter_{{$counter->id}}"
                 data-count="{{$counter->value}}">0</div>
            <div class="counter-title h5">{{$counter->title}}</div>
        </div>
    @endforeach
</div>


@section('footerjs')
    {{-- <script type="text/javascript">
        var a = 0;
        $(window).scroll(function () {
            var oTop = $('#counter').offset().top - window.innerHeight;
            if (a == 0 && $(window).scrollTop() > oTop) {
                $('.counter-number').each(function () {
                   let  $this = $(this),
                        countTo = $this.attr('data-count');
                    $(this).addClass('running')
                    $({
                        countNum: $this.text()
                    }).animate({
                            countNum: countTo
                        },
                        {
                            duration: 2000,
                            easing: 'swing',
                            step: function () {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function () {
                                $this.text(this.countNum);
                                $this.removeClass('running')
                            }

                        });
                });
                a = 1;
            }
            else if($(window).scrollTop() < oTop-100) {
                $('.counter-number').each(function () {
                    let  $this = $(this)
                    $this.text(0);
                    a=0;
                });
            }
        });
    </script> --}}
@endsection


