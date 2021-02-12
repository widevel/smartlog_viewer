<?php

namespace Widevel\SmartlogViewer;

class Filter {
	const LIMIT_VALUES = [10,20,50,100,200,500,1000];
	
	const fields_defaults_values = [
		'limit' => 10,
		'date_from' => null,
		'date_to' => null,
		'view_type' => 'session',
		'sort' => 'desc',
	];
	
	public static function getValue(string $field_name) {
		if(array_key_exists($field_name, $_GET)) {
			return $_GET[$field_name];
		} else return array_key_exists($field_name, self::fields_defaults_values) ? self::fields_defaults_values[$field_name] : null;
	}
}