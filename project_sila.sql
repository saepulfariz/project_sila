-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2023 pada 12.05
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_sila`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-04-13-064958', 'App\\Database\\Migrations\\TbRole', 'default', 'App', 1686000764, 1),
(2, '2023-04-13-065341', 'App\\Database\\Migrations\\TbUser', 'default', 'App', 1686000764, 1),
(3, '2023-04-13-065744', 'App\\Database\\Migrations\\TbStatus', 'default', 'App', 1686000764, 1),
(4, '2023-04-13-065752', 'App\\Database\\Migrations\\TbHelpdeskKategori', 'default', 'App', 1686000764, 1),
(5, '2023-04-13-070116', 'App\\Database\\Migrations\\TbHelpdesk', 'default', 'App', 1686000764, 1),
(6, '2023-04-13-070550', 'App\\Database\\Migrations\\TbSuratKategori', 'default', 'App', 1686000764, 1),
(7, '2023-04-13-070755', 'App\\Database\\Migrations\\TbSurat', 'default', 'App', 1686000764, 1),
(8, '2023-05-31-054849', 'App\\Database\\Migrations\\TbSuratHistory', 'default', 'App', 1686000764, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_helpdesk`
--

CREATE TABLE `tb_helpdesk` (
  `id_helpdesk` int(11) UNSIGNED NOT NULL,
  `deskripsi` text NOT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `catatan` text NOT NULL,
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `id_status` int(11) UNSIGNED NOT NULL,
  `cid` int(11) UNSIGNED DEFAULT NULL,
  `uid` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_helpdesk`
--

INSERT INTO `tb_helpdesk` (`id_helpdesk`, `deskripsi`, `nama_dosen`, `gambar`, `catatan`, `id_kategori`, `id_status`, `cid`, `uid`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '', '', '', 2, 2, 1, 1, '2023-06-08 12:40:15', '2023-06-08 20:30:52'),
(2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '', '', '', 2, 1, 1, NULL, '2023-06-07 12:40:15', '2023-06-08 12:40:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_helpdesk_kategori`
--

CREATE TABLE `tb_helpdesk_kategori` (
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_helpdesk_kategori`
--

INSERT INTO `tb_helpdesk_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Fasilitas'),
(2, 'Pelayanan BAAK'),
(3, 'Dosen'),
(4, 'Perkuliahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) UNSIGNED NOT NULL,
  `nama_role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `nama_role`) VALUES
(1, 'admin'),
(2, 'staff'),
(3, 'pimpinan'),
(4, 'mahasiswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_status`
--

CREATE TABLE `tb_status` (
  `id_status` int(11) UNSIGNED NOT NULL,
  `nama_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `nama_status`) VALUES
(1, 'Pending'),
(2, 'Done'),
(3, 'Reject');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_surat`
--

CREATE TABLE `tb_surat` (
  `id_surat` int(11) UNSIGNED NOT NULL,
  `nama_surat` varchar(128) NOT NULL,
  `no_surat` varchar(128) NOT NULL,
  `perihal` text DEFAULT NULL,
  `catatan` text NOT NULL,
  `kepada` varchar(128) DEFAULT NULL,
  `file_surat` varchar(128) NOT NULL,
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `id_status` int(11) UNSIGNED NOT NULL,
  `cid` int(11) UNSIGNED DEFAULT NULL,
  `uid` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_surat`
--

INSERT INTO `tb_surat` (`id_surat`, `nama_surat`, `no_surat`, `perihal`, `catatan`, `kepada`, `file_surat`, `id_kategori`, `id_status`, `cid`, `uid`, `created_at`, `updated_at`) VALUES
(1, 'test', '7899', 'jsjs', '', 'jsksk', '1686231869_33a66e9a40ab5e4244ec.png', 6, 2, 1, 1, '2023-06-08 17:31:46', '2023-06-08 20:44:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_surat_history`
--

CREATE TABLE `tb_surat_history` (
  `id_history` int(11) UNSIGNED NOT NULL,
  `id_surat` int(11) UNSIGNED NOT NULL,
  `nama_surat` varchar(128) NOT NULL,
  `no_surat` varchar(128) NOT NULL,
  `perihal` text DEFAULT NULL,
  `catatan` text NOT NULL,
  `kepada` varchar(128) DEFAULT NULL,
  `file_surat` varchar(128) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_surat_history`
--

INSERT INTO `tb_surat_history` (`id_history`, `id_surat`, `nama_surat`, `no_surat`, `perihal`, `catatan`, `kepada`, `file_surat`, `id_kategori`, `id_status`, `cid`, `uid`, `created_at`, `updated_at`) VALUES
(1, 1, '', '', 'jsjs', '', 'jsksk', '', 6, 1, 1, NULL, '2023-06-08 17:31:46', '2023-06-08 17:31:46'),
(2, 1, 'test', '7899', 'jsjs', '', 'jsksk', '1686231869_33a66e9a40ab5e4244ec.png', 6, 2, 1, 1, '2023-06-08 20:44:30', '2023-06-08 20:44:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_surat_kategori`
--

CREATE TABLE `tb_surat_kategori` (
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `is_out` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_surat_kategori`
--

INSERT INTO `tb_surat_kategori` (`id_kategori`, `nama_kategori`, `is_out`) VALUES
(1, 'SK', 0),
(2, 'Undangan', 0),
(3, 'Permohonan', 0),
(4, 'Pengajuan', 0),
(5, 'Dokumen Lainnya', 0),
(6, 'Surat Pengantar PKL', 1),
(7, 'Surat Pengantar Magang', 1),
(8, 'Surat Pengantar Nilai', 1),
(9, 'Surat Pengantar Penelitian Skripsi', 1),
(10, 'Surat Pengantar Observasi Tugas', 1),
(11, 'Surat Pengantar Observasi Tugas', 1),
(12, 'Surat SKMK Biasa', 1),
(13, 'Surat SKMK PNS', 1),
(14, 'Surat Perbaikan Absensi', 1),
(15, 'Surat Pengantar Perbaikan Nilai UTS', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `npm` varchar(20) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `id_role` int(11) UNSIGNED NOT NULL,
  `is_active` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `email`, `username`, `password`, `npm`, `nama_lengkap`, `no_hp`, `id_role`, `is_active`, `cid`, `uid`, `created_at`, `updated_at`) VALUES
(1, 'admin@mail.com', 'admin', '$2y$10$5fAlRyUVz/OhHmMDM.Mzhe5mdi0KGS.BMwi0aRWf.0wJhrvIV.h52', 'admin', 'administrator', '082216501151', 1, 1, 1, 1, '2023-04-13 14:15:00', '2023-04-13 14:15:00'),
(2, 'staffn@mail.com', 'staff', '$2y$10$s6/vwjoC/7Z4ucqYM.4l9O3ffUT3dxq.HBV60o6N4MSnL1sgzu2by', 'staff', 'staff', '082216501151', 2, 1, 1, 1, '2023-04-13 14:15:00', '2023-04-13 14:15:00'),
(3, 'pimpinan@mail.com', 'pimpinan', '$2y$10$8ifDcHnpvaonUzCD.4gDqeONNH4Kl00nzj8mVOzHGiMZZlnLtDZOq', 'pimpinan', 'pimpinan', '082216501151', 3, 1, 1, 1, '2023-04-13 14:15:00', '2023-04-13 14:15:00'),
(4, 'penni@mail.com', 'penni', '$2y$10$7TaLqbKwD2TIqwPRQ/HuXurpXWKBMIWPiK/3zjYz1O22TL5KMdd2e', 'D1A20401', 'penni', '082216501151', 4, 1, 1, 1, '2023-04-13 14:15:00', '2023-04-13 14:15:00'),
(5, 'illham@mail.com', 'ilham', '$2y$10$fDNiKy23qLw3tsnaLM8.m.SNY9t0VwM./mZYXdqbGB0jdNPCqyrFa', 'D1A200029', 'ilham', '0822165011511', 4, 1, 1, 1, '2023-04-13 14:15:00', '2023-04-13 14:15:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_helpdesk`
--
ALTER TABLE `tb_helpdesk`
  ADD PRIMARY KEY (`id_helpdesk`),
  ADD KEY `tb_helpdesk_id_kategori_foreign` (`id_kategori`),
  ADD KEY `tb_helpdesk_id_status_foreign` (`id_status`),
  ADD KEY `tb_helpdesk_cid_foreign` (`cid`),
  ADD KEY `tb_helpdesk_uid_foreign` (`uid`);

--
-- Indeks untuk tabel `tb_helpdesk_kategori`
--
ALTER TABLE `tb_helpdesk_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `tb_surat_id_kategori_foreign` (`id_kategori`),
  ADD KEY `tb_surat_id_status_foreign` (`id_status`),
  ADD KEY `tb_surat_cid_foreign` (`cid`),
  ADD KEY `tb_surat_uid_foreign` (`uid`);

--
-- Indeks untuk tabel `tb_surat_history`
--
ALTER TABLE `tb_surat_history`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `tb_surat_history_id_surat_foreign` (`id_surat`);

--
-- Indeks untuk tabel `tb_surat_kategori`
--
ALTER TABLE `tb_surat_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `npm` (`npm`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `tb_user_id_role_foreign` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_helpdesk`
--
ALTER TABLE `tb_helpdesk`
  MODIFY `id_helpdesk` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_helpdesk_kategori`
--
ALTER TABLE `tb_helpdesk_kategori`
  MODIFY `id_kategori` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id_status` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_surat`
--
ALTER TABLE `tb_surat`
  MODIFY `id_surat` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_surat_history`
--
ALTER TABLE `tb_surat_history`
  MODIFY `id_history` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_surat_kategori`
--
ALTER TABLE `tb_surat_kategori`
  MODIFY `id_kategori` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_helpdesk`
--
ALTER TABLE `tb_helpdesk`
  ADD CONSTRAINT `tb_helpdesk_cid_foreign` FOREIGN KEY (`cid`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_helpdesk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `tb_helpdesk_kategori` (`id_kategori`),
  ADD CONSTRAINT `tb_helpdesk_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id_status`),
  ADD CONSTRAINT `tb_helpdesk_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD CONSTRAINT `tb_surat_cid_foreign` FOREIGN KEY (`cid`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_surat_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `tb_surat_kategori` (`id_kategori`),
  ADD CONSTRAINT `tb_surat_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id_status`),
  ADD CONSTRAINT `tb_surat_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_surat_history`
--
ALTER TABLE `tb_surat_history`
  ADD CONSTRAINT `tb_surat_history_id_surat_foreign` FOREIGN KEY (`id_surat`) REFERENCES `tb_surat` (`id_surat`);

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
