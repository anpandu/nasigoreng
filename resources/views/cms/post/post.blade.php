@extends('cms.main')

@section('content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Show Projects</h3>
	</div>
	<div class="box-body">
		<table id="dt" class="display" cellspacing="0" width="100%">
	        <thead>
	                <th>ID</th>
	                <th>Title</th>
	                <th>Category</th>
	                <th>Tag</th>
	                <th>Published</th>
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
				"url": "{{url('post')}}",
				"dataSrc": function ( json ) {

					res = json.map( function(item) {

						item['category'] = item['category']['title'];

						tag_titles = item['tags'].map(function(x){return x['title'];});
						item['tags'] = (item['tags'].length>0) ? tag_titles.join(', ') : '-';
						link = "{{url('cms/post/edit')}}/" + item['id'];
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
	            { "data": "category" },
	            { "data": "tags" },
	            { "data": "created_at" },
	            { "data": "tools" }
	        ]
	    });
	});
</script>

@endsection