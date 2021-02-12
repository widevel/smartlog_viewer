<?php
chdir('..');
require_once 'common.php';
Widevel\SmartlogViewer\Auth::requireAuth();
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
<script defer src="node_modules/@fortawesome/fontawesome-free/js/brands.js"></script>
<script defer src="node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
<script defer src="node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<div class="container">
	<a class="navbar-brand" href="index.php">SmartLog Viewer
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	
</div>
</nav>
<!-- Page Content -->
<form method="GET">
<input type="hidden" name="page" value="<?=$filter_page?>" />
	<div class="container">
		<div class="row">
			<div class="col-lg-12 m-4">
				<h3 class="mb-4">Logs:</h3>
				<div class="card mb-4" style="width: 100%;">
					<div class="card-body">
						<div class="form-inline">
							<div class="form-group mr-4">
								<input type="datetime-local" class="form-control" name="date_from" value="<?=$filter_date_from?>">
							</div>
							<i class="fas fa-trash-alt mr-4" onclick="$('input[name=date_from]').val('');"></i>
							<div class="form-group mr-4">
								<input type="datetime-local" class="form-control" name="date_to" value="<?=$filter_date_to?>">
							</div>
							<i class="fas fa-trash-alt" onclick="$('input[name=date_to]').val('');"></i>
						</div>
						
					</div>
				</div>
				<div class="card mb-4" style="width: 100%;">
					<div class="card-body">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Instance</label>
							<input type="text" name="instance_token" class="form-control" value="<?=$filter_instance_token?>">
							<i class="fas fa-trash-alt" onclick="$('input[name=instance_token]').val('');"></i>
						</div>
						<div class="form-group col-md-6">
							<label>Session</label>
							<input type="text" name="session_token" class="form-control" value="<?=$filter_session_token?>">
							<i class="fas fa-trash-alt" onclick="$('input[name=session_token]').val('');"></i>
						</div>
					</div>
					</div>
				</div>
				<div class="card mb-4" style="width: 100%;">
					<div class="card-body">
						<div class="form-inline">
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
							<select class="form-control mr-4" name="limit">
								<?php foreach(Widevel\SmartlogViewer\Filter::LIMIT_VALUES as $limit) { ?>
								<option <?=$limit === $filter_limit ? 'selected' : ''?>><?=$limit?></option>
								<?php } ?>
							</select>
							<?php if($filter_view_type === 'log') { ?>
							<select class="form-control mr-4" name="level">
								<?php foreach(Widevel\SmartlogViewer\Filter::LEVEL_VALUES as $level => $label) { ?>
								<option <?=$level === $filter_level ? 'selected' : ''?> value="<?=$level?>"><?=$label?></option>
								<?php } ?>
							</select>
							<?php } ?>
							<button type="submit" class="btn btn-success mr-2">Submit</button>
							
						</div>
						
					</div>
				</div>
				<?php require_once $include_file_name; ?>
				<h6><?=$count?> records found</h6>
				<?php if($pagination->getPagesCount() > 1) { ?>
				<nav aria-label="Page navigation example">
					<ul class="pagination mt-4 flex-wrap">
						<?php if($filter_page > 1) { ?>
							<li class="page-item"><button class="page-link" onclick="setPrevPage();" type="button">Previous</button></li>
						<?php } ?>
						<?php for($p=1;$p<=$pagination->getPagesCount();$p++) { ?>
							<li class="page-item"><button class="page-link <?=$p==$filter_page?'font-weight-bold':''?>" onclick="setPage(<?=$p?>);" type="button"><?=$p?></button></li>
						<?php } ?>
						<?php if($filter_page < $pagination->getPagesCount()) { ?>
							<li class="page-item"><button class="page-link" onclick="setNextPage();" type="button">Next</button></li>
						<?php } ?>
					</ul>
				</nav>
				<?php } ?>
				<!-- /.card -->
			</div>
			<!-- /.col-lg-9 -->
		</div>
	</div>
</form>
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

var current_page = parseInt($("input[name=page]").val());

function setPrevPage() {
	setPage(current_page-1);
}

function setPage(p) {
	$("input[name=page]").val(p).parent().submit();
}

function setNextPage() {
	setPage(current_page+1);
}

$('.expand_text').click(function() {
	if($(this).hasClass('fulltexted')) {
		$(this).text($(this).attr('data-mintext')).removeClass('fulltexted');
	} else {
		$(this).attr('data-mintext', $(this).text()).text($(this).attr('data-fulltext')).addClass('fulltexted');
	}
});
function showLogsOfInstance(instance_token) {
    $('#view_type_log').prop('checked',true);
    $('input[name=instance_token]').val(instance_token);
    $('input[name=date_from], input[name=date_to]').val('');
    $('form').submit();
}

</script>
<style>
.expand_text {
	padding: 0;
}
</style>
</body>
</html>