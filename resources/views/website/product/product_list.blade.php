@foreach ($categories as $_category)
	<div class="flex flex-wrap ">
		<div class="w-full">
			<h3>{{$_category->title }}</h3>
			{!!$_category->description!!}
		</div>
	    @foreach ($_category->products()->sorted()->get() as $_item)
			<div class="w-full md:w-1/3 pr-4 pl-4 lg:w-1/4 pr-4 pl-4 mb25">
				<div class="flex flex-wrap ">
					<div class="w-1/3 md:w-full pr-4 pl-4 mb10">
						<a href="{{$_item->getPermalink()}}">
							<img data-src="{!! ImgHelper::get($_item->image, config('fromSky.image.thumbnail')) !!}" alt="{{ $_item->title }}" class="max-w-full h-auto lozad">
						</a>
					</div>
					<div class="w-2/3 md:w-full pr-4 pl-4 mb10">
						<h5>
							<a href="{{$_item->getPermalink()}}">
								{{$_item->title }}
							</a>
						</h5>
						<p>
							{{ StringHelper::truncate($_item->description, 100) }}
						</p>
					</div>
				</div>
			</div>
	   @endforeach
	</div>
@endforeach
