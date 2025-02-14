-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2025 at 08:01 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(5, 'sports', 'football', '0', '2025-02-06 23:28:27', '2025-02-06 23:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('0','1') DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `description`, `status`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(38, 'm', 'o', '1', 4, 5, '2025-02-07 10:58:21', '2025-02-07 11:47:52'),
(41, 'kkkkkkkk', 'pppppppppp', '0', 3, 5, '2025-02-07 11:23:36', NULL),
(42, 'kkkkkkkk', 'pppppppppp', '0', 3, 5, '2025-02-07 11:24:34', '2025-02-08 09:12:28'),
(43, 'kkkkkkkk', 'pppppppppp', '0', 3, 5, '2025-02-07 11:34:28', NULL),
(44, 'kkkkkkkk', 'pppppppppp', '1', 3, 5, '2025-02-07 11:47:35', '2025-02-08 09:12:03'),
(45, 'kkkkkkkk', 'pppppppppp', '0', 3, 5, '2025-02-08 09:10:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `report` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `report`, `post_id`, `created_at`) VALUES
(26, '', 38, '2025-02-07 11:48:17'),
(28, '', 42, '2025-02-07 11:48:21'),
(30, '', 38, '2025-02-07 11:48:26'),
(32, '', 42, '2025-02-07 11:48:31'),
(34, '', 38, '2025-02-07 11:48:35'),
(36, '', 42, '2025-02-07 11:48:40'),
(37, '', 38, '2025-02-07 11:48:43'),
(39, '', 42, '2025-02-07 11:48:48'),
(40, 'mmm', 44, '2025-02-08 09:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `role` enum('user','admin','author') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$CCSgK39focNY7orD6BzKBO6O/kZRy9akXwbU.1tve50QMtWAHE5jm', '1', 'admin', '2025-02-04 21:12:19', '2025-02-07 11:39:50'),
(2, 'admin', 'admin2@gmail.com', '$2y$10$XZpYelGTQDXaThRToPGC/e3fuTBKoYg4NqCkoEWlNE9UtlOl4IhJS', '0', 'admin', '2025-02-04 21:47:29', '2025-02-04 21:48:51'),
(3, 'author', 'author@gmail.com', '$2y$10$Mbsm7DGjmbovCfH7VYeQiO63oHznH4VkjLsrxmre1DcxvFRec4jhy', '1', 'author', '2025-02-04 21:47:42', '2025-02-08 09:11:33'),
(4, 'user', 'user@gmail.com', '$2y$10$rSOWt3aZotUsKc.MXDXHPOgGejk50LyuT7XNurkcuxp.176ORLci6', '1', 'user', '2025-02-04 21:47:57', '2025-02-04 21:48:09'),
(5, 'author', 'author2@gmail.com', '$2y$10$xWG9j392iHz0kNAqMS1DPeiZTi1pKJxIDKWXECjfkrzuXwht69JT2', '1', 'author', '2025-02-07 08:32:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `relation1` (`user_id`),
  ADD KEY `relation2` (`category_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name2` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2798;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `relation1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relation2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `name2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
