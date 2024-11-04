-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 04:27 AM
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
-- Database: `user_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `timeIn` datetime NOT NULL,
  `timeOut` datetime NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `userId`, `timeIn`, `timeOut`, `ip`) VALUES
(1, 1, '2024-11-04 08:58:15', '2024-11-04 08:58:42', '::1'),
(2, 1, '2024-11-04 08:58:48', '2024-11-04 09:00:34', '::1'),
(3, 1, '2024-11-04 09:03:02', '2024-11-04 09:03:06', '::1'),
(4, 1, '2024-11-04 09:03:17', '2024-11-04 09:03:23', '::1'),
(5, 1, '2024-11-04 09:07:28', '2024-11-04 09:10:42', '::1'),
(6, 1, '2024-11-04 09:25:50', '2024-11-04 09:26:03', '::1'),
(7, 1, '2024-11-04 09:26:07', '2024-11-04 09:51:27', '::1'),
(8, 1, '2024-11-04 11:04:23', '2024-11-04 11:08:59', '::1'),
(9, 1, '2024-11-04 11:09:12', '2024-11-04 11:09:20', '::1'),
(10, 2, '2024-11-04 11:09:25', '2024-11-04 11:09:41', '::1'),
(11, 2, '2024-11-04 11:09:44', '2024-11-04 11:09:51', '::1'),
(12, 2, '2024-11-04 11:09:54', '2024-11-04 11:10:13', '::1'),
(13, 2, '2024-11-04 11:10:17', '2024-11-04 11:10:27', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `ucreated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `uupdated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `phone`, `role`, `status`, `token`, `ucreated_at`, `uupdated_at`) VALUES
(1, 'Admin', 'Jake', 'jakemantesnapay@gmail.com', '$2y$10$8Tz/ZZUaK1u3U64TNUzZ.OenIpbbp/DRHiXA11Qo.mMiwGKD6uxR6', '09123456784', 'admin', 'active', '', '2024-11-04 08:57:32', '2024-11-04 11:08:56'),
(2, 'User', 'Sample', 'napayjakem@gmail.com', '$2y$10$TUj5GwtFKBOMsliVnvbQ1.zb0vwUs0LvJzPOG3YEGckMtQjRapIgy', '09123456789', 'user', 'active', '', '2024-11-04 09:54:44', '2024-11-04 11:10:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
