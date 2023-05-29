<?= $this->extend('template/front/index') ?>


<?= $this->section('head') ?>
<style>
    .circle {
        width: 600px;
        height: 600px;
        background: #F25C05;
        /* -moz-border-radius: 70px; */
        /* -webkit-border-radius: 70px; */
        border-radius: 50%;
        position: absolute;
        z-index: -15;
        top: -110px;
        content: none;
        box-sizing: border-box;
        /* right: -180px; */
        /* overflow: hidden; */

        /* position: absolute;
            width: 1220px;
            height: 1220px;
            left: -547px;
            top: -99px;
            z-index: -10;
            border-radius: 50%;
            background: #F25C05; */
    }

    @media (max-width: 576px) {

        .circle {
            width: 700px;
            height: 660px;
            background: #F25C05;
            /* -moz-border-radius: 70px; */
            /* -webkit-border-radius: 70px; */
            border-radius: 50%;
            position: absolute;
            z-index: -15;
            top: -50px;
            right: -100px;
            /* content: ''; */
            /* overflow: hidden; */
        }

    }
</style>
<?= $this->endSection('head') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 col-lg-5  p-0 text-end  d-md-none d-lg-none" id="bg-vektor">
            <!-- <div class="circle"></div> -->
            <!-- <div class="position-relative" style="position: relative;">

                    <div style="overflow: hidden;">
                    </div>
                </div> -->
            <!-- <img src="vektor1.png" width="80%" class="p-5" alt=""> -->
            <img src="<?= base_url(); ?>assets/front/img/vektor1.png" class="vektor-register p-5" alt="" style="">
        </div>
        <div class="col-md-7 col-lg-7 ">
            <form action="<?= base_url('register'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row justify-content-center">
                    <div class="col-12">


                        <div class="row justify-content-center">
                            <div class="col-md-9 col-11">
                                <div class="row">
                                    <div class="col-8 mt-0 mt-lg-5">
                                        <h1 class="">Buat Akun</h1>
                                    </div>
                                </div>
                                <p class="mb-4">
                                    Silahkan Sign In untuk melanjutkan progres
                                </p>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="nama_lengkap" class="form-label">Nama
                                                        Lengkap</label>
                                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>" placeholder="Nama Lengkap">
                                                    <span class="text-danger"><?= validation_show_error('nama_lengkap'); ?></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="npm" class="form-label">NPM</label>
                                                    <input type="text" name="npm" class="form-control" id="npm" value="<?= old('npm'); ?>" placeholder="D1A2XXXXX">
                                                    <span class="text-danger"><?= validation_show_error('npm'); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-2">

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email" value="<?= old('email'); ?>" placeholder="email@gmail.com">
                                                    <span class="text-danger"><?= validation_show_error('email'); ?></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-2">

                                                <div class="mb-3">
                                                    <label for="no_hp" class="form-label">No HP</label>
                                                    <input type="text" name="no_hp" class="form-control" id="no_hp" value="<?= old('no_hp'); ?>" placeholder="082XXXCCCVVV">
                                                    <span class="text-danger"><?= validation_show_error('no_hp'); ?></span>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password">
                                                    <span class="text-danger"><?= validation_show_error('password'); ?></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <div class="mb-3">
                                                    <label for="password_retype" class="form-label">Password Retype</label>
                                                    <input type="password" class="form-control" id="password_retype" name="password_retype">
                                                    <span class="text-danger"><?= validation_show_error('password_retype'); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between">
                                            <div class="col text-start">
                                                <input type="checkbox">
                                                I accept the Terms & Conditions
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <button class="mt-4 btn w-100 btn-lg btn-login">SIGN UP</button>
                                                <p class="mt-3">Sudah mempunyai akun? <a href="<?= base_url('auth'); ?>" class="fw-bold">Login
                                                        disini</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-5 col-lg-5  p-0 text-end d-none d-md-block d-lg-block" id="bg-vektor">
            <!-- <div class="circle"></div> -->
            <!-- <div class="position-relative" style="position: relative;">

                    <div style="overflow: hidden;">
                    </div>
                </div> -->
            <!-- <img src="vektor1.png" width="80%" class="p-5" alt=""> -->
            <img src="<?= base_url(); ?>assets/front/img/vektor1.png" class="vektor-register p-5" alt="">
        </div>
    </div>

    <div class="row bg-black py-2">
        <div class="col-12 p-0">
            <p class="text-center py-3 mb-0 text-white">
                Sistem Informasi Layanan & Aset Fakultas Ilmu Komputer Universitas Subang <span class="sila">SILA</span> © All
                Rights
                Reserved. 2023
            </p>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>