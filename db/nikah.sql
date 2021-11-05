-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2021 at 02:24 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nikah`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `NRP` int(12) NOT NULL,
  `id_kepolisian` int(12) NOT NULL,
  `Nama` varchar(60) NOT NULL,
  `Tempat_lhr` varchar(20) NOT NULL,
  `Tanggal_lhr` date NOT NULL,
  `Pekerjaan` varchar(10) NOT NULL,
  `Pangkat` varchar(20) NOT NULL,
  `Jabatan` varchar(30) NOT NULL,
  `Agama` enum('islam','hindu','budha','kristen','katolik') NOT NULL,
  `Status` enum('jejaka','perawan','duda','janda') NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `Nama_bapak` varchar(30) NOT NULL,
  `Pekerjaan_bapak` varchar(30) NOT NULL,
  `Agama_bapak` enum('islam','hindu','budha','kristen','katolik') NOT NULL,
  `Alamat_bapak` varchar(100) NOT NULL,
  `Nama_ibu` varchar(30) NOT NULL,
  `Pekerjaan_ibu` varchar(30) NOT NULL,
  `Agama_ibu` enum('islam','hindu','budha','kristen','katolik') NOT NULL,
  `Alamat_ibu` varchar(100) NOT NULL,
  `pass_anggota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`NRP`, `id_kepolisian`, `Nama`, `Tempat_lhr`, `Tanggal_lhr`, `Pekerjaan`, `Pangkat`, `Jabatan`, `Agama`, `Status`, `Alamat`, `Nama_bapak`, `Pekerjaan_bapak`, `Agama_bapak`, `Alamat_bapak`, `Nama_ibu`, `Pekerjaan_ibu`, `Agama_ibu`, `Alamat_ibu`, `pass_anggota`) VALUES
(2124, 1, 'Ahmad', 'Situbondo', '1986-08-29', 'Staff', 'II d', 'Anggota Polsek Banyuputihh', 'islam', 'jejaka', 'Banyuputih Situbondo', 'Fulan', 'Petani', 'islam', 'Banyuputih Situbondo', 'Fulanah', 'IRT', 'islam', 'Banyuputih Situbondo', '59a121af50e4988be8d67c388c554689decd7ba3');

-- --------------------------------------------------------

--
-- Table structure for table `ca_pasangan`
--

CREATE TABLE `ca_pasangan` (
  `id_cpsangan` varchar(20) NOT NULL,
  `Nama_c` varchar(60) NOT NULL,
  `Tempat_lhrc` varchar(20) NOT NULL,
  `Tanggal_lhrc` date NOT NULL,
  `Pekerjaan_c` varchar(30) NOT NULL,
  `Agamac` enum('islam','hindu','budha','kristen','katolik') NOT NULL,
  `Statusc` enum('jejaka','perawan','duda','janda') NOT NULL,
  `Alamatc` varchar(100) NOT NULL,
  `Nama_ayahc` varchar(30) NOT NULL,
  `Pekerjaan_ayahc` varchar(30) NOT NULL,
  `Agama_ayahc` enum('islam','hindu','budha','kristen','katolik') NOT NULL,
  `Alamat_ayahc` varchar(100) NOT NULL,
  `Nama_ibuc` varchar(30) NOT NULL,
  `Pekerjaan_ibuc` varchar(30) NOT NULL,
  `Agama_ibuc` enum('islam','hindu','budha','kristen','katolik') NOT NULL,
  `Alamat_ibuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ca_pasangan`
--

INSERT INTO `ca_pasangan` (`id_cpsangan`, `Nama_c`, `Tempat_lhrc`, `Tanggal_lhrc`, `Pekerjaan_c`, `Agamac`, `Statusc`, `Alamatc`, `Nama_ayahc`, `Pekerjaan_ayahc`, `Agama_ayahc`, `Alamat_ayahc`, `Nama_ibuc`, `Pekerjaan_ibuc`, `Agama_ibuc`, `Alamat_ibuc`) VALUES
('CPA.0001', 'Mahmud', 'Situbondo', '1980-12-31', 'Wiraswasta', 'islam', 'jejaka', 'Banyuputih Situbondo', 'Fulan', 'Petani', 'islam', 'Banyuputih Situbondo', 'Fulanah', 'IRT', 'islam', 'Banyuputih Situbondo'),
('CPA.0002', 'Khairul', 'Situbondo', '1999-01-31', 'ASN', 'islam', 'jejaka', 'Situbondo', 'Baijuri', 'Petani', 'islam', 'Situbondo', 'Siti', 'IRT', 'islam', 'Situbondo');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(12) NOT NULL,
  `nm_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nm_jabatan`) VALUES
(1, 'Kapolsek'),
(2, 'Pimpinan');

-- --------------------------------------------------------

--
-- Table structure for table `kepolisian`
--

