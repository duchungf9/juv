<div id="filemanager" class="modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header d-flex justify-content-between" >
				<h4>{{__('admin.label.file_manager')}}</h4>
			    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-action">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link bg-info" href="#tab-upload" id="file-manager-upload" data-bs-toggle="tab" role="tab" aria-controls="upload" aria-selected="true">{{__('admin.label.upload_file')}}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link bg-success" href="#tab-images" id="file-manager-list" data-bs-toggle="tab" role="tab" aria-controls="list" aria-selected="false">{{__('admin.file_manager.library')}}</a>
					</li>
				</ul>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="tab-upload" class="tab-pane fade show active" role="tabpanel" aria-labelledby="file-manager-upload">
						<fieldset class="alert alert-info mt-3">
							<input name="upload-input" type="file" class="btn btn-primary">
							<div id="queue-modal" class="queue">{!!__('admin.message.media_drag') !!}</div>
						</fieldset>
					</div>
					<div id="tab-images" class="tab-pane fade" role="tabpanel" aria-labelledby="file-manager-list">
						<file-manager-grid-component></file-manager-grid-component>
					</div>
				</div>
			</div>
			<div class="modal-footer d-grid gap-2 d-md-flex justify-content-md-end visually-hidden">
				<button type="button" class="btn btn-success confirm-image" data-bs-dismiss="modal">{{icon('check')}} Select</button>
				<button type="button" class="btn btn-default reset-image">{{icon('undo')}} Reset selection</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{icon('times')}} Close</button>
				<input type="hidden" name="file-input" value="0" ref="fileInputModel">
				<input type="hidden" name="file-value" value="0" ref="fileInputValue">
			</div>
		</div>
	</div>
</div>
