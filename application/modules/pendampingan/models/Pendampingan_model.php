<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendampingan_model extends CRUD_Model {
	protected $table_name = "accompaniment";
	protected $table_view_name = 'accompaniment_view';
	protected $primary_key = "accompaniment_id";
	
	public $editable_column = array(
		'schedule_student_id',
		'volunteer_id',
		'date',
	);
}