<!-- ##### Hero Area Start ##### -->
<section class="hero-area">
    <div class="hero-slides owl-carousel">
        <div class="single-hero-slide d-flex align-items-center justify-content-center">
            <!-- Slide Img -->
            <div class="slide-img bg-img" style="background-image: url(<?= base_url('assets/'); ?>img/bg-img/bg-2.jpg);"></div>
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
                    <h2>Latest Instrumental From The Beatmaker</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <div class="ablums-text text-center mb-70">
                    <h2>
                        They are beatmakers who make all kinds of instrumental music for your needs, be an artist, rapper or solo singer, whatever you want by buying instrumental from them
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach ($getBm as $a) : ?>
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 single-album-item s e q ">
                    <a href="<?= base_url('publics/artist/') . $a['id_user']; ?>">
                        <div class="single-album pl-3 pr-3 bg-warning">
                            <img class="mt-3" src="<?= base_url('files/new-image/') . $a['image'] ?>" alt="">
                            <div class="album-info">
                                <h5><?= $a['nickname']; ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- ##### Latest Albums Area End ##### -->

<!-- ##### Buy Now Area Start ##### -->
<section class="featured-artist-area section-padding-100 bg-img bg-overlay bg-fixed" style="background-image: url(<?= base_url('assets/img/bg-img/bg-4.jpg'); ?>);">
    <div class="container">
        <?php foreach ($one as $o) : ?>
            <div class="row align-items-end">
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="featured-artist-thumb">
                        <img src="<?= base_url('files/thumbnail/') . $o['thumbnail']; ?>" alt="">

                    </div>
                </div>
                <div class="col-12 col-md-7 col-lg-8">
                    <div class="featured-artist-content">
                        <!-- Section Heading -->
                        <div class="section-heading white text-left mb-30">
                            <p>New Instrumental From</p>
                            <h2><?= $o['nickname']; ?></h2>
                        </div>
                        <p>
                            <?= $o['description']; ?>
                        </p>
                        <div class="song-play-area">
                            <div class="song-name">
                                <p><?= $o['title']; ?> | Genre : <?= $o["genre"]; ?></p>
                            </div>
                            <audio controls preload="auto" controlsList="nodownload noplaybackrate">
                                <source src="<?= base_url('files/demo/') . $o['demo_version']; ?>">
                            </audio>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>