<?= $this->extend('template/index') ?>




<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Asset Pinjam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Laporan</li>
                    <li class="breadcrumb-item">Asset Pinjam</li>
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
                        Asset Pinjam
                    </div>
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Start</span>
                                        </div>
                                        <input type="date" class="form-control" name="start" id="start" value="<?= $start; ?>">
                                    </div>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">End</span>
                                        </div>
                                        <input type="date" class="form-control" name="end" id="name" value="<?= $end; ?>">
                                    </div>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pinjam</th>
                                    <th>Nama Pinjam</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Jatuh Tempo</th>
                                    <th>Tgl Kembali</th>
                                    <th>Perihal</th>
                                    <th>Catatan</th>
                                    <th>Nama Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($data as $d) : ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= $d['kode_pinjam']; ?></td>
                                        <td><?= $d['nama_lengkap']; ?></td>
                                        <td><?= $d['tgl_pinjam']; ?></td>
                                        <td><?= $d['jatuh_tempo']; ?></td>
                                        <td><?= ($d['tgl_kembali'] == '0000-00-00') ? '-' : $d['tgl_kembali']; ?></td>
                                        <td><?= $d['perihal']; ?></td>
                                        <td><?= $d['catatan']; ?></td>
                                        <td><?= $d['nama_status']; ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm mb-2" href="<?= base_url($link . '/' . $d['kode_pinjam'] . ''); ?>">Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script>
    var table = $('#table').DataTable({
        responsive: true,
        "dom": 'Bflrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        "pageLength": 5,
        "lengthMenu": [
            [5, 100, 1000, -1],
            [5, 100, 1000, "ALL"],
        ],

    })
</script>
<?= $this->endSection('script') ?>