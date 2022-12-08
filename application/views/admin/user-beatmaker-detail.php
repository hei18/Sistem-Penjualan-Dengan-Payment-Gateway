<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-1">
					<a href="<?= base_url('admin/dashboard/beatmaker'); ?>" class="btn btn-warning">Back</a>

				</div>
				<div class="col">
					<h1><?= $tittle; ?> : NONE</h1>

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
									No Data, The user has not completed the profile
								</div>
							<?php else : ?>
								<form>
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="exampleInputEmail1">First Name</label>
												<input type="text" class="form-control" value="<?= $bmdata['first_name']; ?>" readonly>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Phone Number</label>
												<input type="text" class="form-control" value="<?= $bmdata['phone_number']; ?>" readonly>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="exampleInputEmail1">Last Name</label>
												<input type="text" class="form-control" value="<?= $bmdata['last_name']; ?>" readonly>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Phone Number</label>
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
							<h3 class="card-title">Your Bank Account</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?php if ($bank == null) : ?>
								<div class="alert alert-danger" role="alert">
									No Data, The user has not completed the bank data
								</div>
							<?php else : ?>
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead class="thead-dark">
											<tr>

												<th scope="col">Bank</th>
												<th scope="col">Bank Number</th>

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