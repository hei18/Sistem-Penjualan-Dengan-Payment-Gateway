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

			<?php $query = $this->db->query("SELECT * FROM profiles INNER JOIN customer ON profiles.id_cs = customer.id_cs"); ?>
			<?php if ($query->num_rows() > 0) : ?>

			<?php else : ?>
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
					<span class="alert-text">
						Welcome <?= $user['nickname']; ?> , let's update your profile, <a href="<?= base_url('cs/dashboard/updateprofile'); ?>">clik here now!</a>
					</span>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;

						</span>
					</button>
				</div>
			<?php endif; ?>
			<div class="row">
				<div class="col-md-3">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid img-circle" src="<?= base_url('files/pp/') . $user['image'] ?>" alt="User profile picture">
							</div>

							<h3 class="profile-username text-center"><?= $user['nickname']; ?></h3>

							<p class="text-muted text-center"><?= $user['role']; ?></p>

							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b><?= $user['email']; ?></b>
								</li>
								<li class="list-group-item">
									<b>Following</b>
								</li>
								<li class="list-group-item">
									<b>Friends</b>
								</li>
							</ul>

							<a href="<?= base_url('cs/dashboard/profile'); ?>" class="btn btn-primary btn-block"><b>Detail Profile</b></a>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->

					<!-- About Me Box -->

					<!-- /.card -->
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col">
							<div class="info-box mb-3 bg-warning">
								<span class="info-box-icon"><i class="fas fa-tag"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Inventory</span>
									<span class="info-box-number">5,200</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<div class="info-box mb-3 bg-warning">
								<span class="info-box-icon"><i class="fas fa-tag"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Inventory</span>
									<span class="info-box-number">5,200</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<div class="info-box mb-3 bg-warning">
								<span class="info-box-icon"><i class="fas fa-tag"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Inventory</span>
									<span class="info-box-number">5,200</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<div class="info-box mb-3 bg-warning">
								<span class="info-box-icon"><i class="fas fa-tag"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Inventory</span>
									<span class="info-box-number">5,200</span>
								</div>
								<!-- /.info-box-content -->
							</div>
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