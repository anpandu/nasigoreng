@extends('cms.main')

@section('content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Add Tag</h3>
	</div>
	<div class="box-body">
		<form method="POST" action="{{url('/tag')}}" class="form-horizontal" id="form_tag">
			<div class="input-group margin">
                <input name="title" id="input_title" type="text" class="form-control">
                <span class="input-group-btn">
                	<button type="submit" class="btn btn-primary" type="button">ADD</button>
                </span>
            </div>
		</form>
	</div>
	<div class="box-footer"></div>
</div>

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Show Tags</h3>
	</div>
	<div class="box-body">
		<table id="dt" class="display" cellspacing="0" width="100%">
	        <thead>
	                <th>ID</th>
	                <th>Title</th>
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
				"url": "{{url('tag')}}",
				"dataSrc": function ( json ) {

					res = json.map( function(item) {

						link = "{{url('cms/tag/edit')}}/" + item['id'];
						item['tools'] = '<a href="' + link + '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';

						return item;
					});

					console.log(json);
					return json;
				}
			},
	        "columns": [
	            { "data": "id" },
	            { "data": "title" },
	            { "data": "tools" }
	        ]
	    });
		$('#form_tag').submit(function(e) {
            e.preventDefault();
            var form = $(e.target);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(result) {
                	$('#input_title').val('');
                    table.api().ajax.reload();
                }
            });
        });
	});
</script>

@endsection
