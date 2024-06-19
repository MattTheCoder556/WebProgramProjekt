-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 01:52 AM
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
-- Database: `dogwalkxampp`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogs`
--

CREATE TABLE `dogs` (
  `d_id` int(11) NOT NULL,
  `d_pic` varchar(255) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `d_breed` varchar(255) NOT NULL,
  `d_gender` varchar(255) NOT NULL,
  `d_age` int(11) NOT NULL,
  `d_desc` varchar(255) NOT NULL,
  `walk_day` date DEFAULT NULL,
  `booked_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dogs`
--

INSERT INTO `dogs` (`d_id`, `d_pic`, `d_name`, `d_breed`, `d_gender`, `d_age`, `d_desc`, `walk_day`, `booked_by`) VALUES
(1, 'Screenshot 2024-02-11 181045.png', 'Draagon', 'Dargon', 'Male', 500, 'Ladle', '2024-06-20', 0),
(2, 'Screenshot 2024-01-15 195726.png', 'Test', 'Test', 'Test', 25, '', '2024-06-26', 0),
(3, 'Screenshot 2024-02-15 214725.png', 'Test', 'Fly', 'Fly', 5, 'This is a fly testing id it works\r\n', NULL, 0),
(4, 'IMG_20240514_125721.jpg', 'Snek', 'Macaroni', 'Menace', 2, 'Menace', NULL, 0),
(6, 'game1.jpg', 'Test', 'Test', 'Test', 1, 'TesT', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `walker_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `walker_id`, `rating`) VALUES
(1, 58, 58, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_pic` varchar(255) NOT NULL,
  `u_fname` varchar(255) NOT NULL,
  `u_lname` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `u_phone` varchar(255) NOT NULL,
  `u_address` varchar(255) NOT NULL,
  `walk_switch` tinyint(1) NOT NULL,
  `registration_token` char(40) NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint(1) NOT NULL,
  `forgotten_password_token` char(40) NOT NULL,
  `forgotten_password_expires` datetime NOT NULL,
  `is_banned` smallint(1) NOT NULL,
  `u_rating` int(11) NOT NULL,
  `activity_column` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_pic`, `u_fname`, `u_lname`, `u_email`, `u_pass`, `u_phone`, `u_address`, `walk_switch`, `registration_token`, `registration_expires`, `active`, `forgotten_password_token`, `forgotten_password_expires`, `is_banned`, `u_rating`, `activity_column`) VALUES
(58, 'testPic.jpeg', 'Máté', 'Matt', 'mucsimate07@gmail.com', '$2y$10$bCilHTeBlHIwpTLpr9xXruwBH2M/VQRQHOF7CVNRI8GPXwvzLESQC', '0652099422', 'Takacs Istvan 2', 1, '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, 0, 0),
(59, '', 'Máté', 'Yahoo', 'mucsimate07@yahoo.com', '$2y$10$zGMQGSZrMabAgf3ILrhSH.IgiX0ErRXzDc5ZR3An4kx6fC6U9XncW', '0652099422', 'Test Address 2', 0, '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, 0, 0);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogs`
--
ALTER TABLE `dogs`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
