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
					<h3 class="card-title">Cart</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class=" table table-bordered" width="100%">
							 <thead>
								<tr class="bg-light">
									<th>Title</th>
									<th>Qty</th>

									<th>Subtotal</th>

									<th>Action</th>

								</tr>
							</thead>
							<tbody>
								<?php if ($cart == null) : ?>
									<tr>
										<td colspan="4">
											<div class="alert alert-info" role="alert">
												No Data
											</div>
										</td>
									</tr>
								<?php else : ?>
								<?php endif; ?>
								<?php
								$total = 0;
								foreach ($cart as $c) : ?>
									<tr>

										<th><?= $c['title']; ?></th>
										<th><?= $c['qty']; ?></th>

										<th><?= idr($c['subtotal']); ?></th>

										<th class="text-right">
											<a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete <?= $c['title']; ?> ?')" href="<?= base_url('cs/dashboard/deleted/' . $c['id_cart']); ?>"><i class="far fa-trash-alt"></i></a>

										</th>
									</tr>


								<?php
									$total += $c['qty'] * $c['selling_price'];
								endforeach; ?>
								<tr>
									<th colspan="3" class="bg-light">Total Payment</th>
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
							<button class="col-12 btn-info" id="pay-button" data-amount="<?= $total; ?>">Pay!</button>
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