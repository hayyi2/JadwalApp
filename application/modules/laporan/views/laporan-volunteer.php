		<div class="page-content">
        	<?php get_message_flash() ?>
			<div class="card">
				<div class="card-header">
					<h4 class="mt-1 mb-0">
						Ringkasan Volunteer
					</h4>
				</div>
				<div class="pb-3 pt-3">
					<table class="table table-hover mb-0 datatable">
						<thead>
							<tr>
								<th width="5">No</th>
								<th>Nama Volunteer</th>
								<th>Mendampingi</th>
								<th>Izin</th>
								<th>Tidak Datang</th>
								<th>Min Review</th>
								<th>Max Review</th>
								<th>Rata-Rata</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $no => $item): ?>
								<tr>
									<td width="5"><?php echo $no+1; ?></td>
									<td>
										<a href="<?php url('mahasiswa/edit/' . $item->student_id) ?>">
											<?php echo $item->full_name; ?> 
											<small class="text-secondary">(<?php echo $item->nick_name; ?>)</small>
										</a>
									</td>
									<td><?php echo $item->mendampingi; ?></td>
									<td><?php echo $item->izin; ?></td>
									<td><?php echo $item->tidak_datang; ?></td>
									<td><?php echo $item->min_review; ?></td>
									<td><?php echo $item->max_review; ?></td>
									<td><?php echo $item->avg_review; ?></td>
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