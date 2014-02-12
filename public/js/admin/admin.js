$(document).ready(function(){
  var files_processed = 0;
  var upload_started = false;
  var form = $('#addNewArticle');

  var uploader = new plupload.Uploader({
    runtimes : 'html5,flash',
    browse_button : 'pickfiles',
    container : 'uploader',
    max_file_size : '500mb',
    chunk_size: '5mb',
    url : '/api/media',
    flash_swf_url : '/js/plupload/Moxie.swf',
    filters : [
      {title : "Image files", extensions : "png,jpg,jpeg,tiff,gif"},
      {title : "Video files", extensions : "mpeg,mpg,mp4,ogg,mov,webm,mkv,wmv,flv,avi,m3u8,ts,3gp"}
    ],
    multipart_params : function (file) {
      var tags = $('.file[data-id='+file.id+']').find('.file-tags').val();

      return {
        "tags" : tags
      };
    }
  });

  var tagSources = [];

  uploader.bind('Init', function(up, params) {
    // $('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
  });

  $('#start-upload').click(function(e) {
    uploader.start();
    e.preventDefault();
  });

  uploader.init();

  uploader.bind('FilesAdded', function(up, files) {
    var fileList = $('#uploader');
    $.each(files, function(i, file) {
      var fileEl = $(
        '<div class="file"> \
          <div class="info"> \
            <span class="label label-info arrowed-right">Filename: </span> \
            <span class="filename">Tetst.jpg</span> \
          </div> \
          <span class="label label-info arrowed-right">Tags: </span> \
          <span class="tags-container"> \
            <input type="text" class="file-tags" placeholder="Enter tags ..."> \
          </span> \
          <div class="info"> \
            <span class="label label-info arrowed-right">Status: </span> \
            <div class="filestatus"> \
              <div class="progress progress-striped"> \
                <div class="progress-bar progress-bar-success"></div> \
              </div> \
            </div> \
          </div> \
        </div>'
      );

      fileEl.attr('data-id', file.id);
      fileEl.find('.filename').html(file.name);

      var tag_input = fileEl.find('.file-tags');

      tag_input.tag({
        placeholder:tag_input.attr('placeholder'),
        source: tagSources
      });

      fileList.append(fileEl);
    });

    up.refresh(); // Reposition Flash/Silverlight
  });

  uploader.bind('UploadProgress', function(up, file) {
    var percent = file.percent + '%';
    $('.file[data-id='+file.id+']').find('.filestatus .progress').attr('data-percent', percent)
    $('.file[data-id='+file.id+']').find('.filestatus .progress .progress-bar').css('width', percent);
  });

  uploader.bind('Error', function(up, err) {
    $('#filelist').append("<div>Error: " + err.code +
      ", Message: " + err.message +
      (err.file ? ", File: " + err.file.name : "") +
      "</div>"
    );

    files_processed++;

    //check if we have uploaded all the files
    if(files_processed == $('#uploader .file').length) {
      form.submit();
    }

    up.refresh(); // Reposition Flash/Silverlight
  });

  uploader.bind('FileUploaded', function(up, file, ajax) {
    var res = JSON && JSON.parse(ajax.response) || $.parseJSON(ajax.response);

    if(typeof res.data == 'object') {
      form.append("<input type='hidden' name='media[]' value='"+ res.data[0] +"' >");
    }

    files_processed++;

    //check if we have uploaded all the files
    if(files_processed == $('#uploader .file').length) {
      form.submit();
    }
  });









  //end of admin uploader
  $("#region").on('change', function(){
    var id = $(this).val();
    $.get('/admin/provinces/province-option-list',{id:id}, function(res){
      $("#province").html(res);
    });
  });

  $("#province").on('change', function(){
    var id = $(this).val();
    $.get('/admin/cities/city-option-list',{id:id}, function(res){
      $("#city").html(res);
    });
  });

  $(".delete-btn").on('click', function(e){
    // console.log('asd');
    e.preventDefault();
    var confirm_dialog = confirm("Are you sure you want to delete this record? This procedure cannot be undone.");
    if(confirm_dialog){
      // return true;
      window.location.href = $(this).attr('href');
    }
    else{
      return false;
    }
  });

  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

  form.on('submit', function(event){
      //check if we have uploaded all the files
      if(files_processed == $('#uploader .file').length) {

        var selected_modals = window.app_media;

        $.each(selected_modals, function(i, item) {
          form.append("<input type='hidden' name='media[]' value='"+ item +"' >");
        });

        var featured_image = window.featured_image || '';
        form.append("<input type='hidden' name='featured_image' value='"+ featured_image +"' >");

        form.append("<input type='hidden' name='tags' value='"+ $('#form-field-tags').val() +"' >");
        return true;
      }

      if(!upload_started) {
        var selected_modals = $('#myModal .modal-body').find('.ace-thumbnails .item.selected');
        $('input[name=media\\[\\]]').remove();

        selected_modals.each(function(i, el) {
          form.append("<input type='hidden' name='media[]' value='"+ $(this).data('id') +"' >");
        });

        upload_started = true;
        uploader.start();
      }

      event.preventDefault();
  });


  $('input.ace-switch-3').on('click', function() {
    var url = $(this).data('url');
    var params = {};
    params[$(this).attr('name')] = !!this.checked;
    params['update'] = true;
    params['_token'] = $('input[name="_token"]').val();
    $.post(url, params, function(res) {
    	if(!res.success) {
    		alert('An error occured while updating this item');
    	}
    });
  });
});