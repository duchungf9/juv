<div class="row filemanager-list d-grid-lg gy-3">
    @forelse($medias as $media)
        <div class="col-6 col-xl-2 col-lg-3 col-md-3">
            <div id="media-id-{{ $media->id }}" data-id="{{ $media->id }}" class="thumbnail-item">
                @if($media->collection_name == 'images')
                    <img src="{!! ImgHelper::get_cached($media->file_name, array('w' => '200', 'h' => '200', 'c' => 'contain', 'q' => '60' )) !!}"
                         alt="{{ $media->alt }}" title="{{ $media->title }}">
                @else
                    <i class="fa fa-file-text-o fa-5x" aria-hidden="true"></i>
                @endif
                @if($media->title )
                    <div class="thumbnail-caption">
                        {{ $media->title }} {{ $media->id }}
                    </div>
                @endif
            </div>
        </div>
    @empty
        {!! trans('admin.message.no_item_found') !!}
    @endforelse
</div>
