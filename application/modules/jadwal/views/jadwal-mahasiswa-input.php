		<div class="page-title">
			<h2 class="text-center">Master Jadwal Mahasiswa</h2>
		</div>
		<div class="page-content mb-3">
			<div class="row d-flex justify-content-center">
				<div class="col-md-7">
					<?php get_message_flash() ?>
					<form method="post" action="<?php url('jadwal/mahasiswa/' . ($mode == "add" ? "input/" . $id : "edit/" . $post['schedule_student_id'])) ?>">
						<div class="card">
							<div class="card-header">
								<h4 class="mt-1 mb-0">
									<a href="<?php url("jadwal/mahasiswa") ?>" class="text-muted"><i class="fa fa-fw fa-arrow-left"></i></a>
									<?php echo ($mode == "add" ? "Input" : "Edit"); ?> Jadwal Mahasiswa
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
									<label class="col-sm-4 col-form-label">Hari</label>
									<div class="col-sm-8">
										<select class="form-control" name="day">
											<?php 
											$hari = get_app_config('hari');
											foreach ($hari as $key => $value): 
												if (isset($post['day']) && $post['day'] == $key) {
													$selected = true;
												}else{
													$selected = false;
												}
												?>
												<option value="<?php echo $key ?>" <?php if ($selected) echo 'selected=""'; ?>><?php echo $value ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Jam Mulai</label>
									<div class="col-sm-4">
										<input name="start_at" <?php if(isset($post['start_at'])) echo 'value="' . time_html($post['start_at']) . '"'; ?> required="" type="time" class="form-control" placeholder="Nama Panggilan">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Jam Selesai</label>
									<div class="col-sm-4">
										<input name="end_at" <?php if(isset($post['end_at'])) echo 'value="' . time_html($post['end_at']) . '"'; ?> required="" type="time" class="form-control" placeholder="Username">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Ruangan</label>
									<div class="col-sm-8">
										<input name="room" <?php if(isset($post['room'])) echo 'value="' . $post['room'] . '"'; ?> required=""  type="text" class="form-control" placeholder="Ruangan">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Matakuliah</label>
									<div class="col-sm-8">
										<input name="courses" <?php if(isset($post['courses'])) echo 'value="' . $post['courses'] . '"'; ?> required="" type="text" class="form-control" placeholder="Matakuliah">
									</div>
								</div>
							</div>
							<div class="card-footer text-secondary pb-0 pt-3">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"></label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-primary"><?php echo ($mode == "add" ? "Input" : "Edit"); ?> Jadwal Mahasiswa</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>