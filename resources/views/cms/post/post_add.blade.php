@extends('cms.main')

@section('content')

<link href="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Add Post</h3>
	</div>
	<div class="box-body">
		<form method="POST" action="{{url('/cms/post/store')}}" class="form-horizontal" id="form_role">
			<input type="hidden" name="user_id" value="{{$user_id}}"/>
			<div class="form-group">
				<label for="input_title" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
					<input name="title" type="text" class="form-control" id="input_title" placeholder="Title" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="input_slug" class="col-sm-2 control-label">Slug</label>
				<div class="col-sm-10">
					<input name="slug" type="text" class="form-control" id="input_slug" placeholder="Slug" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="input_header_image" class="col-sm-2 control-label">Image</label>
				<div class="col-sm-10">
					<input name="header_image" type="text" class="form-control" id="input_header_image" placeholder="Image" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="input_category" class="col-sm-2 control-label">Categories</label>
				<div class="col-sm-10">
					<select name="category_id" class="form-control" id="input_category">
						@foreach ($categories as $category)
							<option value="{{$category->id}}">{{$category->title}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="input_tag" class="col-sm-2 control-label">Tags</label>
				<div class="col-sm-10">
					<div class="checkbox" id="input_tag">
						@foreach ($tags as $tag)
							<label>
								<input type="checkbox" name="tags[]" value="{{$tag->id}}">{{$tag->title}}<br>
							</label>
							<br>
						@endforeach
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="input_content" class="col-sm-2 control-label">Content</label>
				<div class="col-sm-10">
					<textarea name="content" id="input_content" placeholder="Content" class="form-control" rows="20"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">ADD</button>
				</div>
			</div>
		</form>
	</div>
	<div class="box-footer"></div>
</div>

<script type="text/javascript">
	$('#input_content').wysihtml5();
</script>

@endsection
