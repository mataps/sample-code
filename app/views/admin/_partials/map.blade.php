<div class="form-group ">
	<label class="col-sm-3 control-label no-padding-right" for="tags">Pin Location</label>
	<div class="col-sm-9">
		<div id="mapSearchbox" ></div>
		<div id="mapCSearch"></div><div style="clear: both"></div>
		<div id="mapResultlist"></div>
		<div id="map" style="width: 525px; height: 400px;"></div>
		<div style="clear:both"></div>
		<input type="hidden" name="lat" id="lat" value="<?php echo Input::old('lat') ?>">
		<input type="hidden" name="long" id="long" value="<?php echo Input::old('long') ?>">
	</div>
</div>

<script type="text/javascript">
	document.write('<script src="//js.cit.api.here.com/se/2.5.3/jsl.js?with=all"><\/script>');
	$(function() {
		(function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "/js/admin/map.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', ''));
	});
</script>