@extends('admin.layouts.master')

@section('content')
	<div class="container">
		<div class="page-header">
			<span class="pull-right">
				<a href="/admin/articles/add" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;New</a>
				<br>
			</span>
			<h1>Article<small><i class="icon-double-angle-right"></i> Manage</small></h1>
		</div>
		
		<table class="table table-hover">
			<tr>
				<th>Title</th>
				<th>Category</th>
				<th>Featured</th>
				<th>Published</th>
				<th>Options</th>
			</tr>
			<?php foreach ($articles as $article) : ?>
			<tr>
				<td><?php echo $article->title; ?></td>
				<td><?php echo $article->category; ?></td>
				<td>
					<div class="col-xs-3">
						<label>
							<input name="featured" class="ace ace-switch ace-switch-3" type="checkbox" <?php echo ($article->featured) ? 'checked="true"' : null; ?> data-url="stories/edit/<?php echo $article->_id; ?>">
							<span class="lbl"></span>
						</label>
					</div>
				</td>
				<td>
					<div class="col-xs-3">
						<label>
							<input name="published" class="ace ace-switch ace-switch-3" type="checkbox" <?php echo ($article->published == 'on') ? 'checked="true"' : null; ?> data-url="stories/edit/<?php echo $article->_id; ?>">
							<span class="lbl"></span>
						</label>
					</div>
				</td>
				<td style=" width: 150px;">
					<a href="/admin/articles/edit/<?php echo $article->_id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
					<a href="/admin/articles/delete/<?php echo $article->_id;?>" class="delete-btn btn-sm btn btn-danger"><i class="fa fa-times"></i></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<center> {{ is_object($articles) ? $articles->links() : null; }} </center>
	</div>
@stop