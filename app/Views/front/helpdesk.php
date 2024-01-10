<?= $this->extend('template/front/index') ?>

<?= $this->section('content') ?>
<section class="mt-0" id="sila-kami">
    <div class="container">
        <div class="row">
            <div class="col-md-6 pt-4 pt-md-0 d-flex flex-column align-items-center justify-content-center">
                <div>
                    <div class="row">
                        <div class="col-9 col-lg-12">
                            <h2 class="sila">Gabung Bersama Kami</h2>
                        </div>
                    </div>

                    <p class="mb-4">
                        Selamat datang di Layanan Helpdesk
                        Fakultas Ilmu Komputer, Universitas Subang.
                        Kami sangat senang Anda menghubungi kami untuk mendapatkan bantuan. Harap login akun Anda di bawah ini untuk mengakses layanan helpdesk kami:
                    </p>
                    <div class="row">
                        <div class="col-lg-4 col-5">
                            <a href="<?= base_url('auth'); ?>" class="btn-outline-login btn w-100">Sign in</a>
                        </div>
                        <div class="col-lg-4 col-5">
                            <a href="<?= base_url('register'); ?>" class="btn-login btn w-100">Sign Up</a>
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





<section id="helpdesk" class="mt-4 bg-sila">
    <div class="container mb-4">

        <div class="row pt-0 pt-lg-3">
            <div class="col-md-6 pt-2 pt-lg-2">
                <h5 class="fw-bold text-white">Log Help desk</h5>
            </div>
        </div>
    </div>

    <div class="container pb-4">
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