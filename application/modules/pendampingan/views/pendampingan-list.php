		<div class="page-title">
			<h2 class="text-center">Master Jadwal Pendampingan</h2>
			<form class="form-inline  justify-content-center mb-2" method="get" action="<?php url('pendampingan') ?>">
				<div class="form-group mr-2">
					<select class="form-control" name="m">
						<?php foreach ($m as $key => $value): ?>
							<option <?php if ($key == $active_m) echo 'selected=""'; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group mr-2">
					<select class="form-control" name="y">
						<?php foreach ($y as $value): ?>
							<option <?php if ($value == $active_y) echo 'selected=""'; ?> value="<?php echo $value ?>"><?php echo $value; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<button type="submit" class="btn btn-primary mr-2">
					<i class="fa fa-fw fa-filter"></i> 
					Filter Jadwal
				</button>
				<a href="<?php url('pendampingan/generate') ?>" class="btn btn-primary mr-2">
					<i class="fa fa-fw fa-random"></i> 
					Generate Jadwal
				</a>
				<a href="<?php url('pendampingan/multidelete') ?>" class="btn btn-danger">
					<i class="fa fa-fw fa-trash"></i> 
					Multi Delete
				</a>
			</form>
		</div>
		<div class="page-content">
        	<?php get_message_flash() ?>
			<div class="card">
				<div class="card-header">
					<h4 class="mt-1 mb-0">
						Data Jadwal Pendampingan
					</h4>
					<ul class="nav nav-tabs card-header-tabs pl-2 mt-2">
						<?php foreach ($minggu as $key => $value): ?>
							<li class="nav-item">
								<a class="nav-link<?php if($key == $active_minggu) echo ' active'; ?>" href="<?php url('pendampingan?t=' . $key . '&m=' . $active_m . '&y=' . $active_y); ?>">
									<?php echo (date('d', strtotime($value[0])) != date('d', strtotime($value[1])) ? date('d', strtotime($value[0])) . "-" : ""). date('d M', strtotime($value[1])); ?>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
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
										<?php 
										$proses = true;
										$in_date = date('Y-m-d', strtotime($minggu[$active_minggu][0] . ' +' . ($item->day - 1) . ' day'));
										if (date('Y-m-d') >= date('Y-m-d', strtotime($in_date))) {
											$proses = false;
										}
										if (isset($item->pendamping)): ?>
											<a href="<?php url('mahasiswa/volunteer/edit/' . $item->pendamping->student_id) ?>">
												<?php echo $item->pendamping->nick_name; ?>
											</a>
											<?php if ($proses): ?>
												<div class="float-right">
													<a href="<?php url('pendampingan/delete/' . $item->pendamping->accompaniment_id ) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data jadwal?')" class="text-danger"><i class="fa fa-fw fa-trash"></i></a>
												</div>
											<?php endif ?>
										<?php elseif($proses): ?>
											<a href="<?php url('pendampingan/input/' . $item->schedule_student_id . '/' . date('Y-m-d', strtotime($in_date))) ?>"><i class="fa fa-fw fa-plus"></i>Tambah</a>
										<?php endif ?>
									</td>
								<?php else: ?>
									<td colspan="4"></td>
								<?php endif ?>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>