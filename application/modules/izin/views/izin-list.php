		<div class="page-title">
			<h2 class="text-center">Data Surat Izin</h2>
		</div>
		<div class="page-content">
        	<?php get_message_flash() ?>
			<div class="card">
				<div class="card-header">
					<h4 class="mt-1 mb-0">
						Data Surat Izin
					</h4>
				</div>
				<div class="pt-3 pb-3">
					<table class="table table-striped table-hover mb-0 datatable">
						<thead>
							<tr>
								<th width="5">No</th>
								<th>Pengirim</th>
								<th>Keterangan</th>
								<th>Dibuat</th>
								<th>Mahasiswa</th>
								<th>Pendamping</th>
								<th>Tanggal</th>
								<th width="5">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $no => $item): ?>
								<tr>
									<td width="5"><?php echo $no+1; ?></td>
									<td><?php echo ($item->student == 1 ? "Mahasiswa" : "Volunteer"); ?></td>
									<td><?php echo $item->clarification; ?></td>
									<td><?php echo datetime_html($item->created_at); ?></td>
									<td>
										<a href="<?php url('mahasiswa/edit/' . $item->student_id) ?>">
											<?php echo $item->nick_name; ?>
										</a>
									</td>
									<td>
										<a href="<?php url('mahasiswa/volunteer/edit/' . $item->volunteer_id) ?>">
											<?php echo $item->volunteer_nick_name; ?>
										</a>
									</td>
									<td>
										<a href="<?php url('jadwal/mahasiswa/edit/' . $item->schedule_student_id) ?>">
											<?php echo date_html($item->date); ?>
										</a>
									</td>
									<td width="5" class="text-center">
										<a href="<?php url('izin/delete/' . $item->permit_id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data?')" class="text-danger"><i class="fa fa-fw fa-trash"></i></a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<script>
					$(document).ready(function() {
						$('.datatable').DataTable({
							'aoColumnDefs': [{'bSortable': false, 'targets': [-1]}]
						});
					} );
				</script>
			</div>
		</div>