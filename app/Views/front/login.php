<?= $this->extend('template/front/index') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <!-- <div class="col-md-5 mb-5 pt-5 mb-md-0 pt-md-0">
                <div class="circle"></div>
                <img src="vektor.png" width="100%" class="p-5" alt="">
            </div> -->
        <div class="col-md-5 col-lg-5  p-0 text-start " id="bg-vektor">
            <!-- <div class="circle"></div> -->
            <!-- <div class="position-relative" style="position: relative;">

                    <div style="overflow: hidden;">
                    </div>
                </div> -->
            <!-- <img src="vektor1.png" width="80%" class="p-5" alt=""> -->
            <img src="<?= base_url(); ?>assets/front/img/vektor.png" class="p-5 vektor-login" width="100%" alt="" style="">
        </div>
        <div class="col-md-7 mt-5 mt-md-0">
            <div class="row justify-content-center">
                <div class="col-12">


                    <div class="row justify-content-center">
                        <div class="col-lg-9 col-11">
                            <div class="row">
                                <div class="col-8 mt-0 mt-lg-4">
                                    <h1 class="">Selamat Datang Kembali</h1>
                                </div>
                            </div>
                            <p class="mb-4">
                                Silahkan Sign In untuk melanjutkan progres
                            </p>
                            <form action="<?= base_url(); ?>auth/proses_login" method="post">

                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email/Username</label>
                                            <input type="text" name="username" class="form-control" id="username">
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password">
                                        </div>

                                        <div class=" row justify-content-between">
                                            <div class="col text-start">
                                                <input type="checkbox">
                                                Simpan info saya
                                            </div>
                                            <div class="col text-end fw-bold" id="lupa-wae">
                                                Lupa password?
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" class="mt-4 btn w-100 btn-lg btn-login">SIGN IN</button>
                                                <p class="mt-3">Belum mempunyai akun? <a href="<?= base_url('register'); ?>" class="fw-bold">Daftar
                                                        disini</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('front/copyright'); ?>

</div>
<?= $this->endSection('content') ?>