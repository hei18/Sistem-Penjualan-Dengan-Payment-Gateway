<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $tittle; ?></h1>
					<?= $this->session->flashdata('message') ?>
				</div>

			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Update Profile</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form action="<?= base_url('cs/dashboard/updateprofile'); ?>" method="post" enctype="multipart/form-data">
					<div class="card-body">
						<?php $query = $this->db->query("SELECT * FROM profiles INNER JOIN customer ON profiles.id_cs = customer.id_cs"); ?>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="exampleInputEmail1">Nama Panggilan</label>
									<input autocomplete="off" type="text" name="nickname" id="nickname" value="<?= $user['nickname']; ?>" class="form-control">
									<?= form_error('nickname', '<small class=" text-danger">', '</small>'); ?>

								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Email</label>
									<input autocomplete="off" name="email" id="email" value="<?= $user['email']; ?>" type="email" class="form-control" placeholder="Enter email" readonly>
								</div>
								<div class="form-group">
									<?php if ($query->num_rows() > 0) : ?>
										<label for="exampleInputEmail1">Nama Depan</label>
										<input autocomplete="off" type="text" name="first_name" id="first_name" value="<?= $users['first_name']; ?>" class="form-control">
										<?= form_error('first_name', '<small class=" text-danger">', '</small>'); ?>
									<?php else : ?>
										<label for="exampleInputEmail1">Nama Depan</label>
										<input autocomplete="off" type="text" name="first_name" id="first_name" class="form-control">
										<?= form_error('first_name', '<small class=" text-danger">', '</small>'); ?>

									<?php endif; ?>
								</div>
								<div class="form-group">
									<?php if ($query->num_rows() > 0) : ?>
										<label for="exampleInputEmail1">Nama Belakang</label>
										<input autocomplete="off" type="text" name="last_name" id="last_name" value="<?= $users['last_name']; ?>" class="form-control">
										<?= form_error('last_name', '<small class=" text-danger">', '</small>'); ?>
									<?php else : ?>
										<label for="exampleInputEmail1">Nama Belakang</label>
										<input autocomplete="off" type="text" name="last_name" id="last_name" class="form-control">
										<?= form_error('last_name', '<small class=" text-danger">', '</small>'); ?>

									<?php endif; ?>
								</div>
								<div class="form-group">
									<?php if ($query->num_rows() > 0) : ?>
										<label for="exampleInputEmail1">Nomor Ponsel</label>
										<input autocomplete="off" type="text" name="phone_number" id="phone_number" value="<?= $users['phone_number']; ?>" class="form-control">
										<?= form_error('phone_number', '<small class=" text-danger">', '</small>'); ?>

									<?php else : ?>
										<label for="exampleInputEmail1">Nomor Ponsel</label>
										<input autocomplete="off" type="text" name="phone_number" id="phone_number" class="form-control">
										<?= form_error('phone_number', '<small class=" text-danger">', '</small>'); ?>

									<?php endif; ?>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<?php if ($query->num_rows() > 0) : ?>
										<label for="exampleInputEmail1">Alamat Lengkap</label>
										<textarea class="form-control" name="address" id="address" rows="2"> <?= $users['address']; ?></textarea>
										<?= form_error('address', '<small class=" text-danger">', '</small>'); ?>

									<?php else : ?>
										<label for="exampleInputEmail1">Alamat Lengkap</label>
										<textarea class="form-control" name="address" id="address" rows="2"></textarea>
										<?= form_error('address', '<small class=" text-danger">', '</small>'); ?>

									<?php endif; ?>
								</div>

								<div class="form-group">
									<label for="exampleInputFile">Foto Profil</label>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="image" name="image" accept=".jpeg, .jpg, .png">
											<label class="custom-file-label" for="image">jpg/jpeg/png</label>
										</div>
									</div>
									<small class=" text-danger" id="file-result3"> </small>
								</div>
							</div>
						</div>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>

					</div>
				</form>
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