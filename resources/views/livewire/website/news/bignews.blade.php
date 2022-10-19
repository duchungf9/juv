<div>
    <div class="big-news-content">
        @foreach ($news as $index => $new)
            <div class="big-new-item">
                <img src="{{ImgHelper::get_cached($new->image, ['w' => ($index==0)?800:400, 'h' => ($index==0)?500:250, 'c' => 'cover', 'q' => 80]) }}" alt=""/>
                @isset($new->tags[0]->title)
                    <a href="#" class="big-new-tag" style="background:red">{{$new->tags[0]->title}}</a>
                @endisset
                <a href="#" class="big-new-link">{{$new->title}} - Lượt xem : <span class="view_count">{{$new->hits}}</span></a>
            </div>
        @endforeach
    </div>
{{--    <div><input wire:model.debounce.500ms="search" type="text" placeholder="Search users..."/></div>--}}
</div>
