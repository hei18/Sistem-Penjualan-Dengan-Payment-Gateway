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
					<h5>Change Password</h5>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<form action="<?= base_url('admin/dashboard/changepassword'); ?>" method="post">
						<div class="row">
							<div class="col">
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="exampleInputPassword1">Current Password</label>
											<input type="password" class="form-control" id="old_pass" name="old_pass">
											<?= form_error('old_pass', '<small class="text-danger">', '</small>'); ?>
										</div>
										<div class="form-group">
											<label for="exampleInputPassword1">New Password</label>
											<input type="password" class="form-control" id="n_pass1" name="n_pass1">
											<?= form_error('n_pass1', '<small class="text-danger">', '</small>'); ?>
										</div>
										<div class="form-group">
											<label for="exampleInputPassword1">Confirm Password</label>
											<input type="password" class="form-control" id="n_pass2" name="n_pass2">
											<?= form_error('n_pass2', '<small class="text-danger">', '</small>'); ?>
										</div>
									</div>
									<div class="col">
									</div>
								</div>
							</div>
							<div class="col">
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
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