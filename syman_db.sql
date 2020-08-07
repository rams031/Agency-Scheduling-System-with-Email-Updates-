-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2020 at 12:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syman_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application`
--

CREATE TABLE `tbl_application` (
  `appid` int(10) NOT NULL,
  `jobid` int(10) NOT NULL,
  `fname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact` int(11) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(256) NOT NULL,
  `imgid` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_application`
--

INSERT INTO `tbl_application` (`appid`, `jobid`, `fname`, `lname`, `email`, `contact`, `age`, `gender`, `address`, `imgid`, `date`, `status`) VALUES
(33, 40, 'test', 'test', 'test@gmail.com', 2147483647, 34, 'Male', 'test', '../assets/uploads/317495imiges.png', '2020-08-07', 'forschedule');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email`
--

CREATE TABLE `tbl_email` (
  `emailid` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_email`
--

INSERT INTO `tbl_email` (`emailid`, `email`, `password`) VALUES
(1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `eventid` int(10) NOT NULL,
  `schedid` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `title` varchar(256) NOT NULL,
  `color` varchar(256) NOT NULL,
  `reminder` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forschedule`
--

CREATE TABLE `tbl_forschedule` (
  `schedid` int(11) NOT NULL,
  `appid` int(11) NOT NULL,
  `userid` int(10) NOT NULL,
  `dateapproved` date NOT NULL,
  `process` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_forschedule`
--

INSERT INTO `tbl_forschedule` (`schedid`, `appid`, `userid`, `dateapproved`, `process`) VALUES
(30, 33, 9, '2020-08-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job`
--

CREATE TABLE `tbl_job` (
  `jobid` int(100) NOT NULL,
  `jobname` varchar(256) NOT NULL,
  `jobtype` varchar(256) NOT NULL,
  `jobindustry` varchar(256) NOT NULL,
  `exp` varchar(256) NOT NULL,
  `dateposted` date NOT NULL,
  `jobdescription` varchar(256) NOT NULL,
  `jobeduclvl` varchar(256) NOT NULL,
  `jobsalary` int(10) NOT NULL,
  `joblocation` varchar(256) NOT NULL,
  `jobaddress` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job`
--

INSERT INTO `tbl_job` (`jobid`, `jobname`, `jobtype`, `jobindustry`, `exp`, `dateposted`, `jobdescription`, `jobeduclvl`, `jobsalary`, `joblocation`, `jobaddress`) VALUES
(33, 'Welder', 'Full Time', 'Symanpro', 'Associate', '2019-11-09', ' No visible Tattoo At least Highschool graduate With Certificate of employment at least with TESDA Certificate as Welder', 'High School', 25000, 'Caloocan', ''),
(36, 'Machine Operator', 'Part Time', 'Symanpro', 'Associate', '2019-11-09', ' \r\nHigh School Graduate\r\nWith 5 months to 1 year experience as machine operator\r\nâ€¢ No tattoo\r\nâ€¢ With certificate of employment ', 'College Graduate', 15000, 'Valenzuela', ''),
(39, 'Warehouse Man', 'Full Time', 'Inspiro', 'Associate', '2019-12-20', 'Candidate must be College level or High School Graduate\nCan work under minimum supervision and can handle pressure [â€¦]\nRESPONSIBILITIES [â€¦]\nAccountable to the items prepared.\nCoordination to concerned person regarding Pick list issues.\n ', 'College Graduate', 14000, 'Caloocan', ''),
(40, 'PM Mechanic', 'Full Time', 'Inspiro', 'Associate', '2019-12-20', 'At least college graduate or undergraduate of any engineering course or technical course of mechanical,industrial and electrical\nWith experience in the same field is a must\nAt least Highschool graduate [â€¦]\nAt least with TESDA Certificate as Welder', 'High School', 14000, 'Valenzuela', ''),
(41, 'Production Worker ', 'Full Time', 'Inspiro', 'Associate', '2019-12-20', 'Willing to be trained No tattoo Can work in fastpaced environment Able to hit Quota Able to move fast and quickly Will be assign in Canumay , Valenzuela City', 'High School', 14000, 'Valenzuela', ''),
(42, 'Qc Inspector', 'Full Time', 'Inspiro', 'Associate', '2019-12-20', 'At least Highschool graduate\nCan work well under minimum supervision [â€¦]\nParticular in details\nWith good eyesight and a team player\nWilling to work on a production type environment [â€¦]', 'High School', 14000, 'Malabon', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(10) NOT NULL,
  `username` varchar(256) NOT NULL,
  `userlastname` varchar(256) NOT NULL,
  `useremail` varchar(256) NOT NULL,
  `userpassword` varchar(256) NOT NULL,
  `datecreated` date NOT NULL,
  `contacts` int(20) NOT NULL,
  `usertype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `userlastname`, `useremail`, `userpassword`, `datecreated`, `contacts`, `usertype`) VALUES
(6, 'admin', 'admin', 'admin@gmail.com', '123', '2020-08-18', 123, 'admin'),
(9, 'hr', 'hr', 'hr@gmail.com', '123', '2020-02-26', 123, 'hrstaff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_application`
--
ALTER TABLE `tbl_application`
  ADD PRIMARY KEY (`appid`);

--
-- Indexes for table `tbl_email`
--
ALTER TABLE `tbl_email`
  ADD PRIMARY KEY (`emailid`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `tbl_forschedule`
--
ALTER TABLE `tbl_forschedule`
  ADD PRIMARY KEY (`schedid`);

--
-- Indexes for table `tbl_job`
--
ALTER TABLE `tbl_job`
  ADD PRIMARY KEY (`jobid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_application`
--
ALTER TABLE `tbl_application`
  MODIFY `appid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_email`
--
ALTER TABLE `tbl_email`
  MODIFY `emailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `eventid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `tbl_forschedule`
--
ALTER TABLE `tbl_forschedule`
  MODIFY `schedid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_job`
--
ALTER TABLE `tbl_job`
  MODIFY `jobid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
