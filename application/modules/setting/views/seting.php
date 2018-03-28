		<div class="page-title">
			<h2 class="text-center"><?php echo $title; ?></h2>
		</div>
		<div class="content mb-3 row justify-content-center">
			<div class="col-md-6">
				<?php get_message_flash() ?>
				<form method="post" action="<?php url("setting") ?>">
					<div class="card mb-3">
						<h4 class="card-header">
							Setting App
						</h4>
						<?php if( isset($errors) ){ ?>
							<div class="alert alert-danger rounded-0 mb-0">
				                <button type="button" class="close" data-dismiss="alert">
				                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				                </button>
								<?php foreach ($errors as $error) echo $error.'<br>'; ?>
							</div>
						<?php } ?>
						<div class="card-body pb-0">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Tahun Pemakaian</label>
								<div class="col-sm-4">
									<input type="number" maxlength="4" minlength="4" class="form-control" name="option[start_use]" value="<?php echo get_option('start_use') ?>" placeholder="Awal Pemakaian" required="">
									<small class="form-text text-muted">Mulai</small>
								</div>
								<div class="col-sm-4">
									<input type="number" maxlength="4" minlength="4" class="form-control" name="option[end_use]" value="<?php echo get_option('end_use') ?>" placeholder="Hingga" required="">
									<small class="form-text text-muted">Hingga</small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Pendampingan</label>
								<div class="col-sm-8">
									<input type="number" class="form-control" name="option[max_volunteer]" value="<?php echo get_option('max_volunteer') ?>" placeholder="Nama Aplikasi" required="">
									<small class="form-text text-muted">Maksimum pendampingan volenteer per minggu.</small>
								</div>
							</div>
						</div>
						<div class="card-footer pb-0 pt-3">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label"></label>
								<div class="col-sm-8">
									<button class="btn btn-primary">Simpan Perubahan</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>