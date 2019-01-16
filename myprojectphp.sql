-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2019 at 12:51 PM
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
(1, 'fdf@hotmail.com', '$2y$10$eR3qI5nAWoHjD.y0GjoiM.upgZC9X43kgXQwoySm/wAi8qhGDmwWS', 'tyyyyyy', 'ytytyt', NULL, 1, NULL, NULL),
(26, 'jim@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'w', 'w', NULL, 0, '2018-12-20 09:34:01', '0000-00-00 00:00:00'),
(29, 'admin@hotmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'work', NULL, 1, '2019-01-09 08:55:37', '2019-01-14 16:22:26');

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
  `sensor_duration` double(8,2) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `waters`
--

INSERT INTO `waters` (`id`, `waterLevel`, `sensor_duration`, `date`, `time`) VALUES
(1, 1.90, 0.00, '2018-11-05', '13:08:06'),
(2, 1.50, 0.00, '2018-11-05', '14:08:06'),
(3, 1.33, 0.00, '2018-11-05', '15:08:06'),
(4, 1.40, 0.00, '2018-11-05', '15:08:06'),
(5, 0.80, 0.00, '2018-11-05', '15:08:06'),
(6, 1.10, 0.00, '2018-11-05', '15:08:06'),
(7, 1.40, 0.00, '2018-11-05', '15:08:06'),
(8, 0.87, 0.00, '2018-11-05', '15:08:06'),
(9, 0.77, 0.00, '2018-11-05', '15:08:06'),
(10, 2.00, 0.00, '2018-12-23', '13:04:02'),
(11, 1.30, 0.00, '2018-09-01', '15:05:01'),
(12, 2.20, 0.00, '2019-01-01', '07:08:00'),
(13, 1.30, 0.00, '2018-09-01', '15:05:01'),
(14, 2.20, 0.00, '2019-01-01', '07:08:00'),
(36, 12.00, 0.00, '2019-01-14', '22:22:08'),
(37, 12.00, 0.00, '2019-01-14', '22:23:11'),
(38, 12.00, 0.00, '2019-01-14', '22:24:13'),
(39, 12.00, 0.00, '2019-01-14', '22:25:15'),
(40, 12.00, 0.00, '2019-01-14', '22:26:17'),
(41, 12.00, 0.00, '2019-01-14', '22:27:19'),
(42, 12.00, 0.00, '2019-01-14', '22:28:22'),
(43, 12.00, 0.00, '2019-01-14', '22:29:24'),
(44, 12.00, 0.00, '2019-01-14', '22:30:26'),
(45, 12.00, 0.00, '2019-01-14', '22:31:28'),
(46, 12.00, 0.00, '2019-01-14', '22:32:31'),
(47, 12.00, 0.00, '2019-01-14', '22:33:33'),
(48, 12.00, 0.00, '2019-01-14', '22:34:36'),
(49, 12.00, 0.00, '2019-01-14', '22:35:38'),
(50, 12.00, 0.00, '2019-01-14', '22:36:40'),
(51, 12.00, 0.00, '2019-01-14', '22:37:43'),
(52, 12.00, 0.00, '2019-01-14', '22:38:45'),
(53, 12.00, 0.00, '2019-01-14', '22:39:47'),
(54, 12.00, 0.00, '2019-01-14', '22:40:50'),
(55, 12.00, 0.00, '2019-01-14', '22:41:52'),
(56, 12.00, 0.00, '2019-01-14', '22:42:54'),
(57, 12.00, 0.00, '2019-01-14', '22:43:56'),
(58, 12.00, 0.00, '2019-01-14', '22:44:59'),
(59, -10.00, 0.00, '2019-01-14', '22:46:01'),
(60, -5.00, 0.00, '2019-01-14', '22:47:03'),
(61, -4.00, 0.00, '2019-01-14', '22:48:05'),
(62, -10.00, 0.00, '2019-01-14', '22:49:08'),
(63, -1.00, 0.00, '2019-01-14', '22:50:13'),
(64, -1.00, 0.00, '2019-01-14', '22:51:16'),
(65, -18.00, 0.00, '2019-01-14', '22:52:18'),
(66, -186.00, 0.00, '2019-01-14', '22:52:33'),
(67, -510.00, 0.00, '2019-01-14', '22:53:35'),
(70, -6.00, 8.00, '2019-01-14', '23:17:05'),
(71, -1553.00, 1555.00, '2019-01-14', '23:17:09'),
(72, -1032.00, 1034.00, '2019-01-14', '23:17:14'),
(73, -510.00, 512.00, '2019-01-14', '23:17:18'),
(74, -507.00, 509.00, '2019-01-14', '23:17:22'),
(75, -1492.00, 1494.00, '2019-01-14', '23:17:27'),
(76, -1554.00, 1556.00, '2019-01-14', '23:17:31'),
(77, -1293.00, 1295.00, '2019-01-14', '23:17:35'),
(78, -9.00, 11.00, '2019-01-14', '23:17:39'),
(79, -10.00, 12.00, '2019-01-14', '23:17:43'),
(80, -10.00, 12.00, '2019-01-14', '23:17:48'),
(81, -10.00, 12.00, '2019-01-14', '23:17:52'),
(82, -10.00, 12.00, '2019-01-14', '23:17:56'),
(83, -10.00, 12.00, '2019-01-14', '23:18:01'),
(84, -10.00, 12.00, '2019-01-14', '23:18:05'),
(85, -10.00, 12.00, '2019-01-14', '23:18:09'),
(86, -10.00, 12.00, '2019-01-14', '23:18:14'),
(87, -10.00, 12.00, '2019-01-14', '23:18:18'),
(88, -11.00, 13.00, '2019-01-14', '23:18:22'),
(89, -1379.00, 1381.00, '2019-01-14', '23:18:26'),
(90, -47.00, 49.00, '2019-01-14', '23:18:30'),
(91, -1026.00, 1028.00, '2019-01-14', '23:18:35'),
(92, -162.00, 164.00, '2019-01-14', '23:18:39'),
(93, -9.00, 11.00, '2019-01-14', '23:18:43'),
(94, -42.00, 44.00, '2019-01-14', '23:18:47'),
(95, -138.00, 140.00, '2019-01-14', '23:18:52'),
(96, -314.00, 316.00, '2019-01-14', '23:18:56'),
(97, -179.00, 181.00, '2019-01-14', '23:19:00'),
(98, -177.00, 179.00, '2019-01-14', '23:19:05'),
(99, -177.00, 179.00, '2019-01-14', '23:19:09'),
(100, -178.00, 180.00, '2019-01-14', '23:19:13'),
(101, -310.00, 312.00, '2019-01-14', '23:19:17'),
(102, -76.00, 78.00, '2019-01-14', '23:19:21'),
(103, -311.00, 313.00, '2019-01-14', '23:19:26'),
(104, -311.00, 313.00, '2019-01-14', '23:19:30'),
(105, -95.00, 97.00, '2019-01-14', '23:19:34'),
(106, -313.00, 315.00, '2019-01-14', '23:19:38'),
(107, -312.00, 314.00, '2019-01-14', '23:19:43'),
(108, -162.00, 164.00, '2019-01-14', '23:19:47'),
(109, -312.00, 314.00, '2019-01-14', '23:19:51'),
(110, -115.00, 315.00, '2019-01-14', '23:19:55'),
(111, -116.00, 316.00, '2019-01-14', '23:20:00'),
(112, -116.00, 316.00, '2019-01-14', '23:20:04'),
(113, -110.00, 310.00, '2019-01-14', '23:20:08'),
(114, -111.00, 311.00, '2019-01-14', '23:20:12'),
(115, -110.00, 310.00, '2019-01-14', '23:20:16'),
(116, 122.00, 78.00, '2019-01-14', '23:20:21');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `waters`
--
ALTER TABLE `waters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;

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
