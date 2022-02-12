-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2022 at 07:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `EID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `eventTitle` varchar(50) NOT NULL,
  `eventOfYear` varchar(4) NOT NULL,
  `eventCredit` int(1) UNSIGNED NOT NULL DEFAULT 3,
  `eventType` enum('กิจกรรมบังคับ','กิจกรรมบังคับเลือก','กิจกรรมเลือก') NOT NULL DEFAULT 'กิจกรรมเลือก',
  `start` datetime NOT NULL DEFAULT current_timestamp(),
  `end` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_event`
--

INSERT INTO `tb_event` (`EID`, `eventTitle`, `eventOfYear`, `eventCredit`, `eventType`, `start`, `end`) VALUES
(009, 'ปฐมนิเทศ', '2563', 2, 'กิจกรรมบังคับ', '2020-06-25 08:00:00', '2020-06-25 16:00:00'),
(010, 'ปัจฉิมนิเทศ', '2564', 2, 'กิจกรรมบังคับ', '2021-10-10 08:00:00', '2021-10-10 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `UID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('USER','ADMIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`UID`, `username`, `password`, `name`, `status`) VALUES
(001, 'admin', 'admin', 'Administrator', 'ADMIN'),
(002, 'user', 'user', 'System User', 'USER'),
(003, 'mii', 'password', 'phy sd', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `tb_useronevent`
--

CREATE TABLE `tb_useronevent` (
  `UID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `EID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_useronevent`
--

INSERT INTO `tb_useronevent` (`UID`, `EID`, `timestamp`) VALUES
(002, 010, '2022-01-25 17:40:55'),
(003, 009, '2022-01-25 18:02:48'),
(003, 010, '2022-01-25 17:41:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`EID`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `tb_useronevent`
--
ALTER TABLE `tb_useronevent`
  ADD PRIMARY KEY (`UID`,`EID`),
  ADD KEY `EID` (`EID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `EID` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `UID` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_useronevent`
--
ALTER TABLE `tb_useronevent`
  ADD CONSTRAINT `tb_useronevent_ibfk_1` FOREIGN KEY (`EID`) REFERENCES `tb_event` (`EID`),
  ADD CONSTRAINT `tb_useronevent_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `tb_user` (`UID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
