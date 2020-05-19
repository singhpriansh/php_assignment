-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 07:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_portal`
--
CREATE DATABASE IF NOT EXISTS `login_portal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `login_portal`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` text NOT NULL,
  `passphrase` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='admin_db';

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `passphrase`) VALUES
('charlie', 'Adm!ni$4r@tor');

-- --------------------------------------------------------

--
-- Table structure for table `student_login`
--

CREATE TABLE `student_login` (
  `name` text NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `dob` date NOT NULL,
  `reg` int(11) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `suggestion` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Storage engine InnoDB';

--
-- Dumping data for table `student_login`
--

INSERT INTO `student_login` (`name`, `email`, `phone`, `dob`, `reg`, `pass`, `suggestion`, `timestamp`) VALUES
('Aahana', 'aahana@gmail.com', 8226335829, '1998-04-08', 186301001, 'Aahan@123', '', '2020-05-17 14:29:53'),
('Akshit Singhaniya', 'akshit12911@gmail.com', 8565464867, '1997-05-01', 186301005, 'Akshit@123', 'not needed', '2020-05-17 15:33:52'),
('Prince', 'prince@gmail.com', 7894561230, '1988-05-03', 186301050, 'Prince@123', 'suggestions are useful', '2020-05-19 05:26:36'),
('Priyanshu Kumar', 'priyanshu@gmail.com', 8227854126, '1999-03-22', 186301056, 'Priyansh@123', 'not needed', '2020-05-17 11:47:59'),
('Varun', 'varun_singal@gmail.com', 7894231560, '1998-07-14', 186301078, 'Varun@124', 'no suggestions', '2020-05-19 05:28:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_login`
--
ALTER TABLE `student_login`
  ADD PRIMARY KEY (`reg`,`timestamp`),
  ADD UNIQUE KEY `reg` (`reg`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
