<!-- ##### Breadcumb Area Start ##### -->
<section class="oneMusic-buy-now-area has-fluid bg-gray section-padding-100" style="background-image: url(<?= base_url('assets/'); ?>img/bg-img/breadcumb31.jpg);">
    <div class="container-fluid section-padding-100">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="login-content">
                    <h3>Selamat Datang</h3>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card-body">
                        <form action="<?= base_url('auth'); ?>" method="post">

                            <div class="form-group">
                                <label for="">Email</label>
                                <input autocomplete="off" class="form-control" type="text" name="email" id="email" placeholder="Enter Your Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class=" text-danger">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <?= form_error('password', '<small class=" text-danger">', '</small>'); ?>
                            </div>

                            <div class="col mb-3 ">

                                <button type="submit" class="btn  form-control oneMusic-btn mt-30">Submit</button>
                            </div>
                            <div class="col mb-3">
                                <a href="<?= base_url('auth/register'); ?>">Buat Akun ?</a>
                            </div>
                            <div class="col ">
                                <a href="<?= base_url('auth/forgotPassword'); ?>">Lupa Password ?</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Breadcumb Area End ##### -->