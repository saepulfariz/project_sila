<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Surat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item">Kelola Surat</li>
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
        <form action="<?= base_url('surat/keluar/' . $surat['id_surat']); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-5 mb-2">
                    <div class="card">
                        <div class="card-header">
                            Edit Surat
                        </div>
                        <div class="card-body">
                            <input type='hidden' name='_method' value='PUT' />
                            <!-- GET, POST, PUT, PATCH, DELETE-->
                            <?= csrf_field(); ?>

                            <?php $disabled = ((session()->get('id_role') == 2) || session()->get('id_role') == 1) ? 'disabled' : ''; ?>

                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select class="form-control" name="id_kategori" <?= $disabled; ?> id="id_kategori">
                                    <?php foreach ($kategori as $d) : ?>
                                        <?php if ($d['id_kategori'] == $surat['id_kategori']) : ?>

                                            <option selected value="<?= $d['id_kategori']; ?>"><?= $d['nama_kategori']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $d['id_kategori']; ?>"><?= $d['nama_kategori']; ?></option>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>




                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <textarea required class="form-control" id="perihal" name="perihal" <?= $disabled; ?>><?= $surat['perihal']; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="kepada">Ditujukan kepada</label>
                                <input type="text" required class="form-control" id="kepada" name="kepada" <?= $disabled; ?> value="<?= $surat['kepada']; ?>">
                            </div>



                            <?php if ((session()->get('id_role') == 2) || (session()->get('id_role') == 1)) : ?>
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea required class="form-control" id="catatan" name="catatan"><?= $surat['catatan']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="nama_surat">Nama Surat</label>
                                    <input type="text" required class="form-control" id="nama_surat" name="nama_surat" value="<?= $surat['nama_surat']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="no_surat">No Surat</label>
                                    <input type="text" required class="form-control" id="no_surat" name="no_surat" value="<?= $surat['no_surat']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="file_surat">File Surat</label>
                                    <a href="<?= base_url(); ?>assets/upload/surat/<?= $surat['file_surat']; ?>" target="_blank"><?= $surat['file_surat']; ?></a>
                                    <input type="file" class="form-control" id="file_surat" name="file_surat">
                                </div>

                                <div class="form-group">
                                    <label for="id_status">Status</label>
                                    <select name="id_status" id="id_status" class="form-control">
                                        <?php foreach ($status as $d) : ?>
                                            <?php if ($d['id_status'] == $surat['id_status']) : ?>

                                                <option selected value="<?= $d['id_status']; ?>"><?= $d['nama_status']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $d['id_status']; ?>"><?= $d['nama_status']; ?></option>

                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php else : ?>

                            <?php endif; ?>


                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url('surat/keluar'); ?>" class="btn btn-secondary">Batal</a>


                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
</section>
<?= $this->endSection('content') ?>