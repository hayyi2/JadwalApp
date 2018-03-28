<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('administrator'));

		$this->load->model('mahasiswa/student_model');
		$this->load->model('mahasiswa/volunteer_model');
		$this->load->model('izin/izin_model');
		$this->load->model('pendampingan/pendampingan_model');

	}
	
	public function index()
	{
		if (current_user_data('user_id') == 0) {
			redirect('user/login');
		}

		$params = array(
			'title' 			=> 'Dashboard', 
			'active_menu' 		=> 'dashboard', 
			'data_student' 		=> $this->student_model->gets_view(),
			'data_volunteer' 	=> $this->volunteer_model->gets_view(),
			'data_pendampingan'	=> $this->pendampingan_model->gets(),
			'data_izin' 		=> $this->izin_model->gets(),
			'data' 				=> $this->pendampingan_model->gets(array(), 'pendampingan_laporan'),
		);

		$this->load->view('header', $params);
		$this->load->view('dashboard', $params);
		$this->load->view('footer', $params);
	}
}
