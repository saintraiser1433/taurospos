-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 14, 2024 at 02:46 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `borrows`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `login_session` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`, `login_session`) VALUES
(1, 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrower`
--

DROP TABLE IF EXISTS `tbl_borrower`;
CREATE TABLE IF NOT EXISTS `tbl_borrower` (
  `borrower_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `middle_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `department_id` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL,
  `status_approval` int NOT NULL,
  `front_id_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `back_id_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `login_session` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`borrower_id`),
  KEY `fk_tbl_department` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_borrower`
--

INSERT INTO `tbl_borrower` (`borrower_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `department_id`, `type`, `status`, `status_approval`, `front_id_path`, `back_id_path`, `username`, `password`, `date_created`, `login_session`) VALUES
('12312', 'fdfdsf', 'dasdasd', 'Fusingan', '639770372449', 2, 'Student', 1, 1, '../static/front/12312.png', '../static/back/12312.png', 'fussy', 'fussy', '0000-00-00 00:00:00', 0),
('312312', 'SDFSDF', 'FSDFDS', 'SDFSD', '09312312', 2, 'Student', 1, 1, '../static/front/312312.png', '../static/back/312312.png', 'johnadmin', '1234', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `item_code` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `borrower_id` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_item_code` (`item_code`),
  KEY `fk_cart_borrower_id` (`borrower_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `status`) VALUES
