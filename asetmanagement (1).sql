-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2023 pada 00.42
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asetmanagement`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_aset` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_aset` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `karyawan_id` int(10) UNSIGNED NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_aset` int(11) NOT NULL,
  `spesifikasi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garansi` date DEFAULT NULL,
  `tgl_beli` date DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `toko_beli` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`id`, `kode_aset`, `nama_aset`, `kategori_id`, `karyawan_id`, `merk`, `jumlah_aset`, `spesifikasi`, `garansi`, `tgl_beli`, `harga_beli`, `toko_beli`, `alamat`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'ASET00001', 'asdsadsad', 2, 0, 'asdsad', 0, 'adsadsad', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-27 17:07:08', '2022-11-27 17:41:52'),
(2, 'ASET00002', 'sadasd', 2, 5, 'sadsadsa', 2, 'sadsadsa', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-27 17:12:18', '2022-11-27 17:28:23'),
(3, 'ASET00003', 'Router XEG 1407 THIW', 2, 0, 'Lenovo', 1, 'RAM 12GB assssssssssssssssssssssssssss ssssssssssssssssssssssssssssssssssssassssssss sssssssssssssssssssssssssssssssasssssss', '2023-11-21', '2022-12-30', 2000000, 'Hasmikroasssssssssssssssssssssssssssssssssssssssssss', 'Jl. Rancabolang No. 29 Manjahlega, Kec. Rancasari Kota Bandung, 40286, Jawa Barat, Indonesia', NULL, '2022-11-27 17:47:12', '2022-12-02 07:30:26'),
(4, 'ASET00004', 'sasdasdsadsadsa', 2, 0, 'adasddad', 5, 'adasdsadsa', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 16:14:03', '2022-12-03 03:06:59'),
(5, 'ASET00005', 'Lenovo X1Gk', 2, 0, 'Lenovo', 3, 'kjkjhkjk', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 18:55:31', '2022-12-08 13:11:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `asetac`
--

CREATE TABLE `asetac` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_aset` varchar(255) NOT NULL,
  `nama_kendaraan` varchar(255) NOT NULL,
  `nopol` varchar(11) NOT NULL,
  `masaberlaku_stnk` date NOT NULL,
  `status_kendaraan` int(11) NOT NULL,
  `karyawan_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `asetac`
--

INSERT INTO `asetac` (`id`, `kode_aset`, `nama_kendaraan`, `nopol`, `masaberlaku_stnk`, `status_kendaraan`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(6, 'ATC00001', 'Avanza T1G', 'D 2910 ABC', '2022-11-28', 1, 0, '2022-11-28 12:32:30', '2022-11-28 12:38:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_history` date NOT NULL,
  `aset_id` int(10) UNSIGNED NOT NULL,
  `tindakan` text NOT NULL,
  `karyawan_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`id`, `tgl_history`, `aset_id`, `tindakan`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(1, '2022-11-28', 1, 'contoh', 5, '2022-11-27 17:31:20', '2022-11-27 17:31:30'),
(2, '2022-11-28', 3, 'asdsadsa', 5, '2022-11-28 15:35:52', '2022-11-28 15:35:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nik` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `user_id`, `nik`, `nama`, `jk`, `jabatan`, `created_at`, `updated_at`) VALUES
(0, 1, '-', '-', '', '-', NULL, NULL),
(5, 1, 'X0000100', 'Karyawan1', 'L', 'Finance', '2022-11-04 05:51:13', '2022-11-04 06:02:43'),
(6, 1, 'D9992229', 'Contoh3', 'L', 'Accounting', '2022-11-09 19:16:25', '2022-11-27 09:04:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(2, 'Kendaraan', '2022-11-11 01:21:39', '2022-11-11 01:21:39'),
(6, 'Elektronik', '2022-12-01 14:27:15', '2022-12-01 14:27:15'),
(7, 'Contoh', '2022-12-01 14:27:48', '2022-12-01 14:27:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_11_03_131946_create_users_table', 1),
(2, '2022_11_03_132120_create_karyawans_table', 1),
(3, '2022_11_03_132156_create_transaksis_table', 1),
(4, '2022_11_03_132236_create_asets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeliharaan`
--

CREATE TABLE `pemeliharaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_pemeliharaan` varchar(255) NOT NULL,
  `aset_id` int(10) UNSIGNED NOT NULL,
  `keterangan` text DEFAULT NULL,
  `biaya` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `yang_mengajukan` varchar(255) DEFAULT NULL,
  `keputusan_oleh` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemeliharaan`
--

INSERT INTO `pemeliharaan` (`id`, `kode_pemeliharaan`, `aset_id`, `keterangan`, `biaya`, `status`, `yang_mengajukan`, `keputusan_oleh`, `gambar`, `created_at`, `updated_at`) VALUES
(16, 'PMH-AST-00001', 5, 'Pengajuan ini dalam rangka xxxxxxxxxxxxxxxxxxxxxxx', 200000, 2, 'User IT Example', NULL, NULL, '2022-12-06 04:14:53', '2022-12-08 02:49:52'),
(17, 'PMH-AST-00017', 5, 'Pengajuan contoh ke 2 ini dalam rangka XXXXXX', 200000, 1, 'User IT Example', NULL, NULL, '2022-12-08 13:11:08', '2022-12-08 13:11:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supir`
--

CREATE TABLE `supir` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_supir` varchar(255) NOT NULL,
  `nama_supir` varchar(255) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `status_supir` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supir`
--

INSERT INTO `supir` (`id`, `kode_supir`, `nama_supir`, `kontak`, `status_supir`, `created_at`, `updated_at`) VALUES
(1, 'SPR00001', 'Supir XX', '0895412366969', 1, '2022-11-28 04:32:23', '2022-11-28 12:38:11'),
(2, 'SPR00002', 'sadasdasdsadadadasd', '0895403800000', 1, '2022-11-28 05:28:55', '2022-11-28 11:58:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `karyawan_id` int(10) UNSIGNED NOT NULL,
  `aset_id` int(10) UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` enum('pinjam','kembali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `karyawan_id`, `aset_id`, `tgl_pinjam`, `tgl_kembali`, `status`, `ket`, `created_at`, `updated_at`) VALUES
(1, 'PM00001', 5, 1, '2022-11-28', NULL, 'kembali', 'asadsa', '2022-11-27 17:33:36', '2022-11-27 17:36:58'),
(2, 'PM00002', 6, 1, '2022-11-28', NULL, 'kembali', 'sadsadsa', '2022-11-27 17:37:52', '2022-11-27 17:38:35'),
(3, 'PM00003', 5, 1, '2022-11-28', NULL, 'pinjam', 'asdsadsad', '2022-11-27 17:41:52', '2022-11-27 17:41:52'),
(4, 'PM00004', 5, 3, '2022-11-29', NULL, 'kembali', 'asdsad', '2022-11-29 03:57:39', '2022-11-29 06:38:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksiac`
--

CREATE TABLE `transaksiac` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_peminjaman` varchar(255) NOT NULL,
  `karyawan_id` int(10) UNSIGNED NOT NULL,
  `asetac_id` int(10) UNSIGNED DEFAULT NULL,
  `supir_id` int(10) UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `ket` text DEFAULT NULL,
  `status` enum('pinjam','kembali') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksiac`
--

INSERT INTO `transaksiac` (`id`, `kode_peminjaman`, `karyawan_id`, `asetac_id`, `supir_id`, `tgl_pinjam`, `tgl_kembali`, `ket`, `status`, `created_at`, `updated_at`) VALUES
(3, 'PMJ-ATC-00001', 5, 6, 1, '2022-11-28', '2022-11-30', 'Luar Kota', 'kembali', '2022-11-28 12:32:55', '2022-11-28 12:38:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('manager','it','autocare') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `gambar`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Naufal Zaki Musyaffa', 'hrd123', 'nouvalzaki78@gmail.com', '$2y$10$nFw0Ake.DQO.hZLFC1tm9OsRwjyXQ.Xnv71udxwjFYZHNB973wewW', NULL, 'manager', 'fItDTkY6p9dYOyBOCpIXAkbRSAtypOLtWznBPEPvC88o475wrnsjBMfbeC7G', '2022-11-03 07:07:53', '2022-12-02 09:22:58'),
(2, 'User IT Example', 'it123', '654321@gmail.com', '$2y$10$Yf7fEk2QBrvAJe4lwau9eO5mDeqY1a7qyuk1gMn9nlNo7N37YOiaG', NULL, 'it', 'fXy6rw5v2vQjnYVsEiMfvJ9bjgDO8dXM9bazn4Q3WmYhczideoVCe2hgliFu', '2022-11-03 07:07:53', '2022-11-29 07:22:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aset_kategori_id_foreign` (`kategori_id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `karyaw` (`karyawan_id`);

--
-- Indeks untuk tabel `asetac`
--
ALTER TABLE `asetac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aset` (`aset_id`),
  ADD KEY `teknisi_id` (`karyawan_id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_karyawan_id_foreign` (`karyawan_id`) USING BTREE,
  ADD KEY `transaksi_aset_id_foreign` (`aset_id`);

--
-- Indeks untuk tabel `transaksiac`
--
ALTER TABLE `transaksiac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`),
  ADD KEY `transaksiac_kendaraan_id_foreign` (`asetac_id`) USING BTREE,
  ADD KEY `transaksiac_supir_id_foreign` (`supir_id`) USING BTREE,
  ADD KEY `asetac_id` (`asetac_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aset`
--
ALTER TABLE `aset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `asetac`
--
ALTER TABLE `asetac`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `supir`
--
ALTER TABLE `supir`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksiac`
--
ALTER TABLE `transaksiac`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksiac`
--
ALTER TABLE `transaksiac`
  ADD CONSTRAINT `transaksiac_ibfk_1` FOREIGN KEY (`asetac_id`) REFERENCES `asetac` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksiac_ibfk_2` FOREIGN KEY (`supir_id`) REFERENCES `supir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
