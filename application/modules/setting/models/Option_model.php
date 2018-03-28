<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option_model extends CRUD_Model {
	protected $table_name = "options";
	protected $primary_key = "option_id";

	public $editable_column = array(
		'option_key',
		'option_value',
	);

	public function get_value($key)
	{
		$data = parent::get(array('where' => array('option_key' => $key)));
		return ($data) ? $data->option_value : "";
	}

	public function get_id($key, $value)
	{
		$data = parent::get(array(
			'where' => array(
				'option_key' 	=> $key,
				'option_value' => $value,
			)
		));
		return ($data) ? $data->option_id : false;
	}

	public function gets_data_id($option_id)
	{
		return parent::gets(array('where_in' => array('option_id' => $option_id)));
	}

	public function gets_value($key)
	{
		$data = parent::gets(array(
			'select' => array('option_id', 'value'),
			'where' => array('option_key' => $key),
		));
		return $data;
	}

	public function check_isset_key($key)
	{
		if (!parent::get(array('where' => array('option_key' => $key)))) {
			return false;
		}
		return true;
	}

	public function set_value($key, $value)
	{
		return parent::create(array('option_key' => $key, 'option_value' => $value));
	}

	public function change_value($key, $value)
	{
		return parent::update(array('option_key' => $key), array('option_value' => $value));
	}
}