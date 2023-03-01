 <!-- ##### Breadcumb Area Start ##### -->
 <section class="breadcumb-area bg-img bg-overlay mb-70" style="background-image: url(<?= base_url('assets/'); ?>img/bg-img/breadcumb3.jpg);">

 </section>

 <section class="">
     <div class="one-music-songs-area ">
         <div class="container ">
             <?= $this->session->flashdata('message'); ?>
             <form action="<?= base_url('publics/instrumental'); ?>" method="post">
                 <div class="input-group mb-3">
                     <input type="text" name="keyword" class="form-control" autocomplete="off" autofocus placeholder="Search by genre">
                     <div class="input-group-append">
                         <input class="btn btn-outline-secondary" type="submit" name="submit" value="Refresh/Search">

                     </div>
                 </div>
             </form>
             <h5>Total Instrument:<?= $total_rows; ?></h5>
             <div class="row ">
                 <?php if (empty($getProduct)) : ?>
                     <div class="alert alert-danger col-12" role="alert">
                         Tidak Ditemukan
                     </div>
                 <?php endif; ?>
                 <?php foreach ($getProduct as $g) : ?>
                     <?php if ($g['status_product'] == 0) : ?>
                         <div class="col-12">
                             <div class="single-song-area mb-30 d-flex flex-wrap align-items-end">
                                 <div class="song-thumbnail">
                                     <img src="<?= base_url('files/wm/black.png'); ?>" alt="">
                                 </div>
                                 <div class="song-play-area ">
                                     <div class="song-name">
                                         <p>Default EXAMPLE</p>
                                     </div>
                                     <audio controls preload="auto" controlsList="nodownload noplaybackrate">
                                         <source src="<?= base_url('files/wm/example.wav'); ?>">
                                     </audio>
                                 </div>
                             </div>
                         </div>
                     <?php elseif ($g['status_product'] == 1) : ?>
                         <form class="col-12 mb-30" action="<?= base_url('cs/dashboard/add'); ?>" method="post">
                             <?= form_hidden('id_product', $g['id_product']) ?>
                             <?= form_hidden('title', $g['title']) ?>
                             <?= form_hidden('selling_price', $g['selling_price']) ?>



                             <div class="">

                                 <div class="card">
                                     <div class="card-header bg-info">
                                         <?= $g['nickname']; ?>
                                     </div>
                                     <div class="card-body">
                                         <div class="single-song-area  d-flex flex-wrap align-items-end">
                                             <div class="song-thumbnail">
                                                 <img src="<?= base_url('files/thumbnail/') . $g['thumbnail']; ?>" alt="">
                                             </div>
                                             <div class="song-play-area ">
                                                 <div class="song-name">
                                                     <p><?= $g['title']; ?> | Jenis Musik : <?= $g["genre"]; ?> | Tanggal Rilis: <?= $g['date_release']; ?></p>
                                                 </div>
                                                 <audio controls preload="auto" controlsList="nodownload noplaybackrate">
                                                     <source src="<?= base_url('files/demo/') . $g['demo_version']; ?>">
                                                 </audio>
                                             </div>
                                         </div>
                                         <p style="font-size: 20px;">
                                             <?= $g['description']; ?>
                                         </p>
                                     </div>
                                     <?php if ($this->session->userdata('role') == 'customer') : ?>
                                         <?php if ($this->session->userdata('id_cs')) : ?>
                                             <button type="submit" name="submit" class="btn btn-primary">
                                                 <?= idr($g['selling_price']) ?>
                                             </button>
                                         <?php endif ?>
                                     <?php elseif ($this->session->userdata('role') == 'beatmaker') : ?>
                                         <?php if ($this->session->userdata('id_user')) : ?>
                                             <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
                                                 <?= idr($g['selling_price']) ?>
                                             </a>
                                         <?php endif ?>
                                     <?php elseif ($this->session->userdata('role') == NULL) : ?>
                                         <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                             <?= idr($g['selling_price']) ?>
                                         </a>
                                     <?php endif; ?>



                                 </div>

                             </div>
                         </form>
                     <?php endif; ?>
                 <?php endforeach; ?>

             </div>
         </div>
         <?= $this->pagination->create_links(); ?>
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
 <!-- ##### Song Area End ##### -->