<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_volunteer_model extends CRUD_Model {
	protected $table_name = "schedule_volunteer";
	protected $table_view_name = 'schedule_volunteer_view';
	protected $primary_key = "schedule_volunteer_id";

	public $editable_column = array(
		'start_at',
		'end_at',
		'day',
		'clarification',
	);

	public function check_scadule($student_id, $day, $start_at, $end_at)
	{
		$where_string = "student_id = " . $student_id . " and day = " . $day; 
		$where_start = "start_at < '" . $start_at . "' and end_at > '" . $start_at . "'"; 
		$where_end = "start_at < '" . $end_at . "' and end_at > '" . $end_at . "'"; 
		$where_in = "start_at >= '" . $start_at . "' and end_at <= '" . $end_at . "'"; 

		$where = $where_string . " and " . 
			$where_start . " or " .  
			$where_string . " and " . 
			$where_end . " or " .  
			$where_string . " and " . 
			$where_in; 

		$args = array('where' => array($where), );
		return parent::get_view($args);
	}
}