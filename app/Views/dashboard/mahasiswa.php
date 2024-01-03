<?= $this->extend('template/index') ?>

<?php

$user = new App\Models\UserModel();
$request = \Config\Services::request();
$segment = $request->uri->getSegment(1);

$resUser = $user->find(session()->get('id_user'));

?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-3 mb-2">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Helpdesk Pending</h4>
                        <h5 class=""><?= $helpdesk_pending; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('helpdesk/list'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card bg-gradient-navy">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Helpdesk Done</h4>
                        <h5 class=""><?= $helpdesk_done; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('helpdesk/list'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h4 class="font-weight-bold text-white">Surat Pending</h4>
                        <h5 class="text-white"><?= $surat_pending; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('surat/keluar'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card bg-gradient-gray">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Surat Done</h4>
                        <h5 class=""><?= $surat_done; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('surat/keluar'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card bg-danger">
                    <div class="card-body">
                        <h4 class="font-weight-bold text-white">Pinjam Pending</h4>
                        <h5 class="text-white"><?= $pinjam_pending; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('asset/pinjam/list'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card bg-purple">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Pinjam Done</h4>
                        <h5 class=""><?= $pinjam_done; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('asset/pinjam/list'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<?= $this->endSection('script') ?>