<?= $this->extend('template/front/index') ?>

<?= $this->section('content') ?>
<section class="mt-0" id="sila-kami">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 text-center mt-3">
                <img class="mx-auto" width="300" src="<?= base_url('assets/front/img/logo.png'); ?>" alt="">
                <p class="mt-4">
                    Selamat datang di Sistem Informasi Layanan dan Asset (SILA) Fakultas Ilmu Komputer Universitas Subang!
                    SILA merupakan proyek independent yang dibuat dengan penuh dedikasi oleh kelompok yang terdiri dari Ilham Samsul Arifin, Saepul Hidayat, Maulana Hilman Mustofa, Diky Rihan Fauzan, dan Penni Seftiani pada tahun 2023.
                </p>
                <p class="text-sila mt-2 fw-bold mb-1">Tentang SILA</p>
                <p>SILA adalah platform yang dirancang khusus untuk meningkatkan efisiensi dan efektivitas layanan di Fakultas Ilmu Komputer Universitas Subang. Dengan tiga fitur utama: Help Desk, Surat, dan Asset, SILA dirancang untuk menyediakan solusi terintegrasi bagi kebutuhan layanan dan manajemen aset.
                </p>

                <p class="text-sila mt-2 fw-bold mb-1">Fitur Utama SILA</p>

                <p class="m-1 fw-bold">1. Helpdesk</p>
                <p class="m-1">Deskripsi: Fitur ini memungkinkan pengguna untuk mengajukan pertanyaan, melaporkan masalah, atau meminta bantuan terkait berbagai aspek yang berkaitan dengan Fakultas Ilmu Komputer.</p>
                <p class="m-1">Keuntungan:</p>
                <p class="m-1">- Respon cepat dari tim dukungan.</p>
                <p class="m-1">- Pelacakan status permintaan layanan.</p>
                <p class="m-1">- Dokumentasi riwayat permasalahan.</p>


                <p class="m-1 fw-bold">2. Surat</p>
                <p class="m-1"> Deskripsi: Fitur ini memfasilitasi manajemen surat-menyurat di Fakultas Ilmu Komputer, termasuk penyimpanan aman dan pencarian cepat.</p>
                <p class="m-1">Keuntungan:</p>
                <p class="m-1">- Pengarsipan surat elektronik dan fisik.</p>
                <p class="m-1">- Akses mudah dan cepat.</p>
                <p class="m-1">- Penyaringan berdasarkan kategori.</p>


                <p class="m-1 fw-bold">3. Asset</p>
                <p class="m-1">Deskripsi: Mengelola inventaris dan aset milik Fakultas Ilmu Komputer, mencakup perolehan, pemeliharaan, dan penghapusan.</p>
                <p class="m-1">Keuntungan:</p>
                <p class="m-1">- Pemantauan status dan keberadaan aset.</p>
                <p class="m-1">- Pemberitahuan pemeliharaan dan pembaruan.</p>
                <p class="m-1">- Pelacakan riwayat perubahan aset.</p>


                <p class="text-sila mt-3 fw-bold mb-1">Cara Mengakses SILA</p>
                <p>Silakan kunjungi halaman <b>LOGIN/SIGN IN</b> dengan akun yang telah diberikan kepada pengguna terdaftar. Dengan menggunakan SILA, diharapkan akan lebih mudah bagi seluruh komunitas Fakultas Ilmu Komputer untuk berinteraksi dan mengelola informasi dengan lebih efisien.</p>

                <p class="text-sila mt-2 fw-bold mb-1">Tim Pengembang SILA</p>
                <p class="m-1">- Ilham Samsul Arifin</p>
                <p class="m-1">- Saepul Hidayat</p>
                <p class="m-1">- Maulana Hilman Mustofa</p>
                <p class="m-1">- Diky Rihan Fauzan</p>
                <p class="m-1">- Penni Seftiani</p>

                <p class="text-sila mt-3 fw-bold mb-1">Kontak Dukungan</p>
                <p>Jika Anda mengalami masalah atau membutuhkan bantuan lebih lanjut, silakan hubungi tim dukungan kami melalui email di <b>fasilkom@unsub.ac.id</b> atau nomor telepon <b>081312436643 / 081214086626.</b></p>


                <p class="mt-2">SILA - Meningkatkan Layanan, Mengoptimalkan Aset, dan Menyatukan Komunitas Fakultas Ilmu Komputer Universitas Subang. Terima kasih atas partisipasi dan dukungan Anda!</p>
            </div>
        </div>



    </div>
</section>





<?= $this->include('front/footer'); ?>
<?= $this->endSection('content') ?>