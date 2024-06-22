-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2024 at 01:35 AM
-- Server version: 8.0.37-0ubuntu0.20.04.3
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duke`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogs`
--

CREATE TABLE `dogs` (
  `d_id` int NOT NULL,
  `d_pic` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `d_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `d_breed` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `d_gender` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `d_age` int NOT NULL,
  `d_desc` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `walk_day` date DEFAULT NULL,
  `booked_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dogs`
--

INSERT INTO `dogs` (`d_id`, `d_pic`, `d_name`, `d_breed`, `d_gender`, `d_age`, `d_desc`, `walk_day`, `booked_by`) VALUES
(1, 'Screenshot 2024-02-11 181045.png', 'Draagon', 'Dargon', 'Male', 500, 'Ladle', '2024-06-25', 64),
(2, 'Screenshot 2024-01-15 195726.png', 'Test', 'Test', 'Test', 25, '', '2024-06-26', 0),
(3, 'Screenshot 2024-02-15 214725.png', 'Test', 'Fly', 'Fly', 5, 'This is a fly testing id it works\r\n', NULL, 0),
(4, 'IMG_20240514_125721.jpg', 'Snek', 'Macaroni', 'Menace', 2, 'Menace', NULL, 0),
(6, 'game1.jpg', 'Test', 'Test', 'Test', 1, 'TesT', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `walker_id` int NOT NULL,
  `rating` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `walker_id`, `rating`) VALUES
(1, 58, 58, 5),
(3, 64, 58, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int NOT NULL,
  `u_pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default_pic.jpg',
  `u_fname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `u_lname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `u_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `u_pass` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `u_phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `u_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `walk_switch` tinyint(1) NOT NULL,
  `registration_token` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint NOT NULL,
  `forgotten_password_token` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `forgotten_password_expires` datetime DEFAULT NULL,
  `is_banned` smallint NOT NULL DEFAULT '0',
  `u_rating` int NOT NULL DEFAULT '0',
  `activity_column` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_pic`, `u_fname`, `u_lname`, `u_email`, `u_pass`, `u_phone`, `u_address`, `walk_switch`, `registration_token`, `registration_expires`, `active`, `forgotten_password_token`, `forgotten_password_expires`, `is_banned`, `u_rating`, `activity_column`) VALUES
