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
					<h5>All BeatMaker</h5>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">

						<table class="table table-bordered table-hover">
							<thead>
								<tr>

									<th>Nickname</th>
									<th>Eamail</th>
									<th>Request DELETE</th>
									<th>Action</th>


								</tr>
							</thead>
							<tbody>
								<?php foreach ($bm as $d) : ?>
									<tr>


										<td>
											<?= $d['nickname'] ?>
										</td>
										<td>
											<?= $d['email'] ?>
										</td>
										<td>
											<?php if ($d['request_delete'] == "DELETED") : ?>
												REQUEST TO DELETE
											<?php elseif ($d['request_delete'] == NULL) : ?>
												NO REQUEST
											<?php endif; ?>
										</td>
										<td>
											<?php if ($d['request_delete'] == "DELETED") : ?>
												<a class="btn btn-sm btn-danger" onclick="return confirm('Request delte from <?= $d['nickname']; ?> ')" href="<?= base_url('admin/dashboard/requestdelete/' . $d['id_user']); ?>"><i class="far fa-trash-alt"></i></a>
											<?php elseif ($d['request_delete'] == NULL) : ?>
											<?php endif; ?>

											<a type="button" href="<?= base_url('admin/dashboard/detailUserBeatmaker/') . $d['id_user']; ?>" class="btn btn-sm btn-primary">
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