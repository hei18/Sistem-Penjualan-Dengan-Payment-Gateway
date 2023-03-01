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
			<div class="alert alert-info alert-dismissible fade show d-md-none" role="alert">

			</div>
			<?= $this->session->flashdata('message'); ?>
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title">Ubah Password</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<form action="<?= base_url('bm/channel/setting'); ?>" method="post">
								<div class="form-group">
									<label for="exampleInputPassword1">Password Saat Ini</label>
									<input type="password" class="form-control" id="old_pass" name="old_pass">
									<?= form_error('old_pass', '<small class="text-danger">', '</small>'); ?>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Password Baru</label>
									<input type="password" class="form-control" id="n_pass1" name="n_pass1">
									<?= form_error('n_pass1', '<small class="text-danger">', '</small>'); ?>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Ulangi Password Baru</label>
									<input type="password" class="form-control" id="n_pass2" name="n_pass2">
									<?= form_error('n_pass2', '<small class="text-danger">', '</small>'); ?>
								</div>
								<button type="submit" name="change" id="change" value="change" class="btn btn-primary">Submit</button>
							</form>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-header bg-danger">
							<h3 class="card-title">Permintaan Penghapusan</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<p>Ingat jika anda menghapus akun anda, maka seluruh data anda akan terhapus
								<br>
								Seiring anda mengajukan permintaan penghapusan, anda tidak akan bisa login kembali
								<br>
								Jika anda serius ingin menghapus akun anda ketikan "DELETED"
							</p>
							<form action="<?= base_url('bm/channel/setting'); ?>" method="post">
								<div class="form-group">
									<label for="exampleInputPassword1">Permintaan</label>
									<input autocomplete="off" type="text" class="form-control" id="request_delete" name="request_delete">
									<?= form_error('request_delete', '<small class="text-danger">', '</small>'); ?>

								</div>

								<button type="submit" name="delete" id="delete" value="delete" class="btn btn-danger">Submit</button>
							</form>
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