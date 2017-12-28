-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2017 at 09:07 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventsregister`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventid` int(3) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `dept` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventid`, `name`, `dept`) VALUES
(1, 'Counter Strike', 'COMPIT'),
(2, 'Paper Presentation', 'COMEIT'),
(3, 'Clash of Code', 'COMEIT'),
(4, 'Webber', 'COMEIT'),
(5, 'Project Presentation', 'COMEIT'),
(6, 'Hotkeys', 'COMEIT');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `memid` int(5) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `eventid` int(3) DEFAULT NULL,
  `userid` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memid`, `fname`, `lname`, `college`, `email`, `mobile`, `eventid`, `userid`) VALUES
(1, 'Kaushal', 'Jain', 'GPP', 'drigiobalboa@gmail.com', '8796530399', 1, 1),
(2, 'Vaishnav', 'Gaikwad', 'GPP', 'gkondhare@yahoo.com', '48465646', 1, 2),
(3, 'Harshad', 'parmar', 'gpp', 'hsd', '7879797956', 1, 2),
(8, 'sadas', 'dasd', 'asdasd', 'dadsa@asdds.com', '899565644', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(3) NOT NULL,
  `usertype` int(2) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `dept` varchar(100) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `usermail` varchar(255) DEFAULT NULL,
  `userpass` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `eventid` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `usertype`, `fname`, `lname`, `dept`, `mobile`, `usermail`, `userpass`, `password`, `eventid`) VALUES
(1, 1, 'Gaurav', 'Kondhare', 'Computer', '8796530399', 'drigiobalboa@gmail.com', 'dastur123', '$2y$10$zuN6npB9.L6hnzRlwvCQFudSOn/2.jEHat9HVYYC8SdTIHEWeNuCS', 1),
(2, 2, 'Atharva', 'Deshpande', 'COMEIT', '7218340969', 'atharvadeshpande99@gmail.com', NULL, '$2y$10$zuN6npB9.L6hnzRlwvCQFudSOn/2.jEHat9HVYYC8SdTIHEWeNuCS', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
