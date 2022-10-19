@extends('admin.master')
@section('title', 'Edit')
@section('content')
	@include('admin.common.action-bar')
	<main id="edit-main" class="container-fluid">
		@include('flash::notification')

		<div class="row">
			<div class="col-12 col-sm-8">
				{{ Form::model($page, ['files' => true, 'id'=>'edit-form', 'accept-charset' => "UTF-8"]) }}
				<div class="card">
					@if ($pageConfig->get('help'))
						{{$pageConfig->get('help')}}
						<hr>
					@endif
					<ul class="nav nav-tabs" id="editTab">
						<li class="nav-item">
							<a href="#content_tab" class="nav-link active" data-bs-toggle="tab" role="tab" aria-controls="content" aria-selected="true">
								{{icon('file-alt')}} {{trans('admin.label.content')}}
							</a>
						</li>
						@if ($pageConfig->get('showBlock') == 1 && $page->id!='')
							<li class="nav-item">
								<a href="#block_tab" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="block" aria-selected="false">
									{{icon('newspaper')}} {{trans('admin.label.block')}}
								</a>
							</li>
						@endif
						@if ($pageConfig->get('tabs'))
							@each('admin.helper.edit_form_tab', $pageConfig->get('tabs'), 'tab')
						@endif
						@if($page->review_coin_attributes != null)
							<li class="nav-item">
								<a href="#review_coin_attributes_tab" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="review_coin_attributes" aria-selected="false">
									Review specs
								</a>
							</li>
						@endif

						@if ($pageConfig->get('showSeo') == 1)
						<li class="nav-item">
							<a href="#seo_tab" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="seo" aria-selected="false">
								{{icon('globe-africa')}} {{trans('admin.label.seo')}}
							</a>
						</li>
						@endif
						@if ($pageConfig->get('showMedia') == 1 && $page->id!='')
						<li class="nav-item">
							<a href="#media_tab" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="media" aria-selected="false">
								{{icon('image')}} {{trans('admin.label.media')}}
							</a>
						</li>
						@endif
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane fade show active" id="content_tab" role="tabpanel" aria-labelledby="content_tab">
							{{ AdminForm::get( $page ) }}
						</div>
						@if ($pageConfig->get('showBlock') == 1)
							<div class="tab-pane fade" id="block_tab" role="tabpanel" aria-labelledby="block_tab">
								@include('admin.helper.blocks')

							</div>
						@endif
						@if ($pageConfig->get('tabs'))
							@foreach ($pageConfig->get('tabs') as $tab)
								@include('admin.helper.edit_form_tab_content', ['tab' => $tab])
							@endforeach

						@endif
						@if($page->review_coin_attributes != null)
							<div class="tab-pane fade" id="review_coin_attributes_tab" role="tabpanel" aria-labelledby="review_coin_attributes_tab">
								@include("admin.helper.form_review_coin_attributes", ['review_coin_attributes'=>$page->review_coin_attributes])
								{!!   $page->initReviewLanguages() !!}
							</div>
						@endif
						@if ($pageConfig->get('showSeo') == 1)
							<div class="tab-pane fade" id="seo_tab" role="tabpanel" aria-labelledby="seo_tab">
								{{ AdminForm::context(null)->getSeo( $page ) }}
							</div>
						@endif
						@if ($pageConfig->get('showMedia') == 1 && $page->id!='')
							<div class="tab-pane fade" id="media_tab" role="tabpanel" aria-labelledby="media_tab">
								@if ($pageConfig->get('showMediaCropper'))
									@include('admin.helper.form_mediacropper', ['cropperConfig' => collect($pageConfig->get('mediaCropper'))])
								@else
									@include('admin.helper.form_uploadifive')
								@endif
								@include('admin.helper.media_images')
								@include('admin.helper.media_docs')
							</div>
						@endif
					</div>
				</div>
				@include('admin.common.form_submit_button')
				{{ Form::close() }}

			</div>
			<div id="right-sidebar" class="col-12 col-sm-4">
				@includeFirst(['admin.'.strtolower($pageConfig->get('model')).'.side_bar_action', 'admin.common.side_bar_action'])
			</div>
		</div>
	</main>
	<div id="info" class="hidden"></div>
	@include('admin.helper.modal_media')

	@include('admin.helper.filemanager')

@endsection
@section('footerjs')
	<script src="{!! asset(config('fromSky.admin.path.plugins').'uploadifive/jquery.uploadifive.min.js')!!}" type="text/javascript"></script>
	<script src="{!! asset(config('fromSky.admin.path.plugins').'timepicker/jquery-ui-timepicker-addon.js')!!}" type="text/javascript"></script>
	<script src="{!! asset(config('fromSky.admin.path.plugins').'selectize/selectize.min.js')!!}" type="text/javascript"></script>
	<script src="{{ asset(config('fromSky.admin.path.assets').mix('cms/js/lara-file-manager.js')) }}"></script>
	<script type="text/javascript">
	$(function() {
		Cms.initTinymce();
		Cms.initColorPicker();
		Cms.initFiles();
		Cms.initDatePicker();
		Cms.initDateTimePicker();
		Cms.initUploadifiveSingle();
		Cms.initUploadifiveMedia();
		Cms.initSortableList("ul#simpleGallery");
		Cms.initSortableList("ul#simpleDocGallery");
		Cms.initImageRelationList();
		Cms.initMediaModal();
		Cms.initTabManager('editTab');
		$('.selectizemulti').selectize({
			plugins: ['remove_button', 'drag_drop'],
			delimiter: ',',
			persist: false,
			create: false,
			sortField: 'text',
			allowEmptyOption: true,
		});
		$('.selectize').selectize({
			sortField: 'text',
			allowEmptyOption: true,
		});
	});
</script>
@endsection
