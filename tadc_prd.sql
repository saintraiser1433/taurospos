-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 31, 2024 at 04:47 PM
-- Server version: 8.2.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tadc_prd`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth`
--

DROP TABLE IF EXISTS `tbl_auth`;
CREATE TABLE IF NOT EXISTS `tbl_auth` (
  `auth_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`auth_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_auth`
--

INSERT INTO `tbl_auth` (`auth_id`, `first_name`, `last_name`, `status`, `role`, `date_created`, `username`, `password`) VALUES
(1, 'John Rey', 'Decosta', 1, 'Staff', '2024-03-31 21:50:17', 'staff', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `transact_by` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `item_id`, `quantity`, `transact_by`, `date_created`) VALUES
(7, 3, 1, 1, '2024-03-31 22:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `status`, `date_created`) VALUES
(7, 'test2', 1, '2024-03-31 18:43:22'),
(6, 'vbvbv', 1, '2024-03-30 15:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

DROP TABLE IF EXISTS `tbl_customers`;
CREATE TABLE IF NOT EXISTS `tbl_customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `age` int NOT NULL,
  `phone` varchar(50) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `first_name`, `last_name`, `middle_name`, `address`, `age`, `phone`, `status`, `username`, `password`, `date_created`) VALUES
(4, 'john reyx', 'decostaxx', 'decostaxx', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi provident reprehenderit delectus culpa aliquid dolor laboriosam ex! Facilis atque, voluptate inventore maiores officia voluptatum sint suscipit dolore? Magni, reprehenderit impedit!', 13, '+639301712312', 1, 'decostaxx_john55', 'test123', '2024-03-30 22:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discount`
--

DROP TABLE IF EXISTS `tbl_discount`;
CREATE TABLE IF NOT EXISTS `tbl_discount` (
  `discount_id` int NOT NULL AUTO_INCREMENT,
  `discount_name` varchar(100) NOT NULL,
  `discount_percent` int NOT NULL,
  `points` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`discount_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_discount`
--

INSERT INTO `tbl_discount` (`discount_id`, `discount_name`, `discount_percent`, `points`, `status`, `date_created`) VALUES
(1, 'testxx', 1, 123, 1, '2024-03-30 23:22:45'),
(3, 'Loyalty Award', 10, 20, 1, '2024-03-31 21:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

DROP TABLE IF EXISTS `tbl_inventory`;
CREATE TABLE IF NOT EXISTS `tbl_inventory` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `item_code` varchar(100) NOT NULL,
  `category_id` int NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `price` double(50,2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_path` varchar(100) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`item_id`, `item_code`, `category_id`, `item_name`, `description`, `price`, `status`, `date_created`, `img_path`) VALUES
(1, '2qnth3', 6, 'vxcvxc', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut quis suscipit qui consequuntur fugit accusantium voluptates ipsa eligendi placeat magni minus ex, quo impedit perferendis non laborum. Maiores, nam voluptatem?', 12.32, 1, '2024-03-30 16:43:20', 'no-image.png'),
(2, 'mo57d3', 7, '1xx', 'Legal (8.5 X 14 in)', 232.12, 1, '2024-03-30 17:24:52', 'item11711790692.png'),
(3, 'c4grfq', 7, 'dasd', 'gfgdfggf', 12.23, 1, '2024-03-31 18:56:06', 'dasd1711882566.png'),
(4, 'u69qci', 7, 'Tarpaulin', 'gfdgdfg', 12.23, 1, '2024-03-31 19:21:13', 'Tarpaulin1711884073.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

DROP TABLE IF EXISTS `tbl_payments`;
CREATE TABLE IF NOT EXISTS `tbl_payments` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `amount` double(50,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `reference_number` varchar(100) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_detail`
--

DROP TABLE IF EXISTS `tbl_transaction_detail`;
CREATE TABLE IF NOT EXISTS `tbl_transaction_detail` (
  `trans_detail_id` int NOT NULL AUTO_INCREMENT,
  `transaction_head_id` int NOT NULL,
  `item_id` int NOT NULL,
  PRIMARY KEY (`trans_detail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_head`
--

DROP TABLE IF EXISTS `tbl_transaction_head`;
CREATE TABLE IF NOT EXISTS `tbl_transaction_head` (
  `transaction_head_id` int NOT NULL AUTO_INCREMENT,
  `transaction_no` varchar(100) NOT NULL,
  `client_id` int NOT NULL,
  `pick_up_date` date NOT NULL,
  `payment_status` int NOT NULL DEFAULT '0' COMMENT '	0=Unpaid, 1=partially paid, 2= paid',
  `receive_status` int NOT NULL DEFAULT '0' COMMENT '	0=pending, 1= On-process, 2= done	',
  `total_amount` double(50,2) NOT NULL,
  `transact_by` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_head_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
