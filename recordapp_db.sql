-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2022 at 11:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recordapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `office_id` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `lastname`, `firstname`, `office_id`, `address`) VALUES
(1, 'Doe', 'Jane', 3, 'PPC'),
(2, 'Doe', 'John', 1, 'Roxas'),
(3, 'Reid', 'Spence', 1, NULL),
(4, 'Martinez', 'Kristine Joy', 3, ''),
(5, 'demo', 'demo', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `contactnum` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `postal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`id`, `name`, `contactnum`, `email`, `address`, `city`, `country`, `postal`) VALUES
(1, 'Computer Studies Department', '433-5684', 'csd@psu.palawan.edu.ph', 'IT Building', 'Puerto Princesa', 'Philippines', 5300),
(2, 'CS Dean\'s Office', '433-5686', 'cs@psu.palawan.edu.ph', 'CS Building', 'Puerto Princesa', 'Philippines', 5300),
(3, 'Creative Code Inc.', '433-5685', 'cci@gmail.com', '', '', '', 5300),
(4, 'Creative Code Inc.', '433-5685', 'cci@gmail.com', '', '', '', 5300),
(5, 'Office of the President', '433-1234', 'oup@psu.palawan.edu.ph', 'Admin building', '', '', 5300);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `datelog` datetime DEFAULT current_timestamp(),
  `action` enum('IN','OUT','COMPLETE') DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `documentcode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `employee_id`, `office_id`, `datelog`, `action`, `remarks`, `documentcode`) VALUES
(1, 3, 1, '2022-03-19 09:55:16', 'IN', NULL, '100'),
(2, 3, 2, '2022-03-19 09:55:37', 'OUT', NULL, '100'),
(3, 3, 1, '2022-03-19 09:55:53', 'COMPLETE', NULL, '100'),
(4, 3, 1, '2022-03-19 09:55:30', 'OUT', 'Signed', '100'),
(5, 3, 2, '2022-03-19 09:55:32', 'IN', 'For approval', '100'),
(6, 2, 3, '2022-03-19 09:55:17', 'IN', NULL, '101'),
(7, 2, 3, '2022-03-19 09:59:16', 'OUT', NULL, '101'),
(8, 2, 1, '2022-10-15 17:14:41', 'OUT', 'test', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_id` (`office_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_id` (`office_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `office` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `office` (`id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
