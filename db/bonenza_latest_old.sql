-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 09:44 AM
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_pst` date NOT NULL,
  `click_timestamps` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `referee_user_id` bigint(20) UNSIGNED NOT NULL,
  `referral_id` bigint(20) UNSIGNED NOT NULL,
  `date_referral_id_referee_user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

--
-- Dumping data for table `click_activity`
--

INSERT INTO `click_activity` (`id`, `date_pst`, `click_timestamps`, `referee_user_id`, `referral_id`, `date_referral_id_referee_user_id`, `referrer_user_id`, `referee_confirmation_status`, `referee_confirmation_snapshots`, `referrer_paid_platform_fee`, `referrer_paid_platform_fee_snapshots`, `referrer_paid_referee`, `referrer_paid_referee_snapshots`, `transaction_ratings`, `transaction_comments`, `created_at`, `updated_at`) VALUES
(4, '2024-08-01', '1722518320', 11, 45, NULL, 2, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-01 07:48:40', '2024-08-01 07:48:40'),
(5, '2024-08-01', '1722518329', 11, 45, NULL, 2, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-01 07:48:49', '2024-08-01 07:48:49'),
(6, '2024-08-01', '1722518356', 11, 45, NULL, 2, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-01 07:49:16', '2024-08-01 07:49:16'),
(7, '2024-08-01', '1722518441', 11, 45, NULL, 2, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-01 07:50:41', '2024-08-01 07:50:41'),
(8, '2024-08-01', '1722518442', 11, 45, NULL, 2, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-01 07:50:42', '2024-08-01 07:50:42'),
(9, '2024-08-01', '1722518454', 11, 45, NULL, 2, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-01 07:50:54', '2024-08-01 07:50:54'),
(10, '2024-08-01', '1722518511', 11, 45, NULL, 2, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-01 07:51:51', '2024-08-01 07:51:51'),
(11, '2024-08-01', '1722518802', 11, 45, NULL, 2, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-01 07:56:42', '2024-08-01 07:56:42'),
(12, '2024-08-02', '1722573357', 11, 48, NULL, 6, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-01 23:05:57', '2024-08-01 23:05:57'),
(13, '2024-08-02', '1722576675', 11, 5, NULL, 11, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-02 00:01:15', '2024-08-02 00:01:15'),
(14, '2024-08-02', '1722577145', 11, 45, NULL, 2, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-02 00:09:05', '2024-08-02 00:09:05'),
(15, '2024-08-02', '1722578811', 9, 48, NULL, 6, 'opened', 'N/A', 'not_yet', 'N/A', 'not_yet', 'N/A', 4, 'this is good promo code', '2024-08-02 00:36:51', '2024-08-02 00:36:51');

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(9, '2024_07_25_122457_create_referrals_table', 7),
(10, '2024_07_27_073142_add_id_to_click_activity_table', 8),
(11, '2024_08_01_050735_add_field_to_table_name', 9),
(12, '2024_08_01_085126_message_table', 10),
(13, '2024_08_02_044531_add_column_seen_to_messages_table', 10);

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
  `expected_payout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referee_share_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_share_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform_percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `offer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_payout_by_referar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_payout_by_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_links`
--

INSERT INTO `referral_links` (`id`, `category_id`, `user_id`, `referral_url`, `display_name`, `canonicalized_name`, `logo`, `promo_terms`, `promo_terms_url`, `promo_expiration_date`, `expiry_date`, `status`, `expected_payout`, `referee_share_percentage`, `referral_share_percentage`, `platform_percentage`, `expected_days`, `created_at`, `updated_at`, `offer_id`, `expected_payout_by_referar`, `expected_payout_by_website`) VALUES
(5, '1', '11', 'http://www.google.come', 'MooMoo', 'Demo', 'Screenshot 2024-05-16 150131.png', '1', 'http://www.google.come', '2024-07-06', NULL, 'Active', '1000', '12', '12', '12', '1', '2024-07-01 07:46:53', '2024-08-01 00:12:56', '10', '122', ''),
(7, '1', '2', 'http://www.google.come', 'Prasad', 'Prasad', 'footer.jfif', '1', 'http://www.google.com', '2024-07-16', NULL, 'Pending', '1000', '450', '12', '3', '5', '2024-07-02 02:03:31', '2024-07-02 02:03:31', '', '', ''),
(8, '1', '2', 'http://www.google.come', 'Google', NULL, 'banner.png', '1', 'http://www.google.com', '2024-07-02', NULL, 'Pending', '134', '34', '34', '123', '34', '2024-07-02 02:22:00', '2024-07-02 02:22:00', '', '', ''),
(9, '1', '2', 'http://www.google.come', 'Private', NULL, 'img2.png', '123', 'http://www.google.com', '2024-07-04', NULL, 'Pending', '10', '123', '45', '1', '12', '2024-07-02 02:25:05', '2024-07-02 02:25:05', '', '', ''),
(10, '1', '6', 'http://www.google.com', 'MOMO', NULL, 'img1.png', '123', 'http://www.google.com', '2024-07-25', NULL, 'Pending', '12', '145', '123', '1000', '12', '2024-07-02 02:26:24', '2024-07-02 02:26:24', '', '', ''),
(11, '1', '5', 'http://www.amazon.com', 'Amazon', 'Amazon', 'img5.jfif', '123', 'http://www.google.com', '2024-07-03', NULL, 'Pending', '456', '4547', '413', '10', '10', '2024-07-02 02:32:13', '2024-07-16 15:03:41', '', '', ''),
(12, '1', '2', 'http://www.google.com', 'Logo', NULL, 'logo.PNG', '123', 'http://www.google.com', '2024-07-10', NULL, 'Pending', '123', '123', '12', '34', '23', '2024-07-02 02:33:49', '2024-07-02 02:33:49', '', '', ''),
(31, '1', '9', 'https://getbootstrap.com/docs/5.0/forms/select/', 'test', 'test', 'logos/hUXT57d2Ta7j3mrM4IIGT905OCEpf7ooFOnmuInl.jpg', 'sfdsf', 'https://getbootstrap.com/docs/5.0/forms/select/', '2025-02-22', '2025-02-22', 'Pending', '23', '45', '45', '10', '4', '2024-07-27 00:02:55', '2024-07-27 00:02:55', '', '', ''),
(32, '3', '9', 'https://getbootstrap.com/docs/5.0/forms/select/', 'test', 'test', 'gradient-world-wide-web-internet_78370-4896-removebg-preview.png', 'test', 'https://getbootstrap.com/docs/5.0/forms/select/', '2025-02-22', '2025-02-22', 'Pending', '23', '45', '45', '10', '4', '2024-07-27 00:04:11', '2024-07-28 23:55:35', '', '', ''),
(33, '1', '9', 'https://getbootstrap.com/docs/5.0/forms/select/', 'test', 'test', 'logos/2svqCPJQBNrqauUR02ceciAcP3KsUAmBVLmD9VhD.jpg', 'test', 'https://getbootstrap.com/docs/5.0/forms/select/', '2025-02-22', '2025-02-22', 'Pending', '23', '45', '45', '10', '4', '2024-07-27 00:08:34', '2024-07-27 00:08:34', '', '', ''),
(34, '6', '9', 'https://www.linux.org/threads/go-install-shows-permission-denied.49072/#google_vignette', 'rohit', 'rohit', 'gradient-world-wide-web-internet_78370-4896-removebg-preview.png', 'ghjghjgjh', 'https://www.linux.org/threads/go-install-shows-permission-denied.49072/#google_vignette', '2024-07-10', '2024-07-10', 'Pending', '213', '45', '45', '10', '123', '2024-07-27 05:07:56', '2024-07-28 23:54:22', '15', '121', ''),
(35, '1', '9', 'https://www.linux.org/threads/go-install-shows-permission-denied.49072/#google_vignette', 'rohit', 'rohit', 'gradient-world-wide-web-internet_78370-4896-removebg-preview.png', 'fghghfghfgh', 'https://www.linux.org/threads/go-install-shows-permission-denied.49072/#google_vignette', '2024-07-11', '2024-07-11', 'Pending', '121', '45', '45', '10', '12', '2024-07-27 07:13:06', '2024-07-28 23:54:54', '', '', ''),
(36, '6', '9', 'https://www.netflix.com/in/', 'Netflix', 'netflix', 'logos/MZMjvoPSeiBXEuzZF39qi6omC293jOPoVWjUwYIW.jpg', 'Best Movies', 'https://www.netflix.com/in/', '2024-07-19', '2024-07-19', 'Pending', '122', '45', '45', '10', '112', '2024-07-29 06:40:27', '2024-07-29 06:40:27', '', '', ''),
(42, '6', '9', 'https://docs.google.com/ghghhg', 'Netflix', 'netflix', 'logos/bJadaXCEtHfmaOEaB42JNKuUfpSdL2Co5M7bAaye.png', 'Best Movies', 'https://www.netflix.com/in/', '2024-07-19', '2024-07-19', 'Pending', '122', '45', '45', '10', '112', '2024-07-29 07:48:05', '2024-07-29 07:48:05', '', '', ''),
(43, '6', '9', 'https://www.linux.org/threads/go-install', 'rohit', 'rohit', 'logos/7dCUClfDe01BX5v8WuH0evjgwEHFXPHgpBh4kuiz.png', 'ghjghjgjh', 'https://www.linux.org/threads/go-install-shows-permission-denied.49072/#google_vignette', '2024-07-10', '2024-07-10', 'Pending', '213', '45', '45', '10', '123', '2024-07-29 22:59:45', '2024-07-29 22:59:45', '', '', ''),
(44, '1', '2', 'https://www.linux.org/threads/go-install-shows-permission-denied.49072/#google_vignette', 'Netflix', 'Demo', 'Screenshot 2024-05-16 151526.png', 'this is the first entry', 'https://www.netflix.com/in/', '2024-08-02', NULL, 'Pending', NULL, '12', '12', '12', '12', '2024-08-01 00:52:43', '2024-08-01 00:52:43', '', '122', NULL),
(45, '1', '2', 'https://www.linux.org/threads/go-install-shows-permission-denied.49072/#google_vignette', 'hjkhkjhkjhk', 'hkjhkjhkjhkj', 'Screenshot 2024-05-16 151526.png', 'hjkhkjhkjhjk', 'https://www.netflix.com/in/', '2024-08-09', NULL, 'Active', NULL, '88', '88', '88', '88', '2024-08-01 00:54:47', '2024-08-01 00:54:47', '11', '88', NULL);

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

--
-- Dumping data for table `referral_websites`
--

INSERT INTO `referral_websites` (`id`, `category_id`, `user_id`, `canonicalized_name`, `logo`, `promo_terms`, `promo_terms_url`, `promo_expiration_date`, `status`, `expected_payout`, `referee_share_percentage`, `referral_share_percentage`, `platform_percentage`, `expected_days`, `created_at`, `updated_at`) VALUES
(10, '4', '2', 'Adani Power', 'Adani-Power-Limited-3.jpg', 'this is the coupon for adani power pament', 'https://www.netflix.com/in/', '2024-07-11', 'Active', '12', '45', '52', '145', '7', '2024-07-31 07:06:25', '2024-08-01 04:53:47'),
(11, '1', '2', 'Rohit', 'Screenshot 2024-05-16 151526.png', 'This is a netflix Promo code', 'https://www.netflix.com/in/', '2024-08-16', 'Active', '23', '12', '12', '12', '1', '2024-07-31 23:29:11', '2024-07-31 23:29:11'),
(12, '3', '6', 'Kotak SIP', 'Axis_Bank_logo.svg.png', 'This is coupon for Kotak SIP', 'https://www.netflix.com/in/', '2024-08-09', 'Active', '15', '12', '5', '5', '5', '2024-08-01 04:49:51', '2024-08-01 04:49:51'),
(14, '6', '2', 'HSBC', '1869679.png', 'This is a HSBC Promo code', 'https://www.netflix.com/in/', '2024-08-16', 'Active', '12', '5', '12', '2', '2', '2024-08-01 04:53:26', '2024-08-01 04:53:26'),
(15, '3', '5', 'Hindu', 'gradient-world-wide-web-internet_78370-4896-removebg-preview.png', 'this is the Hindu Promo code', 'https://www.thehindu.com/sci-tech/science/isro-releases-satellite-before-and-after-images-of-landslide-at-chooralmala-in-wayanad-district-of-kerala/article68472357.ece', '2024-08-15', 'Active', '23', '12', '12', '12', '12', '2024-08-02 00:20:11', '2024-08-02 00:20:39');

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
('c5olHbcIYZhu47b72dzFWq9n3mYBrvzlqBaU1oof', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6ImxvY2FsZSI7TjtzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiOGxLMEN3cVJMMzFvSkdsYnB0dW5XV1F4MjkwYzlJdjREa3RXNlNiZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3Byb2ZpbGVfZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTt9', 1722584565),
('DLYjIAIzjRSaIdDSM5iyJHaAPP7PvbKpCWUkqcMv', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidjBsZUliOFl1ZHh3Um9xbDJpeEVKcEhMeDF3S1A2dGxuem11MjBaUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZWZlcnJhbF9saW5rcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO30=', 1722583596);

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
(1, NULL, 'Admin', 'Admin', 'admin@gmail.com', NULL, '$2y$12$82hezuFhhklqzcFXAOk51uH0WXkLagaSOl7dhHa.tdhsDR8j0IDyq', 'user', NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-20 07:05:34', '2024-06-20 07:05:34'),
(2, 'PRASAD', 'Prasad', 'Rodage', 'prodage984@gmail.com', NULL, '$2y$12$Uya1eroMZ9ujwLE0Q6.9u.cmDj9.UrGT4ScYnypOa5uYUBGfMxQKy', 'user', '102 B/ 6 Bhavani Peth,Solapur', '8855921085', 'prasad_62.jpg', NULL, 'I hope you can make good use of any my referral links. Life gets expensive especially at the moment so I am glad if it helps anyone out. I hope you can make good use of any my referral links. Life gets expensive especially at the moment so I am glad if it helps anyone out.', NULL, '2024-06-20 07:14:45', '2024-07-16 07:20:43'),
(3, NULL, 'Suraj', 'Namaji', 'suraj@gmail.com', NULL, '$2y$12$dEOxMMV2NLreNKk7TZQxeeiOxMEH76qBHCpPUPczQl7TY4Nt5Pndy', 'user', NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-20 07:46:23', '2024-06-20 07:46:23'),
(4, 'vwxyz', 'xyz', 'xyz', 'xyz@gmail.com', NULL, '$2y$12$zvArC5FG4D6.eeR.VzeYOepB3kdR/cJxEGF78iX7EMmP14GxYSQX2', 'user', NULL, '8855921085', NULL, '1', NULL, NULL, '2024-06-27 03:43:20', '2024-06-27 03:43:20'),
(5, 'pqrsw', 'pqr', 'pqr', 'pqr@gmail.com', NULL, '$2y$12$uJ7jclwSKVK7E6u7SRbP3.eDzGQR8YIFEoEyla0c3up0gdMa1GHgy', 'user', NULL, NULL, NULL, '1', NULL, NULL, '2024-06-27 03:45:59', '2024-06-27 03:45:59'),
(6, 'pranav', 'pranav', 'mukharji', 'pranavmukharji@gmail.com', NULL, '$2y$12$noeMmraVQ9j8Iy/ibSTjquVBpbWbctUUiWY940q4lheJCfMNg/3RC', 'user', NULL, '8855921085', NULL, '1', NULL, NULL, '2024-06-27 03:48:21', '2024-06-27 03:48:21'),
(7, NULL, 'Sai', 'sharma', 'saisharma@gmail.com', NULL, '$2y$12$di7rgq23V1zJPMqR4soJ6uye/eG6HOPVuX/S4V9CwMZXXAdUr9XPK', 'user', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-17 00:02:00', '2024-07-17 00:02:00'),
(9, NULL, 'pratham', 'kvell', 'pratham.kvell@gmail.com', NULL, '$2y$12$yKl3etQYJEQjt0wW79q0MuHZE/yzLCj2gq37COYIf0C6ApI8uK.B6', 'user', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-26 02:12:44', '2024-07-26 02:12:44'),
(11, NULL, 'growwith', 'kvell', 'growwithkvell@gmail.com', NULL, '$2y$12$RF2dogIqq3WAWXNlP29Y0uniopF4LdiC47q8L6G1jtdlOKBWNuzee', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-27 00:07:27', '2024-07-27 00:07:27'),
(12, NULL, 'rohit', 'godara', 'rohit@gmail.com', NULL, '$2y$12$xQomsx63oh3ojMh/.cpVq.DOuGQ2wIY0M0ufJLGiF4AdLIwpjw/YS', 'user', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-27 04:55:05', '2024-07-27 04:55:05');

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
  ADD PRIMARY KEY (`id`),
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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

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
-- AUTO_INCREMENT for table `click_activity`
--
ALTER TABLE `click_activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `referral_links`
--
ALTER TABLE `referral_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `referral_websites`
--
ALTER TABLE `referral_websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
