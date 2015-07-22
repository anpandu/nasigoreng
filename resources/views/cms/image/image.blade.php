@extends('cms.main')

@section('content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Add Image</h3>
	</div>
	<div class="box-body">

		<div id="error_message" class="alert alert-danger" style="display:none"></div>

		<form method="POST" action="{{url('/image')}}" class="form-horizontal" id="form_image" enctype="multipart/form-data">
			<div class="form-group">
				<label for="input_title" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
					<input name="title" type="text" class="form-control" id="input_title" placeholder="Title" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="input_description" class="col-sm-2 control-label">File</label>
				<div class="col-sm-10">
					<input name="image" type="file" class="form-control" id="input_file" placeholder="File" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="input_description" class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<input name="description" type="text" class="form-control" id="input_description" placeholder="Description" value="">
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

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Show Images</h3>
	</div>
	<div class="box-body">
		<table id="dt" class="display" cellspacing="0" width="100%">
	        <thead>
	                <th>ID</th>
	                <th>Title</th>
	                <th>File Name</th>
	                <th>Tools</th>
	        </thead>
	    </table>
	</div>
	<div class="box-footer"></div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#dt').dataTable( {
	    	"ajax": {
				"url": "{{url('image')}}",
				"dataSrc": function ( json ) {

					res = json.map( function(item) {
						
						item['filename'] = '<img src="' + "{{url('../storage/app/images').'/'}}" + item['filename'] + '" style="max-width:300px;">';


						link = "{{url('cms/image/edit')}}/" + item['id'];
						tool_edit = '<a href="' + link + '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
						tool_delete = '<a href="#" id="'+item['id']+'" class="button_delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
						item['tools'] = tool_edit + " " + tool_delete;

						return item;
					});

					return json;
				}
			},
	        "columns": [
	            { "data": "id" },
	            { "data": "title" },
	            { "data": "filename" },
	            { "data": "tools" }
	        ],
	        "fnInfoCallback": function(oSettings, json) {
	        	table = this;
		    	$(".button_delete").click(function() {
		    		var item_id = $(this).prop('id');
		    		var delete_url = "{{url('image')}}/" + item_id;
				 	$.ajax({
			            url: delete_url,
			            type: 'DELETE',
			            success: function(result) {
			            	table.api().ajax.reload();
			            }
			        });
				});
		    }
	    });
		$('#form_image').submit(function(e) {
            e.preventDefault();
            var form = $(e.target);
   			var formData = new FormData($(this)[0]); 

   			if ($('#input_file')[0].files[0].size > 2200000)
            	$('#error_message').css('display', 'block').html('file size must be < 2MB');
            else {
	            $.ajax({
	                url: form.attr('action'),
	                type: 'POST',
	                data: formData,
					processData: false,
					contentType: false,
	                success: function(result) {
	                	$('#input_title').val('');
	                	$('#input_description').val('');
	                	$('#error_message').css('display', 'none').html('');
	                    table.api().ajax.reload();
	                },
	                error: function(e) {
	                	var err_msg = e.responseJSON.message;
	                	$('#error_message').css('display', 'block').html(err_msg);
	                }
	            });
            }
        });
	});
</script>

@endsection