(58, 'JDJr.png', 'Máté', 'Matt', 'mucsimate07@gmail.com', '$2y$10$0B5hjXPhTOvS2B5HDNspLOeMSnICOLj57JaP68YgZbzKJJAGRS8US', '0652099422', 'Takacs Istvan 2', 1, '', '0000-00-00 00:00:00', 1, '', '2024-06-21 15:00:52', 0, 0, 0),
(64, 'JaD.png', 'Máté', 'Yahoo', 'mucsimate07@yahoo.com', '$2y$10$0vocWA0XxHvmrQ4y9YbkBuwMhXdFiv9CWHmlp10yEmJcL90rYblhy', '0652099422', 'Test Address 4', 1, '71c1c8ac3d4ae21400d8a4a0275eff798359f893', '2024-06-21 22:30:28', 1, '', '2024-06-22 01:38:28', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usersCHOLE`
--

CREATE TABLE `usersCHOLE` (
  `id_user` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `firstname` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` char(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint NOT NULL DEFAULT '0',
  `new_password` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code_password` char(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `new_password_expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `usersCHOLE`
--

INSERT INTO `usersCHOLE` (`id_user`, `username`, `firstname`, `lastname`, `password`, `email`, `code`, `registration_expires`, `active`, `new_password`, `code_password`, `new_password_expires`) VALUES
(2, 'vts', 'vts', 'vts', '', 'vts@gmail.com', '', '2018-12-06 13:52:22', 1, '', '', '0000-00-00 00:00:00'),
(3, 'vts2', 'vts', '', '', 'vts@vtsss.com', '', '2018-12-25 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(4, 'vts2', 'vts', '', '', 'vts@vtsss.com', '', '2018-12-25 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(5, 'vts2', 'vts', '', '', 'vts@vtsss.com', '', '2018-12-25 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(6, 'vts2', 'vts', '', '', 'vts@vtsss.com', '', '2018-12-25 20:22:43', 1, '', '', '0000-00-00 00:00:00'),
(7, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-25 20:23:37', 1, '', '', '0000-00-00 00:00:00'),
(8, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-25 20:24:55', 1, '', '', '0000-00-00 00:00:00'),
(9, 'vts1', 'vts1fn', 'vts1ln', '', 'vts1@vts.com', '', '2019-01-01 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(10, 'vts2', 'vts2fn', 'vts2ln', '', 'vts2@vts.com', '', '2019-01-01 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(12, 'vts1', 'vts1fn', 'vts1ln', '', 'vts1@vts.com', '', '2019-01-01 10:00:00', 1, '', '', '0000-00-00 00:00:00'),
(13, 'vts2', 'vts2fn', 'vts2ln', '', 'vts2@vts.com', '', '2019-01-02 11:00:00', 1, '', '', '0000-00-00 00:00:00'),
(15, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:46:16', 1, '', '', '0000-00-00 00:00:00'),
(16, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:49', 1, '', '', '0000-00-00 00:00:00'),
(17, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:52', 1, '', '', '0000-00-00 00:00:00'),
(18, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:52', 1, '', '', '0000-00-00 00:00:00'),
(19, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:53', 1, '', '', '0000-00-00 00:00:00'),
(20, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:53', 1, '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usersCHOLE2`
--

CREATE TABLE `usersCHOLE2` (
  `id_user` int NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `firstname` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `registration_token` char(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `registration_expires` datetime DEFAULT NULL,
  `active` smallint NOT NULL DEFAULT '0',
  `forgotten_password_token` char(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `forgotten_password_expires` datetime DEFAULT NULL,
  `is_banned` smallint NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `usersCHOLE2`
--

INSERT INTO `usersCHOLE2` (`id_user`, `email`, `password`, `firstname`, `lastname`, `registration_token`, `registration_expires`, `active`, `forgotten_password_token`, `forgotten_password_expires`, `is_banned`, `date_time`) VALUES
(5, 'test@gg.com', '$2y$10$H52TYAJz18/k.BCRbcAmZeb/NWlsy92irFN5onfbgaK84.recFTG.', 'test2', 'test2', '', '0000-00-00 00:00:00', 0, NULL, NULL, 0, '2024-03-18 08:27:30'),
(6, 'test@test.com', '$2y$10$H52TYAJz18/k.BCRbcAmZeb/NWlsy92irFN5onfbgaK84.recFTG.', 'test', 'test', '8b0c088271ca11b7d97d668e7140c57d352f8049', '2023-05-16 20:17:31', 0, NULL, NULL, 0, '2024-03-18 08:27:30'),
(7, 'test@tt.com', '$2y$10$H52TYAJz18/k.BCRbcAmZeb/NWlsy92irFN5onfbgaK84.recFTG.', 'tt', 'tt', '7ea920f5a6059a4f57f66aea148a2c922230cb6f', '2023-05-16 20:18:17', 0, NULL, NULL, 0, '2024-03-18 08:27:30'),
(8, 'AA@A.com', '$2y$10$H52TYAJz18/k.BCRbcAmZeb/NWlsy92irFN5onfbgaK84.recFTG.', 'yu', 'yuy', 'b363640b0ee8a540b88325b74cca6db7e4aa6961', '2023-05-16 20:19:16', 0, NULL, NULL, 0, '2024-04-02 17:34:32'),
(9, 'aa@a.com', '$2y$10$6bf4ImMSyruR86gAnKUjFuudISqGDMhH3/BfafGawbbCUBqZH5K22', 'aa', 'aa', '6c7c525b0d444fd9b4149635edcc9665b72382e5', '2023-05-22 19:07:43', 0, 'cbccbbb8fa8d06d126d815016b18ed22b73e999a', '2023-05-22 03:32:17', 0, '2023-05-21 21:32:17'),
(10, 'bb@b.com', '$2y$10$K3Lj1AjHOoCUd3cmhIjGJORPlmPtMy0e14yxO7qCzhWmaurnELu6C', 'bb', 'bb', '', '0000-00-00 00:00:00', 1, NULL, NULL, 0, '2023-05-21 19:09:10'),
(11, 'fdfd@gg.com', '$2y$10$b0qLPJvppC1Wke8HHYK5a.8Zsd52krYDgTgZ2wlFPUY0lcAm1SpwO', 'tete', 'tete', '08d021e5432627c70ea43b868f89cd1ab259b905', '2023-05-23 06:34:02', 0, NULL, NULL, 0, '2023-05-22 06:34:02'),
(12, 'jj@jj.com', '$2y$10$HyY/o7HzzhVRznUQdx7CaevKBmD/SFT292ABeWdDr63NUAq30oyTW', 'j', 'j', '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, '2023-05-22 07:49:38'),
(13, 'bb@bb.com', '$2y$10$BRAuMgGfYH9HdMNcH34hh.9oz4Bzio5a7T/tVGN53MnzP7jXC14KC', 'bb', 'bb', '', '0000-00-00 00:00:00', 1, '995ad920b194dc860da6cb8b6e54040850057698', '2023-05-22 17:06:46', 0, '2023-05-22 11:06:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_rating` (`user_id`,`walker_id`),
  ADD KEY `walker_id` (`walker_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `usersCHOLE`
--
ALTER TABLE `usersCHOLE`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `usersCHOLE2`
--
ALTER TABLE `usersCHOLE2`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogs`
--
ALTER TABLE `dogs`
  MODIFY `d_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `usersCHOLE`
--
ALTER TABLE `usersCHOLE`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `usersCHOLE2`
--
ALTER TABLE `usersCHOLE2`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`walker_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
