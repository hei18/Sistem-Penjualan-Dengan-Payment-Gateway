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


		</div>
	</section>
	<!-- /.container-fluid -->


	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">


			<div class="row">
				<div class="col-md-3">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid img-circle" src="<?= base_url('files/pp/default.jpg') ?>" alt="User profile picture">
							</div>



							<p class="text-muted text-center"><?= $user['role']; ?></p>

							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b><?= $user['email']; ?></b>
								</li>

							</ul>


						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->

					<!-- About Me Box -->

					<!-- /.card -->
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-3 col-sm-6 col-12">
							<a class="text-white" href="<?= base_url('admin/dashboard/bmcontent'); ?>">
								<div class="info-box">
									<span class="info-box-icon bg-info"><i class="fa-sharp fa-solid fa-music"></i></span>

									<div class="info-box-content">
										<span class="info-box-text">Instrumental</span>
										<span class="info-box-number"><?= $prod; ?></span>
									</div>
									<!-- /.info-box-content -->
								</div>
							</a>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-12">
							<a class="text-white" href="<?= base_url('admin/dashboard/beatmaker'); ?>">

								<div class="info-box">
									<span class="info-box-icon bg-success"><i class="fa-sharp fa-solid fa-users"></i></span>
									<i class=""></i>
									<div class="info-box-content">
										<span class="info-box-text">Beatmaker</span>
										<span class="info-box-number"><?= $bm; ?></span>
									</div>
									<!-- /.info-box-content -->
								</div>
							</a>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-12">
							<a class="text-white" href="<?= base_url('admin/dashboard/customer'); ?>">

								<div class=" info-box">
									<span class="info-box-icon bg-info"><i class="fa-sharp fa-solid fa-users"></i></span>
									<i class=""></i>

									<div class="info-box-content">
										<span class="info-box-text">Customer</span>
										<span class="info-box-number"><?= $cs; ?></span>
									</div>
									<!-- /.info-box-content -->
								</div>
							</a>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-12">
							<a href="<?= base_url('admin/dashboard/requestWd'); ?>" class="text-white">
								<div class="info-box">
									<span class="info-box-icon bg-danger"><i class="fa-solid fa-money-bills"></i></span>

									<div class="info-box-content">
										<span class="info-box-text">Permintaan Penarikan</span>
										<span class="info-box-number"><?= $wd; ?></span>
									</div>
									<!-- /.info-box-content -->
								</div>
							</a>
							<!-- /.info-box -->
						</div>
						<div class="col-md-3 col-sm-6 col-12">
							<a href="<?= base_url('admin/dashboard/income'); ?>" class="text-white">
								<div class="info-box">
									<span class="info-box-icon bg-info"><i class="fa-solid fa-money-bills"></i></span>

									<div class="info-box-content">
										<span class="info-box-text">Pendapatan dari PPN</span>
										<?php if ($ppn == NULL) : ?>
											<span class="info-box-number">Rp 0</span>
										<?php else : ?>
											<span class="info-box-number"><?= idr($ppn); ?></span>
										<?php endif; ?>
									</div>
									<!-- /.info-box-content -->
								</div>
							</a>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>
				</div>
				<!-- /.col -->

				<!-- /.col -->
			</div>

		</div>
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