-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 22, 2019 at 09:48 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `Phone` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `Phone`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Admin', NULL, 'admin', '202cb962ac59075b964b07152d234b70', '2019-10-18 00:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblbookedworkspaces`
--

DROP TABLE IF EXISTS `tblbookedworkspaces`;
CREATE TABLE IF NOT EXISTS `tblbookedworkspaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` varchar(50) NOT NULL,
  `WorkspaceName` varchar(50) NOT NULL,
  `Date` varchar(20) NOT NULL,
  `TimePeriod` varchar(50) NOT NULL,
  `ReturnedDate` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblbookedworkspaces`
--

INSERT INTO `tblbookedworkspaces` (`id`, `UserID`, `WorkspaceName`, `Date`, `TimePeriod`, `ReturnedDate`, `status`, `fine`) VALUES
(9, '1234', 'Workspace1', '2019-10-28', '11:00am-13:00pm', '2019-10-18 23:10:29', 1, 1),
(10, '321', 'Workspace1', '2019-10-17', '11:00am-13:00pm', NULL, NULL, NULL),
(11, '321', 'Workspace1', '2019-10-18', '9:00am-11:00am', '2019-10-18 23:10:22', 1, 0),
(12, '321', 'Workspace2', '2019-10-30', '9:00am-11:00am', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbldonors`
--

DROP TABLE IF EXISTS `tbldonors`;
CREATE TABLE IF NOT EXISTS `tbldonors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DonorName` varchar(30) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Phone` varchar(12) DEFAULT NULL,
  `DateCreated` timestamp NULL DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbldonors`
--

INSERT INTO `tbldonors` (`id`, `DonorName`, `Email`, `Phone`, `DateCreated`, `DateModified`, `status`) VALUES
(2, 'Canadian Tire', 'canadiantire@gmail.com', '6479068818', '2019-10-08 22:10:20', '2019-10-09 03:10:38', 1),
(0, 'Other', NULL, NULL, NULL, NULL, 0),
(5, 'Home People', 'home@gmail.com', '', '2019-10-16 20:10:05', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblholdtool`
--

DROP TABLE IF EXISTS `tblholdtool`;
CREATE TABLE IF NOT EXISTS `tblholdtool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `TypeId` int(11) DEFAULT NULL,
  `CreatedDate` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblholdtool`
--

INSERT INTO `tblholdtool` (`id`, `UserId`, `TypeId`, `CreatedDate`, `status`) VALUES
(2, 1234, 2, '2019-10-12 02:10:16', 0),
(10, 1234, 3, '2019-10-16 03:10:00', 0),
(6, 1234, 2, '2019-10-16 02:10:29', 0),
(11, 321, 4, '2019-10-18 00:10:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedtooldetails`
--

DROP TABLE IF EXISTS `tblissuedtooldetails`;
CREATE TABLE IF NOT EXISTS `tblissuedtooldetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ToolID` int(11) DEFAULT NULL,
  `TypeId` int(11) DEFAULT NULL,
  `UserID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT NULL,
  `DueDate` timestamp NULL DEFAULT NULL,
  `ReturnDate` timestamp NULL DEFAULT NULL,
  `ReturnStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblissuedtooldetails`
--

INSERT INTO `tblissuedtooldetails` (`id`, `ToolID`, `TypeId`, `UserID`, `IssuesDate`, `DueDate`, `ReturnDate`, `ReturnStatus`, `fine`) VALUES
(34, 11, NULL, '1234', '2019-10-11 02:10:19', '2019-10-10 04:00:00', '2019-10-11 04:10:32', 1, 3),
(35, 14, NULL, '1234', '2019-10-11 03:10:43', '2019-10-14 03:10:43', '2019-10-11 04:10:16', 1, 3),
(36, 14, NULL, '123456789', '2019-10-11 04:10:04', '2019-10-14 04:10:04', '2019-10-16 02:10:57', 1, 2),
(37, 11, 2, '1234', '2019-10-12 00:10:27', '2019-10-15 00:10:27', '2019-10-12 00:10:20', 1, 0),
(38, 11, 2, '1234', '2019-10-12 01:10:21', '2019-10-15 01:10:21', '2019-10-15 22:10:27', 1, 1),
(39, 12, 3, '123456789', '2019-10-12 07:10:29', '2019-10-15 07:10:29', '2019-10-15 21:10:30', 1, 1),
(40, 11, 2, '1234', '2019-10-15 22:10:35', '2019-10-14 22:10:35', '2019-10-15 22:10:46', 1, 2),
(41, 15, 2, '1234', '2019-10-15 22:10:45', '2019-10-18 22:10:45', '2019-10-15 22:10:19', 1, 0),
(42, 11, 2, '1234', '2019-10-16 01:10:23', '2019-10-19 01:10:23', '2019-10-16 02:10:26', 1, 0),
(43, 15, 2, '123', '2019-10-16 02:10:20', '2019-10-19 02:10:20', '2019-10-16 02:10:55', 1, 0),
(44, 15, 2, '1234', '2019-10-16 02:10:15', '2019-10-19 02:10:15', '2019-10-16 02:10:12', 1, 0),
(45, 12, 3, '123', '2019-10-16 03:10:36', '2019-10-19 03:10:36', '2019-10-16 03:10:04', 1, 0),
(46, 12, 3, '1234', '2019-10-16 03:10:56', '2019-10-19 03:10:56', '2019-10-16 04:10:48', 1, 0),
(47, 12, 3, '1234', '2019-10-16 04:10:19', '2019-10-19 04:10:19', '2019-10-16 04:10:09', 1, 0),
(48, 12, 3, '123', '2019-10-16 04:10:39', '2019-10-19 04:10:39', '2019-10-16 04:10:51', 1, 0),
(49, 12, 3, '123', '2019-10-16 04:10:18', '2019-10-19 04:10:18', '2019-10-16 04:10:31', 1, 0),
(50, 16, 2, '123', '2019-10-16 04:10:42', '2019-10-19 04:10:42', '2019-10-16 04:10:48', -1, 0),
(51, 15, 2, '123', '2019-10-16 04:10:59', '2019-10-19 04:10:59', '2019-10-16 20:10:17', 1, 0),
(52, 19, 4, '1234', '2019-10-16 23:10:07', '2019-10-09 23:10:07', NULL, NULL, NULL),
(53, 20, 4, '123', '2019-10-16 23:10:29', '2019-10-19 23:10:29', '2019-10-18 00:10:04', 1, 0),
(54, 18, 5, '123', '2019-10-16 23:10:34', '2019-10-15 23:10:34', NULL, NULL, NULL),
(55, 20, 4, '321', '2019-10-18 00:10:57', '2019-10-21 00:10:57', NULL, NULL, NULL),
(56, 30, 5, '123456789', '2019-10-23 02:10:27', '2019-10-26 02:10:27', '2019-10-23 03:10:49', 1, 0),
(57, 30, 5, '123456789', '2019-10-23 03:10:29', '2019-10-26 03:10:29', '2019-10-23 03:10:10', 1, 0),
(58, 30, 5, '123456789', '2019-10-23 03:10:03', '2019-10-26 03:10:03', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbllocations`
--

DROP TABLE IF EXISTS `tbllocations`;
CREATE TABLE IF NOT EXISTS `tbllocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LocationName` varchar(159) DEFAULT NULL,
  `CreateDate` timestamp NULL DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllocations`
--

INSERT INTO `tbllocations` (`id`, `LocationName`, `CreateDate`, `UpdationDate`, `status`) VALUES
(0, 'Other', NULL, NULL, 0),
(12, 'Workspace 1', '2019-09-25 16:12:54', '2019-10-17 22:10:16', 1),
(13, 'Workspace 2', '2019-09-25 16:13:17', '2019-10-17 22:10:22', 1),
(15, 'Main Building', '2019-10-17 22:10:40', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltools`
--

DROP TABLE IF EXISTS `tbltools`;
CREATE TABLE IF NOT EXISTS `tbltools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ToolName` varchar(255) DEFAULT NULL,
  `TypeId` int(11) DEFAULT NULL,
  `TradeId` int(11) DEFAULT NULL,
  `LocationId` int(11) DEFAULT NULL,
  `DonorId` int(11) DEFAULT NULL,
  `Barcode` varchar(30) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `Damage` varchar(25) DEFAULT NULL,
  `Comments` varchar(255) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `kits` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltools`
--

INSERT INTO `tbltools` (`id`, `ToolName`, `TypeId`, `TradeId`, `LocationId`, `DonorId`, `Barcode`, `status`, `Damage`, `Comments`, `RegDate`, `UpdationDate`, `type`, `kits`) VALUES
(11, 'Hammer1', 2, 10, 12, 2, '10004', 1, '	No Damage', NULL, '2019-10-10 01:10:00', '2019-10-10 23:10:54', NULL, NULL),
(12, 'Glove', 3, 13, 15, 2, 'q', 1, 'Slight Damage', NULL, '2019-10-10 01:10:36', '2019-10-12 02:10:21', NULL, NULL),
(16, 'Hammer4', 2, 0, 12, 0, '10001', -1, 'No Damage', NULL, '2019-10-16 03:10:35', '2019-10-16 04:10:51', NULL, NULL),
(18, 'Welding Kit#1', 5, 14, 12, 0, '20001', 0, 'No Damage', NULL, '2019-10-16 20:10:49', NULL, NULL, NULL),
(19, 'Spanner#1', 4, 0, 0, 0, '30001', 0, 'No Damage', NULL, '2019-10-16 20:10:02', NULL, NULL, NULL),
(20, 'Spanner#2', 4, 0, 0, 0, '30002', 0, 'No Damage', '', '2019-10-16 20:10:23', NULL, NULL, NULL),
(30, 'kits Test', 5, 0, 0, 0, 'kit', 0, 'No Damage', '', '2019-10-23 02:10:01', NULL, 1, '1,2,3');

-- --------------------------------------------------------

--
-- Table structure for table `tbltrade`
--

DROP TABLE IF EXISTS `tbltrade`;
CREATE TABLE IF NOT EXISTS `tbltrade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltrade`
--

INSERT INTO `tbltrade` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(0, 'Other', 0, '2019-09-25 16:12:17', NULL),
(10, 'Carpentry', 1, '2019-09-25 16:12:17', '2019-10-09 01:10:03'),
(12, 'Electrician', 1, '2019-09-25 16:12:32', '2019-10-09 01:10:58'),
(13, 'Masonry', 1, '2019-10-09 01:10:37', NULL),
(14, 'Wielding', 1, '2019-10-09 01:10:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltype`
--

DROP TABLE IF EXISTS `tbltype`;
CREATE TABLE IF NOT EXISTS `tbltype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `TypeName` varchar(30) DEFAULT NULL,
  `CreateDate` timestamp NULL DEFAULT NULL,
  `UpdateDate` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbltype`
--

INSERT INTO `tbltype` (`id`, `TypeName`, `CreateDate`, `UpdateDate`, `status`) VALUES
(2, 'Hammers', '2019-10-09 20:10:19', '2019-10-09 20:10:29', 1),
(3, 'Gloves', '2019-10-09 20:10:54', '2019-10-16 23:10:17', 1),
(4, 'Spanners', '2019-10-16 20:10:22', NULL, 1),
(5, 'Welding Kits', '2019-10-16 20:10:35', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `Gender` varchar(12) DEFAULT NULL,
  `Birthdate` varchar(22) DEFAULT NULL,
  `Education` varchar(30) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `MobileNumber2` char(11) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `StudentId` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `UserId`, `FullName`, `Gender`, `Birthdate`, `Education`, `MobileNumber`, `MobileNumber2`, `Status`, `RegDate`, `UpdationDate`) VALUES
(16, '123456789', 'Olivier Karekezi', 'Male', '1983-04-24', 'Formal', '2509068818', '', 1, '2019-10-02 21:26:32', '2019-10-16 23:10:58'),
(17, '123', 'Pierre Habumuremyi', 'Male', '1962-07-21', 'Formal', '6479068818', '', 0, '2019-10-03 14:45:41', '2019-10-16 20:10:27'),
(18, 'q123', 'Sonia Rolland', 'Female', '1987-10-30', 'Formal', '6479068818', '6479068818', 1, '2019-10-03 20:41:21', '2019-10-04 20:26:04'),
(22, '1234', 'Anisia Uzeyman', 'Female', '1976-10-30', 'Informal', '647983456', '', 0, '2019-10-05 03:10:43', '2019-10-15 20:10:16'),
(23, '321', 'Salomon Nirisarike', 'Male', '1993-02-11', 'Formal', '6479068818', '', 0, '2019-10-16 23:10:50', '2019-10-18 03:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbluserstatus`
--

DROP TABLE IF EXISTS `tbluserstatus`;
CREATE TABLE IF NOT EXISTS `tbluserstatus` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) DEFAULT NULL,
  `Nationalid` varchar(50) DEFAULT NULL,
  `StatusInfo` varchar(255) DEFAULT NULL,
  `Checkedby` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbluserstatus`
--

INSERT INTO `tbluserstatus` (`id`, `UserName`, `Nationalid`, `StatusInfo`, `Checkedby`, `CreateDate`) VALUES
(10, 'Xuanchen', 'q123', 'test', 'admin', '2019-10-04 22:10:04'),
(11, 'Jason', '123456789', 'Some Reasons', 'admin', '2019-10-07 05:10:40'),
(12, 'Salomon Nirisarike', '321', '', 'admin', '2019-10-17 23:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `tblworkspaces`
--

DROP TABLE IF EXISTS `tblworkspaces`;
CREATE TABLE IF NOT EXISTS `tblworkspaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `WorkspaceName` varchar(50) DEFAULT NULL,
  `CreateDate` timestamp NULL DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblworkspaces`
--

INSERT INTO `tblworkspaces` (`id`, `WorkspaceName`, `CreateDate`, `UpdateDate`, `status`) VALUES
(1, 'Workspace1', '2019-10-07 21:10:06', '2019-10-08 21:10:52', 1),
(2, 'Workspace2', '2019-10-07 21:10:48', '2019-10-08 21:10:54', 1),
(3, 'Workspace3', '2019-10-07 21:10:25', '2019-10-08 21:10:58', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
