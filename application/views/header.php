<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo $title . " &middot; " . get_app_config('app_name'); ?></title>

	<!-- Bootstrap Core CSS -->
	<link href="<?php asset('css/bootstrap.min.css') ?>" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php asset('css/style.css') ?>" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="<?php asset('vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">

	<!-- jQuery -->
	<script src="<?php asset('js/jquery-3.2.1.min.js') ?>"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="<?php asset('js/popper.min.js') ?>"></script>
	<script src="<?php asset('js/bootstrap.min.js') ?>"></script>
	<!-- Chartjs -->
	<script src="<?php url('assets/vendor/chartjs/chart.bundle.js'); ?>"></script>
	<script src="<?php url('assets/vendor/chartjs/utils.js'); ?>"></script>
	<!-- dataTables -->
	<link href="<?php url("assets/vendor/datatables/dataTables.bootstrap4.min.css") ?>" rel="stylesheet">
	<script src="<?php url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

	<script src="<?php asset('js/script.js') ?>"></script>
</head>
<body class="active-side-nav">
<header class="clearfix">
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark">
		<a class="navbar-toggler" aria-label="Toggle navigation" side-nav-toggle>
			<span class="navbar-toggler-icon"></span>
		</a>
		<a class="navbar-brand" href="<?php url() ?>"><?php echo get_app_config('app_name') ?></a>

		<div class="float-right">
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-nowrap" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="icon-menu avatar"><?php echo substr(ucwords(current_user_data('nick_name')), 0, 1); ?></div>
						&nbsp;
						<span><?php echo ucwords(current_user_data('full_name')); ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="<?php url('dashboard') ?>">
							<i class="fa fa-dashboard fa-fw"></i> Dashboard
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php url('user/profile') ?>">
							<i class="fa fa-user fa-fw"></i> Change Profile
						</a>
						<a class="dropdown-item" href="<?php url('user/logout') ?>">
							<i class="fa fa-sign-out fa-fw"></i> Logout
						</a>
					</div>
				</li>
			</ul>
		</div>

		<ul class="side-nav">
			<?php foreach (get_app_config('main_menu') as $menu): ?>
				<?php if ($menu == 'divider'): ?>
					<div class="dropdown-divider"></div>
				<?php else: ?>
					<li class="nav-item<?php if(isset($active_menu) && $active_menu == $menu['id']) echo " active" ?>">
						<a class="nav-link" href="<?php url($menu['url']); ?>">
							<i class="fa <?php echo $menu['icon']; ?> fa-fw"></i> 
							<?php echo $menu['label']; ?>
						</a>
					</li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
	</nav>
</header>
<div class="body">
	<div class="container-fluid">