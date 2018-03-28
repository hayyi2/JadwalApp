		<div class="page-title text-center">
			<h2>Dashboard</h2>
		</div>
		<div class="page-content mb-3">
        	<?php get_message_flash() ?>
			<!-- counter -->
			<div class="card-columns counter">
				<div class="card clearfix border-primary">
					<div class="card-header border-primary text-white bg-primary clearfix">
						<h1 class="float-right"><i class="fa fa-graduation-cap"></i></h1>
						<h1><?php echo count($data_student); ?></h1>
						<span>Mahasiswa Difabel</span>
					</div>
					<div class="card-footer border-primary">
						<a href="<?php url('mahasiswa') ?>" class="card-footer-link">
							<i class="float-right fa fa-arrow-right"></i>
							View Details
						</a>
					</div>
				</div>
				<div class="card clearfix border-success">
					<div class="card-header border-success text-white bg-success clearfix">
						<h1 class="float-right"><i class="fa fa-heart"></i></h1>
						<h1><?php echo count($data_volunteer); ?></h1>
						<span>Mahasiswa volunteer</span>
					</div>
					<div class="card-footer border-success">
						<a href="<?php url('mahasiswa/volunteer') ?>" class="card-footer-link text-success">
							<i class="float-right fa fa-arrow-right"></i>
							View Details
						</a>
					</div>
				</div>
				<div class="card clearfix border-warning">
					<div class="card-header border-warning text-white bg-warning clearfix">
						<h1 class="float-right"><i class="fa fa-calendar-check-o"></i></h1>
						<h1><?php echo count($data_pendampingan); ?></h1>
						<span>Pendampingan</span>
					</div>
					<div class="card-footer border-warning">
						<a href="<?php url('laporan') ?>" class="card-footer-link text-warning">
							<i class="float-right fa fa-arrow-right"></i>
							View Details
						</a>
					</div>
				</div>
				<div class="card clearfix border-danger">
					<div class="card-header border-danger text-white bg-danger clearfix">
						<h1 class="float-right"><i class="fa fa-calendar-times-o"></i></h1>
						<h1><?php echo count($data_izin); ?></h1>
						<span>Surat Izin</span>
					</div>
					<div class="card-footer border-danger">
						<a href="<?php url('izin') ?>" class="card-footer-link text-danger">
							<i class="float-right fa fa-arrow-right"></i>
							View Details
						</a>
					</div>
				</div>
			</div>
			<!-- /counter -->
			<div class="card mb-3">
				<div class="card-header">
					<h4 class="mt-1 mb-0">
						Grafik Pendampingan
					</h4>
				</div>
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-sm-12">
							<canvas id="chart" width="100%" height="40"></canvas>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$(function () {
						var color = Chart.helpers.color;
						var barChartData = {
							labels: [<?php foreach ($data as $no => $value){
								if ($no > 0) {echo ", ";}
								echo '"' . date('M Y', strtotime($value->date)) . '"';
							} ?>],
							datasets: [{
								label: 'Mendampingi',
								backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
								borderColor: window.chartColors.green,
								borderWidth: 1,
								data: [<?php foreach ($data as $no => $value){
									if ($no > 0) {echo ", ";}
									echo $value->mendampingi;
								} ?>]
							}, {
								label: 'Izin',
								backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
								borderColor: window.chartColors.yellow,
								borderWidth: 1,
								data: [<?php foreach ($data as $no => $value){
									if ($no > 0) {echo ", ";}
									echo $value->izin;
								} ?>]
							}, {
								label: 'Tidak Mendampingi',
								backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
								borderColor: window.chartColors.red,
								borderWidth: 1,
								data: [<?php foreach ($data as $no => $value){
									if ($no > 0) {echo ", ";}
									echo $value->tidak_datang;
								} ?>]
							}]

						};
						var ctx = document.getElementById("chart").getContext("2d");
						ctx.height = 40;
						window.myBar = new Chart(ctx, {
							type: 'bar',
							data: barChartData,
							options: {
								responsive: true,
								legend: {
									position: 'top',
								},
								title: {
									display: false,
								},
								scales: {
									yAxes: [{
										ticks: {
											beginAtZero: true,
										}
									}]
								}
							}
						});
					});
				</script>
			</div>
		</div>