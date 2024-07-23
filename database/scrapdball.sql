-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: scrapx
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_user_id` (`user_id`),
  CONSTRAINT `fk_feedback_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (105,'Abhi tech','abhi@gmail.com','9823456754','bv nbvnbvvmnbnb',NULL,NULL),(106,'Abhi tech','abhi@gmail.com','9823456754','Good Team',NULL,NULL),(107,'AP cons','ap@gmail.com','9812345678','Et minima nemo corru that comes in your mind',NULL,NULL),(110,'AP cons','ap@gmail.com','9812345678','1111good',NULL,NULL),(111,'AP cons','ap@gmail.com','9812345678','111111',NULL,NULL),(112,'AP cons','ap@gmail.com','9812345678','11good',NULL,NULL),(114,'Nitu','nitu7@gmail.com','9867452313','good boy',NULL,NULL),(115,'Nitu','nitu7@gmail.com','9867452313','goof d',NULL,NULL),(116,'Nitu','nitu7@gmail.com','9867452313','gooood',NULL,NULL),(117,'Abhi Tech','abhi@gmail.com','9812345672','doooo',NULL,NULL),(118,'Ktm Funpark','ktmfunpark@gmail.com','9811110000','good team',NULL,NULL),(119,'Ktm Funpark','ktmfunpark@gmail.com','9811110000','Excellent experience 123',NULL,NULL),(121,'Ankit Karki','ankit@gmail.com','9817978423','good product',NULL,NULL),(122,'asha khadka','asha1@gmail.com','9840872119','your service is nice',NULL,NULL),(123,'rr','rr@gmail.com','9876564534','ghoo team',NULL,NULL),(124,'Ankit Karki','ankit@gmail.com','9817978423','good team',NULL,NULL),(125,'Aasha khadka','ashakhadka185@gmail.com','9808618766','Hey bro Nice Team Work',NULL,NULL),(126,'Krishi Thok','Krishithok@gmail.com','9823514356','Very Good Team',NULL,NULL),(127,'Aasha khadka','ashakhadka185@gmail.com','9808618766','Hey you got good team.',NULL,NULL),(128,'example','example@gmail.com','7417411225','helllo goood\r\n',NULL,NULL),(129,'Dipshika Niraula','dip@gmail.com','9860120933','Good Job bhai. Keep it up',NULL,NULL),(130,'Dipshika Niraula','dip@gmail.com','9860120933','NIce system',NULL,NULL),(131,'Vincent Larsen','bin@gmail.com','8847581009','System is very good\r\n',NULL,NULL),(132,'Vincent Larsen','bin@gmail.com','8847581009','Good job\r\n',NULL,NULL);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hero`
--

DROP TABLE IF EXISTS `hero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hero` (
  `hero_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `hero_photo` blob,
  `available` tinyint(1) DEFAULT '1',
  `password` varchar(255) NOT NULL,
  `generated_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`hero_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_number` (`phone_no`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hero`
--

