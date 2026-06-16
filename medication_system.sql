-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2026 at 07:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medication_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `medicine_name` varchar(50) DEFAULT NULL,
  `dosage` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `user_id`, `medicine_name`, `dosage`) VALUES
(2, 2, 'dolo 65', '1 tablet'),
(3, 3, 'dolo 65', '1 tablet'),
(4, 4, 'calf syrup', '500g'),
(6, 6, 'vitamin', '1 tablet'),
(7, 7, 'metroshelf', '1 tablet'),
(8, 8, 'Cetirizine', '1 tablet'),
(9, 9, 'Aspirin', '1 tablet'),
(10, 10, 'Aspirin', '1 tablet'),
(11, 11, 'Aspirin', '1 tablet');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `medicine_id`, `time`) VALUES
(2, 2, '22:51:00'),
(3, 3, '22:59:00'),
(4, 4, '09:27:00'),
(6, 6, '10:30:00'),
(7, 7, '15:55:00'),
(8, 8, '09:58:00'),
(9, 9, '13:51:00'),
(10, 10, '09:59:00'),
(11, 11, '13:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`) VALUES
(2, 'Jeeva L'),
(3, 'Harini'),
(4, 'divya'),
(6, 'abi'),
(7, 'kanniga'),
(8, 'Riya'),
(9, 'Riya'),
(10, 'deva'),
(11, 'Deva');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
