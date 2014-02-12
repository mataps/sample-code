@extends('admin.layouts.master')

@section('content')
	<script src="/js/admin/ckeditor/ckeditor.js"></script>
	<div class="container">

		<div class="page-header">
			<h1>Article<small><i class="icon-double-angle-right"></i> Manage</small></h1>
		</div>

    <div class="row">
    	@foreach ($errors->all('<div class="alert alert-danger">:message</div>') as $error)
    		{{ $error }}
    	@endforeach
			<div class="col-xs-12">
				<form class="form-horizontal" id="addNewArticle" role="form" method="post">
					<?php echo Form::token(); ?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="title">Title</label>
						<div class="col-sm-9">
							<input type="text" id="title" name="title" placeholder="Title" class="col-xs-10 col-sm-5" value="<?php echo Input::old('title') ?>">
						</div>
					</div>
					<div class="space-4"></div>

					<!-- Region Select -->
					@include('admin._partials.regions_select')
					<!-- ./Region Select -->
				
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="tags">Category</label>
					 	<div class="col-sm-9">
					 	{{ Form::select('category', Config::get('general.categories'), Input::old('category')) }}
						</div>
				 	</div>
					<div class="space-4"></div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="tags">Tags</label>
						<div class="col-sm-9">
							<input type="text" id="form-field-tags" placeholder="Enter tags ..." name="tags" value="<?php echo Input::old('tags') ?>">
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
									<span class="file-name" data-title="Insert File from server..."><i class="icon-folder-open-alt"></i>
									</span>
								</label>
								<a class="remove" href="#"><i class="icon-remove"></i></a>
							</div>
							<!-- Uploader -->
							<div id="uploader"></div>
							<!-- ./uploader -->
						</div>
					</div>
					<div class="space-4"></div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="content-editor">Excerpt</label>
						<div class="col-sm-9">
							<textarea id="excerpt1" name="excerpt" rows="10" cols="80"><?php echo Input::old('excerpt') ?></textarea>
							<script>
									// Replace the <textarea id="editor1"> with a CKEditor
									// instance, using default configuration.
									CKEDITOR.replace( 'excerpt1' );
							</script>
						</div>
					</div>
					<div class="space-4"></div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="content-editor">Content</label>
						<div class="col-sm-9">
							<textarea id="editor1" name="content" rows="10" cols="80"><?php echo Input::old('content') ?></textarea>
							<script>
									// Replace the <textarea id="editor1"> with a CKEditor
									// instance, using default configuration.
									CKEDITOR.replace( 'editor1' );
							</script>
						</div>
					</div>
					<div class="space-4"></div>

					<!-- map -->
					@include('admin._partials.map')
					<!-- ./map -->

					<div class="form-group text-center">
						<input type="submit" class="btn btn-primary">
					</div>
				</form>
				<!-- ./Form -->
			</div>
			<!-- ./Col-xs -->
		</div>
		<!-- ./row -->
	</div>
@stop