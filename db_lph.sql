-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2025 at 08:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lph`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_10_17_171440_create_pelaku_usahas_table', 1),
(6, '2025_10_17_210339_modify_users_for_username_login', 1),
(7, '2025_10_17_211136_create_wilayahs_table', 1),
(8, '2025_10_17_212709_modify_daerah_to_wilayah_id_in_pelaku_usahas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelaku_usahas`
--

CREATE TABLE `pelaku_usahas` (
  `id` bigint UNSIGNED NOT NULL,
  `no_sttd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah_id` bigint UNSIGNED DEFAULT NULL,
  `skala_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_produk` int NOT NULL,
  `biaya` decimal(15,2) NOT NULL,
  `jumlah_audit` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelaku_usahas`
--

INSERT INTO `pelaku_usahas` (`id`, `no_sttd`, `nama_usaha`, `alamat_lengkap`, `wilayah_id`, `skala_usaha`, `jenis_produk`, `jumlah_produk`, `biaya`, `jumlah_audit`, `created_at`, `updated_at`) VALUES
(3, 'STTD/LPH/007/06/25', 'PT. Rasa Nusantara', 'Jl. Raya Wonosari-Baron KM 5, Sumberayu, Karangrejek, Wonosari', 15, 'Mikro dan Kecil', 'Pangan siap saji', 3, 4000000.00, 2, '2025-10-17 16:27:33', '2025-10-27 11:41:44'),
(4, 'STTD/LPH/001/06/25', 'UD. Cemilan Enak', 'Jalan Jogja Solo', 14, 'Menengah', 'Suplemen kesehatan', 2, 5500000.00, 2, '2025-10-21 02:23:59', '2025-10-21 02:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `level`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin LPH', 'admin', 'admin', '$2y$12$/8/l/MRiZ2dT1Y2dW7wE5.ZCQI7NN26va6jRHvBMD1K.3cRNYLvHW', NULL, '2025-10-17 15:16:02', '2025-10-17 15:16:02'),
(3, 'Akrimna Fahma', '22106050085', 'user', '$2y$12$V9NqMjqkiyKRv2n/IIA98ui2zSjAYW7VZb8odEbi3FSet8n2lJZlq', NULL, '2025-10-21 03:32:41', '2025-10-27 11:41:01'),
(4, 'Fikri Ramadhan', '199207052018022003', 'admin', '$2y$12$ys7eA3RmOm1PauJxxQ1J0uKMhAi4xWyK3hXFP911VH6lA3BYdeKCm', NULL, '2025-10-21 03:34:30', '2025-10-21 05:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `wilayahs`
--

CREATE TABLE `wilayahs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transport_dalam_kota` decimal(15,2) NOT NULL DEFAULT '0.00',
  `uhpd_dalam_kota` decimal(15,2) NOT NULL DEFAULT '0.00',
  `hotel_luar_kota` decimal(15,2) NOT NULL DEFAULT '0.00',
  `transport_luar_kota` decimal(15,2) NOT NULL DEFAULT '0.00',
  `tiket_pesawat_luar_kota` decimal(15,2) NOT NULL DEFAULT '0.00',
  `uhpd_luar_kota` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wilayahs`
--

INSERT INTO `wilayahs` (`id`, `nama_provinsi`, `transport_dalam_kota`, `uhpd_dalam_kota`, `hotel_luar_kota`, `transport_luar_kota`, `tiket_pesawat_luar_kota`, `uhpd_luar_kota`, `created_at`, `updated_at`) VALUES
(1, 'Aceh', 170000.00, 140000.00, 1294000.00, 766000.00, 4492000.00, 360000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(2, 'Sumatra Utara', 170000.00, 150000.00, 1100000.00, 1128000.00, 3808000.00, 370000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(3, 'Riau', 170000.00, 150000.00, 1650000.00, 714000.00, 3016000.00, 370000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(4, 'Kepulauan Riau', 170000.00, 150000.00, 1037000.00, 842000.00, 2500000.00, 370000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(5, 'Jambi', 170000.00, 150000.00, 1225000.00, 806000.00, 2460000.00, 370000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(6, 'Sumatra Barat', 170000.00, 150000.00, 1353000.00, 892000.00, 2952000.00, 380000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(7, 'Sumatra Selatan', 170000.00, 150000.00, 1571000.00, 870000.00, 2268000.00, 380000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(8, 'Lampung', 170000.00, 150000.00, 1140000.00, 848000.00, 1583000.00, 380000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(9, 'Bengkulu', 170000.00, 150000.00, 1546000.00, 730000.00, 2621000.00, 380000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(10, 'Bangka Belitung', 170000.00, 160000.00, 1957000.00, 706000.00, 2139000.00, 410000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(11, 'Banten', 170000.00, 150000.00, 1000000.00, 1584000.00, 2674000.00, 370000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(12, 'Jawa Barat', 170000.00, 170000.00, 1201000.00, 912000.00, 2674000.00, 430000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(13, 'DKI Jakarta', 170000.00, 210000.00, 992000.00, 512000.00, 2674000.00, 530000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(14, 'Jawa Tengah', 170000.00, 150000.00, 954000.00, 728000.00, 2182000.00, 370000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(15, 'D.I. Yogyakarta', 170000.00, 170000.00, 1384000.00, 1046000.00, 2268000.00, 420000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(16, 'Jawa Timur', 170000.00, 160000.00, 1076000.00, 978000.00, 2674000.00, 410000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(17, 'Bali', 170000.00, 190000.00, 1078000.00, 966000.00, 3262000.00, 480000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(18, 'Nusa Tenggara Barat', 170000.00, 180000.00, 1418000.00, 974000.00, 3230000.00, 440000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(19, 'Nusa Tenggara Timur', 170000.00, 170000.00, 1355000.00, 744000.00, 5081000.00, 430000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(20, 'Kalimantan Barat', 170000.00, 150000.00, 1125000.00, 854000.00, 2781000.00, 380000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(21, 'Kalimantan Tengah', 170000.00, 140000.00, 1160000.00, 780000.00, 2984000.00, 360000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(22, 'Kalimantan Selatan', 170000.00, 150000.00, 1500000.00, 872000.00, 2995000.00, 380000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(23, 'Kalimantan Timur', 170000.00, 170000.00, 1507000.00, 1578000.00, 3797000.00, 430000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(24, 'Kalimantan Utara', 170000.00, 170000.00, 1507000.00, 948000.00, 4057000.00, 430000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(25, 'Sulawesi Utara', 170000.00, 150000.00, 1170000.00, 788000.00, 5102000.00, 370000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(26, 'Gorontalo', 170000.00, 160000.00, 1606000.00, 1042000.00, 4824000.00, 370000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(27, 'Sulawesi Barat', 170000.00, 170000.00, 1075000.00, 1138000.00, 4867000.00, 410000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(28, 'Sulawesi Selatan', 170000.00, 170000.00, 1138000.00, 886000.00, 3829000.00, 430000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(29, 'Sulawesi Tengah', 170000.00, 150000.00, 1567000.00, 842000.00, 5113000.00, 370000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(30, 'Sulawesi Tenggara', 170000.00, 150000.00, 1297000.00, 854000.00, 4182000.00, 380000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(31, 'Maluku', 170000.00, 150000.00, 1048000.00, 1088000.00, 7081000.00, 380000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(32, 'Maluku Utara', 170000.00, 170000.00, 1073000.00, 942000.00, 10001000.00, 430000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(33, 'Papua', 170000.00, 230000.00, 2521000.00, 1538000.00, 8193000.00, 580000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(34, 'Papua Barat', 170000.00, 190000.00, 2056000.00, 1538000.00, 10824000.00, 480000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(35, 'Papua Barat Daya', 170000.00, 190000.00, 2056000.00, 1538000.00, 10824000.00, 480000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(36, 'Papua Tengah', 170000.00, 230000.00, 2521000.00, 1538000.00, 10824000.00, 580000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(37, 'Papua Selatan', 170000.00, 230000.00, 2521000.00, 1538000.00, 10824000.00, 580000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01'),
(38, 'Papua Pegunungan', 170000.00, 230000.00, 2521000.00, 1538000.00, 10824000.00, 580000.00, '2025-10-17 15:16:01', '2025-10-17 15:16:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelaku_usahas`
--
ALTER TABLE `pelaku_usahas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelaku_usahas_no_sttd_unique` (`no_sttd`),
  ADD KEY `pelaku_usahas_wilayah_id_foreign` (`wilayah_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `wilayahs`
--
ALTER TABLE `wilayahs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelaku_usahas`
--
ALTER TABLE `pelaku_usahas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wilayahs`
--
ALTER TABLE `wilayahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelaku_usahas`
--
ALTER TABLE `pelaku_usahas`
  ADD CONSTRAINT `pelaku_usahas_wilayah_id_foreign` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayahs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
