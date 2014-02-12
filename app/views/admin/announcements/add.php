  <link rel="stylesheet" type="text/css" href="/vendor/Datepicker/jquery.datepick.css">
  <script src="/js/admin/ckeditor/ckeditor.js"></script>
<div class="container">
    <div class="page-header">
      <h1>Add <small>Announcements</small></h1>
    </div>
    <div class="row">
          <?php
      foreach ($errors->all('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><li>:message</li></div>') as $error ) {
        echo $error;
      }; ?>
      <div class="col-xs-12">
        <form class="form-horizontal" id="addNewArticle" role="form" method="post">
        <?php echo Form::token(); ?>
          <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="title">Announcement Name</label>
          <div class="col-sm-9">
            <input type="text" id="title" name="name" placeholder="Title" class="col-xs-10 col-sm-5">
          </div>

        </div>
                <div class="space-4"></div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="tags">Place</label>
          <div class="col-sm-9">
            <select name="region" id="region">
              <option value="">Select Region</option>
              <?php foreach ($regions as $region): ?>
                <option value="<?php echo $region->_id; ?>"><?php echo $region->name; ?></option>
              <?php endforeach ?>
            </select>
            <select name="province" id="province"><option value="">Select Provinces</option></select>
            <select name="city" id="city"><option value="">Select City/Municipality</option></select>
         </div>
        </div>
        <div class="space-4"></div>
          <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="title">Where</label>
          <div class="col-sm-9">
            <input type="text" id="title" name="where" placeholder="eg. Munincipal Hall" class="col-xs-10 col-sm-5">
          </div>

        </div>
          <div class="space-4"></div>
          <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="title">When</label>
          <div class="col-sm-4" style="display:inline;">
            <input type="text" id="when-start" name="when-start" placeholder="Start" class="col-xs-10 col-sm-5">
            <span style="line-height: 30px; margin-left: 15px;">To</span>
            <input type="text" style="float:right;" id="when-end" name="when-end" placeholder="End" class="col-xs-10 col-sm-5">

          </div>


          </div>
        <div class="space-4"></div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="tags">Tags</label>
          <div class="col-sm-9">
            <input type="text" id="form-field-tags" placeholder="Enter tags ...">
          </div>
        </div>
        <div class="space-4"></div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="tags">Images/Videos</label>
          <div class="col-sm-9">
            <div class="ace-file-input" id="pickfiles">
              <label class="file-label" data-title="Choose">
                <span class="file-name" data-title="Browse File ...">
                  <i class="icon-upload-alt"></i>
                </span>
              </label>
              <a class="remove" href="#"><i class="icon-remove"></i></a>
            </div>
            <div class="ace-file-input" id="insertfile" data-toggle="modal" data-target="#myModal">
              <label class="file-label" data-title="Choose">
                <span class="file-name" data-title="Insert File from server...">
                  <i class="icon-folder-open-alt"></i>
                </span>
              </label>
              <a class="remove" href="#"><i class="icon-remove"></i></a>
            </div>
            <!-- Uploader -->
            <div id="uploader">
            </div><!-- ./uploader -->
          </div>
        </div>
        <div class="space-4"></div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="content-editor">Content</label>
          <div class="col-sm-9">
                        <textarea id="editor1" name="content" rows="10" cols="80">
                Type article here..
            </textarea>
                        <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
          </div>
        </div>
        <div class="space-4"></div>
                <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="tags">Pin Location</label>
          <div class="col-sm-9">
            <div id="mapSearchbox" ></div>
            <div id="mapCSearch"></div><div style="clear: both"></div>
            <div id="mapResultlist"></div>
            <div id="map" style="width: 525px; height: 400px;"></div>
            <div style="clear:both"></div>
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="long" id="long">
          </div>
        </div>
        <center><input type="submit" class="btn btn-primary"></center>
        </form>
      </div>
    </div>
</div>
<script type="text/javascript" src="/vendor/Datepicker/jquery.datepick.js"></script>
<script>
  $("#when-start").datepick({dateFormat: 'yyyy-mm-dd'});
   $("#when-end").datepick({dateFormat: 'yyyy-mm-dd'});
</script>


<?php echo View::make('admin.layouts.media-manager')->with(array('media'=>isset($media) ? $media : null, 'featured_image' => isset($featured_image) ? $featured_image : null )) ?>