<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");

		protected_page(array('administrator'));

		$this->load->model('admin_model');
	}
	
	public function index()
	{
		$params = array(
			'title' 		=> 'Data Administrator', 
			'active_menu' 	=> 'administrator',
			'data' 			=> $this->admin_model->gets_view(),
		);

		$this->load->view('header', $params);
		$this->load->view('admin-list', $params);
		$this->load->view('footer', $params);
	}

	public function input()
	{
		$params = array(
			'title' 		=> 'Input Administrator', 
			'active_menu' 	=> 'administrator', 
			'mode'			=> 'add'
		);

		if ($post = $this->input->post()) {
			$errors = array();
			$form_valid = true;

			if( !isset($post['full_name']) || !$post['full_name'] ){
				$errors[] 	= "Nama lengkap harus diisi.";
				$form_valid = false;
			}
			if( !isset($post['nick_name']) || !$post['nick_name'] ){
				$errors[] 	= "Nama panggilan harus diisi.";
				$form_valid = false;
			}
			if( !isset($post['username']) || !$post['username'] ){
				$errors[] 	= "Username harus diisi.";
				$form_valid = false;
			} elseif( $this->user_model->username_exists($post['username']) ) {
				$errors[] 	= "Username sudah ada yang menggunakan.";
				$form_valid = false;
			}

			if( !isset($post['password']) || !isset($post['repeat_password']) || !$post['password'] ) {
				$errors[] 	= "Kata sandi harus diisi.";
				$form_valid = false;
			} elseif( $post['password'] != $post['repeat_password'] ) {
				$errors[] 	= "Pengulangan password tidak sama.";
				$form_valid = false;
			}

			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = $post;
			} else {
				$allowed_add = $this->user_model->editable_column;
				$data = array_input_filter($post, $allowed_add);
				$data['capability'] = 2; // administrator
				$insert_id = $this->user_model->create( $data );

				set_message_flash('Data administrator telah berhasil ditambah.', 'success');
				redirect('admin');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('admin-input', $params);
		$this->load->view('footer', $params);
	}

	public function edit($id = false)
	{
		$data = $this->user_model->get($id);
		if( !$data || $data->capability != 2){
			set_message_flash('Data administrator tidak ditemukan.');
			redirect('admin');
		}

		$params = array(
			'title' 		=> 'Edit Administrator', 
			'active_menu' 	=> 'administrator', 
			'mode'			=> 'edit',
			'post' 			=> (array)$data,
		);

		if ($post = $this->input->post()) {
			$errors = array();
			$form_valid = true;

			if( !isset($post['full_name']) || !$post['full_name'] ){
				$errors[] 	= "Nama lengkap harus diisi.";
				$form_valid = false;
			}
			if( !isset($post['nick_name']) || !$post['nick_name'] ){
				$errors[] 	= "Nama panggilan harus diisi.";
				$form_valid = false;
			}
			if( !isset($post['username']) || !$post['username'] ){
				$errors[] 	= "Username harus diisi.";
				$form_valid = false;
			} elseif( $data->username != $post['username'] && $this->user_model->username_exists($post['username']) ) {
				$errors[] 	= "Username sudah ada yang menggunakan.";
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

			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = array_merge($params['post'], $post);
			} else {
				$allowed_add = $this->user_model->editable_column;
				$data = array_input_filter($post, $allowed_add);
				$insert_id = $this->user_model->update( $id, $data );

				set_message_flash('Data administrator telah berhasil ditambah.', 'success');
				redirect('admin');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('admin-input', $params);
		$this->load->view('footer', $params);
	}

	public function delete($id = false)
	{
		if ($id == 1) {
			set_message_flash('User tidak bisa di hapus, hanya bisa di edit.');
			redirect('admin');
		}

		$data = $this->user_model->get($id);
		
		if( !$data || $data->capability != 2){
			set_message_flash('Data administrator tidak ditemukan.');
			redirect('admin');
		}

		$this->user_model->delete( $id );
		set_message_flash('Data administrator telah berhasil dihapus.', 'success');
		redirect('admin');
	}
}
