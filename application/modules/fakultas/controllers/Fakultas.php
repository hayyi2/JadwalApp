<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('administrator'));

		$this->load->model('faculty_model');
	}
	
	public function index()
	{
		$params = array(
			'title' 		=> 'Data Fakultas dan Jurusan', 
			'active_menu' 	=> 'fakultas',
			'data' 			=> $this->faculty_model->gets_view(),
		);

		$this->load->view('header', $params);
		$this->load->view('fakultas-list', $params);
		$this->load->view('footer', $params);
	}

	public function input()
	{
		$params = array(
			'title' 		=> 'Input Fakultas', 
			'active_menu' 	=> 'fakultas', 
			'mode'			=> 'add'
		);

		if ($post = $this->input->post()) {
			$errors = array();
			$form_valid = true;

			if( !isset($post['faculty_name']) || !$post['faculty_name'] ){
				$errors[] 	= "Nama fakultas harus diisi.";
				$form_valid = false;
			}
			
			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = $post;
			} else {
				$new_data['faculty_name'] = $post['faculty_name'];
				$insert_id = $this->faculty_model->create( $new_data );

				set_message_flash('Data fakultas telah berhasil ditambah.', 'success');
				redirect('fakultas');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('fakultas-input', $params);
		$this->load->view('footer', $params);
	}

	public function edit($id = false)
	{
		$data = $this->faculty_model->get($id);
		if( !$data ){
			set_message_flash('Data fakultas tidak ditemukan.');
			redirect('fakultas');
		}

		$params = array(
			'title' 		=> 'Edit Fakultas', 
			'active_menu' 	=> 'fakultas', 
			'mode'			=> 'edit',
			'post' 			=> (array)$data,
		);

		if ($post = $this->input->post()) {
			$errors = array();
			$form_valid = true;

			if( !isset($post['faculty_name']) || !$post['faculty_name'] ){
				$errors[] 	= "Nama fakultas harus diisi.";
				$form_valid = false;
			}

			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = array_merge($params['post'], $post);
			} else {
				$new_data['faculty_name'] = $post['faculty_name'];
				$insert_id = $this->faculty_model->update( $id, $new_data );

				set_message_flash('Data fakultas telah berhasil ditambah.', 'success');
				redirect('fakultas');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('fakultas-input', $params);
		$this->load->view('footer', $params);
	}

	public function delete($id = false)
	{
		$data = $this->faculty_model->get($id);
		if( !$data ){
			set_message_flash('Data fakultas tidak ditemukan.');
			redirect('fakultas');
		}

		$this->faculty_model->delete( $id );
		set_message_flash('Data fakultas telah berhasil dihapus.', 'success');
		redirect('fakultas');
	}
}
