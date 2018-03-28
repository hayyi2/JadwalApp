<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('administrator'));

		$this->load->model('faculty_model');
		$this->load->model('majors_model');
	}
	
	public function input($id = false)
	{
		$params = array(
			'title' 		=> 'Input Jurusan', 
			'active_menu' 	=> 'fakultas', 
			'mode'			=> 'add',
			'data_fakultas'	=> $this->faculty_model->gets(),
			'id'			=> $id,
		);

		if ($post = $this->input->post()) {
			$errors = array();
			$form_valid = true;

			if( !isset($post['faculty_id']) || !$post['faculty_id'] || 
				!($this->faculty_model->get($post['faculty_id'])) ){
				$errors[] 	= "Fakultas tidak ditemukan.";
				$form_valid = false;
			}
			
			if( !isset($post['majors_name']) || !$post['majors_name'] ){
				$errors[] 	= "Nama jurusan harus diisi.";
				$form_valid = false;
			}
			
			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = $post;
			} else {
				$new_data['faculty_id'] = $post['faculty_id'];
				$new_data['majors_name'] = $post['majors_name'];
				$insert_id = $this->majors_model->create( $new_data );

				set_message_flash('Data fakultas telah berhasil ditambah.', 'success');
				redirect('fakultas');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('jurusan-input', $params);
		$this->load->view('footer', $params);
	}

	public function edit($id = false)
	{
		$data = $this->majors_model->get($id);
		if( !$data ){
			set_message_flash('Data jurusan tidak ditemukan.');
			redirect('fakultas');
		}

		$params = array(
			'title' 		=> 'Edit Jurusan', 
			'active_menu' 	=> 'fakultas', 
			'mode'			=> 'edit',
			'data_fakultas'	=> $this->faculty_model->gets(),
			'post' 			=> (array)$data,
		);

		if ($post = $this->input->post()) {
			$errors = array();
			$form_valid = true;

			if( !isset($post['faculty_id']) || !$post['faculty_id'] || 
				!($this->faculty_model->get($post['faculty_id'])) ){
				$errors[] 	= "Fakultas tidak ditemukan.";
				$form_valid = false;
			}
			
			if( !isset($post['majors_name']) || !$post['majors_name'] ){
				$errors[] 	= "Nama jurusan harus diisi.";
				$form_valid = false;
			}
			

			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = array_merge($params['post'], $post);
			} else {
				$new_data['faculty_id'] = $post['faculty_id'];
				$new_data['majors_name'] = $post['majors_name'];
				$insert_id = $this->majors_model->update( $id, $new_data );

				set_message_flash('Data fakultas telah berhasil ditambah.', 'success');
				redirect('fakultas');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('jurusan-input', $params);
		$this->load->view('footer', $params);
	}

	public function delete($id = false)
	{
		$data = $this->majors_model->get($id);
		if( !$data ){
			set_message_flash('Data fakultas tidak ditemukan.');
			redirect('fakultas');
		}
		
		$this->majors_model->delete( $id );
		set_message_flash('Data fakultas telah berhasil dihapus.', 'success');
		redirect('fakultas');
	}
}
