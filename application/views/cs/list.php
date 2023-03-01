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
					<h3 class="card-title"> <a href="<?= base_url('cs/dashboard/transaction'); ?>" class="btn btn-sm btn-warning">Kembali</a> Detail Item</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class=" table table-bordered" width="100%">
							 <thead>
								<tr>

									<th>Judul</th>
									<th>Jenis Instrumental</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Subtotal</th>
									<th>Status</th>


								</tr>
							</thead>
							<tbody>
								<?php foreach ($item as $c) : ?>


									<tr>

										<th><?= $c['title']; ?></th>
										<th><?= $c['genre']; ?></th>
										<th><?= idr($c['bill_price']); ?></th>
										<th><?= $c['qty'] ?></th>
										<th><?= idr($c['subtotal']); ?></th>
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