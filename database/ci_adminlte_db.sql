-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2017 at 11:12 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_adminlte_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_users`
--

DROP TABLE IF EXISTS `ci_users`;
CREATE TABLE IF NOT EXISTS `ci_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_no` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `last_ip` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_users`
--

INSERT INTO `ci_users` (`id`, `username`, `firstname`, `lastname`, `email`, `mobile_no`, `password`, `role`, `is_active`, `is_admin`, `last_ip`, `created_at`, `updated_at`) VALUES
(3, 'Admin', 'admin', 'admin', 'admin@admin.com', '12345', '$2y$10$kqiwRiCcIBsS/i0FC9k3YOE.sSVgu/PKCcO.baV8T4EDru4.qMXrS', 1, 1, 1, '', '2017-09-29 10:09:44', '2017-10-17 10:10:55'),
(15, 'demo3', 'test', 'test', 'test2@gmai.com', '12345', '$2y$10$1rzqcv/3K1EUlF2J1zgDiuS3nIN6/YLZ1ABLuMiZysFDTCkcyJuTC', 1, 0, 0, '', '2017-10-12 07:10:10', '2017-10-17 11:10:04'),
(16, 'demo4', 'test', 'test', 'test3@gmai.com', '12345', '$2y$10$a7GTZPFtVK05ldiI9gYfgunfQHZfalAO/syWItjnhiyahXbfNcWoy', 2, 1, 0, '', '2017-10-12 07:10:10', '2017-10-17 11:10:12'),
(17, 'demo5', 'test', 'test', 'test4@gmai.com', '12345', '$2y$10$iQW7TKdrHNnl3jDtjYBadOxTuWRBdBcZhk2lxZ2lrIX1M4uJu6pFO', 4, 1, 0, '', '2017-10-12 07:10:10', '2017-10-17 11:10:17'),
(18, 'demo6', 'test', 'test', 'test5@gmai.com', '12345', '$2y$10$UEkLtiOP8Lt13vwC8KXsKOOJMnWukPPP7L/NJIpFn49rQKuA6oXD6', 1, 1, 0, '', '2017-10-12 07:10:10', '2017-10-17 11:10:24'),
(19, 'demo7', 'test', 'test', 'test6@gmai.com', '12345', '$2y$10$GSVyEzAbMjdhONCVPevbGOMAjzSGpPk62pg58W8DtG4PCSdTF5Ooy', 1, 0, 0, '', '2017-10-12 07:10:10', '2017-10-17 11:10:30'),
(20, 'demo8', 'test', 'test', 'test7@gmai.com', '12345', '$2y$10$6415cSa21VXXyD3vsaPwyepPyaDpPMgOJkPbZMt/AtKvNx5hRxbLy', 2, 1, 0, '', '2017-10-12 07:10:10', '2017-10-17 11:10:39'),
(21, 'demo9', 'test', 'test', 'test8@gmai.com', '12345', '$2y$10$.4.73sLxhwRHYZoSxbFTMu/iaKHgDYJqz9Lx3js6dmlJxZMuPG8AG', 1, 0, 0, '', '2017-10-12 07:10:10', '2017-10-17 11:10:47'),
(22, 'demo10', 'test', 'test', 'test9@gmai.com', '12345', '$2y$10$.Rr.YeXQ/M4QJ031O3r2k.Tc2ztOvRfCsG2EjYUxY.KZ96WjwR57O', 1, 1, 0, '', '2017-10-12 07:10:10', '2017-10-17 11:10:53'),
(23, 'demo11', 'test', 'test', 'test10@gmai.com', '12345', '$2y$10$cyuI4z5NWt/S1X9Z3vOgWuDKm/ZJGOPy72kZHrrOP0TisXobhaIri', 2, 1, 0, '', '2017-10-12 07:10:10', '2017-10-17 11:10:00'),
(24, 'demo12', 'test', 'test', 'test1@gmai.com', '12345', '$2y$10$JlHihhr5LiGtx7rwZYbLLefdmi3JACN/yDkoJKWWESwELAGFeWOWe', 4, 1, 0, '', '2017-10-12 07:10:10', '2017-10-13 10:10:22'),
(25, 'rizwan', 'rizwan', 'shahid', 'rizwan@gmail.com', '12345', '$2y$10$HdgLtow.ZkitfcEj9rs.9e4yVRFl4LDoXiqonceKnyaXBslPWMh5q', 4, 1, 0, '', '2017-10-13 09:10:37', '2017-10-17 11:10:56'),
(27, 'wwe', 'wwe', 'test', 'test1@gmail.com', '123456', '$2y$10$d6hK4XEEg5.igyWFye5XrO3S813HDZy3Tr5QwrCPSgr2aVQ2eOD8y', 1, 1, 0, '', '2017-10-17 10:10:50', '2017-10-17 10:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `ci_user_groups`
--

DROP TABLE IF EXISTS `ci_user_groups`;
CREATE TABLE IF NOT EXISTS `ci_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_user_groups`
--

INSERT INTO `ci_user_groups` (`id`, `group_name`) VALUES
(1, 'member'),
(2, 'customer'),
(4, 'accountant');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
