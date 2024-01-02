<?= $this->extend('template/index') ?>


<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Pinjam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Asset</li>
                    <li class="breadcrumb-item">Kelola Pinjam</li>
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
        <form action="<?= base_url($link . '/' . $data['id_pinjam']); ?>" method="post">
            <input type='hidden' name='_method' value='PUT' />
            <!-- GET, POST, PUT, PATCH, DELETE-->
            <div class="row">
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-header">
                            Edit Pinjam
                        </div>
                        <div class="card-body">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="kode_pinjam">Kode Pinjam</label>
                                <input type="text" readonly class="form-control" id="kode_pinjam" name="kode_pinjam" value="<?= $data['kode_pinjam']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tgl_pinjam">Tgl Pinjam</label>
                                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= $data['tgl_pinjam']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="jatuh_tempo">Jatuh Tempo</label>
                                <input type="date" class="form-control" id="jatuh_tempo" name="jatuh_tempo" value="<?= $data['jatuh_tempo']; ?>" required>
                            </div>





                        </div>
                    </div>


                </div>
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <textarea class="form-control" name="perihal" id="perihal" cols="30" rows="3"><?= $data['perihal']; ?></textarea>
                            </div>

                            <?php if ((session()->get('id_role') != 4) && (session()->get('id_role') != 3)) : ?>

                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="3"><?= $data['catatan']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="id_status">Status</label>
                                    <select name="id_status" id="id_status" class="form-control">
                                        <?php foreach ($status as $d) : ?>
                                            <?php if ($data['id_status'] == $d['id_status']) : ?>
                                                <option selected value="<?= $d['id_status']; ?>"><?= $d['nama_status']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $d['id_status']; ?>"><?= $d['nama_status']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php else : ?>
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
                            <?php endif; ?>




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
                        </div>
                    </div>

                    <?php if ((session()->get('id_role') != 4) && (session()->get('id_role') != 3)) : ?>

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
                                <p>List Item Barang</p>
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
                                    <tbody id="result-item-list"></tbody>
                                </table>
                                <hr>
                                <button type="submit" class="btn btn-primary ">Submit</button>
                                <a href="<?= base_url($link); ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

            </div>



        </form>
    </div>
</section>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script>
    <?php if ((session()->get('id_role') != 4) && (session()->get('id_role') != 3)) : ?>

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
                        listItemOrderBarang();
                    }
                }
            });
        }

        function AddOrderItemBarang(id_item) {
            var kode_pinjam = $('#kode_pinjam').val();
            var qty = $('#qty').val();
            $.ajax({
                url: '<?= base_url($link . '/add_order_item_barang'); ?>',
                method: 'GET', // POST
                data: {
                    kode_pinjam: kode_pinjam,
                    id_item: id_item,
                },
                dataType: 'json', // json
                success: function(data) {
                    if (data.error == true) {
                        alert('not found');
                    } else {
                        listItemOrderBarang();
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
                            list = list + `<tr>
                            <td>` + i + `</td>
                            <td>` + element.kode_item + `</td>
                            <td>` + element.nama_barang + `</td>
                            <td>` + element.nama_status + `</td>
                            <td class="d-flex flex-row"><button class="btn btn-sm ml-2 btn-danger " type="button" onclick="deleteOrderItemBarang(` + element.id + `)"><i class="fas fa-times"></i></button></td>
                        </tr>`;
                            i++;
                        }

                    }
                    $('#result-item-order').html(list);
                }
            });
        }

        listItemOrderBarang();


        function listItemBarang(id) {
            var id = id;
            $.ajax({
                url: '<?= base_url($link . '/list_item_barang'); ?>',
                method: 'GET', // POST
                data: {
                    id: id
                },
                dataType: 'json', // json
                success: function(data) {
                    var list = '';
                    if (data.error == true) {
                        alert('not found');
                    } else {
                        var i = 1;
                        for (let index = 0; index < data.data.length; index++) {
                            const element = data.data[index];
                            list = list + `<tr>
                            <td>` + i + `</td>
                            <td>` + element.kode_item + `</td>
                            <td>` + element.nama_barang + `</td>
                            <td>` + element.nama_status + `</td>
                            <td class="d-flex flex-row"><button class="btn btn-sm ml-2 btn-info " type="button" onclick="AddOrderItemBarang(` + element.id_item + `)"><i class="fas fa-caret-square-right"></i></button></td>
                        </tr>`;
                            i++;
                        }
                    }
                    $('#result-item-list').html(list);
                }
            });
        }
    <?php endif; ?>

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
                    <?php if ((session()->get('id_role') != 4) && (session()->get('id_role') != 3)) : ?>

                        var action = `<button class="btn btn-sm ml-2 btn-info " type="button" onclick="listItemBarang(` + element.id_barang + `)"><i class="fas fa-cart-plus"></i></button>`;
                    <?php else : ?>
                        var action = '';
                    <?php endif; ?>

                    <?php if ($data['id_status'] == 2) : ?>
                        action += `<button class="btn btn-sm ml-2 btn-danger mr-2" type="button" onclick="deleteBarang(` + element.id + `)"><i class="fas fa-times"></i></button>`;
                    <?php else : ?>
                        action += '-';
                    <?php endif; ?>
                    list = list + `<tr>
                        <td>` + i + `</td>
                        <td>` + element.nama_barang + `</td>
                        <td>` + element.qty + `</td>
                        <td class="d-flex flex-row">
                            ` + action + `
                        </td>
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
                    alert(data.message);
                } else {
                    listBarang();
                }
            }
        });
    }

    $('#add-barang').on('click', addBarang);

    <?php if ($data['id_status'] == 2) : ?>

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
    <?php endif; ?>
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