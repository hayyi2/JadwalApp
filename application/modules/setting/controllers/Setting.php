<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");

		protected_page(array('administrator'));

		$this->load->model('option_model');
	}

	public function index()
	{
		$param = array(
			'title' 		=> 'Setting',
			'active_menu' 	=> 'setting',
		);

		if ($post = $this->input->post()) {
			if (isset($post['option']) && isAssoc( $post['option'] )) {
				foreach ($post['option'] as $key => $value) {
					if ($this->option_model->check_isset_key($key)) {
						$this->option_model->change_value($key, $value);
					}else{
						$this->option_model->set_value($key, $value);
					}
				}
			}

			set_message_flash("Data telah berhasil diubah.", 'success');
			redirect('setting');
		}

		$this->load->view('header', $param );
		$this->load->view('seting', $param );
		$this->load->view('footer', $param );
	}
}
