<footer class="bg-black" id="about">
  <div class="container py-5">
    <div class="row mb-4">
      <div class="col">
        <h1 style="font-size: 32px;" class="sila">SILA</h1>
      </div>
    </div>
    <div class="row text-white">
      <div class="col-md-4 mb-2">
        <h4 class="mb-3">Tentang Kami</h4>
        <p class="">
          Sistem Informasi layanan & Aset (SILA)
          adalah sebuah website layanan mahasiswa
          Fakultas Ilmu Komputer, Universitas Subang
        </p>

        <a href="<?= base_url('about'); ?>" class="fw-bold mt-4 position-relative text-white text-decoration-none">
          <span class="p-0 me-1">Selengkapnya </span>
          <i class="sila fs-5 bi bi-arrow-right position-absolute" style="top: -2px;"></i>
        </a>
        <hr class="d-lg-none d-md-none border-2 border-white">
      </div>
      <div class="col-md-2 mb-2">
        <h4 class="mb-3">Pages</h4>
        <ul>
          <li><a class="text-decoration-none text-white" href="<?= base_url(); ?>">Home</a></li>
          <li><a class="text-decoration-none text-white" href="<?= base_url('helpdesk'); ?>">Help Desk</a></li>
          <li><a class="text-decoration-none text-white" href="<?= base_url('asset'); ?>">Asset</a></li>
          <li><a class="text-decoration-none text-white" href="<?= base_url('about'); ?>">About</a></li>
        </ul>
        <hr class="d-lg-none d-md-none border-2 border-white">
      </div>

      <div class="col-md-3 mb-2">
        <h4 class="mb-3">Contact</h4>
        <ul>
          <li><i class="bi bi-telephone-fill"></i> 081312436643/081214086626</li>
          <li><i class="bi bi-envelope-fill"></i> fasilkom@unsub.ac.id</li>
          <li><i class="bi bi-geo-alt-fill"></i> Pasirkareumbi, Kec. Subang. Kabupaten Subang. Jawa Barat 41285 </li>

        </ul>
        <hr class="d-lg-none d-md-none border-2 border-white">
      </div>

      <div class="col-md-3 mb-2">
        <h3 class="mb-5">Gabung Bersama
          Kami</h3>
        <div class="row mt-3">
          <div class="col">
            <a href="<?= base_url('auth'); ?>" class="btn w-100 rounded-pill btn-outline-light"><i class="bi bi-key-fill"></i> Sign in</a>
          </div>

          <div class="col">
            <a href="<?= base_url('register'); ?>" class="btn w-100 rounded-pill btn-light">
              <i class="bi bi-box-arrow-in-left"></i>
              Sign Up
            </a>
          </div>
        </div>
        <hr class="d-lg-none d-md-none border-2 border-white">
      </div>
    </div>
  </div>
  <div class="container-fluid">

    <?= $this->include('front/copyright'); ?>
  </div>
</footer>