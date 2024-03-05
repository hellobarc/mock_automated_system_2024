-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 01:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mock_automated`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_infos`
--

CREATE TABLE `candidate_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_log_id` bigint(20) NOT NULL,
  `branch_name_for_mock` varchar(255) NOT NULL,
  `purpose_of_ielts` enum('ac','gt') NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `student_source` enum('inhouse','outside') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidate_infos`
--

INSERT INTO `candidate_infos` (`id`, `candidate_log_id`, `branch_name_for_mock`, `purpose_of_ielts`, `phone_number`, `student_source`, `created_at`, `updated_at`) VALUES
(2, 2, 'uttara', 'gt', '01746808384', 'inhouse', '2024-03-05 03:49:52', '2024-03-05 03:49:52'),
(3, 4, 'uttara', 'ac', '01746808384', 'inhouse', '2024-03-05 04:20:00', '2024-03-05 05:26:48'),
(4, 6, 'uttara', 'ac', '01746808384', 'inhouse', '2024-03-05 04:21:07', '2024-03-05 04:21:07'),
(5, 7, 'uttara', 'gt', '01746808384', 'inhouse', '2024-03-05 04:26:51', '2024-03-05 04:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_logs`
--

CREATE TABLE `candidate_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidate_logs`
--

INSERT INTO `candidate_logs` (`id`, `full_name`, `email`, `unique_id`, `created_at`, `updated_at`) VALUES
(2, 'samiu', 'shadman.barc@gmail.com', '3fc31u050324', '2024-03-05 03:49:52', '2024-03-05 03:49:52'),
(4, 'samiu', 'shadman.b1@gmail.com', '1a4d9u050324', '2024-03-05 04:20:00', '2024-03-05 05:26:48'),
(6, 'samiu', 'shadman.barc12@gmail.com', '9c223u050324', '2024-03-05 04:21:07', '2024-03-05 04:21:07'),
(7, 'samiullll', 'adviso1r2@barc.com', 'c1323u050324', '2024-03-05 04:26:51', '2024-03-05 04:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_mock_statuses`
--

CREATE TABLE `candidate_mock_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_log_id` bigint(20) NOT NULL,
  `mock_puchase_count` int(11) NOT NULL,
  `dates_booked` varchar(255) NOT NULL,
  `attendance_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_03_03_054020_create_student_registrations_table', 2),
(7, '2024_03_03_111041_create_purchased_mocks_table', 3),
(8, '2024_03_03_111055_create_candidate_logs_table', 3),
(9, '2024_03_03_111100_create_candidate_infos_table', 3),
(10, '2024_03_03_111114_create_candidate_mock_statuses_table', 3),
(13, '2024_03_04_112647_create_mock_dates_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mock_dates`
--

CREATE TABLE `mock_dates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `total_allocation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mock_dates`
--

INSERT INTO `mock_dates` (`id`, `date`, `total_allocation`, `created_at`, `updated_at`) VALUES
(1, '3-3-2024', '5', NULL, NULL),
(2, '4-3-2024', '8', NULL, NULL),
(3, '5-3-2024', '6', NULL, NULL),
(4, '6-3-2024', '2', NULL, NULL),
(5, '7-3-2024', '7', NULL, NULL),
(6, '10-3-2024', '5', NULL, NULL),
(7, '25-3-2024', '9', NULL, NULL),
(8, '28-3-2024', '', NULL, NULL),
(9, '7-3-2024', '2', '2024-03-05 04:21:07', '2024-03-05 04:21:07'),
(10, '5-3-2024', '2', '2024-03-05 04:26:51', '2024-03-05 04:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchased_mocks`
--

CREATE TABLE `purchased_mocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_log_id` bigint(20) NOT NULL,
  `date` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `paid_fees` int(11) NOT NULL,
  `due_fees` int(11) NOT NULL,
  `total_fees` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_registrations`
--

CREATE TABLE `student_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `purpose_of_ielts` enum('ac','gt') NOT NULL,
  `branch_name_for_mock` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `student_source` enum('inhouse','outside') NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_registrations`
--

INSERT INTO `student_registrations` (`id`, `student_id`, `full_name`, `email`, `phone_number`, `purpose_of_ielts`, `branch_name_for_mock`, `date`, `student_source`, `price`, `created_at`, `updated_at`) VALUES
(1, '65e440f541d28', 'samiullll', 'shadman.barc@gmail.com', '01746808384', 'ac', 'uttara', '2024-03-28', 'inhouse', 1200, '2024-03-03 03:20:53', '2024-03-03 03:20:53'),
(2, 'M-b95e4-03-03-24', 'samiullll', 'shadman.barc@gmail.com', '01746808384', 'ac', 'MIRPUR', '2024-03-30', 'inhouse', 1200, '2024-03-03 04:01:06', '2024-03-03 04:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@barc.com', NULL, '$2y$12$wyO9GNbj.L170Vj42iWwfOVwuSzThmtCm02yTk4FUk0vMdP3JgtRW', 6, NULL, '2024-03-02 04:42:39', '2024-03-02 04:42:39'),
(2, 'Register', 'register@barc.com', NULL, '$2y$12$2V89LJAAfqrNi5yLowBZFerMDMICwrgys0N4XaRvhPMF377Ez24TS', 0, NULL, '2024-03-02 04:42:39', '2024-03-02 04:42:39'),
(3, 'assessor', 'assessor@barc.com', NULL, '$2y$12$9NAu5.f5k26oaP1YJAKx0eXD70d0XpYOA62tBPhHSPmZ8XerY/6IS', 1, NULL, '2024-03-02 04:42:39', '2024-03-02 04:42:39'),
(4, 'moderator', 'moderator@barc.com', NULL, '$2y$12$oKFUwa6JfMFRGpui.V6u8uJB6N5v.2G/1WRHApHs.QxIJLJ7XyBLC', 2, NULL, '2024-03-02 04:42:39', '2024-03-02 04:42:39'),
(5, 'editor', 'editor@barc.com', NULL, '$2y$12$N/uBpnb1MCfVrTZ22FCNqufHYPd2FpICCPIlWQAQ5mLQAayjnG226', 3, NULL, '2024-03-02 04:42:39', '2024-03-02 04:42:39'),
(6, 'accounts', 'accounts@barc.com', NULL, '$2y$12$z0jk6yXD7NZjYIDGV4fA3em2hurpkxNFUtoFjdXFylLL/.eA8JPmq', 4, NULL, '2024-03-02 04:42:39', '2024-03-02 04:42:39'),
(7, 'invigilator', 'invigilator@barc.com', NULL, '$2y$12$d.Djk0ssg6zY.xkYIR1xieHZAnTg0fVUqaIBsd.rcD4aKW5BSdT16', 5, NULL, '2024-03-02 04:42:39', '2024-03-02 04:42:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate_infos`
--
ALTER TABLE `candidate_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_logs`
--
ALTER TABLE `candidate_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `candidate_logs_email_unique` (`email`);

--
-- Indexes for table `candidate_mock_statuses`
--
ALTER TABLE `candidate_mock_statuses`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `mock_dates`
--
ALTER TABLE `mock_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchased_mocks`
--
ALTER TABLE `purchased_mocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_registrations`
--
ALTER TABLE `student_registrations`
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
-- AUTO_INCREMENT for table `candidate_infos`
--
ALTER TABLE `candidate_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `candidate_logs`
--
ALTER TABLE `candidate_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `candidate_mock_statuses`
--
ALTER TABLE `candidate_mock_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mock_dates`
--
ALTER TABLE `mock_dates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchased_mocks`
--
ALTER TABLE `purchased_mocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_registrations`
--
ALTER TABLE `student_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
