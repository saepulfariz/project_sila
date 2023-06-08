<?= $this->extend('template/index') ?>




<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Kelola Surat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item">Kelola Surat</li>
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
                        Kelola Surat
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Perihal</th>
                                    <th>Ditujukan</th>
                                    <th>No Surat</th>
                                    <th>Nama Surat</th>
                                    <th>File Surat</th>
                                    <th>Status</th>
                                    <th>Pemohon</th>
                                    <th>Date Create </th>
                                    <th>Approve</th>
                                    <th>Date Approve</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($surat as $d) : ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= $d['nama_kategori']; ?></td>
                                        <td><?= $d['perihal']; ?></td>
                                        <td><?= $d['kepada']; ?></td>
                                        <td><?= $d['no_surat']; ?></td>
                                        <td><?= $d['nama_surat']; ?></td>
                                        <td>
                                            <?php if ($d['file_surat'] != '') : ?>

                                                <a href="<?= base_url(); ?>assets/upload/surat/<?= $d['file_surat']; ?>" target="_blank">Download Here</a>
                                            <?php else : ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($d['id_status'] == 1) : ?>
                                                <span class="badge badge-secondary"><?= $d['nama_status']; ?></span>
                                            <?php elseif ($d['id_status'] == 2) : ?>
                                                <span class="badge badge-success"><?= $d['nama_status']; ?></span>
                                            <?php else : ?>
                                                <span class="badge badge-danger"><?= $d['nama_status']; ?></span>
                                            <?php endif; ?>

                                        </td>
                                        <td><?= $d['pemohon']; ?></td>
                                        <td><?= $d['created_at']; ?></td>
                                        <td><?= $d['approve']; ?></td>
                                        <td><?= $d['updated_at']; ?></td>

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