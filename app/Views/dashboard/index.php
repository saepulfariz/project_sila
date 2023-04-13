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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        DASHBOARD
                    </div>
                    <div class="card-body">
                        <p>Selamat Datang, Sistem Informasi Klink Evoty, Login Sebagai <b><?= $resUser['username']; ?></b></p>

                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<?= $this->endSection('script') ?>