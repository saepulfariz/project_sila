<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item">Kelola Kategori</li>
                    <li class="breadcrumb-item active">New</li>
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
        <form action="<?= base_url('surat/kategori'); ?>" method="post">
            <div class="row">
                <div class="col-md-5 mb-2">
                    <div class="card">
                        <div class="card-header">
                            New Kategori
                        </div>
                        <div class="card-body">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="nama_kategori">Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required placeholder="Nama Kategori">
                            </div>

                            <div class="form-group">
                                <label for="is_out">Is Out</label>
                                <select class="form-control" name="is_out" id="is_out">
                                    <option value="1">Keluar</option>
                                    <option value="0">Masuk</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url('surat/kategori'); ?>" class="btn btn-secondary">Batal</a>


                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
</section>
<?= $this->endSection('content') ?>