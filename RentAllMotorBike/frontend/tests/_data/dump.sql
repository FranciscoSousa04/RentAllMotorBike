CREATE DATABASE  IF NOT EXISTS `projetodb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `projetodb`;
-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: projetodb
-- ------------------------------------------------------
-- Server version	5.7.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `analise`
--

DROP TABLE IF EXISTS `analise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `analise` (
  `id_analise` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(255) NOT NULL,
  `classificacao` int(11) NOT NULL,
  `data_analise` datetime NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id_analise`),
  KEY `profile_id` (`profile_id`),
  CONSTRAINT `analise_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `analise`
--

LOCK TABLES `analise` WRITE;
/*!40000 ALTER TABLE `analise` DISABLE KEYS */;
INSERT INTO `analise` VALUES (1,'Melhor serviço para alugar carros, com vários extras. Recomendo!',5,'2022-12-14 18:36:30',3),(2,'Aluguer impecável, muito prestáveis, recomendo vivamente',5,'2023-01-09 12:29:53',5),(3,'Apesar do carro ter desempenhado bem, podia ter vindo mais higienizado',4,'2023-01-09 12:40:55',6);
/*!40000 ALTER TABLE `analise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assistencia`
--

DROP TABLE IF EXISTS `assistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assistencia` (
  `id_assistencia` int(11) NOT NULL AUTO_INCREMENT,
  `data_pedido` datetime NOT NULL,
  `mensagem` varchar(91) NOT NULL,
  `localizacao` varchar(51) NOT NULL,
  `condicao` enum('resolvido','nao_resolvido') NOT NULL DEFAULT 'nao_resolvido',
  `motociclo_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id_assistencia`),
  KEY `profile_id` (`profile_id`),
  KEY `motociclo_id` (`motociclo_id`),
  CONSTRAINT `assistencia_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id_profile`),
  CONSTRAINT `assistencia_ibfk_2` FOREIGN KEY (`motociclo_id`) REFERENCES `motociclo` (`id_motociclo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assistencia`
--

LOCK TABLES `assistencia` WRITE;
/*!40000 ALTER TABLE `assistencia` DISABLE KEYS */;
INSERT INTO `assistencia` VALUES (1,'2022-12-14 18:36:30','O motociclo deixou de pegar.','Leiria, Rua de Leiria','resolvido',2,3),(2,'2022-12-14 18:36:30','O motociclo ficou sem combustivel.','Batalha, Rua da Batalha','nao_resolvido',1,2),(3,'2022-12-14 18:36:30','O motociclo nao fecha vidro do condutor.','Leiria, Rua do IPL','nao_resolvido',2,2);
/*!40000 ALTER TABLE `assistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('admin','1',1668699861),('cliente','3',1669113612),('cliente','4',1670930337),('cliente','5',1670930560),('cliente','6',1670930653),('cliente','7',1670930692),('gestor','2',1669113553);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,NULL,NULL,NULL,1668699861,1668699861),('cliente',1,NULL,NULL,NULL,1668699860,1668699860),('createAnalise',2,NULL,NULL,NULL,1668699860,1668699860),('createExtra',2,NULL,NULL,NULL,1668699860,1668699860),('createFuncionario',2,NULL,NULL,NULL,1668699860,1668699860),('createImagem',2,NULL,NULL,NULL,1668699860,1668699860),('createLocalizacao',2,NULL,NULL,NULL,1668699860,1668699860),('createReserva',2,NULL,NULL,NULL,1668699860,1668699860),('createSeguro',2,NULL,NULL,NULL,1668699860,1668699860),('createMotociclo',2,NULL,NULL,NULL,1668699860,1668699860),('deleteAnalise',2,NULL,NULL,NULL,1668699860,1668699860),('deleteExtra',2,NULL,NULL,NULL,1668699860,1668699860),('deleteFuncionario',2,NULL,NULL,NULL,1668699860,1668699860),('deleteImagem',2,NULL,NULL,NULL,1668699860,1668699860),('deleteLocalizacao',2,NULL,NULL,NULL,1668699860,1668699860),('deleteReserva',2,NULL,NULL,NULL,1668699860,1668699860),('deleteSeguro',2,NULL,NULL,NULL,1668699860,1668699860),('deleteMotociclo',2,NULL,NULL,NULL,1668699860,1668699860),('gestor',1,NULL,NULL,NULL,1668699860,1668699860),('updateAnalise',2,NULL,NULL,NULL,1668699860,1668699860),('updateExtra',2,NULL,NULL,NULL,1668699860,1668699860),('updateFuncionario',2,NULL,NULL,NULL,1668699860,1668699860),('updateLocalizacao',2,NULL,NULL,NULL,1668699860,1668699860),('updateReserva',2,NULL,NULL,NULL,1668699860,1668699860),('updateSeguro',2,NULL,NULL,NULL,1668699860,1668699860),('updateMotociclo',2,NULL,NULL,NULL,1668699860,1668699860),('viewFuncionario',2,NULL,NULL,NULL,1668699860,1668699860),('viewReserva',2,NULL,NULL,NULL,1668699860,1668699860);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('cliente','createAnalise'),('gestor','createExtra'),('admin','createFuncionario'),('gestor','createImagem'),('gestor','createLocalizacao'),('cliente','createReserva'),('gestor','createSeguro'),('gestor','createMotociclo'),('cliente','deleteAnalise'),('gestor','deleteExtra'),('admin','deleteFuncionario'),('gestor','deleteImagem'),('gestor','deleteLocalizacao'),('cliente','deleteReserva'),('gestor','deleteSeguro'),('gestor','deleteMotociclo'),('admin','gestor'),('cliente','updateAnalise'),('gestor','updateExtra'),('admin','updateFuncionario'),('gestor','updateLocalizacao'),('cliente','updateReserva'),('gestor','updateSeguro'),('gestor','updateMotociclo'),('admin','viewFuncionario'),('cliente','viewReserva');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalhes_aluguer`
--

DROP TABLE IF EXISTS `detalhes_aluguer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalhes_aluguer` (
  `id_detalhes_aluguer` int(11) NOT NULL AUTO_INCREMENT,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `motociclo_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `seguro_id` int(11) NOT NULL,
  `localizacao_levantamento_id` int(11) NOT NULL,
  `localizacao_devolucao_id` int(11) NOT NULL,
  PRIMARY KEY (`id_detalhes_aluguer`),
  KEY `motociclo_id` (`motociclo_id`),
  KEY `profile_id` (`profile_id`),
  KEY `seguro_id` (`seguro_id`),
  KEY `localizacao_levantamento_id` (`localizacao_levantamento_id`),
  KEY `localizacao_devolucao_id` (`localizacao_devolucao_id`),
  CONSTRAINT `detalhes_aluguer_ibfk_1` FOREIGN KEY (`motociclo_id`) REFERENCES `motociclo` (`id_motociclo`),
  CONSTRAINT `detalhes_aluguer_ibfk_2` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id_profile`),
  CONSTRAINT `detalhes_aluguer_ibfk_3` FOREIGN KEY (`seguro_id`) REFERENCES `seguro` (`id_seguro`),
  CONSTRAINT `detalhes_aluguer_ibfk_4` FOREIGN KEY (`localizacao_levantamento_id`) REFERENCES `localizacao` (`id_localizacao`),
  CONSTRAINT `detalhes_aluguer_ibfk_5` FOREIGN KEY (`localizacao_devolucao_id`) REFERENCES `localizacao` (`id_localizacao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalhes_aluguer`
--

LOCK TABLES `detalhes_aluguer` WRITE;
/*!40000 ALTER TABLE `detalhes_aluguer` DISABLE KEYS */;
INSERT INTO `detalhes_aluguer` VALUES (1,'2022-12-23 00:00:00','2022-12-30 00:00:00',1,3,2,1,1),(2,'2022-12-25 00:00:00','2022-12-31 00:00:00',3,5,1,1,2),(3,'2022-12-28 00:00:00','2022-12-28 00:00:00',2,6,1,1,1),(4,'2022-12-31 00:00:00','2023-01-02 00:00:00',1,5,1,1,1),(5,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,3,3,1,1),(6,'2023-01-13 00:00:00','2023-01-15 00:00:00',1,3,3,1,2);
/*!40000 ALTER TABLE `detalhes_aluguer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extra`
--

DROP TABLE IF EXISTS `extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extra` (
  `id_extra` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `preco` double(4,2) NOT NULL,
  PRIMARY KEY (`id_extra`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra`
--

LOCK TABLES `extra` WRITE;
/*!40000 ALTER TABLE `extra` DISABLE KEYS */;
INSERT INTO `extra` VALUES (1,'Via-Verde',6.99),(2,'Cadeira de Bebé',3.99),(3,'Navegador Gps',4.99),(4,'Correntes de neve',2.99),(5,'Condutor adicional',10.99),(6,'Kms ilimitados',5.99);
/*!40000 ALTER TABLE `extra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extra_detalhes_aluguer`
--

DROP TABLE IF EXISTS `extra_detalhes_aluguer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extra_detalhes_aluguer` (
  `id_extra_detalhes_aluguer` int(11) NOT NULL AUTO_INCREMENT,
  `extra_id` int(11) NOT NULL,
  `detalhes_aluguer_id` int(11) NOT NULL,
  PRIMARY KEY (`id_extra_detalhes_aluguer`),
  KEY `extra_id` (`extra_id`),
  KEY `detalhes_aluguer_id` (`detalhes_aluguer_id`),
  CONSTRAINT `extra_detalhes_aluguer_ibfk_1` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id_extra`),
  CONSTRAINT `extra_detalhes_aluguer_ibfk_2` FOREIGN KEY (`detalhes_aluguer_id`) REFERENCES `detalhes_aluguer` (`id_detalhes_aluguer`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra_detalhes_aluguer`
--

LOCK TABLES `extra_detalhes_aluguer` WRITE;
/*!40000 ALTER TABLE `extra_detalhes_aluguer` DISABLE KEYS */;
INSERT INTO `extra_detalhes_aluguer` VALUES (1,1,1),(2,1,2),(3,2,2),(4,1,4),(5,2,4),(6,5,5),(7,6,5),(8,1,6),(9,2,6),(10,3,6),(11,4,6),(12,5,6),(13,6,6);
/*!40000 ALTER TABLE `extra_detalhes_aluguer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fatura`
--

DROP TABLE IF EXISTS `fatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fatura` (
  `id_fatura` int(11) NOT NULL AUTO_INCREMENT,
  `data_fatura` datetime NOT NULL,
  `preco_total` double(5,2) NOT NULL,
  `detalhes_aluguer_fatura_id` int(11) NOT NULL,
  PRIMARY KEY (`id_fatura`),
  KEY `detalhes_aluguer_fatura_id` (`detalhes_aluguer_fatura_id`),
  CONSTRAINT `fatura_ibfk_1` FOREIGN KEY (`detalhes_aluguer_fatura_id`) REFERENCES `detalhes_aluguer` (`id_detalhes_aluguer`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fatura`
--

LOCK TABLES `fatura` WRITE;
/*!40000 ALTER TABLE `fatura` DISABLE KEYS */;
INSERT INTO `fatura` VALUES (3,'2022-12-25 15:27:48',425.82,2),(4,'2022-12-25 15:29:58',425.82,2),(5,'2022-12-25 15:31:24',425.82,2),(6,'2022-12-25 15:37:00',425.82,2),(7,'2022-12-25 15:37:08',258.86,1),(8,'2022-12-25 15:39:46',0.00,3),(9,'2022-12-25 15:40:21',0.00,3),(10,'2022-12-26 00:49:00',17.99,3),(11,'2022-12-26 00:50:01',399.76,1),(12,'2022-12-26 00:50:06',25.98,3),(13,'2022-12-26 11:22:57',25.98,3),(14,'2022-12-26 11:23:01',399.76,1),(15,'2023-01-08 15:02:41',287.76,6);
/*!40000 ALTER TABLE `fatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imagem` (
  `id_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `imagem` varchar(81) NOT NULL,
  `motociclo_id` int(11) NOT NULL,
  PRIMARY KEY (`id_imagem`),
  KEY `motociclo_id` (`motociclo_id`),
  CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`motociclo_id`) REFERENCES `motociclo` (`id_motociclo`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagem`
--

LOCK TABLES `imagem` WRITE;
/*!40000 ALTER TABLE `imagem` DISABLE KEYS */;
INSERT INTO `imagem` VALUES (1,'bmw_x1.2.jpg',3),(2,'bmw_x1.jpg',3),(3,'bmw-x1-branco.jpg',3),(4,'bmw-x1-xdrive25e-ensaio-teste-review-guilherme-andre-19-de-27-1024x683.jpg',3),(5,'Classe-C-coupé-2017-15.jpg',4),(6,'Classe-C-coupé-2017-19.jpg',4),(7,'Classe-C-coupé-2017-20.jpg',4),(8,'EDN_NCAUTO_10391272-0.jpg',4),(9,'frisos-das-embaladeiras-maxton-seat-ibiza-6l-cupra_21678.jpg',2),(10,'frisos-das-embaladeiras-maxton-seat-ibiza-6l-cupra_21675.jpg',2),(11,'maxresdefault.jpg',2),(12,'14673_4.jpg',2),(13,'1-580x400.jpg',5),(14,'1-680x400.jpg',5),(15,'2-680x400.jpg',5),(16,'3-580x400.jpg',5),(17,'volkswagen_golf_r32_3-e1541111487266.jpg',1),(18,'volkswagen_golf_r32_10_925x520_acf_cropped.jpg',1),(19,'volkswagen_golf_r32_24-e1541111184841.jpg',1),(20,'volkswagen_golf_r32_26-e1541111228643.jpg',1),(21,'audi A6.jpg',6),(22,'audi A6-2.jpg',6),(23,'audi A6-3.jpg',6),(24,'audi A6-4.jpg',6),(25,'BMW X5.jpg',7),(26,'bmwx5 2.jpg',7),(27,'bwn x5.jpg',7),(28,'kango-4.jpg',8),(29,'kangoo.jpg',8),(30,'Renault KANGOO.jpg',8),(31,'Renault KANGOO2.jpg',8),(32,'land rouver evouce.jpg',9),(33,'land rouver evouque-2.jpg',9),(34,'land rouver evouque-3.jpg',9),(35,'land rouver evouque-4.jpg',9),(36,'mini.jpg',10),(37,'mini-2.jpg',10),(38,'mini-3.jpg',10),(39,'mini-4.jpg',10),(40,'renault-clio.jpg',11),(41,'Screenshot_3.jpg',11),(42,'Screenshot_13.jpg',11),(43,'Volvo V40 2.0 D2 Kinetic Eco.jpg',12),(44,'Volvo V40 2.0 D2 Kinetic Eco-2.jpg',12),(45,'Volvo v40.jpg',12),(46,'volvo v40-2.jpg',12),(47,'volkswagen_golf_r32_3-e1541111487266.jpg',1),(48,'volkswagen_golf_r32_10_925x520_acf_cropped.jpg',1),(49,'volkswagen_golf_r32_24-e1541111184841.jpg',1),(50,'volkswagen_golf_r32_26-e1541111228643.jpg',1);
/*!40000 ALTER TABLE `imagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linha_fatura`
--

DROP TABLE IF EXISTS `linha_fatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linha_fatura` (
  `id_linha_fatura` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `preco` double(5,2) DEFAULT NULL,
  `fatura_id` int(11) NOT NULL,
  PRIMARY KEY (`id_linha_fatura`),
  KEY `fatura_id` (`fatura_id`),
  CONSTRAINT `linha_fatura_ibfk_1` FOREIGN KEY (`fatura_id`) REFERENCES `fatura` (`id_fatura`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linha_fatura`
--

LOCK TABLES `linha_fatura` WRITE;
/*!40000 ALTER TABLE `linha_fatura` DISABLE KEYS */;
INSERT INTO `linha_fatura` VALUES (1,'BMW X1',59.99,3),(2,'Seguro Directo Seguro de responsabilidade civil',7.99,3),(3,'Via-Verde',6.99,3),(4,'Cadeira de Bebé',3.99,3),(5,'BMW X1',59.99,5),(6,'Seguro Directo Seguro de responsabilidade civil',7.99,5),(7,'Leiria',NULL,5),(8,'Leiria - Batalha',NULL,5),(9,'Via-Verde',6.99,5),(10,'Cadeira de Bebé',3.99,5),(11,'BMW X1',59.99,6),(12,'Seguro Directo Seguro de responsabilidade civil',7.99,6),(13,'Leiria',NULL,6),(14,'Leiria - Batalha',NULL,6),(15,'Via-Verde',6.99,6),(16,'Cadeira de Bebé',3.99,6),(17,'VW Golf',29.99,7),(18,'Seguro Directo Seguro de danos próprios',12.99,7),(19,'Leiria',NULL,7),(20,'Leiria',NULL,7),(21,'Via-Verde',6.99,7),(22,'Seat Ibiza',17.99,8),(23,'Seguro Directo Seguro de responsabilidade civil',7.99,8),(24,'Leiria',NULL,8),(25,'Leiria',NULL,8),(26,'Seat Ibiza',17.99,9),(27,'Seguro Directo Seguro de responsabilidade civil',7.99,9),(28,'Leiria',NULL,9),(29,'Leiria',NULL,9),(30,'Seat Ibiza',17.99,10),(31,'Seguro Directo Seguro de responsabilidade civil',7.99,10),(32,'Leiria',NULL,10),(33,'Leiria',NULL,10),(34,'VW Golf',29.99,11),(35,'Seguro Directo Seguro de danos próprios',12.99,11),(36,'Leiria',NULL,11),(37,'Leiria',NULL,11),(38,'Via-Verde',6.99,11),(39,'Seat Ibiza',17.99,12),(40,'Seguro Directo Seguro de responsabilidade civil',7.99,12),(41,'Leiria',NULL,12),(42,'Leiria',NULL,12),(43,'Seat Ibiza',17.99,13),(44,'Seguro Directo Seguro de responsabilidade civil',7.99,13),(45,'Leiria',NULL,13),(46,'Leiria',NULL,13),(47,'VW Golf',29.99,14),(48,'Seguro Directo Seguro de danos próprios',12.99,14),(49,'Leiria',NULL,14),(50,'Leiria',NULL,14),(51,'Via-Verde',6.99,14),(52,'VW Golf',29.99,15),(53,'Seguro Tranquilidade Proteção total',29.99,15),(54,'Leiria',NULL,15),(55,'Leiria - Batalha',NULL,15),(56,'Via-Verde',6.99,15),(57,'Cadeira de Bebé',3.99,15),(58,'Navegador Gps',4.99,15),(59,'Correntes de neve',2.99,15),(60,'Condutor adicional',10.99,15),(61,'Kms ilimitados',5.99,15);
/*!40000 ALTER TABLE `linha_fatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localizacao`
--

DROP TABLE IF EXISTS `localizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `localizacao` (
  `id_localizacao` int(11) NOT NULL AUTO_INCREMENT,
  `localizacao` varchar(51) NOT NULL,
  `morada` varchar(71) NOT NULL,
  `cod_postal` varchar(9) NOT NULL,
  PRIMARY KEY (`id_localizacao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localizacao`
--

LOCK TABLES `localizacao` WRITE;
/*!40000 ALTER TABLE `localizacao` DISABLE KEYS */;
INSERT INTO `localizacao` VALUES (1,'Leiria','Rua dos testes-Leiria','2400-137'),(2,'Lisboa','Rua dos testes-Lisboa','1000-012'),(3,'Coimbra','Rua da Charneca- Coimbra','3000-011'),(4,'Porto','Alto do Vieiro-Porto','4000-016'),(5,'Aveiro','Rua de Bourges-Aveiro','3800-012');
/*!40000 ALTER TABLE `localizacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1668699434),('m130524_201442_init',1668699492),('m190124_110200_add_verification_token_column_to_user_table',1668699492),('m140506_102106_rbac_init',1668699853),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1668699853),('m180523_151638_rbac_updates_indexes_without_prefix',1668699853),('m200409_110543_rbac_update_mssql_trigger',1668699853),('m221024_153827_init_rbac',1668699861);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL,
  `nome` varchar(21) NOT NULL,
  `apelido` varchar(21) NOT NULL,
  `telemovel` int(11) NOT NULL,
  `nif` int(11) NOT NULL,
  `nr_cartaconducao` varchar(12) NOT NULL,
  PRIMARY KEY (`id_profile`),
  UNIQUE KEY `telemovel` (`telemovel`),
  UNIQUE KEY `nif` (`nif`),
  UNIQUE KEY `nr_cartaconducao` (`nr_cartaconducao`),
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`id_profile`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,'Admin','Admin',111222333,111222333,'111222333'),(2,'Gestor','Gestor',111333222,111333222,'111333222'),(3,'User','User',123123123,123123123,'123123123'),(5,' bnbnm','vbk',123456789,123456899,'123456789'),(6,'teste','teste',999999999,999999999,'999999999');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguro`
--

DROP TABLE IF EXISTS `seguro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguro` (
  `id_seguro` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(51) NOT NULL,
  `cobertura` varchar(81) NOT NULL,
  `preco` double(4,2) NOT NULL,
  PRIMARY KEY (`id_seguro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguro`
--

LOCK TABLES `seguro` WRITE;
/*!40000 ALTER TABLE `seguro` DISABLE KEYS */;
INSERT INTO `seguro` VALUES (1,'Seguro Directo','Seguro de responsabilidade civil',7.99),(2,'Seguro Directo','Seguro de danos próprios',12.99),(3,'Seguro Tranquilidade','Proteção total',29.99),(4,'Seguro Ageas','Proteção contra roubo',19.99),(5,'Seguro Fidelidade','Cobertura de Franquia',24.99);
/*!40000 ALTER TABLE `seguro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_motociclo`
--

DROP TABLE IF EXISTS `tipo_motociclo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_motociclo` (
  `id_tipo_motociclo` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(21) NOT NULL,
  PRIMARY KEY (`id_tipo_motociclo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_motociclo`
--

LOCK TABLES `tipo_motociclo` WRITE;
/*!40000 ALTER TABLE `tipo_motociclo` DISABLE KEYS */;
INSERT INTO `tipo_motociclo` VALUES (1,'Cabrio'),(2,'Carrinha'),(3,'Citadino'),(4,'Coupé'),(5,'Monovolume'),(6,'Sedan'),(7,'SUV/TT'),(8,'Utilitário');
/*!40000 ALTER TABLE `tipo_motociclo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','qhh_D_rjXk5nFH4dD-liyIl0RNvRXU9R','$2y$13$YxjWLJIZTH.7ntzdd8GjpeqnVv5UBGqAsJjwnOEPa4emja097hlNu',NULL,'admin@pt.pt',10,1668699757,1668699757,NULL),(2,'gestor','EXCaWo9ZYSb-Q-zNqsp_qGmn0FMcyS_B','$2y$13$Fh4/AvcO8vN2UP5yfSR2duaxsiEw/9XH1ixDJn/Y1xnbtfMpPiENO',NULL,'gestor@gestor.pt',10,1669113553,1669113553,NULL),(3,'user','aNf2v4jFaFTtkhEEGLX_e2c9CzEbQfH0','$2y$13$/zEe47G89rne0DuFfCGlkOWXHF3KS7XLt/VqR.yekIa1txS2qwHTa',NULL,'user@user.pt',10,1669113612,1669113612,NULL),(5,'aula','yHLuEDgyAZ-boOB8sw8uK9H0sRJHH6ij','$2y$13$jlmcR5eAQf0zvqeMCN6t5O27aN5KtBZ5Wz74Ni8NzLsN.bbHXGlK.',NULL,'rtyuil@ghjkl.py',10,1670930560,1670930560,NULL),(6,'aula2','ijtyyDXaGt88nCfyjDIauLQ2AtYvvvcl','$2y$13$Mr1ZxZbjpw1pM45byCL.CeVRNsDOz6RSrWDO5R7JcA1AzKhr4ZRSi',NULL,'aual2@aula2.pt',10,1670930653,1670930653,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motociclo`
--

DROP TABLE IF EXISTS `motociclo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `motociclo` (
  `id_motociclo` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(21) NOT NULL,
  `modelo` varchar(31) NOT NULL,
  `combustivel` varchar(9) NOT NULL,
  `preco` double(5,2) NOT NULL,
  `matricula` varchar(9) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `estado` enum('pronto','manutencao') NOT NULL,
  `tipo_motociclo_id` int(11) NOT NULL,
  `localizacao_id` int(11) NOT NULL,
  `franquia` int(11) NOT NULL,
  PRIMARY KEY (`id_motociclo`),
  UNIQUE KEY `matricula` (`matricula`),
  KEY `localizacao_id` (`localizacao_id`),
  KEY `tipo_motociclo_id` (`tipo_motociclo_id`),
  CONSTRAINT `motociclo_ibfk_1` FOREIGN KEY (`localizacao_id`) REFERENCES `localizacao` (`id_localizacao`),
  CONSTRAINT `motociclo_ibfk_2` FOREIGN KEY (`tipo_motociclo_id`) REFERENCES `tipo_motociclo` (`id_tipo_motociclo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motociclo`
--

LOCK TABLES `motociclo` WRITE;
/*!40000 ALTER TABLE `motociclo` DISABLE KEYS */;
INSERT INTO `motociclo` VALUES (1,'VW','Golf','diesel',29.99,'AA-11-AA','Longa descrição do motociclo','pronto',8,1,1250),(2,'Seat','Ibiza','Gasolina',17.99,'CC-33-CC','Longa descrição do motociclo','pronto',3,3,1100),(3,'BMW','X1','diesel',59.99,'BB-22-BB','Longa descrição do motociclo','pronto',7,5,3100),(4,'Mercedes','c220','diesel',49.99,'32-eo-99','mercedes c220 coupe','pronto',4,1,2200),(5,'Fiat','500','gasolina',25.99,'12-zj-32','teste','pronto',1,2,2000),(6,'Audi','A6','diesel',54.99,'09-li-66','Audi A6 impecável xpto','pronto',2,4,2900),(7,'BMW','X5','hibrido',64.99,'23-as-23','Bmw x5 bonito','pronto',7,2,3400),(8,'Renault','Kangoo','diesel',32.99,'32-io-22','Carrinha comercial importada','pronto',8,2,1500),(9,'Land Rover','Evoque','diesel',55.99,'13-ns-23','Suv impressionante','pronto',7,1,2700),(10,'Mini','Clubman','gasolina',37.99,'12-pt-29','Carro citadino lindo','pronto',3,3,2300),(11,'Renault','Clio','diesel',29.99,'32-to-73','Citadino pequeno e prático','pronto',3,1,3300),(12,'Volvo','V40','hibrido',60.99,'ae-23-iu','Volvo hibrido económico','pronto',2,1,5000);
/*!40000 ALTER TABLE `motociclo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-09 13:20:42
