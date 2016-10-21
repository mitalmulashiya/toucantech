-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2016 at 07:08 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toucantech`
--

-- --------------------------------------------------------

--
-- Table structure for table `members_info`
--

CREATE TABLE IF NOT EXISTS `members_info` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `add_date` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `members_info`
--

INSERT INTO `members_info` (`id`, `name`, `email`, `add_date`) VALUES
(21, 'Mital', 'mital.ndinfosys@gmail.com', 1474624043),
(22, 'Mital', 'mita@ndinfosys.com', 1474624063),
(23, 'Nilesh', 'nilesh@ndinfosys.com', 1474631773),
(24, 'Nilesh', 'nilesh1@ndinfosys.com', 1474631852),
(25, 'mital', 'mital1@ndinfosys.com', 1474631921),
(26, ';'' asiod fsadf''', 'ban@ban.com', 1474632823),
(27, 'mital', 'mital12@ndinfosys.com', 1474638212),
(28, 'james', 'mital@ndinfosys.com', 1477067496),
(29, 'james', 'nn@pelican.com', 1477067683),
(30, 'axy', 'aaa.aa@g.com', 1477068376);

-- --------------------------------------------------------

--
-- Table structure for table `mermber_school`
--

CREATE TABLE IF NOT EXISTS `mermber_school` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `school_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mermber_school`
--

INSERT INTO `mermber_school` (`id`, `user_id`, `school_id`) VALUES
(10, 21, 2),
(11, 22, 2),
(12, 22, 4),
(13, 23, 1),
(14, 23, 2),
(15, 24, 1),
(16, 24, 2),
(17, 25, 2),
(18, 26, 3),
(19, 26, 4),
(20, 27, 3),
(21, 27, 4),
(22, 29, 3),
(23, 29, 4),
(24, 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `school_id` int(10) unsigned NOT NULL,
  `school_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_name`, `active`) VALUES
(1, 'Monega School', 1),
(2, 'Shaftsbury School', 1),
(3, 'Elmhurts School', 1),
(4, 'Abc Learning School', 1),
(5, 'Bestbudies School', 1),
(6, 'Canon School', 1),
(7, 'Newstyle School', 1),
(8, 'Littleone School', 1),
(9, 'Metro School', 1),
(10, 'Newham School', 1),
(11, 'Access School', 1),
(12, 'Brillient School', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members_info`
--
ALTER TABLE `members_info`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `mermber_school`
--
ALTER TABLE `mermber_school`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_id` (`user_id`,`school_id`), ADD KEY `school_info` (`school_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members_info`
--
ALTER TABLE `members_info`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `mermber_school`
--
ALTER TABLE `mermber_school`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mermber_school`
--
ALTER TABLE `mermber_school`
ADD CONSTRAINT `school_info` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `school_member` FOREIGN KEY (`user_id`) REFERENCES `members_info` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
