		<div class="page-title">
			<h2 class="text-center">Master Administrator</h2>
		</div>
		<div class="page-content mb-3">
        	<?php get_message_flash() ?>
			<div class="card">
				<div class="card-header">
					<div class="float-right">
						<a href="<?php url('admin/input') ?>" class="btn btn-primary btn-sm">
							<i class="fa fa-fw fa-plus"></i> 
							Tambah Administrator
						</a>
					</div>
					<h4 class="mt-1 mb-0">
						Data Administrator
					</h4>
				</div>
				<div class="pt-3 pb-3">
					<table class="table table-striped table-hover mb-0 datatable">
						<thead>
							<tr>
								<th width="5">No</th>
								<th>Nama Lengkap</th>
								<th>Nama Panggilan</th>
								<th>Username</th>
								<th>Terakhir Login</th>
								<th>Dibuat</th>
								<th width="5">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $no => $item): ?>
								<tr>
									<td width="5"><?php echo $no + 1; ?></td>
									<td><?php echo $item->full_name; ?></td>
									<td><?php echo $item->nick_name; ?></td>
									<td><?php echo $item->username; ?></td>
									<td><?php echo datetime_html($item->last_login) . ' <span class="badge badge-secondary">' . $item->login_count . '</span>' ; ?></td>
									<td><?php echo datetime_html($item->created_at); ?></td>
									<td class="text-center text-nowrap">
										<a href="<?php url('admin/edit/' . $item->user_id ) ?>"><i class="fa fa-fw fa-pencil"></i></a> 
										<?php if ($no > 0): ?>
											<a onclick="return confirm('Apakah anda yakin akan menghapus data <?php echo $item->full_name; ?>?')" href="<?php url('admin/delete/' . $item->user_id ) ?>" class="text-danger"><i class="fa fa-fw fa-trash"></i></a>
										<?php endif ?>
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