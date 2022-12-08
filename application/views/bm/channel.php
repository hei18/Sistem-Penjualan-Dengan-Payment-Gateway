<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1><?= $tittle; ?></h1>
                </div>

                <div class="col d-flex justify-content-end">

                    <a class="btn btn-app d-none d-lg-block" href="<?= base_url('bm/channel/uploadcontent'); ?>">
                        <i class="fa-solid fa-arrow-up-from-bracket fa-2x"></i>
                        <h5>Upload</h5>
                    </a>
                </div>
                <!-- /.info-box -->
            </div>


        </div>
    </section>
    <!-- /.container-fluid -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-info alert-dismissible fade show d-md-none" role="alert">
                <span class="alert-text">
                    You can upload your instrumental in website</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <?= $this->session->flashdata('message'); ?>
            <?php $query = $this->db->query("SELECT * FROM profiles INNER JOIN user ON profiles.id_user = user.id_user WHERE profiles.id_user=" . $this->session->userdata('id_user')); ?>
            <?php if ($query->num_rows() > 0) : ?>

            <?php else : ?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-text">
                        Welcome <?= $user['nickname']; ?> , let's update your profile, <a href="<?= base_url('bm/channel/updateprofile'); ?>">clik here now!</a>
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
                                <li class="list-group-item">
                                    <b>Following</b>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b>
                                </li>
                            </ul>

                            <a href="<?= base_url('bm/channel/profile'); ?>" class="btn btn-primary btn-block"><b>Detail Profile</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->

                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>Income</h3>
                                    <?php if ($in == 0) : ?>
                                        <h4>Rp.0</h4>
                                    <?php else : ?>
                                        <h4><?= idr($in); ?></h4>
                                    <?php endif; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-money-bills"></i>
                                </div>
                                <form class="small-box-footer" action="<?= base_url('bm/channel/requestWithdraw'); ?>" method="post">
                                    <input type="hidden" name="net_income" id="net_income" value="<?= $in; ?>">
                                    <input type="hidden" name="ppn_income" id="ppn_income" value="<?= $ppn; ?>">
                                    <div class="">
                                        <button type="submit" class="btn">Request Witdraw<i class="fas fa-arrow-circle-right"></i></button>
                                    </div>

                                </form>

                            </div>
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