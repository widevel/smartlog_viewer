<?php
require_once __DIR__ . './debug_config.php';
require_once __DIR__ . '/vendor/autoload.php';

$filter_limit = Widevel\SmartlogViewer\Filter::getValue('limit');
$filter_date_from = Widevel\SmartlogViewer\Filter::getValue('date_from');
$filter_date_to = Widevel\SmartlogViewer\Filter::getValue('date_to');
$filter_view_type = Widevel\SmartlogViewer\Filter::getValue('view_type');
$filter_sort = Widevel\SmartlogViewer\Filter::getValue('sort');
$filter_page = Widevel\SmartlogViewer\Filter::getValue('page');
$filter_level = Widevel\SmartlogViewer\Filter::getValue('level');
$filter_session_token = Widevel\SmartlogViewer\Filter::getValue('session_token');
$filter_instance_token = Widevel\SmartlogViewer\Filter::getValue('instance_token');

$mongo_client = new MongoDB\Client;


$pagination = new Widevel\SmartlogViewer\Pagination($filter_limit, $filter_page);


$include_file_name = __DIR__ . '/data_view/' . $filter_view_type . '.php';

$where = [];

if($filter_session_token) {
	$where['session_token'] = $filter_session_token;
}

if($filter_instance_token) {
	$where['instance_token'] = $filter_instance_token;
}

if($filter_level > -1 && $filter_view_type === 'log') $where['level'] = $filter_level;

if($filter_date_from) {
	$where['date'] = ['$gte' => new \MongoDB\BSON\UTCDateTime(strtotime($filter_date_from) * 1000)];
}

if($filter_date_to) {
	$where_date_to = ['$lte' => new \MongoDB\BSON\UTCDateTime(strtotime($filter_date_to) * 1000)];
	if(array_key_exists('date', $where)) {
		$where['date'] = array_merge($where['date'], $where_date_to);
	} else {
		$where['date'] = $where_date_to;
	}
}

$options = [
	'skip' => $pagination->getMongoSkip(),
	'limit' => $filter_limit,
	'sort' => ['_id' => ($filter_sort == 'asc' ? 1 : -1)]
];

$count = $mongo_client->smartlog->$filter_view_type->count($where);

$iterator = $mongo_client->smartlog->$filter_view_type->find($where, $options);

$pagination->setCount($count);




