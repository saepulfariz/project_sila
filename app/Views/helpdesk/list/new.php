<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Helpdesk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Helpdesk</li>
                    <li class="breadcrumb-item">Kelola Helpdesk</li>
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
        <form action="<?= base_url('helpdesk/list'); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-5 mb-2">
                    <div class="card">
                        <div class="card-header">
                            New Helpdesk
                        </div>
                        <div class="card-body">
                            <?= csrf_field(); ?>

                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select class="form-control" name="id_kategori" id="id_kategori">
                                    <?php foreach ($kategori as $d) : ?>
                                        <option value="<?= $d['id_kategori']; ?>"><?= $d['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group d-none" id="input-dosen">
                                <label for="nama_dosen">Nama Dosen</label>
                                <input type="text" class="form-control" name="nama_dosen" id="nama_dosen">
                            </div>

                            <div class="form-group" id="input-gambar">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" name="gambar" id="gambar">
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url('helpdesk/list'); ?>" class="btn btn-secondary">Batal</a>


                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
</section>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script>
    function setInput() {
        var idKategori = $('#id_kategori').val();
        if ((idKategori == 3) || (idKategori == 4)) {
            $('#input-dosen').removeClass('d-none');
            $('#input-gambar').addClass('d-none');
            $('#gambar').val('');
        } else if (idKategori == 1) {
            $('#input-gambar').removeClass('d-none');
            $('#input-dosen').addClass('d-none');
            $('#nama_dosen').val('');
        } else {
            $('#input-gambar').addClass('d-none');
            $('#gambar').val('');
            $('#input-dosen').addClass('d-none');
            $('#nama_dosen').val('');
        }
    }

    $('#id_kategori').on('change', setInput);
</script>
<?= $this->endSection('script') ?>