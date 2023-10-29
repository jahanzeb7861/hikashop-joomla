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
-- Table structure for table `kuv9p_hikashop_order`
--

CREATE TABLE `kuv9p_hikashop_order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `order_billing_address_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_shipping_address_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_status` varchar(255) NOT NULL DEFAULT '',
  `order_type` varchar(255) NOT NULL DEFAULT 'sale',
  `order_number` varchar(255) NOT NULL DEFAULT '',
  `order_created` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_modified` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_invoice_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_invoice_number` varchar(255) NOT NULL DEFAULT '',
  `order_invoice_created` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_currency_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_currency_info` text DEFAULT NULL,
  `order_full_price` decimal(17,5) NOT NULL DEFAULT 0.00000,
  `order_tax_info` text DEFAULT NULL,
  `order_discount_code` varchar(255) NOT NULL DEFAULT '',
  `order_discount_price` decimal(17,5) NOT NULL DEFAULT 0.00000,
  `order_discount_tax` decimal(17,5) NOT NULL DEFAULT 0.00000,
  `order_payment_id` varchar(255) NOT NULL DEFAULT '',
  `order_payment_method` varchar(255) NOT NULL DEFAULT '',
  `order_payment_price` decimal(17,5) NOT NULL DEFAULT 0.00000,
  `order_payment_tax` decimal(17,5) NOT NULL DEFAULT 0.00000,
  `order_payment_params` text DEFAULT NULL,
  `order_shipping_id` varchar(255) NOT NULL DEFAULT '',
  `order_shipping_method` varchar(255) NOT NULL DEFAULT '',
  `order_shipping_price` decimal(17,5) NOT NULL DEFAULT 0.00000,
  `order_shipping_tax` decimal(17,5) NOT NULL DEFAULT 0.00000,
  `order_shipping_params` text DEFAULT NULL,
  `order_partner_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_partner_price` decimal(17,5) NOT NULL DEFAULT 0.00000,
  `order_partner_paid` int(11) NOT NULL DEFAULT 0,
  `order_partner_currency_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_ip` varchar(255) NOT NULL DEFAULT '',
  `order_site_id` varchar(255) DEFAULT '',
  `order_lang` varchar(255) DEFAULT '',
  `order_token` varchar(255) DEFAULT '',
  `order_weight` decimal(12,3) UNSIGNED DEFAULT NULL,
  `order_weight_unit` varchar(255) DEFAULT NULL,
  `order_volume` decimal(12,3) UNSIGNED DEFAULT NULL,
  `order_dimension_unit` varchar(255) DEFAULT NULL,
  `tracking_numbers` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kuv9p_hikashop_order`
--

INSERT INTO `kuv9p_hikashop_order` (`order_id`, `order_billing_address_id`, `order_shipping_address_id`, `order_user_id`, `order_parent_id`, `order_status`, `order_type`, `order_number`, `order_created`, `order_modified`, `order_invoice_id`, `order_invoice_number`, `order_invoice_created`, `order_currency_id`, `order_currency_info`, `order_full_price`, `order_tax_info`, `order_discount_code`, `order_discount_price`, `order_discount_tax`, `order_payment_id`, `order_payment_method`, `order_payment_price`, `order_payment_tax`, `order_payment_params`, `order_shipping_id`, `order_shipping_method`, `order_shipping_price`, `order_shipping_tax`, `order_shipping_params`, `order_partner_id`, `order_partner_price`, `order_partner_paid`, `order_partner_currency_id`, `order_ip`, `order_site_id`, `order_lang`, `order_token`, `order_weight`, `order_weight_unit`, `order_volume`, `order_dimension_unit`, `tracking_numbers`) VALUES
(1, 2, 4, 1, 0, 'shipped', 'sale', 'B1', 1695310673, 1697746484, 1, 'B1', 1697746484, 1, NULL, '50.00000', 'a:1:{i:-1;O:8:\"stdClass\":3:{s:11:\"tax_namekey\";i:-1;s:10:\"tax_amount\";d:0;s:6:\"amount\";d:50;}}', '', '0.00000', '0.00000', '', '', '0.00000', '0.00000', 'O:8:\"stdClass\":0:{}', '', '', '0.00000', '0.00000', 'O:8:\"stdClass\":0:{}', 0, '0.00000', 0, 0, '', '', 'en-GB', 'hnbWSTx9', '5.000', 'kg', '5.000', 'm', '1234 5678 9012, 1234 5678 9012 '),
(2, 0, 0, 1, 0, 'shipped', 'sale', 'C2', 1697656895, 1697656949, 0, '', 0, 1, NULL, '0.00000', 'a:1:{i:-1;O:8:\"stdClass\":3:{s:11:\"tax_namekey\";i:-1;s:10:\"tax_amount\";i:0;s:6:\"amount\";i:0;}}', '', '0.00000', '0.00000', '', '', '0.00000', '0.00000', 'O:8:\"stdClass\":0:{}', '', '', '0.00000', '0.00000', 'O:8:\"stdClass\":0:{}', 0, '0.00000', 0, 0, '', '', 'en-GB', 'uY3EOJcb', '0.000', 'kg', '0.000', 'm', '1234 5678 9012'),
(3, 0, 0, 0, 0, 'created', 'sale', 'D3', 1698259781, 1698259781, 0, '', 0, 1, NULL, '0.00000', NULL, '', '0.00000', '0.00000', '', '', '0.00000', '0.00000', NULL, '', '', '0.00000', '0.00000', NULL, 0, '0.00000', 0, 0, '', '', 'en-GB', 'DSmXUjdU', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kuv9p_hikashop_order`
--
ALTER TABLE `kuv9p_hikashop_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_user_id` (`order_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuv9p_hikashop_order`
--
ALTER TABLE `kuv9p_hikashop_order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
