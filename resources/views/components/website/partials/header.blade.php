<div class="container mx-auto flex justify-center items-center p-5">
    <a href="{{$banner->link}}" class="block w-[970px] h-[250px] hover:grayscale-5 transition-all"><img class="object-cover w-full h-full" src="{{ImgHelper::get_cached($banner->image, ['w' => 970, 'h' =>250, 'c' => 'cover', 'q' => 80]) }}" alt="{{$banner->image}}"></a>
</div>


