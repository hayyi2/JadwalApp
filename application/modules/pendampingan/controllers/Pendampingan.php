<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendampingan extends CI_Controller {

	private $bulan = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'Nopember',
		'12' => 'Desember',
	);

	private $tahun = array();
	private $minggu = array();

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('administrator'));

		$this->load->model('jadwal/schedule_volunteer_model');
		$this->load->model('jadwal/schedule_student_model');
		$this->load->model('pendampingan_model');

		for ($i = get_option('start_use'); $i <= get_option('end_use'); $i++) { 
			$this->tahun[] = $i;
		}
	}
	
	public function index()
	{
		$get = $this->input->get();
		$m = date('m');
		$y = date('Y');
		$t = 1;
		$search_date = false;
		if (isset($get['m']) && isset($get['y'])) {
			if (in_array($get['m'], array_keys($this->bulan))) {
				$m = $get['m'];
			}
			if (get_option('start_use') <= $get['y'] && get_option('end_use') >= $get['y']) {
				$y = $get['y'];
			}
		}elseif (isset($get['date']) && 
			get_option('start_use') <= date('Y', strtotime($get['date'])) && 
			get_option('end_use') >= date('Y', strtotime($get['date']))) {
				$search_date = true;
				$m = date('m', strtotime($get['date']));
				$y = date('Y', strtotime($get['date']));
		}

		$day = cal_days_in_month(CAL_GREGORIAN, $m, $y);
		$c_day = date('w', strtotime($y . "-" . $m . "-" . 1));
		$c_day_temp = 7 - $c_day;
		$c_day = ($c_day == 0 ? 2 : 1);
		$this->minggu[1] = array(
			date('Y-m-d', strtotime($y . "-" . $m . "-" . $c_day)), 
			date('Y-m-d', strtotime($y . "-" . $m . "-" . $c_day_temp))
		);
		$c_day = $c_day_temp;
		$count_week = floor(($day-$c_day)/7);

		for ($i=0; $i < $count_week; $i++) {
			$c_day = $c_day + 2;
			$c_day_temp = $c_day + 5;
			$this->minggu[] = array(
				date('Y-m-d', strtotime($y . "-" . $m . "-" . $c_day)), 
				date('Y-m-d', strtotime($y . "-" . $m . "-" . $c_day_temp))
			);
			$c_day = $c_day_temp;
		}

		$c_day = $c_day + 2;
		$c_day_temp = (date('w', strtotime($y . "-" . $m . "-" . $day)) == 0 ? $day-1 : $day);
		if ($c_day <= $c_day_temp) {
			$this->minggu[] = array(
				date('Y-m-d', strtotime($y . "-" . $m . "-" . $c_day)), 
				date('Y-m-d', strtotime($y . "-" . $m . "-" . $c_day_temp))
			);
		}

		if (isset($get['t']) && in_array($get['t'], array_keys($this->minggu))) {
			$t = $get['t'];
		}else{
			if (isset($get['date']) && $search_date) {
				$day_now = date('d', strtotime($get['date']));
			}else{
				$day_now = date('d');
			}
			if ($m == date('m') && $y == date('Y')) {
				foreach ($this->minggu as $key => $value) {
					if ($day_now >= date('d', strtotime($value[0])) && $day_now <= date('d', strtotime($value[1]))) {
						$t = $key;
						break;
					}
				}
			}
		}

		$this->view($m, $y, $t);
	}

	private function view($m, $y, $t)
	{
		$params = array(
			'title' 		=> 'Jadwal Pendampingan', 
			'active_menu' 	=> 'jadwal_pendampingan',
			'm' 			=> $this->bulan,
			'y' 			=> $this->tahun,
			'minggu' 		=> $this->minggu,
			'active_m' 		=> $m,
			'active_y' 		=> $y,
			'active_minggu' => $t,
		);

		$data = $this->schedule_student_model->gets_view(array(
			'where' => array(
				'day >=' => date('w', strtotime($this->minggu[$t][0])),
				'day <=' => date('w', strtotime($this->minggu[$t][1])),
			)
		));
		$data_pendampingan = $this->pendampingan_model->gets(array(
			'where' => array(
				'date >=' => $this->minggu[$t][0],
				'date <=' => $this->minggu[$t][1],
			)
		), 'accompaniment_mentah');

		$new_data_pendampingan = array();
		foreach ($data_pendampingan as $key => $value) {
			$new_data_pendampingan[$value->schedule_student_id] = $value;
		}

		foreach ($data as $key => $value) {
			if (isset($new_data_pendampingan[$value->schedule_student_id])) {
				$data[$key]->pendamping = $new_data_pendampingan[$value->schedule_student_id];
			}
		}

		$params['data'] = $data;

		$this->load->view('header', $params);
		$this->load->view('pendampingan-list', $params);
		$this->load->view('footer', $params);
	}

	public function generate()
	{
		$params = array(
			'title' 		=> 'Jadwal Pendamping', 
			'active_menu' 	=> 'jadwal_pendampingan',
		);

		$data = $this->schedule_student_model->gets_view();
		$jadwal_volunteer =  $this->schedule_student_model->gets(array(), 'schedule_volunteer_group');

		if ($schedules = $this->input->post('schedules')) {
			$temp_data_id = array();
			$temp_data = array();
			foreach ($data as $key => $value) {
				$temp_data_id[] = $value->schedule_student_id;
				$temp_data[$value->day][$value->schedule_student_id] = $value;
			}
			$new_jadwal_volunteer = array();
			foreach ($jadwal_volunteer as $key => $value) {
				$new_jadwal_volunteer[$value->student_id] = $value;
			}

			$post = $this->input->post();

			$errors = array();
			$form_valid = true;

			if( !isset($post['start_date']) || !$post['start_date'] ){
				$errors[] 	= "Tanggal mulai digunakan harus diisi.";
				$form_valid = false;
			}
			if( !isset($post['end_date']) || !$post['end_date'] ){
				$errors[] 	= "Tanggal selesai digunakan harus diisi.";
				$form_valid = false;
			}

			if( $form_valid && 
				(date('Y-m-d', strtotime($post['start_date'])) > date('Y-m-d', strtotime($post['end_date']))) ){
				$errors[] 	= "Input tanggal tidak sesuai, tanggal mulai lebih besar dari tanggal selesai.";
				$form_valid = false;
			}

			if( $form_valid && 
				$this->pendampingan_model->gets(array(
					'where' => array(
						'date >=' => $post['start_date'],
						'date <=' => $post['end_date'],
					)
				), 'accompaniment_mentah')){
				$errors[] 	= "Terdapat jadwal yang telah di input pada, silahkan ubah tanggal penggunaan.";
				$form_valid = false;
			}

			if ($form_valid) {
				foreach ($schedules as $key => $value) {
					if (!in_array($key, $temp_data_id) || !in_array($value, array_keys($new_jadwal_volunteer))) {
						$errors[] 	= "Generate jadwal filed.";
						$form_valid = false;
						break;
					}
				}
			}

			if( !$form_valid ){
				$params['post'] = $post;
				$params['errors'] = $errors;
				foreach ($data as $key => $value) {
					if (isset($schedules[$value->schedule_student_id]) && 
						in_array($schedules[$value->schedule_student_id], array_keys($new_jadwal_volunteer))) {
						$data[$key]->pendamping = $new_jadwal_volunteer[$schedules[$value->schedule_student_id]];
					}
				}
				$params['data'] = $data;
			} else {
				$wolk_date = date('Y-m-d', strtotime($post['start_date']));
				$new_data = array();
				$updated_at = date('Y-m-d H:i:s');
				do {
					$in_date = $wolk_date;
					$in_day = date('w', strtotime($in_date));
					if (!in_array($in_day, array_keys($temp_data))) {
						$wolk_date = date('Y-m-d', strtotime($wolk_date . " +1 day"));
						continue;
					}
					foreach ($temp_data[$in_day] as $key => $value) {
						$new_data[] = array(
							'schedule_student_id' 	=> $value->schedule_student_id,
							'volunteer_id' 			=> $schedules[$value->schedule_student_id],
							'date' 					=> $in_date,
							'updated_at' 			=> $updated_at,
						);
					}
					$wolk_date = date('Y-m-d', strtotime($wolk_date . " +1 day"));
				} while (date('Y-m-d', strtotime($wolk_date)) <= date('Y-m-d', strtotime($post['end_date'])));

				$insert_id = $this->pendampingan_model->create_bulk( $new_data );

				set_message_flash('Data jadwal pendampingan telah berhasil ditambah.', 'success');
				redirect('pendampingan?date=' . $post['start_date']);
			}
		}else{
			$not_found = 0;
			foreach ($data as $i_data => $v_data) {
				$find_jadwal = false;
				foreach ($jadwal_volunteer as $i_target => $v_target) {
					$day = "day".$v_data->day;
					$jadwal = json_decode($v_target->$day);
					if ($jadwal == array()) {
						$find_jadwal = $i_target;
						break;
					}
					$find = true;
					foreach ($jadwal as $key => $value) {
						if ((strtotime($v_data->start_at) < strtotime($value->start_at) && 
								strtotime($v_data->end_at) > strtotime($value->start_at)) ||
							(strtotime($v_data->start_at) < strtotime($value->end_at) && 
								strtotime($v_data->end_at) > strtotime($value->end_at)) ||
							(strtotime($v_data->start_at) >= strtotime($value->start_at) && 
								strtotime($v_data->end_at) <= strtotime($value->end_at))) {
							$find = false;
							break;
						}
					}
					if ($find) {
						$find_jadwal = $i_target;
						break;
					}
				}
				if ($find_jadwal !== false) {
					$data[$i_data]->pendamping = $jadwal_volunteer[$find_jadwal];
					$day = "day".$v_data->day;
					$jadwal = json_decode($jadwal_volunteer[$find_jadwal]->$day);
					$jadwal[] = array(
						'start_at' => $v_data->start_at,
						'end_at' => $v_data->end_at,
					);
					$jadwal_volunteer[$find_jadwal]->$day = json_encode($jadwal);
					if (isset($jadwal_volunteer[$find_jadwal]->jumlah)) {
						$jadwal_volunteer[$find_jadwal]->jumlah += 1;
					}else{
						$jadwal_volunteer[$find_jadwal]->jumlah = 1;
					}
					if ($jadwal_volunteer[$find_jadwal]->jumlah < get_option('max_volunteer')) {
						$jadwal_volunteer[] = $jadwal_volunteer[$find_jadwal];
					}
					unset($jadwal_volunteer[$find_jadwal]);
				}else{
					$not_found += 1;
				}
			}
			
			$params['data'] = $data;
			if ($not_found > 0) {
				$errors[] 	= "Terdapat " . $not_found . " mahasiswa tidak mendapatkan pendamping.";
				$params['errors'] = $errors;
			}
		}


		$this->load->view('header', $params);
		$this->load->view('pendampingan-generate', $params);
		$this->load->view('footer', $params);
	}

	public function input($id, $date)
	{
		if (!(get_option('start_use') <= date('Y', strtotime($date)) && 
					get_option('end_use') >= date('Y', strtotime($date)))) {
			set_message_flash('Tanggal tidak sesuai.');
			redirect('pendampingan');
		}

		$data_pendampingan = $this->pendampingan_model->get(array(
			'where' => array(
				'schedule_student_id' 	=> $id,
				'date' 					=> $date,
			)
		));

		if ($data_pendampingan) {
			set_message_flash('Data jadwal pendampingan telah ada.');
			redirect('pendampingan?date=' . $date);
		}

		$data = $this->schedule_student_model->get_view($id);

		if (!$data) {
			set_message_flash('Data jadwal mahasiswa tidak ditemukan.');
			redirect('pendampingan?date=' . $date);
		}
		if (date('w', strtotime($date)) != $data->day) {
			set_message_flash('Url filed.');
			redirect('pendampingan?date=' . $date);
		}

		$params = array(
			'title' 		=> 'Input Pendamping', 
			'active_menu' 	=> 'jadwal_pendampingan',
			'data'			=> $data,
			'id' 			=> $id,
			'date' 			=> $date,
		);

		if ($volunteer_id = $this->input->post('volunteer_id')) {
			$errors = array();
			$form_valid = true;

			$volunteer = $this->schedule_student_model->get(array('where' => array('student_id' => $volunteer_id)), 'schedule_volunteer_group');
			if ($volunteer) {
				$day = "day".$data->day;
				$jadwal = json_decode($volunteer->$day);
				$kres = false;
				foreach ($jadwal as $key => $value) {
					if ((strtotime($data->start_at) < strtotime($value->start_at) && 
							strtotime($data->end_at) > strtotime($value->start_at)) ||
						(strtotime($data->start_at) < strtotime($value->end_at) && 
							strtotime($data->end_at) > strtotime($value->end_at)) ||
						(strtotime($data->start_at) >= strtotime($value->start_at) && 
							strtotime($data->end_at) <= strtotime($value->end_at))) {
						$kres = true;
						break;
					}
				}

				if ($kres) {
					$errors[] 	= "Jadwal volunteer bersinggungan dengan kesibukannya.";
					$form_valid = false;
				}
			}

			if ($form_valid) {
				$data_pendampingan = $this->pendampingan_model->gets(array(
					'where' => array(
						'date' => $date,
						'volunteer_id' => $volunteer_id,
					),
				), 'accompaniment_input');
				$kres = false;
				foreach ($data_pendampingan as $key => $value) {
					if ((strtotime($data->start_at) < strtotime($value->start_at) && 
								strtotime($data->end_at) > strtotime($value->start_at)) ||
							(strtotime($data->start_at) < strtotime($value->end_at) && 
								strtotime($data->end_at) > strtotime($value->end_at)) ||
							(strtotime($data->start_at) >= strtotime($value->start_at) && 
								strtotime($data->end_at) <= strtotime($value->end_at))) {
						$kres = true;
						break;
					}
				}

				if ($kres) {
					$errors[] 	= "Jadwal volunteer bersinggungan dengan jadwal pendampingannya.";
					$form_valid = false;
				}
			}

			if( !$form_valid ){
				$params['post'] = $this->input->post();
				$params['errors'] = $errors;
			} else {
				$new_data = array(
					'schedule_student_id' 	=> $id,
					'volunteer_id' 			=> $volunteer_id,
					'date' 					=> $date,
					'updated_at'			=> date('Y-m-d H:i:s'),
				);
				var_dump($new_data);
				$insert_id = $this->pendampingan_model->create( $new_data );

				set_message_flash('Data jadwal pendampingan telah berhasil ditambah.', 'success');
				redirect('pendampingan?date=' . $date);
			}
		}
		$jadwal_volunteer =  $this->schedule_student_model->gets(array(), 'schedule_volunteer_group');
		$find_jadwal = array();
		foreach ($jadwal_volunteer as $i_target => $v_target) {
			$day = "day".$data->day;
			$jadwal = json_decode($v_target->$day);
			if ($jadwal == array()) {
				$find_jadwal[$v_target->student_id] = $v_target;
			}else{
				$find = true;
				foreach ($jadwal as $key => $value) {
					if ((strtotime($data->start_at) < strtotime($value->start_at) && 
							strtotime($data->end_at) > strtotime($value->start_at)) ||
						(strtotime($data->start_at) < strtotime($value->end_at) && 
							strtotime($data->end_at) > strtotime($value->end_at)) ||
						(strtotime($data->start_at) >= strtotime($value->start_at) && 
							strtotime($data->end_at) <= strtotime($value->end_at))) {
						$find = false;
						break;
					}
				}
				if ($find) {
					$find_jadwal[$v_target->student_id] = $v_target;
					break;
				}
			}
		}
		if (count($find_jadwal) == 0) {
			$params['errors'][] = "Semua jadwal volunteer bersinggungan dengan jadwal kesibukannya.";
			$params['data_volunteer'] = array();
		}else{
			$data_pendampingan = $this->pendampingan_model->gets(array(
				'where' => array(
					'date' => $date,
				),
				'where_in' => array(
					'volunteer_id' => array_keys($find_jadwal),
				)
			), 'accompaniment_input');
			if (count($data_pendampingan) > 0) {
				foreach ($data_pendampingan as $key => $value) {
					if ((strtotime($data->start_at) < strtotime($value->start_at) && 
								strtotime($data->end_at) > strtotime($value->start_at)) ||
							(strtotime($data->start_at) < strtotime($value->end_at) && 
								strtotime($data->end_at) > strtotime($value->end_at)) ||
							(strtotime($data->start_at) >= strtotime($value->start_at) && 
								strtotime($data->end_at) <= strtotime($value->end_at))) {
						unset($find_jadwal[$value->volunteer_id]);
					}
				}
				if (count($find_jadwal) == 0) {
					$params['errors'][] = "Semua jadwal volunteer bersinggungan dengan jadwal pendampingannya.";
				}
			}
			$params['data_volunteer'] = $find_jadwal;
		}

		$this->load->view('header', $params);
		$this->load->view('pendampingan-input', $params);
		$this->load->view('footer', $params);
	}

	public function delete($id = false)
	{
		$data = $this->pendampingan_model->get($id);
		if( !$data ){
			set_message_flash('Data jadwal pendampingan tidak ditemukan.');
			redirect('pendampingan');
		}

		$this->pendampingan_model->delete( $id );
		set_message_flash('Data jadwal pendampingan telah berhasil dihapus.', 'success');
		redirect('pendampingan?date=' . $data->date);
	}

	public function multidelete()
	{
		$params = array(
			'title' 		=> 'Delete Pendamping', 
			'active_menu' 	=> 'jadwal_pendampingan',
		);

		if ($post = $this->input->post()) {
			$errors = array();
			$form_valid = true;

			if( !isset($post['start_date']) || !$post['start_date'] ){
				$errors[] 	= "Tanggal mulai digunakan harus diisi.";
				$form_valid = false;
			}
			if( !isset($post['end_date']) || !$post['end_date'] ){
				$errors[] 	= "Tanggal selesai digunakan harus diisi.";
				$form_valid = false;
			}

			if( $form_valid && 
				(date('Y-m-d', strtotime($post['start_date'])) > date('Y-m-d', strtotime($post['end_date']))) ){
				$errors[] 	= "Input tanggal tidak sesuai, tanggal mulai lebih besar dari tanggal selesai.";
				$form_valid = false;
			}

			if( !$form_valid ){
				$params['post'] = $post;
				$params['errors'] = $errors;
			} else {
				$this->pendampingan_model->delete(array(
					'date >=' => $post['start_date'],
					'date <=' => $post['end_date'],
				));

				set_message_flash('Data jadwal pendampingan telah berhasil dihapus.', 'success');
				redirect('pendampingan?date=' . $post['start_date']);
			}
		}

		$this->load->view('header', $params);
		$this->load->view('pendampingan-delete', $params);
		$this->load->view('footer', $params);
	}
}
