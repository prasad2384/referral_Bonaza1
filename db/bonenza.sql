-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 03:31 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bonenza`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bank', '2024-06-20 07:27:52', '2024-06-20 07:27:52'),
(3, 'Mutual Funds', '2024-06-27 03:50:16', '2024-06-27 03:50:16'),
(4, 'Adani shares', '2024-06-27 03:50:38', '2024-06-27 03:50:38'),
(6, 'Employee', '2024-06-27 03:51:10', '2024-06-27 03:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `click_activity`
--

CREATE TABLE `click_activity` (
  `date_pst` date NOT NULL,
  `click_timestamps` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `referee_user_id` bigint(20) UNSIGNED NOT NULL,
  `referral_id` bigint(20) UNSIGNED NOT NULL,
  `date_referral_id_referee_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referrer_user_id` bigint(20) UNSIGNED NOT NULL,
  `referee_confirmation_status` enum('not_yet','opened') COLLATE utf8mb4_unicode_ci NOT NULL,
  `referee_confirmation_snapshots` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `referrer_paid_platform_fee` enum('not_yet','paid','acknowledged') COLLATE utf8mb4_unicode_ci NOT NULL,
  `referrer_paid_platform_fee_snapshots` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `referrer_paid_referee` enum('not_yet','paid','acknowledged') COLLATE utf8mb4_unicode_ci NOT NULL,
  `referrer_paid_referee_snapshots` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `transaction_ratings` int(11) DEFAULT NULL,
  `transaction_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_14_094641_create_categories_table', 2),
(5, '2024_06_14_111633_create_categories_table', 3),
(6, '2024_06_15_100908_create_referral_links_table', 4),
(7, '2024_06_15_152805_create_click_activities_table', 5),
(8, '2024_06_15_153111_create_referral_websites_table', 6),
(9, '2024_07_25_122457_create_referrals_table', 7);

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
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `date_pst` date NOT NULL,
  `click_timestamps` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `referee_user_id` bigint(20) UNSIGNED NOT NULL,
  `referral_id` bigint(20) UNSIGNED NOT NULL,
  `date_referral_id_referee_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referrer_user_id` bigint(20) UNSIGNED NOT NULL,
  `referee_confirmation_status` enum('not_yet','opened') COLLATE utf8mb4_unicode_ci NOT NULL,
  `referee_confirmation_snapshots` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `referrer_paid_platform_fee` enum('not_yet','paid','acknowledged') COLLATE utf8mb4_unicode_ci NOT NULL,
  `referrer_paid_platform_fee_snapshots` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `referrer_paid_referee` enum('not_yet','paid','acknowledged') COLLATE utf8mb4_unicode_ci NOT NULL,
  `referrer_paid_referee_snapshots` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `transaction_ratings` int(11) DEFAULT NULL,
  `transaction_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_links`
--

CREATE TABLE `referral_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canonicalized_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_terms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_terms_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_expiration_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_payout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referee_share_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_share_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_links`
--

