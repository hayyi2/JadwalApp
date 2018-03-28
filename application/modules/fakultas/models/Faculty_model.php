<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty_model extends CRUD_Model {
	protected $table_name = "faculties";
	protected $table_view_name = 'faculty_view';
	protected $primary_key = "faculty_id";
}