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
        <span class="brand-text font-weight-light">KLINIK</span>
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


                <li class="nav-item  <?= ($segment == 'kunjungan' || $segment == 'resep' || $segment == 'visit_all') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clinic-medical"></i>
                        <p>
                            Kunjungan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('kunjungan'); ?>" class="nav-link <?= ($segment == 'kunjungan') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    List Baru
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('resep'); ?>" class="nav-link <?= ($segment == 'resep') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Resep Obat
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('visit_all'); ?>" class="nav-link <?= ($segment == 'visit_all') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    List Semua
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  <?= ($segment == 'pasien' || $segment == 'dept') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>
                            Kelola Pasien
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('pasien'); ?>" class="nav-link <?= ($segment == 'pasien') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    List Pasien
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('dept'); ?>" class="nav-link <?= ($segment == 'dept') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Kelola Dept
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  <?= ($segment == 'obat') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>
                            Kelola Obat
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('obat'); ?>" class="nav-link <?= ($segment2 == 'list') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    List Obat
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('obat/stock/in'); ?>" class="nav-link <?= ($segment2 == 'stock') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Stock In
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('gantipass'); ?>" class="nav-link <?= ($segment == 'gantipass') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Stock Out
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('obat/bentuk'); ?>" class="nav-link <?= ($segment2 == 'bentuk') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Kelola Bentuk/Jenis
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('obat/kategori'); ?>" class="nav-link <?= ($segment2 == 'kategori') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Kelola Kategori
                                </p>
                            </a>
                        </li>
                    </ul>
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