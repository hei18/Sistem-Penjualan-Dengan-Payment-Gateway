<!-- ##### Hero Area Start ##### -->
<section class="hero-area">
	<div class="hero-slides owl-carousel">
		<div class="single-hero-slide d-flex align-items-center justify-content-center">
			<!-- Slide Img -->
			<div class="slide-img bg-img"><img src="<?= base_url('assets/img/bg-img/bg-2.jpg'); ?>" alt=""></div>
			<!-- Slide Content -->
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="hero-slides-content text-center">
							<h6 data-animation="fadeInUp" data-delay="100ms">Welcome To BeatAudio</h6>
							<h2 data-animation="fadeInUp" data-delay="300ms">Lets Buy Your Music <span>Lets Buy Your Music</span></h2>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ##### Hero Area End ##### -->

<!-- ##### Latest Albums Area Start ##### -->
<section class="latest-albums-area section-padding-100">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-heading style-2">
					<p>See what’s new</p>
					<h2>Latest Albums</h2>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-12 col-lg-9">
				<div class="ablums-text text-center mb-70">
					<p>Nam tristique ex vel magna tincidunt, ut porta nisl finibus. Vivamus eu dolor eu quam varius rutrum. Fusce nec justo id sem aliquam fringilla nec non lacus. Suspendisse eget lobortis nisi, ac cursus odio. Vivamus nibh velit, rutrum at ipsum ac, dignissim iaculis ante. Donec in velit non elit pulvinar pellentesque et non eros.</p>
				</div>
			</div>
		</div>

		<div class="row">
			<?php foreach ($getBm as $a) : ?>
				<div class="col-12 col-sm-4 col-md-3 col-lg-2 single-album-item s e q ">
					<div class="single-album pl-3 pr-3 bg-warning">
						<img class="mt-3" src="<?= base_url('files/new-image/') . $a['image'] ?>" alt="">
						<div class="album-info">
							<a href="#">
								<h5><?= $a['beatmaker_name']; ?></h5>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- ##### Latest Albums Area End ##### -->

<!-- ##### Buy Now Area Start ##### -->
<section class="featured-artist-area section-padding-100 bg-img bg-overlay bg-fixed" style="background-image: url(<?= base_url('assets/img/bg-img/bg-4.jpg'); ?>);">
	<div class="container">
		<div class="row align-items-end">
			<div class="col-12 col-md-5 col-lg-4">
				<div class="featured-artist-thumb">
					<img src="img/bg-img/fa.jpg" alt="">
				</div>
			</div>
			<div class="col-12 col-md-7 col-lg-8">
				<div class="featured-artist-content">
					<!-- Section Heading -->
					<div class="section-heading white text-left mb-30">
						<p>See what’s new</p>
						<h2>Buy What’s New</h2>
					</div>
					<p>Nam tristique ex vel magna tincidunt, ut porta nisl finibus. Vivamus eu dolor eu quam varius rutrum. Fusce nec justo id sem aliquam fringilla nec non lacus. Suspendisse eget lobortis nisi, ac cursus odio. Vivamus nibh velit, rutrum at ipsum ac, dignissim iaculis ante. Donec in velit non elit pulvinar pellentesque et non eros.</p>
					<div class="song-play-area">
						<div class="song-name">
							<p>01. Main Hit Song</p>
						</div>
						<audio preload="auto" controls>
							<source src="audio/dummy-audio.mp3">
						</audio>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ##### Buy Now Area End ##### -->

<!-- ##### Featured Artist Area Start ##### -->

<!-- ##### Featured Artist Area End ##### -->

<!-- ##### Miscellaneous Area Start ##### -->

<!-- ##### Miscellaneous Area End ##### -->

<!-- ##### Contact Area Start ##### -->

<!-- ##### Contact Area End ##### -->