<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer_model extends CRUD_Model {
	protected $table_name = "students";
	protected $table_view_name = 'volunteer_view';
	protected $primary_key = "student_id";

	public $editable_column = array(
		'majors_id',
		'class_of_college',
		'no_hp',
	);

	public function update($id, $data)
	{
		$data['token'] = "";
		parent::update($id, $data);
	}
}