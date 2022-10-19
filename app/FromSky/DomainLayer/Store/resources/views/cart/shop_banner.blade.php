@if($show())
    <section {{ $attributes->merge(['class' => 'shipping_disclaimer']) }}>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    {!! $banner->description !!}
                </div>
            </div>
        </div>
    </section>
@endif





