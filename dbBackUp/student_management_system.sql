-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 13, 2020 at 06:14 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `roletable`
--

DROP TABLE IF EXISTS `roletable`;
CREATE TABLE IF NOT EXISTS `roletable` (
  `roleId` int(250) NOT NULL,
  `roleName` varchar(250) NOT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roletable`
--

INSERT INTO `roletable` (`roleId`, `roleName`) VALUES
(1, 'admin'),
(2, 'teacher'),
(3, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `usnNumber` varchar(250) NOT NULL,
  `studentId` int(250) NOT NULL,
  `rollNumber` int(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `standard` int(250) NOT NULL,
  `firstName` varchar(250) NOT NULL,
  `lastName` varchar(250) NOT NULL,
  PRIMARY KEY (`usnNumber`),
  KEY `fk-studentid` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`usnNumber`, `studentId`, `rollNumber`, `status`, `standard`, `firstName`, `lastName`) VALUES
('1', 30, 1, 'active', 1, 'Yash', 'Patil'),
('12', 32, 12, 'active', 1, 'Divya', 'Naik');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacherId` int(250) NOT NULL,
  `firstName` varchar(250) NOT NULL,
  `lastName` varchar(250) NOT NULL,
  KEY `fk-teacherId` (`teacherId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherId`, `firstName`, `lastName`) VALUES
(28, 'Sushmita', 'Shastri'),
(29, 'Namruta', 'Shastri');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

DROP TABLE IF EXISTS `teacher_subject`;
CREATE TABLE IF NOT EXISTS `teacher_subject` (
  `rowId` int(250) NOT NULL AUTO_INCREMENT,
  `teacherId` int(250) DEFAULT NULL,
  `subjectName` varchar(250) NOT NULL,
  `standard` int(250) NOT NULL,
  PRIMARY KEY (`rowId`),
  KEY `fk` (`teacherId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`rowId`, `teacherId`, `subjectName`, `standard`) VALUES
(9, 29, 'Kannada', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(250) NOT NULL AUTO_INCREMENT,
  `roleId` int(250) NOT NULL,
  `userName` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userName` (`userName`),
  KEY `fk-roleid` (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `roleId`, `userName`, `password`) VALUES
(1, 1, 'admin', 'admin'),
(28, 2, 'Sushmita', '123'),
(29, 2, 'Namruta', '123'),
(30, 3, 'Yash', '123'),
(32, 3, 'Divyan', '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk-studentid` FOREIGN KEY (`studentId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk-teacherId` FOREIGN KEY (`teacherId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD CONSTRAINT `fk` FOREIGN KEY (`teacherId`) REFERENCES `user` (`userId`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`teacherId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk-roleid` FOREIGN KEY (`roleId`) REFERENCES `roletable` (`roleId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
