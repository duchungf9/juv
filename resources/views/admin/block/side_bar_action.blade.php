<x-admin.card.side-bar id="edit-sidebar">
	<x-slot name="title">{!! trans('admin.label.actions')!!}</x-slot>
	<ul>
		@if ($pageConfig['actions']['copy']==1 && $page->id!='')
			<li>
				<a href="{{ma_get_admin_copy_url($page)}}">{{icon('copy')}}{!! trans('admin.label.copy')!!}</a>
			</li>
			<li>
				<a href="{{ma_get_admin_edit_url($page->model)}}#block_tab">{{icon('reply')}}{!! trans('admin.label.back_to')!!} {{$page->model->title}}</a>
			</li>
		@endif
	</ul>
</x-admin.card.side-bar>
