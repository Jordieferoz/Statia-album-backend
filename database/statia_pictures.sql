-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2023 at 11:24 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `statia_pictures`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `verification_key` varchar(200) NOT NULL,
  `is_verified` int(200) NOT NULL DEFAULT 0 COMMENT '1 for verified',
  `joined_date` date DEFAULT NULL,
  `joined_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `email`, `password`, `verification_key`, `is_verified`, `joined_date`, `joined_time`) VALUES
(69, 'ADMIN', 'login@statia.com', 'e6a843f441a2f1fe054ea3580963cf9d64c33a61d1c120ab5fac6d63a1c014a7c2c2bc2accbcfa144e64b2b644678978a42e6ed1fb707f580838fd2b3f984e50k5gVayoN4hUuygfVJEAPrcUrduo+NOxDhTnJZgJEbNY=', 'ae3148314a8cde674623343f4b3dbeae', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(200) NOT NULL,
  `category` varchar(200) DEFAULT NULL,
  `file_name` varchar(200) NOT NULL,
  `added_date` date DEFAULT NULL,
  `added_time` time DEFAULT NULL,
  `is_active` int(200) NOT NULL DEFAULT 1 COMMENT '0 for inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `file_name`, `added_date`, `added_time`, `is_active`) VALUES
(1, 'Testf', '171997528564ca3d11d4c465155395d6.png', '2023-05-03', '23:37:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(200) NOT NULL,
  `user_id` int(200) DEFAULT NULL,
  `user_role` varchar(200) DEFAULT NULL,
  `os` varchar(200) DEFAULT NULL,
  `browser` varchar(200) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `login_date` date DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  `status` int(200) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `user_role`, `os`, `browser`, `ip`, `login_date`, `login_time`, `status`) VALUES
(1, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-03', '23:15:35', 1),
(2, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-03', '23:17:02', 1),
(3, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-03', '23:25:18', 1),
(4, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-06', '15:46:37', 1),
(5, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-08', '12:53:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `file_type` varchar(200) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `full_path` varchar(200) DEFAULT NULL,
  `raw_name` varchar(200) DEFAULT NULL,
  `orig_name` varchar(200) DEFAULT NULL,
  `client_name` varchar(200) DEFAULT NULL,
  `file_ext` varchar(200) DEFAULT NULL,
  `file_size` decimal(55,2) DEFAULT NULL,
  `is_image` int(11) DEFAULT NULL,
  `image_width` int(11) DEFAULT NULL,
  `image_height` int(11) DEFAULT NULL,
  `image_type` varchar(200) DEFAULT NULL,
  `total_views` int(100) NOT NULL DEFAULT 0,
  `remote_address` varchar(100) DEFAULT NULL,
  `last_update_remote` varchar(200) DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  `added_time` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
