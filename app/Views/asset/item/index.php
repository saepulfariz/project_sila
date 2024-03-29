<?= $this->extend('template/index') ?>




<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kelola Item</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Assets</li>
          <li class="breadcrumb-item">Kelola Item</li>
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
      <div class="col-12">
        <a href="<?= base_url($link . '/new'); ?>" class="btn btn-primary btn-sm mb-2">New</a>
        <div class="card">
          <div class="card-header">
            Kelola Item
          </div>
          <div class="card-body">
            <table class="table" id="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Item</th>
                  <th>Nama Barang</th>
                  <th>Nama Kategori</th>
                  <th>Nama Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 1;
                foreach ($data as $d) : ?>
                  <tr>
                    <td><?= $a++; ?></td>
                    <td><?= $d['kode_item']; ?></td>
                    <td><?= $d['nama_barang']; ?></td>
                    <td><?= $d['nama_kategori']; ?></td>
                    <td><?= $d['nama_status']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


  </div>
</section>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script>
  var table = $('#table').DataTable({
    responsive: true,
    "dom": 'Bflrtip',
    buttons: [
      'copy', 'excel', 'pdf'
    ],
    "pageLength": 5,
    "lengthMenu": [
      [5, 100, 1000, -1],
      [5, 100, 1000, "ALL"],
    ],

  })
</script>
<?= $this->endSection('script') ?>