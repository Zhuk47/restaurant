-- MySQL dump 10.13  Distrib 5.7.16, for Win64 (x86_64)
--
-- Host: localhost    Database: restaurant
-- ------------------------------------------------------
-- Server version	5.7.16

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
  `title` varchar(200) NOT NULL,
  `text` text DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Салаты','2017-12-13 12:42:29',NULL),(2,'Десерты','2017-11-22 12:07:15',NULL),(3,'Первые блюда','2017-11-22 12:06:20','2017-11-22 12:06:20'),(9,'Гарниры','2017-11-30 11:35:40','2017-11-24 13:15:21'),(10,'Гриль','2017-12-02 07:07:19','2017-12-02 07:07:19');
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
INSERT INTO `food_ingredient` VALUES (1,5,80.000),(1,20,100.000),(1,35,50.000),(1,40,20.000),(1,45,10.000),(1,46,50.000),(4,5,15.000),(4,31,10.000),(4,40,50.000),(4,45,100.000),(4,46,50.000),(5,46,50.000),(10,21,100.000),(10,32,150.000),(11,21,100.000),(11,32,50.000),(12,5,50.000),(12,31,200.000),(12,45,100.000),(13,21,100.000),(13,32,20.000),(30,37,200.000),(37,5,10.000),(38,45,10.000),(38,46,10.000),(40,39,150.000),(41,39,100.000),(42,39,50.000),(42,40,70.000),(43,40,200.000),(44,40,100.000),(44,46,100.000),(45,40,50.000);
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateTimeInCook` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `confirmed` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`,`food_id`,`created_at`),
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
-- Table structure for table `food_prices`
--

