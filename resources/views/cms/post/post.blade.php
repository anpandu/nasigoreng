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
	                <th>Slug</th>
	                <th>Description</th>
	                <th>Category</th>
	                <th>Tag</th>
	                <th>Published</th>
	                <th>Tools</th>
	        </thead>
	    </table>
	</div>
	<div class="box-footer">
		<a href="{{url('cms/post/add')}}">
			<button class="btn btn-primary btn-block">ADD</button>
		</a>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#dt').dataTable( {
	    	"ajax": {
				"url": "{{url($endpoint)}}",
				"dataSrc": function ( json ) {

					res = json.map( function(item) {

						link = "{{url('cms/post/category')}}/" + item['category']['slug'];
						item['category'] = '<a href="' + link + '">' + item['category']['title'] + '</a>';

						tag_titles = item['tags'].map(function(x){
							link = "{{url('cms/post/tag')}}/" + x['slug'];
							return '<a href="' + link + '">' + x['title'] + '</a>';
						});
						item['tags'] = (item['tags'].length>0) ? tag_titles.join(', ') : '-';

						link = "{{url('cms/post/edit')}}/" + item['slug'];
						tool_edit = '<a href="' + link + '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
						tool_delete = '<a href="#" id="'+item['id']+'" class="button_delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
						item['tools'] = tool_edit + " " + tool_delete;


						return item;
					});

					console.log(json);
					return json;
				}
			},
	        "columns": [
	            { "data": "id" },
	            { "data": "title" },
	            { "data": "slug" },
	            { "data": "description" },
	            { "data": "category" },
	            { "data": "tags" },
	            { "data": "created_at" },
	            { "data": "tools" }
	        ],
	        "fnInfoCallback": function(oSettings, json) {
	        	table = this;
		    	$(".button_delete").click(function() {
		    		var item_id = $(this).prop('id');
		    		var delete_url = "{{url('post')}}/" + item_id;
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
	});
</script>

@endsection
