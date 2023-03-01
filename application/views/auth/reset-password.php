<!-- ##### Breadcumb Area Start ##### -->
<section class="oneMusic-buy-now-area has-fluid bg-gray section-padding-100" style="background-image: url(<?= base_url('assets/'); ?>img/bg-img/breadcumb31.jpg);">
    <div class="container-fluid section-padding-100">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="login-content">
                    <?php if ($this->session->userdata('reset_email_cs')) : ?>
                        <h3>Reset Password Untuk: <?= $this->session->userdata('reset_email_cs');   ?></h3>
                    <?php elseif ($this->session->userdata('reset_email_bm')) : ?>
                        <h3>Reset Password Untuk: <?= $this->session->userdata('reset_email_bm');   ?></h3>
                    <?php endif; ?>

                    <?= $this->session->flashdata('message'); ?>
                    <div class="card-body">
                        <form action="<?= base_url('auth/changepassword'); ?>" method="post">


                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                                <?= form_error('password1', '<small class=" text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ulagi Password</label>
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Password">
                                <?= form_error('password2', '<small class=" text-danger">', '</small>'); ?>

                            </div>
                            <div class="col mb-3">
                                <button type="submit" class="btn oneMusic-btn mt-30">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Breadcumb Area End ##### -->