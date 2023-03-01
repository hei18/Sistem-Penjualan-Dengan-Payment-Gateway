<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col">
					<h1><?= $tittle; ?> : <?= $users['first_name'] . ' ' . $users['last_name']; ?></h1>
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
					<h3 class="card-title"> <a href="<?= base_url('admin/dashboard/customer'); ?>" class="btn btn-sm btn-info">Kembali</a></h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class=" table table-bordered" width="100%">
							 <thead>
								<tr>
									<th>Order Id</th>

									<th>Tanggal Transaksi</th>
									<th>Bayar di & Kode Bank</th>

									<th>Nomor Virtual Akun</th>
									<th>Panduan</th>
									<th>Detail Info</th>
									<th>Status</th>
									<th>Cek Status</th>


								</tr>
							</thead>
							<tbody>
								<?php foreach ($bill as $c) :


								?>

									<form class="form-group" action="<?= base_url('cs/transaction/status'); ?>" method="post">
										<?= form_hidden('order_id', $c['order_id']); ?>

										<tr>

											<th><?= $c['order_id']; ?></th>

											<th><?= indonesian_date($c['transaction_time']); ?></th>
											<th><?= $c['bank']; ?> (<?= $c['biller_code']; ?>)</th>
											<th><?= $c['va_number']; ?></th>



											<th>
												<?php if ($c['status_code'] == 201) : ?>
													<span class="badge badge-warning">pending</span>

												<?php elseif ($c['status_code'] == 200) : ?>
													<span class="badge badge-success">success</span>
												<?php else : ?>
													<span class="badge badge-danger">timeout</span>
												<?php endif ?>
											</th>
											<th>
												<a class="btn btn-sm btn-info" href="<?= base_url('admin/dashboard/item?orderID=') . base64_encode($c['order_id']) . '&key=' . base64_encode($c['id_cs']); ?>">
													<i class="fa-solid fa-eye"></i>
												</a>
											</th>
											<th>


												<?php if ($c['status_code'] == 201) : ?>
													<a class="btn btn-sm btn-info" href="<?= base_url('cs/handler/d?uid=') . base64_encode($c['order_id']) . '&key=' . base64_encode($c['payment_type']); ?>">Check Status</a>

												<?php elseif ($c['status_code'] == 200) : ?>
													<span class="badge badge-success">Success</span>
												<?php endif; ?>


											</th>
											<th>
												<?php if ($c['status_code'] == 201) : ?>

												<?php elseif ($c['status_code'] == 200) : ?>
													<?php if ($c['button_handle'] == 0) : ?>
														<button type="submit" class="btn btn-sm btn-warning">Give Me Beat</button>

													<?php elseif ($c['button_handle'] == 1) : ?>
														<span class="badge badge-success">Success</span>
													<?php endif; ?>

												<?php else : ?>
												<?php endif ?>




											</th>

										</tr>
									</form>


								<?php endforeach; ?>
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