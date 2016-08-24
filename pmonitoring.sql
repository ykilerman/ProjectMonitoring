-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Agu 2016 pada 08.30
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmonitoring`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `message_details`
--

CREATE TABLE `message_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` enum('Consultation','Procurement','Consultation and Procurement') COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `icon_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `update_schedule` int(11) NOT NULL,
  `last_notification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('On Going','Closed','Deleted','Archived') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'On Going',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `highlight` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activity` longtext COLLATE utf8_unicode_ci NOT NULL,
  `activity_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `income` int(11) DEFAULT NULL,
  `income_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expense` int(11) DEFAULT NULL,
  `expense_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `updating_statuses`
--

CREATE TABLE `updating_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `highlight` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `position`, `remember_token`) VALUES
(1, 'admin1', '$2y$10$zEpajH33isV7pd68duf6SeCW.njzpu3DLlWKD0kU0Eqhr2mR57Lim', 'Project Admin 1', 'Project Admin', NULL),
(2, 'coordinator1', '$2y$10$JWgIHDOOxpuG7CuoRLGD2uVbILmHB6vRGeZBHlv4dNVg5fRJXYP7a', 'Project Coordinator 1', 'Project Coordinator', NULL),
(3, 'stakeholder1', '$2y$10$0MFSS2jeYhQuyQijqOAckuMhLLy0oEoaFuPNSawpp1cErkvEitObi', 'Stakeholder 1', 'Stakeholder', NULL),
(4, 'management1', '$2y$10$ZOWW0Mr6LgJfVxaow0t.3uUW80hpUYg41M6V9H41to6SnVyX4HRia', 'Management 1', 'Management', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `message_details`
--
ALTER TABLE `message_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_details_message_id_foreign` (`message_id`),
  ADD KEY `message_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_foreign` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_project_id_foreign` (`project_id`);

--
-- Indexes for table `updating_statuses`
--
ALTER TABLE `updating_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updating_statuses_project_id_foreign` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `message_details`
--
ALTER TABLE `message_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `updating_statuses`
--
ALTER TABLE `updating_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `message_details`
--
ALTER TABLE `message_details`
  ADD CONSTRAINT `message_details_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `message_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Ketidakleluasaan untuk tabel `updating_statuses`
--
ALTER TABLE `updating_statuses`
  ADD CONSTRAINT `updating_statuses_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
