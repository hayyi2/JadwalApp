		<div class="page-title">
			<h2 class="text-center">Data Pendampingan</h2>
			<form class="form-inline  justify-content-center mb-2">
				<ul class="nav nav-pills justify-content-center">
					<li class="nav-item mr-2">
						<a class="nav-link <?php echo (!$volunteer ? 'active' : 'bg-light') ?>" href="<?php url('laporan') ?>">Data Pendampingan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo ($volunteer ? 'active' : 'bg-light') ?>" href="<?php url('laporan/volunteer') ?>">Ringkasan Volunteer</a>
					</li>
				</ul>
			</form>
		</div>