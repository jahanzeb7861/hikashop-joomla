-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2023 at 10:52 AM
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
-- Table structure for table `kuv9p_hikashop_field`
--

CREATE TABLE `kuv9p_hikashop_field` (
  `field_id` smallint(5) UNSIGNED NOT NULL,
  `field_table` varchar(50) DEFAULT NULL,
  `field_realname` varchar(250) NOT NULL,
  `field_namekey` varchar(50) NOT NULL,
  `field_type` varchar(50) DEFAULT NULL,
  `field_value` longtext NOT NULL,
  `field_published` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `field_ordering` smallint(5) UNSIGNED DEFAULT 99,
  `field_options` longtext DEFAULT NULL,
  `field_core` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `field_required` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `field_default` longtext NOT NULL,
  `field_access` varchar(255) NOT NULL DEFAULT 'all',
  `field_categories` text DEFAULT NULL,
  `field_with_sub_categories` tinyint(1) NOT NULL DEFAULT 0,
  `field_products` text DEFAULT NULL,
  `field_address_type` varchar(50) DEFAULT '',
  `field_frontcomp` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `field_backend` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `field_backend_listing` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `field_display` text DEFAULT NULL,
  `field_shipping_id` varchar(255) NOT NULL DEFAULT '',
  `field_payment_id` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kuv9p_hikashop_field`
--

INSERT INTO `kuv9p_hikashop_field` (`field_id`, `field_table`, `field_realname`, `field_namekey`, `field_type`, `field_value`, `field_published`, `field_ordering`, `field_options`, `field_core`, `field_required`, `field_default`, `field_access`, `field_categories`, `field_with_sub_categories`, `field_products`, `field_address_type`, `field_frontcomp`, `field_backend`, `field_backend_listing`, `field_display`, `field_shipping_id`, `field_payment_id`) VALUES
(1, 'address', 'Title', 'address_title', 'singledropdown', 'Mr::HIKA_TITLE_MR\nMrs::HIKA_TITLE_MRS\nMiss::HIKA_TITLE_MISS\nMs::HIKA_TITLE_MS\nDr::HIKA_TITLE_DR', 1, 1, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 1, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(2, 'address', 'Firstname', 'address_firstname', 'text', '', 1, 2, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 1, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(3, 'address', 'Middle name', 'address_middle_name', 'text', '', 0, 3, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 0, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(4, 'address', 'Lastname', 'address_lastname', 'text', '', 1, 4, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 1, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(5, 'address', 'Company', 'address_company', 'text', '', 0, 5, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 0, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(6, 'address', 'Street', 'address_street', 'text', '', 1, 6, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 1, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(7, 'address', 'Complement', 'address_street2', 'text', '', 0, 7, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 0, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(8, 'address', 'Post code', 'address_post_code', 'text', '', 1, 8, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 0, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(9, 'address', 'City', 'address_city', 'text', '', 1, 9, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 1, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(10, 'address', 'Telephone', 'address_telephone', 'text', '', 1, 10, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 1, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(11, 'address', 'Telephone', 'address_telephone2', 'text', '', 0, 11, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 0, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(12, 'address', 'Fax', 'address_fax', 'text', '', 0, 12, 'a:5:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 0, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(13, 'address', 'Country', 'address_country', 'zone', '', 1, 13, 'a:6:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:9:\"zone_type\";s:7:\"country\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 1, 'country_United_States_of_America_223', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(14, 'address', 'State', 'address_state', 'zone', '', 1, 14, 'a:6:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:9:\"zone_type\";s:5:\"state\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 1, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(15, 'address', 'VAT number', 'address_vat', 'text', '', 0, 15, 'a:6:{s:12:\"errormessage\";s:0:\"\";s:4:\"cols\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:9:\"zone_type\";s:7:\"country\";s:4:\"size\";s:0:\"\";s:6:\"format\";s:0:\"\";}', 1, 0, '', 'all', NULL, 0, NULL, '', 1, 1, 0, NULL, '', ''),
(20, 'address', 'Track 456', 'track_456', 'text', '', 1, 17, 'a:29:{s:12:\"errormessage\";s:0:\"\";s:5:\"regex\";s:0:\"\";s:9:\"attribute\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:6:\"inline\";s:1:\"0\";s:12:\"target_blank\";s:1:\"1\";s:9:\"allow_add\";s:1:\"0\";s:4:\"cols\";s:0:\"\";s:9:\"filtering\";s:1:\"1\";s:9:\"maxlength\";s:1:\"0\";s:4:\"rows\";s:0:\"\";s:9:\"zone_type\";s:7:\"country\";s:12:\"pleaseselect\";s:1:\"0\";s:4:\"size\";s:0:\"\";s:14:\"display_format\";s:0:\"\";s:6:\"format\";s:8:\"%Y-%m-%d\";s:5:\"allow\";s:0:\"\";s:18:\"allowed_extensions\";s:0:\"\";s:10:\"upload_dir\";s:0:\"\";s:12:\"max_filesize\";s:1:\"0\";s:11:\"thumbnail_x\";s:1:\"0\";s:11:\"thumbnail_y\";s:1:\"0\";s:9:\"max_width\";s:1:\"0\";s:10:\"max_height\";s:1:\"0\";s:12:\"delete_files\";s:1:\"0\";s:8:\"multiple\";s:1:\"0\";s:8:\"readonly\";s:1:\"0\";s:11:\"mysql_query\";s:0:\"\";s:18:\"datepicker_options\";a:14:{s:5:\"today\";s:1:\"0\";s:6:\"inline\";s:1:\"0\";s:12:\"monday_first\";s:1:\"0\";s:12:\"change_month\";s:1:\"0\";s:11:\"change_year\";s:1:\"0\";s:16:\"year_range_start\";s:0:\"\";s:14:\"year_range_end\";s:0:\"\";s:14:\"show_btn_panel\";s:1:\"0\";s:11:\"show_months\";s:1:\"1\";s:11:\"other_month\";s:1:\"0\";s:19:\"exclude_days_format\";s:3:\"mdY\";s:7:\"waiting\";s:0:\"\";s:14:\"hour_extra_day\";s:0:\"\";s:11:\"check_dates\";s:3:\"all\";}}', 0, 0, '', 'all', 'all', 0, '', '', 0, 1, 0, NULL, '', ''),
(19, 'address', 'Tracking Numbers', 'tracking_numbers', 'text', '', 1, 16, 'a:29:{s:12:\"errormessage\";s:0:\"\";s:5:\"regex\";s:0:\"\";s:9:\"attribute\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:6:\"inline\";s:1:\"0\";s:12:\"target_blank\";s:1:\"1\";s:9:\"allow_add\";s:1:\"0\";s:4:\"cols\";s:0:\"\";s:9:\"filtering\";s:1:\"1\";s:9:\"maxlength\";s:1:\"0\";s:4:\"rows\";s:0:\"\";s:9:\"zone_type\";s:7:\"country\";s:12:\"pleaseselect\";s:1:\"0\";s:4:\"size\";s:0:\"\";s:14:\"display_format\";s:0:\"\";s:6:\"format\";s:8:\"%Y-%m-%d\";s:5:\"allow\";s:0:\"\";s:18:\"allowed_extensions\";s:0:\"\";s:10:\"upload_dir\";s:0:\"\";s:12:\"max_filesize\";s:1:\"0\";s:11:\"thumbnail_x\";s:1:\"0\";s:11:\"thumbnail_y\";s:1:\"0\";s:9:\"max_width\";s:1:\"0\";s:10:\"max_height\";s:1:\"0\";s:12:\"delete_files\";s:1:\"0\";s:8:\"multiple\";s:1:\"0\";s:8:\"readonly\";s:1:\"0\";s:11:\"mysql_query\";s:0:\"\";s:18:\"datepicker_options\";a:14:{s:5:\"today\";s:1:\"0\";s:6:\"inline\";s:1:\"0\";s:12:\"monday_first\";s:1:\"0\";s:12:\"change_month\";s:1:\"0\";s:11:\"change_year\";s:1:\"0\";s:16:\"year_range_start\";s:0:\"\";s:14:\"year_range_end\";s:0:\"\";s:14:\"show_btn_panel\";s:1:\"0\";s:11:\"show_months\";s:1:\"1\";s:11:\"other_month\";s:1:\"0\";s:19:\"exclude_days_format\";s:3:\"mdY\";s:7:\"waiting\";s:0:\"\";s:14:\"hour_extra_day\";s:0:\"\";s:11:\"check_dates\";s:3:\"all\";}}', 0, 0, '', 'all', 'all', 0, '', '', 0, 1, 0, NULL, '', ''),
(21, 'address', 'Track 789', 'track_789', 'text', '', 1, 18, 'a:29:{s:12:\"errormessage\";s:0:\"\";s:5:\"regex\";s:0:\"\";s:9:\"attribute\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:6:\"inline\";s:1:\"0\";s:12:\"target_blank\";s:1:\"1\";s:9:\"allow_add\";s:1:\"0\";s:4:\"cols\";s:0:\"\";s:9:\"filtering\";s:1:\"1\";s:9:\"maxlength\";s:1:\"0\";s:4:\"rows\";s:0:\"\";s:9:\"zone_type\";s:7:\"country\";s:12:\"pleaseselect\";s:1:\"0\";s:4:\"size\";s:0:\"\";s:14:\"display_format\";s:0:\"\";s:6:\"format\";s:8:\"%Y-%m-%d\";s:5:\"allow\";s:0:\"\";s:18:\"allowed_extensions\";s:0:\"\";s:10:\"upload_dir\";s:0:\"\";s:12:\"max_filesize\";s:1:\"0\";s:11:\"thumbnail_x\";s:1:\"0\";s:11:\"thumbnail_y\";s:1:\"0\";s:9:\"max_width\";s:1:\"0\";s:10:\"max_height\";s:1:\"0\";s:12:\"delete_files\";s:1:\"0\";s:8:\"multiple\";s:1:\"0\";s:8:\"readonly\";s:1:\"0\";s:11:\"mysql_query\";s:0:\"\";s:18:\"datepicker_options\";a:14:{s:5:\"today\";s:1:\"0\";s:6:\"inline\";s:1:\"0\";s:12:\"monday_first\";s:1:\"0\";s:12:\"change_month\";s:1:\"0\";s:11:\"change_year\";s:1:\"0\";s:16:\"year_range_start\";s:0:\"\";s:14:\"year_range_end\";s:0:\"\";s:14:\"show_btn_panel\";s:1:\"0\";s:11:\"show_months\";s:1:\"1\";s:11:\"other_month\";s:1:\"0\";s:19:\"exclude_days_format\";s:3:\"mdY\";s:7:\"waiting\";s:0:\"\";s:14:\"hour_extra_day\";s:0:\"\";s:11:\"check_dates\";s:3:\"all\";}}', 0, 0, '', 'all', 'all', 0, '', '', 0, 1, 0, NULL, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kuv9p_hikashop_field`
--
ALTER TABLE `kuv9p_hikashop_field`
  ADD PRIMARY KEY (`field_id`),
  ADD UNIQUE KEY `field_namekey` (`field_namekey`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuv9p_hikashop_field`
--
ALTER TABLE `kuv9p_hikashop_field`
  MODIFY `field_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
