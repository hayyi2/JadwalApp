<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Majors_model extends CRUD_Model {
	protected $table_name = "majors";
	// protected $table_view_name = 'faculty_view';
	protected $primary_key = "majors_id";

	public function gets_faculty($id)
	{
		return parent::gets(array('where' => array('faculty_id' => $id)));
	}
}