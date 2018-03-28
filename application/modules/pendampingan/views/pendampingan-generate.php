		<div class="page-title">
			<h2 class="text-center">Master Jadwal Pendampingan</h2>
		</div>
		<div class="page-content mb-3">
        	<?php get_message_flash() ?>
        	<form action="<?php url('pendampingan/generate') ?>" method="post">
				<div class="card">
					<div class="card-header">
						<h4 class="mt-1 mb-0">
							<a href="<?php url("pendampingan") ?>" class="text-muted"><i class="fa fa-fw fa-arrow-left"></i></a>
							Generate Jadwal
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
						<div class="row d-flex justify-content-center">
							<div class="col-sm-8">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Tanggal mulai digunakan</label>
									<div class="col-sm-8">
										<input name="start_date" <?php if(isset($post['start_date'])) echo 'value="' . $post['start_date'] . '"'; ?> min="<?php echo date('Y-m-d') ?>" max="<?php echo date('Y-m-d', strtotime(get_option('end_use') .'-12-31')) ?>" required="" type="date" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Tanggal selesai digunakan</label>
									<div class="col-sm-8">
										<input name="end_date" <?php if(isset($post['end_date'])) echo 'value="' . $post['end_date'] . '"'; ?> required="" type="date" min="<?php echo date('Y-m-d') ?>" max="<?php echo date('Y-m-d', strtotime(get_option('end_use') .'-12-31')) ?>" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label"></label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-primary mr-2">Gunakan jadwal</button>
										<a href="<?php echo url('pendampingan/generate') ?>" class="btn btn-secondary">Generate Ulang</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-header">
						<h4 class="mt-1 mb-0">
							Hasil Generate
						</h4>
					</div>
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th width="5">No</th>
								<th>Nama</th>
								<th>Jurusan</th>
								<th>No Hp</th>
								<th>Hari</th>
								<th>Jam</th>
								<th>Ruang</th>
								<th>Mata Kuliah</th>
								<th>Pendamping</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$hari = get_app_config('hari');
							$rowspan = 1;
							$rowspan2 = 1;
							foreach ($data as $no => $item): ?>
								<tr>
									<td width="5"><?php echo $no + 1; ?></td>
									<?php if ($rowspan == 1): 
										while(isset($data[$no + $rowspan]) && $data[$no + $rowspan]->student_id == $item->student_id){
											$rowspan++;
										}
										?>
										<td rowspan="<?php echo $rowspan;?>" width="1" class="text-nowrap">
											<a href="<?php url('mahasiswa/edit/' . $item->student_id) ?>">
												<?php echo $item->full_name; ?>
												<small class="text-secondary">(<?php echo $item->nick_name; ?>)</small>
											</a>
										</td>
										<td rowspan="<?php echo $rowspan;?>">
											<?php echo $item->majors_name; ?>
										</td>
										<td rowspan="<?php echo $rowspan;?>">
											<?php echo $item->no_hp; ?>
										</td>
									<?php else: $rowspan--;?>
									<?php endif ?>
									<?php if ($item->schedule_student_id != null): ?>
										<?php if ($rowspan2 == 1): 
											while(isset($data[$no + $rowspan2]) && $data[$no + $rowspan2]->day == $item->day && $item->student_id == $data[$no + $rowspan2]->student_id){
												$rowspan2++;
											}
											?>
											<td rowspan="<?php echo $rowspan2;?>"><?php echo $hari[$item->day]; ?></td>
										<?php else: $rowspan2--;?>
										<?php endif ?>
										<td><?php echo time_html($item->start_at) . " - " . time_html($item->end_at); ?></td>
										<td><?php echo $item->room; ?></td>
										<td><?php echo $item->courses; ?></td>
										<td>
											<?php if (isset($item->pendamping)): ?>
												<a target="blank" href="<?php url('mahasiswa/volunteer/edit/' . $item->pendamping->student_id) ?>">
													<?php echo $item->pendamping->nick_name; ?>
												</a>
												<input name="schedules[<?php echo $item->schedule_student_id ?>]" value="<?php echo $item->pendamping->student_id ?>" type="hidden">
											<?php endif ?>
										</td>
									<?php else: ?>
										<td colspan="5"></td>
									<?php endif ?>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
        	</form>
		</div>