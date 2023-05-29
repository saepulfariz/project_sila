<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Helpdesk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Helpdesk</li>
                    <li class="breadcrumb-item">Kelola Helpdesk</li>
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
        <form action="<?= base_url('helpdesk/list/' . $helpdesk['id_helpdesk']); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-5 mb-2">
                    <div class="card">
                        <div class="card-header">
                            Edit Helpdesk
                        </div>
                        <div class="card-body">
                            <?= csrf_field(); ?>
                            <input type='hidden' name='_method' value='PUT' />
                            <!-- GET, POST, PUT, PATCH, DELETE-->

                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select class="form-control" name="id_kategori" id="id_kategori">
                                    <?php foreach ($kategori as $d) : ?>
                                        <?php if ($helpdesk['id_kategori'] == $d['id_kategori']) : ?>

                                            <option selected value="<?= $d['id_kategori']; ?>"><?= $d['nama_kategori']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $d['id_kategori']; ?>"><?= $d['nama_kategori']; ?></option>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group <?= ($helpdesk['nama_dosen'] == '') ? 'd-none' : ''; ?>" id="input-dosen">
                                <label for="nama_dosen">Nama Dosen</label>
                                <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" value="<?= $helpdesk['nama_dosen']; ?>">
                            </div>

                            <div class="<?= ($helpdesk['gambar'] == '') ? 'd-none' : ''; ?>" id="input-gambar">

                                <a href="<?= base_url(); ?>assets/upload/helpdesk/<?= $helpdesk['gambar']; ?>" target="_blank">
                                    <img class="img-thumbnail mb-1" width="170px" src="<?= base_url(); ?>assets/upload/helpdesk/<?= $helpdesk['gambar']; ?>" alt="">
                                </a>
                                <div class="form-group ">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" class="form-control" name="gambar" id="gambar">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="3"><?= $helpdesk['deskripsi']; ?></textarea>
                            </div>

                            <?php if (session()->get('id_role') != 4) : ?>

                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="5"><?= $helpdesk['catatan']; ?></textarea>
                                </div>

                            <?php endif; ?>


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
    // setInput();
    $('#id_kategori').on('change', setInput);
</script>
<?= $this->endSection('script') ?>