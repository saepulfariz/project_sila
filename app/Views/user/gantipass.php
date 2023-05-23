<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ganti Password</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Profile</li>
                    <li class="breadcrumb-item active">Ganti Password</li>
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
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Ganti Password
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('gantipass'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="password_lama">Password Lama</label>
                                <input type="password" class="form-control" id="password_lama" name="password_lama" required placeholder="Password Lama">
                            </div>
                            <div class="form-group">
                                <label for="password_baru">Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru" required placeholder="Password Baru">
                            </div>
                            <div class="form-group">
                                <label for="password_retype">Password Retype</label>
                                <input type="password" class="form-control" id="password_retype" name="password_retype" required placeholder="Password Retype">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<?= $this->endSection('content') ?>