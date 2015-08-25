@extends('cms.main')

@section('content')



<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Edit Tag</h3>
	</div>
	<div class="box-body">
		<form method="POST" action="{{url('/cms/tag/update/'.$tag->id)}}" class="form-horizontal" id="form_role">
			<input type="hidden" name="id" value="{{$tag->id}}"/>
			<div class="form-group">
				<label for="input_title" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
					<input name="title" type="text" class="form-control" id="input_title" placeholder="Title" value="{{$tag->title}}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">EDIT</button>
				</div>
			</div>
		</form>
	</div>
	<div class="box-footer"></div>
</div>

@endsection
