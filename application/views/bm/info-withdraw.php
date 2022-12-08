<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col">
					<h1><?= $tittle; ?></h1>
				</div>


			</div>


		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?= $this->session->flashdata('message'); ?>

			<div class="card">

				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>

									<th>Income</th>
									<th>Bank Account</th>
									<th>Date Withdraw</th>
									<th>Status</th>

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
										<td><?= idr($d['net_income']); ?></td>
										<td><?= $d['bank_name']; ?> - <?= $d['bank_number']; ?></td>
										<td><?= indonesian_date($d['date_wd']); ?></td>
										<td>
											<?php if ($d['status_income'] == 0) : ?>
												<span class="badge badge-warning">pending</span>
											<?php else : ?>
												<span class="badge badge-succes">success</span>

											<?php endif; ?>
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