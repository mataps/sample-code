  <script src="http://js.cit.api.here.com/se/2.5.3/jsl.js?with=maps,places" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.3/jsl.js?with=all"></script>
  <script src="/js/admin/map.js"></script>
  <script>
    window.stories = <?php echo json_encode(Story::getTags()); ?>;
    window.app_media =  <?php echo json_encode(isset($media) ? $media : ''); ?>;
    window.featured_image =  <?php echo json_encode(isset($featured_image) ? $featured_image : ''); ?>;
  </script>

<script type="text/javascript" src="/js/admin/media-manager.js"></script>
<style type="text/css">
  #uploader .file { border: 1px dashed rgb(245, 153, 66); border-radius: 4px; padding: 10px; }
  #uploader .file .info{ margin-bottom: 5px; }
  #uploader .progress { margin-top: 10px; margin-bottom: 10px; }
  #uploader .moxie-shim{ width: 0px !important; }

  .ace-thumbnails > li > :first-child > .selected-text > .inner {
    padding: 4px 0px;
    margin: 0px;
    display: inline-block;
    vertical-align: middle;
    max-width: 90%;
  }
  .ace-thumbnails > li > :first-child > .selected-text::before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    margin-right: 0px;
  }

  .ace-thumbnails > li > :first-child > .selected-text {
    position: absolute;
    right: 0px;
    left: 0px;
    bottom: 0px;
    top: 0px;
    text-align: center;
    color: rgb(255, 255, 255);
    background-color: rgba(0, 0, 0, 0.54902);
    opacity: 0;
  }

  .ace-thumbnails > li.selected > :first-child > .selected-text {
    opacity: 1;
  }

  .modal-dialog { width: 97%; }
  input#search-media { float: right; }
  .ace-thumbnails > li.featured { border: 2px solid red; }
</style>
<script type="text/javascript">
  jQuery(function($) {

    var colorbox_params = {
      reposition:true,
      scalePhotos:true,
      scrolling:false,
      previous:'<i class="icon-arrow-left"></i>',
      next:'<i class="icon-arrow-right"></i>',
      close:'&times;',
      current:'{current} of {total}',
      maxWidth:'100%',
      maxHeight:'100%'
    };

    var mediaOptions = {
      colorbox_params: colorbox_params,
      fileCounter: $('#insertfile'),
      trigger: $('#insertfile')
    };

    var mediaBrowser = new MediaManager( mediaOptions );
  });
</script>