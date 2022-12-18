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
					<h3 class="card-title">Detail Item</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table class=" table table-bordered" width="100%">
							 <thead>
								<tr>
									<th>Thumbnail</th>
									<th>Title</th>
									<th>Item</th>
									<th>Status</th>


								</tr>
							</thead>
							<tbody>
								<?php foreach ($item as $c) : ?>


									<tr>
										<th>
											<img src="<?= base_url('files/thumbnail/') . $c['thumbnail']; ?>" alt="<?= base64_encode($c['thumbnail']); ?>" srcset="" style="max-width: 80px;">
										</th>
										<th><?= $c['title']; ?></th>
										<th><?= $c['genre']; ?></th>
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