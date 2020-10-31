-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: iot_database
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1-log

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
-- Table structure for table `buffer_sokhambenh`
--

DROP TABLE IF EXISTS `buffer_sokhambenh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buffer_sokhambenh` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(255) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `chuan_doan` text CHARACTER SET utf8,
  `nhip_tim` int(255) DEFAULT NULL,
  `oxy` int(255) DEFAULT NULL,
  `huyet_ap` int(255) DEFAULT NULL,
  `nhiet_do` int(255) DEFAULT NULL,
  `chieu_cao` int(255) DEFAULT NULL,
  `can_nang` int(255) DEFAULT NULL,
  `tuoi` int(255) DEFAULT NULL,
  `gioi_tinh` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `don_thuoc` longtext CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buffer_sokhambenh`
--

LOCK TABLES `buffer_sokhambenh` WRITE;
/*!40000 ALTER TABLE `buffer_sokhambenh` DISABLE KEYS */;
INSERT INTO `buffer_sokhambenh` VALUES (1,1,'2020-10-13','string',999,999,999,999,999,999,999,'sex','{\"state\":\"provide\",\"type\":\"request\",\"value\":\"sensor\",\"data\":{\"Heartbeat\":111,\"oxygen\":222,\"bloodpressure\":333,\"bodytemperature\":444}}');
/*!40000 ALTER TABLE `buffer_sokhambenh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_device` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'offline',
  `nhip_tim` int(255) DEFAULT NULL,
  `oxy` int(255) DEFAULT NULL,
  `huyet_ap` int(255) DEFAULT NULL,
  `nhiet_do` int(255) DEFAULT NULL,
  `gioi_tinh` varchar(255) DEFAULT NULL,
  `nam_tuoi` int(11) DEFAULT NULL,
  `chieu_cao` int(11) DEFAULT NULL,
  `can_nang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (13,'device0001','offline',11,22,33,444,'male',29,180,70),(14,'device0002','offline',12,13,13,15,NULL,NULL,NULL,NULL),(15,'device0003','offline',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'device0004','offline',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infobacsy`
--

DROP TABLE IF EXISTS `infobacsy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infobacsy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infobacsy`
--

LOCK TABLES `infobacsy` WRITE;
/*!40000 ALTER TABLE `infobacsy` DISABLE KEYS */;
/*!40000 ALTER TABLE `infobacsy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sokhambenh`
--

DROP TABLE IF EXISTS `sokhambenh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sokhambenh` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(255) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `chuan_doan` text CHARACTER SET utf8 NOT NULL,
  `nhip_tim` int(255) NOT NULL,
  `oxy` int(255) NOT NULL,
  `huyet_ap` int(255) NOT NULL,
  `nhiet_do` int(255) NOT NULL,
  `chieu_cao` int(255) NOT NULL,
  `can_nang` int(255) NOT NULL,
  `tuoi` int(255) NOT NULL,
  `gioi_tinh` char(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `don_thuoc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`),
  KEY `sokhambenh_user_id_foreign` (`user_id`),
  CONSTRAINT `sokhambenh_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sokhambenh`
--

LOCK TABLES `sokhambenh` WRITE;
/*!40000 ALTER TABLE `sokhambenh` DISABLE KEYS */;
INSERT INTO `sokhambenh` VALUES (1,7,'2020-08-01','bệnh đau đầu ',112,3132,412,23,43,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(2,7,'2020-08-02','bệnh đâu chân',32,23,13,12,123,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(3,7,'2020-08-03','Sốt mọc răng',54,123,444,123,111,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(4,7,'2020-08-04','khám lại lần 3',23,123,444,123,111,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(5,7,'2020-08-05','bệnh đau đầu ',51,123,444,123,111,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(6,7,'2020-08-06','Sốt cảm lạnh',66,123,444,123,111,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(7,7,'2020-08-07','khám lại lần 2',99,123,444,123,111,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(8,7,'2020-08-08','Sốt do vi khuẩn',94,123,444,123,111,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(9,7,'2020-08-09','bệnh tiểu đường tuýt 2',3,123,123,123,123,123,123,'nu','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(10,7,'2020-08-10','bệnh tiểu đường tuýt 3',55,123,123,123,123,123,123,'nu','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(11,7,'2020-08-01','bệnh đau đầu ',112,3132,412,23,43,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(12,8,'2020-08-01','bệnh đau đầu ',112,3132,412,23,43,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),(13,5,'2020-08-01','bệnh đau đầu ',112,3132,412,23,43,23,23,'nam','{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}');
/*!40000 ALTER TABLE `sokhambenh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'offline',
  `id_device` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id_userhw` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_enable` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'offline',NULL,'us01hw01','chungnt','0123456789','$2y$10$6v7bzYLNVGUf6f0NgfY/7.gNo8pTw481WvKvOuc1QDUAmca8uxh2m','toanchungk57m.uet@gmail.com','admin','2020-08-21 09:36:13','2020-08-21 09:36:13','{\"id\": \"1\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),(2,'offline',NULL,'us02hw02','bác sỹ khoa tim','399474475','$2y$10$dpXIY0FBRFOzRJkO1EQ9kOH/eOm.WTj21y0/7Vf.twaUjAp7CWKT6','test1@gmail.com','doctor','2020-09-15 06:04:38','2020-08-21 09:36:13','{\"id\": \"2\", \"list\": [\"us10hw10\"]}'),(4,'online',NULL,'us04hw04','doctor2','917250330','$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai','test1@gmail.com','doctor','2020-08-22 09:46:49','2020-08-22 09:46:49','{\"id\": \"4\", \"list\": [\"us03hw03\", \"us08hw08\", \"us07hw07\", \"us01hw01\"]}'),(5,'offline',NULL,'us05hw05','doctor3','877250330','$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai','test2@gmail.com','doctor','2020-08-22 09:46:49','2020-08-22 09:46:49','{\"id\": \"5\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),(7,'offline','device0001','us07hw07','pham van thanh','866250330','$2y$10$RfDn86nOVga/P8nMLY.tBectle83ySJHyibfHxmmyYr4WHdh4vR5i','test4@gmail.com','user','2020-09-09 02:27:48','2020-08-22 09:46:49','{\"id\": \"7\", \"list\": [\"us04hw04\", \"us05hw05\", \"us06hw06\", \"us02hw02\"]}'),(8,'offline',NULL,'us08hw08','user2','931250330','$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai','test5@gmail.com','user','2020-08-22 09:46:49','2020-08-22 09:46:49','{\"id\": \"8\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),(17,'offline',NULL,'us17hw17','doctor6','817041996','$2y$10$pfVWy/SFbBwEXLvAgnJpH.bdD.At9S2Cnyvil5SxU4kznvPkMChX.','doctor6@gmail.com','doctor','2020-09-07 02:41:11','2020-09-07 02:41:11','{\"id\": \"14\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),(46,'offline','device0002','us306hw306','Nguyen Chung','0943953697','$2y$10$js3i7mFnMQJ0hGilGoNuYOUe82HrRccU3nAZiWrWew.600sOEoPuS','learnembedded.org@gmail.com','user','2020-10-06 11:55:46','2020-10-06 11:55:46',NULL),(57,'offline','device0001','us408hw408','Hiếu Phạm','0000000000','$2y$10$c4PP7rVNygeSsOYlXVp/veNN4Ki1HMcU06zukSxj.XNL6oMPLDWkK','phamhieu078@gmail.com','user','2020-10-20 11:09:48','2020-10-20 11:09:48',NULL);
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

-- Dump completed on 2020-10-26 18:43:05
