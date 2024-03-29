<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Doon Po Sa Amin | Admin</title>

	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="/css/admin/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">

	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="/css/admin/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="/css/admin/chosen.css">
	<link rel="stylesheet" href="/css/admin/datepicker.css">
	<link rel="stylesheet" href="/css/admin/bootstrap-timepicker.css">
	<link rel="stylesheet" href="/css/admin/daterangepicker.css">
	<link rel="stylesheet" href="/css/admin/colorpicker.css">
	<link rel="stylesheet" href="/css/admin/colorbox.css">

	<!-- ace styles -->
	<link rel="stylesheet" href="/css/admin/ace.min.css">
	<link rel="stylesheet" href="/css/admin/ace-rtl.min.css">
	<link rel="stylesheet" href="/css/admin/ace-skins.min.css">
	<link rel="stylesheet" href="/css/admin/admin.css">
	<link rel="stylesheet" href="/css/admin/font-awesome-4.0.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/admin/font-awesome.min.css">
	<!--[if lte IE 8]>
		<link rel="stylesheet" href="/css/ace-ie.min.css" />
	<![endif]-->

	<!-- ace settings handler -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/js/jquery-1.10.2.min.js"><\/script>')</script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="/js/html5shiv.js"></script>
		<script src="/js/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		.jqstooltip {position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}
		.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
	</style>
	<script type="text/javascript">
			try{ ace.settings.check('navbar', 'fixed') }catch(e){}
	</script>
</head>

