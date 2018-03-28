<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('administrator'));

		$this->load->model('izin_model');
	}
	
	public function index()
	{
		$params = array(
			'title' 		=> 'Data Surat Izin', 
			'active_menu' 	=> 'surat-izin', 
			'volunteer' 	=> false,
			'data' 			=> $this->izin_model->gets_view(),
		);

		$this->load->view('header', $params);
		$this->load->view('izin-list', $params);
		$this->load->view('footer', $params);
	}

	public function delete($id = false)
	{
		$data = $this->izin_model->get($id);
		if( !$data ){
			set_message_flash('Data surat izin tidak ditemukan.');
			redirect('izin');
		}

		$this->izin_model->delete( $id );
		set_message_flash('Data surat izin telah berhasil dihapus.', 'success');
		redirect('izin');
	}
}
