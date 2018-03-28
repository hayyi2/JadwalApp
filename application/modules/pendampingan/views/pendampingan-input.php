		<div class="page-title">
			<h2 class="text-center">Master Jadwal Pendampingan</h2>
		</div>
		<div class="page-content mb-3">
			<div class="row d-flex justify-content-center">
				<div class="col-md-7">
					<?php get_message_flash() ?>
					<form method="post" action="<?php url('pendampingan/input/' . $id . '/' . $date)?>">
						<div class="card">
							<div class="card-header">
								<h4 class="mt-1 mb-0">
									<a href="<?php url("pendampingan?date=" . $date) ?>" class="text-muted"><i class="fa fa-fw fa-arrow-left"></i></a>
									Input Pendamping
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
									<label class="col-sm-4 col-form-label">Nama Mahasiswa</label>
									<label class="col-sm-8 col-form-label">
										<a target="blank" href="<?php url('mahasiswa/edit/' . $data->student_id) ?>">
											<?php echo $data->full_name; ?>
											<small>(<?php echo $data->nick_name; ?>)</small>
										</a>
									</label>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Tanggal Pendampingan</label>
									<label class="col-sm-8 col-form-label">
										<?php 
										$hari = get_app_config('hari');
										echo $hari[date('w', strtotime($date))]; ?>, 
										<?php echo date('d M Y', strtotime($date)); ?>
										<small>(<?php echo date('H:i', strtotime($data->start_at)) . '-' . date('H:i', strtotime($data->end_at)); ?>)</small>
									</label>
								</div>
								<hr>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Volunteer</label>
									<div class="col-sm-8">
										<select class="form-control" name="volunteer_id">
											<?php foreach ($data_volunteer as $key => $value): ?>
												<option value="<?php echo $key ?>"><?php echo $value->full_name . ' (' . $value->nick_name . ')'; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="card-footer text-secondary pb-0 pt-3">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"></label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-primary">Input Pendamping</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>