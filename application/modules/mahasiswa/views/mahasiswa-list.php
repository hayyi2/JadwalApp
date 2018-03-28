		<div class="page-title">
			<h2 class="text-center">Master <?php echo ucwords($type); ?></h2>
		</div>
		<div class="page-content">
        	<?php get_message_flash() ?>
			<div class="card">
				<div class="card-header">
					<div class="float-right">
						<a href="<?php url('mahasiswa/' . ($type == "mahasiswa" ? "" : "volunteer/") . 'input') ?>" class="btn btn-primary btn-sm">
							<i class="fa fa-fw fa-plus"></i> 
							Tambah <?php echo ucwords($type); ?>
						</a>
					</div>
					<h4 class="mt-1 mb-0">
						Data <?php echo ucwords($type); ?>
					</h4>
				</div>
				<div class="pt-3 pb-3">
					<table class="table table-striped table-hover mb-0 datatable">
						<thead>
							<tr>
								<th width="5">No</th>
								<th>Nama</th>
								<th>NIM</th>
								<th>Fakultas</th>
								<th>Jurusan</th>
								<th>Angkatan</th>
								<th>No Hp</th>
								<th>Dibuat</th>
								<th width="5">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $no => $item): ?>
								<tr>
									<td width="5"><?php echo $no + 1; ?></td>
									<td>
										<?php echo $item->full_name; ?>
										<small class="text-secondary">(<?php echo $item->nick_name; ?>)</small>
									</td>
									<td><?php echo $item->username; ?></td>
									<td><?php echo $item->faculty_name; ?></td>
									<td><?php echo $item->majors_name; ?></td>
									<td><?php echo $item->class_of_college; ?></td>
									<td><?php echo $item->no_hp; ?></td>
									<td><?php echo datetime_html($item->created_at); ?></td>
									<td class="text-center text-nowrap">
										<a href="<?php url('mahasiswa/' . ($type == "mahasiswa" ? "" : "volunteer/") . 'edit/' . $item->student_id ) ?>"><i class="fa fa-fw fa-pencil"></i></a> 
										<a href="<?php url('mahasiswa/' . ($type == "mahasiswa" ? "" : "volunteer/") . 'delete/' . $item->student_id ) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data <?php echo $item->full_name; ?>?')" class="text-danger"><i class="fa fa-fw fa-trash"></i></a>
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