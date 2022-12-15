<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col">
					<h1><?= $tittle; ?></h1>
				</div>


				<!-- /.info-box -->
			</div>


		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?= $this->session->flashdata('message'); ?>

			<div class="card">
				<div class="card-header bg-warning">
					All Customer
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">

						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Nickname</th>
									<th>Eamail</th>
									<th>Request Status</th>
									<th>Action</th>


								</tr>
							</thead>
							<tbody>
								<?php foreach ($cs as $d) : ?>
									<tr>

										<td>
											<?= $d['id_cs']; ?>
											<?= $d['nickname'] ?>
										</td>
										<td>
											<?= $d['email'] ?>
										</td>
										<td>
											<?= $d['request_delete'] ?>
										</td>
										<td>
											<?php if ($d['request_delete'] == "DELETED") : ?>
												<a class="btn btn-sm btn-danger" onclick="return confirm('Request delte from <?= $d['nickname']; ?> ')" href="<?= base_url('admin/dashboard/requestdeleteCs/' . $d['id_cs']); ?>"><i class="far fa-trash-alt"></i></a>
											<?php elseif ($d['request_delete'] == NULL) : ?>
											<?php endif; ?>

											<a href="<?= base_url('admin/dashboard/detailUserCustomer/' . $d['id_cs']); ?>" class="btn btn-sm btn-primary">
												<i class="fa-solid fa-circle-info"></i>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
						</table>
					</div>
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
<!-- Modal -->
<?php foreach ($details as $d) :
	$id = $d['id_cs'];
?>
	<div class="modal fade" id="exampleModal<?= $d['id_cs']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="row">
							<div class="col">

								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Phone Number</label>
									<input type="text" class="form-control" value="<?= $d['phone_number']; ?>">
								</div>
							</div>
							<div class="col">

								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Address</label>
									<textarea class="form-control" name="" id="" cols="30" rows="0"><?= $d['address']; ?></textarea>
								</div>
							</div>
						</div>


					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- Main Footer -->