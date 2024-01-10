<?= $this->extend('template/front/index') ?>

<?= $this->section('content') ?>
<section class="mt-0" id="sila-kami">
    <div class="container">
        <div class="row">
            <div class="col-md-6 pt-4 pt-md-0 d-flex flex-column align-items-center justify-content-center">
                <div>
                    <div class="row">
                        <div class="col-9 col-lg-12">
                            <h2 class="sila">Sistem Informasi Layanan
                                dan Aset</h2>
                        </div>
                    </div>

                    <p class="mb-4">
                        Selamat datang di Sistem Informasi Layanan & Aset
                        Fakultas Ilmu Komputer Universitas Subang.
                        Silahkan klik help desk untuk mengajukan laporan
                    </p>
                    <div class="row">
                        <div class="col-lg-4 col-5">
                            <a href="<?= base_url('helpdesk'); ?>" class="btn-login btn w-100">Help Desk</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?= base_url(); ?>assets/front/img/vektor2.png" width="100%" class="p-5" alt="">
            </div>
        </div>



    </div>
</section>

<section id="tentang-kami" class="text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-5 pt-3 pt-md-0  d-flex flex-column align-items-center justify-content-center">

                <div>
                    <h4 class="fw-bold">Sistem Informasi Layanan & Aset</h4>

                    <p class="mb-4 mt-4">
                        SILA adalah platform yang dirancang khusus untuk meningkatkan efisiensi dan efektivitas layanan di Fakultas Ilmu Komputer Universitas Subang. Dengan tiga fitur utama: Help Desk, Surat, dan Asset, SILA dirancang untuk menyediakan solusi terintegrasi bagi kebutuhan layanan dan manajemen aset.
                    </p>
                    <a href="<?= base_url('about'); ?>" class="fw-bold mt-4 position-relative text-white text-decoration-none">
                        <span class="p-0 me-1">Selengkapnya Tentang Kami </span>
                        <i class=" fs-5 bi bi-arrow-right position-absolute" style="top: -2px;"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-7 ">
                <div class="position-relative">

                    <img src="<?= base_url(); ?>assets/front/img/fasilkom.png" width="100%" class="p-5 blur" alt="">
                    <div class="position-absolute top-50 start-50 translate-middle">

                        <img class="w-100 w-md-100 mx-auto text-center" src="<?= base_url(); ?>assets/front/img/logo_horizontal.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="layanan">
    <div class="container">

        <div class="row pt-0 pt-lg-3">
            <div class="col-md-6 pt-2 pt-lg-2">
                <h2 class="sila">Informasi</h2>
                <p class="fw-bold">Layanan Kami</p>
            </div>
        </div>

    </div>
    <div class="container-fluid">
        <div class="row mb-4 justify-content-center">
            <div class="col-md-3 mb-2 text-center">
                <i class="bi bi-info-lg icon-cirle"></i>
                <div class="text-center">
                    <p class="fw-bold m-0 p-0 mt-3">HELDESK</p>
                    <p>
                        Layanan bantu Mahasiswa
                    </p>
                </div>
            </div>

            <div class="col-md-3 mb-2 text-center">
                <i class="bi bi-journal-text icon-cirle"></i>
                <div class="text-center">
                    <p class="fw-bold m-0 p-0 mt-3">ASSET</p>
                    <p>
                        Lihat dan Pinjam Asset FASILKOM, UNSUB
                    </p>
                </div>
            </div>

            <div class="col-md-3 mb-2 text-center">
                <i class="bi bi-envelope icon-cirle"></i>
                <div class="text-center">
                    <p class="fw-bold m-0 p-0 mt-3">SURAT</p>
                    <p>
                        Template Surat Mahasiswa
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>



<section class="bg-black" id="surat">

    <div class="container mb-4">

        <div class="row pt-0 pt-lg-3">
            <div class="col-md-6 pt-4 pt-lg-4">
                <h2 class="sila">Surat</h2>
                <p class="fw-bold text-white">kategori Surat</p>
            </div>
        </div>
    </div>

    <div class="container mb-3">

        <div class="row justify-content-center mb-3">
            <?php foreach ($kategori_surat as $d) : ?>

                <div class="col-md-3 col-lg-3 mb-4 col-6">
                    <div class="card">
                        <div class="card-body mb-2">
                            <img src="<?= base_url(); ?>assets/front/img/word.png" class="card-img-top" alt="...">
                            <p class="card-text"><?= $d['nama_kategori']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<section id="helpdesk" class="mt-4">
    <div class="container mb-4">

        <div class="row pt-0 pt-lg-3">
            <div class="col-md-6 pt-2 pt-lg-2">
                <h2 class="sila">LOG</h2>
                <p class="fw-bold">Review Help Desk</p>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <!-- Set up your HTML -->
            <div class="owl-carousel owl-theme col px-3 px-lg-0">
                <?php foreach ($helpdesk as $d) : ?>
                    <div class=" me-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-3 text-center mt-2">
                                        <img src="<?= base_url(); ?>assets/front/img/sila.png" alt="">
                                    </div>
                                    <div class="col-md-9 col-9">
                                        <?= makeStringAnonymous($d['nama_lengkap'], 1, 1); ?>
                                        <p>
                                            <?= date('H:i', strtotime($d['created_at'])); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($d['id_status'] == 1) : ?>
                                        <div class="col-md-7 col-12 text-center">

                                            <p style="font-size: 12px;" class=" bg-warning text-white rounded-pill px-1">
                                                <i class="bi bi-clock"></i> <?= $d['nama_status']; ?>
                                            </p>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-md-6 col-12 text-center">
                                            <p style="font-size: 12px;" class=" bg-success text-white rounded-pill px-1">
                                                <i class="bi bi-check2"></i> <?= $d['nama_status']; ?>
                                            </p>

                                        </div>
                                    <?php endif; ?>

                                </div>
                                <p>
                                    <?= makeStringAnonymous(cuplikKonten($d['deskripsi']), 1, 1); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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

        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 4,
            loop: true,
            // margin: 10,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    });
</script>
<?= $this->endSection('script') ?>