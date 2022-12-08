<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Profile</h1>

				</div>

			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?= $this->session->flashdata('message'); ?>
			<div class="row">
				<div class="col-md-3">
					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid img-circle" src="<?= base_url('files/new-image/') . $user['image'] ?>" alt="User profile picture">
							</div>

							<h3 class="profile-username text-center"><?= $user['nickname']; ?></h3>

							<p class="text-muted text-center"><?= $user['role']; ?></p>

						</div>

					</div>
				</div>
				<div class="col-md-8">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">About <?= $user['nickname']; ?></h3>
						</div>
						<div class="card-body">
							<?php $query = $this->db->query("SELECT * FROM profiles INNER JOIN user ON profiles.id_user = user.id_user"); ?>
							<?php if ($query->num_rows() > 0) : ?>
								<div class="row">
									<div class="col">
										<strong><i class="fa-sharp fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;Full Name</strong>

										<p class="text-muted">
											<?= $users['first_name']; ?><?= $users['last_name']; ?>
										</p>

										<hr>

										<strong><i class="fas fa-map-marker-alt mr-1"></i>&nbsp;&nbsp;&nbsp;Address</strong>

										<p class="text-muted"><?= $users['address']; ?></p>


									</div>
									<div class="col">

										<strong><i class="fa-solid fa-envelope"></i></i>&nbsp;&nbsp;&nbsp;email</strong>

										<p class="text-muted"><?= $users['email']; ?></p>

										<hr>
										<strong><i class="fa-sharp fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;Phone Number</strong>

										<p class="text-muted">
											<?= $users['phone_number']; ?>

										</p>

										<hr>


									</div>
								</div>
							<?php else : ?>
								<div class="row">
									<div class="col">
										<strong><i class="fa-sharp fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;Full Name</strong>

										<p class="text-muted">

										</p>

										<hr>

										<strong><i class="fas fa-map-marker-alt mr-1"></i>&nbsp;&nbsp;&nbsp;Address</strong>

										<p class="text-muted"></p>

										<hr>
										<strong><i class="fa-solid fa-envelope"></i></i>&nbsp;&nbsp;&nbsp;email</strong>

										<p class="text-muted"></p>

										<hr>
									</div>
									<div class="col">
										<strong><i class="fa-sharp fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;Phone Number</strong>

										<p class="text-muted">


										</p>

										<hr>

										<strong><i class="fa-solid fa-money-check-dollar"></i>&nbsp;&nbsp;&nbsp;Bank Account</strong>

									</div>
								</div>
							<?php endif ?>





							<a href="<?= base_url('cs/dashboard/updateprofile'); ?>" class="btn btn-primary">Update Profile</a>


						</div>
						<!-- /.card-body -->
					</div>
				</div>

			</div>
			<!-- /.row -->
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