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


		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<?= $this->session->flashdata('message'); ?>

			<div class="card">
				<div class="card-header bg-warning">
					Request Witdraw
				</div>
				<div class="card-body">
					<form action="<?= base_url('bm/channel/doWithdraw'); ?>" method="post">
						<input type="hidden" name="ppn_income" id="ppn_income" value="<?= $data['ppn_income']; ?>">
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="formGroupExampleInput">Email</label>
									<input type="text" class="form-control" name="email" id="email" value="<?= $data['email']; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="disabledSelect">Select Your Bank</label>
									<select name="bank_name" class="form-control" id="myBank">
										<option value="">---SELECT YOUR BANK---</option>
										<?php foreach ($mybank as $key) : ?>
											<option value="<?= $key['bank_name']; ?>" data-number="<?= $key['bank_number']; ?>">
												<?= $key['bank_name']; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="formGroupExampleInput2">Income</label>
									<input type="text" class="form-control" name="net_income" id="net_income" value="<?= idr($data['net_income']); ?>" readonly>
								</div>
								<div class="form-group">
									<label for="formGroupExampleInput2">Bank Number</label>
									<input type="text" class="form-control" name="bank_number" id="bank_number" readonly>
								</div>
							</div>
						</div>
						<input name="submit" type="submit" value="submit" disabled="true" />
					</form>
				</div>
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