
@if($hasImageGallery())
   <section {{ $attributes->merge(['class' => '']) }}>
       <div class="container mx-auto sm:px-4">
           <div class="flex flex-wrap ">
           {!! $title ??'' !!}
           <!-- Gallery -->
               @foreach ( $gallery()  as  $index => $item )
                   <div class="lg:w-1/3 pr-4 pl-4 md:w-full pr-4 pl-4 mb-4 ">
                       <div class="thumbnail-item" >
                           <a href="{{ma_get_image_from_repository($item->file_name)}}" class="lightbox">
                           <img src="{{ ImgHelper::init('')->get_cached($item->file_name, ['w' => 600, 'h' => 400, 'q' => 70]) }}"
                                alt="{{$item->alt}}" class="thumbnail-image ">
                           <div class="thumbnail-caption">
                               <h6 class="thumbnail-caption-title text-start">{{$item->title}}</h6>
                           </div>
                           </a>
                       </div>
                   </div>
               @endforeach
           </div>
       </div>
   </section>

@endif