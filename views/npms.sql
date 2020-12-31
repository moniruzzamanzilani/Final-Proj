-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 10:21 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `npms`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `dates` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `section`, `title`, `description`, `likes`, `dislikes`, `dates`, `status`) VALUES
(4, 'International', ' Air Plan crush', ' chicken', 0, 0, '', 1),
(7, 'Sports', 'Cricket', ' Bangladesh vs India', 0, 0, '2020-11-23', 1),
(8, 'Entertainment', 'funny', ' COMedy Film coming soon', 0, 0, '2020-11-23', 1),
(9, 'Jobs', 'Software engineer', ' Coming soon', 0, 0, '2020-12-08', 1),
(12, 'Politics', 'byden replace', ' hki', 0, 0, '2020-12-08', 1),
(13, 'Jobs', 'ricsha driver', ' lol', 0, 0, '2020-12-09', 1),
(14, 'Politics', 'Awami ', ' ji', 0, 0, '2020-12-22', 0),
(16, 'Sports', 'ludu', ' lost', 0, 0, '2020-12-15', 1),
(17, 'Entertainment', 'qw', ' qw', 0, 0, '2020-12-15', 0),
(18, 'Jobs', 'marketing', ' oi', 0, 0, '2020-12-15', 0),
(19, 'International', 'england', ' lol country', 0, 0, '2020-12-14', 0),
(20, 'Politics', 'Bonding', ' need', 0, 0, '2020-12-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `phone`, `password`, `role`) VALUES
(8, 'reader45', 'raeder45@gmail.com', 45536, 'reader345', 0),
(9, 'admin1', 'admin1@gmail.com', 567764345, 'admin12345', 1),
(13, 'publisher21', 'publisher21@gmail.com', 34556, 'publisher23', 2),
(16, 'admin23', 'admin23@gmail.com', 1, 'admin234567890', 1),
(19, 'admin3', 'admin3@gmail.com', 456333, 'admin123456', 1),
(20, 'auditor4', 'auditor4@gmail.com', 431, 'reader43', 3),
(21, 'reader2', 'reader2@gmail.com', 446474590, 'reader2', 0),
(22, 'admin11', 'admin11@gmail.com', 65775775, 'admin11', 1),
(23, 'auditor6', 'auditor6@gmail.com', 567574, 'auditor6', 3),
(39, 'reader10', 'reader10@gmail.com', 2, 'reader10', 0),
(40, 'auditor23', 'auditor23@gmail.com', 3, 'auditor23', 3),
(41, 'publisher23', 'publisher23@gmail.com', 4, 'publisher23', 2),
(42, 'admin100', 'admin100@gmail.com', 456677, 'admin100', 1),
(43, 'reader99', 'reader99@gmail.com', 32443, 'reader100', 0),
(44, 'tanvir34', 'bantitanvir3@gmail.com', 3467, 'tanvir34', 0),
(46, 'Tanvir_Ahamed_1', 'sharmin.feni65@gmail.com', 2147483647, '56', 0),
(47, '44342', 'kabirdaiyan@gmail.com', 432, '12', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
