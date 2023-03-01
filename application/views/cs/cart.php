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
		</div>
	</section>
	<!-- /.container-fluid -->


	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?= $this->session->flashdata('message'); ?>

			<div class="card">
				<div class="card-header bg-warning">
					<h3 class="card-title"><?= $tittle; ?></h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">

						<table class=" table table-bordered" width="100%">
							 <thead>
								<tr class="bg-light">

									<th>Aksi</th>
									<th>Judul Instrumental</th>
									<th>Jumlah</th>

									<th>Harga</th>
									<th>Subtotal</th>


								</tr>
							</thead>
							<tbody>
								<?php if ($cart == null) : ?>
									<tr>
										<td colspan="5">
											<div class="alert alert-info" role="alert">
												Tidak Ada Data
											</div>
										</td>
									</tr>
								<?php else : ?>
								<?php endif; ?>
								<?php
								$total = 0;
								foreach ($cart as $c) : ?>
									<form action="<?= base_url('cs/dashboard/updatecart/'); ?>" method="post">
										<tr>
											<input type="hidden" name="id_cart" value="<?= $c['id_cart']; ?>">
											<input type="hidden" name="bill_price" value="<?= $c['bill_price']; ?>">
											<th class="text-right">
												<button class="btn btn-sm btn-warning" type="submit" name="submit">Ubah</button>

												<a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete <?= $c['title']; ?> ?')" href="<?= base_url('cs/dashboard/deleted/' . $c['id_cart']); ?>"><i class="far fa-trash-alt"></i></a>

											</th>
											<th><?= $c['title']; ?></th>
											<th> <input type="number" name="qty" id="qty" value="<?= $c['qty']; ?>" min="1">

											</th>

											<th class="text-right"><?= idr($c['bill_price']); ?></th>
											<th class="text-right"><?= idr($c['subtotal']); ?></th>

										</tr>

									</form>


								<?php
									$total += $c['qty'] * $c['bill_price'];
								endforeach; ?>
								<tr>
									<th colspan="4" class="bg-light">Total Harga</th>
									<th class="text-right bg-light">
										<?= idr($total); ?>

									</th>
								</tr>
							</tbody>

						</table>


						<form id="payment-form" method="post" action="<?= site_url() ?>cs/snap/finish">
							<input type="hidden" name="result_type" id="result-type" value="">
							<input type="hidden" name="result_data" id="result-data" value="">
						</form>
						<?php if ($cart == null) : ?>
						<?php else : ?>
							<button class="col-12 btn-info" id="pay-button" data-amount="<?= $total; ?>">Bayar</button>
						<?php endif; ?>


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