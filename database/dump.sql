-- MySQL dump 10.13  Distrib 5.7.19, for Win32 (AMD64)
--
-- Host: localhost    Database: restaurant
-- ------------------------------------------------------
-- Server version	5.7.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Салаты','2017-11-22 12:07:08',NULL),(2,'Десерты','2017-11-22 12:07:15',NULL),(3,'Первые блюда','2017-11-22 12:06:20','2017-11-22 12:06:20'),(9,'Гарниры','2017-11-30 11:35:40','2017-11-24 13:15:21'),(10,'Гриль','2017-12-02 07:07:19','2017-12-02 07:07:19');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_ingredient`
--

DROP TABLE IF EXISTS `food_ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_ingredient` (
  `ingredient_id` int(10) unsigned NOT NULL,
  `food_id` int(10) unsigned NOT NULL,
  `mass` decimal(10,3) unsigned NOT NULL,
  PRIMARY KEY (`ingredient_id`,`food_id`),
  KEY `FK_food_ingredient_foods` (`food_id`),
  CONSTRAINT `FK_food_ingredient_foods` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_food_ingredient_ingredients` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_ingredient`
--

LOCK TABLES `food_ingredient` WRITE;
/*!40000 ALTER TABLE `food_ingredient` DISABLE KEYS */;
INSERT INTO `food_ingredient` VALUES (1,5,80.000),(1,20,100.000),(1,31,50.000),(1,35,50.000),(1,40,50.000),(4,5,15.000),(4,31,10.000),(4,40,50.000),(10,21,100.000),(10,32,150.000),(11,21,100.000),(11,32,50.000),(12,31,200.000),(13,21,100.000),(13,32,20.000),(30,37,200.000),(40,39,150.000),(41,39,100.000),(42,39,50.000),(42,40,70.000),(43,40,200.000),(44,40,100.000),(45,40,50.000),(46,40,5.000);
/*!40000 ALTER TABLE `food_ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_order`
--

DROP TABLE IF EXISTS `food_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_order` (
  `order_id` int(10) unsigned NOT NULL,
  `food_id` int(10) unsigned NOT NULL,
  `dataTimeAdd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateTimeInCook` datetime DEFAULT NULL,
  `dateTimeOutCook` datetime DEFAULT NULL,
  `confirmed` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`,`food_id`,`dataTimeAdd`),
  KEY `FK_food_order_foods` (`food_id`),
  CONSTRAINT `FK_food_order_foods` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_food_order_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_order`
--

LOCK TABLES `food_order` WRITE;
/*!40000 ALTER TABLE `food_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `food_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_price`
--

DROP TABLE IF EXISTS `food_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_price` (
  `food_id` int(10) unsigned NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) NOT NULL,
  `netCost` decimal(10,2) NOT NULL,
  PRIMARY KEY (`food_id`,`dateTime`),
  CONSTRAINT `FK_food_price_foods` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_price`
--

LOCK TABLES `food_price` WRITE;
/*!40000 ALTER TABLE `food_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `food_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foods`
--

DROP TABLE IF EXISTS `foods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `dateTimeIn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateTimeOut` datetime NOT NULL DEFAULT '2100-01-01 00:00:00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_foods_categories` (`category_id`),
  CONSTRAINT `FK_foods_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foods`
--

LOCK TABLES `foods` WRITE;
/*!40000 ALTER TABLE `foods` DISABLE KEYS */;
INSERT INTO `foods` VALUES (5,'Греческий',1,'2017-11-22 17:07:41','2100-01-01 00:00:00',40.50,NULL,NULL),(20,'Цезарь',1,'2017-11-22 17:27:58','2100-01-01 00:00:00',60.60,'2017-11-22 11:27:58','2017-11-22 11:27:58'),(21,'Тирамису',2,'2017-11-22 17:28:09','2100-01-01 00:00:00',99.99,'2017-11-22 11:28:09','2017-11-22 11:28:09'),(31,'Салат из капусты',1,'2017-11-24 08:53:42','2100-01-01 00:00:00',28.00,'2017-11-24 02:53:42','2017-11-24 02:53:42'),(32,'Панакота',2,'2017-11-24 08:53:53','2100-01-01 00:00:00',80.00,'2017-11-24 02:53:53','2017-11-24 02:53:53'),(33,'Борщ',3,'2017-11-24 10:43:26','2100-01-01 00:00:00',50.00,'2017-11-24 08:59:16','2017-11-24 04:43:26'),(35,'Домашний',1,'2017-11-24 18:45:56','2100-01-01 00:00:00',45.99,'2017-11-24 12:45:56','2017-11-24 12:45:56'),(37,'Каша гречневая',9,'2017-11-30 19:07:28','2100-01-01 00:00:00',10.00,'2017-11-30 13:10:00','2017-11-30 13:07:28'),(39,'Медовая вкусняшка',2,'2017-12-01 21:29:28','2100-01-01 00:00:00',150.00,'2017-12-01 15:30:49','2017-12-01 15:29:28'),(40,'Баранина на гриле',10,'2017-12-02 13:09:55','2100-01-01 00:00:00',100.00,'2017-12-02 07:11:50','2017-12-02 07:09:55');
/*!40000 ALTER TABLE `foods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `dateTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Морковь','2017-11-22 14:21:28','2017-11-23 06:14:39',NULL),(4,'Перец','2017-11-22 14:29:53','2017-11-22 09:39:30',NULL),(5,'Пшено','2017-11-22 14:32:22','2017-11-22 08:32:22','2017-11-22 08:32:22'),(10,'Сливки','2017-11-23 12:25:06','2017-11-23 06:25:06','2017-11-23 06:25:06'),(11,'Какао','2017-11-23 13:07:54','2017-11-23 07:07:54','2017-11-23 07:07:54'),(12,'Капуста','2017-11-23 16:48:41','2017-11-23 10:48:41','2017-11-23 10:48:41'),(13,'Сахер','2017-11-23 17:12:45','2017-11-24 12:45:09','2017-11-23 11:12:45'),(29,'Имбирь','2017-11-30 14:02:49','2017-11-30 08:02:49','2017-11-30 08:02:49'),(30,'Греча','2017-11-30 14:04:33','2017-11-30 08:04:33','2017-11-30 08:04:33'),(37,'Семки','2017-11-30 17:00:16','2017-11-30 11:00:42','2017-11-30 11:00:16'),(38,'Кунжут','2017-11-30 17:56:51','2017-11-30 11:56:51','2017-11-30 11:56:51'),(40,'Мак','2017-12-01 21:28:05','2017-12-01 15:28:04','2017-12-01 15:28:04'),(41,'Курага','2017-12-01 21:28:20','2017-12-01 15:28:20','2017-12-01 15:28:20'),(42,'Мёд','2017-12-01 21:28:38','2017-12-01 15:28:38','2017-12-01 15:28:38'),(43,'Баранина','2017-12-02 13:07:44','2017-12-02 07:07:44','2017-12-02 07:07:44'),(44,'Баклажан','2017-12-02 13:08:15','2017-12-02 07:08:15','2017-12-02 07:08:15'),(45,'Лук','2017-12-02 13:08:42','2017-12-02 07:08:42','2017-12-02 07:08:42'),(46,'Соль','2017-12-02 13:09:19','2017-12-02 07:09:19','2017-12-02 07:09:19'),(47,'Пшено','2017-12-05 19:09:08','2017-12-05 13:09:08','2017-12-05 13:09:08');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serial` varchar(100) DEFAULT NULL,
  `table_id` int(10) unsigned NOT NULL,
  `dateTimeIn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateTimeOut` datetime DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `personal_id` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_orders_personals` (`personal_id`),
  KEY `FK_orders_tables` (`table_id`),
  CONSTRAINT `FK_orders_personals` FOREIGN KEY (`personal_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_orders_tables` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `ingredient_id` int(10) unsigned NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`,`dateTime`),
  CONSTRAINT `FK_prices_ingredients` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,'2017-11-24 13:42:40',7.50,NULL,NULL),(4,'2017-11-24 15:07:41',20.00,NULL,NULL),(5,'2017-11-24 15:07:41',2.50,NULL,NULL),(10,'2017-11-24 15:07:41',30.00,NULL,NULL),(11,'2017-11-24 15:07:41',40.00,NULL,NULL),(12,'2017-11-24 15:07:41',10.00,NULL,NULL),(13,'2017-11-24 15:07:41',10.00,NULL,NULL),(29,'2017-11-30 14:02:56',18.00,'2017-11-30 08:02:56','2017-11-30 08:02:56'),(30,'2017-11-30 14:04:42',0.30,'2017-11-30 08:04:42','2017-11-30 08:04:42'),(30,'2017-11-30 14:11:35',0.50,NULL,NULL),(30,'2017-11-30 16:33:23',1.50,NULL,NULL),(37,'2017-11-30 17:00:29',6.50,'2017-11-30 11:00:29','2017-11-30 11:00:29'),(37,'2017-11-30 17:00:42',7.00,'2017-11-30 11:00:42','2017-11-30 11:00:42'),(38,'2017-11-30 17:57:45',20.00,'2017-11-30 11:57:45','2017-11-30 11:57:45'),(38,'2017-11-30 17:57:58',23.00,'2017-11-30 11:57:58','2017-11-30 11:57:58'),(40,'2017-12-01 21:28:14',40.00,'2017-12-01 15:28:14','2017-12-01 15:28:14'),(41,'2017-12-01 21:28:28',25.00,'2017-12-01 15:28:28','2017-12-01 15:28:28'),(42,'2017-12-01 21:28:46',36.00,'2017-12-01 15:28:46','2017-12-01 15:28:46'),(43,'2017-12-02 13:08:01',10.00,'2017-12-02 07:08:01','2017-12-02 07:08:01'),(44,'2017-12-02 13:08:24',5.00,'2017-12-02 07:08:24','2017-12-02 07:08:24'),(45,'2017-12-02 13:08:49',5.00,'2017-12-02 07:08:49','2017-12-02 07:08:49'),(46,'2017-12-02 13:09:31',0.50,'2017-12-02 07:09:31','2017-12-02 07:09:31'),(47,'2017-12-05 19:09:13',1.50,'2017-12-05 13:09:13','2017-12-05 13:09:13');
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serial` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `midname` varchar(100) NOT NULL,
  `dateBirth` date DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_personals_roles` (`role_id`),
  CONSTRAINT `FK_personals_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-06 23:18:27
