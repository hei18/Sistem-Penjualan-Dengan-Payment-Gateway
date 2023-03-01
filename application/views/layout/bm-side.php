<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
        <a href="<?= base_url('bm/channel'); ?>" style="color: white;">
            <img src="<?= base_url('assets/img/core-img/icon-beataudio.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">BeatAudio</span>

        </a>

    </div>



    <!-- Sidebar -->
    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Kelola Akun
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('bm/channel'); ?>" class="nav-link">
                                <i class=" nav-icon fa-solid fa-gauge"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('bm/channel/profile'); ?>" class="nav-link">
                                <i class=" nav-icon fa-regular fa-user"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('bm/channel/content'); ?>" class="nav-link">
                                <i class="nav-icon fa-regular fa-folder"></i>
                                <p>Instrumental</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('bm/channel/infoWd'); ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-money-bills"></i>
                                <p>Informasi Penarikan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('bm/channel/setting'); ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-gear"></i>
                                <p>Pengaturan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('publics'); ?>" class="nav-link">
                        <i class="nav-icon fa-sharp fa-solid fa-music"></i>

                        <p>
                            BeatAudio
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>