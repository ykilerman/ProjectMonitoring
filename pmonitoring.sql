-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Jan 2017 pada 14.14
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
-- Struktur dari tabel `devices`
--

CREATE TABLE `devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `device_id` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `room` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `read` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2016_08_09_112049_create_projects_table', 1),
('2016_08_09_114452_create_reports_table', 1),
('2016_08_09_121815_create_messages_table', 1),
('2016_08_09_133501_create_updating_statuses_table', 1),
('2016_11_15_183856_create_devices_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` enum('Consultation','Procurement','Consultation and Procurement') COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `icon_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `update_schedule` int(11) NOT NULL,
  `last_notification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `percent` int(11) NOT NULL DEFAULT '0',
  `status` enum('On Going','Closed','Deleted','Archived') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'On Going',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `type`, `name`, `description`, `icon_path`, `client_name`, `value`, `update_schedule`, `last_notification`, `percent`, `status`, `created_at`, `updated_at`) VALUES
('CP0000000001', 2, 'Consultation and Procurement', 'Project 4', 'Project 4 Seeder', 'http://localhost/ProjectMonitoring/web/storage/app/images/icon/project4-20160823100135.jpg', 'VDI', 12000000, 7, '2017-01-16 12:58:45', 0, 'Archived', '2017-01-16 12:58:45', '2017-01-16 12:58:45'),
('CU0000000001', 2, 'Consultation', 'Project 1', 'Project 1 Seeder', 'http://localhost/ProjectMonitoring/web/storage/app/images/icon/project1-20160823100135.jpg', 'VDI', 12000000, 7, '2017-01-16 12:58:45', 0, 'On Going', '2017-01-16 12:58:45', '2017-01-16 12:58:45'),
('CU0000000002', 2, 'Consultation', 'Project 2', 'Project 2 Seeder', 'http://localhost/ProjectMonitoring/web/storage/app/images/icon/project2-20160823100135.jpg', 'VDI', 12000000, 7, '2017-01-16 12:58:45', 0, 'Deleted', '2017-01-16 12:58:45', '2017-01-16 12:58:45'),
('PR0000000001', 2, 'Procurement', 'Project 3', 'Project 3 Seeder', 'http://localhost/ProjectMonitoring/web/storage/app/images/icon/project3-20160823100135.jpg', 'VDI', 12000000, 7, '2017-01-16 12:58:45', 0, 'Closed', '2017-01-16 12:58:45', '2017-01-16 12:58:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `highlight` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activity` longtext COLLATE utf8_unicode_ci NOT NULL,
  `activity_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `income` int(11) DEFAULT NULL,
  `income_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expense` int(11) DEFAULT NULL,
  `expense_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `reports`
--

INSERT INTO `reports` (`id`, `project_id`, `highlight`, `activity`, `activity_path`, `income`, `income_path`, `expense`, `expense_path`, `created_at`, `updated_at`) VALUES
(1, 'CU0000000001', 'initiate project', 'initiate project', 'http://localhost/ProjectMonitoring/web/storage/app/images/evidence/activity1-20160824125700.jpg', 0, 'http://localhost/ProjectMonitoring/web/storage/app/images/evidence/income1-20160824125700.jpg', 0, 'http://localhost/ProjectMonitoring/web/storage/app/images/evidence/expense1-20160824125700.jpg', '2017-01-16 12:58:45', '2017-01-16 12:58:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `updating_statuses`
--

CREATE TABLE `updating_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `highlight` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `updating_statuses`
--

INSERT INTO `updating_statuses` (`id`, `project_id`, `highlight`, `description`, `created_at`, `updated_at`) VALUES
(1, 'PR0000000001', 'Closing Project', 'Project is cleared', '2017-01-16 12:58:46', '2017-01-16 12:58:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` enum('Project Admin','Project Coordinator','Stakeholder','Management') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `position`, `remember_token`) VALUES
(1, 'admin1', '$2y$10$zTjKwKiiecq10Hb48Zp8YO76k8/1DeXREx27RhGWgrMnBGD/1F8DG', 'Project Admin 1', 'Project Admin', NULL),
(2, 'coordinator1', '$2y$10$O6pskY1P5bWdIwXQJojCKeFQtwR8bB5g84K.QrsZLz0fS/7OTufV.', 'Project Coordinator 1', 'Project Coordinator', NULL),
(3, 'stakeholder1', '$2y$10$zdFsC.pe.l3ub29bmlspjeJKKBEWBwE.dv9K6/u90Zk9zDYBgA3Ou', 'Stakeholder 1', 'Stakeholder', NULL),
(4, 'management1', '$2y$10$PwmS04swEYqkqea3lajUqeYKdW0dxGc8SKE9.9kOuAzEq4.Y1H0W.', 'Management 1', 'Management', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devices_user_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
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
-- Ketidakleluasaan untuk tabel `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
