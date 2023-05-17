-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 04:59 PM
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
(1, 'Testf', '171997528564ca3d11d4c465155395d6.png', '2023-05-03', '23:37:59', 1),
(2, 'Other', '171997528564ca3d11d4c465155395d6.png', '2023-05-03', '23:37:59', 1),
(3, 'Rohit', '171997528564ca3d11d4c465155395d6.png', '2023-05-03', '23:37:59', 1);

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
(5, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-08', '12:53:21', 1),
(6, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-09', '12:59:14', 1),
(7, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-10', '12:40:12', 1),
(8, 1526, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '17:35:41', 1),
(9, 1526, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '17:36:24', 1),
(10, 1526, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '17:36:39', 1),
(11, 1526, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '18:00:22', 1),
(12, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '18:13:38', 1),
(13, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '18:14:26', 1),
(14, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-11', '18:15:04', 1),
(15, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-11', '18:29:00', 1),
(16, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '18:50:01', 1),
(17, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '18:58:08', 1),
(18, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '19:00:06', 1),
(19, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '19:01:42', 1),
(20, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-11', '19:04:17', 1),
(21, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-12', '13:06:26', 1),
(22, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-12', '18:11:56', 1),
(23, 69, 'ADMIN', 'Windows 10', 'Chrome', '::1', '2023-05-12', '18:58:26', 1),
(24, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-13', '13:44:59', 1),
(25, 1, 'USER', 'Windows 10', 'Chrome', '::1', '2023-05-13', '14:09:39', 1);

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
  `thumbnail_path` varchar(200) DEFAULT NULL,
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
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `category_id`, `user_id`, `title`, `description`, `file_name`, `thumbnail_path`, `file_type`, `file_path`, `full_path`, `raw_name`, `orig_name`, `client_name`, `file_ext`, `file_size`, `is_image`, `image_width`, `image_height`, `image_type`, `total_views`, `remote_address`, `last_update_remote`, `added_date`, `added_time`, `status`) VALUES
(34, 3, 69, 'New 1', '<p>dkjfgh</p>\r\n<p>&nbsp;</p>', 'e452c6a67814d7dc58ea07ddbabe1988.png', NULL, 'image/png', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/e452c6a67814d7dc58ea07ddbabe1988.png', 'e452c6a67814d7dc58ea07ddbabe1988', 'Screenshot_(2).png', 'Screenshot (2).png', '.png', '431.02', 1, 1920, 1080, 'png', 1, '::1', '::1', '2023-05-09', '13:33:55', 1),
(35, 2, 69, 'e', '<p>dfgdfg</p>\r\n<p>&nbsp;</p>', 'c89df1c0948ea5b54b5639b194a81daa.mp4', NULL, 'video/mp4', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/c89df1c0948ea5b54b5639b194a81daa.mp4', 'c89df1c0948ea5b54b5639b194a81daa', 'WhatsApp_Video_2022-10-03_at_21_11_45.mp4', 'WhatsApp Video 2022-10-03 at 21_11_45.mp4', '.mp4', '8639.85', 0, NULL, NULL, '', 0, '::1', '::1', '2023-05-09', '13:43:07', 1),
(36, 2, 69, 'f', '<p>dff</p>\r\n<p>&nbsp;</p>', '7a1468e39a3d656bdcf175416e25a5a5.png', NULL, 'image/png', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/7a1468e39a3d656bdcf175416e25a5a5.png', '7a1468e39a3d656bdcf175416e25a5a5', 'Screenshot_(3).png', 'Screenshot (3).png', '.png', '381.08', 1, 1920, 1080, 'png', 0, '::1', '::1', '2023-05-09', '14:10:36', 1),
(37, 2, 69, 'New 1', '<p>dkjfgh</p>\r\n<p>&nbsp;</p>', 'e452c6a67814d7dc58ea07ddbabe1988.png', NULL, 'image/png', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/e452c6a67814d7dc58ea07ddbabe1988.png', 'e452c6a67814d7dc58ea07ddbabe1988', 'Screenshot_(2).png', 'Screenshot (2).png', '.png', '431.02', 1, 1920, 1080, 'png', 0, '::1', '::1', '2023-05-09', '13:33:55', 0),
(38, 1, 69, 'gdfg234456789', '<p>dfgdfg</p>\r\n<p>&nbsp;</p>', 'c89df1c0948ea5b54b5639b194a81daa.mp4', 'ac573340d400b850d57164255e86fafb.png', 'video/mp4', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/c89df1c0948ea5b54b5639b194a81daa.mp4', 'c89df1c0948ea5b54b5639b194a81daa', 'WhatsApp_Video_2022-10-03_at_21_11_45.mp4', 'WhatsApp Video 2022-10-03 at 21_11_45.mp4', '.mp4', '8639.85', 0, NULL, NULL, '', 0, '::1', '::1', '2023-05-09', '13:43:07', 0),
(39, 1, 69, '234', '<p>dff</p>\r\n<p>&nbsp;</p>', '7a1468e39a3d656bdcf175416e25a5a5.png', NULL, 'image/png', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/7a1468e39a3d656bdcf175416e25a5a5.png', '7a1468e39a3d656bdcf175416e25a5a5', 'Screenshot_(3).png', 'Screenshot (3).png', '.png', '381.08', 1, 1920, 1080, 'png', 6, '::1', '::1', '2023-05-09', '14:10:36', 1),
(40, 1, 69, 'dkfj', '<p>hkjh</p>\r\n<p>&nbsp;</p>', '37bc588defe3bf2585974ac52f6a337c.mp4', 'ac573340d400b850d57164255e86fafb.png', 'video/mp4', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/37bc588defe3bf2585974ac52f6a337c.mp4', '37bc588defe3bf2585974ac52f6a337c', 'VID-20220605-WA0082.mp4', 'VID-20220605-WA0082.mp4', '.mp4', '5284.23', 0, NULL, NULL, '', 0, '::1', NULL, '2023-05-10', '12:48:46', 1),
(41, 1, 69, 'kh', '<p>kjhkj</p>\r\n<p>&nbsp;</p>', '94d45cdbaaf2a19ae13a7ef320609cea.mp4', NULL, 'video/mp4', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/94d45cdbaaf2a19ae13a7ef320609cea.mp4', '94d45cdbaaf2a19ae13a7ef320609cea', 'VID-20220605-WA0082.mp4', 'VID-20220605-WA0082.mp4', '.mp4', '5284.23', 0, NULL, NULL, '', 3, '::1', NULL, '2023-05-10', '12:49:29', 1),
(42, 1, 69, 'dsfsdsd23', '<p>fg</p>\r\n<p>&nbsp;</p>', 'c89df1c0948ea5b54b5639b194a81daa.mp4', 'd0f842b074330bc0d0cc99679964637b.png', 'video/mp4', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/c4ddf15870bd930013117e330adc3dda.mp4', 'c4ddf15870bd930013117e330adc3dda', 'VID-20220605-WA0082.mp4', 'VID-20220605-WA0082.mp4', '.mp4', '5284.23', 0, NULL, NULL, '', 12, '::1', '::1', '2023-05-10', '12:50:13', 1),
(43, 3, 69, 'Newest', '<p>dkfj</p>\r\n<p>&nbsp;</p>', '974b40573c5a14ac248017e351bb2d8a.png', NULL, 'image/png', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/photos/974b40573c5a14ac248017e351bb2d8a.png', '974b40573c5a14ac248017e351bb2d8a', 'Screenshot_(8).png', 'Screenshot (8).png', '.png', '390.38', 1, 1920, 1080, 'png', 62, '::1', NULL, '2023-05-10', '13:46:59', 1),
(44, 3, 69, 'New Video Test', '<p>111test</p>\r\n<p>&nbsp;</p>', '0b2f48c3c588bd6feb53b887eedc6e94.mp4', '39261a2047052de1492b794e6d2990b3.png', 'video/mp4', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/', 'C:/xampp/htdocs/statia-admin-ui/uploads/videos/0b2f48c3c588bd6feb53b887eedc6e94.mp4', '0b2f48c3c588bd6feb53b887eedc6e94', '(23)_Class_9_Science___Matter_in_Our_Surroundings___Chapter_1___Properties_of_Solids_Liquids_and_Gases_-_YouTube_-_Google_Chrome_2023-03-03_15-24-05.mp4', '(23) Class 9 Science _ Matter in Our Surroundings _ Chapter 1 _ Properties of Solids Liquids and Gases - YouTube - Google Chrome 2023-03-03 15-24-05.mp4', '.mp4', '18209.81', 0, NULL, NULL, '', 4, '::1', NULL, '2023-05-12', '19:01:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `otp` varchar(200) NOT NULL,
  `verification_key` varchar(200) NOT NULL,
  `joined_date` date NOT NULL,
  `joined_time` time NOT NULL,
  `identified_remote` varchar(200) DEFAULT NULL,
  `asked_recovery` int(11) NOT NULL DEFAULT 0,
  `recovery_otp` varchar(200) DEFAULT NULL,
  `recovery_key` varchar(200) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `otp`, `verification_key`, `joined_date`, `joined_time`, `identified_remote`, `asked_recovery`, `recovery_otp`, `recovery_key`, `is_verified`, `is_active`) VALUES
(1, 'Rohit Sahu', '8402081402', 'rohitsahu728@gmail.com', '6ba1c5f09d3fe1417119bd2215b20dfbab2ecb9f8f254728e7d987b24e67fe41624e68cd90939b2b0cefeb27da0f421b3aaf8b4df4d85f5930b56357ec55b6c4dOsh7Nvu0T29/Ug1949KLQLT0vnJxOJ26p4MO7d3gIs=', '766187', 'd0b32d7c237e877725139dc5b42e9696', '2023-05-11', '18:12:36', NULL, 1, '598990', NULL, 1, 1);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
