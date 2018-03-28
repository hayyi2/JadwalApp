		<div class="page-content">
        	<?php get_message_flash() ?>
			<div class="card">
				<div class="card-header">
					<h4 class="mt-1 mb-0">
						Data Pendampingan
					</h4>
				</div>
				<div class="pb-3 pt-3">
					<table class="table table-hover mb-0 datatable">
						<thead>
							<tr>
								<th width="5">No</th>
								<th>Nama</th>
								<th>Status</th>
								<th>Tanggal</th>
								<th>Jam</th>
								<th>Ruang</th>
								<th>Mata Kuliah</th>
								<th>Pendamping</th>
								<th>Status</th>
								<th>Review</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$hari = get_app_config('hari');
							$status = get_app_config('status');
							$star = array();
							for ($i=0; $i < 6; $i++) {
								if ($i == 0) {
									$star[$i] = '';
								} else {
									$star[$i] = $star[$i - 1] . '<i class="fa fa-star"></i>';
								}
							}
							foreach ($data as $no => $item): ?>
								<tr>
									<td width="5"><?php echo $no+1; ?></td>
									<td>
										<a href="<?php url('mahasiswa/edit/' . $item->student_id) ?>">
											<?php echo $item->nick_name; ?>
										</a>
									</td>
									<td><?php echo $status[$item->student_status]; ?></td>
									<td><?php echo $hari[$item->day] . ', ' . date_html($item->date); ?></td>
									<td><?php echo time_html($item->start_at) . "-" . time_html($item->end_at); ?></td>
									<td><?php echo $item->room; ?></td>
									<td><?php echo $item->courses; ?></td>
									<td>
										<a href="<?php url('mahasiswa/volunteer/edit/' . $item->volunteer_id) ?>">
											<?php echo $item->volunteer_nick_name; ?>
										</a>
									</td>
									<td><?php echo $status[$item->volunteer_status]; ?></td>
									<td><small><?php echo $star[$item->review]; ?></small></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<script>
					$(document).ready(function() {
						$('.datatable').DataTable();
					} );
				</script>
			</div>
		</div>