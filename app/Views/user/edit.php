<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Kelola User</li>
                    <li class="breadcrumb-item active">Edit</li>
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
        <form action="<?= base_url('user/' . $user['id_user']); ?>" method="post">
            <div class="row">
                <div class="col-md-5 mb-2">
                    <div class="card">
                        <div class="card-header">
                            Edit User
                        </div>
                        <div class="card-body">
                            <input type='hidden' name='_method' value='PUT' />
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" disabled placeholder="Username" value="<?= $user['username']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" required placeholder="nama_lengkap">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required placeholder="email">
                            </div>
                            <div class="form-group">
                                <label for="email">Role</label>
                                <select name="id_role" id="id_role" required class="form-control">
                                    <?php foreach ($role as $d) : ?>
                                        <?php if ($d['id_role'] == $user['id_role']) : ?>
                                            <option selected value="<?= $d['id_role']; ?>"><?= $d['nama_role']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $d['id_role']; ?>"><?= $d['nama_role']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" required placeholder="nik" value="<?= $user['nik']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required placeholder="tanggal_lahir" value="<?= $user['tanggal_lahir']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option <?= ($user['jenis_kelamin'] == 'LAKI-LAKI') ? 'selected' : ''; ?>>LAKI-LAKI</option>
                                    <option <?= ($user['jenis_kelamin'] == 'PEREMPUAN') ? 'selected' : ''; ?>>PEREMPUAN</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="asal_instansi">Asal Instansi</label>
                                <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" required placeholder="Asal Instansi" value="<?= $user['asal_instansi']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="asal_instansi">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5"><?= $user['alamat']; ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>


    </div>
</section>
<?= $this->endSection('content') ?>