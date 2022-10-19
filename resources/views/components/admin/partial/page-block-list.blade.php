<x-admin.card.side-bar id="page-block-list">
    <x-slot name="title">
        {!! trans('admin.label.page-blocks')!!}
    </x-slot>
    <x-slot name="action">
        <a href="{{ma_get_admin_create_url('block')}}?model={{$model}}&model_id={{$item->id}}"
           class="nav-link btn btn-info btn-sm">{{icon('plus')}}{!! trans('admin.message.add_block')!!}</a>
    </x-slot>
    <ul>
        @foreach($item->blocks as $block)
            <li>
                <a href="{{ma_get_admin_edit_url($block)}}">- {!! $block->title !!}</a>
            </li>
        @endforeach
    </ul>
</x-admin.card.side-bar>

