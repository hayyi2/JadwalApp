		<div class="page-title">
			<h2 class="text-center">Master Fakultas dan Jurusan</h2>
		</div>
		<div class="page-content mb-3">
			<div class="row d-flex justify-content-center">
				<div class="col-md-7">
					<?php get_message_flash() ?>
					<div class="card">
						<div class="card-header">
							<div class="float-right">
								<a href="<?php url('fakultas/input') ?>" class="btn btn-primary btn-sm">
									<i class="fa fa-fw fa-plus"></i> 
									Tambah Fakultas
								</a>
							</div>
							<h4 class="mt-1 mb-0">
								Data Fakultas dan Jurusan
							</h4>
						</div>
						<table class="table table-hover mb-0">
							<thead>
								<tr>
									<th width="5">No</th>
									<th>Fakultas</th>
									<th>Jurusan</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$rowspan = 1;
								$fakultas = 0;
								$jurusan = 0;
								foreach ($data as $no => $item): ?>
									<tr>
										<td width="5"><?php echo $no + 1; ?></td>
										<?php if ($rowspan == 1): $fakultas++; ?>
											<td rowspan="<?php 
												while(isset($data[$no + $rowspan]) && $data[$no + $rowspan]->faculty_id == $item->faculty_id){
													$rowspan++;
												}
												echo $rowspan;
												?>">
												<div class="float-right">
													<a href="<?php url('fakultas/edit/' . $item->faculty_id ) ?>"><i class="fa fa-fw fa-pencil"></i></a> 
													<a href="<?php url('fakultas/jurusan/input/' . $item->faculty_id ) ?>" title="Tambah Jurusan"><i class="fa fa-fw fa-plus"></i></a> 
													<a onclick="return confirm('Apakah anda yakin akan menghapus data?')" href="<?php url('fakultas/delete/' . $item->faculty_id ) ?>" class="text-danger"><i class="fa fa-fw fa-trash"></i></a>
												</div>
												<?php echo $item->faculty_name; ?>
											</td>
										<?php else: $rowspan--;?>
										<?php endif ?>
										<td>
											<?php if ($item->majors_name != ""): $jurusan++; ?>
												<div class="float-right">
													<a href="<?php url('fakultas/jurusan/edit/' . $item->majors_id ) ?>"><i class="fa fa-fw fa-pencil"></i></a> 
													<a onclick="return confirm('Apakah anda yakin akan menghapus data?')" href="<?php url('fakultas/jurusan/delete/' . $item->majors_id ) ?>" class="text-danger"><i class="fa fa-fw fa-trash"></i></a>
												</div>
											<?php endif ?>
											<?php echo $item->majors_name; ?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
						<div class="card-footer text-secondary">
							Jumlah: <?php echo $fakultas ?> Fakultas dan <?php echo $jurusan ?> Jurusan
						</div>
					</div>
				</div>
			</div>
		</div>