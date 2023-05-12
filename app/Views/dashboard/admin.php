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
                        <h4 class="font-weight-bold">Total User</h4>
                        <h5 class=""><?= $count_user; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('user'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card bg-gradient-navy">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Total Helpdesk</h4>
                        <h5 class=""><?= $count_helpdesk; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('helpdesk/list'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h4 class="font-weight-bold text-white">Total Surat Masuk</h4>
                        <h5 class="text-white"><?= $count_masuk; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('surat/masuk'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card bg-gradient-gray">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Total Surat Keluar</h4>
                        <h5 class=""><?= $count_keluar; ?></h5>
                        <a class="mt-1 text-white" href="<?= base_url('surat/keluar'); ?>">
                            <i class="fas fa-search mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="card mb-4">
                    <div class="card-header bg-dark">
                        <i class="fas fa-chart-line mr-1"></i>
                        Helpdesk Kategori
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($helpdesk as $d) : ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= $d['nama_kategori']; ?></td>
                                        <?php

                                        $modelhelpdesk = new \App\Models\HelpdeskModel();
                                        $countData = $modelhelpdesk->select('count(id_helpdesk) as count')->where('id_kategori', $d['id_kategori'])->first()['count'];
                                        ?>
                                        <td><?= $countData; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-dark">
                        <i class="fas fa-chart-line mr-1"></i>
                        Surat Kategori
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($surat as $d) : ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= $d['nama_kategori']; ?></td>
                                        <td><?= $d['count']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-2">
                <div class="card">
                    <div class="card-header bg-dark">
                        Paling Banyak Pengaduan Helpdesk
                    </div>
                    <div class="card-bod">
                        <h1>INI CHART</h1>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<?= $this->endSection('script') ?>