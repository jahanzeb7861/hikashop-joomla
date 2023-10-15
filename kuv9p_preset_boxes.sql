-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2023 at 09:13 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_joomla`
--

-- --------------------------------------------------------

--
-- Table structure for table `kuv9p_preset_boxes`
--

CREATE TABLE `kuv9p_preset_boxes` (
  `id` int(255) NOT NULL,
  `box_name` varchar(255) DEFAULT NULL,
  `box_unit_type` varchar(255) DEFAULT NULL,
  `box_length` varchar(255) DEFAULT NULL,
  `box_width` varchar(255) DEFAULT NULL,
  `box_height` varchar(255) DEFAULT NULL,
  `box_weight` varchar(255) DEFAULT NULL,
  `box_insurance` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuv9p_preset_boxes`
--

INSERT INTO `kuv9p_preset_boxes` (`id`, `box_name`, `box_unit_type`, `box_length`, `box_width`, `box_height`, `box_weight`, `box_insurance`) VALUES
(8, 'Box 1', 'Metric', '22', '21', '23', '21', '100'),
(9, 'Box 2', 'Metric', '33', '1', '3', '10', '100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kuv9p_preset_boxes`
--
ALTER TABLE `kuv9p_preset_boxes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuv9p_preset_boxes`
--
ALTER TABLE `kuv9p_preset_boxes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