DROP TABLE IF EXISTS `food_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_prices` (
  `food_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) DEFAULT '0.00',
  `netCost` decimal(10,2) DEFAULT '0.00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`food_id`,`created_at`),
  CONSTRAINT `FK_food_price_foods` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_prices`
--

LOCK TABLES `food_prices` WRITE;
/*!40000 ALTER TABLE `food_prices` DISABLE KEYS */;
INSERT INTO `food_prices` VALUES (5,'2017-12-15 16:25:47',20.00,15.10,'2017-12-15 14:25:47',NULL),(20,'2017-12-15 16:26:06',20.00,8.00,'2017-12-15 14:26:06',NULL),(21,'2017-12-15 16:26:15',100.00,80.00,'2017-12-15 14:26:15',NULL),(31,'2017-12-15 16:26:22',30.00,22.00,'2017-12-15 14:26:22',NULL),(32,'2017-12-15 16:26:32',80.00,67.00,'2017-12-15 14:26:32',NULL),(33,'2017-12-15 16:26:41',5.00,0.00,'2017-12-15 14:26:41',NULL),(35,'2017-12-15 16:26:51',10.00,4.00,'2017-12-15 14:26:51',NULL),(37,'2017-12-15 16:27:08',5.00,3.00,'2017-12-15 14:27:08',NULL),(39,'2017-12-15 16:27:23',150.00,103.00,'2017-12-15 14:27:23',NULL),(40,'2017-12-15 16:27:35',110.00,64.30,'2017-12-15 14:27:35',NULL),(45,'2017-12-15 16:33:26',0.00,0.00,'2017-12-15 14:34:06','2017-12-15 14:34:06'),(45,'2017-12-15 16:34:06',40.00,33.10,'2017-12-15 14:34:06',NULL),(46,'2017-12-15 17:24:08',0.00,0.00,'2017-12-15 15:24:43','2017-12-15 15:24:43'),(46,'2017-12-15 17:24:43',25.00,15.25,'2017-12-15 15:26:11','2017-12-15 15:26:11'),(46,'2017-12-15 17:26:11',40.00,15.25,'2017-12-15 16:27:09','2017-12-15 16:27:09'),(46,'2017-12-15 18:27:09',50.00,15.00,'2017-12-15 16:53:02','2017-12-15 16:53:02'),(46,'2017-12-15 18:53:02',50.00,20.00,'2017-12-15 16:53:02',NULL);
/*!40000 ALTER TABLE `food_prices` ENABLE KEYS */;
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `mass` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_foods_categories` (`category_id`),
  CONSTRAINT `FK_foods_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foods`
--

LOCK TABLES `foods` WRITE;
/*!40000 ALTER TABLE `foods` DISABLE KEYS */;
INSERT INTO `foods` VALUES (5,'Греческий',1,NULL,NULL,NULL,0),(20,'Цезарь',1,'2017-11-22 11:27:58','2017-11-22 11:27:58',NULL,0),(21,'Тирамису',2,'2017-11-22 11:28:09','2017-11-22 11:28:09',NULL,0),(31,'Салат из капусты',1,'2017-12-13 12:36:00','2017-11-24 02:53:42',NULL,0),(32,'Панакота',2,'2017-11-24 02:53:53','2017-11-24 02:53:53',NULL,0),(33,'Борщ',3,'2017-11-24 08:59:16','2017-11-24 04:43:26',NULL,0),(35,'Домашний',1,'2017-11-24 12:45:56','2017-11-24 12:45:56',NULL,0),(37,'Каша гречневая',9,'2017-11-30 13:10:00','2017-11-30 13:07:28',NULL,0),(39,'Медовая вкусняшка',2,'2017-12-01 15:30:49','2017-12-01 15:29:28',NULL,0),(40,'Баранина на гриле',10,'2017-12-15 16:58:31','2017-12-02 07:09:55',NULL,490),(45,'Salad',1,'2017-12-15 14:35:57','2017-12-15 14:33:26',NULL,0),(46,'БЛЮДО',3,'2017-12-15 16:58:11','2017-12-15 15:24:08',NULL,260);
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Морковь','2017-11-22 14:21:28','2017-11-23 06:14:39',NULL,NULL),(4,'Перец','2017-11-22 14:29:53','2017-11-22 09:39:30',NULL,NULL),(5,'Пшено','2017-11-22 14:32:22','2017-11-22 08:32:22','2017-11-22 08:32:22',NULL),(10,'Сливки','2017-11-23 12:25:06','2017-11-23 06:25:06','2017-11-23 06:25:06',NULL),(11,'Какао','2017-11-23 13:07:54','2017-11-23 07:07:54','2017-11-23 07:07:54',NULL),(12,'Капуста','2017-11-23 16:48:41','2017-11-23 10:48:41','2017-11-23 10:48:41',NULL),(13,'Сахер','2017-11-23 17:12:45','2017-11-24 12:45:09','2017-11-23 11:12:45',NULL),(29,'Имбирь','2017-11-30 14:02:49','2017-11-30 08:02:49','2017-11-30 08:02:49',NULL),(30,'Греча','2017-11-30 14:04:33','2017-11-30 08:04:33','2017-11-30 08:04:33',NULL),(37,'Семки','2017-11-30 17:00:16','2017-11-30 11:00:42','2017-11-30 11:00:16',NULL),(38,'Кунжут','2017-11-30 17:56:51','2017-11-30 11:56:51','2017-11-30 11:56:51',NULL),(40,'Мак','2017-12-01 21:28:05','2017-12-01 15:28:04','2017-12-01 15:28:04',NULL),(41,'Курага','2017-12-01 21:28:20','2017-12-01 15:28:20','2017-12-01 15:28:20',NULL),(42,'Мёд','2017-12-01 21:28:38','2017-12-01 15:28:38','2017-12-01 15:28:38',NULL),(43,'Баранина','2017-12-02 13:07:44','2017-12-02 07:07:44','2017-12-02 07:07:44',NULL),(44,'Баклажан','2017-12-02 13:08:15','2017-12-02 07:08:15','2017-12-02 07:08:15',NULL),(45,'Лук','2017-12-02 13:08:42','2017-12-02 07:08:42','2017-12-02 07:08:42',NULL),(46,'Соль','2017-12-02 13:09:19','2017-12-02 07:09:19','2017-12-02 07:09:19',NULL),(47,'Пшено','2017-12-05 19:09:08','2017-12-05 13:09:08','2017-12-05 13:09:08',NULL),(48,'Ingr1','2017-12-15 18:10:55','2017-12-15 16:10:55','2017-12-15 16:10:55',NULL);
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
  `comment` varchar(200) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_orders_personals` (`user_id`),
  KEY `FK_orders_tables` (`table_id`),
  CONSTRAINT `FK_orders_personals` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_orders_tables` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (13,NULL,1,NULL,3,0.00,'2017-12-13 16:38:30','2017-12-13 16:38:30',NULL),(14,NULL,3,NULL,3,0.00,'2017-12-15 17:37:08','2017-12-15 17:37:08',NULL);
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`,`created_at`),
  CONSTRAINT `FK_prices_ingredients` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,'2017-11-24 13:42:40',7.50,NULL),(1,'2017-12-12 13:16:36',8.00,'2017-12-12 09:16:36'),(4,'2017-11-24 15:07:41',20.00,NULL),(5,'2017-11-24 15:07:41',2.50,NULL),(10,'2017-11-24 15:07:41',30.00,NULL),(11,'2017-11-24 15:07:41',40.00,NULL),(12,'2017-11-24 15:07:41',10.00,NULL),(13,'2017-11-24 15:07:41',10.00,NULL),(29,'2017-11-30 14:02:56',18.00,'2017-11-30 08:02:56'),(30,'2017-11-30 14:04:42',0.30,'2017-11-30 08:04:42'),(30,'2017-11-30 14:11:35',0.50,NULL),(30,'2017-11-30 16:33:23',1.50,NULL),(37,'2017-11-30 17:00:29',6.50,'2017-11-30 11:00:29'),(37,'2017-11-30 17:00:42',7.00,'2017-11-30 11:00:42'),(38,'2017-11-30 17:57:45',20.00,'2017-11-30 11:57:45'),(38,'2017-11-30 17:57:58',23.00,'2017-11-30 11:57:58'),(40,'2017-12-01 21:28:14',40.00,'2017-12-01 15:28:14'),(41,'2017-12-01 21:28:28',25.00,'2017-12-01 15:28:28'),(42,'2017-12-01 21:28:46',36.00,'2017-12-01 15:28:46'),(43,'2017-12-02 13:08:01',10.00,'2017-12-02 07:08:01'),(44,'2017-12-02 13:08:24',5.00,'2017-12-02 07:08:24'),(45,'2017-12-02 13:08:49',5.00,'2017-12-02 07:08:49'),(46,'2017-12-02 13:09:31',0.50,'2017-12-02 07:09:31'),(47,'2017-12-05 19:09:13',1.50,'2017-12-05 13:09:13'),(48,'2017-12-15 18:10:58',100.00,'2017-12-15 16:10:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'waiter'),(3,'cook');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES (1,'11'),(2,'22'),(3,'33');
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_personals_roles` (`role_id`),
  CONSTRAINT `FK_personals_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Должанский','Колян','Рэпер','1987-07-15',1,NULL,NULL,'NwsyBvb2fMYVxUqZRbWeuYk3TbgKubGk8Uw8z5nNGUKqlw7LJW829FjIN2ID','admin@gmail.com','$2b$10$u5Ji8hkOzj5WWd8Q1B5LUuQEL3Vk9znG0TGxPo7nCnA5Xnz5TbxO2',NULL),(3,'Пупкин','Вася','Гришевич','1990-12-12',2,'2017-12-12 09:28:52','2017-12-12 09:28:52','sJDCaQ1GpWN9kq2a6tS9DGbszPrv0AM2f3wp7Fp6RZioEIlwQt7NjBaguSHK','off1@gmail.com','$2y$10$agLvcVbYf7kT7lj.vRjNc.NIVtIzHWH8Zw9/Qk2R8cAa.43fMafHK',NULL),(5,'Шеф','Повар','Бондович','1975-10-23',3,'2017-12-12 10:02:02','2017-12-12 10:02:02','CTFKXnQx2kjUSjDFea8mYYAH6EAra0fenmx135X0XI4thMbIgFeYIQMbk720','povar@gmail.com','$2y$10$KKFKd29Vd35dWdZ674BZ9uqXbWNlzugvd0midE/PQL5.9wfUcezpa',NULL);
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

-- Dump completed on 2017-12-15 19:00:13
