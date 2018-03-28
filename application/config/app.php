<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['app_name'] = 'Penjadwalan App';

$config['access_roles'] = array(
	false,
	'mahasiswa',
	'administrator',
);
$config['hari'] = array(
	1 => 'Senin',
	2 => 'Selasa',
	3 => 'Rabu',
	4 => 'Kamis',
	5 => 'Jumat',
	6 => 'Saptu',
);

$config['status'] = array(
	'Dijadwalkan',
	'Dilihat',
	'Konfirmasi',
	'Izin',
	'Selesai',
	'Tidak Datang',
);


$config['main_menu'] = array(
	array(
		'id'            => 'dashboard',
		'capability'    => array('administrator'),
		'label'         => 'Dashboard',
		'icon'         => 'fa-dashboard',
		'url'           => 'dashboard',
	),
	'divider',
	array(
		'id'            => 'mahasiswa',
		'capability'    => array('administrator'),
		'label'         => 'Mahasiswa',
		'icon'         => 'fa-graduation-cap',
		'url'           => 'mahasiswa',
	),
	array(
		'id'            => 'volunteer',
		'capability'    => array('administrator'),
		'label'         => 'Volunteer',
		'icon'         => 'fa-heart',
		'url'           => 'mahasiswa/volunteer',
	),
	'divider',
	array(
		'id'            => 'jadwal_mahasiswa',
		'capability'    => array('administrator'),
		'label'         => 'Jadwal Mahasiswa',
		'icon'         => 'fa-calendar',
		'url'           => 'jadwal/mahasiswa',
	),
	array(
		'id'            => 'jadwal_volunteer',
		'capability'    => array('administrator'),
		'label'         => 'Jadwal Volunteer',
		'icon'         => 'fa-calendar',
		'url'           => 'jadwal/volunteer',
	),
	array(
		'id'            => 'jadwal_pendampingan',
		'capability'    => array('administrator'),
		'label'         => 'Jadwal Pendampingan',
		'icon'         => 'fa-calendar-check-o',
		'url'           => 'pendampingan',
	),
	array(
		'id'            => 'surat-izin',
		'capability'    => array('administrator'),
		'label'         => 'Surat Izin',
		'icon'         => 'fa-calendar-times-o',
		'url'           => 'izin',
	),
	array(
		'id'            => 'laporan',
		'capability'    => array('administrator'),
		'label'         => 'Data Pendampingan',
		'icon'         => 'fa-file-text',
		'url'           => 'laporan',
	),
	'divider',
	array(
		'id'            => 'administrator',
		'capability'    => array('administrator'),
		'label'         => 'Administrator',
		'icon'         => 'fa-user-secret',
		'url'           => 'admin',
	),
	array(
		'id'            => 'fakultas',
		'capability'    => array('administrator'),
		'label'         => 'Fakultas dan Jurusan',
		'icon'         => 'fa-university',
		'url'           => 'fakultas',
	),
	array(
		'id'            => 'setting',
		'capability'    => array('administrator'),
		'label'         => 'Setting',
		'icon'         => 'fa-cogs',
		'url'           => 'setting',
	),
);