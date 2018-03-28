<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin_model extends CRUD_Model {
	protected $table_name = "permit";
	protected $table_view_name = 'permit_view';
	protected $primary_key = "permit_id";
}