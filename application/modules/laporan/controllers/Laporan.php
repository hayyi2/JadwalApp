<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('administrator'));

		$this->load->model('pendampingan/pendampingan_model');
		$this->load->model('mahasiswa/volunteer_model');
	}
	
	public function index()
	{
		$params = array(
			'title' 		=> 'Data Pendampingan', 
			'active_menu' 	=> 'laporan',
			'volunteer' 	=> false,
			'data' 			=> $this->pendampingan_model->gets_view(),
		);

		$this->load->view('header', $params);
		$this->load->view('laporan-head', $params);
		$this->load->view('laporan-data', $params);
		$this->load->view('footer', $params);
	}
	public function volunteer()
	{
		$params = array(
			'title' 		=> 'Ringkasan Volunteer', 
			'active_menu' 	=> 'laporan',
			'data' 			=> $this->volunteer_model->gets(array(), 'volunteer_resume'),
			'volunteer' 	=> true,
		);
		$this->load->view('header', $params);
		$this->load->view('laporan-head', $params);
		$this->load->view('laporan-volunteer', $params);
		$this->load->view('footer', $params);
	}
}
