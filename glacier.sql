-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2016 at 11:44 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glacier`
--

-- --------------------------------------------------------

--
-- Table structure for table `13month`
--

CREATE TABLE `13month` (
  `id` bigint(11) NOT NULL,
  `yearperiod` bigint(11) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `no_of_months` float(6,2) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

CREATE TABLE `absences` (
  `id` bigint(11) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `payperiod` bigint(11) NOT NULL,
  `absent` float(5,2) NOT NULL,
  `rate` float(8,2) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `hours_worked` double DEFAULT NULL,
  `overtime` double DEFAULT NULL,
  `tardiness` double DEFAULT NULL,
  `undertime` double DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bir_table`
--

CREATE TABLE `bir_table` (
  `id` int(11) NOT NULL,
  `cstatus` char(20) NOT NULL,
  `dependents` mediumint(5) NOT NULL,
  `minrange` float(10,2) NOT NULL,
  `maxrange` float(10,2) NOT NULL,
  `tax1` float(8,2) NOT NULL,
  `tax2` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bir_table`
--

INSERT INTO `bir_table` (`id`, `cstatus`, `dependents`, `minrange`, `maxrange`, `tax1`, `tax2`) VALUES
(1, 's/me', 0, 4167.00, 4999.99, 0.00, 0.05),
(2, 's/me', 0, 5000.00, 6666.99, 41.67, 0.10),
(3, 's/me', 0, 6667.00, 9999.99, 208.33, 0.15),
(4, 's/me', 0, 10000.00, 15832.99, 708.33, 0.20),
(5, 's/me', 0, 15833.00, 24999.99, 1875.00, 0.25),
(6, 's/me', 0, 25000.00, 45832.99, 4166.67, 0.30),
(7, 's/me', 0, 45833.00, 1000000.00, 10416.67, 0.32),
(8, 's1/me1', 1, 6250.00, 7082.99, 0.00, 0.05),
(9, 's1/me1', 1, 7083.00, 8749.99, 41.67, 0.10),
(10, 's1/me1', 1, 8750.00, 12082.99, 208.33, 0.15),
(11, 's1/me1', 1, 12083.00, 17916.99, 708.33, 0.20),
(12, 's1/me1', 1, 17917.00, 27082.99, 1875.00, 0.25),
(13, 's1/me1', 1, 27083.00, 47916.99, 4166.67, 0.30),
(14, 's1/me1', 1, 47917.00, 1000000.00, 10416.67, 0.32),
(15, 's2/me2', 2, 8333.00, 9166.99, 0.00, 0.05),
(16, 's2/me2', 2, 9167.00, 10832.99, 41.67, 0.10),
(17, 's2/me2', 2, 10833.00, 14166.99, 208.33, 0.15),
(18, 's2/me2', 2, 14167.00, 19999.99, 708.33, 0.20),
(19, 's2/me2', 2, 20000.00, 29166.99, 1875.00, 0.25),
(20, 's2/me2', 2, 29167.00, 49999.99, 4166.67, 0.30),
(21, 's2/me2', 2, 50000.00, 1000000.00, 10416.67, 0.32),
(22, 's3/me3', 3, 10417.00, 11249.99, 0.00, 0.05),
(23, 's3/me3', 3, 11250.00, 12916.99, 41.67, 0.10),
(24, 's3/me3', 3, 12917.00, 16249.99, 208.33, 0.15),
(25, 's3/me3', 3, 16250.00, 22082.99, 708.33, 0.20),
(26, 's3/me3', 3, 22083.00, 31249.99, 1875.00, 0.25),
(27, 's3/me3', 3, 31250.00, 52082.99, 4166.67, 0.30),
(28, 's3/me3', 3, 52083.00, 1000000.00, 10416.67, 0.32),
(29, 's4/me4', 4, 12500.00, 13332.99, 0.00, 0.05),
(30, 's4/me4', 4, 13333.00, 14999.99, 41.67, 0.10),
(31, 's4/me4', 4, 15000.00, 18332.99, 208.33, 0.15),
(32, 's4/me4', 4, 18333.00, 24166.99, 708.33, 0.20),
(33, 's4/me4', 4, 24167.00, 33332.99, 1875.00, 0.25),
(34, 's4/me4', 4, 33333.00, 54166.99, 4166.67, 0.30),
(35, 's4/me4', 4, 54167.00, 1000000.00, 10416.67, 0.32);

-- --------------------------------------------------------

--
-- Table structure for table `branddetails`
--

CREATE TABLE `branddetails` (
  `brand_id` int(11) NOT NULL,
  `brandname` varchar(50) NOT NULL,
  `dealername` varchar(50) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `wedaddress` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `contactno` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`) VALUES
