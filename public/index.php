<?php
chdir('..');
require_once 'common.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>SmartLog Viewer</title>
<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/shop-item.css" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<div class="container">
	<a class="navbar-brand" href="#">SmartLog Viewer
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
			<a class="nav-link" href="#">Logout</a>
			</li>
		</ul>
	</div>
</div>
</nav>
<!-- Page Content -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 m-4">
			<h3 class="mb-4">Logs:</h3>
			<div class="card mb-4" style="width: 100%;">
				<div class="card-body">
					<form class="form-inline">
						<select class="form-control mr-4" name="limit">
							<?php foreach(Widevel\SmartlogViewer\Filter::LIMIT_VALUES as $limit) { ?>
							<option <?=$limit === $filter_limit ? 'selected' : ''?>><?=$limit?></option>
							<?php } ?>
						</select>
						<div class="form-group mr-4">
							<input type="datetime-local" class="form-control" name="date_from" value="<?=$filter_date_from?>">
						</div>
						<div class="form-group mr-4">
							<input type="datetime-local" class="form-control" name="date_to" value="<?=$filter_date_to?>">
						</div>
					</form>
					
				</div>
			</div>
			<div class="card mb-4" style="width: 100%;">
				<div class="card-body">
					<form class="form-inline">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="view_type" value="session" id="view_type_session" <?=$filter_view_type === 'session' ? 'checked' : ''?>>
							<label class="form-check-label" for="view_type_session">Session</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="view_type" value="instance" id="view_type_instance" <?=$filter_view_type === 'instance' ? 'checked' : ''?>>
							<label class="form-check-label" for="view_type_instance">Instance</label>
						</div>
						<div class="form-check form-check-inline mr-4">
							<input class="form-check-input" type="radio" name="view_type" value="log" id="view_type_log" <?=$filter_view_type === 'log' ? 'checked' : ''?>>
							<label class="form-check-label" for="view_type_log">Log</label>
						</div>
						<div class="form-check form-check-inline ml-4">
							<input class="form-check-input" type="radio" name="sort" value="desc" id="sort_desc" <?=$filter_sort === 'desc' ? 'checked' : ''?>>
							<label class="form-check-label" for="sort_desc">Desc</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sort" value="asc" id="sort_asc" <?=$filter_sort === 'asc' ? 'checked' : ''?>>
							<label class="form-check-label" for="sort_asc">Asc</label>
						</div>
						<button type="button" onclick="onFilterSubmit(this);" class="btn btn-primary" id="filter_submit">Filter</button>
						
					</form>
					
				</div>
			</div>
			<div id="ajax_content">
			</div>
			
			<!-- /.card -->
		</div>
		<!-- /.col-lg-9 -->
	</div>
</div>
<!-- /.container -->
<!-- Footer -->
<footer class="py-5 bg-dark">
<div class="container">
	<p class="m-0 text-center text-white">
		
	</p>
</div>
<!-- /.container -->
</footer>
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
function onFilterSubmit(e = null) {
	if(e != null) $(e).prop('disabled', true);
	
	var jqxhr = $.get( "filter.php", {'test' : 1}, function(html) {
		$('#ajax_content').html(html);
	})
	.fail(function() {
		alert( "error" );
	})
	.always(function() {
		if(e != null) $(e).prop('disabled', false);
	});
}

onFilterSubmit();
</script>
</body>
</html>