-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2020 at 06:56 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tax_revenue`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessees`
--

CREATE TABLE `assessees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tin_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_tin_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_date` date NOT NULL,
  `circle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessees`
--

INSERT INTO `assessees` (`id`, `name`, `tin_number`, `old_tin_number`, `tin_date`, `circle_id`, `created_at`, `updated_at`) VALUES
(1, 'A B S SIDDIQUE', '323456789124', '551114329', '2017-02-12', 1, '2020-02-13 09:02:06', NULL),
(2, 'A K M Fazlul Hoque', '323456789125', '551114330', '2017-02-13', 1, '2020-02-13 09:02:06', NULL),
(3, 'A K M Mazharul Islam Khan', '323456789126', '551114331', '2018-02-14', 1, '2020-02-13 09:02:06', NULL),
(4, 'A Latif Khan', '323456789127', '551114332', '2020-02-15', 1, '2020-02-13 09:02:06', NULL),
(5, 'Joy', '323456789128', '551114333', '2020-02-16', 1, '2020-02-13 09:02:06', NULL),
(6, 'Araf Karim', '323456789129', '551114334', '2020-02-17', 1, '2020-02-13 09:02:06', NULL),
(7, 'Shibbir', '323456789130', '551114335', '2020-02-18', 1, '2020-02-13 09:02:06', NULL),
(8, 'Jayanta Biswas', '323456789131', '551114336', '2020-02-19', 1, '2020-02-13 09:02:06', NULL),
(9, 'Jabbar', '323456789132', '551114337', '2020-02-20', 1, '2020-02-13 09:02:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `circles`
--

CREATE TABLE `circles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `circles`
--

INSERT INTO `circles` (`id`, `zone`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Mymensingh', 'Circle One', '', NULL, NULL),
(2, 'Mymensingh', 'Circle Two', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_02_10_061522_create_circles_table', 1),
(5, '2020_02_11_122115_create_tax_sessions_table', 1),
(6, '2020_02_11_122403_create_assessees_table', 1),
(7, '2020_02_11_122621_create_tax_returns_table', 1);

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
-- Table structure for table `tax_returns`
--

CREATE TABLE `tax_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessee_id` bigint(20) UNSIGNED NOT NULL,
  `tax_session_id` bigint(20) UNSIGNED NOT NULL,
  `circle_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_returns`
--

INSERT INTO `tax_returns` (`id`, `assessee_id`, `tax_session_id`, `circle_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '5000.00', '2020-02-12 11:36:35', '2020-02-12 11:36:35'),
(4, 5, 1, 1, '5000.00', '2020-02-13 00:07:53', '2020-02-13 00:07:53'),
(5, 5, 3, 1, '1000.00', '2020-02-13 00:27:17', '2020-02-13 00:27:17'),
(6, 4, 1, 1, '1000.00', '2020-02-13 00:29:15', '2020-02-13 00:29:15'),
(7, 8, 2, 1, '5000.00', '2020-02-13 05:00:27', '2020-02-13 05:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `tax_sessions`
--

CREATE TABLE `tax_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_sessions`
--

INSERT INTO `tax_sessions` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, '2017-2018', NULL, NULL),
(2, '2018-2019', NULL, NULL),
(3, '2019-2020', NULL, NULL),
(4, '2020-2021', NULL, NULL),
(5, '2021-2022', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `circle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 or 1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `circle_id`, `email_verified_at`, `password`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Circle one', 'circleone@gmail.com', 1, NULL, '$2y$10$rT0I9/LlSPyuKZ3xiK3UdO25.04Giqc7I/1nF8qn/xrifHmASQV7G', 1, '3HiLjcMMmpAsonh7Dy6QJ6gRvlkmM2DAjy8kiP0YFHWn6cNN6udkF5ZtZZNZ', '2020-02-12 11:23:37', '2020-02-13 00:21:54'),
(2, 'Circle two', 'circletwo@gmail.com', 2, NULL, '$2y$10$G3X6q9./Q3xW7PRT.UY3uuJbbHGqpsJm1xizTNKQ9xY3e2k.notzG', 1, NULL, '2020-02-12 11:23:37', '2020-02-12 11:23:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessees`
--
ALTER TABLE `assessees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assessees_tin_number_unique` (`tin_number`),
  ADD UNIQUE KEY `assessees_old_tin_number_unique` (`old_tin_number`),
  ADD KEY `assessees_circle_id_foreign` (`circle_id`);

--
-- Indexes for table `circles`
--
ALTER TABLE `circles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tax_returns`
--
ALTER TABLE `tax_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tax_returns_assessee_id_foreign` (`assessee_id`),
  ADD KEY `tax_returns_circle_id_foreign` (`circle_id`),
  ADD KEY `tax_returns_tax_session_id_foreign` (`tax_session_id`);

--
-- Indexes for table `tax_sessions`
--
ALTER TABLE `tax_sessions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `assessees`
--
ALTER TABLE `assessees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `circles`
--
ALTER TABLE `circles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tax_returns`
--
ALTER TABLE `tax_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tax_sessions`
--
ALTER TABLE `tax_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessees`
--
ALTER TABLE `assessees`
  ADD CONSTRAINT `assessees_circle_id_foreign` FOREIGN KEY (`circle_id`) REFERENCES `circles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tax_returns`
--
ALTER TABLE `tax_returns`
  ADD CONSTRAINT `tax_returns_assessee_id_foreign` FOREIGN KEY (`assessee_id`) REFERENCES `assessees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_returns_circle_id_foreign` FOREIGN KEY (`circle_id`) REFERENCES `circles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_returns_tax_session_id_foreign` FOREIGN KEY (`tax_session_id`) REFERENCES `tax_sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
