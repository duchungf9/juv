@if ($pageConfig->get('showMediaCategory') == 1 && $page->id!='')
	@inject('template','App\Model\Template')
	<div class="form-group">
		<h5>{!!trans('admin.message.media_doc_type') !!}</h5>
		<select id="myImgType" name="myImgType" class="form-control mid-input full-xs">
			<option value=''>{!! trans('admin.label.please_select')!!}</option>
			@foreach ( $template->byTemplate('imagetype')->get() as $index => $item )
				<option value="{!! $item->id !!}">{!! $item->title !!}</option>
			@endforeach
		</select>
	</div>
	<hr />
@endif
