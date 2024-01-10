<?= $this->extend('template/front/index') ?>

<?= $this->section('content') ?>
<section class="mt-0 bg-sila" id="sila-kami">
    <div class="container text-white">
        <div class="row">
            <div class="col-md-6 pt-4 pt-md-0 d-flex flex-column align-items-center justify-content-center">
                <div>
                    <div class="row">
                        <div class="col-9 col-lg-9">
                            <h3 class="mb-2">Asset Fakultas Ilmu Komputer
                                Universitas Subang</h3>
                        </div>
                    </div>

                    <p class="mb-4 mt-2">
                        Selamat datang di halaman login untuk melihat dan meminjam asset kami!
                        Dengan sistem ini, Anda dapat dengan mudah menjelajahi katalog asset kami dan melakukan peminjaman dengan cepat dan efisien.
                    </p>
                    <div class="row">
                        <div class="col-lg-4 col-5">
                            <a href="<?= base_url('auth'); ?>" class="btn-outline-sila btn w-100">Pinjam Asset</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row pt-3 pb-3">
                    <div class="owl-carousel owl-theme col-6 px-3 px-lg-0">

                        <?php foreach ($kategori as $d) : ?>
                            <div class="me-3">

                                <div class="card mt-2 mb-2">
                                    <img src="<?= base_url('assets/front/img/asset_' . $d['id_kategori'] . '.png'); ?>" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $d['nama_kategori']; ?></h5>
                                        <p class="card-text">Jumlah : <?= $d['jumlah']; ?></p>
                                        <div class="mb-3 mt-0">
                                            <?php foreach ($d['barang'] as $b) : ?>

                                                <button type="button" class="btn btn-outline-login btn-sm "><?= $b['nama_barang']; ?></button>
                                            <?php endforeach; ?>
                                        </div>
                                        <a href="<?= base_url('auth'); ?>" class="fw-bold mt-4 position-relative text-sila text-decoration-none">
                                            <span class="p-0 me-1">Pinjam Asset </span>
                                            <i class=" fs-5 bi bi-arrow-right position-absolute" style="top: -2px;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>



    </div>
</section>






<?= $this->include('front/footer'); ?>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        // $(".owl-carousel").owlCarousel();

        var owlAsset = $('.owl-carousel');
        owlAsset.owlCarousel({
            items: 2,
            loop: true,
            // margin: 10,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: false
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 2,
                    nav: false
                }
            }
        });
    });
</script>
<?= $this->endSection('script') ?>