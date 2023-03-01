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

			<?php $query = $this->db->query("SELECT * FROM profiles INNER JOIN customer ON profiles.id_cs = customer.id_cs"); ?>
			<?php if ($query->num_rows() > 0) : ?>

			<?php else : ?>
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
					<span class="alert-text">
						Selamat Datang <?= $user['nickname']; ?> , lengkapi profil anda, <a href="<?= base_url('cs/dashboard/updateprofile'); ?>">klik disini</a>
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
					<div class="card">
						<div class="card-header bg-warning">
							Instrumental Terbaru
						</div>
						<div class="card-body">
							<?php foreach ($beat as $key) : ?>
								<form action="<?= base_url('cs/dashboard/addNew'); ?>" method="post">
									<?= form_hidden('id_product', $key['id_product']) ?>
									<?= form_hidden('title', $key['title']) ?>
									<?= form_hidden('selling_price', $key['selling_price']) ?>

									<blockquote class="blockquote mb-0">
										<p>Beatmaker: <?= $key['nickname']; ?> | Judul: <?= $key['title']; ?> | Jenis Musik: <?= $key['genre']; ?> </p>
										<footer class="blockquote-footer">
											<audio controls preload="auto" controlsList="nodownload noplaybackrate">
												<source src="<?= base_url('files/demo/') . $key['demo_version']; ?>">
											</audio>
										</footer>
										<p><?= $key['description']; ?></p>
										<button type="submit" class="btn btn-info" style="width: 100%;"><?= idr($key['selling_price']); ?></button>

									</blockquote>
								</form>
							<?php endforeach; ?>
						</div>
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