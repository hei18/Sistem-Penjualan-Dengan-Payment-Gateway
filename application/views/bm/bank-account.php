<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col">
					<h1><?= $tittle; ?></h1>
				</div>

				<div class="col d-flex justify-content-end">

					<a href="<?= base_url("bm/channel/uploadcontent"); ?>" class="btn btn-app d-none d-lg-block">
						<i class="fa-solid fa-arrow-up-from-bracket fa-2x"></i>
						<h5>Upload</h5>
					</a>



				</div>
				<!-- /.info-box -->
			</div>


		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="alert alert-info alert-dismissible fade show d-md-none" role="alert">
				<span class="alert-text">
					Anda hanya bisa upload instrumental di versi website</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<?= $this->session->flashdata('message'); ?>
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title">Bank</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<form action="<?= base_url('bm/channel/bank_account'); ?>" method="post">
								<label for="disabledSelect">Nama Bank</label>
								<select id="bank_name" name="bank_name" class="form-control">
									<option value="">Pilih Bank</option>
									<option value="BCA">BCA</option>
									<option value="BNI">BNI</option>
									<option value="BRI">BRI</option>
									<option value="Mandiri">Mandiri</option>
								</select>
								<?= form_error('bank_name', '<small class=" text-danger">', '</small>'); ?>
								<div class="form-group">
									<label for="exampleInputEmail1">Nomor Rekening</label>
									<input autocomplete="off" type="text" name="bank_number" id="bank_number" class="form-control">
									<?= form_error('bank_number', '<small class=" text-danger">', '</small>'); ?>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-header bg-danger">
							<h3 class="card-title">Akun Bank Anda</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead class="thead-dark">
										<tr>

											<th scope="col">Bank</th>
											<th scope="col">Nomor Rekening</th>
											<th scope="col">Aksi</th>
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
												<td>
													<a class="btn btn-sm btn-danger" onclick="return confirm('Are you want to delete Bank <?= $b['bank_name']; ?> ?')" href="<?= base_url('bm/channel/deleteBank/' . $b['id_bank']); ?>"><i class="far fa-trash-alt"></i></a>

												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>

							</div>



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