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
									<th>Thumbnail</th>
									<th>BeatMaker</th>
									<th>Title</th>
									<th>Full_version</th>
									<th>Demo_version</th>
									<th>Genre</th>
									<th>Status</th>
									<th>Info</th>

								</tr>
							</thead>
							<tbody>
								<?php foreach ($getProd as $d) : ?>
									<tr>
										<td><img src="<?= base_url('files/thumbnail/') . $d['thumbnail']; ?>" alt="" style="max-width: 150px;"></td>
										<td><?= $d['nickname']; ?></td>
										<td><?= $d['title']; ?></td>
										<td><audio controls controlsList="nodownload">
												<source src="<?= base_url('files/full/') . $d['full_version']; ?>" type="audio/mpeg">
											</audio>
										</td>
										<td><audio controls controlsList="nodownload">
												<source src="<?= base_url('files/demo/') . $d['demo_version']; ?>" type="audio/mpeg">
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
												<a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete <?= $d['title']; ?> ?')" href="<?= base_url('admin/dashboard/deleteContent/' . $d['id_product']); ?>"><i class="far fa-trash-alt"></i></a>
												<a class="btn btn-sm btn-warning" onclick="return confirm('Are you sure want to post <?= $d['title']; ?> ?')" href="<?= base_url('admin/dashboard/update/' . $d['id_product']); ?>"><i class="fa-solid fa-pen-to-square"></i></a>
											<?php elseif ($d['status_product'] == 1) : ?>
												<span class="badge badge-success">Posted</span>
											<?php elseif ($d['status_product'] == 3) : ?>
												<span class="badge badge-danger">Canceled</span>
											<?php endif; ?>


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

<!-- Main Footer -->