(3, 'category 1', 1),
(4, 'Category 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE IF NOT EXISTS `tbl_department` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`, `status`) VALUES
(2, 'department1xxx', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

DROP TABLE IF EXISTS `tbl_item`;
CREATE TABLE IF NOT EXISTS `tbl_item` (
  `item_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `item_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category_id` int NOT NULL,
  `size_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_code`),
  KEY `fk_category_id` (`category_id`),
  KEY `fk_size_id` (`size_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_code`, `item_name`, `category_id`, `size_id`, `quantity`, `status`, `description`, `img_path`, `date_created`) VALUES
('3x2pno', 'vvxc', 3, 2, 0, 0, 'dsfsd', 'vvxc1709923244.png', '2024-03-09 02:40:44'),
('l4csb7', 'Beaker', 3, 2, 29, 1, 'beaker description', 'Beaker1709819570.png', '2024-03-07 21:52:50'),
('ls6w95', 'TEST CATEGORY', 3, 2, 123, 1, 'CADAS', 'TEST CATEGORY1709825943.png', '2024-03-07 23:39:03'),
('ohb5s6', '123123', 4, 2, 21, 1, 'descriptiontgesst1', '1231231709817454.png', '2024-03-07 21:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penalty`
--

DROP TABLE IF EXISTS `tbl_penalty`;
CREATE TABLE IF NOT EXISTS `tbl_penalty` (
  `penalty_id` int NOT NULL AUTO_INCREMENT,
  `transaction_no` int NOT NULL,
  `amount` double(50,2) DEFAULT '100.00',
  `status` int NOT NULL DEFAULT '0',
  `date_paid` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`penalty_id`),
  KEY `fk_pen_trans_no` (`transaction_no`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_penalty`
--

INSERT INTO `tbl_penalty` (`penalty_id`, `transaction_no`, `amount`, `status`, `date_paid`) VALUES
(2, 95107349, 100.00, 1, '0000-00-00'),
(6, 57644223, 100.00, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_retirement`
--

DROP TABLE IF EXISTS `tbl_retirement`;
CREATE TABLE IF NOT EXISTS `tbl_retirement` (
  `retirement_id` int NOT NULL AUTO_INCREMENT,
  `item_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantity` int NOT NULL,
  `remarks` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_retirement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`retirement_id`),
  KEY `fk_item_code2` (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_retirement`
--

INSERT INTO `tbl_retirement` (`retirement_id`, `item_code`, `quantity`, `remarks`, `date_retirement`) VALUES
(10, '3x2pno', 1, '1', '2024-03-09 02:41:05'),
(11, '3x2pno', 1, 'fdsf', '2024-03-09 02:41:17'),
(12, '3x2pno', 1, 'fdsfs', '2024-03-09 02:42:21'),
(13, '3x2pno', 1, 'sdfds', '2024-03-09 02:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

DROP TABLE IF EXISTS `tbl_size`;
CREATE TABLE IF NOT EXISTS `tbl_size` (
  `size_id` int NOT NULL AUTO_INCREMENT,
  `size_description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`size_id`, `size_description`) VALUES
(2, '123mm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_in`
--

DROP TABLE IF EXISTS `tbl_stock_in`;
CREATE TABLE IF NOT EXISTS `tbl_stock_in` (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `item_code` varchar(100) NOT NULL,
  `old_quantity` int NOT NULL,
  `added_quantity` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stock_id`),
  KEY `fk_stock_item_code` (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_stock_in`
--

INSERT INTO `tbl_stock_in` (`stock_id`, `item_code`, `old_quantity`, `added_quantity`, `date_added`) VALUES
(2, 'l4csb7', 25, 2, '2024-03-09 01:08:01'),
(3, 'l4csb7', 27, 2, '2024-03-09 01:08:18'),
(8, '3x2pno', 0, 2, '2024-03-09 02:40:57'),
(9, '3x2pno', 0, 2, '2024-03-09 02:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_detail`
--

DROP TABLE IF EXISTS `tbl_transaction_detail`;
CREATE TABLE IF NOT EXISTS `tbl_transaction_detail` (
  `trans_item_id` int NOT NULL AUTO_INCREMENT,
  `transaction_no` int NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `return_quantity` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '4',
  PRIMARY KEY (`trans_item_id`),
  KEY `fk_dtl_item_code` (`item_code`),
  KEY `fk_dtl_transaction_no` (`transaction_no`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_transaction_detail`
--

INSERT INTO `tbl_transaction_detail` (`trans_item_id`, `transaction_no`, `item_code`, `quantity`, `return_quantity`, `status`) VALUES
(7, 20294498, 'ohb5s6', 2, 2, 0),
(8, 20294498, 'ls6w95', 2, 2, 0),
(10, 57837994, 'ohb5s6', 1, 0, 5),
(11, 57837994, 'l4csb7', 2, 0, 5),
(13, 5899442, 'ohb5s6', 1, 0, 5),
(14, 5899442, 'l4csb7', 1, 0, 5),
(16, 98268094, 'ohb5s6', 1, 1, 0),
(17, 98268094, 'l4csb7', 2, 2, 0),
(19, 21680979, 'ohb5s6', 1, 1, 0),
(20, 21680979, 'l4csb7', 1, 1, 0),
(22, 48590568, 'ohb5s6', 1, 1, 0),
(23, 48590568, 'l4csb7', 2, 2, 0),
(25, 5428495, 'ohb5s6', 1, 1, 0),
(26, 5428495, 'l4csb7', 1, 1, 0),
(28, 95274448, 'ohb5s6', 1, 1, 0),
(29, 95274448, 'l4csb7', 1, 1, 0),
(31, 35480184, 'ohb5s6', 1, 1, 0),
(32, 35480184, 'l4csb7', 1, 1, 0),
(34, 95107349, 'ohb5s6', 1, 1, 0),
(35, 95107349, 'l4csb7', 1, 1, 0),
(37, 10342428, 'ohb5s6', 1, 0, 5),
(38, 57644223, 'ohb5s6', 1, 1, 0),
(39, 20137544, 'ohb5s6', 3, 3, 0),
(40, 94758253, 'ohb5s6', 1, 0, 2),
(41, 12877089, 'l4csb7', 1, 0, 4),
(42, 12877089, 'ohb5s6', 1, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_header`
--

DROP TABLE IF EXISTS `tbl_transaction_header`;
CREATE TABLE IF NOT EXISTS `tbl_transaction_header` (
  `transaction_no` int NOT NULL,
  `borrower_id` varchar(100) NOT NULL,
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `expected_return_date` date NOT NULL DEFAULT '0000-00-00',
  `return_date` date NOT NULL DEFAULT '0000-00-00',
  `status` int DEFAULT '6',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_no`),
  KEY `fk_head_borrower_id` (`borrower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_transaction_header`
--

INSERT INTO `tbl_transaction_header` (`transaction_no`, `borrower_id`, `start_date`, `expected_return_date`, `return_date`, `status`, `date_created`) VALUES
(5428495, '312312', '2024-03-08', '2024-03-08', '2024-03-08', 0, '2024-03-09 07:23:06'),
(5899442, '312312', '0000-00-00', '0000-00-00', '0000-00-00', 5, '2024-03-08 23:21:14'),
(10342428, '312312', '0000-00-00', '0000-00-00', '0000-00-00', 5, '2024-03-09 08:04:00'),
(12877089, '12312', '0000-00-00', '0000-00-00', '0000-00-00', 6, '2024-03-14 10:44:40'),
(20137544, '12312', '2024-03-09', '2024-03-14', '2024-03-09', 0, '2024-03-09 16:01:33'),
(20294498, '312312', '2024-03-08', '2024-03-13', '2024-03-08', 0, '2024-03-08 15:22:58'),
(21680979, '312312', '2024-03-08', '2024-03-13', '2024-03-08', 0, '2024-03-09 07:19:07'),
(35480184, '312312', '2024-03-08', '2024-03-13', '2024-03-09', 0, '2024-03-09 07:31:58'),
(48590568, '312312', '2024-03-08', '2024-03-08', '2024-03-08', 0, '2024-03-09 07:21:01'),
(57644223, '12312', '2024-03-09', '2024-03-08', '2024-03-09', 0, '2024-03-09 09:30:07'),
(57837994, '312312', '0000-00-00', '0000-00-00', '0000-00-00', 4, '2024-03-08 22:57:55'),
(94758253, '12312', '2024-03-14', '2024-03-19', '0000-00-00', 2, '2024-03-14 09:54:58'),
(95107349, '312312', '2024-03-09', '2024-03-08', '2024-03-09', 0, '2024-03-09 07:34:03'),
(95274448, '312312', '2024-03-08', '2024-03-08', '2024-03-08', 0, '2024-03-09 07:28:48'),
(98268094, '312312', '2024-03-08', '2024-03-08', '2024-03-08', 0, '2024-03-09 02:47:54');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_borrower`
--
ALTER TABLE `tbl_borrower`
  ADD CONSTRAINT `fk_tbl_department` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`department_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `fk_cart_borrower_id` FOREIGN KEY (`borrower_id`) REFERENCES `tbl_borrower` (`borrower_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_item_code` FOREIGN KEY (`item_code`) REFERENCES `tbl_item` (`item_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_size_id` FOREIGN KEY (`size_id`) REFERENCES `tbl_size` (`size_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_penalty`
--
ALTER TABLE `tbl_penalty`
  ADD CONSTRAINT `fk_pen_trans_no` FOREIGN KEY (`transaction_no`) REFERENCES `tbl_transaction_header` (`transaction_no`);

--
-- Constraints for table `tbl_retirement`
--
ALTER TABLE `tbl_retirement`
  ADD CONSTRAINT `fk_item_code2` FOREIGN KEY (`item_code`) REFERENCES `tbl_item` (`item_code`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_stock_in`
--
ALTER TABLE `tbl_stock_in`
  ADD CONSTRAINT `fk_stock_item_code` FOREIGN KEY (`item_code`) REFERENCES `tbl_item` (`item_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_transaction_detail`
--
ALTER TABLE `tbl_transaction_detail`
  ADD CONSTRAINT `fk_dtl_item_code` FOREIGN KEY (`item_code`) REFERENCES `tbl_item` (`item_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dtl_transaction_no` FOREIGN KEY (`transaction_no`) REFERENCES `tbl_transaction_header` (`transaction_no`);

--
-- Constraints for table `tbl_transaction_header`
--
ALTER TABLE `tbl_transaction_header`
  ADD CONSTRAINT `fk_head_borrower_id` FOREIGN KEY (`borrower_id`) REFERENCES `tbl_borrower` (`borrower_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
