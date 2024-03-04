-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 20, 2024 at 11:13 AM
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
-- Database: `borrowing`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrower`
--

DROP TABLE IF EXISTS `tbl_borrower`;
CREATE TABLE IF NOT EXISTS `tbl_borrower` (
  `borrower_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `department_id` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `status_approval` int DEFAULT '0',
  `front_id_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `back_id_path` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`borrower_id`),
  KEY `fk_department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_borrower`
--

INSERT INTO `tbl_borrower` (`borrower_id`, `first_name`, `middle_name`, `last_name`, `phone_number`, `department_id`, `type`, `status`, `status_approval`, `front_id_path`, `back_id_path`, `username`, `password`, `date_created`) VALUES
('123-ss', 'johnrey', 'dasda', 'decosta', '09301791280', 15, 'Student', 1, 1, '0f947507-6da1-42f9-8168-0c1052fefa81.png', '', 'admin', 'admin', '2024-02-16 18:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `status`) VALUES
(1, 'cvxxvcvcb', 1),
(2, 'qwe', 1),
(4, 'cxzcx', 1),
(5, 'qqq', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

DROP TABLE IF EXISTS `tbl_course`;
CREATE TABLE IF NOT EXISTS `tbl_course` (
  `course_id` int NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `course_name`, `status`) VALUES
(2, 'ccc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_damage_items`
--

DROP TABLE IF EXISTS `tbl_damage_items`;
CREATE TABLE IF NOT EXISTS `tbl_damage_items` (
  `item_dmg_no` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `ex_replace_date` date NOT NULL,
  `penalty` int NOT NULL,
  `quantity` int NOT NULL,
  `remarks` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`item_dmg_no`),
  KEY `fk_dmg_trans_no` (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`, `status`) VALUES
(15, 'zxcxzx', 1),
(16, 'cxzcxz', 1),
(17, 'cxzcxzccv', 1),
(21, 'FSDFSD', 1),
(22, 'zxcxzx', 1),
(23, 'zxcxzx123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

DROP TABLE IF EXISTS `tbl_inventory`;
CREATE TABLE IF NOT EXISTS `tbl_inventory` (
  `item_code` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category_id` int NOT NULL,
  `quantity` int NOT NULL,
  `size_id` int NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `item_condition` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `description` varchar(100) NOT NULL,
  `img_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_code`),
  KEY `fk_category_id` (`category_id`),
  KEY `fk_size_id` (`size_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`item_code`, `item_name`, `category_id`, `quantity`, `size_id`, `serial_no`, `item_condition`, `status`, `description`, `img_path`, `date_created`) VALUES
('jw2kq1', 'bvcb', 2, 13, 1, '0', 'Good', 1, 'gdfgfdg', 'bvcb1708324787.png', '2024-02-19 14:39:47'),
('st5w7a', 'test', 2, 13, 1, '0', 'Good', 1, '1232', 'no-image.png', '2024-02-19 14:40:27'),
('wc0p6x', 'test', 1, 115, 1, '0', 'Slightly Damage', 1, 'fgfdg', 'test1708312832.png', '2024-02-19 14:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penalty`
--

DROP TABLE IF EXISTS `tbl_penalty`;
CREATE TABLE IF NOT EXISTS `tbl_penalty` (
  `penalty_id` int NOT NULL AUTO_INCREMENT,
  `transaction_no` int NOT NULL,
  `penalty` int NOT NULL,
  PRIMARY KEY (`penalty_id`),
  KEY `fk_pen_trans_no` (`transaction_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_retirement`
--

DROP TABLE IF EXISTS `tbl_retirement`;
CREATE TABLE IF NOT EXISTS `tbl_retirement` (
  `retirement_no` int NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `remarks` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`retirement_no`),
  KEY `fk_item_code` (`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return_items`
--

DROP TABLE IF EXISTS `tbl_return_items`;
CREATE TABLE IF NOT EXISTS `tbl_return_items` (
  `return_id` int NOT NULL AUTO_INCREMENT,
  `transaction_no` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`return_id`),
  KEY `fk_rtn_trans_no` (`transaction_no`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_return_items`
--

INSERT INTO `tbl_return_items` (`return_id`, `transaction_no`, `quantity`) VALUES
(7, 72879502, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

DROP TABLE IF EXISTS `tbl_size`;
CREATE TABLE IF NOT EXISTS `tbl_size` (
  `size_id` int NOT NULL AUTO_INCREMENT,
  `size_description` varchar(100) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`size_id`, `size_description`) VALUES
(1, 'NO SIZE'),
(2, '1 MM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

DROP TABLE IF EXISTS `tbl_transaction`;
CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `transaction_no` int NOT NULL,
  `borrower_id` varchar(100) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `start_date` date DEFAULT NULL,
  `expected_return_date` date NOT NULL,
  `status` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_no`),
  KEY `fk_trans_item_code` (`item_code`),
  KEY `fk_trans_borrower_id` (`borrower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`transaction_no`, `borrower_id`, `item_code`, `quantity`, `start_date`, `expected_return_date`, `status`, `date_created`) VALUES
(72879502, '123-ss', 'wc0p6x', 3, '2024-02-20', '2024-02-25', 0, '2024-02-20 09:46:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_borrower`
--
ALTER TABLE `tbl_borrower`
  ADD CONSTRAINT `fk_department_id` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`department_id`);

--
-- Constraints for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`),
  ADD CONSTRAINT `fk_size_id` FOREIGN KEY (`size_id`) REFERENCES `tbl_size` (`size_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_retirement`
--
ALTER TABLE `tbl_retirement`
  ADD CONSTRAINT `fk_item_code` FOREIGN KEY (`item_code`) REFERENCES `tbl_inventory` (`item_code`);

--
-- Constraints for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD CONSTRAINT `fk_trans_borrower_id` FOREIGN KEY (`borrower_id`) REFERENCES `tbl_borrower` (`borrower_id`),
  ADD CONSTRAINT `fk_trans_item_code` FOREIGN KEY (`item_code`) REFERENCES `tbl_inventory` (`item_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
