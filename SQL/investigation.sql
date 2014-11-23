-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2014 at 02:53 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `investigation`
--

-- --------------------------------------------------------

--
-- Table structure for table `case_informant`
--

CREATE TABLE IF NOT EXISTS `case_informant` (
  `CIID` int(10) NOT NULL AUTO_INCREMENT,
  `CID` int(10) NOT NULL,
  `IID` int(10) NOT NULL,
  PRIMARY KEY (`CIID`),
  KEY `CID` (`CID`),
  KEY `IID` (`IID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `case_suspect`
--

CREATE TABLE IF NOT EXISTS `case_suspect` (
  `CSID` int(10) NOT NULL AUTO_INCREMENT,
  `CID` int(10) NOT NULL,
  `SID` int(10) NOT NULL,
  PRIMARY KEY (`CSID`),
  KEY `CID` (`CID`),
  KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE IF NOT EXISTS `complaint` (
  `CoID` int(10) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Memo` varchar(500) DEFAULT NULL,
  `Status` varchar(20) NOT NULL,
  `UID` int(10) NOT NULL,
  `CID` int(10) DEFAULT NULL,
  PRIMARY KEY (`CoID`),
  KEY `UID` (`UID`),
  KEY `CID` (`CID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `informant`
--

CREATE TABLE IF NOT EXISTS `informant` (
  `IID` int(10) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  PRIMARY KEY (`IID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `investigation_case`
--

CREATE TABLE IF NOT EXISTS `investigation_case` (
  `CID` int(10) NOT NULL,
  `Title` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Memo` varchar(500) DEFAULT NULL,
  `Owner` varchar(20) NOT NULL,
  `UID` int(10) NOT NULL,
  PRIMARY KEY (`CID`),
  KEY `UID` (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investigation_case`
--

INSERT INTO `investigation_case` (`CID`, `Title`, `Date`, `Status`, `Memo`, `Owner`, `UID`) VALUES
(0, 'Hospital', '2014-02-02', 'Pending', 'This case requires attention', 'Jaston', 2);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `PID` int(10) NOT NULL AUTO_INCREMENT,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`PID`, `Description`) VALUES
(2, 'Staff'),
(3, 'Administrator'),
(4, 'Super Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `SoID` int(10) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  PRIMARY KEY (`SoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `suspect`
--

CREATE TABLE IF NOT EXISTS `suspect` (
  `SID` int(10) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UID` int(10) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `JobTitle` varchar(50) NOT NULL,
  `PID` int(10) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `emp_num` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`UID`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `Fname`, `Lname`, `JobTitle`, `PID`, `Username`, `Password`, `emp_num`) VALUES
(2, 'Tester', 'Test', 'Test User', 4, 'Tester', '*A839F8E05B1CAE03C20EA93B25AA868051A05EA9', NULL),
(3, 'Victor', 'Garcia', 'Admin', 4, 'Victor', '*D68A223B5A4C5A66DF0EEB4455F3CF0CC9A858E2', NULL),
(4, 'Jaston', 'Anjain', 'Chief Investigator', 4, 'Jaston', '*D95D511EAF7A50528E875B337542A18E282E8E85', NULL),
(5, 'Test', 'Test', 'Tester', 2, 'Test', '*AF31C6CBDECD88726D0A9B3798C71EF41F1624D5', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `case_informant`
--
ALTER TABLE `case_informant`
  ADD CONSTRAINT `case_informant_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `investigation_case` (`CID`),
  ADD CONSTRAINT `case_informant_ibfk_2` FOREIGN KEY (`IID`) REFERENCES `informant` (`IID`);

--
-- Constraints for table `case_suspect`
--
ALTER TABLE `case_suspect`
  ADD CONSTRAINT `case_suspect_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `investigation_case` (`CID`),
  ADD CONSTRAINT `case_suspect_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `suspect` (`SID`);

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  ADD CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`CID`) REFERENCES `investigation_case` (`CID`);

--
-- Constraints for table `investigation_case`
--
ALTER TABLE `investigation_case`
  ADD CONSTRAINT `investigation_case_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `permissions` (`PID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
