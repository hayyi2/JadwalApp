		<div class="page-title">
			<h2 class="text-center">Master Jadwal Mahasiswa</h2>
		</div>
		<div class="page-content">
        	<?php get_message_flash() ?>
			<div class="card">
				<div class="card-header">
					<h4 class="mt-1 mb-0">
						Data Jadwal Mahasiswa
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
							<th width="5">Aksi</th>
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
										</a><br>
										<a href="<?php url('jadwal/mahasiswa/input/' . $item->student_id) ?>" class="btn btn-primary mt-1 btn-sm">Tambah Jadwal</a>
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
										while(isset($data[$no + $rowspan2]) && $data[$no + $rowspan2]->day == $item->day){
											$rowspan2++;
										}
										?>
										<td rowspan="<?php echo $rowspan2;?>"><?php echo $hari[$item->day]; ?></td>
									<?php else: $rowspan2--;?>
									<?php endif ?>
									<td><?php echo time_html($item->start_at) . " - " . time_html($item->end_at); ?></td>
									<td><?php echo $item->room; ?></td>
									<td><?php echo $item->courses; ?></td>
									<td class="text-center text-nowrap">
										<a href="<?php url('jadwal/mahasiswa/edit/' . $item->schedule_student_id ) ?>"><i class="fa fa-fw fa-pencil"></i></a> 
										<a href="<?php url('jadwal/mahasiswa/delete/' . $item->schedule_student_id ) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data jadwal?')" class="text-danger"><i class="fa fa-fw fa-trash"></i></a>
									</td>
								<?php else: ?>
									<td colspan="5"></td>
								<?php endif ?>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<div class="card-footer text-secondary">
					Jumlah: <?php echo count($data) ?> Jadwal Mahasiswa
				</div>
			</div>
		</div>