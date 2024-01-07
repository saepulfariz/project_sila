<?php

$user = new App\Models\UserModel();
$request = \Config\Services::request();
$segment = $request->uri->getSegment(1);
$segment2 = ($request->uri->getTotalSegments() > 1) ? $request->uri->getSegment(2) : NULL;
$segment3 = ($request->uri->getTotalSegments() > 2) ? $request->uri->getSegment(3) : NULL;

$resUser = $user->join('tb_role', 'tb_role.id_role = tb_user.id_role')->find(session()->get('id_user'));

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link">
        <img src="<?= base_url(); ?>assets/front/img/sila.png" alt="SILA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                <a href="#" class="d-block"><span class="text-capitalize"><?= $resUser['username']; ?></span> - <span class="text-capitalize"><?= $resUser['nama_role']; ?></span></a>
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

                <?php if (session()->get('id_role') == 4) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('helpdesk/list'); ?>" class="nav-link <?= ($segment == 'helpdesk') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-headset"></i>
                            <p>
                                Helpdesk
                            </p>
                        </a>
                    </li>

                <?php else : ?>

                    <li class="nav-item  <?= ($segment == 'helpdesk') ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-headset"></i>
                            <p>
                                Helpdesk
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (session()->get('id_role') == 4) : ?>

                                <li class="nav-item">
                                    <a href="<?= base_url('helpdesk/list'); ?>" class="nav-link <?= ($segment2 == 'list') ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            List
                                        </p>
                                    </a>
                                </li>
                            <?php else : ?>
                                <li class="nav-item">
                                    <a href="<?= base_url('helpdesk/list'); ?>" class="nav-link <?= ($segment2 == 'list') ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            List
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('helpdesk/kategori'); ?>" class="nav-link <?= (($segment == 'helpdesk') && ($segment2 == 'kategori')) ? 'active' : ''; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Kategori
                                        </p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>


                <li class="nav-item  <?= ($segment == 'surat') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Surat
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <?php if (session()->get('id_role') == 4) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('surat/keluar'); ?>" class="nav-link <?= ($segment2 == 'keluar') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Pengajuan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('surat/history'); ?>" class="nav-link <?= ($segment2 == 'history') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        History
                                    </p>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('surat/masuk'); ?>" class="nav-link <?= (($segment == 'surat') && $segment2 == 'masuk') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Masuk
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('surat/keluar'); ?>" class="nav-link <?= (($segment == 'surat') && $segment2 == 'keluar') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Pengajuan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('surat/history'); ?>" class="nav-link <?= (($segment == 'surat') && $segment2 == 'history') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        History
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('surat/kategori'); ?>" class="nav-link <?= (($segment == 'surat') && ($segment2 == 'kategori')) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Kategori
                                    </p>
                                </a>
                            </li>

                        <?php endif; ?>
                    </ul>
                </li>


                <li class="nav-item  <?= ($segment == 'asset') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon  fas fa-shapes"></i>
                        <p>
                            Asset
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ((session()->get('id_role') != 4) && (session()->get('id_role') != 3)) : ?>



                            <li class="nav-item">
                                <a href="<?= base_url('asset/item'); ?>" class="nav-link <?= (($segment == 'asset') && ($segment2 == 'item')) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Item
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('asset/log'); ?>" class="nav-link <?= (($segment == 'asset') && ($segment2 == 'log')) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Item Log
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('asset/status'); ?>" class="nav-link <?= (($segment == 'asset') && ($segment2 == 'status')) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Status
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('asset/kategori'); ?>" class="nav-link <?= (($segment == 'asset') && ($segment2 == 'kategori')) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Kategori
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('asset/barang'); ?>" class="nav-link <?= (($segment == 'asset') && ($segment2 == 'barang')) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Barang
                                    </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="<?= base_url('asset/pinjam/status'); ?>" class="nav-link <?= (($segment == 'asset') && ($segment2 == 'pinjam') && ($segment3 == 'status')) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Pinjam Status
                                    </p>
                                </a>
                            </li>

                        <?php endif; ?>

                        <li class="nav-item">
                            <a href="<?= base_url('asset/pinjam/list'); ?>" class="nav-link <?= (($segment == 'asset') && ($segment2 == 'pinjam') && ($segment3 == 'list')) ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Pinjam List
                                </p>
                            </a>
                        </li>





                    </ul>
                </li>


                <?php if (session()->get('id_role') != 4) : ?>

                    <li class="nav-item  <?= ($segment == 'laporan') ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-mail-bulk"></i>
                            <p>
                                Laporan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('laporan/helpdesk'); ?>" class="nav-link <?= ($segment == 'laporan' && $segment2 == 'helpdesk') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Helpdesk
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('laporan/history'); ?>" class="nav-link <?= ($segment == 'laporan' && $segment2 == 'history') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        History
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('laporan/keluar'); ?>" class="nav-link <?= ($segment == 'laporan' && $segment2 == 'keluar') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Surat Pengajuan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('laporan/masuk'); ?>" class="nav-link <?= ($segment == 'laporan' && $segment2 == 'masuk') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Surat Masuk
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('laporan/asset_pinjam'); ?>" class="nav-link <?= ($segment == 'laporan' && $segment2 == 'asset_pinjam') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Asset Pinjam
                                    </p>
                                </a>
                            </li>
                        </ul>
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