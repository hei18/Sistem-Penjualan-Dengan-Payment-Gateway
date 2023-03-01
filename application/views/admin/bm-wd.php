<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col">
					<h1><?= $tittle; ?></h1>
				</div>


				<!-- /.info-box -->
			</div>


		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?= $this->session->flashdata('message'); ?>

			<div class="card">
				<div class="card-header bg-warning">
					Permintaan Penarikan
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>
									<th>ID Penarikan</th>
									<th>Permintaan Penarikan</th>
									<th>Dari</th>
									<th>Akun Bank</th>
									<th>Tanggal Penarikan</th>
									<th>Tanggal Transfer</th>
									<th>Status</th>
									<th>Aksi</th>

								</tr>
							</thead>
							<tbody>
								<?php if (empty($wd)) : ?>
									<tr>
										<td colspan="7">
											<div class="alert alert-info" role="alert">
												No Data
											</div>
										</td>
									</tr>
								<?php endif; ?>
								<?php foreach ($wd as $d) : ?>
									<tr>
										<td><?= $d['wd_id']; ?></td>
										<td><?= idr($d['net_income']); ?></td>
										<td><?= $d['email']; ?></td>
										<td><?= $d['bank_name']; ?> - <?= $d['bank_number']; ?></td>
										<td><?= indonesian_date($d['date_wd']); ?></td>
										<td><?= indonesian_date($d['date_approve']); ?></td>
										<td>
											<?php if ($d['status_income'] == 0) : ?>
												<span class="badge badge-warning">Pending</span>
											<?php else : ?>
												<span class="badge badge-success">Success</span>

											<?php endif; ?>
										</td>
										<td>
											<form action="<?= base_url('admin/dashboard/requestWd'); ?>" method="post">
												<input type="hidden" name="net_income" id="net_income" value="<?= $d['net_income']; ?>">
												<input type="hidden" name="wd_id" id="wd_id" value="<?= $d['wd_id']; ?>">
												<input type="hidden" name="email" id="email" value="<?= $d['email']; ?>">
												<input type="hidden" name="date_wd" id="date_wd" value="<?= $d['date_wd']; ?>">
												<?php if ($d['status_income'] == 0) : ?>
													<button type="submit" class="btn btn-info">
														submit
													</button>
												<?php else : ?>


												<?php endif; ?>


											</form>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.card-body -->
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->