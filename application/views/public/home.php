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
                            <h6 data-animation="fadeInUp" data-delay="100ms">Selamat Datang Di BeatAudioStore</h6>
                            <h2 data-animation="fadeInUp" data-delay="300ms">Belilah Musik Mu Sesaui Kebutuhan <span>Belilah Musik Mu Sesaui Kebutuhan</span></h2>

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
                    <p>Lihat Apa Yang Baru</p>
                    <h2>Instrumental Terbaru Dari Beatmaker</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <div class="ablums-text text-center mb-70">
                    <h2>
                        Mereka adalah beatmaker yang membuat segala jenis musik instrumental untuk kebutuhan anda, menjadi artis, rapper atau penyanyi solo, apapun yang anda inginkan dengan membeli instrumental dari mereka
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach ($getBm as $a) :

            ?>
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 single-album-item s e q ">

                    <a href="<?= base_url('publics/artist?key=') . base64_encode($a['id_user']); ?>">
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
            <form action="<?= base_url('cs/dashboard/addHome'); ?>" method="post">
                <?= form_hidden('id_product', $o['id_product']) ?>
                <?= form_hidden('title', $o['title']) ?>
                <?= form_hidden('selling_price', $o['selling_price']) ?>
                <div class="row align-items-end">
                    <div class="col-12 col-md-5 col-lg-4">
                        <div class="featured-artist-thumb">
                            <img src="<?= base_url('files/master-image/') . $o['thumbnail']; ?>" alt="">

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
                        <?php if ($o['status_product'] == 0) : ?>
                            <button class="btn btn-primary btn-block">
                                instrumental under review
                            </button>
                        <?php elseif ($o['status_product'] == 1) : ?>
                            <?php if ($this->session->userdata('role') == 'customer') : ?>
                                <?php if ($this->session->userdata('id_cs')) : ?>
                                    <button type="submit" name="submit" class="btn btn-primary btn-block swalDefaultSuccess">
                                        <?= idr($o['selling_price']) ?>
                                    </button>

                                <?php endif ?>
                            <?php elseif ($this->session->userdata('role') == 'beatmaker') : ?>
                                <?php if ($this->session->userdata('id_user')) : ?>
                                    <a type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal2">
                                        <?= idr($o['selling_price']) ?>
                                    </a>
                                <?php endif ?>
                            <?php elseif ($this->session->userdata('role') == NULL) : ?>
                                <a type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                                    <?= idr($o['selling_price']) ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        <?php endforeach; ?>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buatlah Akun Customer Untuk Membeli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h5>Jika Punya Akun</h5>
                        <a href="<?= base_url('auth'); ?>" class="btn btn-primary">Login</a>
                    </div>
                    <div class="col">
                        <h5>Jika Tidak Punya Akun</h5>
                        <a href="<?= base_url('auth/register'); ?>" class="btn btn-warning">Register</a>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buatlah Akun Customer Untuk Membeli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h5>Jika Punya Akun</h5>
                        <a href="<?= base_url('auth'); ?>" class="btn btn-primary">Login</a>
                    </div>
                    <div class="col">
                        <h5>Jika Tidak Punya Akun</h5>
                        <a href="<?= base_url('auth/register'); ?>" class="btn btn-warning">Register</a>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>