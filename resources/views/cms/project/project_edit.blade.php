@extends('cms.main')

@section('content')



<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Edit Project</h3>
	</div>
	<div class="box-body">
		<form method="POST" action="{{url('/project/update/'.$project->id)}}" class="form-horizontal" id="form_role">
			<input type="hidden" name="id" value="{{$project->id}}"/>
			<div class="form-group">
				<label for="input_title" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
					<input name="title" type="text" class="form-control" id="input_title" placeholder="Title" value="{{$project->title}}">
				</div>
			</div>
			<div class="form-group">
				<label for="input_title" class="col-sm-2 control-label">Max Quota</label>
				<div class="col-sm-10">
					<input name="object_quota" type="text" class="form-control" id="input_object_quota" placeholder="Quota" value="{{$project->object_quota}}">
				</div>
			</div>
			<div class="form-group">
				<label for="input_title" class="col-sm-2 control-label">Expired</label>
				<div class="col-sm-10">
					<input name="expired" type="text" class="form-control" id="input_expired" placeholder="Expired" value="{{$project->expired}}">
				</div>
			</div>
			<div class="form-group">
				<label for="input_title" class="col-sm-2 control-label">Widgets</label>
				<div class="col-sm-10">
					<div class="checkbox">
							@foreach ($widgets as $widget)
								<label>
									<input type="checkbox" name="widgets[]" value="{{$widget->id}}" {{$widget->available ? 'checked' : ''}}>{{$widget->title}}<br>
								</label>
								<br>
							@endforeach
					</div>
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


<script src="{{ asset('/plugins/datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('/plugins/datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

<script type="text/javascript">
	$(function () {
		$('#input_expired').datepicker({
			format: 'yyyy-mm-dd'
		});
	});
</script>

@endsection