INSERT INTO `referral_links` (`id`, `category_id`, `user_id`, `referral_url`, `display_name`, `canonicalized_name`, `logo`, `promo_terms`, `promo_terms_url`, `promo_expiration_date`, `expiry_date`, `status`, `expected_payout`, `referee_share_percentage`, `referral_share_percentage`, `platform_percentage`, `expected_days`, `created_at`, `updated_at`) VALUES
(5, '1', '2', 'http://www.google.come', 'MooMoo', NULL, 'img6.jfif', '1', 'http://www.google.come', '2024-07-06', NULL, 'Pending', '1000', '200', '200', '200', '12', '2024-07-01 07:46:53', '2024-07-16 15:01:44'),
(7, '1', '2', 'http://www.google.come', 'Prasad', 'Prasad', 'footer.jfif', '1', 'http://www.google.com', '2024-07-16', NULL, 'Pending', '1000', '450', '12', '3', '5', '2024-07-02 02:03:31', '2024-07-02 02:03:31'),
(8, '1', '2', 'http://www.google.come', 'Google', NULL, 'banner.png', '1', 'http://www.google.com', '2024-07-02', NULL, 'Pending', '134', '34', '34', '123', '34', '2024-07-02 02:22:00', '2024-07-02 02:22:00'),
(9, '1', '2', 'http://www.google.come', 'Private', NULL, 'img2.png', '123', 'http://www.google.com', '2024-07-04', NULL, 'Pending', '10', '123', '45', '1', '12', '2024-07-02 02:25:05', '2024-07-02 02:25:05'),
(10, '1', '6', 'http://www.google.com', 'MOMO', NULL, 'img1.png', '123', 'http://www.google.com', '2024-07-25', NULL, 'Pending', '12', '145', '123', '1000', '12', '2024-07-02 02:26:24', '2024-07-02 02:26:24'),
(11, '1', '5', 'http://www.amazon.com', 'Amazon', 'Amazon', 'img5.jfif', '123', 'http://www.google.com', '2024-07-03', NULL, 'Pending', '456', '4547', '413', '10', '10', '2024-07-02 02:32:13', '2024-07-16 15:03:41'),
(12, '1', '2', 'http://www.google.com', 'Logo', NULL, 'logo.PNG', '123', 'http://www.google.com', '2024-07-10', NULL, 'Pending', '123', '123', '12', '34', '23', '2024-07-02 02:33:49', '2024-07-02 02:33:49'),
(13, '1', '8', 'https://refral.com', 'rohit', 'rohit', 'logos/4U8pqPCEELcGfqgOZw8cjHA11RCHERpceMynwk2s.png', 'this is for testing', 'https://prmo.com', '2024-07-26', '2024-07-26', 'Pending', '50', '45', '45', '10', '20', '2024-07-26 07:20:50', '2024-07-26 07:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `referral_websites`
--

CREATE TABLE `referral_websites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `canonicalized_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `promo_terms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_terms_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_expiration_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_payout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referee_share_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_share_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GUS3iykKBf3A3LuCWkvTPB70c9Sg7nToOmx8rOJj', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmwxcllRWWpNTXY2VFROejNUWUdQc0pDeHNMY0dneEpoVE9xUDR3QSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3Byb2ZpbGVfZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1721999816),
('J3SxNC0FxgIDTxt0SJBrPb6bPV2IKyGxGGntmhoP', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6ImxvY2FsZSI7TjtzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiTWh2Q3hiNHNoRERtbElZMElwc000NlpwVXh6WVB2aU5xVFZ0amxqQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3Byb2ZpbGVfZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1721912140),
('s21g6J3hoES9LjFIUERKsIo2YNyQXZSoLVK9YjHV', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWDVONXU2Q0JzYzNSRFN0VFk1TjJXbDlad3ZrNUc2WTRPTkdMS0U4ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3Byb2ZpbGVfZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1721967582);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `usertype`, `address`, `phone`, `logo`, `status`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'Admin', 'admin@gmail.com', NULL, '$2y$12$2G3xnHF32Tqmve9o4taiPuLFB7pAAuTdzcl8e0KRg2VIRk43jevja', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-20 07:05:34', '2024-06-20 07:05:34'),
(2, 'PRASAD', 'Prasad', 'Rodage', 'prodage984@gmail.com', NULL, '$2y$12$Uya1eroMZ9ujwLE0Q6.9u.cmDj9.UrGT4ScYnypOa5uYUBGfMxQKy', 'user', '102 B/ 6 Bhavani Peth,Solapur', '8855921085', 'home-card-1.png', NULL, 'I hope you can make good use of any my referral links. Life gets expensive especially at the moment so I am glad if it helps anyone out. I hope you can make good use of any my referral links. Life gets expensive especially at the moment so I am glad if it helps anyone out.', NULL, '2024-06-20 07:14:45', '2024-07-25 01:46:20'),
(3, NULL, 'Suraj', 'Namaji', 'suraj@gmail.com', NULL, '$2y$12$dEOxMMV2NLreNKk7TZQxeeiOxMEH76qBHCpPUPczQl7TY4Nt5Pndy', 'user', NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-20 07:46:23', '2024-06-20 07:46:23'),
(4, 'vwxyz', 'xyz', 'xyz', 'xyz@gmail.com', NULL, '$2y$12$zvArC5FG4D6.eeR.VzeYOepB3kdR/cJxEGF78iX7EMmP14GxYSQX2', 'user', NULL, '8855921085', NULL, '1', NULL, NULL, '2024-06-27 03:43:20', '2024-06-27 03:43:20'),
(5, 'pqrsw', 'pqr', 'pqr', 'pqr@gmail.com', NULL, '$2y$12$uJ7jclwSKVK7E6u7SRbP3.eDzGQR8YIFEoEyla0c3up0gdMa1GHgy', 'user', NULL, NULL, NULL, '1', NULL, NULL, '2024-06-27 03:45:59', '2024-06-27 03:45:59'),
(6, 'pranav', 'pranav', 'mukharji', 'pranavmukharji@gmail.com', NULL, '$2y$12$noeMmraVQ9j8Iy/ibSTjquVBpbWbctUUiWY940q4lheJCfMNg/3RC', 'user', NULL, '8855921085', NULL, '1', NULL, NULL, '2024-06-27 03:48:21', '2024-06-27 03:48:21'),
(7, NULL, 'Sai', 'sharma', 'saisharma@gmail.com', NULL, '$2y$12$di7rgq23V1zJPMqR4soJ6uye/eG6HOPVuX/S4V9CwMZXXAdUr9XPK', 'user', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-17 00:02:00', '2024-07-17 00:02:00'),
(8, NULL, 'rohit', 'godara', 'rohit@gmail.com', NULL, '$2y$12$2G3xnHF32Tqmve9o4taiPuLFB7pAAuTdzcl8e0KRg2VIRk43jevja', 'user', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-24 07:08:05', '2024-07-24 07:08:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `click_activity`
--
ALTER TABLE `click_activity`
  ADD UNIQUE KEY `click_activity_date_referral_id_referee_user_id_unique` (`date_referral_id_referee_user_id`),
  ADD KEY `click_activity_referee_user_id_foreign` (`referee_user_id`),
  ADD KEY `click_activity_referrer_user_id_foreign` (`referrer_user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD KEY `referrals_referee_user_id_foreign` (`referee_user_id`);

--
-- Indexes for table `referral_links`
--
ALTER TABLE `referral_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_websites`
--
ALTER TABLE `referral_websites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `referral_links`
--
ALTER TABLE `referral_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `referral_websites`
--
ALTER TABLE `referral_websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `click_activity`
--
ALTER TABLE `click_activity`
  ADD CONSTRAINT `click_activity_referee_user_id_foreign` FOREIGN KEY (`referee_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `click_activity_referrer_user_id_foreign` FOREIGN KEY (`referrer_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_referee_user_id_foreign` FOREIGN KEY (`referee_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
