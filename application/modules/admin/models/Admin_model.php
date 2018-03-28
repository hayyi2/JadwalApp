<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CRUD_Model {
	protected $table_name = "users";
	protected $table_view_name = 'admin_view';
	protected $primary_key = "user_id";
}