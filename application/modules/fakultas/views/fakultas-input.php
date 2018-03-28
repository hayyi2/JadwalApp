		<div class="page-title">
			<h2 class="text-center">Master Fakultas dan Jurusan</h2>
		</div>
		<div class="page-content mb-3">
			<div class="row d-flex justify-content-center">
				<div class="col-md-7">
					<?php get_message_flash() ?>
					<form method="post" action="<?php url('fakultas/' . ($mode == "add" ? "input" : "edit/" . $post['faculty_id'])) ?>">
						<div class="card">
							<div class="card-header">
								<?php if ($mode == 'edit'): ?>
									<div class="float-right">
										<a href="<?php url('fakultas/input') ?>" class="btn btn-secondary btn-sm">
											<i class="fa fa-fw fa-plus"></i> 
											Tambah Fakultas
										</a>
									</div>
								<?php endif ?>
								<h4 class="mt-1 mb-0">
									<a href="<?php url("fakultas") ?>" class="text-muted"><i class="fa fa-fw fa-arrow-left"></i></a>
									<?php echo ($mode == "add" ? "Input" : "Edit"); ?> Fakultas
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
									<label class="col-sm-4 col-form-label">Nama Fakultas</label>
									<div class="col-sm-8">
										<input name="faculty_name" <?php if(isset($post['faculty_name'])) echo 'value="' . $post['faculty_name'] . '"'; ?> required="" type="text" class="form-control" placeholder="Nama Fakultas">
									</div>
								</div>
							</div>
							<div class="card-footer text-secondary pb-0 pt-3">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"></label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-primary"><?php echo ($mode == "add" ? "Input" : "Edit"); ?> Fakultas</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>