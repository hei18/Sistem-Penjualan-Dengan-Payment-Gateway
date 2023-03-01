<!-- ##### Breadcumb Area Start ##### -->
<section class="oneMusic-buy-now-area has-fluid bg-gray section-padding-100" style="background-image: url(<?= base_url('assets/'); ?>img/bg-img/breadcumb31.jpg);">
    <div class="container-fluid section-padding-100">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="login-content">
                    <h3>Silahkan Registrasi</h3>
                    <!-- Login Form -->
                    <div class="card-body">
                        <form action="<?= base_url('auth/register'); ?>" method="post">

                            <div class="form-group">
                                <label for="">Email</label>
                                <input autocomplete="off" class="form-control" type="text" name="email" id="email" placeholder="Enter Your Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class=" text-danger">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input autocomplete="off" type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                                <?= form_error('password1', '<small class=" text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ulangi Password</label>
                                <input autocomplete="off" type="password" class="form-control" id="password2" name="password2" placeholder="Password">
                                <?= form_error('password2', '<small class=" text-danger">', '</small>'); ?>

                            </div>
                            <div class="form-group">
                                <label for="disabledSelect">Siapakah Anda ?</label>
                                <h5>
                                    <input style="transform: scale(1.5);" type="radio" id="role" name="role" value="beatmaker">&nbsp;BeatMaker
                                </h5>
                                <h5>
                                    <input style="transform: scale(1.5);" type="radio" id="role" name="role" value="customer">&nbsp;Customer
                                </h5>

                                <?= form_error('role', '<small class=" text-danger">', '</small>'); ?>
                            </div>
                            <div class="col mb-3">
                                <button type="submit" class="btn oneMusic-btn mt-30">Submit</button>
                            </div>
                            <div class="col">
                                <a href="<?= base_url('auth'); ?>">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Breadcumb Area End ##### -->