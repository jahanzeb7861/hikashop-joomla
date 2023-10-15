-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2023 at 10:10 PM
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
-- Table structure for table `kuv9p_hikashop_address`
--

CREATE TABLE `kuv9p_hikashop_address` (
  `address_id` int(10) UNSIGNED NOT NULL,
  `address_user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `address_type` varchar(50) NOT NULL DEFAULT '',
  `address_title` varchar(255) DEFAULT NULL,
  `address_firstname` varchar(255) DEFAULT NULL,
  `address_middle_name` varchar(255) DEFAULT NULL,
  `address_lastname` varchar(255) DEFAULT NULL,
  `address_company` varchar(255) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_street2` varchar(255) NOT NULL DEFAULT '',
  `address_post_code` varchar(255) DEFAULT NULL,
  `address_city` varchar(255) DEFAULT NULL,
  `address_telephone` varchar(255) DEFAULT NULL,
  `address_telephone2` varchar(255) DEFAULT NULL,
  `address_fax` varchar(255) DEFAULT NULL,
  `address_state` varchar(255) DEFAULT NULL,
  `address_country` varchar(255) DEFAULT NULL,
  `address_published` tinyint(4) NOT NULL DEFAULT 1,
  `address_vat` varchar(255) DEFAULT NULL,
  `address_default` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kuv9p_hikashop_address`
--

INSERT INTO `kuv9p_hikashop_address` (`address_id`, `address_user_id`, `address_type`, `address_title`, `address_firstname`, `address_middle_name`, `address_lastname`, `address_company`, `address_street`, `address_street2`, `address_post_code`, `address_city`, `address_telephone`, `address_telephone2`, `address_fax`, `address_state`, `address_country`, `address_published`, `address_vat`, `address_default`) VALUES
(1, 0, '', 'Mr', 'abu bakar', NULL, 'pervaiz', NULL, 'test addresss', '', '38000', 'faisalabad', '0304', NULL, NULL, 'state____________2806', 'country_Pakistan_162', 1, NULL, 0),
(2, 0, 'billing', 'Mr', 'Dilawar', NULL, 'Javaid', NULL, 'Unit # 905 79 Thorncliffe Park Drive', '', 'K1K4T3', 'Toronto', '+1 (647) 570-5502', NULL, NULL, 'Ontario ', 'Canada', 0, NULL, 0),
(3, 0, '', 'Mr', 'Dilawar', NULL, 'Javaid', NULL, 'Unit # 905 79 Thorncliffe Park Drive', '', 'K1K4T3', 'Toronto', '+1 (647) 570-5502', NULL, NULL, 'Ontario ', 'Canada', 1, NULL, 0),
(4, 0, 'shipping', 'Mr', 'Dilawar', NULL, 'Javaid', NULL, 'Unit # 905 79 Thorncliffe Park Drive', '', 'K1K4T3', 'Toronto', '+1 (647) 570-5502', NULL, NULL, 'Ontario ', 'Canada', 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kuv9p_hikashop_address`
--
ALTER TABLE `kuv9p_hikashop_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address_user_id` (`address_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuv9p_hikashop_address`
--
ALTER TABLE `kuv9p_hikashop_address`
  MODIFY `address_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
