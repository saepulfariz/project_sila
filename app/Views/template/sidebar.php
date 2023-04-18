<?php

$user = new App\Models\UserModel();
$request = \Config\Services::request();
$segment = $request->uri->getSegment(1);
$segment2 = $request->uri->getSegment(2);

$resUser = $user->join('tb_role', 'tb_role.id_role = tb_user.id_role')->find(session()->get('id_user'));

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link">
        <img src="<?= base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SILA</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url(); ?>assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $resUser['username']; ?> - <?= $resUser['nama_role']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class  with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= ($segment == 'dashboard') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <?php if (session()->get('id_role') == 1) : ?>

                    <li class="nav-item">
                        <a href="<?= base_url('user'); ?>" class="nav-link <?= ($segment == 'user') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Kelola User
                            </p>
                        </a>
                    </li>

                <?php endif; ?>

                <li class="nav-item  <?= ($segment == 'helpdesk') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-headset"></i>
                        <p>
                            Helpdesk
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('helpdesk/list'); ?>" class="nav-link <?= ($segment2 == 'list') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('helpdesk/kategori'); ?>" class="nav-link <?= ($segment2 == 'kategori') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  <?= ($segment == 'surat') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Surat
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('surat/masuk'); ?>" class="nav-link <?= ($segment2 == 'masuk') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Masuk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('surat/keluar'); ?>" class="nav-link <?= ($segment2 == 'keluar') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Keluar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('surat/kategori'); ?>" class="nav-link <?= ($segment2 == 'kategori') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item  <?= ($segment == 'profile' || $segment == 'gantipass') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('profile'); ?>" class="nav-link <?= ($segment == 'profile') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    My Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('gantipass'); ?>" class="nav-link <?= ($segment == 'gantipass') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Ganti Password
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url(); ?>logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
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