<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
        <img src="<?= base_url('assets/img/core-img/iconba.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BeatAudio</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Manage Acount
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
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('bm/channel/content'); ?>" class="nav-link">
                                <i class="nav-icon fa-regular fa-folder"></i>
                                <p>Content</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('bm/channel/infoWd'); ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-money-bills"></i>
                                <p>Information Withdraw</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('bm/channel/setting'); ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-gear"></i>
                                <p>Setting</p>
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
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>