<body cz-shortcut-listen="true">

	@include('admin._partials.nav')

	<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <div class="main-container-inner">
      <a class="menu-toggler" id="menu-toggler" href="#">
        <span class="menu-text"></span>
      </a>

      <div class="sidebar" id="sidebar">
        <script type="text/javascript">
          try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts">
          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
              <button class="btn btn-success"></button>
              <button class="btn btn-info"></button>
              <button class="btn btn-warning"></button>
              <button class="btn btn-danger"></button>
          </div>

          <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
              <span class="btn btn-success"></span>
              <span class="btn btn-info"></span>
              <span class="btn btn-warning"></span>
              <span class="btn btn-danger"></span>
          </div>
        </div> -->
        <!-- #sidebar-shortcuts -->

        <ul class="nav nav-list">
        	@include('admin._partials.sidenav')
        </ul><!-- /.nav-list -->

        <div class="sidebar-collapse" id="sidebar-collapse">
            <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
        </div>

        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
      </div><!-- /.sidebar -->

      <div class="main-content">
        <div class="page-content">
          @yield('content')
        </div><!-- /.page-content -->
      </div><!-- /.main-content -->
    </div><!-- /.main-container-inner -->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>
  </div><!-- /.main-container -->

  <div class="tooltip top in" style="display: none;"><div class="tooltip-inner"></div></div>

  <script type="text/javascript">
      // window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
  </script>

  <script type="text/javascript">
      if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
  </script>

  <script src="/js/admin/bootstrap.min.js"></script>
  <script src="/js/admin/typeahead-bs2.min.js"></script>
  <!--[if lte IE 8]>
    <script src="/js/admin/excanvas.min.js"></script>
  <![endif]-->
  <script src="/js/admin/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="/js/admin/jquery.ui.touch-punch.min.js"></script>
  <script src="/js/admin/chosen.jquery.min.js"></script>
  <script src="/js/admin/fuelux/fuelux.spinner.min.js"></script>
  <script src="/js/admin/date-time/bootstrap-datepicker.min.js"></script>
  <script src="/js/admin/date-time/bootstrap-timepicker.min.js"></script>
  <script src="/js/admin/date-time/moment.min.js"></script>
  <script src="/js/admin/date-time/daterangepicker.min.js"></script>
  <script src="/js/admin/bootstrap-colorpicker.min.js"></script>
  <script src="/js/admin/jquery.knob.min.js"></script>
  <script src="/js/admin/jquery.autosize.min.js"></script>
  <script src="/js/admin/jquery.inputlimiter.1.3.1.min.js"></script>
  <script src="/js/admin/jquery.maskedinput.min.js"></script>
  <script src="/js/admin/jquery.colorbox-min.js"></script>
  <script src="/js/admin/bootstrap-tag.min.js"></script>
  <script src="/js/admin/bootstrap-wysiwyg.min.js"></script>
  <script src="/js/admin/bootbox.min.js"></script>

  <!-- plupload -->
  <script src="/js/plupload/plupload.full.min.js"></script>
  <script src="/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>

  <script src="/js/admin/ace-elements.min.js"></script>
  <script src="/js/admin/ace.min.js"></script>

  <script src="/js/admin/ace-extra.min.js"></script>
  <script src="/js/admin/Chart.min.js"></script>

 <script src="/js/admin/admin.js"></script>
  <script type="text/javascript">
      jQuery(function($) {
          $('#id-disable-check').on('click', function() {
              var inp = $('#form-input-readonly').get(0);
              if(inp.hasAttribute('disabled')) {
                  inp.setAttribute('readonly' , 'true');
                  inp.removeAttribute('disabled');
                  inp.value="This text field is readonly!";
              }
              else {
                  inp.setAttribute('disabled' , 'disabled');
                  inp.removeAttribute('readonly');
                  inp.value="This text field is disabled!";
              }
          });

          $(".chosen-select").chosen();
          $('#chosen-multiple-style').on('click', function(e){
              var target = $(e.target).find('input[type=radio]');
              var which = parseInt(target.val());
              if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
               else $('#form-field-select-4').removeClass('tag-input-style');
          });


          $('[data-rel=tooltip]').tooltip({container:'body'});
          $('[data-rel=popover]').popover({container:'body'});

          $('textarea[class*=autosize]').autosize({append: "\n"});
          $('textarea.limited').inputlimiter({
              remText: '%n character%s remaining...',
              limitText: 'max allowed : %n.'
          });

          $.mask.definitions['~']='[+-]';
          $('.input-mask-date').mask('99/99/9999');
          $('.input-mask-phone').mask('(999) 999-9999');
          $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
          $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});



          $( "#input-size-slider" ).css('width','200px').slider({
              value:1,
              range: "min",
              min: 1,
              max: 8,
              step: 1,
              slide: function( event, ui ) {
                  var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                  var val = parseInt(ui.value);
                  $('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
              }
          });

          $( "#input-span-slider" ).slider({
              value:1,
              range: "min",
              min: 1,
              max: 12,
              step: 1,
              slide: function( event, ui ) {
                  var val = parseInt(ui.value);
                  $('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
              }
          });


          $( "#slider-range" ).css('height','200px').slider({
              orientation: "vertical",
              range: true,
              min: 0,
              max: 100,
              values: [ 17, 67 ],
              slide: function( event, ui ) {
                  var val = ui.values[$(ui.handle).index()-1]+"";

                  if(! ui.handle.firstChild ) {
                      $(ui.handle).append("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>");
                  }
                  $(ui.handle.firstChild).show().children().eq(1).text(val);
              }
          }).find('a').on('blur', function(){
              $(this.firstChild).hide();
          });

          $( "#slider-range-max" ).slider({
              range: "max",
              min: 1,
              max: 10,
              value: 2
          });

          $( "#eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
              // read initial values from markup and remove that
              var value = parseInt( $( this ).text(), 10 );
              $( this ).empty().slider({
                  value: value,
                  range: "min",
                  animate: true

              });
          });


          $('#id-input-file-1 , #id-input-file-2').ace_file_input({
              no_file:'No File ...',
              btn_choose:'Choose',
              btn_change:'Change',
              droppable:false,
              onchange:null,
              thumbnail:false //| true | large
              //whitelist:'gif|png|jpg|jpeg'
              //blacklist:'exe|php'
              //onchange:''
              //
          });

          // $('#id-input-file-3').ace_file_input({
          //     style:'well',
          //     btn_choose:'Drop files here or click to choose',
          //     btn_change:null,
          //     no_icon:'icon-cloud-upload',
          //     droppable:true,
          //     thumbnail:'small'//large | fit
          //     //,icon_remove:null//set null, to hide remove/reset button
          //     /**,before_change:function(files, dropped) {
          //         //Check an example below
          //         //or examples/file-upload.html
          //         return true;
          //     }*/
          //     *,before_remove : function() {
          //         return true;
          //     }
          //     ,
          //     preview_error : function(filename, error_code) {
          //         //name of the file that failed
          //         //error_code values
          //         //1 = 'FILE_LOAD_FAILED',
          //         //2 = 'IMAGE_LOAD_FAILED',
          //         //3 = 'THUMBNAIL_FAILED'
          //         //alert(error_code);
          //     }

          // }).on('change', function(){
          //     //console.log($(this).data('ace_input_files'));
          //     //console.log($(this).data('ace_input_method'));
          // });


          //dynamically change allowed formats by changing before_change callback function
          $('#id-file-format').removeAttr('checked').on('change', function() {
              var before_change
              var btn_choose
              var no_icon
              if(this.checked) {
                  btn_choose = "Drop images here or click to choose";
                  no_icon = "icon-picture";
                  before_change = function(files, dropped) {
                      var allowed_files = [];
                      for(var i = 0 ; i < files.length; i++) {
                          var file = files[i];
                          if(typeof file === "string") {
                              //IE8 and browsers that don't support File Object
                              if(! (/\.(jpe?g|png|gif|bmp)$/i).test(file) ) return false;
                          }
                          else {
                              var type = $.trim(file.type);
                              if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif|bmp)$/i).test(type) )
                                      || ( type.length == 0 && ! (/\.(jpe?g|png|gif|bmp)$/i).test(file.name) )//for android's default browser which gives an empty string for file.type
                                  ) continue;//not an image so don't keep this file
                          }

                          allowed_files.push(file);
                      }
                      if(allowed_files.length == 0) return false;

                      return allowed_files;
                  }
              }
              else {
                  btn_choose = "Drop files here or click to choose";
                  no_icon = "icon-cloud-upload";
                  before_change = function(files, dropped) {
                      return files;
                  }
              }
              var file_input = $('#id-input-file-3');
              file_input.ace_file_input('update_settings', {'before_change':before_change, 'btn_choose': btn_choose, 'no_icon':no_icon})
              file_input.ace_file_input('reset_input');
          });




          $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
          .on('change', function(){
              //alert(this.value)
          });
          $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'icon-caret-up', icon_down:'icon-caret-down'});
          $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'icon-plus smaller-75', icon_down:'icon-minus smaller-75', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});



          $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
              $(this).prev().focus();
          });
          $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function(){
              $(this).next().focus();
          });

          $('#timepicker1').timepicker({
              minuteStep: 1,
              showSeconds: true,
              showMeridian: false
          }).next().on(ace.click_event, function(){
              $(this).prev().focus();
          });

          $('#colorpicker1').colorpicker();
          $('#simple-colorpicker-1').ace_colorpicker();


          $(".knob").knob();


          //we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
          var tag_input = $('#form-field-tags');

              tag_input.tag(
                {
                  placeholder:tag_input.attr('placeholder'),
                  //enable typeahead by specifying the source array
                  source: window.stories,//defined in ace.js >> ace.enable_search_ahead
                }
              );




          /////////
          $('#modal-form input[type=file]').ace_file_input({
              style:'well',
              btn_choose:'Drop files here or click to choose',
              btn_change:null,
              no_icon:'icon-cloud-upload',
              droppable:true,
              thumbnail:'large'
          })

          //chosen plugin inside a modal will have a zero width because the select element is originally hidden
          //and its width cannot be determined.
          //so we set the width after modal is show
          $('#modal-form').on('shown.bs.modal', function () {
              $(this).find('.chosen-container').each(function(){
                  $(this).find('a:first-child').css('width' , '210px');
                  $(this).find('.chosen-drop').css('width' , '210px');
                  $(this).find('.chosen-search input').css('width' , '200px');
              });
          })
          /**
          //or you can activate the chosen plugin after modal is shown
          //this way select element becomes visible with dimensions and chosen works as expected
          $('#modal-form').on('shown', function () {
              $(this).find('.modal-chosen').chosen();
          })
          */

      });
  </script>

  <script type="text/javascript">
      jQuery(function($){
          function showErrorAlert (reason, detail) {
              var msg='';
              if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
              else {
                  console.log("error uploading file", reason, detail);
              }
              $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+
               '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
          }

          //$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

          //but we want to change a few buttons colors for the third style
          $('#content-editor').ace_wysiwyg({
              toolbar:
              [
                  'font',
                  null,
                  'fontSize',
                  null,
                  {name:'bold', className:'btn-info'},
                  {name:'italic', className:'btn-info'},
                  {name:'strikethrough', className:'btn-info'},
                  {name:'underline', className:'btn-info'},
                  null,
                  {name:'insertunorderedlist', className:'btn-success'},
                  {name:'insertorderedlist', className:'btn-success'},
                  {name:'outdent', className:'btn-purple'},
                  {name:'indent', className:'btn-purple'},
                  null,
                  {name:'justifyleft', className:'btn-primary'},
                  {name:'justifycenter', className:'btn-primary'},
                  {name:'justifyright', className:'btn-primary'},
                  {name:'justifyfull', className:'btn-inverse'},
                  null,
                  {name:'createLink', className:'btn-pink'},
                  {name:'unlink', className:'btn-pink'},
                  null,
                  {name:'insertImage', className:'btn-success'},
                  null,
                  'foreColor',
                  null,
                  {name:'undo', className:'btn-grey'},
                  {name:'redo', className:'btn-grey'}
              ],
              'wysiwyg': {
                  fileUploadError: showErrorAlert
              }
          }).prev().addClass('wysiwyg-style2');



          $('#editor2').css({'height':'200px'}).ace_wysiwyg({
              toolbar_place: function(toolbar) {
                  return $(this).closest('.widget-box').find('.widget-header').prepend(toolbar).children(0).addClass('inline');
              },
              toolbar:
              [
                  'bold',
                  {name:'italic' , title:'Change Title!', icon: 'icon-leaf'},
                  'strikethrough',
                  null,
                  'insertunorderedlist',
                  'insertorderedlist',
                  null,
                  'justifyleft',
                  'justifycenter',
                  'justifyright'
              ],
              speech_button:false
          });


          $('[data-toggle="buttons"] .btn').on('click', function(e){
              var target = $(this).find('input[type=radio]');
              var which = parseInt(target.val());
              var toolbar = $('#editor1').prev().get(0);
              if(which == 1 || which == 2 || which == 3) {
                  toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
                  if(which == 1) $(toolbar).addClass('wysiwyg-style1');
                  else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
              }
          });




          //Add Image Resize Functionality to Chrome and Safari
          //webkit browsers don't have image resize functionality when content is editable
          //so let's add something using jQuery UI resizable
          //another option would be opening a dialog for user to enter dimensions.
          if ( typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase()) ) {

              var lastResizableImg = null;
              function destroyResizable() {
                  if(lastResizableImg == null) return;
                  lastResizableImg.resizable( "destroy" );
                  lastResizableImg.removeData('resizable');
                  lastResizableImg = null;
              }

              var enableImageResize = function() {
                  $('.wysiwyg-editor')
                  .on('mousedown', function(e) {
                      var target = $(e.target);
                      if( e.target instanceof HTMLImageElement ) {
                          if( !target.data('resizable') ) {
                              target.resizable({
                                  aspectRatio: e.target.width / e.target.height,
                              });
                              target.data('resizable', true);

                              if( lastResizableImg != null ) {//disable previous resizable image
                                  lastResizableImg.resizable( "destroy" );
                                  lastResizableImg.removeData('resizable');
                              }
                              lastResizableImg = target;
                          }
                      }
                  })
                  .on('click', function(e) {
                      if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
                          destroyResizable();
                      }
                  })
                  .on('keydown', function() {
                      destroyResizable();
                  });
              }

              enableImageResize();

              /**
              //or we can load the jQuery UI dynamically only if needed
              if (typeof jQuery.ui !== 'undefined') enableImageResize();
              else {//load jQuery UI if not loaded
                  $.getScript($path_assets+"/js/jquery-ui-1.10.3.custom.min.js", function(data, textStatus, jqxhr) {
                      if('ontouchend' in document) {//also load touch-punch for touch devices
                          $.getScript($path_assets+"/js/jquery.ui.touch-punch.min.js", function(data, textStatus, jqxhr) {
                              enableImageResize();
                          });
                      } else  enableImageResize();
                  });
              }
              */
          }


      });
  </script>
</body>
</html>
