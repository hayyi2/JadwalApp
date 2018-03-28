<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('administrator'));

		$this->load->model('schedule_student_model');
		$this->load->model('mahasiswa/student_model');
	}
	
	public function index()
	{
		$params = array(
			'title' 		=> 'Jadwal Mahasiswa', 
			'active_menu' 	=> 'jadwal_mahasiswa', 
			'data' 			=> $this->schedule_student_model->gets_view(),
		);

		$this->load->view('header', $params);
		$this->load->view('jadwal-mahasiswa-list', $params);
		$this->load->view('footer', $params);
	}

	public function input($id)
	{
		$data_mahasiswa = $this->student_model->get_view($id);
		if( !$data_mahasiswa ){
			set_message_flash('Data mahasiswa tidak ditemukan.');
			redirect('jadwal/mahasiswa');
		}

		$params = array(
			'title' 		=> 'Input Jadwal Mahasiswa', 
			'active_menu' 	=> 'jadwal_mahasiswa', 
			'mode'			=> 'add',
			'id'			=> $id,
		);

		if ($post = $this->input->post()) {
			$required_post = array(
				'day'		=> "Hari",
				'start_at'	=> "Jam Mulai",
				'end_at'	=> "Jam Selesai",
				'room'		=> "Ruangan",
				'courses'	=> "Matakuliah",
			);

			$errors = array();
			$form_valid = true;

			foreach (array_keys($required_post) as $key) {
				if (!in_array($key, array_keys($post)) || $post[$key] == "") {
					$errors[] 	= $required_post[$key] . " harus diisi.";
					$form_valid = false;
				}
			}

			if ($form_valid && $this->schedule_student_model->check_scadule( $id, $post['day'], $post['start_at'], $post['end_at'] )) {
				$errors[] 	= "Jadwal yang diinput kres dengan jadwal yang lain.";
				$form_valid = false;
			}
			
			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = $post;
			} else {
				$allowed_add = $this->schedule_student_model->editable_column;
				$data = array_input_filter($post, $allowed_add);
				$data['student_id'] = $data_mahasiswa->student_id;
				$insert_id = $this->schedule_student_model->create( $data );

				set_message_flash('Data jadwal mahasiswa telah berhasil ditambah.', 'success');
				redirect('jadwal/mahasiswa');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('jadwal-mahasiswa-input', $params);
		$this->load->view('footer', $params);
	}

	public function edit($id = false)
	{
		$data = $this->schedule_student_model->get_view($id);
		if( !$data ){
			set_message_flash('Data mahasiswa tidak ditemukan.');
			redirect('mahasiswa');
		}

		$params = array(
			'title' 		=> 'Edit Jadwal Mahasiswa', 
			'active_menu' 	=> 'jadwal_mahasiswa', 
			'mode'			=> 'edit',
			'post'			=> (array)$data,
		);

		if ($post = $this->input->post()) {
			$required_post = array(
				'day'		=> "Hari",
				'start_at'	=> "Jam Mulai",
				'end_at'	=> "Jam Selesai",
				'room'		=> "Ruangan",
				'courses'	=> "Matakuliah",
			);

			$errors = array();
			$form_valid = true;

			foreach (array_keys($required_post) as $key) {
				if (!in_array($key, array_keys($post)) || $post[$key] == "") {
					$errors[] 	= $required_post[$key] . " harus diisi.";
					$form_valid = false;
				}
			}

			if ($form_valid && $this->schedule_student_model->check_scadule( $data->student_id, $post['day'], $post['start_at'], $post['end_at'] )) {
				$errors[] 	= "Jadwal yang diinput kres dengan jadwal yang lain.";
				$form_valid = false;
			}

			if( !$form_valid ){
				$params['errors'] = $errors;
				$params['post'] = array_merge($params['post'], $post);
			} else {
				$allowed_add = $this->schedule_student_model->editable_column;
				$new_data = array_input_filter($post, $allowed_add);
				$insert_id = $this->schedule_student_model->update( $id, $new_data );

				set_message_flash('Data jadwal mahasiswa telah berhasil ditambah.', 'success');
				redirect('jadwal/mahasiswa');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('jadwal-mahasiswa-input', $params);
		$this->load->view('footer', $params);
	}

	public function delete($id = false)
	{
		$data_mahasiswa = $this->schedule_student_model->get_view($id);
		if( !$data_mahasiswa ){
			set_message_flash('Data jadwal mahasiswa tidak ditemukan.');
			redirect('jadwal/mahasiswa');
		}

		$this->schedule_student_model->delete( $id );
		set_message_flash('Data jadwal mahasiswa telah berhasil dihapus.', 'success');
		redirect('jadwal/mahasiswa');
	}
}
