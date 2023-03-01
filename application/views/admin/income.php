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
					PPN
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>


									<th>Penjualan Dari</th>

									<th>Pendapatan</th>


								</tr>
							</thead>
							<tbody>
								<?php if (empty($webIncome)) : ?>
									<tr>
										<td colspan="7">
											<div class="alert alert-info" role="alert">
												Tidak Ada Data
											</div>
										</td>
									</tr>
								<?php endif; ?>
								<?php

								foreach ($webIncome as $key) : ?>
									<tr>

										<td><?= $key['email']; ?></td>
										<td class="text-right"><?= idr($key['ppn_income']); ?></td>



									</tr>
								<?php

								endforeach; ?>
								<tr>
									<th colspan="1" class="bg-light">Total Pendapatan</th>
									<th class="text-right bg-light">
										<?php if ($ppn == NULL) : ?>
											Rp.0
										<?php else : ?>
											<?= idr($ppn); ?>
										<?php endif; ?>

									</th>
								</tr>
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