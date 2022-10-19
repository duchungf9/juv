<div class="accordion text-start">
    @foreach($items as $item)
        <div class="accordion-item md:flex">
            <div class="w-full md:w-1/2 pr-4 pl-4 h3 accordion-item-title collapsed " data-bs-toggle="collapse" href="#item_{{$item->id}}">
                {{$item->title}}
            </div>
            <div class="hidden w-full md:w-1/2 pr-4 pl-4 accordion-item-description" id="item_{{$item->id}}">
                {!! $item->description!!}
            </div>
        </div>
    @endforeach
</div>
