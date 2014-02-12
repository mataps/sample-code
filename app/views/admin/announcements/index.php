<div class="container">
<div class="page-header">
	<span class="pull-right">
		<a href="announcements/add" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;New</a><br>
	</span>
	<h1>Announcements <small><i class="icon-double-angle-right"></i> Manage</small></h1>
</div>
	<table class="table table-hover">
		<tr>
			<th>Title</th>
			<th>Featured</th>
			<th>Published</th>
			<th>Options</th>
		</tr>
		<?php foreach ($announcements as $item) : ?>
		<tr>
			<td><?php echo $item->getTitle(); ?></td>
			<td>
				<div class="col-xs-3">
					<label>
						<input name="featured" class="ace ace-switch ace-switch-3" type="checkbox" <?php echo ($item->featured) ? 'checked="true"' : null; ?> data-url="announcements/edit/<?php echo $item->_id; ?>">
						<span class="lbl"></span>
					</label>
				</div>
			</td>
			<td>
				<div class="col-xs-3">
					<label>
						<input name="published" class="ace ace-switch ace-switch-3" type="checkbox" <?php echo ($item->published) ? 'checked="true"' : null; ?> data-url="announcements/edit/<?php echo $item->_id; ?>">
						<span class="lbl"></span>
					</label>
				</div>
			</td>
			<td><a href="announcements/edit/<?php echo $item->_id; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>&nbsp;<a href="announcements/delete/<?php echo $item->_id; ?>" class="delete-btn btn btn-danger"><i class="fa fa-times"></i></a></td>
		</tr>
		<?php endforeach; ?>
		<?php echo Form::token() ?>
	</table>
<center>
	<?php echo Pagination::render(Announcement::count(), 10); ?>
</center>
</div>