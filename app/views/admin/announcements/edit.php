  <link rel="stylesheet" type="text/css" href="/vendor/Datepicker/jquery.datepick.css">
  <script src="/js/admin/ckeditor/ckeditor.js"></script>
<div class="container">
    <div class="page-header">
      <h1>Edit <small>Announcements</small></h1>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <form class="form-horizontal" id="addNewArticle" role="form" method="post">
        <?php echo Form::token(); ?>
          <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="title">Event Name</label>
          <div class="col-sm-9">
            <input type="text" id="title" name="name" placeholder="Name" class="col-xs-10 col-sm-5" value="<?php echo $event->content['title']; ?>">
          </div>

        </div>
                <div class="space-4"></div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="tags">Place</label>
          <div class="col-sm-9">
            <select name="region" id="region">
              <option>Select Region</option>
              <?php foreach ($regions as $region): ?>
                <option <?php if($region->_id == $event->region_id) echo 'selected'; ?> value="<?php echo $region->_id; ?>"><?php echo $region->name; ?></option>
              <?php endforeach ?>
            </select>
           <select name="province" id="province">
              <option>Select Province</option>
             <?php foreach ($provinces as $province): ?>
                <option <?php if($province->_id == $event->province_id) echo 'selected'; ?> value="<?php echo $province->_id; ?>"><?php echo $province->name; ?></option>
              <?php endforeach ?>

            </select>
            <select name="city" id="city">
              <option>Select City/Municipality</option>
              <?php foreach ($cities as $city): ?>
                <option <?php if($city->_id == $event->city_id) echo 'selected'; ?> value="<?php echo $city->_id; ?>"><?php echo $city->name; ?></option>
              <?php endforeach ?>
            </select>   </div>
        </div>
        <div class="space-4"></div>
          <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="title">Where</label>
          <div class="col-sm-9">
            <input type="text" id="title" value="<?php echo $event->where; ?>" name="where" placeholder="eg. Munincipal Hall" class="col-xs-10 col-sm-5">
          </div>

        </div>

          <div class="space-4"></div>
          <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="title">When</label>
          <div class="col-sm-4" style="display:inline;">
            <input type="text" id="when-start" name="when-start" value="<?php echo date('Y-m-d', $event->when['start']->sec); ?>"  placeholder="Start" class="col-xs-10 col-sm-5">
            <span style="line-height: 30px; margin-left: 15px;">To</span>
            <input type="text" style="float:right;" id="when-end" name="when-end" value="<?php echo isset($event->when['end']) ? date('Y-m-d', $event->when['end']->sec) : null ?>"  placeholder="End" class="col-xs-10 col-sm-5">
          </div>
          </div>
                   <div class="space-4"></div>
          <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="title">Published</label>
          <div class="col-sm-9">
            <input type="checkbox" name="published" <?php if($event->published) echo 'checked'; ?>>
          </div>
        </div>
        <div class="space-4"></div>
        <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="tags">Tags</label>
          <div class="col-sm-9">
            <input type="text" id="form-field-tags" value="<?php echo $tags; ?>"  placeholder="Enter tags ...">
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
               <?php echo $event->content['content']; ?>
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
      <input type="hidden" name="lat" id="lat" value="<?php echo  $event->coord['latitude']; ?>">
            <input type="hidden" name="long" id="long" value="<?php echo $event->coord['longitude']; ?>" >

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