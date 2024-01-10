<?= $this->extend('template/index') ?>




<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Kelola User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Kelola User</li>
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
                <a href="<?= base_url('user/new'); ?>" class="btn btn-primary btn-sm mb-2">New</a>
                <div class="card">
                    <div class="card-header">
                        Kelola User
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Is Active</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;
                                foreach ($user as $d) : ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <td><?= $d['username']; ?></td>
                                        <td><?= $d['nama_lengkap']; ?></td>
                                        <td><?= $d['nama_role']; ?></td>
                                        <td><?= $d['email']; ?></td>
                                        <td>
                                            <?php if ($d['is_active'] == 1) : ?>
                                                <a class="btn btn-success btn-sm" href="<?= base_url('user/active/' . $d['id_user'] . '/0'); ?>">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            <?php else : ?>
                                                <a class="btn btn-danger btn-sm" href="<?= base_url('user/active/' . $d['id_user'] . '/1'); ?>">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm mb-2" href="<?= base_url('user/' . $d['id_user'] . '/edit'); ?>">Edit</a>
                                            <form action='<?= base_url('user') . '/' . $d['id_user']; ?>' method='post' enctype='multipart/form-data'>
                                                <input type='hidden' name='_method' value='DELETE' />
                                                <!-- GET, POST, PUT, PATCH, DELETE-->
                                                <?= csrf_field(); ?>
                                                <button type="button" onclick="deleteTombol(this)" class="btn btn-danger btn-sm mb-2">Delete</button>
                                            </form>
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
        buttons: [{
                extend: 'copy',
                className: "btn bg-tranparent btn-primary",
                footer: true
            },
            {
                extend: 'pdf',
                className: "btn bg-tranparent btn-success",
                footer: true
            },
            {
                extend: 'excel',
                className: "btn bg-tranparent btn-danger",
                footer: true
            },
        ],
        "pageLength": 5,
        "lengthMenu": [
            [5, 100, 1000, -1],
            [5, 100, 1000, "ALL"],
        ],

    })
</script>
<?= $this->endSection('script') ?>