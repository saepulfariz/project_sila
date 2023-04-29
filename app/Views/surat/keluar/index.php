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
                <a href="<?= base_url('surat/keluar/new'); ?>" class="btn btn-primary btn-sm mb-2">New</a>
                <div class="card">
                    <div class="card-header">
                        Kelola Surat
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Surat</th>
                                    <th>Nama Surat</th>
                                    <th>File Surat</th>
                                    <th>Kategori</th>
                                    <th>Jenis Surat</th>
                                    <th>Status</th>
                                    <th>Pemohon</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($surat as $d) : ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= $d['no_surat']; ?></td>
                                        <td><?= $d['nama_surat']; ?></td>
                                        <td><?= $d['file_surat']; ?></td>
                                        <td><?= $d['nama_kategori']; ?></td>
                                        <td><?= ($d['is_out'] == 1) ? 'Keluar' : 'Masuk'; ?></td>
                                        <td><?= $d['nama_status']; ?></td>
                                        <td><?= $d['pemohon']; ?></td>
                                        <td><?= $d['created_at']; ?></td>
                                        <td>
                                            <?php if ($d['id_status'] == 1) : ?>

                                                <a class="btn btn-warning btn-sm mb-2" href="<?= base_url('surat/keluar/' . $d['id_surat'] . '/edit'); ?>">Edit</a>
                                                <?php if (session()->get('id_role') == 2 || session()->get('id_role') == 3) : ?>
                                                    <form action='<?= base_url('surat/keluar') . '/' . $d['id_surat']; ?>' method='post' enctype='multipart/form-data'>
                                                        <input type='hidden' name='_method' value='DELETE' />
                                                        <!-- GET, POST, PUT, PATCH, DELETE-->
                                                        <?= csrf_field(); ?>
                                                        <button type="button" onclick="deleteTombol(this)" class="btn btn-danger btn-sm mb-2">Delete</button>
                                                    </form>
                                                <?php else : ?>

                                                <?php endif; ?>
                                            <?php else : ?>

                                            <?php endif; ?>
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