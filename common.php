<?php
require_once __DIR__ . './debug_config.php';
require_once __DIR__ . '/vendor/autoload.php';

$filter_limit = Widevel\SmartlogViewer\Filter::getValue('limit');
$filter_date_from = Widevel\SmartlogViewer\Filter::getValue('date_from');
$filter_date_to = Widevel\SmartlogViewer\Filter::getValue('date_to');
$filter_view_type = Widevel\SmartlogViewer\Filter::getValue('view_type');
$filter_sort = Widevel\SmartlogViewer\Filter::getValue('sort');

$mongo_client = new MongoDB\Client;

if($filter_view_type === 'session') {
	$sessions_fetch = $mongo_client->smartlog->session->find();
	
	//print_r($sessions_fetch);
}

