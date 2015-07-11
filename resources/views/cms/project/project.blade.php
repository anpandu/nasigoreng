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
	                <th>Companies</th>
	                <th>Available Objects (Quota)</th>
	                <th>Widgets</th>
	                <th>Expired</th>
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
				"url": "{{Config::get('app.source_url')}}marketing_dashboard/project",
				"dataSrc": function ( json ) {

					res = json.map( function(item) {

						p = item['object_quota_left'];
						q = item['object_quota'];
						n = 100 * p / q;
						n = Math.floor(n);

						item['quota'] = '<div class="progress-bar" role="progressbar" aria-valuenow="'+n+'" aria-valuemin="0" aria-valuemax="100" style="width: '+n+'%;">'+p+' of '+q+'</div>';

						obj_titles = item['objects'].map(function(x){return x['content'];});
						item['objects'] = (item['objects'].length>0) ? obj_titles.join('') : '-';

						com_titles = item['companies'].map(function(x){return '<span class="label label-info" style="padding:7px;">'+x['company_name']+'</span>';});
						item['companies'] = (item['companies'].length>0) ? com_titles.join('') : '-';

						tag_titles = item['tags'].map(function(x){return x['title'];});
						item['tags'] = (item['tags'].length>0) ? tag_titles.join(', ') : '-';

						widget_titles = item['widgets'].map(function(x){return '<span class="label label-info" style="padding:7px;margin-bottom:1px;display:inline-block">'+x['title']+'</span>';});
						item['widgets'] = (item['widgets'].length>0) ? widget_titles.join(' ') : '-';

						link = '{{url('project/edit')}}/' + item['id'];
						item['tools'] = '<a href="' + link + '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';

						// item['expired'] = $.datepicker.parseDate('yy-mm-dd', item['expired']);


						return item;
					});

					console.log(json);
					return json;
				}
			},
	        "columns": [
	            { "data": "id" },
	            { "data": "title" },
	            { "data": "companies" },
	            { "data": "quota" },
	            { "data": "widgets" },
	            { "data": "expired" },
	            { "data": "tools" }
	        ]
	    });
	});
</script>

@endsection
