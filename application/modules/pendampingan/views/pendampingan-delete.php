		<div class="page-title">
			<h2 class="text-center">Master Jadwal Pendampingan</h2>
		</div>
		<div class="page-content mb-3">
			<div class="row d-flex justify-content-center">
				<div class="col-md-7">
					<?php get_message_flash() ?>
					<form method="post" action="<?php url('pendampingan/multidelete')?>">
						<div class="card">
							<div class="card-header">
								<h4 class="mt-1 mb-0">
									<a href="<?php url("pendampingan") ?>" class="text-muted"><i class="fa fa-fw fa-arrow-left"></i></a>
									Delete Pendamping
								</h4>
							</div>
							<?php if (isset($errors)): ?>
								<div class="alert alert-danger mb-0">
									<button type="button" class="close" data-dismiss="alert">
										<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
									</button>
									<?php foreach ($errors as $error): ?>
										<p class="mb-0"><?php echo $error; ?></p>
									<?php endforeach ?>
								</div>
							<?php endif ?>
							<div class="card-body pb-0">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Mulai Tanggal</label>
									<div class="col-sm-8">
										<input name="start_date" <?php if(isset($post['start_date'])) echo 'value="' . $post['start_date'] . '"'; ?> min="<?php echo date('Y-m-d') ?>" max="<?php echo date('Y-m-d', strtotime(get_option('end_use') .'-12-31')) ?>" required="" type="date" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Hingga Tanggal</label>
									<div class="col-sm-8">
										<input name="end_date" <?php if(isset($post['end_date'])) echo 'value="' . $post['end_date'] . '"'; ?> required="" type="date" min="<?php echo date('Y-m-d') ?>" max="<?php echo date('Y-m-d', strtotime(get_option('end_use') .'-12-31')) ?>" class="form-control">
									</div>
								</div>
							</div>
							<div class="card-footer text-secondary pb-0 pt-3">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"></label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-primary">Delete Pendamping</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>