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
  `text` text,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Акция!!!','Приведи друга и уведи его обратно.','2017-12-19 11:11:26','2017-12-19 11:01:44'),(2,'Акция №2','Уведи своего друга!','2017-12-19 11:09:18','2017-12-19 11:09:18'),(4,'Акация','Забери его!!!','2017-12-19 17:11:18','2017-12-19 17:11:20');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Салаты','2017-12-13 12:42:29',NULL),(2,'Десерты','2017-11-22 12:07:15',NULL),(3,'Первые блюда','2017-11-22 12:06:20','2017-11-22 12:06:20'),(4,'Гарниры',NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
INSERT INTO `food_ingredient` VALUES (54,52,20.000),(54,57,50.000),(54,58,50.000),(54,64,50.000),(57,53,10.000),(57,58,50.000),(58,57,50.000),(58,58,50.000),(58,64,80.000),(59,52,20.000),(59,57,50.000),(60,57,50.000),(61,53,20.000),(61,57,10.000),(61,58,10.000),(61,64,20.000),(62,54,50.000),(63,53,25.000),(63,54,20.000),(64,52,10.000),(64,54,20.000),(66,52,20.000),(66,53,25.000),(67,54,30.000),(68,55,100.000),(70,56,100.000);
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
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `dateTimeInCook` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `confirmed` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `timeInCook` time DEFAULT NULL,
  `comment` varchar(100) DEFAULT '-',
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
INSERT INTO `food_order` VALUES (24,52,'2018-01-21 11:51:25.000000','2018-01-21 13:51:36','2018-01-21 11:53:49',1,'2018-01-21 11:53:49','00:02:13',NULL),(24,52,'2018-01-21 11:51:26.000000','2018-01-21 13:51:36','2018-01-21 11:53:50',1,'2018-01-21 11:53:50','00:02:14',NULL),(24,52,'2018-01-21 11:51:27.000000','2018-01-21 13:51:36','2018-01-21 11:53:52',1,'2018-01-21 11:53:52','00:02:16',NULL),(24,52,'2018-01-21 11:51:33.000000','2018-01-21 13:51:36','2018-01-21 11:52:01',1,'2018-01-21 11:52:01','00:00:25',NULL),(24,53,'2018-01-21 11:51:30.000000','2018-01-21 13:51:36','2018-01-21 11:52:09',1,'2018-01-21 11:52:09','00:00:33',NULL),(24,53,'2018-01-21 11:51:31.000000','2018-01-21 13:51:36','2018-01-21 11:52:11',1,'2018-01-21 11:52:11','00:00:35',NULL),(25,54,'2018-01-21 12:08:30.000000','2018-01-21 14:08:55','2018-01-23 14:05:34',1,'2018-01-23 14:05:34','01:56:39',NULL),(25,57,'2018-01-21 12:08:24.000000','2018-01-21 14:08:55','2018-01-23 14:05:35',1,'2018-01-23 14:05:35','01:56:40',NULL),(25,58,'2018-01-21 12:08:33.000000','2018-01-21 14:08:55','2018-01-23 14:05:36',1,'2018-01-23 14:05:36','01:56:41','35'),(33,54,'2018-01-23 13:47:48.000000','2018-01-23 15:50:01','2018-01-23 14:05:37',1,'2018-01-23 14:05:37','00:15:36','Без гренок'),(33,57,'2018-01-23 13:52:43.000000','2018-01-23 15:53:03','2018-01-23 14:05:38',1,'2018-01-23 14:05:38','00:12:35','Без оливок'),(33,58,'2018-01-23 14:01:04.000000','2018-01-23 16:01:13','2018-01-23 14:05:39',1,'2018-01-23 14:05:39','00:04:26','var'),(33,64,'2018-01-23 14:01:11.000000','2018-01-23 16:01:13','2018-01-23 14:05:40',1,'2018-01-23 14:05:40','00:04:27','zhizhi'),(34,52,'2018-01-23 14:10:20.000000','2018-01-23 16:10:59','2018-01-23 14:11:11',1,'2018-01-23 14:11:11','00:00:12','Сметану вместо мазика'),(34,54,'2018-01-23 14:10:27.000000','2018-01-23 16:10:59','2018-01-23 14:11:15',1,'2018-01-23 14:11:15','00:00:16','Без гренок'),(34,55,'2018-01-23 14:10:31.000000','2018-01-23 16:10:59','2018-01-23 14:11:12',1,'2018-01-23 14:11:12','00:00:13',NULL),(34,58,'2018-01-23 14:10:39.000000','2018-01-23 16:10:59','2018-01-23 14:11:13',1,'2018-01-23 14:11:13','00:00:14','Без сметаны'),(35,55,'2018-01-23 14:12:01.000000',NULL,NULL,0,'2018-01-23 14:12:01',NULL,NULL),(35,55,'2018-01-23 14:12:02.000000',NULL,NULL,0,'2018-01-23 14:12:02',NULL,NULL),(35,58,'2018-01-23 14:12:04.000000',NULL,NULL,0,'2018-01-23 14:12:04',NULL,NULL),(36,56,'2018-01-23 14:12:20.000000','2018-01-23 16:12:43',NULL,1,'2018-01-23 14:12:43',NULL,'Послаще'),(36,57,'2018-01-23 14:12:25.000000','2018-01-23 16:12:43',NULL,1,'2018-01-23 14:12:43',NULL,'Погуще');
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
INSERT INTO `food_prices` VALUES (52,'2018-01-07 01:29:15',0.00,0.00,'2018-01-06 23:46:32','2018-01-06 23:46:32'),(52,'2018-01-07 01:46:32',15.00,7.22,'2018-01-15 12:48:05','2018-01-15 12:48:05'),(52,'2018-01-15 14:48:05',16.00,7.40,'2018-01-15 12:48:05',NULL),(53,'2018-01-07 01:29:24',0.00,0.00,'2018-01-06 23:47:09','2018-01-06 23:47:09'),(53,'2018-01-07 01:47:09',15.00,3.24,'2018-01-06 23:47:09',NULL),(54,'2018-01-07 01:29:30',0.00,0.00,'2018-01-06 23:48:14','2018-01-06 23:48:14'),(54,'2018-01-07 01:48:14',30.00,11.30,'2018-01-06 23:48:14',NULL),(55,'2018-01-07 01:29:40',0.00,0.00,'2018-01-06 23:50:19','2018-01-06 23:50:19'),(55,'2018-01-07 01:50:19',40.00,20.00,'2018-01-06 23:50:19',NULL),(56,'2018-01-03 22:46:42',60.00,35.00,NULL,'2018-01-05 20:47:07'),(56,'2018-01-07 01:29:52',0.00,0.00,'2018-01-06 23:51:17','2018-01-06 23:51:17'),(56,'2018-01-07 01:51:17',55.00,30.00,'2018-01-06 23:51:17',NULL),(57,'2018-01-07 01:30:06',0.00,0.00,'2018-01-06 23:43:54','2018-01-06 23:43:54'),(57,'2018-01-07 01:43:54',50.00,30.15,'2018-01-06 23:43:54',NULL),(58,'2018-01-07 01:30:12',0.00,0.00,'2018-01-06 23:43:19','2018-01-06 23:43:19'),(58,'2018-01-07 01:43:19',20.00,5.35,'2018-01-06 23:43:19',NULL),(62,'2018-01-14 14:24:40',0.00,0.00,'2018-01-14 12:37:16','2018-01-14 12:37:16'),(63,'2018-01-14 14:36:13',0.00,0.00,'2018-01-14 12:37:11','2018-01-14 12:37:11'),(64,'2018-01-14 14:38:23',0.00,0.00,'2018-01-14 13:02:53','2018-01-14 13:02:53'),(64,'2018-01-14 15:02:53',20.00,8.70,'2018-01-14 16:59:23','2018-01-14 16:59:23'),(64,'2018-01-14 18:59:23',25.00,8.70,'2018-01-14 16:59:23',NULL),(65,'2018-01-14 15:13:20',0.00,0.00,'2018-01-14 13:14:47','2018-01-14 13:14:47'),(66,'2018-01-14 15:14:30',0.00,0.00,'2018-01-14 13:14:41','2018-01-14 13:14:41'),(69,'2018-01-19 17:58:35',0.00,0.00,'2018-01-19 15:59:04','2018-01-19 15:59:04');
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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foods`
--

LOCK TABLES `foods` WRITE;
/*!40000 ALTER TABLE `foods` DISABLE KEYS */;
INSERT INTO `foods` VALUES (52,'Оливье',1,'2018-01-13 14:54:28','2018-01-06 23:29:15',NULL,70),(53,'Греческий',1,'2018-01-06 23:47:05','2018-01-06 23:29:24',NULL,80),(54,'Цезарь',1,'2018-01-06 23:48:09','2018-01-06 23:29:30',NULL,120),(55,'Наполеон',2,'2018-01-06 23:50:14','2018-01-06 23:29:40',NULL,100),(56,'Панакота',2,'2018-01-06 23:51:11','2018-01-06 23:29:52',NULL,100),(57,'Солянка',3,'2018-01-06 23:43:49','2018-01-06 23:30:06',NULL,210),(58,'Борщ',3,'2018-01-06 23:43:09','2018-01-06 23:30:12',NULL,160),(62,'Супец',3,'2018-01-14 12:37:16','2018-01-14 12:24:40','2018-01-14 12:37:16',0),(63,'Soup',3,'2018-01-14 12:37:11','2018-01-14 12:36:13','2018-01-14 12:37:11',0),(64,'Супец',3,'2018-01-14 13:00:38','2018-01-14 12:38:23',NULL,150),(65,'shiko',1,'2018-01-14 13:14:47','2018-01-14 13:13:20','2018-01-14 13:14:47',0),(66,'ss',1,'2018-01-14 13:14:41','2018-01-14 13:14:30','2018-01-14 13:14:41',0),(69,'bfg',3,'2018-01-19 15:59:04','2018-01-19 15:58:35','2018-01-19 15:59:04',100);
/*!40000 ALTER TABLE `foods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guests`
--

DROP TABLE IF EXISTS `guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guests`
--

LOCK TABLES `guests` WRITE;
/*!40000 ALTER TABLE `guests` DISABLE KEYS */;
INSERT INTO `guests` VALUES (1,'name@gmail.com','Name','Surname','2017-12-26 17:30:04','2017-12-26 17:30:04'),(2,'name1@gmail.com','Nmae1','Surname1','2017-12-26 17:33:18','2017-12-26 17:33:18'),(3,'namsur@mail.com','Name1','Sur1','2017-12-26 17:53:23','2017-12-26 17:53:23');
/*!40000 ALTER TABLE `guests` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (54,'Картофель','2018-01-07 01:34:13','2018-01-19 13:06:30','2018-01-06 23:33:45',NULL),(55,'Рис','2018-01-07 01:37:55','2018-01-06 23:37:55','2018-01-06 23:37:55',NULL),(56,'Греча','2018-01-07 01:38:18','2018-01-06 23:38:18','2018-01-06 23:38:18',NULL),(57,'Капуста','2018-01-07 01:40:53','2018-01-06 23:40:53','2018-01-06 23:40:53',NULL),(58,'Телятина','2018-01-07 01:41:14','2018-01-06 23:41:14','2018-01-06 23:41:14',NULL),(59,'Колбаса №1','2018-01-07 01:41:54','2018-01-06 23:41:54','2018-01-06 23:41:54',NULL),(60,'Колбаса №2','2018-01-07 01:42:09','2018-01-06 23:42:09','2018-01-06 23:42:09',NULL),(61,'Перец','2018-01-07 01:42:20','2018-01-06 23:42:20','2018-01-06 23:42:20',NULL),(62,'Куриное филе','2018-01-07 01:44:25','2018-01-06 23:44:25','2018-01-06 23:44:25',NULL),(63,'Помидор','2018-01-07 01:44:42','2018-01-06 23:44:42','2018-01-06 23:44:42',NULL),(64,'Соус №1','2018-01-07 01:45:10','2018-01-06 23:45:10','2018-01-06 23:45:10',NULL),(65,'Соус №2','2018-01-07 01:45:17','2018-01-06 23:45:17','2018-01-06 23:45:17',NULL),(66,'Огурец','2018-01-07 01:45:38','2018-01-06 23:45:38','2018-01-06 23:45:38',NULL),(67,'Салат','2018-01-07 01:47:51','2018-01-06 23:47:51','2018-01-06 23:47:51',NULL),(68,'Набор для наполеона','2018-01-07 01:48:57','2018-01-06 23:48:57','2018-01-06 23:48:57',NULL),(69,'Набор для тирамису','2018-01-07 01:49:08','2018-01-06 23:50:38','2018-01-06 23:49:08','2018-01-06 23:50:38'),(70,'Набор для панакоты','2018-01-07 01:50:50','2018-01-06 23:50:50','2018-01-06 23:50:50',NULL),(71,'Авокадо','2018-01-14 14:13:49','2018-01-14 12:14:07','2018-01-14 12:13:49','2018-01-14 12:14:07'),(72,'GuGu','2018-01-14 14:14:59','2018-01-14 12:15:39','2018-01-14 12:14:59','2018-01-14 12:15:39'),(73,'NEW','2018-01-14 14:23:43','2018-01-14 12:23:55','2018-01-14 12:23:43','2018-01-14 12:23:55'),(74,'ssdd','2018-01-19 17:55:40','2018-01-19 15:55:47','2018-01-19 15:55:40','2018-01-19 15:55:47');
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
  `user_id` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `netPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `FK_orders_personals` (`user_id`),
  KEY `FK_orders_tables` (`table_id`),
  CONSTRAINT `FK_orders_personals` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_orders_tables` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (11,NULL,1,3,0.00,'2018-01-20 15:49:01','2018-01-20 15:56:16','2018-01-20 15:56:16',0.00),(12,NULL,1,3,0.00,'2018-01-20 16:26:39','2018-01-20 17:17:35','2018-01-20 17:17:35',0.00),(14,NULL,2,3,125.00,'2018-01-20 16:31:37','2018-01-21 11:08:01','2018-01-21 11:08:01',0.00),(15,NULL,3,3,0.00,'2018-01-20 17:12:26','2018-01-20 17:13:01','2018-01-20 17:13:01',0.00),(16,NULL,3,3,0.00,'2018-01-20 17:13:04','2018-01-20 17:13:48','2018-01-20 17:13:48',0.00),(17,NULL,3,3,0.00,'2018-01-20 17:13:49','2018-01-20 17:17:29','2018-01-20 17:17:29',0.00),(19,NULL,1,3,251.00,'2018-01-21 10:23:41','2018-01-21 11:07:53','2018-01-21 11:07:53',0.00),(20,NULL,3,3,106.00,'2018-01-21 11:04:10','2018-01-21 11:08:10','2018-01-21 11:08:10',0.00),(21,NULL,1,3,107.00,'2018-01-21 11:34:24','2018-01-21 11:37:59','2018-01-21 11:37:59',0.00),(22,NULL,2,6,170.00,'2018-01-21 11:38:02','2018-01-21 11:51:06','2018-01-21 11:51:06',0.00),(23,NULL,1,3,470.00,'2018-01-21 11:44:26','2018-01-21 11:50:58','2018-01-21 11:50:58',0.00),(24,NULL,1,3,94.00,'2018-01-21 11:51:21','2018-01-21 12:08:09','2018-01-21 12:08:09',0.00),(25,NULL,1,6,100.00,'2018-01-21 12:08:11','2018-01-23 14:06:10','2018-01-23 14:06:10',46.80),(32,NULL,2,3,0.00,'2018-01-23 12:51:50','2018-01-23 12:52:03','2018-01-23 12:52:03',0.00),(33,NULL,6,6,125.00,'2018-01-23 13:36:53','2018-01-23 14:06:04','2018-01-23 14:06:04',55.50),(34,NULL,1,6,106.00,'2018-01-23 14:08:39','2018-01-23 14:10:59',NULL,44.05),(35,NULL,2,6,0.00,'2018-01-23 14:11:58','2018-01-23 14:11:58',NULL,0.00),(36,NULL,3,6,105.00,'2018-01-23 14:12:09','2018-01-23 14:12:43',NULL,60.15);
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`,`created_at`),
  CONSTRAINT `FK_prices_ingredients` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (54,'2018-01-07 01:35:14',0.01,'2018-01-06 23:40:14','2018-01-06 23:40:14'),(54,'2018-01-07 01:40:14',0.10,'2018-01-07 12:14:26','2018-01-07 12:14:26'),(54,'2018-01-07 14:14:26',1.00,'2018-01-19 13:50:42','2018-01-19 13:50:42'),(54,'2018-01-19 15:50:42',12.00,'2018-01-19 13:57:32',NULL),(55,'2018-01-07 01:38:10',0.50,'2018-01-06 23:38:10',NULL),(56,'2018-01-07 01:38:23',0.50,'2018-01-06 23:38:23',NULL),(57,'2018-01-07 01:41:05',0.40,'2018-01-06 23:41:05',NULL),(58,'2018-01-07 01:41:43',10.00,'2018-01-06 23:41:43',NULL),(59,'2018-01-07 01:42:02',20.00,'2018-01-06 23:42:02',NULL),(60,'2018-01-07 01:42:12',30.00,'2018-01-06 23:42:12',NULL),(61,'2018-01-07 01:42:25',1.00,'2018-01-06 23:42:25',NULL),(62,'2018-01-07 01:44:32',8.00,'2018-01-06 23:44:32',NULL),(63,'2018-01-07 01:44:55',6.00,'2018-01-06 23:44:55',NULL),(64,'2018-01-07 01:45:12',20.00,'2018-01-06 23:45:12',NULL),(65,'2018-01-07 01:45:19',35.00,'2018-01-06 23:45:19',NULL),(66,'2018-01-07 01:45:41',6.00,'2018-01-06 23:45:41',NULL),(67,'2018-01-07 01:47:57',7.00,'2018-01-06 23:47:57',NULL),(68,'2018-01-07 01:49:01',20.00,'2018-01-06 23:49:01',NULL),(69,'2018-01-07 01:49:11',30.00,'2018-01-06 23:50:38','2018-01-06 23:50:38'),(70,'2018-01-07 01:50:52',30.00,'2018-01-06 23:50:52',NULL),(71,'2018-01-14 14:13:56',10.00,'2018-01-14 12:14:07','2018-01-14 12:14:07'),(72,'2018-01-14 14:15:02',10.00,'2018-01-14 12:15:39','2018-01-14 12:15:39'),(73,'2018-01-14 14:23:50',15.00,'2018-01-14 12:23:55','2018-01-14 12:23:55'),(74,'2018-01-19 17:55:43',45.00,'2018-01-19 15:55:47','2018-01-19 15:55:47');
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES (1,'11',NULL,NULL),(2,'22',NULL,NULL),(3,'33',NULL,NULL),(6,'101','2017-12-30 11:50:24','2017-12-30 11:50:24'),(17,'505','2018-01-14 12:02:22','2018-01-14 12:02:22');
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
INSERT INTO `users` VALUES (2,'Должанский','Колян','Рэпер','1987-07-15',1,NULL,NULL,'NbPIYQNIBJbRfMfd47Mcb1t7ClXgEMFY6VoeGgzVgvjrnx8T2e1PGGX2fKN4','admin@gmail.com','$2b$10$u5Ji8hkOzj5WWd8Q1B5LUuQEL3Vk9znG0TGxPo7nCnA5Xnz5TbxO2',NULL),(3,'Пупкин','Вася','Гришевич','1990-12-12',2,'2017-12-12 09:28:52','2017-12-12 09:28:52','gBEQOc9fEucZXYobGE2k6iGRljpiG9iBGf91c5R8Wsqte7L9TfmyZsTnrLsH','off1@gmail.com','$2y$10$agLvcVbYf7kT7lj.vRjNc.NIVtIzHWH8Zw9/Qk2R8cAa.43fMafHK',NULL),(5,'Шеф','Повар','Бондович','1975-10-23',3,'2017-12-12 10:02:02','2017-12-12 10:02:02','uHhtzYDHDsljP5uxRD20joooD7AR7KviE3UKf82AUeXZlFrrWjT8JGDn1rfj','povar@gmail.com','$2y$10$KKFKd29Vd35dWdZ674BZ9uqXbWNlzugvd0midE/PQL5.9wfUcezpa',NULL),(6,'Попкин','Иджворг','Ольгович','1990-06-21',2,'2017-12-18 21:16:09','2017-12-18 21:16:09','EjLfQ0zikpy3u7ds5CPW7P6Xun3DmpiysshV9RFDM1XGfsO9IYWQqyfjYkQG','off2@gmail.com','$2y$10$HVtzpuKb9pyAiSEcVSUCYOxKsEMjUQ2vwQkiAF87pFKO5bXEPXRCa',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visits`
--

DROP TABLE IF EXISTS `visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visits` (
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `midname` varchar(100) DEFAULT NULL,
  `entered` timestamp NULL DEFAULT NULL,
  `goneaway` timestamp NULL DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visits`
--

LOCK TABLES `visits` WRITE;
/*!40000 ALTER TABLE `visits` DISABLE KEYS */;
/*!40000 ALTER TABLE `visits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-23 16:25:46
