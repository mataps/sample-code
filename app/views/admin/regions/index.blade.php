@extends('admin.layouts.master')

@section('content')
	<div class="container">
		<div class="page-header">
			<span class="pull-right">
				<a href="/admin/regions/add" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;New</a>
				<br>
			</span>
			<h1>Regions<small><i class="icon-double-angle-right"></i> Manage</small></h1>
		</div>
		
		<table class="table table-hover">
			<tr>
				<th>Name</th>
				<th>Screen Name</th>
				<th>Featured</th>
				<th>Published</th>
				<th>Options</th>
			</tr>
			<?php foreach ($regions as $region) : ?>
			<tr>
				<td><?php echo $region->name; ?></td>
				<td><?php echo $region->screen_name; ?></td>
				<td>
					<div class="col-xs-3">
						<label>
							<input name="featured" class="ace ace-switch ace-switch-3" type="checkbox" <?php echo ($region->featured) ? 'checked="true"' : null; ?> data-url="stories/edit/<?php echo $region->_id; ?>">
							<span class="lbl"></span>
						</label>
					</div>
				</td>
				<td>
					<div class="col-xs-3">
						<label>
							<input name="published" class="ace ace-switch ace-switch-3" type="checkbox" <?php echo ($region->published) ? 'checked="true"' : null; ?> data-url="stories/edit/<?php echo $region->_id; ?>">
							<span class="lbl"></span>
						</label>
					</div>
				</td>
				<td style=" width: 150px;">
					<a href="/admin/regions/edit/<?php echo $region->_id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
					<a href="/admin/regions/delete/<?php echo $region->_id;?>" class="delete-btn btn-sm btn btn-danger"><i class="fa fa-times"></i></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<center> {{ is_object($regions) ? $regions->links() : null; }} </center>
	</div>
@stop