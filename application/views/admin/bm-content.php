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
				<div class="card-header">

				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">

						<table class="table table-bordered table-hover">
							<thead>
								<tr>

									<th>Gambar</th>
									<th>Beatmaker</th>
									<th>Judul</th>
									<th>Versi Lengkap</th>
									<th>Versi Demo</th>
									<th>Jenis Musik</th>
									<th>Status</th>

									<th>Info</th>

								</tr>
							</thead>
							<tbody>
								<?php if (empty($getProd)) : ?>
									<tr>
										<td colspan="8">
											<div class="alert alert-info" role="alert">
												No Data
											</div>
										</td>
									</tr>
								<?php endif; ?>
								<?php foreach ($getProd as $d) : ?>
									<form action="<?= base_url('admin/dashboard/deleteContent/') . $d['id_product']; ?>" method="POST">
										<tr>
											<input type="hidden" name="email" id="email" value="<?= $d['email']; ?>">
											<input type="hidden" name="first_name" id="first_name" value="<?= $d['first_name']; ?>">
											<input type="hidden" name="last_name" id="last_name" value="<?= $d['last_name']; ?>">
											<td><img src="<?= base_url('files/thumbnail/') . $d['thumbnail']; ?>" alt="" style="max-width: 150px;"></td>
											<td><?= $d['nickname']; ?></td>
											<td><?= $d['title']; ?></td>
											<td><audio controls controlsList="nodownload">
													<source src="<?= base_url('files/full/') . $d['full_version']; ?>">
												</audio>
											</td>
											<td><audio controls controlsList="nodownload">
													<source src="<?= base_url('files/demo/') . $d['demo_version']; ?>">
												</audio>
											</td>
											<td>
												<?= $d['genre']; ?>

											</td>
											<td>
												<?php if ($d['status_product'] == 0) : ?>
													<span class="badge badge-warning">Review</span>
												<?php elseif ($d['status_product'] == 1) : ?>
													<span class="badge badge-success">Posted</span>
												<?php elseif ($d['status_product'] == 3) : ?>
													<span class="badge badge-danger">Canceled</span>
												<?php endif; ?>
											</td>
											<td>
												<?php if ($d['status_product'] == 0) : ?>
													<button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></i></button>


													<a class="btn btn-sm btn-warning" onclick="return confirm('Yakin ingin post <?= $d['title']; ?> ?')" href="<?= base_url('admin/dashboard/update/' . $d['id_product']); ?>"><i class="fa-solid fa-pen-to-square"></i></a>
												<?php elseif ($d['status_product'] == 1) : ?>
													<span class="badge badge-success">Posted</span>
												<?php elseif ($d['status_product'] == 3) : ?>
													<span class="badge badge-danger">Canceled</span>
												<?php endif; ?>


											</td>


										</tr>

									</form>
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

<!-- Main Footer -->