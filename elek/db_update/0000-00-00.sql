-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: elek_db
-- ------------------------------------------------------
-- Server version	8.0.25

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
-- Table structure for table `elek_sentence_list`
--

DROP TABLE IF EXISTS `elek_sentence_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elek_sentence_list` (
  `sentence_id` int NOT NULL AUTO_INCREMENT,
  `text_id` int DEFAULT NULL,
  `sentence_data` varchar(3000) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`sentence_id`),
  KEY `txtid_idx` (`text_id`),
  CONSTRAINT `txtid` FOREIGN KEY (`text_id`) REFERENCES `elek_text_list` (`text_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5537 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elek_sentence_list`
--

LOCK TABLES `elek_sentence_list` WRITE;
/*!40000 ALTER TABLE `elek_sentence_list` DISABLE KEYS */;
INSERT INTO `elek_sentence_list` VALUES (5527,51,'Qırım Cumhuriyeti ve Sevastopol şeeri musulmanları diniy idaresinde Qırım Müftisi hacı Emirali Ablayevniñ rehberliginde Qırım rayonları baş imamlarnıñ aylıq toplaşuvı olıp keçti.'),(5528,51,'Qırım musulmanlarınıñ diniy yetekçisi Yüce Allahqa hızmet, vatanperverlik ve öz milletine sevgi aqqında tarif etti.'),(5529,51,'Körüşüv esnasında diniy hadimler iş meselelerini ve 2023 senesine planlarnı muzakere ettiler.'),(5530,51,'Toplaşuvnıñ soñunda imamlar bölgelerinde musulmanlar arasında darqatmaq içün “Hidayet” gazetasınıñ yañı sanını ve 2023 senesi içün islâmiy taqvimlerni aldılar.'),(5531,52,'Qırım Müftisiniñ Qırım Cumhuriyeti ve Sevastopol şeeri boyunca Cezalarnı icra etüv federal hızmeti idaresi (ÜFSİN) ile işbirlik boyunca yardımcısı Muhammed İslamov Keriç şeeriniñ №1 apishanesinde bulunğan mahkümlernen körüşti.'),(5532,52,'Bundan da ğayrı, apishaneniñ binasında dinlerara iş taqımınıñ iş oturışı olıp keçti.'),(5533,52,'Taqımnıñ terkibine inanğanlar ile çalışuv boyunca idare başlığınıñ yardımcısı papaz R.'),(5534,52,'Tsurkan, Qırım prokurorınıñ tüzeltüv müessiselerinde qanunlarnıñ icra etilüviniñ nezareti boyunca yardımcısı Ya.'),(5535,52,'Filenko kirmekte.'),(5536,52,'Din hadimleri ve prokuraturanıñ vekilleri apishanedeki ibadethanelerniñ alına baqtılar ve mahküm etilgenlerniñ suallerine cevaplar berdiler, soñra da kelecek senege iş planlarını belgilediler.');
/*!40000 ALTER TABLE `elek_sentence_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elek_sentence_member_list`
--

DROP TABLE IF EXISTS `elek_sentence_member_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elek_sentence_member_list` (
  `member_id` int NOT NULL AUTO_INCREMENT,
  `sentence_id` int DEFAULT NULL,
  `word_id` int DEFAULT NULL,
  PRIMARY KEY (`member_id`),
  KEY `snt_idx` (`sentence_id`),
  KEY `wrdid_idx` (`word_id`),
  CONSTRAINT `snt` FOREIGN KEY (`sentence_id`) REFERENCES `elek_sentence_list` (`sentence_id`) ON DELETE CASCADE,
  CONSTRAINT `wrdid` FOREIGN KEY (`word_id`) REFERENCES `elek_word_list` (`word_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60228 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elek_sentence_member_list`
--

LOCK TABLES `elek_sentence_member_list` WRITE;
/*!40000 ALTER TABLE `elek_sentence_member_list` DISABLE KEYS */;
INSERT INTO `elek_sentence_member_list` VALUES (60076,5527,16672),(60077,5527,16673),(60078,5527,16674),(60079,5527,16675),(60080,5527,16676),(60081,5527,16677),(60082,5527,16678),(60083,5527,16679),(60084,5527,16672),(60085,5527,16680),(60086,5527,16681),(60087,5527,16682),(60088,5527,16683),(60089,5527,16684),(60090,5527,16672),(60091,5527,16685),(60092,5527,16686),(60093,5527,16687),(60094,5527,16688),(60095,5527,16689),(60096,5527,16690),(60097,5527,16691),(60098,5528,16672),(60099,5528,16692),(60100,5528,16678),(60101,5528,16693),(60102,5528,16694),(60103,5528,16695),(60104,5528,16696),(60105,5528,16697),(60106,5528,16674),(60107,5528,16698),(60108,5528,16699),(60109,5528,16700),(60110,5528,16701),(60111,5528,16702),(60112,5528,16703),(60113,5529,16704),(60114,5529,16705),(60115,5529,16678),(60116,5529,16706),(60117,5529,16707),(60118,5529,16708),(60119,5529,16674),(60120,5529,16709),(60121,5529,16710),(60122,5529,16711),(60123,5529,16712),(60124,5530,16713),(60125,5530,16714),(60126,5530,16715),(60127,5530,16716),(60128,5530,16717),(60129,5530,16718),(60130,5530,16719),(60131,5530,16720),(60132,5530,16721),(60133,5530,16722),(60134,5530,16723),(60135,5530,16724),(60136,5530,16674),(60137,5530,16725),(60138,5530,16720),(60139,5530,16726),(60140,5530,16727),(60141,5530,16728),(60142,5531,16672),(60143,5531,16729),(60144,5531,16672),(60145,5531,16673),(60146,5531,16674),(60147,5531,16675),(60148,5531,16676),(60149,5531,16730),(60150,5531,16731),(60151,5531,16732),(60152,5531,16733),(60153,5531,16734),(60154,5531,16735),(60155,5531,16736),(60156,5531,16737),(60157,5531,16738),(60158,5531,16739),(60159,5531,16730),(60160,5531,16740),(60161,5531,16741),(60162,5531,16742),(60163,5531,16743),(60164,5531,16744),(60165,5531,16745),(60166,5531,16746),(60167,5531,16747),(60168,5531,16748),(60169,5532,16749),(60170,5532,16750),(60171,5532,16751),(60172,5532,16752),(60173,5532,16753),(60174,5532,16754),(60175,5532,16707),(60176,5532,16755),(60177,5532,16707),(60178,5532,16756),(60179,5532,16690),(60180,5532,16691),(60181,5533,16757),(60182,5533,16758),(60183,5533,16759),(60184,5533,16738),(60185,5533,16760),(60186,5533,16730),(60187,5533,16761),(60188,5533,16762),(60189,5533,16740),(60190,5533,16763),(60191,5533,16764),(60192,5534,16765),(60193,5534,16672),(60194,5534,16766),(60195,5534,16767),(60196,5534,16768),(60197,5534,16769),(60198,5534,16732),(60199,5534,16770),(60200,5534,16771),(60201,5534,16730),(60202,5534,16740),(60203,5534,16772),(60204,5535,16773),(60205,5535,16774),(60206,5536,16775),(60207,5536,16776),(60208,5536,16674),(60209,5536,16777),(60210,5536,16778),(60211,5536,16779),(60212,5536,16780),(60213,5536,16781),(60214,5536,16782),(60215,5536,16674),(60216,5536,16783),(60217,5536,16784),(60218,5536,16785),(60219,5536,16786),(60220,5536,16787),(60221,5536,16788),(60222,5536,16750),(60223,5536,16789),(60224,5536,16790),(60225,5536,16707),(60226,5536,16791),(60227,5536,16792);
/*!40000 ALTER TABLE `elek_sentence_member_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elek_signature_list`
--

DROP TABLE IF EXISTS `elek_signature_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elek_signature_list` (
  `signature_id` int NOT NULL AUTO_INCREMENT,
  `word_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_group_title` varchar(45) DEFAULT NULL,
  `sign_date` datetime DEFAULT NULL,
  PRIMARY KEY (`signature_id`),
  UNIQUE KEY `unqsign` (`word_id`,`user_id`),
  KEY `wid_idx` (`word_id`),
  CONSTRAINT `wid` FOREIGN KEY (`word_id`) REFERENCES `elek_word_list` (`word_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elek_signature_list`
--

LOCK TABLES `elek_signature_list` WRITE;
/*!40000 ALTER TABLE `elek_signature_list` DISABLE KEYS */;
INSERT INTO `elek_signature_list` VALUES (45,16779,527,'baycik','manager','2023-01-26 11:11:38');
/*!40000 ALTER TABLE `elek_signature_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elek_text_list`
--

DROP TABLE IF EXISTS `elek_text_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elek_text_list` (
  `text_id` int NOT NULL AUTO_INCREMENT,
  `text_author` varchar(45) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `text_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `text_data` mediumtext CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `text_date` datetime DEFAULT NULL,
  `text_file_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `text_sentence_count` int DEFAULT NULL,
  `text_word_total_count` int DEFAULT NULL,
  `text_word_unique_count` int DEFAULT NULL,
  `text_letter_count` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`text_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elek_text_list`
--

LOCK TABLES `elek_text_list` WRITE;
/*!40000 ALTER TABLE `elek_text_list` DISABLE KEYS */;
INSERT INTO `elek_text_list` VALUES (51,NULL,NULL,'Qırım Cumhuriyeti ve Sevastopol şeeri musulmanları diniy idaresinde Qırım Müftisi hacı Emirali Ablayevniñ rehberliginde Qırım rayonları baş imamlarnıñ aylıq toplaşuvı olıp keçti. Qırım musulmanlarınıñ diniy yetekçisi Yüce Allahqa hızmet, vatanperverlik ve öz milletine sevgi aqqında tarif etti.\r\n\r\nKörüşüv esnasında diniy hadimler iş meselelerini ve 2023 senesine planlarnı muzakere ettiler.\r\n\r\nToplaşuvnıñ soñunda imamlar bölgelerinde musulmanlar arasında darqatmaq içün “Hidayet” gazetasınıñ yañı sanını ve 2023 senesi içün islâmiy taqvimlerni aldılar.',NULL,'./src/8285a5b2bd32d0a46087791289fb231918bfb208.txt',4,66,57,554,'2023-01-26 11:11:10'),(52,NULL,NULL,'Qırım Müftisiniñ Qırım Cumhuriyeti ve Sevastopol şeeri boyunca Cezalarnı icra etüv federal hızmeti idaresi (ÜFSİN) ile işbirlik boyunca yardımcısı Muhammed İslamov Keriç şeeriniñ №1 apishanesinde bulunğan mahkümlernen körüşti. Bundan da ğayrı, apishaneniñ binasında dinlerara iş taqımınıñ iş oturışı olıp keçti. Taqımnıñ terkibine inanğanlar ile çalışuv boyunca idare başlığınıñ yardımcısı papaz R. Tsurkan, Qırım prokurorınıñ tüzeltüv müessiselerinde qanunlarnıñ icra etilüviniñ nezareti boyunca yardımcısı Ya. Filenko kirmekte.\r\n\r\nDin hadimleri ve prokuraturanıñ vekilleri apishanedeki ibadethanelerniñ alına baqtılar ve mahküm etilgenlerniñ suallerine cevaplar berdiler, soñra da kelecek senege iş planlarını belgilediler.',NULL,'./src/574bbb829305c55fd6d43595218c4a51bfaba266.txt',10,152,121,725,'2023-01-26 11:11:13');
/*!40000 ALTER TABLE `elek_text_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elek_word_list`
--

DROP TABLE IF EXISTS `elek_word_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elek_word_list` (
  `word_id` int NOT NULL AUTO_INCREMENT,
  `word_data` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `word_count` int DEFAULT NULL,
  `word_rank` int DEFAULT NULL,
  `word_status` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `word_lemma` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `word_parent_value` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `word_form` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `lugat_word_id` int DEFAULT NULL,
  `lugat_wordform_id` int DEFAULT NULL,
  `lugat_is_submited` tinyint DEFAULT NULL,
  PRIMARY KEY (`word_id`),
  UNIQUE KEY `wrd_unq` (`word_data`)
) ENGINE=InnoDB AUTO_INCREMENT=16793 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elek_word_list`
--

LOCK TABLES `elek_word_list` WRITE;
/*!40000 ALTER TABLE `elek_word_list` DISABLE KEYS */;
INSERT INTO `elek_word_list` VALUES (16672,'qırım',7,1,NULL,NULL,NULL,NULL,15948,3024809,NULL),(16673,'cumhuriyeti',2,7,NULL,NULL,NULL,NULL,5031,749746,NULL),(16674,'ve',7,2,NULL,NULL,NULL,NULL,21347,6455930,NULL),(16675,'sevastopol',2,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16676,'şeeri',2,9,NULL,NULL,NULL,NULL,25130,763484,NULL),(16677,'musulmanları',1,16,NULL,NULL,NULL,NULL,12315,1884677,NULL),(16678,'diniy',3,5,NULL,NULL,NULL,NULL,5707,313438,NULL),(16679,'idaresinde',1,17,NULL,NULL,NULL,NULL,8274,2900659,NULL),(16680,'müftisi',1,18,NULL,NULL,NULL,NULL,12422,757691,NULL),(16681,'hacı',1,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16682,'emirali',1,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16683,'ablayevniñ',1,21,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16684,'rehberliginde',1,22,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16685,'rayonları',1,23,NULL,NULL,NULL,NULL,16327,1886837,NULL),(16686,'baş',1,24,NULL,NULL,NULL,NULL,3256,312741,NULL),(16687,'imamlarnıñ',1,25,NULL,NULL,NULL,NULL,8511,478441,NULL),(16688,'aylıq',1,26,NULL,NULL,NULL,NULL,2192,312628,NULL),(16689,'toplaşuvı',1,27,NULL,NULL,NULL,NULL,20082,766878,NULL),(16690,'olıp',2,10,NULL,NULL,NULL,NULL,13229,366219,NULL),(16691,'keçti',2,11,NULL,NULL,NULL,NULL,9807,5313136,NULL),(16692,'musulmanlarınıñ',1,28,NULL,NULL,NULL,NULL,12315,1478529,NULL),(16693,'yetekçisi',1,29,NULL,NULL,NULL,NULL,22373,769133,NULL),(16694,'yüce',1,30,NULL,NULL,NULL,NULL,22700,317118,NULL),(16695,'allahqa',1,31,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16696,'hızmet',1,32,NULL,NULL,NULL,NULL,8218,313941,NULL),(16697,'vatanperverlik',1,33,NULL,NULL,NULL,NULL,21321,768161,NULL),(16698,'öz',1,34,NULL,NULL,NULL,NULL,24384,315208,NULL),(16699,'milletine',1,35,NULL,NULL,NULL,NULL,11970,2289914,NULL),(16700,'sevgi',1,36,NULL,NULL,NULL,NULL,17477,763837,NULL),(16701,'aqqında',1,37,NULL,NULL,NULL,NULL,1360,6451116,NULL),(16702,'tarif',1,38,NULL,NULL,NULL,NULL,18932,765591,NULL),(16703,'etti',1,39,NULL,NULL,NULL,NULL,6844,5311690,NULL),(16704,'körüşüv',1,40,NULL,NULL,NULL,NULL,10515,755593,NULL),(16705,'esnasında',1,41,NULL,NULL,NULL,NULL,6807,2899763,NULL),(16706,'hadimler',1,42,NULL,NULL,NULL,NULL,7818,545344,NULL),(16707,'iş',4,3,NULL,NULL,NULL,NULL,9135,314118,NULL),(16708,'meselelerini',1,43,NULL,NULL,NULL,NULL,11801,944576,NULL),(16709,'senesine',1,44,NULL,NULL,NULL,NULL,17333,2293077,NULL),(16710,'planlarnı',1,45,NULL,NULL,NULL,NULL,14147,391747,NULL),(16711,'muzakere',1,46,NULL,NULL,NULL,NULL,12359,314959,NULL),(16712,'ettiler',1,47,NULL,NULL,NULL,NULL,6844,5255420,NULL),(16713,'toplaşuvnıñ',1,48,NULL,NULL,NULL,NULL,20082,683080,NULL),(16714,'soñunda',1,49,NULL,NULL,NULL,NULL,17846,2906241,NULL),(16715,'imamlar',1,50,NULL,NULL,NULL,NULL,8511,545762,NULL),(16716,'bölgelerinde',1,51,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16717,'musulmanlar',1,52,NULL,NULL,NULL,NULL,12316,103428,NULL),(16718,'arasında',1,53,NULL,NULL,NULL,NULL,1466,2896949,NULL),(16719,'darqatmaq',1,54,NULL,NULL,NULL,NULL,5280,6452192,NULL),(16720,'içün',2,12,NULL,NULL,NULL,NULL,9127,6453069,NULL),(16721,'hidayet',1,55,NULL,NULL,NULL,NULL,8064,752962,NULL),(16722,'gazetasınıñ',1,56,NULL,NULL,NULL,NULL,7518,2659238,NULL),(16723,'yañı',1,57,NULL,NULL,NULL,NULL,22066,316938,NULL),(16724,'sanını',1,58,NULL,NULL,NULL,NULL,16799,2108948,NULL),(16725,'senesi',1,59,NULL,NULL,NULL,NULL,17333,763687,NULL),(16726,'islâmiy',1,60,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16727,'taqvimlerni',1,61,NULL,NULL,NULL,NULL,18885,394629,NULL),(16728,'aldılar',1,62,NULL,NULL,NULL,NULL,966,5251961,NULL),(16729,'müftisiniñ',1,63,NULL,NULL,NULL,NULL,12422,2661905,NULL),(16730,'boyunca',4,4,NULL,NULL,NULL,NULL,4171,6451886,NULL),(16731,'cezalarnı',1,64,NULL,NULL,NULL,NULL,4918,386372,NULL),(16732,'icra',2,13,NULL,NULL,NULL,NULL,8256,313986,NULL),(16733,'etüv',1,65,'alternative',NULL,NULL,NULL,NULL,NULL,NULL),(16734,'federal',1,66,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16735,'hızmeti',1,67,NULL,NULL,NULL,NULL,8217,753017,NULL),(16736,'idaresi',1,68,NULL,NULL,NULL,NULL,8274,753263,NULL),(16737,'üfsin',1,69,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16738,'ile',2,14,NULL,NULL,NULL,NULL,8467,6281154,NULL),(16739,'işbirlik',1,70,NULL,NULL,NULL,NULL,9174,753876,NULL),(16740,'yardımcısı',3,6,NULL,NULL,NULL,NULL,21830,768761,NULL),(16741,'muhammed',1,71,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16742,'islamov',1,72,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16743,'keriç',1,73,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16744,'şeeriniñ',1,74,NULL,NULL,NULL,NULL,25130,2664780,NULL),(16745,'apishanesinde',1,75,NULL,NULL,NULL,NULL,1258,2896858,NULL),(16746,'bulunğan',1,76,NULL,NULL,NULL,NULL,4340,313013,NULL),(16747,'mahkümlernen',1,77,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16748,'körüşti',1,78,NULL,NULL,NULL,NULL,10514,5313691,NULL),(16749,'bundan',1,79,NULL,NULL,NULL,NULL,4255,3136571,NULL),(16750,'da',2,15,NULL,NULL,NULL,NULL,5135,6452133,NULL),(16751,'ğayrı',1,80,NULL,NULL,NULL,NULL,24814,3137007,NULL),(16752,'apishaneniñ',1,81,NULL,NULL,NULL,NULL,1259,240562,NULL),(16753,'binasında',1,82,NULL,NULL,NULL,NULL,3688,2897899,NULL),(16754,'dinlerara',1,83,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16755,'taqımınıñ',1,84,NULL,NULL,NULL,NULL,18889,2665780,NULL),(16756,'oturışı',1,85,NULL,NULL,NULL,NULL,13537,759082,NULL),(16757,'taqımnıñ',1,86,NULL,NULL,NULL,NULL,18889,682387,NULL),(16758,'terkibine',1,87,NULL,NULL,NULL,NULL,19610,2294374,NULL),(16759,'inanğanlar',1,88,NULL,NULL,NULL,NULL,8568,3242457,NULL),(16760,'çalışuv',1,89,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16761,'idare',1,90,NULL,NULL,NULL,NULL,8274,753262,NULL),(16762,'başlığınıñ',1,91,NULL,NULL,NULL,NULL,3288,2656718,NULL),(16763,'papaz',1,92,NULL,NULL,NULL,NULL,13730,759310,NULL),(16764,'r',1,93,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16765,'tsurkan',1,94,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16766,'prokurorınıñ',1,95,'new',NULL,'',NULL,NULL,NULL,NULL),(16767,'tüzeltüv',1,96,NULL,NULL,NULL,NULL,20635,767446,NULL),(16768,'müessiselerinde',1,97,NULL,NULL,NULL,NULL,12416,1701639,NULL),(16769,'qanunlarnıñ',1,98,NULL,NULL,NULL,NULL,14672,66555,NULL),(16770,'etilüviniñ',1,99,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16771,'nezareti',1,100,NULL,NULL,NULL,NULL,12959,758319,NULL),(16772,'ya',1,101,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16773,'filenko',1,102,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16774,'kirmekte',1,103,NULL,NULL,NULL,NULL,9983,6281968,NULL),(16775,'din',1,104,NULL,NULL,NULL,NULL,5697,750339,NULL),(16776,'hadimleri',1,105,NULL,NULL,NULL,NULL,7819,545346,NULL),(16777,'prokuraturanıñ',1,106,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16778,'vekilleri',1,107,NULL,NULL,NULL,NULL,21365,553280,NULL),(16779,'apishanedeki',1,108,'new','Apis','','isimfiil',NULL,NULL,1),(16780,'ibadethanelerniñ',1,109,NULL,NULL,NULL,NULL,8236,478267,NULL),(16781,'alına',1,110,NULL,NULL,NULL,NULL,842,2283882,NULL),(16782,'baqtılar',1,111,NULL,NULL,NULL,NULL,2969,5252912,NULL),(16783,'mahküm',1,112,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16784,'etilgenlerniñ',1,113,NULL,NULL,NULL,NULL,6841,3205965,NULL),(16785,'suallerine',1,114,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16786,'cevaplar',1,115,NULL,NULL,NULL,NULL,4904,543509,NULL),(16787,'berdiler',1,116,NULL,NULL,NULL,NULL,3519,5253206,NULL),(16788,'soñra',1,117,NULL,NULL,NULL,NULL,17864,6454999,NULL),(16789,'kelecek',1,118,NULL,NULL,NULL,NULL,9407,314242,NULL),(16790,'senege',1,119,NULL,NULL,NULL,NULL,17333,611841,NULL),(16791,'planlarını',1,120,NULL,NULL,NULL,NULL,14147,945945,NULL),(16792,'belgilediler',1,121,NULL,NULL,NULL,NULL,3431,5253158,NULL);
/*!40000 ALTER TABLE `elek_word_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-26 12:27:12