LOCK TABLES `hero` WRITE;
/*!40000 ALTER TABLE `hero` DISABLE KEYS */;
INSERT INTO `hero` VALUES (1,'John Doe','johndoe@example.com','+1234567890','Thamel','Car','ABC123',NULL,1,'',NULL),(2,'ramkumar','ram@hero.uthaoo.com','9812345612','Thamel','bicycle','',_binary 'WhatsApp Image 2023-06-20 at 23.14.19.jpg',1,'$2y$10$4H.xo9nBKijOU5I5xdPnBu4rjTZUFF9YnYgr2iFOXepOS.z71Euq2',NULL),(3,'ktmcity','ktm@hero.uthaoo.com','9812345678','Durbar Square','car','305',_binary 'xxx.jpg',1,'$2y$10$rGmRzvv6BAiOjSwMEypW1OwoPQsc5GZpaaWTD2GTWOeF1dVEG85B2',NULL),(4,'anish','ani@hero.uthaoo.com','9898989898','Thamel','bicycle','',_binary '0f00935d-ba47-4931-a2b4-36a9da73cd44.jpg',1,'$2y$10$xbFOdlw4/qW01ZluP3kFFuNpTHOfGRNlcs0Op5F4ea//Sd8Q9ovk.',NULL),(5,'Mohan Singh Dhobi','moh@hero.uthaoo.com','1234567890','Boudhanath','motorbike','AB12345',_binary 'me.jpg',1,'$2y$10$icXU3S31eiZDZVH09I4aY.SAVD6nnLRRXHjnVuEwXwmrvnZpB4uDy',NULL),(7,'Ramesh Kc','','1111111111','Durbar Square','bicycle','',_binary 'm.jpg',1,'$2y$10$h3O5rJVFWFZTY9wHpjVsv.9rBnUlREVtX9LhFGbOJjKyxtQoQQX3K',NULL),(8,'Kapil Sharma','kapilsharma@gmail.com','1234123412','Boudhanath','bicycle','',_binary '1.jpg',1,'$2y$10$fvyN9Wq2x4bYlNPCwh4WW.KISZWP6jGQfvvy/r5RrkZHF2GTPi31G',NULL),(9,'Naman Oija','namanojha@gmail.com','1212345678','Durbar Square','bicycle','',_binary '2.jpg',1,'$2y$10$6eoUQN/4R0dG4gCBKbIVMegLV5L44sV67S5lEG5xjnWtxNBr8mTnq','nam9@hero.uthaoo.com'),(10,'messi','messi@gmail.com','9876543435','Boudhanath','car','CA123',_binary '1.jpg',1,'$2y$10$s/2n0gBlAEabqwsjzmxY8O8U8p.Hg4kxrudJrF9m3b5sudQWawHEu','mes10@hero.uthaoo.com'),(11,'Rajan GC','rajan@gmail.com','9867564532','Kalanki','bicycle','',_binary 'WhatsApp Image 2023-06-20 at 23.14.19.jpg',1,'$2y$10$IZrgMuU9y7szvGQBD9jmXuPxzjsTfk67sk7GNrF2GVnVNmpWMsVjm','raj11@hero.uthaoo.com'),(13,'Sam Bahadur','sambahadur@mailinator.com','9812345622','Koteswor','motorbike','608',_binary 'whatsapp myphuto.jpg',1,'$2y$10$zgY/XaFwQ4d2L3K/ZR2GduBPmHJR4xwjW1E0wCseLyU3pR3TMLmvq','sam13@hero.uthaoo.com'),(14,'Ankit Karki','ankitkarki12345@gmail.com','7025234224','Koteswor','bicycle','773',_binary '279004887_1583926805317142_1746857739344350451_n.jpg',1,'$2y$10$HuuKNT6wq93I2Jcs0eK5te6qkPdzUXE4yvnnnerNe31amv3CFmV.2','ank14@hero.uthaoo.com'),(15,'Charlotte Matthews','duqohevis@gmail.com','5067352488','Durbar Square','car','371',_binary '353431096_237861792373809_1930743101861127744_n.jpg',1,'$2y$10$W10WFXuN0KkMQ.3UmG7sduLg/D8BXoC6FkFJPgnvn182fl85W02yy','cha15@hero.uthaoo.com'),(16,'Ram Nepal','ram@gmail.com','8848445654','Anamnagar','motorbike','786',_binary 'j cole.jpg',1,'$2y$10$Lre8SEYh86FAkXoiyXfQ.OJo.q6i7AA5dapDqoJ2UpkG.aEJQPbBW','ram16@hero.uthaoo.com'),(17,'Mulang','mulang@gmail.com','7358634015','Putalisadak','motorbike','33',_binary '357103687_237862045707117_6730796466856712264_n (1).jpg',1,'$2y$10$Hgq/cXukbYIx8eXfzBw9TeCoSMT9YOQIk2JS8nqNrPm95in91ttkm','mul17@hero.uthaoo.com'),(18,'Patricia Ward','mixabahe@gmail.com','9171174343','Naxal','motorbike','314',_binary '326790235_867544774572564_3813884500267533421_n.jpg',1,'$2y$10$hXDfqgljH3oaA4pQ3jwQpuP5qJ0TwEoGj1e2pucn.83kK/2urdnfK',NULL),(19,'Quinton dickok','qu@gmail.com','9849505154','Balkumari','bicycle','130',_binary 'j cole.jpg',1,'$2y$10$WuslOq8nw2ECgJIY7pI2A.HxWMOG17tmspkBRXZXyAcRttO23Xn6G','qui19@hero.uthaoo.com'),(20,'Jane Fisher','qyxufokexy@gmail.com','8877708282','Dallu','car','750',_binary 'IMG-20230815-WA0002.jpg',1,'$2y$10$CXTH7gwa74ritOS4KD9qPuU0ZmKPSFHgYiHs5PPW/9TYilZPvpdQy','jan20@hero.uthaoo.com'),(21,'Yetta Rice','jucaqyvoli@gmail.com','3391188788','Kalanki','car','140',_binary 'IMG-20230815-WA0004.jpg',1,'$2y$10$G3hAjnBKv.Ce/nvtg8qCPO1KU7/G9pOOHWPpjVQ8mQnFrKMFnhh9a','yet21@hero.uthaoo.com'),(22,'Yoshi Hernandez','mytabela@gmail.com','6366108673','RNAC','bicycle','480',_binary '326475354_686235819658383_854653088711603618_n.jpg',1,'$2y$10$MNy6ovAy0BWSbKoa.GMUmuUo1RM2cXJGStimt5.gIfcRwD.yDRA7C','yos22@hero.uthaoo.com'),(23,'Louis Munoz','qapyluqetu@gmail.com','1843137821','Chabel','motorbike','873',_binary '350378751_248233021134260_1916474351379739988_n.jpg',1,'$2y$10$FhFr3ZJjE1Uqlz7mAqZk7eLl7HfDPsWxZrT7s7GfQYm4T4ELgyS4W','lou23@hero.uthaoo.com'),(24,'Byron Baxter','godohi@gmail.com','6252423029','Anamnagar','car','432',_binary 'IMG-20230815-WA0001.jpg',1,'$2y$10$2NDFfKv2OiNjkD7x59QWyenRG4JLUVwfNgTjMEv81xh5tmqbDpFvq','byr24@hero.uthaoo.com'),(25,'Sawyer Donovan','buniwyx@gmail.com','1583935744','Iste place','motorcycle','795',_binary '346077957_2528349710649149_7421896041562635087_n.jpg',1,'$2y$10$8RttUy8ab8.mG1an6/81Gub3n3MJRfPM4KivHpeXTZt3WjF.plPT2','saw25@hero.uthaoo.com'),(26,'raaa Murphy','bubaz@gmail.com','1571537598','Odio aut d','car','188',_binary '350378751_248233021134260_1916474351379739988_n.jpg',1,'$2y$10$FZeio69svlFfNwVqDWZAB.iVqS2auJijNj49UMIEV4SxAYrRa1Exm','raa26@hero.uthaoo.com'),(27,'Glenna Sheppard','fowaze@gmail.com','8647299451','Quibusdam','car','718',_binary 'IMG-20230815-WA0001.jpg',1,'$2y$10$BFtrSRAqkaJf4nY3BuChuOfaPFR6o5HY.0QyPvsCDX7l7MYNPEhZm','gle27@hero.uthaoo.com'),(28,'Randall Pugh','wafab@gmail.com','8646533308','Quia volup','bicycle','688',_binary '357744706_236075395885782_708667015117510518_n.jpg',1,'$2y$10$I5/xPrCNZRntKwWbzPXL.ORRI2BGwjGOsQaftG6UddavhQa6P58i2','ran28@hero.uthaoo.com'),(29,'Rylee Hardin','hizicebixe@gmail.com','7221461712','Non ut est','car','792',_binary '353431096_237861792373809_1930743101861127744_n.jpg',1,'$2y$10$R1V6hnygAYhG6dZ42VHv0.coQjSKPpvwyu9WG89kAhIX54e3Hz.8q','ryl29@hero.uthaoo.com'),(30,'Buffy Battle','rogyhub@gmail.com','2178626353','Suscipit a','bicycle','',_binary '278129047_661957274879035_1251546782749179520_n.jpg',1,'$2y$10$jkTCUg2eLCKBSSBbFJWltOwpXRuMckB6OaFQy4EumRBdkqHZh.DLu','buf30@hero.uthaoo.com'),(31,'Breanna Bailey','cugidopu@gmail.com','1254651695','Quia rerum','bicycle','',_binary '348376387_1304784470440729_2135168577023009502_n.jpg',1,'$2y$10$qHrekC1vLEzFdSshAMQS2uLDPn3YjQErodONPud21JDtHKryBCtuK','bre31@hero.uthaoo.com'),(32,'Hayden Wallace','zaxytanef@gmail.com','3011259515','Expedita q','car','823',_binary '357744706_236075395885782_708667015117510518_n.jpg',1,'$2y$10$Jl7G9vWsSdpH4/Sz6NZ63.cqmiNZXbrdJidWHucmJaMP3HUMy1I66','hay32@hero.uthaoo.com'),(33,'Honorato Carey','wogaboh@gmail.com','1548249979','Quis odio','bicycle','',_binary '278129047_661957274879035_1251546782749179520_n.jpg',1,'$2y$10$Cqhfek0U73iVScODLdNi8eVRfeqv3wkVLxC4JYi9rXEXogpzSJo3e','hon33@hero.uthaoo.com'),(37,'Mukesh','mukesh@gmail.com','1342523368','Kathmandu','car','691',_binary '5.jpg',1,'$2y$10$v1YSgubkZ5xvRf6.PF6Si.UJYq9WWPrKzpBdBa69CXwVfvzdg6yCG','muk37@hero.uthaoo.com'),(38,'For Test','test@gmail.com','9158551787','Bhaktapur','car','19-9990999999',_binary '356440155_1883076052068881_8464140941865667660_n.jpg',1,'$2y$10$ZLDrhLJbhDoeqXBptmkmAuIXWeJFcbvCZNZidTnaa.4U1if4r79mu','for38@hero.uthaoo.com');
/*!40000 ALTER TABLE `hero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricing`
--

DROP TABLE IF EXISTS `pricing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pricing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `scrapname` varchar(255) NOT NULL,
  `scraprate` varchar(255) NOT NULL,
  `scrapcategory` varchar(255) NOT NULL,
  `scrap_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pricing_scrap_id` (`scrap_id`),
  CONSTRAINT `fk_pricing_scrap_id` FOREIGN KEY (`scrap_id`) REFERENCES `scrap` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricing`
--

LOCK TABLES `pricing` WRITE;
/*!40000 ALTER TABLE `pricing` DISABLE KEYS */;
INSERT INTO `pricing` VALUES (6,'Polythene Bags (Small)','15','Plastic',NULL),(8,'Hard plastic','30','Plastic',NULL),(9,'Soft plastic','10','Paper',NULL),(10,'Nepali Paper','45','Paper',NULL),(12,'Wrappers','16','Plastic',NULL),(14,'Plastic Furniture','25','Plastic',NULL),(15,'Polythene Bags(Big)','20','Plastic',NULL),(24,'pen','14','Plastic',NULL),(25,'Plastic Roll(large)','55','Plastic',NULL),(27,'Bottless','25','Plastic',NULL),(28,'Hero','16.00','Mixed',NULL),(29,'Trash bag','20','Plastic',NULL),(30,'Plastic Can','25','Plastic',NULL),(31,'can','39','Plastic',NULL),(32,'Bottle','133','Plastic',NULL),(34,'plastic raincoat','1200','Plastic',NULL),(36,'good','12','Plastic',NULL),(37,'plastic pen','15','Plastic',NULL),(38,'Cartoon','25','Paper',NULL),(39,'paper bag','57','Paper',NULL),(40,'pen','12','Plastic',NULL),(41,'pen wrapper','12','Plastic',NULL),(42,'new plastic banner','50','Plastic',NULL),(46,'Plastic rope','100','Plastic',NULL),(47,'Mixed Scrap','25','Mixed',NULL),(48,'Mixed Plastic ','25','Mixed',NULL),(51,'Soft plastic','5','Plastic',NULL),(52,'plastic chair','200','Plastic',NULL);
/*!40000 ALTER TABLE `pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scrap`
--

DROP TABLE IF EXISTS `scrap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scrap` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `scrapname` varchar(255) NOT NULL,
  `des` text,
  `scraprate` varchar(255) NOT NULL,
  `scrapquantity` varchar(255) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `user_id` int DEFAULT NULL,
  `messages` text,
  `request_type` varchar(255) NOT NULL,
  `scheduled_date` date DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_scrap_user_id` (`user_id`),
  CONSTRAINT `fk_scrap_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scrap`
--

LOCK TABLES `scrap` WRITE;
/*!40000 ALTER TABLE `scrap` DISABLE KEYS */;
INSERT INTO `scrap` VALUES (153,'khalisisi','khalisisi@gmail.com','9878787878','Impedit quia dolore','new plastic banner',NULL,'50','858','mixed1.jpg','2024-03-26 06:36:17','Pending',NULL,NULL,'sell','2024-04-19','Lalitpur'),(154,'Aasha khadka','ashakhadka185@gmail.com','9808618766','Aut vitae vitae qui ','Mixed Scrap',NULL,'25','997','plastic.jpg','2024-03-26 07:37:07','Pending',NULL,NULL,'donate','2012-06-16','Lalitpur'),(155,'Test','test@gmail.com','1234512345','bhaktapur','Wrappers',NULL,'16','241','8.png','2024-04-05 16:31:14','Accepted',NULL,NULL,'sell','2024-04-13','Kathmandu'),(156,'khalisisi','khalisisi@gmail.com','9878787878','Lokanthali,Hotel Manohora','Mixed Scrap',NULL,'25','20','scrapcollect.jpg','2024-04-17 00:39:55','Pending',NULL,NULL,'sell','2024-04-19','Bhaktapur'),(157,'Ankit Karki','ankit@gmail.com','9817978423','Et esse eum et non d','Hero',NULL,'16.00','207','0f00935d-ba47-4931-a2b4-36a9da73cd44.jpg','2024-05-09 03:08:34','Pending',NULL,NULL,'donate','2007-07-10','Bhaktapur'),(158,'Ankit Karki','ankit@gmail.com','9817978423','Quia quasi dicta dol','Hero',NULL,'16.00','336','','2024-05-09 03:08:40','Pending',NULL,NULL,'sell_and_donate','1983-09-09','Lalitpur'),(159,'Ankit Karki','ankit@gmail.com','9817978423','Praesentium vitae su','Trash bag',NULL,'20','','','2024-05-09 03:08:53','Pending',NULL,NULL,'sell_and_donate','2024-04-04','Bhaktapur'),(160,'Ankit Karki','ankit@gmail.com','9817978423','Praesentium vitae su','Trash bag',NULL,'20','','','2024-05-09 03:08:57','Pending',NULL,NULL,'sell_and_donate','2024-04-04','Bhaktapur'),(161,'Ankit Karki','ankit@gmail.com','9817978423','','Soft plastic',NULL,'10','0','','2024-05-09 03:09:11','Pending',NULL,NULL,'donate','2021-12-17','Bhaktapur'),(162,'example','example@gmail.com','7417411225','Koteshwor','Mixed Scrap',NULL,'25','122','357744706_236075395885782_708667015117510518_n.jpg','2024-05-20 16:28:42','Accepted',NULL,NULL,'sell','2024-05-24','Kathmandu'),(165,'Dipshika Niraula','dip@gmail.com','9860120933','Lokanthalo','Plastic Furniture',NULL,'25','784','3.jpg','2024-05-30 22:51:56','Pending',NULL,NULL,'sell','2024-08-07','Bhaktapur'),(167,'Ankit Karki','ankitkarki@gmail.com','9812345678','Lokanthali, Manohara Hotel','pen',NULL,'14','699','440403169_410214025271116_6938621541012459805_n.jpg','2024-06-09 10:53:36','Pending',NULL,NULL,'sell_and_donate','2024-07-15','Bhaktapur'),(168,'Nepal Law Campus','nlc@gmail.com','5818506892','Kathmandu, Pradarshani Marg','Bottless',NULL,'25','40','0f00935d-ba47-4931-a2b4-36a9da73cd44.jpg','2024-06-12 04:04:49','Pending',NULL,NULL,'sell','2024-12-05','Kathmandu');
/*!40000 ALTER TABLE `scrap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` enum('admin','donor','receiver') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'12345','admin@example.com',NULL,NULL,NULL,NULL,'admin','2024-05-18 08:02:15'),(2,'12345','adminhere@example.com',NULL,NULL,NULL,NULL,'admin','2024-05-18 08:02:24'),(3,'K@thm@ndu','admin@gmail.com','1234567890','Admin','1980-01-01','123 Admin St','admin','2024-05-20 20:22:02');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_tbl`
--

DROP TABLE IF EXISTS `user_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_tbl`
--

LOCK TABLES `user_tbl` WRITE;
/*!40000 ALTER TABLE `user_tbl` DISABLE KEYS */;
INSERT INTO `user_tbl` VALUES (44,'Krishi Bari','krishibari@gmail.com','$2y$10$SgIK3GAGBxk6v5/U739vVeV06VoFHxt3zmM.ss6emjRzamGlIgqra','9820192011','user'),(45,'FunPark KTM','funpark@gmail.com','$2y$10$4.R.E0iC2sVLFq1r5.OBHuabHxYO4UswQnX7VEqPqbxCJYXh1ibTO','9816704259','user'),(46,'John Doe','johndoe@example.com','$2y$10$hgSGJ87UVjeOUkUVIsWEMOHzgvPCbszZbDGOzwYA9aXf1IXarJh0u','1234567890','user'),(47,'Abhi Sekh','abhisekh@gmail.com','$2y$10$UfvJJyynzloDQ3M2L1IJJuI0iD8elUsC7.OLnqJK1oIp/UicrDmzG','9834251676','user'),(48,'Admin here','admin@example.com','$2y$10$uMw4rij4Z/pNQ8YXaK4D4u7C5fRgUuQyTE9fFK8x1R.EtaLhTebg.','9834567890','admin'),(49,'RR College','rrlc@gmail.com','$2y$10$4luHI7B58hmAaFqcNURX8Od.4k534eRf5LwzRfoSxzI6nCDTZ3jM6','9812344322','user'),(50,'Nepal Law College','nlc@gmal.com','$2y$10$HGZ9A85iiuow40hFSxg0xe7vNFGx.zF3vDQr8GYkt8RNNqn8yNXn6','9812345678','user'),(51,'Ankit Karki','ankit@gmail.com','$2y$10$nSRQIbzXs/PiKcHlBf9Kc.WVbUHUoq9W6Ay1e6KJyad.IbHd26C26','9817978423','user'),(52,'Aasha khadka','ashakhadka185@gmail.com','$2y$10$IfmmI0NwwrQNxwm78O2Syeu8R2H2KtYdzECQvzPU86TAdC8p96Z7u','9808618766','user'),(53,'kushi shah','kushi12@gmail.com','$2y$10$LEd2o94k4AHtMFWwE3U0k.jGnELJBk6sDmW4AFnw5Hu5cJjH3akyS','9876543212','user'),(54,'asha khadka','asha12@gmail.com','$2y$10$X3AE6rKk9BkvkUcP5UyzUupfoWiv2DJgPjA.Ayg54g9YLCjjJ4rlW','9876543212','user'),(55,'asha khadka','asha1@gmail.com','$2y$10$byMv.EcKd4S5t5RGULxgjeTnG0DvrR3rb1Ti6dPEHYePcw6Xh0FVa','9840872119','user'),(56,'ram thapa','ram1@gmail.com','$2y$10$JgJ8qmKmr3HQVa7SIrhnCe8YXvo8VJx2o5tRlpkfJwPZ5asuDWJ0e','9876543234','user'),(57,'Ktm City','ktm@gmail.com','$2y$10$JLKPI.vNscZJasTLMEzCUu.iBGjRR1BPBBXZm/e9mITazlmaJM52i','9867676767','user'),(58,'Laith Larson','qazu@mailinator.com','$2y$10$a07eBjPvU7.JGijjCeUh3O4HBWajA/H5IwDHyCu1ZZG6B5vrs5.YW','9812345678','user'),(59,'Hanna Rojas','xigukabu@mailinator.com','$2y$10$L76uYLLFksU72M8SPmRj4.hxdF5X3A8PY0SXlQEGlq7ZtdbqSqY9.','9812345678','user'),(60,'Tanya Schmidt','femohiw@mailinator.com','$2y$10$xZHoBhkj4.TtaqMobWdxeegpFN6T2zkjHMEDF9fMnsLqmyNWxSU1.','1234567890','user'),(61,'Ahmed Adkins','hojutexady@mailinator.com','$2y$10$EzxT6w3C4fAJreNiDQQh7eZuQW7swsbNZfALAE/Bjprev23mchEDi','1234567890','user'),(62,'ankit','ak@gmail.com','$2y$10$1iHPPaN1YYItHKkYeQ80hubK.bedcEcYKS5hB39CHKqQxvclO/fnS','9812345678','user'),(63,'hari thapa','hari@gmail.com','$2y$10$BwyS4ZU3B5lIZCAmYk/ZLue8yXxQj/8YRoNoyffhzbogbCPGQABDq','9876767656','user'),(64,'mm','mm@gmail.com','$2y$10$c1zE0Deg1NEy/SPU6keHq.cIr98MbKwB4ZbGyJn4N71LuOjXCf7du','9876565456','user'),(65,'rr','rr@gmail.com','$2y$10$XavNEyXB8DuqeaWgyw8zZ.oiHX.i3sjeoVAyfk8OwZFAMw0w5laAO','9876564534','user'),(66,'Dipen','Dipen@gmail.com','$2y$10$DeQ0EYV4qT92R2BqSa8uNuR2C9OHAXzF03RYbmS.OKvvs3QSbF1Su','9817878448','user'),(67,'Krishi Thok','Krishithok@gmail.com','$2y$10$xwYmdp4D0kq06qCk4lt9PewspFqar0wEtBT9JaVQLFXkwEfYhgt5O','9823514356','user'),(68,'Hell King','hell@gmail.com','$2y$10$9osC3lYwkUJjDUKCWvnIqeKvMZR1XSHOHKAfaMC5VaE7Zcm9nG05W','9812345678','user'),(69,'khalisisi','khalisisi@gmail.com','$2y$10$NA17dku.ajJYFpDGVGdXWOwO9kIZT8WvMgnnySKJxQh1gn.0nx70O','9878787878','user'),(70,'Anish','anish@gmail.com','$2y$10$bWB38/aLFe76JFlObTyJdeU.eMZq/iMrAAR5Eb0/aXg/Ucq.7ukOK','9876565656','user'),(71,'Test','test@gmail.com','$2y$10$gpGaH8T3sB6hjUuSBPns3.ubFwJYkqoTLK/StKAOPz3AvRowCVDsy','1234512345','user'),(72,'example','example@gmail.com','$2y$10$W//NAxZpG0j/sp5zBuY/Y.LC0yF4QDV6R8YXa18qdDXjWfXj0zT/q','7417411225','user'),(73,'Dipshika Niraula','dip@gmail.com','$2y$10$PjeHBOBsF/Gh/l.pzDWeDe/tJM19h.vsg1oQX03glj5dfN4E8eL32','9812345678','user'),(74,'Vincent Larsen','bin@gmail.com','$2y$10$5dpBoRWn3KpYUcFoGTj3iu5FWckXpqWL19L5dp47xLMtKGmgoS7UG','8847581009','user'),(75,'Ankit Karki','ankitkarki@gmail.com','$2y$10$jMqpCMZrvylev9XZt.UAhOh1xrYvd9MUqFcTB1CiMdsuf6DwISsam','9812345678','user'),(76,'Ankit Here','ankithere@gmail.com','$2y$10$Aqwl0Xuv.9UceNhDgO/SVu3OLMOChBonJNxplcuXHdKPuAmt9YfBe','7445499035','user'),(77,'NLC','nlc@gmail.com','$2y$10$5aXXNp548IIH7lo3SQgHiu2g4Nnjw5P.z0ccIqc/SApsoVYsasGTW','5818506892','user');
/*!40000 ALTER TABLE `user_tbl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-12 13:41:35

use scrapx

CREATE TABLE IF NOT EXISTS `collectedscrap` (
    collectedscrap_id INT AUTO_INCREMENT PRIMARY KEY,
    scrap_id INT NOT NULL,
    collected_by VARCHAR(255) NOT NULL,
    collected_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    weight DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (scrap_id) REFERENCES scrap(id)
);

show tables