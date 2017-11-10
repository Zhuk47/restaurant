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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `idc` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`idc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foods`
--

DROP TABLE IF EXISTS `foods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foods` (
  `idf` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `idc` int(11) DEFAULT NULL,
  `datetime_in` datetime DEFAULT NULL,
  `datetime_out` datetime DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idf`),
  KEY `foods_categories_idc_fk` (`idc`),
  CONSTRAINT `foods_categories_idc_fk` FOREIGN KEY (`idc`) REFERENCES `categories` (`idc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foods`
--

LOCK TABLES `foods` WRITE;
/*!40000 ALTER TABLE `foods` DISABLE KEYS */;
/*!40000 ALTER TABLE `foods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foods_orders`
--

DROP TABLE IF EXISTS `foods_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foods_orders` (
  `ido` int(11) DEFAULT NULL,
  `idf` int(11) DEFAULT NULL,
  `datetime_add` datetime DEFAULT NULL,
  KEY `foods_orders_orders_ido_fk` (`ido`),
  KEY `foods_orders_foods_idf_fk` (`idf`),
  CONSTRAINT `foods_orders_foods_idf_fk` FOREIGN KEY (`idf`) REFERENCES `foods` (`idf`),
  CONSTRAINT `foods_orders_orders_ido_fk` FOREIGN KEY (`ido`) REFERENCES `orders` (`ido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foods_orders`
--

LOCK TABLES `foods_orders` WRITE;
/*!40000 ALTER TABLE `foods_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `foods_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `idi` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`idi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients_foods`
--

DROP TABLE IF EXISTS `ingredients_foods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients_foods` (
  `idi` int(11) DEFAULT NULL,
  `idf` int(11) DEFAULT NULL,
  `mass` int(11) DEFAULT NULL,
  KEY `ingredients_foods_ingredients_idi_fk` (`idi`),
  KEY `ingredients_foods_foods_idf_fk` (`idf`),
  CONSTRAINT `ingredients_foods_foods_idf_fk` FOREIGN KEY (`idf`) REFERENCES `foods` (`idf`),
  CONSTRAINT `ingredients_foods_ingredients_idi_fk` FOREIGN KEY (`idi`) REFERENCES `ingredients` (`idi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients_foods`
--

LOCK TABLES `ingredients_foods` WRITE;
/*!40000 ALTER TABLE `ingredients_foods` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingredients_foods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `ido` int(11) NOT NULL AUTO_INCREMENT,
  `serial` int(11) NOT NULL,
  `idt` int(11) DEFAULT NULL,
  `datetime_in` datetime DEFAULT NULL,
  `datetime_out` datetime DEFAULT NULL,
  PRIMARY KEY (`ido`),
  KEY `orders_tables_idt_fk` (`idt`),
  CONSTRAINT `orders_tables_idt_fk` FOREIGN KEY (`idt`) REFERENCES `tables` (`idt`)
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
-- Table structure for table `personals`
--

DROP TABLE IF EXISTS `personals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personals` (
  `idp` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `idr` int(11) DEFAULT NULL,
  PRIMARY KEY (`idp`),
  KEY `personals_roles_idr_fk` (`idr`),
  CONSTRAINT `personals_roles_idr_fk` FOREIGN KEY (`idr`) REFERENCES `roles` (`idr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personals`
--

LOCK TABLES `personals` WRITE;
/*!40000 ALTER TABLE `personals` DISABLE KEYS */;
/*!40000 ALTER TABLE `personals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `idr` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`idr`)
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
  `idt` int(11) NOT NULL AUTO_INCREMENT,
  `serial` int(11) NOT NULL,
  `idp` int(11) DEFAULT NULL,
  PRIMARY KEY (`idt`),
  KEY `tables_personals_idp_fk` (`idp`),
  CONSTRAINT `tables_personals_idp_fk` FOREIGN KEY (`idp`) REFERENCES `personals` (`idp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-10 20:42:13
