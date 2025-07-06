-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: galery
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photos` (
  `id_photo` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `photo` varchar(255) NOT NULL COMMENT 'Photo file path',
  `category` enum('Naturaleza','Arquitectura','Personas','Animales','Tecnologia') NOT NULL,
  PRIMARY KEY (`id_photo`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
INSERT INTO `photos` VALUES (1,'1751837867_descargar (4).jpg','Naturaleza'),(2,'1751838310_descargar (3).jpg','Arquitectura'),(3,'1751839413_descargar (2).jpg','Personas'),(4,'1751839423_descargar (1).jpg','Animales'),(5,'1751839430_descargar.jpg','Tecnologia'),(6,'1751838310_descargar (3).jpg','Naturaleza'),(7,'1751839430_descargar.jpg','Naturaleza'),(8,'1751839423_descargar (1).jpg','Naturaleza'),(9,'1751837867_descargar (4).jpg','Naturaleza'),(10,'1751839413_descargar (2).jpg','Naturaleza'),(11,'1751839430_descargar.jpg','Naturaleza'),(12,'1751838310_descargar (3).jpg','Naturaleza'),(13,'1751839423_descargar (1).jpg','Naturaleza'),(14,'1751839413_descargar (2).jpg','Naturaleza'),(15,'1751837867_descargar (4).jpg','Naturaleza'),(16,'1751838310_descargar (3).jpg','Naturaleza'),(17,'1751839430_descargar.jpg','Naturaleza'),(18,'1751839423_descargar (1).jpg','Naturaleza'),(19,'1751837867_descargar (4).jpg','Naturaleza'),(20,'1751839413_descargar (2).jpg','Naturaleza'),(21,'1751839430_descargar.jpg','Naturaleza'),(22,'1751838310_descargar (3).jpg','Naturaleza'),(23,'1751839423_descargar (1).jpg','Naturaleza'),(24,'1751839413_descargar (2).jpg','Naturaleza'),(25,'1751837867_descargar (4).jpg','Naturaleza'),(26,'1751839413_descargar (2).jpg','Arquitectura'),(27,'1751839430_descargar.jpg','Arquitectura'),(28,'1751839423_descargar (1).jpg','Arquitectura'),(29,'1751837867_descargar (4).jpg','Arquitectura'),(30,'1751838310_descargar (3).jpg','Arquitectura'),(31,'1751839430_descargar.jpg','Arquitectura'),(32,'1751839423_descargar (1).jpg','Arquitectura'),(33,'1751837867_descargar (4).jpg','Arquitectura'),(34,'1751839413_descargar (2).jpg','Arquitectura'),(35,'1751838310_descargar (3).jpg','Arquitectura'),(36,'1751839430_descargar.jpg','Arquitectura'),(37,'1751839423_descargar (1).jpg','Arquitectura'),(38,'1751837867_descargar (4).jpg','Arquitectura'),(39,'1751839413_descargar (2).jpg','Arquitectura'),(40,'1751838310_descargar (3).jpg','Arquitectura'),(41,'1751839430_descargar.jpg','Arquitectura'),(42,'1751839423_descargar (1).jpg','Arquitectura'),(43,'1751837867_descargar (4).jpg','Arquitectura'),(44,'1751839413_descargar (2).jpg','Arquitectura'),(45,'1751838310_descargar (3).jpg','Arquitectura'),(46,'1751839423_descargar (1).jpg','Personas'),(47,'1751839430_descargar.jpg','Personas'),(48,'1751837867_descargar (4).jpg','Personas'),(49,'1751838310_descargar (3).jpg','Personas'),(50,'1751839413_descargar (2).jpg','Personas'),(51,'1751839430_descargar.jpg','Personas'),(52,'1751839423_descargar (1).jpg','Personas'),(53,'1751837867_descargar (4).jpg','Personas'),(54,'1751838310_descargar (3).jpg','Personas'),(55,'1751839413_descargar (2).jpg','Personas'),(56,'1751839430_descargar.jpg','Personas'),(57,'1751839423_descargar (1).jpg','Personas'),(58,'1751837867_descargar (4).jpg','Personas'),(59,'1751838310_descargar (3).jpg','Personas'),(60,'1751839413_descargar (2).jpg','Personas'),(61,'1751839430_descargar.jpg','Personas'),(62,'1751839423_descargar (1).jpg','Personas'),(63,'1751837867_descargar (4).jpg','Personas'),(64,'1751838310_descargar (3).jpg','Personas'),(65,'1751839413_descargar (2).jpg','Personas'),(66,'1751837867_descargar (4).jpg','Animales'),(67,'1751839430_descargar.jpg','Animales'),(68,'1751839423_descargar (1).jpg','Animales'),(69,'1751838310_descargar (3).jpg','Animales'),(70,'1751839413_descargar (2).jpg','Animales'),(71,'1751839430_descargar.jpg','Animales'),(72,'1751839423_descargar (1).jpg','Animales'),(73,'1751837867_descargar (4).jpg','Animales'),(74,'1751838310_descargar (3).jpg','Animales'),(75,'1751839413_descargar (2).jpg','Animales'),(76,'1751839430_descargar.jpg','Animales'),(77,'1751839423_descargar (1).jpg','Animales'),(78,'1751837867_descargar (4).jpg','Animales'),(79,'1751838310_descargar (3).jpg','Animales'),(80,'1751839413_descargar (2).jpg','Animales'),(81,'1751839430_descargar.jpg','Animales'),(82,'1751839423_descargar (1).jpg','Animales'),(83,'1751837867_descargar (4).jpg','Animales'),(84,'1751838310_descargar (3).jpg','Animales'),(85,'1751839413_descargar (2).jpg','Animales'),(86,'1751839430_descargar.jpg','Tecnologia'),(87,'1751839423_descargar (1).jpg','Tecnologia'),(88,'1751837867_descargar (4).jpg','Tecnologia'),(89,'1751838310_descargar (3).jpg','Tecnologia'),(90,'1751839413_descargar (2).jpg','Tecnologia'),(91,'1751839430_descargar.jpg','Tecnologia'),(92,'1751839423_descargar (1).jpg','Tecnologia'),(93,'1751837867_descargar (4).jpg','Tecnologia'),(94,'1751838310_descargar (3).jpg','Tecnologia'),(95,'1751839413_descargar (2).jpg','Tecnologia'),(96,'1751839430_descargar.jpg','Tecnologia'),(97,'1751839423_descargar (1).jpg','Tecnologia'),(98,'1751837867_descargar (4).jpg','Tecnologia'),(99,'1751838310_descargar (3).jpg','Tecnologia'),(100,'1751839413_descargar (2).jpg','Tecnologia'),(101,'1751839430_descargar.jpg','Tecnologia'),(102,'1751839423_descargar (1).jpg','Tecnologia'),(103,'1751837867_descargar (4).jpg','Tecnologia'),(104,'1751838310_descargar (3).jpg','Tecnologia'),(105,'1751839413_descargar (2).jpg','Tecnologia');
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_session` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('admin','employee','client') DEFAULT 'client',
  `status` enum('active','inactive','pending') DEFAULT 'active',
  `profile_picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'juan','$2y$10$LpaqkSNHJSL43dffDhiNZOkIx.m1EVSjQfCaYNSVC.UPSmmzcW3J.','2025-06-03 05:05:05','2025-07-06 22:29:15','admin','active','default.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Dumping routines for database 'galery'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-06 17:32:44
