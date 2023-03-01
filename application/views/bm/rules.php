<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Information Upload</h1>
					<?= $this->session->flashdata('message'); ?>
				</div>

			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-header bg-info">
							Indonesiia
						</div>
						<div class="card-body">
							<p style="font-size: 20px;">
								1. Pastikan musik instrumental yang akan anda dijual adalah original hasil karya anda
								<br>
								2. Gunakan watermark ini ke dalam versi demo anda&nbsp;&nbsp;<audio controls controlsList="nodownload noplaybackrate">
									<source src="<?= base_url('files/wm/watermark.wav'); ?>" type="audio/wav">
								</audio>
								<br>
								3. Dengarkan contoh ini untuk memastikan Anda mengerti&nbsp;&nbsp;<audio controls controlsList="nodownload noplaybackrate">
									<source src="<?= base_url('files/wm/example.wav'); ?>" type="audio/wav">
								</audio>
								<br>
								4. Pastikan demo musik instrumental Anda minimal 1:30 menit atau setengah dari durasi full versinya
								<br>
								5. Tidak peduli seberapa bagus musik instrumental anda, kami akan memeriksa secara manual demo musiknya
								<br>
								7. Jika anda tidak memberi watermaker pada versi demo, maka kami akan menghapusnya, dan anda bisa upload ulang dengan versi demo yang sudah diberi watermark
								<br>
								8. Format audio yang didukung adalah wav dan mp3
								<br>
								9. Pastikan ketika upload file tidak melebihi 100MB
								<br>
								10. Pastikan juga format audionya sama semua, jika mp3 maka mp3 semuanya, begitu juga dengan format wav
								<br>
								11. Thumbnail harus berukuran 1500 x 1500 piksel maximal ukuran adalah 2MB
								<br>
								12. Harga yang anda cantumkan adalah murni yang anda tentukan sendiri
								<br>
								14. Apabila anda melihat harga yang terdisplay pada website kami melebihi dari harga yang anda tentukan, itu adalah harga yang sudah ditambahkan PPN 10% oleh sistem
								<br>
								15. Penghasilan murni anda adalah dari harga yang anda tentukan sendiri dan tidak termasuk dengan PPN
								<br>
								16. Jika anda sudah mengherti maka anda bisa download watermarknya <a href="<?= base_url('bm/channel/dodownload'); ?>">disini</a>

							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-header bg-info">
							English
						</div>
						<div class="card-body">
							<p style="font-size: 20px;">
								1. Make sure the instrumental music you are going to sell is your original work
								<br>
								2. Apply this watermark into your demo version&nbsp;&nbsp;<audio controls controlsList="nodownload noplaybackrate">
									<source src="<?= base_url('files/wm/watermark.wav'); ?>" type="audio/wav">
								</audio>
								<br>
								3. Listen to this example to make sure you understand&nbsp;&nbsp;<audio controls controlsList="nodownload noplaybackrate">
									<source src="<?= base_url('files/wm/example.wav'); ?>" type="audio/wav">
								</audio>
								<br>
								4. Make sure your instrumental music demo is at least 1:30 minutes or half the duration of the full version
								<br>
								5. No matter how good your instrumental music is, we will manually check the demo music
								<br>
								7. If you don't provide a watermaker in the demo version, we will delete it, and you can re-upload it with a watermarked demo version
								<br>
								8. Supported audio formats are wav and mp3
								<br>
								9. Make sure when uploading files it doesn't exceed 100MB
								<br>
								10. Also make sure all the audio formats are the same, if mp3 then all mp3, as well as the wav format
								<br>
								11. Thumbnails must be 1500 x 1500 pixels, the maximum size is 2MB
								<br>
								12. The price you put is purely what you set yourself
								<br>
								14. If you see the price displayed on our website exceeds the price you specified, that is the price that the system has added 10% VAT
								<br>
								15. Your pure income is from the price that you determine yourself and does not include VAT
								<br>
								16. If you understand, you can download the watermark <a href="<?= base_url('bm/channel/dodownload'); ?>">here</a>

							</p>
						</div>
					</div>
				</div>
			</div>
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