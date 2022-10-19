$( function()
{

  const $modal = $('#filemanager');
  /*
  * When the user clicks on upload button, open the modal
  * with input name and current value
  */
  $('.filemanager-select').on('click', function(e) {
    e.preventDefault();
    $modal.modal('show');

    let inputName = $(this).data('input');
    let inputValue = $('input[name='+ inputName +']').val();
    let params ={...this.dataset} // get  the element data attribute (dataset)
    // Set modal hidden input values
    $('input[name=file-input]', $modal).val(inputName);
    $('input[name=file-value]', $modal).val(inputValue)

    window.emitterHub.emit('FILE_MANAGER_INIT',inputValue,params);

    // If 'inputValue' value is != 0, open library tab
    if(inputValue != 0) {
      $('#file-manager-list').click();
    }
  });

  /*
  * Tab upload, uploadifive method
  */
  $('input[name=upload-input]', $modal).uploadifive({
    'auto': true,
    'queueID': 'queue-modal',
    'uploadScript': urlAjaxHandlerCms + 'filemanager/upload',
    'onAddQueueItem': function(file) {
      this.data('uploadifive').settings.formData = {
        '_token': $('[name=_token]').val()
      };
    },
    'onUploadComplete' : function(file, data) {
      let responseObj = jQuery.parseJSON(data);
      let mediaType   =  responseObj.data;
      // Set media id in modal hidden value
      $('input[name=file-value]', $modal).val(responseObj.id);
      $('#file-manager-list').trigger('click');
    }
  });

  /*
  * When the user clicks on 'library' tab, load all images
  */
  $('#file-manager-list').on('click', function(e) {
      window.emitterHub.emit('FILE_MANAGER_LOAD_LIST')

      let fileValue = $('input[name=file-value]').val();
      $('.modal-footer', $modal).removeClass('visually-hidden');

      // If user is in edit mode, set media as active and load sidebar
      if(fileValue != 0) {

        $('#file-manager-upload', $modal).removeClass('active');
        $('#file-manager-list', $modal).addClass('active');
        $('#tab-upload', $modal).removeClass('active show');
        $('#tab-images', $modal).addClass('active show')

        window.emitterHub.emit('FILE_MANAGER_UPDATE_SIDE_BAR',fileValue)
        window.emitterHub.emit('FILE_MANAGER_SELECT_ITEM',fileValue)
     }
  });






  /*
  * When the user clicks resets button, remove current active and reset hidden input value
  */
  $('.reset-image', $modal).on('click', function(e) {
    e.preventDefault();
    // Remove all 'is-active' classes
    window.emitterHub.emit('FILE_MANAGER_RESET')
  });

  /*
  * When the user confirm an image from filemanager,
  * set image id as new value in admin form input and close the modal
  */
  $('.confirm-image', $modal).on('click', function(e) {
    e.preventDefault();
    // Set admin form input value
    $('input[name='+ $('input[name=file-input]', $modal).val() +']').val($('input[name=file-value]', $modal).val());
    // Close modal
    $modal.modal('hide');
  });

  /*
   * When the user close the modal, reset sidebar and loader.
   */
  $('#filemanager').on('hidden.bs.modal', function () {
    $('#tab-upload',$modal).addClass('active show');
    $('#tab-images',$modal).removeClass('active show')
    $('#file-manager-upload',$modal).addClass('active');
    $('#file-manager-list',$modal).removeClass('active');
    window.emitterHub.emit('FILE_MANAGER_UPDATE_SIDE_BAR',null)
  });

} );