CREATE TABLE `kepolisian` (
  `id_kepolisian` int(12) NOT NULL,
  `nama_kep` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `status_k` enum('N','Y') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kepolisian`
--

INSERT INTO `kepolisian` (`id_kepolisian`, `nama_kep`, `alamat`, `status_k`) VALUES
(1, 'POLSEK BANYUPUTIH', 'BANYUPUTIH', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_10_06_033810_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pimpinan`
--

CREATE TABLE `pimpinan` (
  `NRP_pimpinan` int(10) NOT NULL,
  `id_jabatan` int(12) NOT NULL,
  `id_kepolisian` int(12) NOT NULL,
  `Nama_p` varchar(50) NOT NULL,
  `thn_jabatan` varchar(30) NOT NULL,
  `foto` text NOT NULL,
  `level` enum('kapolres','kapolsek','pimpinan') NOT NULL,
  `pass_pimpinan` varchar(100) NOT NULL,
  `status_p` enum('N','Y') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pimpinan`
--

INSERT INTO `pimpinan` (`NRP_pimpinan`, `id_jabatan`, `id_kepolisian`, `Nama_p`, `thn_jabatan`, `foto`, `level`, `pass_pimpinan`, `status_p`) VALUES
(1123, 1, 1, 'Dodi', '2021', 'avatar-male.png', 'kapolsek', 'cf7579954ba3792f6a40044c32f28fb62b10863f', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('G3OjLOEzJESwowweJJg1oODM9p5XC7KjUwmN1dKY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.61 Safari/537.36', 'YTo1OntzOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IjlWMGVQSjBKblZnemlrckhvVEhpUldYV0FZMGp1NndUbUxjT1dlMW4iO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkTlRjQlBwSW1ERTF4b1FEUFdiQm1rdTNzMHdZdUladVl1dlBTRjBWbkQ4Q0pPM2dXT3F4NC4iO30=', 1633523033);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cerai`
--

CREATE TABLE `tb_cerai` (
  `id_cerai` int(12) NOT NULL,
  `nomor_sic` varchar(32) NOT NULL,
  `dasar_c` varchar(100) NOT NULL,
  `nomor_dsrc` varchar(32) NOT NULL,
  `tgl_dsr` date NOT NULL,
  `perihal_c` varchar(100) NOT NULL,
  `alasan` varchar(100) NOT NULL,
  `id_izin` int(12) NOT NULL,
  `statuscp` varchar(32) NOT NULL,
  `statuscs` varchar(32) NOT NULL,
  `statuspb` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cerai`
--

INSERT INTO `tb_cerai` (`id_cerai`, `nomor_sic`, `dasar_c`, `nomor_dsrc`, `tgl_dsr`, `perihal_c`, `alasan`, `id_izin`, `statuscp`, `statuscs`, `statuspb`) VALUES
(1, '002/X/2021', 'Mempertahankan Ego', '002/X/2021', '2021-11-06', 'Ego Terlalu Besar', 'Ego Terlalu Besar', 1, 'ACC', 'ACC', 'ACC');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mhnizinnikah`
--

CREATE TABLE `tb_mhnizinnikah` (
  `id_izin` int(12) NOT NULL,
  `nomor_sik` varchar(32) NOT NULL,
  `dasar` varchar(100) NOT NULL,
  `nomor_dsr` varchar(32) NOT NULL,
  `tgl_dasar` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `NRP` int(12) NOT NULL,
  `id_cpsangan` varchar(20) NOT NULL,
  `status_izinr` varchar(32) NOT NULL,
  `status_izins` varchar(32) NOT NULL,
  `status_izinp` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mhnizinnikah`
--

INSERT INTO `tb_mhnizinnikah` (`id_izin`, `nomor_sik`, `dasar`, `nomor_dsr`, `tgl_dasar`, `perihal`, `NRP`, `id_cpsangan`, `status_izinr`, `status_izins`, `status_izinp`) VALUES
(1, '001/X/2021', 'Saling Cinta', '002/X/2021', '2021-10-01', 'Saling Menicintai', 123, 'CPA.0001', 'ACC', 'ACC', 'ACC');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin_SDM','Kapolres','Kapolsek') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin_SDM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `level`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin_SDM', 'admin', NULL, '$2y$10$4wwTlf63jiBGCODuvfWj2O5O3nD9Qd0rVfApC6T18pN7/YjnBeHh2', NULL, NULL, 'dJQ23uKxU7xbl7f85xywzGjrS0HZry5sTQnqGWKRoaIFtWw83BfUfYgDaDGn', NULL, NULL, '2021-10-05 21:58:11', '2021-10-05 21:58:11'),
(4, 'Dodi', 'kapolsek', '1123', NULL, '$2y$10$NTcBPpImDE1xoQDPWbBmku3s0wYuIZuYuvPSF0VnD8CJO3gWOqx4.', NULL, NULL, 'X6WHRbwUuQQP8YUjLUP5liPU91vL4Mbh6ShPUbTTRobvMCAnODMrEjgwrNKJ', NULL, NULL, NULL, NULL),
(5, 'Ahmad', 'anggota', '2124', NULL, '$2y$10$DHhyhtIcgDfw7O1x.HIprO2YvbShhitZl3vmKnF1qeD4rBzkDa9zG', NULL, NULL, 'bEHrfx1PPgSVRl6q9C1NNXRIdksyG6bPnveU9R6r8iWngZaLANYExLT1Lj7Z', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`NRP`);

--
-- Indexes for table `ca_pasangan`
--
ALTER TABLE `ca_pasangan`
  ADD PRIMARY KEY (`id_cpsangan`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kepolisian`
--
ALTER TABLE `kepolisian`
  ADD PRIMARY KEY (`id_kepolisian`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD PRIMARY KEY (`NRP_pimpinan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tb_cerai`
--
ALTER TABLE `tb_cerai`
  ADD PRIMARY KEY (`id_cerai`);

--
-- Indexes for table `tb_mhnizinnikah`
--
ALTER TABLE `tb_mhnizinnikah`
  ADD PRIMARY KEY (`id_izin`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kepolisian`
--
ALTER TABLE `kepolisian`
  MODIFY `id_kepolisian` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_cerai`
--
ALTER TABLE `tb_cerai`
  MODIFY `id_cerai` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_mhnizinnikah`
--
ALTER TABLE `tb_mhnizinnikah`
  MODIFY `id_izin` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
