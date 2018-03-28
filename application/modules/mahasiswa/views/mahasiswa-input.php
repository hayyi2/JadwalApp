		<div class="page-title">
			<h2 class="text-center">Master <?php echo ucwords($type); ?></h2>
		</div>
		<div class="page-content mb-3">
			<div class="row d-flex justify-content-center">
				<div class="col-md-7">
					<?php get_message_flash() ?>
					<form method="post" action="<?php url('mahasiswa/' . ($type == "mahasiswa" ? "" : "volunteer/") . ($mode == "add" ? "input" : "edit/" . $post['student_id'])) ?>">
						<div class="card">
							<div class="card-header">
								<?php if ($mode == 'edit'): ?>
									<div class="float-right">
										<a href="<?php url('mahasiswa/' . ($type == "mahasiswa" ? "" : "volunteer/") . 'input') ?>" class="btn btn-secondary btn-sm">
											<i class="fa fa-fw fa-plus"></i> 
											Tambah <?php echo ucwords($type); ?>
										</a>
									</div>
								<?php endif ?>
								<h4 class="mt-1 mb-0">
									<a href="<?php url("mahasiswa" . ($type == "mahasiswa" ? "" : "/volunteer")) ?>" class="text-muted"><i class="fa fa-fw fa-arrow-left"></i></a>
									<?php echo ($mode == "add" ? "Input" : "Edit"); ?> <?php echo ucwords($type); ?>
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
									<label class="col-sm-4 col-form-label">NIM</label>
									<div class="col-sm-8">
										<input name="username" <?php if(isset($post['username'])) echo 'value="' . $post['username'] . '"'; ?> required="" type="text" class="form-control" placeholder="NIM">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Nama Lengkap</label>
									<div class="col-sm-8">
										<input name="full_name" <?php if(isset($post['full_name'])) echo 'value="' . $post['full_name'] . '"'; ?> required="" type="text" class="form-control" placeholder="Nama Lengkap">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Nama Panggilan</label>
									<div class="col-sm-8">
										<input name="nick_name" <?php if(isset($post['nick_name'])) echo 'value="' . $post['nick_name'] . '"'; ?> required="" type="text" class="form-control" placeholder="Nama Panggilan">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Jurusan</label>
									<div class="col-sm-8">
										<select class="form-control" name="majors_id">
											<?php for ($i = 0; $i < count($data_faculty); $i++): ?>
												<optgroup label="<?php echo $data_faculty[$i]->faculty_name ?>">
													<?php 
													$add_index = 0;
													while (isset($data_faculty[$i + $add_index]) && 
														$data_faculty[$i + $add_index]->faculty_id == $data_faculty[$i]->faculty_id): ?>
														<?php if ($data_faculty[$i + $add_index]->majors_id != null): ?>
															<option <?php if(isset($post['majors_id']) && $data_faculty[$i + $add_index]->majors_id == $post['majors_id']) echo 'selected=""'; ?> value="<?php echo $data_faculty[$i + $add_index]->majors_id; ?>"><?php echo $data_faculty[$i + $add_index]->majors_name; ?></option>
														<?php endif ?>
													<?php $add_index++; endwhile; $i += $add_index -1; ?>
												</optgroup>
											<?php endfor ?>
										</select> 
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Angkatan</label>
									<div class="col-sm-4">
										<input minlength="4" maxlength="4" name="class_of_college" <?php if(isset($post['class_of_college'])) echo 'value="' . $post['class_of_college'] . '"'; ?> required="" type="number" class="form-control" placeholder="Angkatan">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Nomor Hp</label>
									<div class="col-sm-8">
										<input name="no_hp" <?php if(isset($post['no_hp'])) echo 'value="' . $post['no_hp'] . '"'; ?> required="" type="text" class="form-control" placeholder="Nomor Hp">
									</div>
								</div>
								<?php if ($mode == "edit"): ?>
									<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" name="change_password" class="form-check-input" toggle-show="#change_password">
											Ubah Password
										</label>
									</div>
								<?php endif ?>
								<div <?php if ($mode == "edit") echo 'class="hide"'; ?> id="change_password">
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Password</label>
										<div class="col-sm-8">
											<input name="password" type="password" class="form-control" placeholder="Password">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Ulangi Password</label>
										<div class="col-sm-8">
											<input name="repeat_password" type="password" class="form-control" placeholder="Ulangi Password">
										</div>
									</div>
								</div>
								<?php if ($mode == "edit"): ?>
									<hr>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Terakhir Login</label>
										<label class="col-sm-8 col-form-label"><?php echo datetime_html($post['last_login']); ?> <span class="badge badge-secondary"><?php echo $post['login_count']; ?></span></label>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Tanggal Dibuat</label>
										<label class="col-sm-8 col-form-label"><?php echo datetime_html($post['created_at']); ?></label>
									</div>
								<?php endif ?>
							</div>
							<div class="card-footer text-secondary pb-0 pt-3">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"></label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-primary"><?php echo ($mode == "add" ? "Input" : "Edit"); ?> <?php echo ucwords($type); ?></button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>