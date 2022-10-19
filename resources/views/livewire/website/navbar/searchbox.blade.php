<div wire:model="kw">
    <input type="text" class="from-control" placeholder="Search" wire:keydown.enter="doSearch"> 
    <span><button class="btn btn-warning" wire:click="doSearch">[🔍🔍🔍]</button></span>
    <div id="pre-searching">
        <ul>
            @if($result != null)
                @foreach($result as $item)
                    @if(is_object($item))
                        <li><a href="{{$item->_url}}">{{$item->title}}</a></li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>
