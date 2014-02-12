<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="tags">Place</label>
	<div class="col-sm-9">

		<select name="region" id="region">
			<option value="">Select Region</option>
			<?php foreach ($regions as $reg): ?>
				<?php if(isset($loc) && key($loc['region']) == $reg->_id) : ?>
					<option value="<?php echo $reg->_id; ?>" selected="true"><?php echo $reg->name; ?></option>
				<?php else : ?>
					<option value="<?php echo $reg->_id; ?>"><?php echo $reg->name; ?></option>
				<?php endif; ?>
			<?php endforeach ?>
		</select>

		<select name="province" id="province">
			<option value="">Select Provinces</option>
			<?php if(isset($loc)) : ?>
				<option value="<?php echo key($loc['province']) ?>" selected="true"><?php echo reset($loc['province']) ?></option>
			<?php endif ?>
		</select>
		<select name="city" id="city">
			<option value="">Select City/Municipality</option>
			<?php if(isset($loc)) : ?>
				<option value="<?php echo key($loc['city']) ?>" selected="true"><?php echo reset($loc['city']) ?></option>
			<?php endif ?>
		</select>
 </div>
</div>