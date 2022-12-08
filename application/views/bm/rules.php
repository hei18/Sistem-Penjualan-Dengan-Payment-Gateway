<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Profile</h1>
					<?= $this->session->flashdata('message'); ?>
				</div>

			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<h4>1. Make sure the beat that will be for sale is the original beat from your work</h4>
			<br>
			<h4>2. Use the watermark into your demo version
				<audio controls controlsList="nodownload noplaybackrate">
					<source src="<?= base_url('files/wm/watermark.wav'); ?>" type="audio/wav">
				</audio>
			</h4>
			<h4>3. Listen this example to make sure you understand
				<audio controls controlsList="nodownload noplaybackrate">
					<source src="<?= base_url('files/wm/example.wav'); ?>" type="audio/wav">
				</audio>
			</h4>
			<h4>
				4. Make sure your demo of instrumental music no longer than 1:30 minute
			</h4>
			<h4>5. No matter what how good your beat, we will check manual of the demo version
			</h4>
			<h4>7. If you don't put the watermark on your demo or your demo lebih dari 1:30 minute, we will takedown your submit
			</h4>
			<h4>8. And we don't post your beat and you can do new upload on channel content</h4>

			<h4>9. You can download this watermerk <a href="<?= base_url('bm/channel/Dodownload'); ?>">here</a></h4>
			<a class="btn btn-info" href="<?= base_url('bm/channel/content'); ?>">Back</a>
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