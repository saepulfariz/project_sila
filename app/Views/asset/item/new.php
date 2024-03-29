<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Item</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Asset</li>
                    <li class="breadcrumb-item">Kelola Item</li>
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
                            New Item
                        </div>
                        <div class="card-body">
                            <?= csrf_field(); ?>

                            <div class="form-group">
                                <label for="id_barang">Barang</label>
                                <select name="id_barang" id="id_barang" class="form-control">
                                    <option selected disabled>== PILIH == </option>
                                    <?php foreach ($barang as $d) : ?>
                                        <option value="<?= $d['id_barang']; ?>"><?= $d['nama_barang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kode_item">Kode Item</label>
                                <input type="text" class="form-control" readonly id="kode_item" name="kode_item" required placeholder="Kode Item">
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