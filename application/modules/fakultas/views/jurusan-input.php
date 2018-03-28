		<div class="page-title">
			<h2 class="text-center">Master Fakultas dan Jurusan</h2>
		</div>
		<div class="page-content mb-3">
			<div class="row d-flex justify-content-center">
				<div class="col-md-7">
					<?php get_message_flash() ?>
					<form method="post" action="<?php url('fakultas/jurusan/' . ($mode == "add" ? "input" : "edit/" . $post['majors_id'])) ?>">
						<div class="card">
							<div class="card-header">
								<?php if ($mode == 'edit'): ?>
									<div class="float-right">
										<a href="<?php url('fakultas/jurusan/input') ?>" class="btn btn-secondary btn-sm">
											<i class="fa fa-fw fa-plus"></i> 
											Tambah Jurusan
										</a>
									</div>
								<?php endif ?>
								<h4 class="mt-1 mb-0">
									<a href="<?php url("fakultas") ?>" class="text-muted"><i class="fa fa-fw fa-arrow-left"></i></a>
									<?php echo ($mode == "add" ? "Input" : "Edit"); ?> Jurusan
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
									<label class="col-sm-4 col-form-label">Fakultas</label>
									<div class="col-sm-8">
										<select class="form-control" name="faculty_id">
											<?php foreach ($data_fakultas as $item): 
												if (isset($id) && $id == $item->faculty_id || isset($post['faculty_id']) && $post['faculty_id'] == $item->faculty_id) {
													$selected = true;
												}else{
													$selected = false;
												}
												?>
												<option value="<?php echo $item->faculty_id ?>" <?php if ($selected) echo 'selected=""'; ?>><?php echo $item->faculty_name ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Nama Jurusan</label>
									<div class="col-sm-8">
										<input name="majors_name" <?php if(isset($post['majors_name'])) echo 'value="' . $post['majors_name'] . '"'; ?> required="" type="text" class="form-control" placeholder="Nama Jurusan">
									</div>
								</div>
							</div>
							<div class="card-footer text-secondary pb-0 pt-3">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"></label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-primary"><?php echo ($mode == "add" ? "Input" : "Edit"); ?> Jurusan</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>