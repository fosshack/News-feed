-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2017 at 03:56 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fosshack`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rdata`
--

CREATE TABLE `tbl_rdata` (
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `places` text NOT NULL,
  `medical` text NOT NULL,
  `orgs` text NOT NULL,
  `skills` text NOT NULL,
  `political` text NOT NULL,
  `business` text NOT NULL,
  `hobbies` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `uid` int(11) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `username` varchar(10) NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT '0',
  `phone` varchar(25) NOT NULL DEFAULT 'N/A',
  `user_email` varchar(60) NOT NULL DEFAULT 'N/A',
  `password` varchar(100) NOT NULL,
  `avatar` varchar(40) NOT NULL DEFAULT 'avatar.png',
  `online_status` tinyint(1) NOT NULL DEFAULT '0',
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_rdata`
--
ALTER TABLE `tbl_rdata`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `uid_2` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_rdata`
--
ALTER TABLE `tbl_rdata`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
