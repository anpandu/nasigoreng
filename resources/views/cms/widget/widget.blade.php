@extends('cms.main')

@section('content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Show Widgets</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="dt" class="display" cellspacing="0" width="100%">
	        <thead>
	                <th>ID</th>
	                <th>Title</th>
	                <th>Metric</th>
	                <th>Visualization</th>
	                <th>Tools</th>
	        </thead>
	    </table>
	</div><!-- /.box-body -->
	<div class="box-footer"></div><!-- box-footer -->
</div><!-- /.box -->

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Add Widget</h3>
	</div>
	<div class="box-body">
		<form method="POST" action="{{Config::get('app.source_url')}}marketing_dashboard/widget_definition" class="form-horizontal" id="form_widget">
			<div class="form-group">
				<label for="input_title" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
					<input name="title" type="text" class="form-control" id="input_title" placeholder="Title">
				</div>
			</div>
			<div class="form-group">
				<label for="input_metric" class="col-sm-2 control-label">Metric</label>
				<div class="col-sm-10">
					<input name="metric" type="text" class="form-control" id="input_metric" placeholder="Metric">
				</div>
			</div>
			<div class="form-group">
				<label for="input_visualization" class="col-sm-2 control-label">Visualization</label>
				<div class="col-sm-10">
					<input name="visualization" type="text" class="form-control" id="input_visualization" placeholder="Visualization">
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
	$(document).ready(function() {
	    var table = $('#dt').dataTable( {
	    	"ajax": {
				"url": "{{Config::get('app.source_url')}}marketing_dashboard/widget_definition",
				"dataSrc": function ( json ) {

					res = json.map( function(item) {

						edit_link = '{{url('widget/edit')}}/' + item['id'];
						delete_link = '{{url('widget/delete')}}/' + item['id'];
						str = '';
						item['tools'] = 
						'<a href="' + edit_link + '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> ' + 
						'<a href="' + delete_link + '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';

						return item;
					});

					console.log(json);
					return json;
				}
			},
	        "columns": [
	            { "data": "id" },
	            { "data": "title" },
	            { "data": "metric" },
	            { "data": "visualization" },
	            { "data": "tools" }
	        ]
	    });
		$("#form_widget").submit(function(e) {
            e.preventDefault();
            var form = $(e.target);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(result) {
                    table.api().ajax.reload();
                }
            });
        });
	});
</script>

@endsection
