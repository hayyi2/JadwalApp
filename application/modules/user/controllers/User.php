<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
	}
	
	public function login()
	{
		if (current_user_data('user_id') > 0) {
			set_message_flash('Anda Sudah Login.');
			redirect('dashboard');
		}

		if ($post = $this->input->post()) {
			if (isset($post['username']) && isset($post['password'])) {
				$login = $this->user_model->login($post['username'], $post['password']);
				if ($login['value']) {
					set_message_flash($login['message'], 'success');

					if (isset($post['go'])) 
						redirect($post['go']);
						
					redirect('dashboard');
				}else{
					set_message_flash($login['message']);
					redirect('user/login');
				}
			}
		}

		$params = array(
			'title' 		=> 'Login', 
		);

		if ($go = $this->input->get('go')) 
			$params['go'] = $go;

		$this->load->view('simple-header', $params);
		$this->load->view('login', $params);
		$this->load->view('simple-footer', $params);
	}

	public function logout()
	{
		$capability = get_app_config('access_roles');
		unset($capability[0]);
		protected_page($capability);
		
		$this->user_model->logout();
		set_message_flash('Success Logout.', 'success');
		redirect('user/login');
	}

	public function profile()
	{
		protected_page(array('administrator'));
		
		$data = $this->user_model->get_mine();

		$param = array(
			'title' 		=> 'Change Profile',
			'data' 			=> $data,
		);

		if ($post = $this->input->post()) {
			$new_data = array();
			
			$errors = array();
			$form_valid = true;

			if( !isset($post['full_name']) || !$post['full_name'] ){
				$errors[] 	= "Nama lengkap harus diisi.";
				$form_valid = false;
			}else{
				$new_data['full_name'] = $post['full_name'];
			}

			if( !isset($post['nick_name']) || !$post['nick_name'] ){
				$errors[] 	= "Nama panggilan  harus diisi.";
				$form_valid = false;
			}else{
				$new_data['nick_name'] = $post['nick_name'];
			}

			if (isset($post['change_password'])) {
				if( !isset($post['last_password']) || !$post['last_password'] ){
					$errors[] 	= "Kata Sandi Lama harus diisi.";
					$form_valid = false;
				}else if( !isset($post['new_password']) || !$post['new_password'] ){
					$errors[] 	= "Kata Sandi baru harus diisi.";
					$form_valid = false;
				}else if( !isset($post['repeat_password']) || !$post['repeat_password'] ){
					$errors[] 	= "Ulangi katasandi harus diisi.";
					$form_valid = false;
				}else if( $post['new_password'] != $post['repeat_password'] ) {
					$errors[] = "Pengulangan kata sandi tidak sama.";
					$form_valid = false;
				}

				if (!$this->user_model->check_last_pass($post['last_password'])) {
					$errors[] = "Password lama salah.";
					$form_valid = false;
				}else{
					$new_data['password'] = $post['new_password'];
				}
			}

			if( !$form_valid ){
				$param['errors'] = $errors;
			} else {
				$this->user_model->update( $data->user_id, $new_data);
				$this->user_model->refresh_session();

				set_message_flash('Perubahan data telah berhasil disimpan. ', 'success');
				redirect('user/profile');
			}
		}

		$this->load->view('header', $param );
		$this->load->view('profile', $param );
		$this->load->view('footer', $param );
	}

}
