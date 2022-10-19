<x-admin.card.side-bar id="edit-sidebar">
    <x-slot name="title">{!! trans('admin.label.actions')!!}</x-slot>
    <ul>
        @if (data_get($pageConfig,'actions.copy')==1 && $page->id!='')
            <li>
                <a href="{{ma_get_admin_copy_url($page)}}">{{icon('copy')}}{!! trans('admin.label.copy')!!}</a>
            </li>
        @endif
        @if (data_get($pageConfig,'actions.create')==1)
            <li>
                <a href="{{ma_get_admin_create_url($page)}}">{{icon('plus')}}{!! trans('admin.message.add_new_item')!!}</a>
            </li>
        @endif
        <li>
            <a href="{{ma_get_admin_list_url($page)}}">{{icon('reply')}}{!! trans('admin.message.back_to_list')!!}</a>
        </li>
        @if (data_get($pageConfig,'actions.preview')==1 && $page->id!='')
            <li>
                <a href="{{ma_get_admin_preview_url($page)}}"
                   target="_new">{{icon('eye')}}{!! trans('admin.message.view_page')!!}</a>
            </li>
        @endif

    </ul>
</x-admin.card.side-bar>
@if ($pageConfig->get('showBlock') == 1)
    <x-admin.partial.page-block-list :item="$page" :model="$pageConfig->get('model')"/>
@endif





