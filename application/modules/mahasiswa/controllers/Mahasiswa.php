<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('administrator'));

		$this->load->model('student_model');
		$this->load->model('fakultas/faculty_model');
	}
	
	public function index()
	{
		$params = array(
			'title' 		=> 'Data Mahasiswa', 
			'active_menu' 	=> 'mahasiswa',
			'type'			=> 'mahasiswa',
			'data' 			=> $this->student_model->gets_view(),
		);

		$this->load->view('header', $params);
		$this->load->view('mahasiswa-list', $params);
		$this->load->view('footer', $params);
	}

	public function input()
	{
		$params = array(
			'title' 		=> 'Input Mahasiswa', 
			'active_menu' 	=> 'mahasiswa', 
			'mode'			=> 'add',
			'data_faculty'	=> $this->faculty_model->gets_view(),
			'type'			=> 'mahasiswa',
		);

		if ($post = $this->input->post()) {
			$required_post = array(
				'full_name'			=> "Nama Lengkap",
				'nick_name'			=> "Nama Panggilan",
				'majors_id'			=> "Jurusan",
				'class_of_college'	=> "Angkatan",
				'no_hp'				=> "No Hp",
			);

			$errors = array();
			$form_valid = true;

			if( !isset($post['username']) || !$post['username'] ){
				$errors[] 	= "NIM harus diisi.";
				$form_valid = false;
			} elseif( $this->user_model->username_exists($post['username']) ) {
				$errors[] 	= "NIM sudah ada yang menggunakan.";
				$form_valid = false;
			}

			if( !isset($post['password']) || !isset($post['repeat_password']) || !$post['password'] ) {
				$errors[] 	= "Kata sandi harus diisi.";
				$form_valid = false;
			} elseif( $post['password'] != $post['repeat_password'] ) {
				$errors[] 	= "Pengulangan password tidak sama.";
				$form_valid = false;
			}
			
			foreach (array_keys($required_post) as $key) {
				if (!in_array($key, array_keys($post)) || $post[$key] == "") {
					$errors[] 	= $required_post[$key] . " harus diisi.";
					$form_valid = false;
				}
			}

			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = $post;
			} else {
				$allowed_add = $this->user_model->editable_column;
				$data = array_input_filter($post, $allowed_add);
				$data['capability'] = 1; // administrator
				$insert_id = $this->user_model->create( $data );

				$allowed_add = $this->student_model->editable_column;
				$data = array_input_filter($post, $allowed_add);
				$data['user_id'] = $insert_id;
				$data['type'] = 1; // mahasiswa difabel
				$insert_id = $this->student_model->create( $data );

				set_message_flash('Data mahasiswa telah berhasil ditambah.', 'success');
				redirect('mahasiswa');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('mahasiswa-input', $params);
		$this->load->view('footer', $params);
	}

	public function edit($id = false)
	{
		$data = $this->student_model->get_view($id);
		if( !$data ){
			set_message_flash('Data mahasiswa tidak ditemukan.');
			redirect('mahasiswa');
		}

		$params = array(
			'title' 		=> 'Edit Mahasiswa', 
			'active_menu' 	=> 'mahasiswa', 
			'mode'			=> 'edit',
			'post'			=> (array)$data,
			'data_faculty'	=> $this->faculty_model->gets_view(),
			'type'			=> 'mahasiswa',
		);

		if ($post = $this->input->post()) {
			$required_post = array(
				'full_name'			=> "Nama Lengkap",
				'nick_name'			=> "Nama Panggilan",
				'majors_id'			=> "Jurusan",
				'class_of_college'	=> "Angkatan",
				'no_hp'				=> "No Hp",
			);

			$errors = array();
			$form_valid = true;

			if( !isset($post['username']) || !$post['username'] ){
				$errors[] 	= "NIM harus diisi.";
				$form_valid = false;
			} elseif( $data->username != $post['username'] && $this->user_model->username_exists($post['username']) ) {
				$errors[] 	= "NIM sudah ada yang menggunakan.";
				$form_valid = false;
			}

			if (isset($post['change_password'])) {
				if( !isset($post['password']) || !isset($post['repeat_password']) || !$post['password'] ) {
					$errors[] 	= "Kata sandi harus diisi.";
					$form_valid = false;
				} elseif( $post['password'] != $post['repeat_password'] ) {
					$errors[] 	= "Pengulangan password tidak sama.";
					$form_valid = false;
				}
			}else{
				if (isset($post['password'])) {
					unset($post['password']);
				}
			}

			foreach (array_keys($required_post) as $key) {
				if (!in_array($key, array_keys($post)) || $post[$key] == "") {
					$errors[] 	= $required_post[$key] . " harus diisi.";
					$form_valid = false;
				}
			}

			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = array_merge($params['post'], $post);
			} else {
				$allowed_add = $this->user_model->editable_column;
				$new_data = array_input_filter($post, $allowed_add);
				$insert_id = $this->user_model->update( $data->user_id, $new_data );

				$allowed_add = $this->student_model->editable_column;
				$new_data = array_input_filter($post, $allowed_add);
				$insert_id = $this->student_model->update( $id, $new_data );

				set_message_flash('Data mahasiswa telah berhasil ditambah.', 'success');
				redirect('mahasiswa');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('mahasiswa-input', $params);
		$this->load->view('footer', $params);
	}

	public function delete($id = false)
	{
		$data = $this->student_model->get_view($id);
		if( !$data ){
			set_message_flash('Data mahasiswa tidak ditemukan.');
			redirect('mahasiswa');
		}

		$this->user_model->delete( $data->user_id );
		set_message_flash('Data mahasiswa telah berhasil dihapus.', 'success');
		redirect('mahasiswa');
	}
}
