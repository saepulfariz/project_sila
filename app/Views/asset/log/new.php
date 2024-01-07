<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Log</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Asset</li>
                    <li class="breadcrumb-item">Kelola Log</li>
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
        <form action="<?= base_url($link); ?>" method="post">
            <div class="row">
                <div class="col-md-5 mb-2">
                    <div class="card">
                        <div class="card-header">
                            New Log
                        </div>
                        <div class="card-body">
                            <?= csrf_field(); ?>

                            <div class="form-group">
                                <label for="id_item">Item</label>
                                <select name="id_item" id="id_item" class="form-control">
                                    <option selected disabled>== PILIH == </option>
                                    <?php foreach ($item as $d) : ?>
                                        <option value="<?= $d['id_item']; ?>"><?= $d['kode_item']; ?> | <?= $d['nama_barang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="id_status">Status</label>
                                <select name="id_status" id="id_status" class="form-control">
                                    <option selected disabled>== PILIH == </option>
                                    <?php foreach ($status as $d) : ?>
                                        <option value="<?= $d['id_status']; ?>"><?= $d['nama_status']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_penanggung_jawab">Penanggung Jawab</label>
                                <select name="id_penanggung_jawab" id="id_penanggung_jawab" class="form-control">
                                    <option selected disabled>== PILIH == </option>
                                    <?php foreach ($user as $d) : ?>
                                        <option value="<?= $d['id_user']; ?>"><?= $d['nama_lengkap']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url($link); ?>" class="btn btn-secondary">Batal</a>


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
    function setKodeItem() {
        var id = $('#id_barang').val();
        $.ajax({
            url: '<?= base_url($link); ?>/' + id,
            method: 'GET', // POST
            data: {
                // id: id
            },
            dataType: 'json', // json
            success: function(data) {
                if (data.error != true) {
                    alert('not found');
                } else {
                    $('#kode_item').val(data.data);
                }
            }
        });
    }

    $('#id_barang').on('change', function() {
        setKodeItem();
    })
</script>
<?= $this->endSection('script') ?>