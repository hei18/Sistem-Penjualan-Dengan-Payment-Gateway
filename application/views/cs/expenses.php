<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col">
					<h1><?= $tittle; ?> untuk: <?= $users['first_name'] . ' ' . $users['last_name']; ?></h1>
				</div>
			</div>
		</div>
	</section>
	<!-- /.container-fluid -->


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
					<h3 class="card-title">Transaksi

						<?php if ($this->session->flashdata('from') && $this->session->flashdata('until')) : ?>
							<a href="<?= base_url('cs/dashboard/printExpenses/' . $this->session->userdata('id_cs') . '/' . $this->session->flashdata('from') . '/' . $this->session->flashdata('until')); ?>" class="btn btn-sm btn-success">
								<i class="fas fa-print"></i>
							</a>
						<?php endif; ?>
					</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class=" table table-bordered" width="100%">
							 <thead>
								<tr>
									<th>Hari Transaksi </th>
									<th>Hari Pembayaran</th>
									<th>Item</th>
									<th>Jumlah Pengeluaran</th>

								</tr>
							</thead>
							<tbody>
								<?php
								$expenses = $this->session->flashdata('expenses');

								if ($expenses) :
									foreach ($expenses as $c) :
										$date_tr = $c['transaction_time'];
										$date_stl = $c['settlement_time'];

										$defineTrFormated = date_create($date_tr);
										$defineStlFormated = date_create($date_stl);

								?>
										<tr>
											<th>
												<?= indonesian_date($c['transaction_time']); ?>
												/
												<?php if ($c['transaction_time'] != NULL) :
													$format_date = date_format($defineTrFormated, 'H:i:s');
												?>
													<?= $format_date; ?>
												<?php elseif ($c['transaction_time'] == NULL) : ?>
												<?php endif ?>
											</th>
											<th>
												<?= indonesian_date($c['settlement_time']); ?>
												/
												<?php if ($c['settlement_time'] != NULL) :
													$formatStl = date_format($defineStlFormated, 'H:i:s');
												?>
													<?= $formatStl; ?>
												<?php elseif ($c['settlement_time'] == NULL) : ?>
												<?php endif ?>
											</th>
											<th><?= $c['title']; ?></th>
											<th><?= idr($c['bill_price']); ?></th>
										</tr>



								<?php
									endforeach;
								endif;
								?>
								<tr>
									<th colspan="3">TOTAL</th>
									<th>
										<?php
										$sum = $this->session->flashdata('sum');
										if ($sum == NULL) : ?>
											Rp.0
										<?php elseif ($sum != NULL) : ?>
											<?= idr($this->session->flashdata('sum')); ?>
										<?php endif; ?>
									</th>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
				<!-- /.card-body -->

			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class=" control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->