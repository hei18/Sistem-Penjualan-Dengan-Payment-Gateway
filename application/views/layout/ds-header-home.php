<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?= $header; ?></title>

    <!-- Favicon -->

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?= site_url('assets/style.css'); ?>">
    <link rel="stylesheet" href="<?= site_url('assets/new-style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>


    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Navbar Area -->
        <div class="oneMusic-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="oneMusicNav">

                        <!-- Nav brand -->
                        <a href="<?= base_url('publics'); ?>" class="nav-brand"><img src="<?= base_url('assets/'); ?>img/core-img/logoss.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="<?= base_url('publics'); ?>">Halaman Utama</a></li>
                                    <li><a href="<?= base_url('publics/instrumental'); ?>">Instrumental</a></li>


                                    <li><a href="<?= base_url('publics/about'); ?>">Tentang Kami</a></li>
                                </ul>
                                <?php if ($this->session->userdata('email')) : ?>
                                    <?php if ($this->session->userdata('role') == 'customer') : ?>
                                        <ul>
                                            <li class="login-register-cart-button">
                                                <a href="#"> <?= $cs['nickname']; ?></a>
                                                <ul class="dropdown">
                                                    <li><a href="<?= base_url('cs/dashboard'); ?>">Dashboard</a></li>
                                                    <li><a href="<?= base_url('auth/logout'); ?>">Keluar</a></li>
                                                </ul>
                                            </li>

                                        </ul>

                                    <?php elseif ($this->session->userdata('role') == 'beatmaker') : ?>
                                        <ul>
                                            <li class="login-register-cart-button">
                                                <a href="#"> <?= $this->session->userdata('nickname') ?></a>
                                                <ul class="dropdown">
                                                    <li><a href="<?= base_url('bm/channel'); ?>">BeatAudio Studio</a></li>
                                                    <li><a href="<?= base_url('auth/logout'); ?>">Keluar</a></li>
                                                </ul>
                                            </li>

                                        </ul>
                                    <?php endif; ?>
                                    <?php if ($this->session->userdata('role') == 'customer') : ?>
                                        <li class="nav-item dropdown">
                                            <?php if (empty($count)) : ?>
                                                <a class="nav-link" data-toggle="dropdown" href="#">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                    <span class="badge badge-danger navbar-badge">0</span>
                                                </a>
                                            <?php elseif ($count) : ?>
                                                <a class="nav-link" data-toggle="dropdown" href="#">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                    <span class="badge badge-danger navbar-badge"><?= $count; ?></span>
                                                </a>

                                            <?php endif; ?>


                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a href="#" class="dropdown-item">
                                                    <?php if ($cart == null) : ?>
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <h6 class="dropdown-item-title">
                                                                    No Cart
                                                                </h6>


                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <?php foreach ($cart as $c) : ?>

                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <h6 class="dropdown-item-title">
                                                                        <?= $c['title']; ?>
                                                                    </h6>

                                                                    <p class="text-sm"><?= $c['qty']; ?> x <?= idr($c['bill_price']); ?></p>
                                                                    <p class="text-sm fa fa-calculator">&nbsp;<?= idr($c['subtotal']); ?></p>
                                                                </div>
                                                            </div>
                                                            <!-- Message End -->
                                                            <div class="dropdown-divider"></div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <?php if ($cart == null) : ?>
                                                    <?php else : ?>
                                                        <p class="text-sm">Total <?= idr($sum); ?></p>
                                                    <?php endif; ?>
                                                </a>
                                                <?php if ($cart == null) : ?>

                                                <?php else : ?>

                                                    <a href="<?= base_url('cs/dashboard/cart'); ?>" class="dropdown-item dropdown-footer">Ke Keranjang</a>
                                                <?php endif; ?>
                                            </div>

                                        </li>

                                    <?php elseif ($this->session->userdata('role') == 'beatmaker') : ?>

                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="login-register-cart-button d-flex align-items-center">
                                        <!-- Login/Register -->
                                        <div class="login-register-btn mr-50">
                                            <a href="<?= base_url('auth'); ?>" id="loginBtn">Masuk / Registrasi</a>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                            <!-- Nav End -->

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->