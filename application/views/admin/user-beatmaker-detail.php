<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-1">
					<a href="<?= base_url('admin/dashboard/beatmaker'); ?>" class="btn btn-warning">Kembali</a>

				</div>
				<div class="col">
					<?php if ($bmdata == NULL) : ?>
						<h1><?= $tittle; ?> : NONE</h1>
					<?php else : ?>
						<h1><?= $tittle; ?> : <?= $bmdata['nickname']; ?></h1>
					<?php endif; ?>

				</div>

			</div>


		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<?= $this->session->flashdata('message'); ?>

			<div class="row">

				<div class="col">
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title">Detail</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?php if ($bmdata == null) : ?>
								<div class="alert alert-danger" role="alert">
									Tidak ada data
								</div>
							<?php else : ?>
								<form>
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="exampleInputEmail1">Nama Depan</label>
												<input type="text" class="form-control" value="<?= $bmdata['first_name']; ?>" readonly>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Nomor Ponsel</label>
												<input type="text" class="form-control" value="<?= $bmdata['phone_number']; ?>" readonly>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="exampleInputEmail1">Nama Belakang</label>
												<input type="text" class="form-control" value="<?= $bmdata['last_name']; ?>" readonly>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Alamat Lengkap</label>
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="1"><?= $bmdata['address']; ?></textarea>
											</div>
										</div>
									</div>
								</form>
							<?php endif; ?>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-header bg-danger">
							<h3 class="card-title">Akun Bank</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?php if ($bank == null) : ?>
								<div class="alert alert-danger" role="alert">
									Tidak ada data
								</div>
							<?php else : ?>
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead class="thead-dark">
											<tr>

												<th scope="col">Bank</th>
												<th scope="col">Nomor Rekening</th>

											</tr>
										</thead>
										<tbody>

											<?php foreach ($bank as $b) : ?>
												<tr>

													<td>
														<?= $b['bank_name']; ?>
													</td>
													<td>
														<?= $b['bank_number']; ?>
													</td>

												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>

								</div>
							<?php endif; ?>

						</div>
						<!-- /.card-body -->
					</div>
				</div>
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