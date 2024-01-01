<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Pinjam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Asset</li>
                    <li class="breadcrumb-item">Kelola Pinjam</li>
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
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-header">
                            New Pinjam
                        </div>
                        <div class="card-body">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="kode_pinjam">Kode Pinjam</label>
                                <input type="text" readonly class="form-control" id="kode_pinjam" name="kode_pinjam" value="<?= $kode_pinjam; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tgl_pinjam">Tgl Pinjam</label>
                                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
                            </div>

                            <div class="form-group">
                                <label for="jatuh_tempo">Jatuh Tempo</label>
                                <input type="date" class="form-control" id="jatuh_tempo" name="jatuh_tempo" required>
                            </div>

                            <div class="form-group">
                                <label for="tgl_kembali">Tgl Kembali</label>
                                <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
                            </div>

                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <textarea class="form-control" name="perihal" id="perihal" cols="30" rows="3"></textarea>
                            </div>


                        </div>
                    </div>


                </div>
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-body">


                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="id_status">Status</label>
                                <select name="id_status" id="id_status" class="form-control">
                                    <?php foreach ($status as $d) : ?>
                                        <option value="<?= $d['id_status']; ?>"><?= $d['nama_status']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>




                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="id_barang">Barang</label>
                                        <select name="id_barang" id="id_barang" class="form-control">
                                            <?php foreach ($barang as $d) : ?>
                                                <option value="<?= $d['id_barang']; ?>"><?= $d['nama_barang']; ?> | <?= $d['qty']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="qty">Qty</label>
                                        <input type="number" name="qty" id="qty" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="add-barang" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <p>Data Barang</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barang</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="result"></tbody>
                            </table>
                            <hr>
                            <button type="submit" class="btn btn-primary ">Submit</button>
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
    function listBarang() {
        var kode_pinjam = $('#kode_pinjam').val();
        $.ajax({
            url: '<?= base_url($link . '/list_barang'); ?>',
            method: 'GET', // POST
            data: {
                kode_pinjam: kode_pinjam
            },
            dataType: 'json', // json
            success: function(data) {
                var list = '';
                var i = 1;
                for (let index = 0; index < data.data.length; index++) {
                    const element = data.data[index];
                    list = list + `<tr>
                        <td>` + i + `</td>
                        <td>` + element.nama_barang + `</td>
                        <td>` + element.qty + `</td>
                        <td><button class="btn btn-sm btn-danger" type="button" onclick="deleteBarang(` + element.id + `)">X</button></td>
                    </tr>`;
                    i++;
                }
                $('#result').html(list);
            }
        });
    }

    listBarang();

    function addBarang() {
        var id_barang = $('#id_barang').val();
        var kode_pinjam = $('#kode_pinjam').val();
        var qty = $('#qty').val();
        $.ajax({
            url: '<?= base_url($link . '/add_barang'); ?>',
            method: 'GET', // POST
            data: {
                kode_pinjam: kode_pinjam,
                id_barang: id_barang,
                qty: qty,
            },
            dataType: 'json', // json
            success: function(data) {
                if (data.error == true) {
                    alert('not found');
                } else {
                    listBarang();
                }
            }
        });
    }

    $('#add-barang').on('click', addBarang);

    function deleteBarang(id) {
        $.ajax({
            url: '<?= base_url($link . '/delete_barang'); ?>',
            method: 'GET', // POST
            data: {
                id: id,
            },
            dataType: 'json', // json
            success: function(data) {
                if (data.error == true) {
                    alert('not found');
                } else {
                    listBarang();
                }
            }
        });
    }
</script>
<?= $this->endSection('script') ?>