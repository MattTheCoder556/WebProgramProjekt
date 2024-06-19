-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 02:38 PM
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
  `d_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dogs`
--

INSERT INTO `dogs` (`d_id`, `d_pic`, `d_name`, `d_breed`, `d_gender`, `d_age`, `d_desc`) VALUES
(1, 'Screenshot 2024-02-11 181045.png', 'Draagon', 'Dargon', 'Male', 500, 'Ladle'),
(2, 'Screenshot 2024-01-15 195726.png', 'Test', 'Test', 'Test', 25, ''),
(3, 'Screenshot 2024-02-15 214725.png', 'Test', 'Fly', 'Fly', 5, 'This is a fly testing id it works\r\n'),
(4, 'IMG_20240514_125721.jpg', 'Snek', 'Macaroni', 'Menace', 2, 'Menace');

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
  `u_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_pic`, `u_fname`, `u_lname`, `u_email`, `u_pass`, `u_phone`, `u_address`, `walk_switch`, `registration_token`, `registration_expires`, `active`, `forgotten_password_token`, `forgotten_password_expires`, `is_banned`, `u_rating`) VALUES
(54, '', 'Máté', 'Yahoo', 'mucsimate07@yahoo.com', '$2y$10$pczMeAPudNdbPuJD8NYlCe48Lp94yLKPGk03DvO68dxj5K1sPU/BS', '0652099422', 'Test Address 4', 1, '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, 0),
(56, '', 'Máté', 'Mucsi', 'mucsimate07@gmail.com', '$2y$10$jaL4RqlKQAG/.nKlK71J8..vtYSn1jkTQss0RNW66QnUk81IxNFHq', '0652099422', 'Test Address 2', 1, '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`d_id`);

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
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
