-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2019 at 01:30 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myprojectphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `process_statuses`
--

CREATE TABLE `process_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUsers` int(10) UNSIGNED DEFAULT NULL,
  `idPumps` int(10) UNSIGNED NOT NULL,
  `idStatus` int(10) UNSIGNED NOT NULL,
  `idWaters` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `process_statuses`
--

INSERT INTO `process_statuses` (`id`, `idUsers`, `idPumps`, `idStatus`, `idWaters`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, NULL),
(2, 1, 1, 2, 2, NULL, NULL),
(3, 1, 1, 3, 3, NULL, NULL),
(4, 29, 1, 9, 8, '2019-01-21 21:07:06', '2019-01-16 18:10:03'),
(5, 29, 1, 9, 8, '2019-01-21 21:07:06', '2019-01-16 18:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `pumps`
--

CREATE TABLE `pumps` (
  `id` int(10) UNSIGNED NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pumps`
--

INSERT INTO `pumps` (`id`, `address`) VALUES
(1, 'สวนมะนาว');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `numstatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `numstatus`) VALUES
(1, 0),
(2, 1),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isadmin` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `lastname`, `api_token`, `isadmin`, `created_at`, `updated_at`) VALUES
(1, 'fdf@hotmail.com', '$2y$10$eR3qI5nAWoHjD.y0GjoiM.upgZC9X43kgXQwoySm/wAi8qhGDmwWS', 'admin', 'JKS', NULL, 1, NULL, NULL),
(26, 'jim@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'w', 'w', NULL, 0, '2018-12-20 09:34:01', '2018-12-20 09:34:01'),
(29, 'admin@hotmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'work', NULL, 1, '2018-12-24 09:28:20', '2018-12-24 09:28:20'),
(30, 't@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'jim', 'myyy', NULL, 0, '2019-01-08 11:37:17', '2019-01-08 11:37:17'),
(31, 'r@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'dddd', 'dd', NULL, 0, '2019-01-08 11:41:49', '2019-01-08 11:41:49'),
(32, 'K@hotmail.com', '698d51a19d8a121ce581499d7b701668', 'myyyy', 'tututututu', NULL, 0, '2019-01-08 12:01:50', '2019-01-08 12:01:50'),
(33, 'M@hotmaill.com', '698d51a19d8a121ce581499d7b701668', 'jim', 'ssssjimmmmmm', NULL, 0, '2019-01-09 00:36:47', '2019-01-09 00:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `idUsers` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `value`, `date`, `time`, `idUsers`) VALUES
(1, 20, '2018-11-05', '13:08:06', 1),
(2, 15, '2018-11-15', '13:08:06', 1),
(3, 20, '2018-12-12', '13:08:06', 1),
(4, 6, '2019-01-08', '13:21:51', 1),
(5, 0, '2019-01-08', '838:59:59', 1),
(6, 0, '2019-01-08', '00:00:00', 1),
(7, 12, '2019-01-08', '13:23:50', 1),
(8, 25, '2019-01-08', '13:24:37', 1),
(9, 12, '2019-01-08', '13:30:27', 1),
(10, 40, '2019-01-08', '19:06:59', 1),
(11, 111, '2019-01-08', '19:08:58', 1),
(12, 2147483647, '2019-01-08', '19:09:15', 1),
(13, 10, '2019-01-09', '07:41:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `waters`
--

CREATE TABLE `waters` (
  `id` int(10) UNSIGNED NOT NULL,
  `waterLevel` double(8,2) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `waters`
--

INSERT INTO `waters` (`id`, `waterLevel`, `date`, `time`) VALUES
(1, 1.90, '2018-11-05', '13:08:06'),
(2, 1.50, '2018-11-05', '14:08:06'),
(3, 1.33, '2018-11-05', '15:08:06'),
(4, 1.40, '2018-11-05', '15:08:06'),
(5, 0.80, '2018-11-05', '15:08:06'),
(6, 1.10, '2018-11-05', '15:08:06'),
(7, 1.40, '2018-11-05', '15:08:06'),
(8, 0.87, '2018-11-05', '15:08:06'),
(9, 0.77, '2018-11-05', '15:08:06'),
(10, 2.00, '2018-12-23', '13:04:02'),
(11, 1.30, '2018-09-01', '15:05:01'),
(12, 2.20, '2019-01-01', '07:08:00'),
(13, 1.30, '2018-09-01', '15:05:01'),
(14, 2.20, '2019-01-01', '07:08:00'),
(15, 1.45, '2019-01-16', '12:10:25'),
(16, 1.22, '2019-01-20', '26:00:00'),
(17, 1.22, '2019-01-16', '12:10:25'),
(18, 1.22, '2019-01-20', '26:00:00'),
(19, 0.96, '2019-01-16', '19:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `process_statuses`
--
ALTER TABLE `process_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `process_statuses_idusers_foreign` (`idUsers`),
  ADD KEY `process_statuses_idpumps_foreign` (`idPumps`),
  ADD KEY `process_statuses_idstatus_foreign` (`idStatus`),
  ADD KEY `process_statuses_idwaters_foreign` (`idWaters`);

--
-- Indexes for table `pumps`
--
ALTER TABLE `pumps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activities_idusers_foreign` (`idUsers`);

--
-- Indexes for table `waters`
--
ALTER TABLE `waters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `process_statuses`
--
ALTER TABLE `process_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pumps`
--
ALTER TABLE `pumps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `waters`
--
ALTER TABLE `waters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `process_statuses`
--
ALTER TABLE `process_statuses`
  ADD CONSTRAINT `process_statuses_idpumps_foreign` FOREIGN KEY (`idPumps`) REFERENCES `pumps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `process_statuses_idstatus_foreign` FOREIGN KEY (`idStatus`) REFERENCES `statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `process_statuses_idusers_foreign` FOREIGN KEY (`idUsers`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `process_statuses_idwaters_foreign` FOREIGN KEY (`idWaters`) REFERENCES `waters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_idusers_foreign` FOREIGN KEY (`idUsers`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
