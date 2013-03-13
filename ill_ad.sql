-- MySQL dump 10.13  Distrib 5.5.10, for osx10.6 (i386)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.5.10-log

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
-- Table structure for table `illumina_adaptor`
--

DROP TABLE IF EXISTS `illumina_adaptor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `illumina_adaptor` (
  `illumina_adaptor_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `illumina_adaptor` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`illumina_adaptor_id`),
  UNIQUE KEY `illumina_adaptor` (`illumina_adaptor`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `illumina_adaptor`
--

LOCK TABLES `illumina_adaptor` WRITE;
/*!40000 ALTER TABLE `illumina_adaptor` DISABLE KEYS */;
INSERT INTO `illumina_adaptor` VALUES (1,'A01'),(2,'A02'),(3,'A03'),(4,'A04'),(5,'A05'),(6,'A06'),(7,'A07'),(8,'A08'),(9,'A09'),(10,'A10'),(11,'A11'),(12,'A12'),(13,'B01'),(14,'B02'),(15,'B03'),(16,'B04'),(17,'B05'),(18,'B06'),(19,'B07'),(20,'B08'),(21,'B09'),(22,'B10'),(23,'B11'),(24,'B12'),(25,'C01'),(26,'C02'),(27,'C03'),(28,'C04'),(29,'C05'),(30,'C06'),(31,'C07'),(32,'C08'),(33,'C09'),(34,'C10'),(35,'C11'),(36,'C12'),(37,'D01'),(38,'D02'),(39,'D03'),(40,'D04'),(41,'D05'),(42,'D06'),(43,'D07'),(44,'D08'),(45,'D09'),(46,'D10'),(47,'D11'),(48,'D12'),(49,'E01'),(50,'E02'),(51,'E03'),(52,'E04'),(53,'E05'),(54,'E06'),(55,'E07'),(56,'E08'),(57,'E09'),(58,'E10'),(59,'E11'),(60,'E12'),(61,'F01'),(62,'F02'),(63,'F03'),(64,'F04'),(65,'F05'),(66,'F06'),(67,'F07'),(68,'F08'),(69,'F09'),(70,'F10'),(71,'F11'),(72,'F12'),(73,'G01'),(74,'G02'),(75,'G03'),(76,'G04'),(77,'G05'),(78,'G06'),(79,'G07'),(80,'G08'),(81,'G09'),(82,'G10'),(83,'G11'),(84,'G12'),(85,'H01'),(86,'H02'),(87,'H03'),(88,'H04'),(89,'H05'),(90,'H06'),(91,'H07'),(92,'H08'),(93,'H09'),(94,'H10'),(95,'H11'),(96,'H12');
/*!40000 ALTER TABLE `illumina_adaptor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `illumina_adaptor_ref`
--

DROP TABLE IF EXISTS `illumina_adaptor_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `illumina_adaptor_ref` (
  `illumina_adaptor_id` tinyint(3) unsigned NOT NULL,
  `illumina_index_id` tinyint(3) unsigned NOT NULL,
  `illumina_run_key_id` tinyint(3) unsigned NOT NULL,
  `dna_region_id` tinyint(3) unsigned NOT NULL,
  `domain` enum('bacteria','archaea','eukarya') DEFAULT NULL,
  UNIQUE KEY `adaptor_combination` (`illumina_adaptor_id`,`dna_region_id`,`domain`),
  KEY `illumina_index_id` (`illumina_index_id`),
  KEY `illumina_run_key_id` (`illumina_run_key_id`),
  KEY `dna_region_id` (`dna_region_id`),
  CONSTRAINT `illumina_adaptor_ref_ibfk_1` FOREIGN KEY (`illumina_adaptor_id`) REFERENCES `illumina_adaptor` (`illumina_adaptor_id`),
  CONSTRAINT `illumina_adaptor_ref_ibfk_2` FOREIGN KEY (`illumina_index_id`) REFERENCES `illumina_index` (`illumina_index_id`),
  CONSTRAINT `illumina_adaptor_ref_ibfk_3` FOREIGN KEY (`illumina_run_key_id`) REFERENCES `illumina_run_key` (`illumina_run_key_id`),
  CONSTRAINT `illumina_adaptor_ref_ibfk_4` FOREIGN KEY (`dna_region_id`) REFERENCES `dna_region` (`dna_region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `illumina_adaptor_ref`
--

LOCK TABLES `illumina_adaptor_ref` WRITE;
/*!40000 ALTER TABLE `illumina_adaptor_ref` DISABLE KEYS */;
INSERT INTO `illumina_adaptor_ref` VALUES (1,16,1,15,'archaea'),(13,16,2,15,'archaea'),(25,16,3,15,'archaea'),(37,16,4,15,'archaea'),(49,16,5,15,'archaea'),(61,16,6,15,'archaea'),(73,16,7,15,'archaea'),(85,16,8,15,'archaea'),(2,17,1,15,'archaea'),(14,17,2,15,'archaea'),(26,17,3,15,'archaea'),(38,17,4,15,'archaea'),(50,17,5,15,'archaea'),(62,17,6,15,'archaea'),(74,17,7,15,'archaea'),(86,17,8,15,'archaea'),(3,18,1,15,'archaea'),(15,18,2,15,'archaea'),(27,18,3,15,'archaea'),(39,18,4,15,'archaea'),(51,18,5,15,'archaea'),(63,18,6,15,'archaea'),(75,18,7,15,'archaea'),(87,18,8,15,'archaea'),(4,19,1,15,'archaea'),(16,19,2,15,'archaea'),(28,19,3,15,'archaea'),(40,19,4,15,'archaea'),(52,19,5,15,'archaea'),(64,19,6,15,'archaea'),(76,19,7,15,'archaea'),(88,19,8,15,'archaea'),(5,20,1,15,'archaea'),(17,20,2,15,'archaea'),(29,20,3,15,'archaea'),(41,20,4,15,'archaea'),(53,20,5,15,'archaea'),(65,20,6,15,'archaea'),(77,20,7,15,'archaea'),(89,20,8,15,'archaea'),(6,21,1,15,'archaea'),(18,21,2,15,'archaea'),(30,21,3,15,'archaea'),(42,21,4,15,'archaea'),(54,21,5,15,'archaea'),(66,21,6,15,'archaea'),(78,21,7,15,'archaea'),(90,21,8,15,'archaea'),(7,22,1,15,'archaea'),(19,22,2,15,'archaea'),(31,22,3,15,'archaea'),(43,22,4,15,'archaea'),(55,22,5,15,'archaea'),(67,22,6,15,'archaea'),(79,22,7,15,'archaea'),(91,22,8,15,'archaea'),(8,23,1,15,'archaea'),(20,23,2,15,'archaea'),(32,23,3,15,'archaea'),(44,23,4,15,'archaea'),(56,23,5,15,'archaea'),(68,23,6,15,'archaea'),(80,23,7,15,'archaea'),(92,23,8,15,'archaea'),(9,24,1,15,'archaea'),(21,24,2,15,'archaea'),(33,24,3,15,'archaea'),(45,24,4,15,'archaea'),(57,24,5,15,'archaea'),(69,24,6,15,'archaea'),(81,24,7,15,'archaea'),(93,24,8,15,'archaea'),(10,25,1,15,'archaea'),(22,25,2,15,'archaea'),(34,25,3,15,'archaea'),(46,25,4,15,'archaea'),(58,25,5,15,'archaea'),(70,25,6,15,'archaea'),(82,25,7,15,'archaea'),(94,25,8,15,'archaea'),(11,26,1,15,'archaea'),(23,26,2,15,'archaea'),(35,26,3,15,'archaea'),(47,26,4,15,'archaea'),(59,26,5,15,'archaea'),(71,26,6,15,'archaea'),(83,26,7,15,'archaea'),(95,26,8,15,'archaea'),(12,27,1,15,'archaea'),(24,27,2,15,'archaea'),(36,27,3,15,'archaea'),(48,27,4,15,'archaea'),(60,27,5,15,'archaea'),(72,27,6,15,'archaea'),(84,27,7,15,'archaea'),(96,27,8,15,'archaea'),(1,1,33,19,'archaea'),(13,1,34,19,'archaea'),(25,1,35,19,'archaea'),(37,1,36,19,'archaea'),(49,1,37,19,'archaea'),(61,1,38,19,'archaea'),(73,1,39,19,'archaea'),(85,1,40,19,'archaea'),(2,2,33,19,'archaea'),(14,2,34,19,'archaea'),(26,2,35,19,'archaea'),(38,2,36,19,'archaea'),(50,2,37,19,'archaea'),(62,2,38,19,'archaea'),(74,2,39,19,'archaea'),(86,2,40,19,'archaea'),(3,3,33,19,'archaea'),(15,3,34,19,'archaea'),(27,3,35,19,'archaea'),(39,3,36,19,'archaea'),(51,3,37,19,'archaea'),(63,3,38,19,'archaea'),(75,3,39,19,'archaea'),(87,3,40,19,'archaea'),(4,4,33,19,'archaea'),(16,4,34,19,'archaea'),(28,4,35,19,'archaea'),(40,4,36,19,'archaea'),(52,4,37,19,'archaea'),(64,4,38,19,'archaea'),(76,4,39,19,'archaea'),(88,4,40,19,'archaea'),(5,5,33,19,'archaea'),(17,5,34,19,'archaea'),(29,5,35,19,'archaea'),(41,5,36,19,'archaea'),(53,5,37,19,'archaea'),(65,5,38,19,'archaea'),(77,5,39,19,'archaea'),(89,5,40,19,'archaea'),(6,6,33,19,'archaea'),(18,6,34,19,'archaea'),(30,6,35,19,'archaea'),(42,6,36,19,'archaea'),(54,6,37,19,'archaea'),(66,6,38,19,'archaea'),(78,6,39,19,'archaea'),(90,6,40,19,'archaea'),(7,7,33,19,'archaea'),(19,7,34,19,'archaea'),(31,7,35,19,'archaea'),(43,7,36,19,'archaea'),(55,7,37,19,'archaea'),(67,7,38,19,'archaea'),(79,7,39,19,'archaea'),(91,7,40,19,'archaea'),(8,8,33,19,'archaea'),(20,8,34,19,'archaea'),(32,8,35,19,'archaea'),(44,8,36,19,'archaea'),(56,8,37,19,'archaea'),(68,8,38,19,'archaea'),(80,8,39,19,'archaea'),(92,8,40,19,'archaea'),(9,9,33,19,'archaea'),(21,9,34,19,'archaea'),(33,9,35,19,'archaea'),(45,9,36,19,'archaea'),(57,9,37,19,'archaea'),(69,9,38,19,'archaea'),(81,9,39,19,'archaea'),(93,9,40,19,'archaea'),(10,10,33,19,'archaea'),(22,10,34,19,'archaea'),(34,10,35,19,'archaea'),(46,10,36,19,'archaea'),(58,10,37,19,'archaea'),(70,10,38,19,'archaea'),(82,10,39,19,'archaea'),(94,10,40,19,'archaea'),(11,11,33,19,'archaea'),(23,11,34,19,'archaea'),(35,11,35,19,'archaea'),(47,11,36,19,'archaea'),(59,11,37,19,'archaea'),(71,11,38,19,'archaea'),(83,11,39,19,'archaea'),(95,11,40,19,'archaea'),(12,12,33,19,'archaea'),(24,12,34,19,'archaea'),(36,12,35,19,'archaea'),(48,12,36,19,'archaea'),(60,12,37,19,'archaea'),(72,12,38,19,'archaea'),(84,12,39,19,'archaea'),(96,12,40,19,'archaea'),(1,31,17,15,'bacteria'),(13,31,18,15,'bacteria'),(25,31,19,15,'bacteria'),(37,31,20,15,'bacteria'),(49,31,21,15,'bacteria'),(61,31,22,15,'bacteria'),(73,31,23,15,'bacteria'),(85,31,24,15,'bacteria'),(2,32,17,15,'bacteria'),(14,32,18,15,'bacteria'),(26,32,19,15,'bacteria'),(38,32,20,15,'bacteria'),(50,32,21,15,'bacteria'),(62,32,22,15,'bacteria'),(74,32,23,15,'bacteria'),(86,32,24,15,'bacteria'),(3,33,17,15,'bacteria'),(15,33,18,15,'bacteria'),(27,33,19,15,'bacteria'),(39,33,20,15,'bacteria'),(51,33,21,15,'bacteria'),(63,33,22,15,'bacteria'),(75,33,23,15,'bacteria'),(87,33,24,15,'bacteria'),(4,34,17,15,'bacteria'),(16,34,18,15,'bacteria'),(28,34,19,15,'bacteria'),(40,34,20,15,'bacteria'),(52,34,21,15,'bacteria'),(64,34,22,15,'bacteria'),(76,34,23,15,'bacteria'),(88,34,24,15,'bacteria'),(5,35,17,15,'bacteria'),(17,35,18,15,'bacteria'),(29,35,19,15,'bacteria'),(41,35,20,15,'bacteria'),(53,35,21,15,'bacteria'),(65,35,22,15,'bacteria'),(77,35,23,15,'bacteria'),(89,35,24,15,'bacteria'),(6,36,17,15,'bacteria'),(18,36,18,15,'bacteria'),(30,36,19,15,'bacteria'),(42,36,20,15,'bacteria'),(54,36,21,15,'bacteria'),(66,36,22,15,'bacteria'),(78,36,23,15,'bacteria'),(90,36,24,15,'bacteria'),(7,37,17,15,'bacteria'),(19,37,18,15,'bacteria'),(31,37,19,15,'bacteria'),(43,37,20,15,'bacteria'),(55,37,21,15,'bacteria'),(67,37,22,15,'bacteria'),(79,37,23,15,'bacteria'),(91,37,24,15,'bacteria'),(8,38,17,15,'bacteria'),(20,38,18,15,'bacteria'),(32,38,19,15,'bacteria'),(44,38,20,15,'bacteria'),(56,38,21,15,'bacteria'),(68,38,22,15,'bacteria'),(80,38,23,15,'bacteria'),(92,38,24,15,'bacteria'),(9,39,17,15,'bacteria'),(21,39,18,15,'bacteria'),(33,39,19,15,'bacteria'),(45,39,20,15,'bacteria'),(57,39,21,15,'bacteria'),(69,39,22,15,'bacteria'),(81,39,23,15,'bacteria'),(93,39,24,15,'bacteria'),(10,40,17,15,'bacteria'),(22,40,18,15,'bacteria'),(34,40,19,15,'bacteria'),(46,40,20,15,'bacteria'),(58,40,21,15,'bacteria'),(70,40,22,15,'bacteria'),(82,40,23,15,'bacteria'),(94,40,24,15,'bacteria'),(11,41,17,15,'bacteria'),(23,41,18,15,'bacteria'),(35,41,19,15,'bacteria'),(47,41,20,15,'bacteria'),(59,41,21,15,'bacteria'),(71,41,22,15,'bacteria'),(83,41,23,15,'bacteria'),(95,41,24,15,'bacteria'),(12,42,17,15,'bacteria'),(24,42,18,15,'bacteria'),(36,42,19,15,'bacteria'),(48,42,20,15,'bacteria'),(60,42,21,15,'bacteria'),(72,42,22,15,'bacteria'),(84,42,23,15,'bacteria'),(96,42,24,15,'bacteria'),(1,31,48,19,'bacteria'),(13,31,47,19,'bacteria'),(25,31,46,19,'bacteria'),(37,31,41,19,'bacteria'),(49,31,45,19,'bacteria'),(61,31,44,19,'bacteria'),(73,31,43,19,'bacteria'),(85,31,42,19,'bacteria'),(2,32,48,19,'bacteria'),(14,32,47,19,'bacteria'),(26,32,46,19,'bacteria'),(38,32,41,19,'bacteria'),(50,32,45,19,'bacteria'),(62,32,44,19,'bacteria'),(74,32,43,19,'bacteria'),(86,32,42,19,'bacteria'),(3,33,48,19,'bacteria'),(15,33,47,19,'bacteria'),(27,33,46,19,'bacteria'),(39,33,41,19,'bacteria'),(51,33,45,19,'bacteria'),(63,33,44,19,'bacteria'),(75,33,43,19,'bacteria'),(87,33,42,19,'bacteria'),(4,34,48,19,'bacteria'),(16,34,47,19,'bacteria'),(28,34,46,19,'bacteria'),(40,34,41,19,'bacteria'),(52,34,45,19,'bacteria'),(64,34,44,19,'bacteria'),(76,34,43,19,'bacteria'),(88,34,42,19,'bacteria'),(5,35,48,19,'bacteria'),(17,35,47,19,'bacteria'),(29,35,46,19,'bacteria'),(41,35,41,19,'bacteria'),(53,35,45,19,'bacteria'),(65,35,44,19,'bacteria'),(77,35,43,19,'bacteria'),(89,35,42,19,'bacteria'),(6,36,48,19,'bacteria'),(18,36,47,19,'bacteria'),(30,36,46,19,'bacteria'),(42,36,41,19,'bacteria'),(54,36,45,19,'bacteria'),(66,36,44,19,'bacteria'),(78,36,43,19,'bacteria'),(90,36,42,19,'bacteria'),(7,37,48,19,'bacteria'),(19,37,47,19,'bacteria'),(31,37,46,19,'bacteria'),(43,37,41,19,'bacteria'),(55,37,45,19,'bacteria'),(67,37,44,19,'bacteria'),(79,37,43,19,'bacteria'),(91,37,42,19,'bacteria'),(8,38,48,19,'bacteria'),(20,38,47,19,'bacteria'),(32,38,46,19,'bacteria'),(44,38,41,19,'bacteria'),(56,38,45,19,'bacteria'),(68,38,44,19,'bacteria'),(80,38,43,19,'bacteria'),(92,38,42,19,'bacteria'),(9,39,48,19,'bacteria'),(21,39,47,19,'bacteria'),(33,39,46,19,'bacteria'),(45,39,41,19,'bacteria'),(57,39,45,19,'bacteria'),(69,39,44,19,'bacteria'),(81,39,43,19,'bacteria'),(93,39,42,19,'bacteria'),(10,40,48,19,'bacteria'),(22,40,47,19,'bacteria'),(34,40,46,19,'bacteria'),(46,40,41,19,'bacteria'),(58,40,45,19,'bacteria'),(70,40,44,19,'bacteria'),(82,40,43,19,'bacteria'),(94,40,42,19,'bacteria'),(11,41,48,19,'bacteria'),(23,41,47,19,'bacteria'),(35,41,46,19,'bacteria'),(47,41,41,19,'bacteria'),(59,41,45,19,'bacteria'),(71,41,44,19,'bacteria'),(83,41,43,19,'bacteria'),(95,41,42,19,'bacteria'),(12,42,48,19,'bacteria'),(24,42,47,19,'bacteria'),(36,42,46,19,'bacteria'),(48,42,41,19,'bacteria'),(60,42,45,19,'bacteria'),(72,42,44,19,'bacteria'),(84,42,43,19,'bacteria'),(96,42,42,19,'bacteria');
/*!40000 ALTER TABLE `illumina_adaptor_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `illumina_adaptor_ref_view`
--

DROP TABLE IF EXISTS `illumina_adaptor_ref_view`;
/*!50001 DROP VIEW IF EXISTS `illumina_adaptor_ref_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `illumina_adaptor_ref_view` (
  `illumina_adaptor` char(3),
  `illumina_index` char(6),
  `illumina_run_key` char(5),
  `dna_region` varchar(32),
  `domain` enum('bacteria','archaea','eukarya'),
  `illumina_adaptor_id` tinyint(3) unsigned,
  `illumina_index_id` tinyint(3) unsigned,
  `illumina_run_key_id` tinyint(3) unsigned,
  `dna_region_id` tinyint(3) unsigned
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `illumina_index`
--

DROP TABLE IF EXISTS `illumina_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `illumina_index` (
  `illumina_index_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `illumina_index` char(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`illumina_index_id`),
  UNIQUE KEY `illumina_index` (`illumina_index`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `illumina_index`
--

LOCK TABLES `illumina_index` WRITE;
/*!40000 ALTER TABLE `illumina_index` DISABLE KEYS */;
INSERT INTO `illumina_index` VALUES (35,'ACAGTG'),(38,'ACTTGA'),(22,'AGATTG'),(6,'AGGAGT'),(12,'AGGTGA'),(18,'AGTCGT'),(23,'AGTTAC'),(3,'ATAATC'),(31,'ATCACG'),(21,'CAAATT'),(25,'CAACTC'),(37,'CAGATC'),(11,'CCAAGA'),(10,'CCAAGT'),(17,'CGAGCA'),(20,'CGAGGG'),(32,'CGATGT'),(2,'CGCACA'),(7,'CGTGAC'),(4,'CTAGGC'),(42,'CTTGTA'),(39,'GATCAG'),(24,'GCATAT'),(36,'GCCAAT'),(16,'GCGATA'),(1,'GCGGTA'),(8,'GCTCGC'),(41,'GGCTAC'),(9,'GTAGAT'),(19,'GTATCT'),(5,'TACATC'),(27,'TACGAG'),(40,'TAGCTT'),(34,'TGACCA'),(33,'TTAGGC'),(26,'TTGCGT');
/*!40000 ALTER TABLE `illumina_index` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `illumina_run_key`
--

DROP TABLE IF EXISTS `illumina_run_key`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `illumina_run_key` (
  `illumina_run_key_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `illumina_run_key` char(5) NOT NULL DEFAULT '',
  PRIMARY KEY (`illumina_run_key_id`),
  UNIQUE KEY `illumina_run_key` (`illumina_run_key`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `illumina_run_key`
--

LOCK TABLES `illumina_run_key` WRITE;
/*!40000 ALTER TABLE `illumina_run_key` DISABLE KEYS */;
INSERT INTO `illumina_run_key` VALUES (41,'ACGCA'),(36,'ACTAT'),(4,'ACTCG'),(21,'ACTGC'),(40,'AGACA'),(5,'AGTGT'),(3,'ATACG'),(6,'ATAGT'),(39,'ATATA'),(38,'ATCGA'),(24,'ATGCT'),(37,'CAGTA'),(18,'CGACG'),(7,'CGAGT'),(8,'CGCGA'),(42,'CGCTC'),(19,'CTACT'),(43,'CTAGC'),(23,'GACAG'),(44,'GACTC'),(45,'GAGAC'),(46,'GCTAC'),(47,'GTATC'),(22,'GTCAC'),(17,'TACGC'),(35,'TAGCA'),(2,'TAGTG'),(34,'TCACA'),(48,'TCAGC'),(1,'TCGAG'),(20,'TGACT'),(33,'TGATA');
/*!40000 ALTER TABLE `illumina_run_key` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `illumina_adaptor_ref_view`
--

/*!50001 DROP TABLE IF EXISTS `illumina_adaptor_ref_view`*/;
/*!50001 DROP VIEW IF EXISTS `illumina_adaptor_ref_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50001 VIEW `illumina_adaptor_ref_view` AS select `illumina_adaptor`.`illumina_adaptor` AS `illumina_adaptor`,`illumina_index`.`illumina_index` AS `illumina_index`,`illumina_run_key`.`illumina_run_key` AS `illumina_run_key`,`dna_region`.`dna_region` AS `dna_region`,`illumina_adaptor_ref`.`domain` AS `domain`,`illumina_adaptor_ref`.`illumina_adaptor_id` AS `illumina_adaptor_id`,`illumina_adaptor_ref`.`illumina_index_id` AS `illumina_index_id`,`illumina_adaptor_ref`.`illumina_run_key_id` AS `illumina_run_key_id`,`illumina_adaptor_ref`.`dna_region_id` AS `dna_region_id` from ((((`illumina_adaptor_ref` join `illumina_adaptor` on((`illumina_adaptor_ref`.`illumina_adaptor_id` = `illumina_adaptor`.`illumina_adaptor_id`))) join `illumina_index` on((`illumina_adaptor_ref`.`illumina_index_id` = `illumina_index`.`illumina_index_id`))) join `illumina_run_key` on((`illumina_adaptor_ref`.`illumina_run_key_id` = `illumina_run_key`.`illumina_run_key_id`))) join `dna_region` on((`illumina_adaptor_ref`.`dna_region_id` = `dna_region`.`dna_region_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-13 13:24:01
