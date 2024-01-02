<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Pinjam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Asset</li>
                    <li class="breadcrumb-item">Kelola Pinjam</li>
                    <li class="breadcrumb-item active">Detail</li>
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
        <form action="<?= ($data['id_status'] == 3) ?  base_url($link . '/return/' . $data['id_pinjam']) : ''; ?>" method="post">
            <input type='hidden' name='_method' value='PUT' />
            <!-- GET, POST, PUT, PATCH, DELETE-->
            <div class="row">
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-header">
                            Detail Pinjam
                        </div>
                        <div class="card-body">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="kode_pinjam">Kode Pinjam</label>
                                <input type="text" readonly class="form-control" id="kode_pinjam" name="kode_pinjam" value="<?= $data['kode_pinjam']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tgl_pinjam">Tgl Pinjam</label>
                                <input type="date" class="form-control" readonly id="tgl_pinjam" name="tgl_pinjam" value="<?= $data['tgl_pinjam']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="jatuh_tempo">Jatuh Tempo</label>
                                <input type="date" class="form-control" readonly id="jatuh_tempo" name="jatuh_tempo" value="<?= $data['jatuh_tempo']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tgl_kembali">Tgl Kembali</label>
                                <input type="date" class="form-control" readonly id="tgl_kembali" name="tgl_kembali" value="<?= $data['tgl_kembali']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <textarea class="form-control" readonly name="perihal" id="perihal" cols="30" rows="3"><?= $data['perihal']; ?></textarea>
                            </div>


                        </div>
                    </div>


                </div>
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-body">


                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control" name="catatan" <?= ($data['id_status'] == 4) ? 'readonly' : ''; ?> id="catatan" cols="30" rows="5"><?= $data['catatan']; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="id_status">Status</label>
                                <select name="id_status" id="id_status" disabled class="form-control">
                                    <?php foreach ($status as $d) : ?>
                                        <?php if ($data['id_status'] == $d['id_status']) : ?>
                                            <option selected value="<?= $d['id_status']; ?>"><?= $d['nama_status']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $d['id_status']; ?>"><?= $d['nama_status']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>




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
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <p>List Item Pinjam</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Item</th>
                                        <th>Nama Barang</th>
                                        <th>Nama Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="result-item-order"></tbody>
                            </table>
                            <hr>
                            <p>List Item Kembali</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Item</th>
                                        <th>Nama Barang</th>
                                        <th>Nama Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="result-item-return"></tbody>
                            </table>
                            <hr>
                            <?php if ($data['id_status'] == 3) : ?>
                                <button type="submit" class="btn btn-primary ">Return Barang</button>
                            <?php endif; ?>
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
    var id_status_active = <?= $data['id_status']; ?>;

    function deleteOrderItemBarang(id) {
        $.ajax({
            url: '<?= base_url($link . '/delete_order_item_barang'); ?>',
            method: 'GET', // POST
            data: {
                id: id,
            },
            dataType: 'json', // json
            success: function(data) {
                if (data.error == true) {
                    alert('not found');
                } else {
                    listReturnItemOrderBarang();
                }
            }
        });
    }

    function listItemOrderBarang() {
        var kode_pinjam = $('#kode_pinjam').val();
        $.ajax({
            url: '<?= base_url($link . '/list_item_order_barang'); ?>',
            method: 'GET', // POST
            data: {
                kode_pinjam: kode_pinjam,
                id_status: 1 // pinjam
            },
            dataType: 'json', // json
            success: function(data) {
                var list = '';
                if (data.error == true) {
                    // alert('not found');
                } else {
                    // var list = '';
                    var i = 1;
                    for (let index = 0; index < data.data.length; index++) {
                        const element = data.data[index];
                        var action = `<button class="btn btn-sm ml-2 btn-success " type="button"       title="Kembali" onclick="returnOrderItemBarang(` + element.id + `, <?= $status_id['kembali']; ?>)"><i class="fas fa-undo-alt"></i></button>
                                <button class="btn btn-sm ml-2 btn-warning " type="button" title="Rusak" onclick="returnOrderItemBarang(` + element.id + `, <?= $status_id['rusak']; ?>)"><i class="fas fa-unlink"></i></button>
                                <button class="btn btn-sm ml-2 btn-danger " type="button" title="Hilang" onclick="returnOrderItemBarang(` + element.id + `, <?= $status_id['hilang']; ?>)"><i class="fas fa-question"></i></i></button>`;
                        if (id_status_active == 4) {
                            action = '-';
                        }
                        list = list + `<tr>
                            <td>` + i + `</td>
                            <td>` + element.kode_item + `</td>
                            <td>` + element.nama_barang + `</td>
                            <td>` + element.nama_status + `</td>
                            <td class="d-flex flex-row">
                               ` + action + `
                            </td>
                        </tr>`;
                        i++;
                    }

                }
                $('#result-item-order').html(list);
            }
        });
    }

    listItemOrderBarang();

    function returnOrderItemBarang(id, id_status) {
        $.ajax({
            url: '<?= base_url($link . '/return_order_item_barang'); ?>',
            method: 'GET', // POST
            data: {
                id: id,
                id_status: id_status,
            },
            dataType: 'json', // json
            success: function(data) {
                if (data.error == true) {
                    alert('not found');
                } else {
                    listReturnItemOrderBarang();
                }
            }
        });
    }

    function listReturnItemOrderBarang() {
        var kode_pinjam = $('#kode_pinjam').val();
        $.ajax({
            url: '<?= base_url($link . '/list_item_order_barang'); ?>',
            method: 'GET', // POST
            data: {
                kode_pinjam: kode_pinjam,
                id_status: 0 // kembali
            },
            dataType: 'json', // json
            success: function(data) {
                var list = '';
                if (data.error == true) {
                    // alert('not found');
                } else {
                    // var list = '';
                    var i = 1;
                    for (let index = 0; index < data.data.length; index++) {
                        const element = data.data[index];
                        var action = `<button class="btn btn-sm ml-2 btn-danger " type="button" title="Hilang" onclick="deleteOrderItemBarang(` + element.id + `)"><i class="fas fa-times"></i></button>`;
                        <?php if (session()->get('id_role') == 4) : ?>
                        <?php endif; ?>
                        if (id_status_active == 4) {
                            action = '-';
                        }

                        list = list + `<tr>
                            <td>` + i + `</td>
                            <td>` + element.kode_item + `</td>
                            <td>` + element.nama_barang + `</td>
                            <td>` + element.nama_status + `</td>
                            <td class="d-flex flex-row">
                                ` + action + `
                            </td>
                        </tr>`;
                        i++;
                    }

                }
                $('#result-item-return').html(list);
            }
        });
    }

    listReturnItemOrderBarang();


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
                        <td class="d-flex flex-row">-</td>
                    </tr>`;
                    i++;
                }
                $('#result').html(list);
            }
        });
    }

    listBarang();
</script>

<script>
    var table = $('.table').DataTable({
        responsive: true,
        // "dom": 'Bflrtip',
        // buttons: [
        //     'copy', 'excel', 'pdf'
        // ],
        "pageLength": 5,
        "lengthMenu": [
            [5, 100, 1000, -1],
            [5, 100, 1000, "ALL"],
        ],

    })
</script>
<?= $this->endSection('script') ?>