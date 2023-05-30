<?= $this->extend('template/index') ?>




<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Helpdesk</li>
                    <li class="breadcrumb-item">List</li>
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
                <a href="<?= base_url('helpdesk/list/new'); ?>" class="btn btn-primary btn-sm mb-2">New</a>
                <div class="card">
                    <div class="card-header">
                        List
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mahasiswa</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Gambar</th>
                                    <th>Nama Dosen</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($helpdesk as $d) : ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= $d['nama_lengkap']; ?></td>
                                        <td><?= $d['deskripsi']; ?></td>
                                        <td><?= $d['nama_kategori']; ?></td>
                                        <td><img src="<?= base_url(); ?>assets/upload/helpdesk/<?= $d['gambar']; ?>" width="100px" alt=""></td>
                                        <td><?= $d['nama_dosen']; ?></td>
                                        <td>
                                            <?php if ($d['id_status'] == 1) : ?>
                                                <a href="<?= base_url(); ?>helpdesk/list/status/<?= $d['id_helpdesk']; ?>" class="badge badge-secondary"><?= $d['nama_status']; ?></a>
                                            <?php else : ?>
                                                <span class="badge badge-success"><?= $d['nama_status']; ?></span>
                                            <?php endif; ?>

                                        </td>
                                        <td><?= $d['catatan']; ?></td>
                                        <td><?= $d['created_at']; ?></td>
                                        <td>
                                            <?php if ($d['id_status'] == 1) : ?>
                                                <a class="btn btn-warning btn-sm mb-2" href="<?= base_url('helpdesk/list/' . $d['id_helpdesk'] . '/edit'); ?>">Edit</a>

                                                <form action='<?= base_url('helpdesk/list') . '/' . $d['id_helpdesk']; ?>' method='post' enctype='multipart/form-data'>
                                                    <input type='hidden' name='_method' value='DELETE' />
                                                    <!-- GET, POST, PUT, PATCH, DELETE-->
                                                    <?= csrf_field(); ?>
                                                    <button type="button" onclick="deleteTombol(this)" class="btn btn-danger btn-sm mb-2">Delete</button>
                                                </form>
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