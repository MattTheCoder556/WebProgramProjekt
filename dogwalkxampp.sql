-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 03:55 PM
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
  `dogs_id` int(11) NOT NULL,
  `dog_name` varchar(255) NOT NULL,
  `dog_breed` varchar(255) NOT NULL,
  `dog_age` varchar(255) NOT NULL,
  `dog_bday` date NOT NULL,
  `dog_gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dogs`
--

INSERT INTO `dogs` (`dogs_id`, `dog_name`, `dog_breed`, `dog_age`, `dog_bday`, `dog_gender`) VALUES
(1, 'Lara', 'German Shepard', '12', '2012-03-22', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_lname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_age` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_bday` date NOT NULL,
  `user_gender` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `walkers`
--

CREATE TABLE `walkers` (
  `walker_id` int(11) NOT NULL,
  `walker_fname` varchar(255) NOT NULL,
  `walker_lname` varchar(255) NOT NULL,
  `walker_age` varchar(255) NOT NULL,
  `walker_bday` date NOT NULL,
  `walker_gender` varchar(255) NOT NULL,
  `walker_email` varchar(255) NOT NULL,
  `walker_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`dogs_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `walkers`
--
ALTER TABLE `walkers`
  ADD PRIMARY KEY (`walker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogs`
--
ALTER TABLE `dogs`
  MODIFY `dogs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `walkers`
--
ALTER TABLE `walkers`
  MODIFY `walker_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
