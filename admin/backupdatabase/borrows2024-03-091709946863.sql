-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: borrows
-- ------------------------------------------------------
-- Server version 	8.2.0
-- Date: Sat, 09 Mar 2024 01:14:23 +0000

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_admin`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_admin` VALUES (1,'admin','admin');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_admin` with 1 row(s)
--

--
-- Table structure for table `tbl_borrower`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_borrower` (
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
  PRIMARY KEY (`borrower_id`),
  KEY `fk_tbl_department` (`department_id`),
  CONSTRAINT `fk_tbl_department` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`department_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_borrower`
--

LOCK TABLES `tbl_borrower` WRITE;
/*!40000 ALTER TABLE `tbl_borrower` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_borrower` VALUES ('312312','SDFSDF','FSDFDS','SDFSD','09312312',2,'Student',0,0,'../static/front/312312.png','../static/back/312312.png','johnadmin','1234','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_borrower` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_borrower` with 1 row(s)
--

--
-- Table structure for table `tbl_cart`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `item_code` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `borrower_id` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_item_code` (`item_code`),
  KEY `fk_cart_borrower_id` (`borrower_id`),
  CONSTRAINT `fk_cart_borrower_id` FOREIGN KEY (`borrower_id`) REFERENCES `tbl_borrower` (`borrower_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cart_item_code` FOREIGN KEY (`item_code`) REFERENCES `tbl_item` (`item_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cart`
--

LOCK TABLES `tbl_cart` WRITE;
/*!40000 ALTER TABLE `tbl_cart` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `tbl_cart` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_cart` with 0 row(s)
--

--
-- Table structure for table `tbl_category`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_category` VALUES (3,'category 1',1),(4,'Category 2',1);
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_category` with 2 row(s)
--

--
-- Table structure for table `tbl_department`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_department` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_department`
--

LOCK TABLES `tbl_department` WRITE;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_department` VALUES (2,'department1xxx',1);
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_department` with 1 row(s)
--

--
-- Table structure for table `tbl_item`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item` (
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
  KEY `fk_size_id` (`size_id`),
  CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_size_id` FOREIGN KEY (`size_id`) REFERENCES `tbl_size` (`size_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item`
--

LOCK TABLES `tbl_item` WRITE;
/*!40000 ALTER TABLE `tbl_item` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_item` VALUES ('3x2pno','vvxc',3,2,0,0,'dsfsd','vvxc1709923244.png','2024-03-09 02:40:44'),('l4csb7','Beaker',3,2,29,1,'beaker description','Beaker1709819570.png','2024-03-07 21:52:50'),('ls6w95','TEST CATEGORY',3,2,123,1,'CADAS','TEST CATEGORY1709825943.png','2024-03-07 23:39:03'),('ohb5s6','123123',4,2,15,1,'descriptiontgesst1','1231231709817454.png','2024-03-07 21:17:34');
/*!40000 ALTER TABLE `tbl_item` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_item` with 4 row(s)
--

--
-- Table structure for table `tbl_penalty`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_penalty` (
  `penalty_id` int NOT NULL AUTO_INCREMENT,
  `transaction_no` int NOT NULL,
  `amount` double(50,2) DEFAULT '100.00',
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`penalty_id`),
  KEY `fk_pen_trans_no` (`transaction_no`),
  CONSTRAINT `fk_pen_trans_no` FOREIGN KEY (`transaction_no`) REFERENCES `tbl_transaction_header` (`transaction_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_penalty`
--

LOCK TABLES `tbl_penalty` WRITE;
/*!40000 ALTER TABLE `tbl_penalty` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_penalty` VALUES (2,95107349,100.00,1);
/*!40000 ALTER TABLE `tbl_penalty` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_penalty` with 1 row(s)
--

--
-- Table structure for table `tbl_retirement`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_retirement` (
  `retirement_id` int NOT NULL AUTO_INCREMENT,
  `item_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantity` int NOT NULL,
  `remarks` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_retirement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`retirement_id`),
  KEY `fk_item_code2` (`item_code`),
  CONSTRAINT `fk_item_code2` FOREIGN KEY (`item_code`) REFERENCES `tbl_item` (`item_code`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_retirement`
--

LOCK TABLES `tbl_retirement` WRITE;
/*!40000 ALTER TABLE `tbl_retirement` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_retirement` VALUES (10,'3x2pno',1,'1','2024-03-09 02:41:05'),(11,'3x2pno',1,'fdsf','2024-03-09 02:41:17'),(12,'3x2pno',1,'fdsfs','2024-03-09 02:42:21'),(13,'3x2pno',1,'sdfds','2024-03-09 02:42:25');
/*!40000 ALTER TABLE `tbl_retirement` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_retirement` with 4 row(s)
--

--
-- Table structure for table `tbl_size`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_size` (
  `size_id` int NOT NULL AUTO_INCREMENT,
  `size_description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_size`
--

LOCK TABLES `tbl_size` WRITE;
/*!40000 ALTER TABLE `tbl_size` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_size` VALUES (2,'123mm');
/*!40000 ALTER TABLE `tbl_size` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_size` with 1 row(s)
--

--
-- Table structure for table `tbl_stock_in`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_stock_in` (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `item_code` varchar(100) NOT NULL,
  `old_quantity` int NOT NULL,
  `added_quantity` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stock_id`),
  KEY `fk_stock_item_code` (`item_code`),
  CONSTRAINT `fk_stock_item_code` FOREIGN KEY (`item_code`) REFERENCES `tbl_item` (`item_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_stock_in`
--

LOCK TABLES `tbl_stock_in` WRITE;
/*!40000 ALTER TABLE `tbl_stock_in` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_stock_in` VALUES (2,'l4csb7',25,2,'2024-03-09 01:08:01'),(3,'l4csb7',27,2,'2024-03-09 01:08:18'),(8,'3x2pno',0,2,'2024-03-09 02:40:57'),(9,'3x2pno',0,2,'2024-03-09 02:42:10');
/*!40000 ALTER TABLE `tbl_stock_in` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_stock_in` with 4 row(s)
--

--
-- Table structure for table `tbl_transaction_detail`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_transaction_detail` (
  `trans_item_id` int NOT NULL AUTO_INCREMENT,
  `transaction_no` int NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `return_quantity` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '4',
  PRIMARY KEY (`trans_item_id`),
  KEY `fk_dtl_item_code` (`item_code`),
  KEY `fk_dtl_transaction_no` (`transaction_no`),
  CONSTRAINT `fk_dtl_item_code` FOREIGN KEY (`item_code`) REFERENCES `tbl_item` (`item_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dtl_transaction_no` FOREIGN KEY (`transaction_no`) REFERENCES `tbl_transaction_header` (`transaction_no`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transaction_detail`
--

LOCK TABLES `tbl_transaction_detail` WRITE;
/*!40000 ALTER TABLE `tbl_transaction_detail` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_transaction_detail` VALUES (7,20294498,'ohb5s6',2,2,0),(8,20294498,'ls6w95',2,2,0),(10,57837994,'ohb5s6',1,0,5),(11,57837994,'l4csb7',2,0,5),(13,5899442,'ohb5s6',1,0,5),(14,5899442,'l4csb7',1,0,5),(16,98268094,'ohb5s6',1,1,0),(17,98268094,'l4csb7',2,2,0),(19,21680979,'ohb5s6',1,1,0),(20,21680979,'l4csb7',1,1,0),(22,48590568,'ohb5s6',1,1,0),(23,48590568,'l4csb7',2,2,0),(25,5428495,'ohb5s6',1,1,0),(26,5428495,'l4csb7',1,1,0),(28,95274448,'ohb5s6',1,1,0),(29,95274448,'l4csb7',1,1,0),(31,35480184,'ohb5s6',1,1,0),(32,35480184,'l4csb7',1,1,0),(34,95107349,'ohb5s6',1,1,0),(35,95107349,'l4csb7',1,1,0),(37,10342428,'ohb5s6',1,0,5);
/*!40000 ALTER TABLE `tbl_transaction_detail` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_transaction_detail` with 21 row(s)
--

--
-- Table structure for table `tbl_transaction_header`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_transaction_header` (
  `transaction_no` int NOT NULL,
  `borrower_id` varchar(100) NOT NULL,
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `expected_return_date` date NOT NULL DEFAULT '0000-00-00',
  `return_date` date NOT NULL DEFAULT '0000-00-00',
  `status` int DEFAULT '6',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_no`),
  KEY `fk_head_borrower_id` (`borrower_id`),
  CONSTRAINT `fk_head_borrower_id` FOREIGN KEY (`borrower_id`) REFERENCES `tbl_borrower` (`borrower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transaction_header`
--

LOCK TABLES `tbl_transaction_header` WRITE;
/*!40000 ALTER TABLE `tbl_transaction_header` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tbl_transaction_header` VALUES (5428495,'312312','2024-03-08','2024-03-08','2024-03-08',0,'2024-03-09 07:23:06'),(5899442,'312312','0000-00-00','0000-00-00','0000-00-00',5,'2024-03-08 23:21:14'),(10342428,'312312','0000-00-00','0000-00-00','0000-00-00',5,'2024-03-09 08:04:00'),(20294498,'312312','2024-03-08','2024-03-13','2024-03-08',0,'2024-03-08 15:22:58'),(21680979,'312312','2024-03-08','2024-03-13','2024-03-08',0,'2024-03-09 07:19:07'),(35480184,'312312','2024-03-08','2024-03-13','2024-03-09',0,'2024-03-09 07:31:58'),(48590568,'312312','2024-03-08','2024-03-08','2024-03-08',0,'2024-03-09 07:21:01'),(57837994,'312312','0000-00-00','0000-00-00','0000-00-00',4,'2024-03-08 22:57:55'),(95107349,'312312','2024-03-09','2024-03-08','2024-03-09',0,'2024-03-09 07:34:03'),(95274448,'312312','2024-03-08','2024-03-08','2024-03-08',0,'2024-03-09 07:28:48'),(98268094,'312312','2024-03-08','2024-03-08','2024-03-08',0,'2024-03-09 02:47:54');
/*!40000 ALTER TABLE `tbl_transaction_header` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tbl_transaction_header` with 11 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Sat, 09 Mar 2024 01:14:23 +0000
