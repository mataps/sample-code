@extends('admin.layouts.master')

@section('content')
	<script src="/js/admin/ckeditor/ckeditor.js"></script>
	<div class="container">

		<div class="page-header">
			<h1>Region<small><i class="icon-double-angle-right"></i> Add</small></h1>
		</div>

    <div class="row">
    	@foreach ($errors->all('<div class="alert alert-danger">:message</div>') as $error)
    		{{ $error }}
    	@endforeach
			<div class="col-xs-12">
				<form class="form-horizontal" id="addNewArticle" role="form" method="post">
					<?php echo Form::token(); ?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="name">Name</label>
						<div class="col-sm-9">
							<input type="text" id="name" name="name" placeholder="Name" class="col-xs-10 col-sm-5" value="<?php echo Input::old('name') ?>">
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="screen_name">Screen Name</label>
						<div class="col-sm-9">
							<input type="text" id="screen_name" name="screen_name" placeholder="Screen Name" class="col-xs-10 col-sm-5" value="<?php echo Input::old('screen_name') ?>">
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="published">Published</label>
						<div class="col-sm-9">
							<input name="published"
							id="published" type="checkbox" <?php echo (Input::old('published')) ? 'checked="true"' : null; ?> >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="featured">Featured</label>
						<div class="col-sm-9">
							<input name="featured"
							id="featured" type="checkbox" <?php echo (Input::old('featured')) ? 'checked="true"' : null; ?> >
						</div>
					</div>


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

	<!-- media-browser -->
	@include('admin._partials.media-manager')
	<!-- ./media-browser -->
@stop