(1, 'admin'),
(2, 'engineering'),
(3, 'warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `userlevel` mediumint(9) NOT NULL DEFAULT '2',
  `emp_pass` varchar(250) NOT NULL,
  `department` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `img_name` varchar(32) NOT NULL,
  `thumb_name` varchar(32) NOT NULL,
  `ext` varchar(32) NOT NULL,
  `upload_date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `firstname`, `middlename`, `lastname`, `userlevel`, `emp_pass`, `department`, `position`, `contact_no`, `address`, `status`, `date_created`, `img_name`, `thumb_name`, `ext`, `upload_date`) VALUES
(1, '2', 'Ricardos', 'Ronel', 'Arabia', 2, 'c81e728d9d4c2f636f067f89cc14862c', 'Hr department', 'Supervisors', '94776515s', '', 1, '0000-00-00', 'pic15', 'pic15_thumb', '.JPG', '1469186275'),
(3, '2016082', 'marjan', 'gorgeous', 'nassiri', 3, '94b11656405aa155684fbb1b02f9f87e', 'Exexcutive', 'ceo', '123456', 'forbes park', 1, '1996-10-10', 'pic11', 'pic11_thumb', '.JPG', '1470115497'),
(4, '2016083', 'lebron', 'king', 'james', 3, '6accff9fd9643c351eaeb8f0966fad02', 'cleveland', 'forward', '123456', 'cavaliers', 1, '1996-10-10', 'profile_', 'profile__thumb', '.jpg', '1470395052');

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `emp_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `datehired` date NOT NULL,
  `cstatus` varchar(50) NOT NULL,
  `salary` decimal(10,0) NOT NULL,
  `hdmf_no` varchar(255) NOT NULL,
  `tin_no` varchar(255) NOT NULL,
  `sss_no` varchar(255) NOT NULL,
  `philhealth_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`emp_details_id`, `user_id`, `birthdate`, `gender`, `datehired`, `cstatus`, `salary`, `hdmf_no`, `tin_no`, `sss_no`, `philhealth_no`) VALUES
(55, 2, '1996-10-10', 'male', '0000-00-00', 'asd', '0', 'asds', '1231231231', 'asd', 'asd'),
(59, 2016072, '1996-10-17', 'asd', '1996-10-10', 'asd', '0', 'qwerty', 'asdasd', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `emp_contributions`
--

CREATE TABLE `emp_contributions` (
  `id` bigint(11) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `sss` float(8,2) NOT NULL,
  `philhealth` float(8,2) NOT NULL,
  `pagibig` float(8,2) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_contributions`
--

INSERT INTO `emp_contributions` (`id`, `user_id`, `sss`, `philhealth`, `pagibig`, `status`) VALUES
(1, 2, 581.30, 437.50, 360.00, 1),
(2, 3, 581.30, 437.50, 360.00, 1),
(3, 4, 581.30, 437.50, 360.00, 1),
(4, 5, 581.30, 250.00, 200.00, 1),
(5, 6, 581.30, 437.50, 360.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_status`
--

CREATE TABLE `emp_status` (
  `emp_ID` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `empstatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_status`
--

INSERT INTO `emp_status` (`emp_ID`, `title`, `empstatus`) VALUES
(1, 'Single', 's'),
(2, 'Single/With 1 Dependent', 's1'),
(3, 'Single/With 2 Dependent', 's2'),
(4, 'Single/With 3 Dependent', 's3'),
(5, 'Single/With 4 Dependent', 's4'),
(6, 'Married', 'me'),
(7, 'Married With 1 Dependent', 'me1'),
(8, 'Married With 2 Dependent 	', 'me2'),
(9, 'Married With 3 Dependent 	', 'me3'),
(10, 'Married With 4 Dependent 	', 'me4');

-- --------------------------------------------------------

--
-- Table structure for table `emp_workschedule`
--

CREATE TABLE `emp_workschedule` (
  `sched_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `mon_start` datetime NOT NULL,
  `mon_end` datetime NOT NULL,
  `tue_start` datetime NOT NULL,
  `tue_end` datetime NOT NULL,
  `wed_start` datetime NOT NULL,
  `wed_end` datetime NOT NULL,
  `thurs_start` datetime NOT NULL,
  `thurs_end` datetime NOT NULL,
  `fri_start` datetime NOT NULL,
  `fri_end` datetime NOT NULL,
  `sat_start` datetime NOT NULL,
  `sat_end` datetime NOT NULL,
  `sun_start` datetime NOT NULL,
  `sun_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_workschedule`
--

INSERT INTO `emp_workschedule` (`sched_id`, `user_id`, `mon_start`, `mon_end`, `tue_start`, `tue_end`, `wed_start`, `wed_end`, `thurs_start`, `thurs_end`, `fri_start`, `fri_end`, `sat_start`, `sat_end`, `sun_start`, `sun_end`) VALUES
(1, '2016082', '2016-08-11 06:00:00', '2016-08-12 14:00:00', '2016-08-13 06:00:00', '2016-08-14 14:00:00', '2016-08-15 06:00:00', '2016-08-16 14:00:00', '2016-08-17 06:00:00', '2016-08-18 14:00:00', '2016-08-19 06:00:00', '2016-08-20 14:00:00', '2016-08-21 06:00:00', '2016-08-22 14:00:00', '2016-08-23 06:00:00', '2016-08-24 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3a87ad',
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `color`, `start`, `end`) VALUES
(11, '#e00e2b', '2016-08-14 09:24:00', '2016-08-15 14:00:00'),
(12, '#4c55f2', '2016-08-15 09:25:00', '2016-08-15 13:00:00'),
(13, '#6bce45', '2016-08-16 10:26:00', '2016-08-16 17:00:00'),
(14, '#c529d5', '2016-08-17 11:28:00', '2016-08-17 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `recipient_id` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `recipient_id`, `name`, `email`, `subject`, `message`, `created_at`, `read_status`) VALUES
(123, '2', 'asd', 'asd', 'asd', 'asd', '2016-08-09 17:04:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` bigint(11) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `payperiod` bigint(11) NOT NULL,
  `hours` float(8,2) NOT NULL,
  `rate` float(8,2) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `user_id`, `payperiod`, `hours`, `rate`, `status`) VALUES
(1, 6, 11, 5.00, 1022.73, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payperiod`
--

CREATE TABLE `payperiod` (
  `id` int(11) NOT NULL,
  `payfrom` varchar(100) NOT NULL,
  `payto` varchar(100) NOT NULL,
  `no_days` int(4) NOT NULL,
  `monthend` tinyint(2) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payperiod`
--

INSERT INTO `payperiod` (`id`, `payfrom`, `payto`, `no_days`, `monthend`, `status`) VALUES
(11, '04/01/2016', '04/16/2016', 0, 0, 1),
(12, '04/17/2016', '04/31/2016', 0, 1, 1),
(13, '05/17/2016', '05/31/2016', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payslip`
--

CREATE TABLE `payslip` (
  `id` bigint(11) NOT NULL,
  `sss` float(8,2) NOT NULL,
  `philhealth` float(8,2) NOT NULL,
  `pagibig` float(8,2) NOT NULL,
  `monthend` tinyint(1) NOT NULL DEFAULT '0',
  `payperiod` tinyint(2) NOT NULL,
  `overtime` float(8,2) NOT NULL,
  `absences` float(8,2) NOT NULL,
  `witholdingtax` float(8,2) NOT NULL,
  `grosspay` float(8,2) NOT NULL,
  `netpay` float(8,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `philhealth_table`
--

CREATE TABLE `philhealth_table` (
  `id` int(11) NOT NULL,
  `min_salary` float(10,2) NOT NULL,
  `max_salary` float(10,2) NOT NULL,
  `employee` float(8,2) NOT NULL,
  `employer` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `philhealth_table`
--

INSERT INTO `philhealth_table` (`id`, `min_salary`, `max_salary`, `employee`, `employer`) VALUES
(1, 1.00, 8999.99, 100.00, 100.00),
(2, 9000.00, 9999.99, 112.50, 112.50),
(3, 10000.00, 10999.99, 125.00, 125.00),
(4, 11000.00, 11999.99, 137.50, 137.50),
(5, 12000.00, 12999.99, 150.00, 150.00),
(6, 13000.00, 13999.99, 162.50, 162.50),
(7, 14000.00, 14999.99, 175.00, 175.00),
(8, 15000.00, 15999.99, 187.50, 187.50),
(9, 16000.00, 16999.99, 200.00, 200.00),
(10, 17000.00, 17999.99, 212.50, 212.50),
(11, 18000.00, 18999.99, 225.00, 225.00),
(12, 19000.00, 19999.99, 237.50, 237.50),
(13, 20000.00, 20999.99, 250.00, 250.00),
(14, 21000.00, 21999.99, 262.50, 262.50),
(15, 22000.00, 22999.99, 275.00, 275.00),
(16, 23000.00, 23999.99, 287.50, 287.50),
(17, 24000.00, 24999.99, 300.00, 300.00),
(18, 25000.00, 25999.99, 312.50, 312.50),
(19, 26000.00, 26999.99, 325.00, 325.00),
(20, 27000.00, 27999.99, 337.50, 337.50),
(21, 28000.00, 28999.99, 350.00, 350.00),
(22, 29000.00, 29999.99, 362.50, 362.50),
(23, 30000.00, 30999.99, 375.00, 375.00),
(24, 31000.00, 31999.99, 387.50, 387.50),
(25, 32000.00, 32999.99, 400.00, 400.00),
(26, 33000.00, 33999.99, 412.50, 412.50),
(27, 34000.00, 34999.99, 425.00, 425.00),
(28, 35000.00, 100000000.00, 437.50, 437.50);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` bigint(11) NOT NULL,
  `payperiod` tinyint(2) NOT NULL,
  `sss` float NOT NULL,
  `philhealth` float NOT NULL,
  `pagibig` float NOT NULL,
  `monthend` tinyint(1) NOT NULL DEFAULT '0',
  `overtime` float NOT NULL,
  `absences` float NOT NULL,
  `witholdingtax` float NOT NULL,
  `grosspay` float NOT NULL,
  `netpay` float NOT NULL,
  `user_id` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rqst_leaves`
--

CREATE TABLE `rqst_leaves` (
  `leave_id` int(11) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `leave_status` varchar(255) NOT NULL,
  `cause` text NOT NULL,
  `duration` int(11) NOT NULL,
  `leavetype` varchar(255) NOT NULL,
  `date_submitted` date DEFAULT NULL,
  `date_approved` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rqst_leaves`
--

INSERT INTO `rqst_leaves` (`leave_id`, `user_id`, `startdate`, `enddate`, `leave_status`, `cause`, `duration`, `leavetype`, `date_submitted`, `date_approved`) VALUES
(3, '2016083', '2016-08-22', '2016-08-26', 'approved', 'nothing', 5, 'Vacation', '2016-08-15', '2016-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `rqst_overtime`
--

CREATE TABLE `rqst_overtime` (
  `overtime_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `cause` text NOT NULL,
  `ot_status` varchar(255) NOT NULL,
  `date_submitted` date NOT NULL,
  `date_approved` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rqst_overtime`
--

INSERT INTO `rqst_overtime` (`overtime_id`, `user_id`, `date`, `duration`, `cause`, `ot_status`, `date_submitted`, `date_approved`) VALUES
(1, 2, '2016-08-10', 10, 'qwert', 'requested', '0000-00-00', '0000-00-00'),
(2, 2016082, '2016-08-16', 2, 'asd', 'approved', '0000-00-00', '2016-08-09');

-- --------------------------------------------------------

--
-- Table structure for table `rqst_shift`
--

CREATE TABLE `rqst_shift` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `duration` int(11) NOT NULL,
  `reason` text NOT NULL,
  `shift_status` varchar(255) NOT NULL,
  `shift_days` varchar(255) NOT NULL,
  `sub_department` varchar(255) NOT NULL,
  `sub_position` varchar(255) NOT NULL,
  `sub_id` varchar(255) NOT NULL,
  `mon_start` datetime NOT NULL,
  `mon_end` datetime NOT NULL,
  `tue_start` datetime NOT NULL,
  `tue_end` datetime NOT NULL,
  `wed_start` datetime NOT NULL,
  `wed_end` datetime NOT NULL,
  `thurs_start` datetime NOT NULL,
  `thurs_end` datetime NOT NULL,
  `fri_start` datetime NOT NULL,
  `fri_end` datetime NOT NULL,
  `sat_start` datetime NOT NULL,
  `sat_end` datetime NOT NULL,
  `sun_start` datetime NOT NULL,
  `sun_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rqst_shift`
--

INSERT INTO `rqst_shift` (`id`, `user_id`, `startdate`, `enddate`, `duration`, `reason`, `shift_status`, `shift_days`, `sub_department`, `sub_position`, `sub_id`, `mon_start`, `mon_end`, `tue_start`, `tue_end`, `wed_start`, `wed_end`, `thurs_start`, `thurs_end`, `fri_start`, `fri_end`, `sat_start`, `sat_end`, `sun_start`, `sun_end`) VALUES
(7, 2, '2016-08-16', '2016-08-23', 7, 'asd', 'requested', 'asdasd', 'asd', 'qwerty', '2016082', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00', '2016-08-12 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `day` varchar(255) NOT NULL,
  `work_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `user_id`, `color`, `start`, `end`, `day`, `work_status`) VALUES
(100, '2016083', '#264281', '2016-08-17 00:00:00', '2016-08-17 00:00:00', 'Wed', 'inactive'),
(101, '2016083', '#264281', '2016-08-18 06:00:00', '2016-08-18 14:00:00', 'Thu', 'active'),
(102, '2016083', '#264281', '2016-08-19 14:00:00', '2016-08-19 22:00:00', 'Fri', 'active'),
(103, '2016083', '#264281', '2016-08-20 00:00:00', '2016-08-20 00:00:00', 'Sat', 'inactive'),
(104, '2016083', '#264281', '2016-08-21 00:00:00', '2016-08-21 00:00:00', 'Sun', 'inactive'),
(105, '2016083', '#f6ba3e', '2016-08-22 06:00:00', '2016-08-22 14:00:00', 'Mon', 'leave'),
(106, '2016083', '#f6ba3e', '2016-08-23 14:00:00', '2016-08-23 22:00:00', 'Tue', 'leave'),
(107, '2016083', '#264281', '2016-08-24 00:00:00', '2016-08-24 00:00:00', 'Wed', 'inactive'),
(108, '2016083', '#f6ba3e', '2016-08-25 06:00:00', '2016-08-25 14:00:00', 'Thu', 'leave'),
(109, '2016083', '#f6ba3e', '2016-08-26 14:00:00', '2016-08-26 22:00:00', 'Fri', 'leave'),
(110, '2016083', '#264281', '2016-08-27 00:00:00', '2016-08-27 00:00:00', 'Sat', 'inactive'),
(111, '2016083', '#264281', '2016-08-28 00:00:00', '2016-08-28 00:00:00', 'Sun', 'inactive'),
(112, '2016083', '#264281', '2016-08-29 06:00:00', '2016-08-29 14:00:00', 'Mon', 'active'),
(113, '2016083', '#264281', '2016-08-30 14:00:00', '2016-08-30 22:00:00', 'Tue', 'active'),
(114, '2016083', '#264281', '2016-08-31 00:00:00', '2016-08-31 00:00:00', 'Wed', 'inactive'),
(115, '2016083', '#264281', '2016-09-01 06:00:00', '2016-09-01 14:00:00', 'Thu', 'active'),
(116, '2016083', '#264281', '2016-09-02 14:00:00', '2016-09-02 22:00:00', 'Fri', 'active'),
(117, '2016083', '#264281', '2016-09-03 00:00:00', '2016-09-03 00:00:00', 'Sat', 'inactive'),
(118, '2016083', '#264281', '2016-09-04 00:00:00', '2016-09-04 00:00:00', 'Sun', 'inactive'),
(119, '2016083', '#264281', '2016-09-05 06:00:00', '2016-09-05 14:00:00', 'Mon', 'active'),
(120, '2016083', '#264281', '2016-09-06 14:00:00', '2016-09-06 22:00:00', 'Tue', 'active'),
(121, '2016083', '#264281', '2016-09-07 00:00:00', '2016-09-07 00:00:00', 'Wed', 'inactive'),
(122, '2016083', '#264281', '2016-09-08 06:00:00', '2016-09-08 14:00:00', 'Thu', 'active'),
(123, '2016083', '#264281', '2016-09-09 14:00:00', '2016-09-09 22:00:00', 'Fri', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `semi_birtable`
--

CREATE TABLE `semi_birtable` (
  `id` int(11) NOT NULL,
  `cstatus` char(20) NOT NULL,
  `dependents` mediumint(5) NOT NULL,
  `minrange` float(10,2) NOT NULL,
  `maxrange` float(10,2) NOT NULL,
  `tax1` float(8,2) NOT NULL,
  `tax2` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semi_birtable`
--

INSERT INTO `semi_birtable` (`id`, `cstatus`, `dependents`, `minrange`, `maxrange`, `tax1`, `tax2`) VALUES
(1, 's/me', 0, 2083.00, 2499.99, 0.00, 0.05),
(2, 's/me', 0, 2500.00, 3332.99, 20.83, 0.10),
(3, 's/me', 0, 3333.00, 4999.99, 104.17, 0.15),
(4, 's/me', 0, 5000.00, 7916.99, 354.17, 0.20),
(5, 's/me', 0, 7917.00, 12499.99, 937.50, 0.25),
(6, 's/me', 0, 12500.00, 22916.99, 2083.33, 0.30),
(7, 's/me', 0, 22917.00, 1000000.00, 5208.33, 0.32),
(8, 's1/me1', 1, 3125.00, 3541.99, 0.00, 0.05),
(9, 's1/me1', 1, 3542.00, 4374.99, 20.83, 0.10),
(10, 's1/me1', 1, 4375.00, 6041.99, 104.17, 0.15),
(11, 's1/me1', 1, 6042.00, 8957.99, 354.17, 0.20),
(12, 's1/me1', 1, 8958.00, 13541.99, 937.50, 0.25),
(13, 's1/me1', 1, 13542.00, 23957.99, 2083.33, 0.30),
(14, 's1/me1', 1, 23958.00, 1000000.00, 5208.33, 0.32),
(15, 's2/me2', 2, 4167.00, 4582.99, 0.00, 0.05),
(16, 's2/me2', 2, 4583.00, 5416.99, 20.83, 0.10),
(17, 's2/me2', 2, 5417.00, 7082.99, 104.17, 0.15),
(18, 's2/me2', 2, 7083.00, 9999.99, 354.17, 0.20),
(19, 's2/me2', 2, 10000.00, 14582.99, 937.50, 0.25),
(20, 's2/me2', 2, 14583.00, 24999.99, 2083.33, 0.30),
(21, 's2/me2', 2, 25000.00, 1000000.00, 5208.33, 0.32),
(22, 's3/me3', 3, 5208.00, 5624.99, 0.00, 0.05),
(23, 's3/me3', 3, 5625.00, 6457.99, 20.83, 0.10),
(24, 's3/me3', 3, 6458.00, 8124.99, 104.17, 0.15),
(25, 's3/me3', 3, 8125.00, 11041.99, 354.17, 0.20),
(26, 's3/me3', 3, 11042.00, 15624.99, 937.50, 0.25),
(27, 's3/me3', 3, 15625.00, 26041.99, 2083.33, 0.30),
(28, 's3/me3', 3, 26042.00, 1000000.00, 5208.33, 0.32),
(29, 's4/me4', 4, 6250.00, 6666.99, 0.00, 0.05),
(30, 's4/me4', 4, 6667.00, 7499.99, 20.83, 0.10),
(31, 's4/me4', 4, 7500.00, 9166.99, 104.17, 0.15),
(32, 's4/me4', 4, 9167.00, 12082.99, 354.17, 0.20),
(33, 's4/me4', 4, 12083.00, 16666.99, 937.50, 0.25),
(34, 's4/me4', 4, 16667.00, 27082.99, 2083.33, 0.30),
(35, 's4/me4', 4, 27083.00, 1000000.00, 5208.33, 0.32);

-- --------------------------------------------------------

--
-- Table structure for table `sss`
--

CREATE TABLE `sss` (
  `id` int(8) NOT NULL,
  `min_salary` float(8,2) NOT NULL,
  `max_salary` float(8,2) NOT NULL,
  `employer` float(8,2) NOT NULL,
  `employee` float(8,2) NOT NULL,
  `total` float(8,2) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sss`
--

INSERT INTO `sss` (`id`, `min_salary`, `max_salary`, `employer`, `employee`, `total`, `status`) VALUES
(1, 1000.00, 1249.99, 73.70, 36.30, 110.00, 1),
(2, 1250.00, 1749.99, 110.50, 54.50, 165.00, 1),
(3, 1750.00, 2249.99, 147.30, 72.70, 220.00, 1),
(4, 2250.00, 2749.99, 184.20, 90.80, 275.00, 1),
(5, 2750.00, 3249.99, 221.00, 109.00, 330.00, 1),
(6, 3250.00, 3749.99, 257.80, 127.20, 385.00, 1),
(7, 3750.00, 4249.99, 294.70, 145.30, 440.00, 1),
(8, 4250.00, 4749.99, 331.50, 163.50, 495.00, 1),
(9, 4750.00, 5249.99, 368.30, 181.70, 550.00, 1),
(10, 5250.00, 5749.99, 405.20, 199.80, 605.00, 1),
(11, 5740.00, 6249.99, 442.00, 218.00, 660.00, 1),
(12, 6250.00, 6749.99, 478.80, 236.20, 715.00, 1),
(13, 6750.00, 7249.99, 515.70, 254.30, 770.00, 1),
(14, 7250.00, 7749.99, 552.50, 272.50, 825.00, 1),
(15, 7750.00, 8249.99, 589.30, 290.70, 880.00, 1),
(16, 8250.00, 8749.99, 626.20, 308.80, 935.00, 1),
(17, 8750.00, 9249.99, 663.00, 327.00, 990.00, 1),
(18, 9250.00, 9749.99, 699.80, 345.20, 1045.00, 1),
(19, 9750.00, 10249.99, 736.70, 363.30, 1100.00, 1),
(20, 10250.00, 10749.99, 773.50, 381.50, 1155.00, 1),
(21, 10750.00, 11249.99, 810.30, 399.70, 1210.00, 1),
(22, 11250.00, 11749.99, 847.20, 417.80, 1265.00, 1),
(23, 11750.00, 12249.99, 884.00, 436.00, 1320.00, 1),
(24, 12250.00, 12749.99, 920.80, 454.20, 1375.00, 1),
(25, 12750.00, 13249.99, 957.70, 472.30, 1430.00, 1),
(26, 13250.00, 13749.99, 994.50, 490.50, 1485.00, 1),
(27, 13750.00, 14249.99, 1031.30, 508.70, 1540.00, 1),
(28, 14250.00, 14749.99, 1068.20, 526.80, 1595.00, 1),
(29, 14750.00, 15249.99, 1105.00, 545.00, 1650.00, 1),
(30, 15250.00, 15749.99, 1141.80, 563.20, 1705.00, 1),
(31, 15750.00, 1000000.00, 1178.70, 581.30, 1760.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timelogs`
--

CREATE TABLE `timelogs` (
  `id` bigint(12) NOT NULL,
  `emp_id` varchar(200) NOT NULL,
  `timein` varchar(200) NOT NULL,
  `timeout` varchar(200) NOT NULL,
  `created_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timelogs`
--

INSERT INTO `timelogs` (`id`, `emp_id`, `timein`, `timeout`, `created_date`) VALUES
(1, 'EMP0001', '8:05', '18:30', '1/1/2016'),
(2, 'EMP0001', '7:45', '17:10', '1/24/2016'),
(3, 'EMP0002', '8:15', '17:12', '1/10/2016'),
(4, '2002-0057', '9:05', '18:10', '1/5/2016'),
(5, '20-200727371', '8:55', '18:25', '1/6/2016'),
(6, '2002-0057', '8:16', '17:05', '1/8/2016'),
(7, '2002-0057', '7:55', '17:02', '1/9/2016'),
(8, '2002-0057', '7:45', '17:01', '1/10/2016'),
(9, '2002-0057', '8:05', '17:05', '1/11/2016'),
(10, '2002-0057', '8:00', '17:02', '1/12/2016'),
(11, '2002-0057', '7:50', '17:01', '1/13/2016'),
(12, '2002-0057', '8:12', '17:05', '1/14/2016'),
(13, '2002-0057', '8:08', '17:02', '1/15/2016'),
(14, 'EMP0002', '8:00', '17:01', '1/5/2016'),
(15, 'EMP0002', '8:06', '17:05', '1/6/2016'),
(16, 'EMP0002', '8:12', '17:02', '1/8/2016'),
(17, 'EMP0002', '8:18', '17:01', '1/9/2016'),
(18, 'EMP0002', '8:24', '17:05', '1/10/2016'),
(19, 'EMP0002', '8:30', '17:02', '1/11/2016'),
(20, 'EMP0002', '8:36', '17:01', '1/12/2016'),
(21, 'EMP0002', '8:42', '17:05', '1/13/2016'),
(22, 'EMP0002', '8:48', '17:02', '1/14/2016'),
(23, 'EMP0002', '8:54', '17:01', '1/15/2016'),
(24, 'EMP0002', '9:01', '18:06', '1/7/2016'),
(25, 'EMP0002', '8:16', '17:35', '1/4/2016'),
(26, 'EMP0002', '9:01', '18:06', '1/7/2016'),
(27, 'EMP0002', '8:16', '17:35', '1/4/2016'),
(28, 'EMP0002', '9:01', '18:06', '1/7/2016'),
(29, 'EMP0002', '8:16', '17:35', '1/4/2016');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `img_name` varchar(32) NOT NULL,
  `thumb_name` varchar(32) NOT NULL,
  `ext` varchar(8) NOT NULL,
  `upload_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userlevel`
--

CREATE TABLE `userlevel` (
  `levelid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlevel`
--

INSERT INTO `userlevel` (`levelid`, `title`, `status`) VALUES
(1, 'accountant', 1),
(2, 'hr', 1),
(3, 'employee', 1);

-- --------------------------------------------------------

--
-- Table structure for table `yearperiod`
--

CREATE TABLE `yearperiod` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yearperiod`
--

INSERT INTO `yearperiod` (`id`, `title`, `status`) VALUES
(1, '2015', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `13month`
--
ALTER TABLE `13month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bir_table`
--
ALTER TABLE `bir_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branddetails`
--
ALTER TABLE `branddetails`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`emp_details_id`);

--
-- Indexes for table `emp_contributions`
--
ALTER TABLE `emp_contributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_status`
--
ALTER TABLE `emp_status`
  ADD PRIMARY KEY (`emp_ID`);

--
-- Indexes for table `emp_workschedule`
--
ALTER TABLE `emp_workschedule`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payperiod`
--
ALTER TABLE `payperiod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip`
--
ALTER TABLE `payslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `philhealth_table`
--
ALTER TABLE `philhealth_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rqst_leaves`
--
ALTER TABLE `rqst_leaves`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `rqst_overtime`
--
ALTER TABLE `rqst_overtime`
  ADD PRIMARY KEY (`overtime_id`);

--
-- Indexes for table `rqst_shift`
--
ALTER TABLE `rqst_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semi_birtable`
--
ALTER TABLE `semi_birtable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sss`
--
ALTER TABLE `sss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timelogs`
--
ALTER TABLE `timelogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`levelid`);

--
-- Indexes for table `yearperiod`
--
ALTER TABLE `yearperiod`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `13month`
--
ALTER TABLE `13month`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bir_table`
--
ALTER TABLE `bir_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `branddetails`
--
ALTER TABLE `branddetails`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `emp_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `emp_contributions`
--
ALTER TABLE `emp_contributions`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emp_status`
--
ALTER TABLE `emp_status`
  MODIFY `emp_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `emp_workschedule`
--
ALTER TABLE `emp_workschedule`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payperiod`
--
ALTER TABLE `payperiod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `payslip`
--
ALTER TABLE `payslip`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `philhealth_table`
--
ALTER TABLE `philhealth_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rqst_leaves`
--
ALTER TABLE `rqst_leaves`
  MODIFY `leave_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rqst_overtime`
--
ALTER TABLE `rqst_overtime`
  MODIFY `overtime_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rqst_shift`
--
ALTER TABLE `rqst_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `semi_birtable`
--
ALTER TABLE `semi_birtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `sss`
--
ALTER TABLE `sss`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `timelogs`
--
ALTER TABLE `timelogs`
  MODIFY `id` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userlevel`
--
ALTER TABLE `userlevel`
  MODIFY `levelid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `yearperiod`
--
ALTER TABLE `yearperiod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
