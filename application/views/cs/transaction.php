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
				<div class="card-header bg-primary">
					<h3 class="card-title">Detail Item</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class=" table table-bordered" width="100%">
							 <thead>
								<tr>
									<th>Title</th>
									<th>Item</th>
									<th>Status</th>


								</tr>
							</thead>
							<tbody>
								<?php foreach ($item as $c) : ?>


									<tr>
										<th><?= $c['title']; ?></th>
										<th><?= $c['full_version']; ?></th>
										<th>
											<?php if ($c['status'] == 1) : ?>
												<span class="badge badge-success">Sent</span>
											<?php else : ?>
												<span class="badge badge-warning">Pending</span>
											<?php endif; ?>
										</th>
									</tr>



								<?php endforeach; ?>
							</tbody>
						</table>
					</div>

				</div>
				<!-- /.card-body -->

			</div>

			<div class="card">
				<div class="card-header bg-primary">
					<h3 class="card-title">DataTable with minimal features & hover style</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class=" table table-bordered" width="100%">
							 <thead>
								<tr>
									<th>Order Id</th>
									<th>Full Name</th>
									<th>Transaction Time</th>
									<th>Bank</th>
									<th>VA Number</th>
									<th>Bill Key</th>
									<th>Bill Code</th>
									<th>Status</th>
									<th>Action</th>

								</tr>
							</thead>
							<tbody>
								<?php foreach ($bill as $c) : ?>

									<form class="form-group" action="<?= base_url('cs/transaction/status'); ?>" method="post">
										<?= form_hidden('order_id', $c['order_id']); ?>
										<tr>
											<th><?= $c['order_id']; ?></th>
											<th><?= $c['first_name']; ?> <?= $c['last_name']; ?></th>
											<th><?= indonesian_date($c['transaction_time']); ?></th>
											<th><?= $c['bank']; ?></th>
											<th><?= $c['va_number']; ?></th>
											<th><?= $c['bill_key']; ?></th>
											<th><?= $c['biller_code']; ?></th>
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
												<?php if ($c['status_code'] == 201) : ?>

													<a class="btn btn-info" href="<?= $c['pdf_url']; ?>">Download</a>
													<button type="submit" class="btn btn-warning">Give Me Beat</button>
												<?php elseif ($c['status_code'] == 200) : ?>


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