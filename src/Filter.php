<?php

namespace Widevel\SmartlogViewer;

class Filter {
	const LIMIT_VALUES = [5, 10,20,50,100,200,500,1000];

	const LEVEL_VALUES = [
		-1 => 'All',
		1 => 'ERROR',
		2 => 'WARNING',
		3 => 'DEBUG',
		4 => 'INFO'
	];
	
	const fields_defaults_values = [
		'limit' => 5,
		'date_from' => null,
		'date_to' => null,
		'view_type' => 'session',
		'sort' => 'desc',
		'page' => 1,
		'level' => -1,
	];

	const fields_allowed_values = [
		'limit' => self::LIMIT_VALUES,
		'view_type' => ['session', 'instance', 'log'],
		'sort' => ['desc', 'asc'],
	];

	const fields_cast = [
		'limit' => 'int',
		'page' => 'int',
		'level' => 'int',
	];
	
	public static function getValue(string $field_name) {
		if(array_key_exists($field_name, $_GET)) {
			$value = $_GET[$field_name];
			if(array_key_exists($field_name, self::fields_cast)) settype($value, self::fields_cast[$field_name]);
			return (array_key_exists($field_name, self::fields_allowed_values) && in_array($value, self::fields_allowed_values[$field_name])) || !array_key_exists($field_name, self::fields_allowed_values) ? $value : null;
		} else return array_key_exists($field_name, self::fields_defaults_values) ? self::fields_defaults_values[$field_name] : null;
	}
}