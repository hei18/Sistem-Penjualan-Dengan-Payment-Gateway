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
				<div class="card-header bg-warning">
					Pencarian
				</div>
				<div class="card-body">

					<form class="form-inline" method="POST">
						<label>Dari Tanggal</label>
						<input type="date" class="form-control mx-sm-3" name="from">
						<label>Hingga Tanggal</label>
						<input type="date" class="form-control mx-sm-3" name="until">

						<button type="submit" class="btn btn-sm btn-primary mt-2"><i class="fas fa-search"></i></button>

					</form>
				</div>
			</div>
			<div class="card">
				<div class="card-header bg-warning">
					Print
				<?php if ($this->session->flashdata('from') && $this->session->flashdata('until')) : ?>

						<a href="<?= base_url('bm/channel/printWd/' . $this->session->userdata('id_user') . '/' . $this->session->flashdata('from') . '/' . $this->session->flashdata('until')); ?>" class="btn btn-sm btn-info">
							<i class="fas fa-print"></i>
						</a>
					<?php endif; ?>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
				    
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>
									<th>Id Penarikan</th>
									<th>Pendapatan</th>
									<th>Akun Bank</th>
									<th>Tanggal Penarikan</th>
									<th>Tanggal Di Transfer</th>
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
								<?php
								$reportWd = $this->session->flashdata('reportWd');
								if ($reportWd) :
									foreach ($wd as $d) : ?>
										<tr>
											<td><?= $d['wd_id']; ?></td>
											<td><?= idr($d['net_income']); ?></td>
											<td><?= $d['bank_name']; ?> - <?= $d['bank_number']; ?></td>
											<td><?= indonesian_date($d['date_wd']); ?></td>
											<td><?= indonesian_date($d['date_approve']); ?></td>
											<td>
												<?php if ($d['status_income'] == 0) : ?>
													<span class="badge badge-warning">pending</span>
												<?php else : ?>
													<span class="badge badge-succes">success</span>

												<?php endif; ?>
											</td>
										</tr>
									<?php
									endforeach;

									?>
								<?php endif; ?>
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