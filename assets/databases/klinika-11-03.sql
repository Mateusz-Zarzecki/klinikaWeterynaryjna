-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: klinika
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `klinika`
--

/*!40000 DROP DATABASE IF EXISTS `klinika`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `klinika` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `klinika`;

--
-- Table structure for table `diety`
--

DROP TABLE IF EXISTS `diety`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diety` (
  `IdDiety` int(11) NOT NULL AUTO_INCREMENT,
  `NazwaDiety` varchar(100) NOT NULL,
  `OpisDiety` varchar(500) DEFAULT NULL,
  `IdGatunku` int(11) NOT NULL,
  PRIMARY KEY (`IdDiety`),
  KEY `fk_Diety_Gatunki` (`IdGatunku`),
  CONSTRAINT `fk_Diety_Gatunki` FOREIGN KEY (`IdGatunku`) REFERENCES `gatunki` (`IdGatunku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diety`
--

LOCK TABLES `diety` WRITE;
/*!40000 ALTER TABLE `diety` DISABLE KEYS */;
/*!40000 ALTER TABLE `diety` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gatunki`
--

DROP TABLE IF EXISTS `gatunki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gatunki` (
  `IdGatunku` int(11) NOT NULL AUTO_INCREMENT,
  `NazwaGatunku` varchar(100) NOT NULL,
  `SredniaWaga` decimal(10,2) NOT NULL,
  `SredniCzasZycia` decimal(10,2) NOT NULL,
  `ZwierzeStadne` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`IdGatunku`),
  UNIQUE KEY `NazwaGatunku` (`NazwaGatunku`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gatunki`
--

LOCK TABLES `gatunki` WRITE;
/*!40000 ALTER TABLE `gatunki` DISABLE KEYS */;
INSERT INTO `gatunki` VALUES (1,'3.00',12.00,12.00,0);
/*!40000 ALTER TABLE `gatunki` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leczenia`
--

DROP TABLE IF EXISTS `leczenia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leczenia` (
  `IdLeczenia` int(11) NOT NULL AUTO_INCREMENT,
  `IdZwierzecia` int(11) DEFAULT NULL,
  `DataRozpoczecia` datetime DEFAULT NULL,
  `DataZakonczenia` datetime DEFAULT NULL,
  `Opis` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`IdLeczenia`),
  KEY `IdZwierzecia` (`IdZwierzecia`),
  CONSTRAINT `leczenia_ibfk_1` FOREIGN KEY (`IdZwierzecia`) REFERENCES `zwierzeta` (`IdZwierzecia`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leczenia`
--

LOCK TABLES `leczenia` WRITE;
/*!40000 ALTER TABLE `leczenia` DISABLE KEYS */;
INSERT INTO `leczenia` VALUES (1,1,'2021-01-15 00:00:00',NULL,'Leczenie po amputacji ogona'),(2,NULL,'2021-02-20 00:00:00',NULL,'Leczenie infekcji dróg oddechowych'),(3,3,'2021-03-05 00:00:00','2023-04-01 00:00:00','Leczenie dermatologiczne'),(4,4,'2021-04-10 00:00:00',NULL,'Leczenie stomatologiczne'),(5,5,'2021-05-15 00:00:00','2023-05-01 00:00:00','Leczenie ortopedyczne'),(6,6,'2021-06-20 00:00:00',NULL,'Kontynuacja leczenia dermatologicznego'),(7,7,'2021-07-25 00:00:00',NULL,'Leczenie stomatologiczne'),(8,10,'2021-10-05 00:00:00','2023-06-01 00:00:00','Szczepienie oraz odrobaczanie'),(9,11,'2021-11-12 00:00:00',NULL,'Operacja oka'),(10,13,'2022-01-20 00:00:00','2023-07-01 00:00:00','Kontrola stomatologiczna'),(11,16,'2023-06-05 00:00:00',NULL,'Leczenie neurologiczne'),(12,17,'2023-07-10 00:00:00',NULL,'Leczenie dermatologiczne'),(13,18,'2023-08-15 00:00:00','2023-09-01 00:00:00','Kontrola po zabiegu'),(14,14,'2022-02-15 00:00:00',NULL,'Szczepienie'),(15,15,'2022-03-10 00:00:00','2023-05-15 00:00:00','Leczenie zapalenia ucha'),(16,6,'2022-09-12 00:00:00',NULL,'Kontynuacja leczenia dermatologicznego'),(17,9,'2021-09-10 00:00:00',NULL,'Leczenie kardiologiczne'),(18,3,'2022-06-15 00:00:00','2023-08-01 00:00:00','Leczenie dermatologiczne');
/*!40000 ALTER TABLE `leczenia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lekarze`
--

DROP TABLE IF EXISTS `lekarze`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lekarze` (
  `IdLekarza` int(11) NOT NULL AUTO_INCREMENT,
  `Imie` varchar(100) DEFAULT NULL,
  `Nazwisko` varchar(200) DEFAULT NULL,
  `Pensja` decimal(10,2) DEFAULT NULL,
  `Specjalizacja` varchar(100) DEFAULT NULL,
  `DataUrodzenia` date DEFAULT NULL,
  `NumerTelefonu` varchar(50) DEFAULT NULL,
  `AdresEmail` varchar(320) DEFAULT NULL,
  `AdresZamieszkania` varchar(200) DEFAULT NULL,
  `KodPocztowy` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`IdLekarza`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lekarze`
--

LOCK TABLES `lekarze` WRITE;
/*!40000 ALTER TABLE `lekarze` DISABLE KEYS */;
INSERT INTO `lekarze` VALUES (1,'Krzysztof','Nowak',1999.00,'Chirurgia','1975-05-15','700123456','krzysztof.nowak@gmail.com','ul. Medyczna 1, Warszawa','00-001'),(2,'Marek','Lewandowski',5200.00,'Kardiologia','1980-06-20','701234567','marek.lewandowski@interia.pl','ul. Zdrowa 2, Kraków','30-002'),(3,'Ewa','Kowalska',3800.00,'Dermatologia','1985-07-25','702345678','ewa.kowalska@poczta.fm','ul. Szpitalna 3, Gdańsk','80-003'),(4,'Paweł','Dudek',5100.00,'Ortopedia','1978-08-30','703456789','pawel.dudek@gmail.com','ul. Lekarska 4, Wrocław','50-004'),(5,'Anna','Kaczmarek',1999.00,'Okulistyka','1982-09-05','704567890','anna.kaczmarek@interia.pl','ul. Zdrowotna 5, Poznań','60-005'),(6,'Tomasz','Piotrowski',5300.00,'Neurologia','1977-10-10','705678901','tomasz.piotrowski@poczta.fm','ul. Pacjentów 6, Łódź','90-006'),(7,'Agata','Zielińska',4700.00,'Onkologia','1983-11-15','706789012','agata.zielinska@gmail.com','ul. Kliniczna 7, Lublin','20-007'),(8,'Jan','Szymański',5500.00,'Chirurgia','1979-12-20','707890123','jan.szymanski@interia.pl','ul. Medyczna 8, Katowice','40-008'),(9,'Matylda','Woźniak',4850.00,'Kardiologia','1981-01-25','708901234','monika.wozniak@poczta.fm','ul. Zdrowa 9, Szczecin','70-009'),(10,'Piotr','Kwiatkowski',5150.00,'Ortopedia','1984-02-28','709012345','piotr.kwiatkowski@gmail.com','ul. Szpitalna 10, Białystok','15-010'),(11,'Karolina','Mazur',4900.00,'Dermatologia','1986-03-15','710123456','karolina.mazur@interia.pl','ul. Lekarska 11, Gdynia','81-011'),(12,'Grzegorz','Wójcik',5250.00,'Neurologia','1976-04-20','711234567','grzegorz.wojcik@poczta.fm','ul. Zdrowotna 12, Toruń','87-012'),(13,'Katarzyna','Kamińska',5050.00,'Okulistyka','1987-05-25','712345678','katarzyna.kaminska@gmail.com','ul. Pacjentów 13, Olsztyn','10-013'),(14,'Andrzej','Lewandowski',5400.00,'Onkologia','1974-06-30','713456789','andrzej.lewandowski@interia.pl','ul. Kliniczna 14, Bielsko-Biała','43-014'),(15,'Beata','Zielińska',4750.00,'Kardiologia','1982-07-05','714567890','beata.zielinska@poczta.fm','ul. Medyczna 15, Rzeszów','35-015'),(16,'Łukasz','Kowalczyk',5200.00,'Chirurgia','1985-08-08','715678901','lukasz.kowalczyk@gmail.com','ul. Lekarska 16, Gorzów Wielkopolski','66-016'),(17,'Magdalena','Pawlak',4800.00,'Dermatologia','1983-09-09','716789012','magdalena.pawlak@interia.pl','ul. Zdrowa 17, Bydgoszcz','85-017'),(18,'Damian','Sikorski',5300.00,'Neurologia','1976-10-10','717890123','damian.sikorski@poczta.fm','ul. Szpitalna 18, Gdynia','81-018'),(19,'Ewelina','Nowakowska',4950.00,'Okulistyka','1984-11-11','718901234','ewelina.nowakowska@gmail.com','ul. Lekarska 19, Łomża','18-019'),(20,'Rafał','Dąbrowski',5100.00,'Ortopedia','1979-12-12','719012345','rafal.dabrowski@interia.pl','ul. Zdrowotna 20, Koszalin','75-020'),(21,'Matylda',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `lekarze` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leki`
--

DROP TABLE IF EXISTS `leki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leki` (
  `IdLeku` int(11) NOT NULL AUTO_INCREMENT,
  `Nazwa` varchar(200) DEFAULT NULL,
  `Cena` decimal(10,2) DEFAULT NULL,
  `Opis` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`IdLeku`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leki`
--

LOCK TABLES `leki` WRITE;
/*!40000 ALTER TABLE `leki` DISABLE KEYS */;
INSERT INTO `leki` VALUES (1,'Amoxiclav',25.00,'Antybiotyk o szerokim spektrum działania'),(2,'Metacam',35.50,'Lek przeciwbólowy i przeciwzapalny'),(3,'Advocate',50.75,'Preparat przeciw pasożytom zewnętrznym i wewnętrznym'),(4,'Furosemid',15.00,'Lek moczopędny stosowany w niewydolności serca'),(5,'Caninsulin',120.00,'Insulina dla psów i kotów'),(6,'Rimadyl',40.00,'Lek przeciwzapalny dla psów'),(7,'Baytril',30.00,'Antybiotyk stosowany w zakażeniach bakteryjnych'),(8,'Vetoryl',200.00,'Lek stosowany w chorobie Cushinga u psów'),(9,'Karsivan',60.00,'Poprawia krążenie mózgowe u starszych psów'),(10,'Otinum',18.00,'Krople do uszu o działaniu przeciwzapalnym'),(11,'Frontline',45.00,'Preparat przeciw pchłom i kleszczom'),(12,'Milbemax',35.00,'Tabletki odrobaczające dla psów i kotów'),(13,'Cerenia',70.00,'Lek przeciwwymiotny'),(14,'Feliserin',55.00,'Szczepionka przeciw białaczce kotów'),(15,'Synulox',28.00,'Antybiotyk beta-laktamowy'),(16,'Dermato',22.00,'Maść na zmiany skórne'),(17,'Cardisure',90.00,'Lek stosowany w niewydolności serca'),(18,'Prilium',80.00,'Inhibitor ACE dla psów'),(19,'Propalin',65.00,'Lek stosowany w nietrzymaniu moczu u suk'),(20,'Equoral',150.00,'Immunosupresant dla zwierząt'),(22,'Vetprofenum',10.00,'Lek przeciwbolowy i przeciwzapalny dla psow i kotow');
/*!40000 ALTER TABLE `leki` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER dodanieLekuLog
AFTER INSERT ON leki
FOR EACH ROW
BEGIN
INSERT INTO logi(opis, data_czas)
VALUES (CONCAT('Dodano lek: ',NEW.Nazwa, ' Cena: ', NEW.Cena),NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER walidacjaZmianyLeku
BEFORE UPDATE ON Leki
FOR EACH ROW
BEGIN
	IF NEW.Cena < 0 THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'cena leku ponizej 0 zl';
	END IF;
	IF NEW.Nazwa IS NULL OR NEW.Nazwa = '' THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'nazwa zawiera pusty ciag tekstowy';
	END IF;	
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER aktualizacjaLekuLog
AFTER UPDATE ON leki
FOR EACH ROW
BEGIN
INSERT INTO logi(opis, data_czas)
VALUES (CONCAT('Zaktualizowano lek: ',OLD.Nazwa, ' -> ', NEW.Nazwa, ' Cena: ', OLD.Cena, ' -> ', NEW.Cena),NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `logi`
--

DROP TABLE IF EXISTS `logi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opis` varchar(255) DEFAULT NULL,
  `data_czas` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logi`
--

LOCK TABLES `logi` WRITE;
/*!40000 ALTER TABLE `logi` DISABLE KEYS */;
INSERT INTO `logi` VALUES (1,'Dodano lek: Vetprofen Cena: 55.00','2024-11-19 11:05:11'),(2,'Zaktualizowano lek: Vetprofen -> Vetprofenum Cena: 55.00 -> 60.00','2024-11-19 11:13:15'),(3,'Usunieto recepte o ID: 16 Dla Zabiegu o ID: 20','2024-11-20 14:46:14'),(4,'Zaktualizowano lek: Vetprofenum ->  Cena: 60.00 -> 10.00','2024-12-16 22:28:42'),(5,'Zaktualizowano lek:  -> Vetprofenum Cena: 10.00 -> 10.00','2024-12-16 22:32:09'),(6,'Usunieto recepte o ID: 17 Dla Zabiegu o ID: 5','2024-12-16 22:56:20');
/*!40000 ALTER TABLE `logi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privileges` (
  `PrivilegeId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `Privilege` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PrivilegeId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `privileges_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privileges`
--

LOCK TABLES `privileges` WRITE;
/*!40000 ALTER TABLE `privileges` DISABLE KEYS */;
INSERT INTO `privileges` VALUES (1,1,'select'),(2,2,'all'),(7,14,'all');
/*!40000 ALTER TABLE `privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `szczegolywizytyrecepty`
--

DROP TABLE IF EXISTS `szczegolywizytyrecepty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `szczegolywizytyrecepty` (
  `IdRecepty` int(11) NOT NULL,
  `IdLeku` int(11) NOT NULL,
  `Ilosc` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdRecepty`,`IdLeku`),
  KEY `IdLeku` (`IdLeku`),
  CONSTRAINT `szczegolywizytyrecepty_ibfk_1` FOREIGN KEY (`IdRecepty`) REFERENCES `wizytyrecepty` (`IdRecepty`),
  CONSTRAINT `szczegolywizytyrecepty_ibfk_2` FOREIGN KEY (`IdLeku`) REFERENCES `leki` (`IdLeku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `szczegolywizytyrecepty`
--

LOCK TABLES `szczegolywizytyrecepty` WRITE;
/*!40000 ALTER TABLE `szczegolywizytyrecepty` DISABLE KEYS */;
INSERT INTO `szczegolywizytyrecepty` VALUES (1,1,10),(1,3,1),(2,7,5),(3,16,1),(4,4,20),(4,17,10),(5,15,10),(6,10,2),(7,5,10),(8,2,15),(9,6,5),(10,3,20),(10,7,10),(11,8,15),(11,9,15),(12,10,5),(12,11,5),(13,12,10),(13,13,10),(14,14,20),(14,15,20),(15,1,10),(15,2,10),(15,3,10),(16,4,15),(16,5,15),(16,6,15),(17,7,5),(17,8,5),(17,9,5),(18,10,10),(18,11,10),(18,12,10),(19,13,20),(19,14,20),(19,15,20),(20,16,10),(20,17,10),(20,18,10),(21,1,15),(21,19,15),(21,20,15),(22,2,10),(22,3,10),(22,4,10),(22,5,10),(23,6,15),(23,7,15),(23,8,15),(23,9,15),(24,10,5),(24,11,5),(24,12,5),(24,13,5),(25,14,20),(25,15,20),(25,16,20),(25,17,20),(25,18,20),(26,1,10),(26,2,10),(26,3,10),(26,19,10),(26,20,10),(27,4,15),(27,5,15),(27,6,15),(27,7,15),(27,8,15),(28,9,5),(28,10,5),(28,11,5),(28,12,5),(28,13,5),(30,4,5);
/*!40000 ALTER TABLE `szczegolywizytyrecepty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `szczegolyzabiegirecepty`
--

DROP TABLE IF EXISTS `szczegolyzabiegirecepty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `szczegolyzabiegirecepty` (
  `IdRecepty` int(11) NOT NULL,
  `IdLeku` int(11) NOT NULL,
  `Ilosc` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdRecepty`,`IdLeku`),
  KEY `IdLeku` (`IdLeku`),
  CONSTRAINT `szczegolyzabiegirecepty_ibfk_1` FOREIGN KEY (`IdLeku`) REFERENCES `leki` (`IdLeku`),
  CONSTRAINT `szczegolyzabiegirecepty_ibfk_2` FOREIGN KEY (`IdRecepty`) REFERENCES `zabiegirecepty` (`IdRecepty`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `szczegolyzabiegirecepty`
--

LOCK TABLES `szczegolyzabiegirecepty` WRITE;
/*!40000 ALTER TABLE `szczegolyzabiegirecepty` DISABLE KEYS */;
INSERT INTO `szczegolyzabiegirecepty` VALUES (1,2,10),(1,7,5),(2,4,15),(3,17,10),(4,3,1),(5,5,10),(5,8,5),(6,2,15),(6,9,10),(7,1,5),(7,6,5),(7,11,5),(8,3,10),(8,7,10),(8,14,10),(9,8,5),(9,15,5),(9,16,5),(10,4,15),(10,12,15),(10,18,15),(10,19,15),(11,5,10),(11,10,10),(11,13,10),(11,20,10),(12,1,5),(12,6,5),(12,11,5),(12,14,5),(12,17,5),(13,2,10),(13,3,10),(13,5,10),(13,7,10),(13,9,10),(14,4,10),(14,12,5),(15,2,10),(15,9,10),(15,17,10);
/*!40000 ALTER TABLE `szczegolyzabiegirecepty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mateusz','1234'),(2,'admin','5678'),(14,'matis','9999');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `widokcount`
--

DROP TABLE IF EXISTS `widokcount`;
/*!50001 DROP VIEW IF EXISTS `widokcount`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `widokcount` AS SELECT
 1 AS `liczbaPracownikow` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `widokhaving`
--

DROP TABLE IF EXISTS `widokhaving`;
/*!50001 DROP VIEW IF EXISTS `widokhaving`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `widokhaving` AS SELECT
 1 AS `Nazwa`,
  1 AS `Cena`,
  1 AS `IloscUzycia` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `widokjoin`
--

DROP TABLE IF EXISTS `widokjoin`;
/*!50001 DROP VIEW IF EXISTS `widokjoin`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `widokjoin` AS SELECT
 1 AS `Imie`,
  1 AS `Gatunek`,
  1 AS `liczbaWizyt` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `widoklike`
--

DROP TABLE IF EXISTS `widoklike`;
/*!50001 DROP VIEW IF EXISTS `widoklike`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `widoklike` AS SELECT
 1 AS `Imie`,
  1 AS `Nazwisko`,
  1 AS `AdresEmail` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `widoksumgroupby`
--

DROP TABLE IF EXISTS `widoksumgroupby`;
/*!50001 DROP VIEW IF EXISTS `widoksumgroupby`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `widoksumgroupby` AS SELECT
 1 AS `Imie`,
  1 AS `Gatunek`,
  1 AS `laczneWydatkiNaZabiegi` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `widoktriplejoin`
--

DROP TABLE IF EXISTS `widoktriplejoin`;
/*!50001 DROP VIEW IF EXISTS `widoktriplejoin`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `widoktriplejoin` AS SELECT
 1 AS `Imie`,
  1 AS `Nazwisko`,
  1 AS `Nazwa`,
  1 AS `OpisZabiegu`,
  1 AS `StanZwierzecia` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `widoktriplewhere`
--

DROP TABLE IF EXISTS `widoktriplewhere`;
/*!50001 DROP VIEW IF EXISTS `widoktriplewhere`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `widoktriplewhere` AS SELECT
 1 AS `Imie`,
  1 AS `Nazwisko`,
  1 AS `Nazwa`,
  1 AS `OpisZabiegu`,
  1 AS `StanZwierzecia` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `widokwhere`
--

DROP TABLE IF EXISTS `widokwhere`;
/*!50001 DROP VIEW IF EXISTS `widokwhere`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `widokwhere` AS SELECT
 1 AS `ImieZwierzecia`,
  1 AS `GatunekZwierzecia`,
  1 AS `LiczbaWizyt` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `widokwhereorderby`
--

DROP TABLE IF EXISTS `widokwhereorderby`;
/*!50001 DROP VIEW IF EXISTS `widokwhereorderby`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `widokwhereorderby` AS SELECT
 1 AS `Nazwa`,
  1 AS `Cena` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `wizyty`
--

DROP TABLE IF EXISTS `wizyty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wizyty` (
  `IdWizyty` int(11) NOT NULL AUTO_INCREMENT,
  `IdZwierzecia` int(11) DEFAULT NULL,
  `DataWizyty` datetime DEFAULT NULL,
  `Nazwa` varchar(1000) DEFAULT NULL,
  `StanZwierzecia` varchar(30) DEFAULT NULL,
  `OpisWizyty` varchar(1000) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `CenaWizyty` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`IdWizyty`),
  KEY `IdZwierzecia` (`IdZwierzecia`),
  CONSTRAINT `wizyty_ibfk_1` FOREIGN KEY (`IdZwierzecia`) REFERENCES `zwierzeta` (`IdZwierzecia`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wizyty`
--

LOCK TABLES `wizyty` WRITE;
/*!40000 ALTER TABLE `wizyty` DISABLE KEYS */;
INSERT INTO `wizyty` VALUES (1,1,'2021-01-15 10:00:00','Kontrola ogólna','Bardzo dobry','Rutynowe badanie kontrolne. Zwierzę w doskonałej kondycji.','Zakończona',100.00),(2,NULL,'2021-02-20 11:30:00','Leczenie infekcji','Średni','Zwierzę wykazuje objawy infekcji dróg oddechowych. Zastosowano antybiotykoterapię.','Nieodbyta',150.00),(3,3,'2021-03-05 09:00:00','Obcięcie pazurów','Dobry','Zabieg obcięcia pazurów u chomika. Bez komplikacji.','Zakończona',50.00),(4,4,'2021-04-10 14:00:00','Szczepienie','Bardzo dobry','Szczepienie przeciwko wściekliźnie. Zwierzę zniosło zabieg bez problemów.','Zakończona',80.00),(5,5,'2021-05-15 13:00:00','Kontrola po zabiegu','Dobry','Kontrola stanu zdrowia po zabiegu usunięcia guza.','Zakończona',100.00),(6,6,'2021-06-20 12:00:00','Leczenie dermatologiczne','Średni','Zwierzę z problemami skórnymi. Zastosowano leczenie dermatologiczne.','Nieodbyta',120.00),(7,7,'2021-07-25 11:00:00','Kontrola stanu zdrowia','Bardzo dobry','Ogólne badanie świnki morskiej. Zwierzę zdrowe.','Zakończona',90.00),(8,8,'2021-08-30 15:00:00','Badanie kontrolne','Dobry','Rutynowe badanie kanarka. Bez nieprawidłowości.','Zakończona',80.00),(9,9,'2021-09-10 10:30:00','Leczenie kardiologiczne','Zły','Zwierzę z objawami niewydolności serca. Zlecono dalsze badania.','Nieodbyta',200.00),(10,10,'2021-10-05 16:00:00','Szczepienie i odrobaczanie','Dobry','Szczepienie przeciw chorobom zakaźnym oraz odrobaczanie.','Zakończona',110.00),(11,11,'2021-11-12 14:00:00','Operacja oka','Średni','Usunięcie ciała obcego z oka. Zabieg przebiegł pomyślnie.','Zakończona',300.00),(12,12,'2021-12-01 10:00:00','Leczenie złamania','Średni','Zwierzę z złamaniem przedniej łapy. Zastosowano opatrunek gipsowy.','Nieodbyta',250.00),(13,13,'2022-01-20 09:30:00','Kontrola stomatologiczna','Dobry','Badanie zębów psa. Wykonano skaling.','Zakończona',150.00),(14,14,'2022-02-15 11:00:00','Szczepienie','Bardzo dobry','Szczepienie kota przeciw chorobom zakaźnym.','Zakończona',80.00),(15,15,'2022-03-10 13:00:00','Leczenie zapalenia ucha','Średni','Zwierzę z objawami zapalenia ucha. Zastosowano leczenie farmakologiczne.','Nieodbyta',130.00),(16,1,'2022-04-10 10:00:00','Szczepienie','Bardzo dobry','Szczepienie przeciwko chorobom zakaźnym. Zwierzę w doskonałej kondycji.','Zakończona',90.00),(17,1,'2022-08-15 09:00:00','Kontrola stanu zdrowia','Dobry','Regularne badanie kontrolne. Wszystkie parametry w normie.','Zakończona',100.00),(18,1,'2023-01-20 11:30:00','Badanie stomatologiczne','Dobry','Przeprowadzono skaling zębów. Brak ubytków.','Zakończona',120.00),(19,NULL,'2022-05-05 14:00:00','Leczenie alergii','Średni','Zwierzę wykazuje objawy alergiczne. Zastosowano terapię antyhistaminową.','Nieodbyta',150.00),(20,NULL,'2022-09-10 16:00:00','Kontrola po leczeniu','Dobry','Stan zwierzęcia uległ poprawie po terapii. Kontynuacja zaleceń.','Zakończona',100.00),(21,NULL,'2023-02-28 10:30:00','Szczepienie','Bardzo dobry','Rutynowe szczepienie przypominające. Zwierzę w doskonałej formie.','Zakończona',80.00),(22,3,'2022-06-15 09:00:00','Badanie dermatologiczne','Średni','Objawy podrażnienia skóry. Zalecono specjalistyczne szampony.','Nieodbyta',110.00),(23,3,'2022-10-20 11:00:00','Kontrola po leczeniu dermatologicznym','Dobry','Poprawa stanu skóry. Zalecenia pielęgnacyjne.','Zakończona',90.00),(24,4,'2022-07-25 14:30:00','Usuwanie kamienia nazębnego','Dobry','Wykonano zabieg usunięcia kamienia. Zalecenia dotyczące higieny jamy ustnej.','Zakończona',130.00),(25,4,'2022-11-30 15:00:00','Kontrola stomatologiczna','Bardzo dobry','Stan uzębienia bardzo dobry. Brak nowych zaleceń.','Zakończona',80.00),(26,5,'2022-08-05 13:00:00','Leczenie ortopedyczne','Średni','Zwierzę z urazem stawu kolanowego. Zastosowano stabilizator.','Nieodbyta',200.00),(27,5,'2023-03-15 12:00:00','Kontrola po leczeniu ortopedycznym','Dobry','Staw goi się prawidłowo. Kontynuacja rehabilitacji.','Zakończona',100.00),(28,6,'2022-09-12 10:00:00','Szczepienie i odrobaczanie','Dobry','Wykonano szczepienie i profilaktyczne odrobaczanie.','Zakończona',110.00),(29,7,'2022-10-20 11:00:00','Leczenie stomatologiczne','Średni','Usunięcie zęba z powodu próchnicy. Zalecono miękką dietę.','Zakończona',150.00),(30,20,'2022-12-01 10:00:00','Pierwsza wizyta - badanie ogólne','Bardzo dobry','Nowe zwierzę w klinice. Wykonano pełne badanie ogólne.','Zakończona',100.00),(31,21,'2023-01-15 09:30:00','Leczenie gastroenterologiczne','Średni','Zwierzę z objawami zaburzeń trawienia. Zlecono dietę specjalistyczną.','Nieodbyta',160.00),(32,22,'2023-02-20 11:00:00','Szczepienie','Dobry','Wykonano szczepienie ochronne. Zwierzę w dobrej kondycji.','Zakończona',80.00),(33,23,'2023-03-25 14:00:00','Badanie neurologiczne','Zły','Podejrzenie zaburzeń neurologicznych. Zlecono dodatkowe badania.','Nieodbyta',220.00),(34,24,'2023-04-30 13:00:00','Leczenie stomatologiczne','Średni','Usunięcie kamienia nazębnego i leczenie dziąseł.','Zakończona',140.00),(35,25,'2023-05-10 15:30:00','Leczenie okulistyczne','Średni','Zwierzę z objawami zapalenia spojówek. Zastosowano krople do oczu.','Nieodbyta',130.00),(36,16,'2023-06-05 10:00:00','Badanie neurologiczne','Średni','Zwierzę z objawami padaczki. Zlecono badania neurologiczne.','Nieodbyta',220.00),(37,17,'2023-07-10 11:00:00','Leczenie dermatologiczne','Średni','Objawy atopowego zapalenia skóry. Zastosowano leczenie.','Nieodbyta',180.00),(38,18,'2023-08-15 09:30:00','Kontrola po zabiegu','Dobry','Kontrola stanu po usunięciu guza. Brak powikłań.','Zakończona',100.00),(39,6,'2024-12-16 00:00:00','Usuwanie zębów',NULL,NULL,'Nieodbyta',NULL),(40,3,'2025-02-10 00:00:00',NULL,NULL,NULL,'Nieodbyta',NULL);
/*!40000 ALTER TABLE `wizyty` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER ustawianieDanychWizyty
BEFORE INSERT ON Wizyty
FOR EACH ROW 
BEGIN 
	IF NEW.DataWizyty IS NULL THEN
		SET NEW.DataWizyty = CURDATE();
	END IF;
	IF NEW.Status IS NULL THEN
		SET NEW.Status = 'Nieodbyta';
	END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `wizytyleczenia`
--

DROP TABLE IF EXISTS `wizytyleczenia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wizytyleczenia` (
  `IdLeczenia` int(11) NOT NULL,
  `IdWizyty` int(11) NOT NULL,
  PRIMARY KEY (`IdLeczenia`,`IdWizyty`),
  KEY `IdWizyty` (`IdWizyty`),
  CONSTRAINT `wizytyleczenia_ibfk_1` FOREIGN KEY (`IdWizyty`) REFERENCES `wizyty` (`IdWizyty`),
  CONSTRAINT `wizytyleczenia_ibfk_2` FOREIGN KEY (`IdLeczenia`) REFERENCES `leczenia` (`IdLeczenia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wizytyleczenia`
--

LOCK TABLES `wizytyleczenia` WRITE;
/*!40000 ALTER TABLE `wizytyleczenia` DISABLE KEYS */;
INSERT INTO `wizytyleczenia` VALUES (1,1),(1,16),(1,17),(1,18),(2,2),(2,19),(2,20),(2,21),(3,3),(3,22),(3,23),(4,4),(4,24),(4,25),(5,5),(5,26),(5,27),(6,6),(6,28),(7,7),(7,29),(8,10),(9,11),(10,13),(11,36),(12,37),(13,38),(14,14),(15,15),(16,28),(17,9),(18,22),(18,23);
/*!40000 ALTER TABLE `wizytyleczenia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wizytylekarze`
--

DROP TABLE IF EXISTS `wizytylekarze`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wizytylekarze` (
  `IdWizyty` int(11) NOT NULL,
  `IdLekarza` int(11) NOT NULL,
  PRIMARY KEY (`IdWizyty`,`IdLekarza`),
  KEY `IdLekarza` (`IdLekarza`),
  CONSTRAINT `wizytylekarze_ibfk_1` FOREIGN KEY (`IdWizyty`) REFERENCES `wizyty` (`IdWizyty`),
  CONSTRAINT `wizytylekarze_ibfk_2` FOREIGN KEY (`IdLekarza`) REFERENCES `lekarze` (`IdLekarza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wizytylekarze`
--

LOCK TABLES `wizytylekarze` WRITE;
/*!40000 ALTER TABLE `wizytylekarze` DISABLE KEYS */;
INSERT INTO `wizytylekarze` VALUES (1,1),(2,2),(2,3),(3,4),(4,5),(5,1),(5,6),(6,7),(7,8),(8,9),(9,2),(9,10),(10,11),(11,5),(12,4),(13,3),(14,5),(15,7),(16,15),(17,13),(18,11),(18,17),(19,3),(19,12),(20,2),(20,13),(21,9),(21,16),(22,3),(22,17),(23,11),(23,17),(24,1),(24,8),(25,13),(25,16),(26,4),(26,10),(26,16),(27,4),(27,10),(28,9),(29,1),(29,16),(30,14),(31,7),(31,14),(32,9),(32,15),(33,6),(33,12),(33,18),(34,8),(34,16),(35,5),(35,13),(36,6),(36,18),(37,3),(37,17),(38,1);
/*!40000 ALTER TABLE `wizytylekarze` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wizytyrecepty`
--

DROP TABLE IF EXISTS `wizytyrecepty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wizytyrecepty` (
  `IdRecepty` int(11) NOT NULL AUTO_INCREMENT,
  `IdWizyty` int(11) NOT NULL,
  `DataWystawienia` datetime DEFAULT NULL,
  PRIMARY KEY (`IdRecepty`),
  KEY `IdWizyty` (`IdWizyty`),
  CONSTRAINT `wizytyrecepty_ibfk_1` FOREIGN KEY (`IdWizyty`) REFERENCES `wizyty` (`IdWizyty`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wizytyrecepty`
--

LOCK TABLES `wizytyrecepty` WRITE;
/*!40000 ALTER TABLE `wizytyrecepty` DISABLE KEYS */;
INSERT INTO `wizytyrecepty` VALUES (1,2,'2021-02-20 12:00:00'),(2,4,'2021-05-15 14:00:00'),(3,6,'2021-06-20 13:00:00'),(4,9,'2021-09-10 11:00:00'),(5,12,'2021-12-01 11:00:00'),(6,15,'2022-03-10 14:00:00'),(7,3,'2021-03-05 12:00:00'),(8,4,'2021-04-10 17:00:00'),(9,7,'2021-07-25 14:00:00'),(10,10,'2021-10-05 19:00:00'),(11,11,'2021-11-12 17:00:00'),(12,13,'2022-01-20 12:30:00'),(13,14,'2022-02-15 14:00:00'),(14,16,'2022-04-10 13:00:00'),(15,19,'2022-05-05 17:00:00'),(16,20,'2022-09-10 19:00:00'),(17,21,'2023-02-28 13:30:00'),(18,22,'2022-06-15 12:00:00'),(19,23,'2022-10-20 14:00:00'),(20,26,'2022-08-05 16:00:00'),(21,27,'2023-03-15 15:00:00'),(22,29,'2022-10-20 14:00:00'),(23,31,'2023-01-15 12:30:00'),(24,33,'2023-03-25 17:00:00'),(25,34,'2023-04-30 16:00:00'),(26,35,'2023-05-10 18:30:00'),(27,36,'2023-06-05 13:00:00'),(28,37,'2023-07-10 14:00:00'),(30,1,'2021-01-15 11:00:00');
/*!40000 ALTER TABLE `wizytyrecepty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wlasciciele`
--

DROP TABLE IF EXISTS `wlasciciele`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wlasciciele` (
  `IdWlasciciela` int(11) NOT NULL AUTO_INCREMENT,
  `Imie` varchar(100) DEFAULT NULL,
  `Nazwisko` varchar(200) DEFAULT NULL,
  `AdresEmail` varchar(320) DEFAULT NULL,
  `NumerTelefonu` varchar(30) DEFAULT NULL,
  `AdresZamieszkania` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`IdWlasciciela`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wlasciciele`
--

LOCK TABLES `wlasciciele` WRITE;
/*!40000 ALTER TABLE `wlasciciele` DISABLE KEYS */;
INSERT INTO `wlasciciele` VALUES (1,'Jan','Kowalski','jan.kowalski@gmail.com','600123456','ul. Leśna 5, Warszawa'),(2,'Anna','Nowak','anna.nowak@interia.pl','601234567','ul. Polna 12, Kraków'),(3,'Piotr','Wiśniewski','piotr.wisniewski@poczta.fm','602345678','ul. Słoneczna 8, Gdańsk'),(4,'Katarzyna','Wójcik','katarzyna.wojcik@gmail.com','603456789','ul. Kwiatowa 3, Wrocław'),(5,'Tomasz','Kamiński','tomasz.kaminski@interia.pl','604567890','ul. Długa 7, Poznań'),(6,'Agnieszka','Lewandowska','agnieszka.lewandowska@poczta.fm','605678901','ul. Krótka 9, Łódź'),(7,'Marek','Zieliński','marek.zielinski@gmail.com','606789012','ul. Spacerowa 14, Lublin'),(8,'Monika','Szymańska','monika.szymanska@interia.pl','607890123','ul. Ogrodowa 6, Katowice'),(9,'Krzysztof','Woźniak','krzysztof.wozniak@poczta.fm','608901234','ul. Jasna 2, Szczecin'),(10,'Emilia','Kozłowska','ewa.kozlowska@gmail.com','609012345','ul. Lipowa 11, Białystok'),(11,'Paweł','Jankowski','pawel.jankowski@interia.pl','610123456','ul. Brzozowa 4, Gdynia'),(12,'Barbara','Mazur','barbara.mazur@poczta.fm','611234567','ul. Wierzbowa 10, Toruń'),(13,'Andrzej','Kwiatkowski','andrzej.kwiatkowski@gmail.com','612345678','ul. Zielona 15, Olsztyn'),(14,'Maria','Krawczyk','maria.krawczyk@interia.pl','613456789','ul. Cicha 1, Bielsko-Biała'),(15,'Michał','Piotrowski','michal.piotrowski@poczta.fm','614567890','ul. Wesoła 8, Rzeszów'),(16,'Dorota','Grabowska','dorota.grabowska@gmail.com','615678901','ul. Wodna 5, Kielce'),(17,'Adam','Pawłowski','adam.pawlowski@interia.pl','616789012','ul. Miodowa 3, Opole'),(18,'Jadwiga','Nowicka','jadwiga.nowicka@poczta.fm','617890123','ul. Kamienna 7, Radom'),(19,'Łukasz','Majewski','lukasz.majewski@gmail.com','618901234','ul. Szkolna 9, Zabrze'),(20,'Natalia','Olszewska','natalia.olszewska@interia.pl','619012345','ul. Fabryczna 2, Gliwice'),(21,'Szymon','Nowicki','szymon.nowicki@poczta.fm','620123456','ul. Klonowa 18, Gorzów Wielkopolski'),(22,'Paulina','Sikora','paulina.sikora@gmail.com','621234567','ul. Kasztanowa 6, Bydgoszcz'),(23,'Damian','Wieczorek','damian.wieczorek@interia.pl','622345678','ul. Sosnowa 9, Gdynia'),(24,'Karolina','Kaczmarek','karolina.kaczmarek@poczta.fm','623456789','ul. Bukowa 11, Łomża'),(25,'Mateusz','Kucharski','mateusz.kucharski@gmail.com','624567890','ul. Jodłowa 7, Koszalin');
/*!40000 ALTER TABLE `wlasciciele` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zabiegi`
--

DROP TABLE IF EXISTS `zabiegi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zabiegi` (
  `IdZabiegu` int(11) NOT NULL AUTO_INCREMENT,
  `IdZwierzecia` int(11) DEFAULT NULL,
  `DataZabiegu` datetime DEFAULT NULL,
  `Nazwa` varchar(1000) DEFAULT NULL,
  `StanZwierzecia` varchar(30) DEFAULT NULL,
  `OpisZabiegu` varchar(1000) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `CenaZabiegu` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`IdZabiegu`),
  KEY `IdZwierzecia` (`IdZwierzecia`),
  CONSTRAINT `zabiegi_ibfk_1` FOREIGN KEY (`IdZwierzecia`) REFERENCES `zwierzeta` (`IdZwierzecia`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zabiegi`
--

LOCK TABLES `zabiegi` WRITE;
/*!40000 ALTER TABLE `zabiegi` DISABLE KEYS */;
INSERT INTO `zabiegi` VALUES (1,5,'2021-05-16 10:00:00','Operacja usunięcia guza','Dobry','Usunięcie guza z tylnej łapy. Zabieg przeprowadzony bez komplikacji.','Zakończona',800.00),(2,6,'2021-06-21 11:00:00','Sterylizacja','Bardzo dobry','Zabieg sterylizacji samicy kota. Zwierzę wybudziło się bez problemów.','Zakończona',400.00),(3,12,'2021-07-01 10:00:00','Operacja ortopedyczna','Średni','Naprawa złamania kości udowej. Zabieg skomplikowany, wymaga dalszej rehabilitacji.','Zakończona',1200.00),(4,6,'2021-06-25 09:00:00','Usunięcie kamienia nazębnego','Dobry','Czyszczenie zębów w znieczuleniu ogólnym. Zabieg przebiegł pomyślnie.','Zakończona',200.00),(5,9,'2021-09-11 12:00:00','Operacja serca','Zły','Korekta wady serca. Zabieg bardzo skomplikowany.','W trakcie',5000.00),(6,1,'2021-05-20 08:00:00','Amputacja ogona','Dobry','Amputacja uszkodzonego ogona. Zwierzę w dobrej kondycji.','Zakończona',600.00),(7,7,'2021-08-31 13:00:00','Operacja usunięcia ciała obcego','Średni','Usunięcie połkniętego przedmiotu z przewodu pokarmowego.','Zakończona',700.00),(8,NULL,'2021-04-10 14:30:00','Szczepienie przeciwko chorobom zakaźnym','Bardzo dobry','Szczepienie ochronne.','Zakończona',100.00),(9,13,'2022-01-20 10:30:00','Leczenie endodontyczne','Dobry','Leczenie kanałowe zęba.','Zakończona',200.00),(10,10,'2021-10-06 15:00:00','Operacja usunięcia kamieni moczowych','Średni','Usunięcie kamieni z pęcherza moczowego.','Zakończona',900.00),(11,3,'2021-07-05 10:00:00','Kastracja','Dobry','Standardowy zabieg kastracji królika. Zabieg przebiegł pomyślnie.','Zakończona',200.00),(12,4,'2021-08-15 09:00:00','Operacja usunięcia kamieni nerkowych','Średni','Usunięcie kamieni nerkowych u psa. Wymagana dalsza opieka.','Zakończona',1000.00),(13,8,'2021-09-20 11:00:00','Operacja skrzydła','Średni','Naprawa złamanego skrzydła u kanarka. Zabieg skomplikowany.','Zakończona',500.00),(14,14,'2021-10-25 12:00:00','Usunięcie ciała obcego z żołądka','Zły','Operacja usunięcia ciała obcego z żołądka kota. Stan krytyczny.','W trakcie',1200.00),(15,15,'2021-11-30 13:00:00','Operacja przepukliny','Dobry','Usunięcie przepukliny u psa. Zabieg przebiegł bez komplikacji.','Zakończona',700.00),(16,18,'2021-12-05 14:00:00','Operacja usunięcia guza','Średni','Usunięcie guza u chomika. Wymaga dalszej obserwacji.','Zakończona',400.00),(17,11,'2022-01-10 15:00:00','Operacja oka','Dobry','Usunięcie zaćmy u kota. Zabieg udany.','Zakończona',800.00),(18,16,'2022-02-15 16:00:00','Operacja neurologiczna','Zły','Operacja kręgosłupa u psa. Stan poważny.','W trakcie',2500.00),(19,17,'2022-03-20 09:00:00','Operacja usunięcia ciała obcego','Średni','Usunięcie połkniętego przedmiotu u kota. Stan stabilny.','Zakończona',900.00),(20,19,'2022-04-25 11:00:00','Operacja ortopedyczna','Dobry','Naprawa złamania kości u psa. Dalsza rehabilitacja konieczna.','Zakończona',1500.00);
/*!40000 ALTER TABLE `zabiegi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zabiegileczenia`
--

DROP TABLE IF EXISTS `zabiegileczenia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zabiegileczenia` (
  `IdLeczenia` int(11) NOT NULL,
  `IdZabiegu` int(11) NOT NULL,
  PRIMARY KEY (`IdLeczenia`,`IdZabiegu`),
  KEY `IdZabiegu` (`IdZabiegu`),
  CONSTRAINT `zabiegileczenia_ibfk_1` FOREIGN KEY (`IdZabiegu`) REFERENCES `zabiegi` (`IdZabiegu`),
  CONSTRAINT `zabiegileczenia_ibfk_2` FOREIGN KEY (`IdLeczenia`) REFERENCES `leczenia` (`IdLeczenia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zabiegileczenia`
--

LOCK TABLES `zabiegileczenia` WRITE;
/*!40000 ALTER TABLE `zabiegileczenia` DISABLE KEYS */;
INSERT INTO `zabiegileczenia` VALUES (1,6),(2,8),(3,11),(4,12),(5,1),(6,2),(6,4),(7,7),(8,10),(9,17),(10,9),(11,18),(12,19),(13,16),(14,14),(15,15),(16,2),(16,4),(17,5),(18,11);
/*!40000 ALTER TABLE `zabiegileczenia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zabiegilekarze`
--

DROP TABLE IF EXISTS `zabiegilekarze`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zabiegilekarze` (
  `IdZabiegu` int(11) NOT NULL,
  `IdLekarza` int(11) NOT NULL,
  PRIMARY KEY (`IdZabiegu`,`IdLekarza`),
  KEY `IdLekarza` (`IdLekarza`),
  CONSTRAINT `zabiegilekarze_ibfk_1` FOREIGN KEY (`IdZabiegu`) REFERENCES `zabiegi` (`IdZabiegu`),
  CONSTRAINT `zabiegilekarze_ibfk_2` FOREIGN KEY (`IdLekarza`) REFERENCES `lekarze` (`IdLekarza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zabiegilekarze`
--

LOCK TABLES `zabiegilekarze` WRITE;
/*!40000 ALTER TABLE `zabiegilekarze` DISABLE KEYS */;
INSERT INTO `zabiegilekarze` VALUES (1,1),(1,8),(2,5),(3,4),(3,10),(4,11),(5,2),(5,9),(6,1),(7,7),(8,13),(9,3),(10,6),(11,1),(11,16),(12,8),(13,4),(13,20),(14,8),(15,16),(16,7),(16,14),(17,5),(17,19),(18,6),(18,12),(18,18),(19,1),(19,8),(20,4),(20,10),(20,20);
/*!40000 ALTER TABLE `zabiegilekarze` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zabiegirecepty`
--

DROP TABLE IF EXISTS `zabiegirecepty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zabiegirecepty` (
  `IdRecepty` int(11) NOT NULL AUTO_INCREMENT,
  `IdZabiegu` int(11) NOT NULL,
  `DataWystawienia` datetime DEFAULT NULL,
  PRIMARY KEY (`IdRecepty`),
  KEY `IdZabiegu` (`IdZabiegu`),
  CONSTRAINT `zabiegirecepty_ibfk_1` FOREIGN KEY (`IdZabiegu`) REFERENCES `zabiegi` (`IdZabiegu`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zabiegirecepty`
--

LOCK TABLES `zabiegirecepty` WRITE;
/*!40000 ALTER TABLE `zabiegirecepty` DISABLE KEYS */;
INSERT INTO `zabiegirecepty` VALUES (1,1,'2021-05-16 10:00:00'),(2,3,'2021-06-21 11:00:00'),(3,5,'2021-09-11 12:00:00'),(4,7,'2021-08-31 13:00:00'),(5,2,'2021-06-21 14:00:00'),(6,4,'2021-06-25 12:00:00'),(7,6,'2021-05-20 11:00:00'),(8,8,'2021-04-10 17:30:00'),(9,9,'2022-01-20 13:30:00'),(10,10,'2021-10-06 18:00:00'),(11,11,'2021-07-05 13:00:00'),(12,12,'2021-08-15 12:00:00'),(13,13,'2021-09-20 14:00:00'),(14,14,'2021-10-25 15:00:00'),(15,15,'2021-11-30 16:00:00');
/*!40000 ALTER TABLE `zabiegirecepty` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER usuwanieRecepty
BEFORE DELETE ON ZabiegiRecepty
FOR EACH ROW
BEGIN
    DELETE FROM SzczegolyZabiegiRecepty
    WHERE OLD.IdRecepty = IdRecepty;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER usuwanieReceptyLogi
AFTER DELETE ON ZabiegiRecepty
FOR EACH ROW
BEGIN
    INSERT INTO logi(opis, data_czas)
    VALUES (CONCAT('Usunieto recepte o ID: ', OLD.IdRecepty, 
                   ' Dla Zabiegu o ID: ', OLD.IdZabiegu), NOW());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `zwierzeta`
--

DROP TABLE IF EXISTS `zwierzeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zwierzeta` (
  `IdZwierzecia` int(11) NOT NULL AUTO_INCREMENT,
  `Imie` varchar(50) DEFAULT NULL,
  `Gatunek` varchar(100) DEFAULT NULL,
  `Rasa` varchar(100) DEFAULT NULL,
  `DataUrodzenia` date DEFAULT NULL,
  `Plec` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdZwierzecia`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zwierzeta`
--

LOCK TABLES `zwierzeta` WRITE;
/*!40000 ALTER TABLE `zwierzeta` DISABLE KEYS */;
INSERT INTO `zwierzeta` VALUES (1,'Burek','pies','Owczarek niemiecki','2017-03-15','M'),(3,'Słoneczko','chomik','Chomik syryjski','2020-05-10','M'),(4,'Bella','kot','Syjamski','2019-09-05','F'),(5,'Reksio','pies','Beagle','2016-12-01','M'),(6,'Luna','kot','Perski','2018-11-18','F'),(7,'Chrupek','świnka morska','Skinny','2020-02-28','M'),(8,'Tweety','ptak','Kanarek','2019-08-14','F'),(9,'Kora','pies','Husky','2015-01-20','F'),(10,'Mimi','kot','Brytyjski krótkowłosy','2018-06-30','F'),(11,'Rocky','pies','Bokser','2017-10-12','M'),(12,'Fibi','mysz','Mysz domowa','2020-03-08','F'),(13,'Sara','pies','Border collie','2016-07-17','F'),(14,'Felix','kot','Sfinks','2020-12-25','M'),(15,'Bruno','pies','Mops','2019-09-09','M'),(16,'Tusia','świnka morska','Abisyńska','2018-04-04','F'),(17,'Daisy','pies','Cocker spaniel','2017-11-11','F'),(18,'Kiwi','ptak','Papuga falista','2019-01-01','M'),(19,'Coco','pies','Pudel','2016-05-25','F'),(20,'Kitka','kot','Rosyjski niebieski','2017-08-08','F'),(21,'Max','pies','Golden retriever','2015-04-14','M'),(22,'Leo','kot','Norweski leśny','2016-06-06','M'),(23,'Bob','mysz','Mysz laboratoryjna','2020-09-01','M'),(24,'Luna','chomik','Chomik dżungarski','2020-10-10','F'),(25,'Bella','pies','Sznaucer miniaturowy','2019-02-15','F'),(26,'Pepe','ptak','Nimfa','2018-12-12','M'),(27,'Molly','kot','Maine coon','2017-03-03','F'),(28,'Niko','chomik','Chomik Roborowskiego','2020-05-05','M'),(29,'Gucio','pies','Shih tzu','2019-07-07','M'),(30,'Kiki','ptak','Papuga nierozłączka','2018-08-18','F');
/*!40000 ALTER TABLE `zwierzeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zwierzeta2_test`
--

DROP TABLE IF EXISTS `zwierzeta2_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zwierzeta2_test` (
  `IdZwierzecia` int(11) NOT NULL AUTO_INCREMENT,
  `Imie` varchar(50) DEFAULT NULL,
  `Gatunek` varchar(100) DEFAULT NULL,
  `Rasa` varchar(100) DEFAULT NULL,
  `DataUrodzenia` date DEFAULT NULL,
  `Plec` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdZwierzecia`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zwierzeta2_test`
--

LOCK TABLES `zwierzeta2_test` WRITE;
/*!40000 ALTER TABLE `zwierzeta2_test` DISABLE KEYS */;
INSERT INTO `zwierzeta2_test` VALUES (1,'Burek','pies','Owczarek niemiecki','2017-03-15','M'),(3,'Puszek','chomik','Chomik syryjski','2020-05-10','M'),(4,'Bella','kot','Syjamski','2019-09-05','F'),(5,'Reksio','pies','Beagle','2016-12-01','M'),(6,'Luna','kot','Perski','2018-11-18','F'),(7,'Chrupek','?winka morska','Skinny','2020-02-28','M'),(8,'Tweety','ptak','Kanarek','2019-08-14','F'),(9,'Kora','pies','Husky','2015-01-20','F'),(10,'Mimi','kot','Brytyjski kr?tkow?osy','2018-06-30','F'),(11,'Rocky','pies','Bokser','2017-10-12','M'),(12,'Fibi','mysz','Mysz domowa','2020-03-08','F'),(13,'Sara','pies','Border collie','2016-07-17','F'),(14,'Felix','kot','Sfinks','2020-12-25','M'),(15,'Bruno','pies','Mops','2019-09-09','M'),(16,'Tusia','?winka morska','Abisy?ska','2018-04-04','F'),(17,'Daisy','pies','Cocker spaniel','2017-11-11','F'),(18,'Kiwi','ptak','Papuga falista','2019-01-01','M'),(19,'Coco','pies','Pudel','2016-05-25','F'),(20,'Kitka','kot','Rosyjski niebieski','2017-08-08','F'),(21,'Max','pies','Golden retriever','2015-04-14','M'),(22,'Leo','kot','Norweski le?ny','2016-06-06','M'),(23,'Bob','mysz','Mysz laboratoryjna','2020-09-01','M'),(24,'Luna','chomik','Chomik d?ungarski','2020-10-10','F'),(25,'Bella','pies','Sznaucer miniaturowy','2019-02-15','F'),(26,'Pepe','ptak','Nimfa','2018-12-12','M'),(27,'Molly','kot','Maine coon','2017-03-03','F'),(28,'Niko','chomik','Chomik Roborowskiego','2020-05-05','M'),(29,'Gucio','pies','Shih tzu','2019-07-07','M'),(30,'Kiki','ptak','Papuga nieroz??czka','2018-08-18','F');
/*!40000 ALTER TABLE `zwierzeta2_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zwierzeta_test`
--

DROP TABLE IF EXISTS `zwierzeta_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zwierzeta_test` (
  `IdZwierzecia` int(11) NOT NULL AUTO_INCREMENT,
  `Imie` varchar(50) DEFAULT NULL,
  `Gatunek` varchar(100) DEFAULT NULL,
  `Rasa` varchar(100) DEFAULT NULL,
  `DataUrodzenia` date DEFAULT NULL,
  `Plec` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdZwierzecia`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zwierzeta_test`
--

LOCK TABLES `zwierzeta_test` WRITE;
/*!40000 ALTER TABLE `zwierzeta_test` DISABLE KEYS */;
INSERT INTO `zwierzeta_test` VALUES (1,'Burek','pies','Owczarek niemiecki','2017-03-15','M'),(3,'Puszek','chomik','Chomik syryjski','2020-05-10','M'),(4,'Bella','kot','Syjamski','2019-09-05','F'),(5,'Reksio','pies','Beagle','2016-12-01','M'),(6,'Luna','kot','Perski','2018-11-18','F'),(7,'Chrupek','?winka morska','Skinny','2020-02-28','M'),(8,'Tweety','ptak','Kanarek','2019-08-14','F'),(9,'Kora','pies','Husky','2015-01-20','F'),(10,'Mimi','kot','Brytyjski kr?tkow?osy','2018-06-30','F'),(11,'Rocky','pies','Bokser','2017-10-12','M'),(12,'Fibi','mysz','Mysz domowa','2020-03-08','F'),(13,'Sara','pies','Border collie','2016-07-17','F'),(14,'Felix','kot','Sfinks','2020-12-25','M'),(15,'Bruno','pies','Mops','2019-09-09','M'),(16,'Tusia','?winka morska','Abisy?ska','2018-04-04','F'),(17,'Daisy','pies','Cocker spaniel','2017-11-11','F'),(18,'Kiwi','ptak','Papuga falista','2019-01-01','M'),(19,'Coco','pies','Pudel','2016-05-25','F'),(20,'Kitka','kot','Rosyjski niebieski','2017-08-08','F'),(21,'Max','pies','Golden retriever','2015-04-14','M'),(22,'Leo','kot','Norweski le?ny','2016-06-06','M'),(23,'Bob','mysz','Mysz laboratoryjna','2020-09-01','M'),(24,'Luna','chomik','Chomik d?ungarski','2020-10-10','F'),(25,'Bella','pies','Sznaucer miniaturowy','2019-02-15','F'),(26,'Pepe','ptak','Nimfa','2018-12-12','M'),(27,'Molly','kot','Maine coon','2017-03-03','F'),(28,'Niko','chomik','Chomik Roborowskiego','2020-05-05','M'),(29,'Gucio','pies','Shih tzu','2019-07-07','M'),(30,'Kiki','ptak','Papuga nieroz??czka','2018-08-18','F');
/*!40000 ALTER TABLE `zwierzeta_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zwierzetawlasciciele`
--

DROP TABLE IF EXISTS `zwierzetawlasciciele`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zwierzetawlasciciele` (
  `IdZwierzecia` int(11) NOT NULL,
  `IdWlasciciela` int(11) NOT NULL,
  PRIMARY KEY (`IdZwierzecia`,`IdWlasciciela`),
  KEY `IdWlasciciela` (`IdWlasciciela`),
  CONSTRAINT `zwierzetawlasciciele_ibfk_1` FOREIGN KEY (`IdZwierzecia`) REFERENCES `zwierzeta` (`IdZwierzecia`),
  CONSTRAINT `zwierzetawlasciciele_ibfk_2` FOREIGN KEY (`IdWlasciciela`) REFERENCES `wlasciciele` (`IdWlasciciela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zwierzetawlasciciele`
--

LOCK TABLES `zwierzetawlasciciele` WRITE;
/*!40000 ALTER TABLE `zwierzetawlasciciele` DISABLE KEYS */;
INSERT INTO `zwierzetawlasciciele` VALUES (1,1),(1,3),(3,5),(4,6),(4,7),(5,1),(6,8),(7,9),(8,10),(8,11),(9,12),(10,13),(11,14),(12,15),(12,16),(13,17),(14,18),(15,19),(16,20),(17,21),(18,22),(18,23),(19,24),(20,25),(21,2),(22,8),(23,9),(24,10),(25,11),(26,12),(27,13),(28,14),(29,15),(30,16);
/*!40000 ALTER TABLE `zwierzetawlasciciele` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'klinika'
--

--
-- Dumping routines for database 'klinika'
--

--
-- Current Database: `klinika`
--

USE `klinika`;

--
-- Final view structure for view `widokcount`
--

/*!50001 DROP VIEW IF EXISTS `widokcount`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `widokcount` AS select count(0) AS `liczbaPracownikow` from `lekarze` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `widokhaving`
--

/*!50001 DROP VIEW IF EXISTS `widokhaving`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `widokhaving` AS select `l`.`Nazwa` AS `Nazwa`,`l`.`Cena` AS `Cena`,ifnull(sum(`swr`.`Ilosc`),0) + ifnull(sum(`szr`.`Ilosc`),0) AS `IloscUzycia` from ((`leki` `l` left join `szczegolywizytyrecepty` `swr` on(`l`.`IdLeku` = `swr`.`IdLeku`)) left join `szczegolyzabiegirecepty` `szr` on(`l`.`IdLeku` = `szr`.`IdLeku`)) where `l`.`Nazwa` like 'A%' or `l`.`Nazwa` like 'B%' or `l`.`Nazwa` like 'C%' or `l`.`Nazwa` like 'D%' or `l`.`Nazwa` like 'E%' group by `l`.`IdLeku` having `IloscUzycia` < 100 order by ifnull(sum(`swr`.`Ilosc`),0) + ifnull(sum(`szr`.`Ilosc`),0) desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `widokjoin`
--

/*!50001 DROP VIEW IF EXISTS `widokjoin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `widokjoin` AS select `zwierzeta`.`Imie` AS `Imie`,`zwierzeta`.`Gatunek` AS `Gatunek`,count(`wizyty`.`IdWizyty`) AS `liczbaWizyt` from (`zwierzeta` left join `wizyty` on(`zwierzeta`.`IdZwierzecia` = `wizyty`.`IdZwierzecia`)) group by `zwierzeta`.`IdZwierzecia` order by `zwierzeta`.`Imie`,`zwierzeta`.`Gatunek` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `widoklike`
--

/*!50001 DROP VIEW IF EXISTS `widoklike`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `widoklike` AS select `lekarze`.`Imie` AS `Imie`,`lekarze`.`Nazwisko` AS `Nazwisko`,`lekarze`.`AdresEmail` AS `AdresEmail` from `lekarze` where `lekarze`.`AdresEmail` like '%@gmail.com' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `widoksumgroupby`
--

/*!50001 DROP VIEW IF EXISTS `widoksumgroupby`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `widoksumgroupby` AS select `zwierzeta`.`Imie` AS `Imie`,`zwierzeta`.`Gatunek` AS `Gatunek`,sum(`zabiegi`.`CenaZabiegu`) AS `laczneWydatkiNaZabiegi` from (`zwierzeta` join `zabiegi` on(`zwierzeta`.`IdZwierzecia` = `zabiegi`.`IdZwierzecia`)) group by `zwierzeta`.`IdZwierzecia` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `widoktriplejoin`
--

/*!50001 DROP VIEW IF EXISTS `widoktriplejoin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `widoktriplejoin` AS select `lekarze`.`Imie` AS `Imie`,`lekarze`.`Nazwisko` AS `Nazwisko`,`zabiegi`.`Nazwa` AS `Nazwa`,`zabiegi`.`OpisZabiegu` AS `OpisZabiegu`,`zabiegi`.`StanZwierzecia` AS `StanZwierzecia` from ((`lekarze` join `zabiegilekarze` on(`lekarze`.`IdLekarza` = `zabiegilekarze`.`IdLekarza`)) join `zabiegi` on(`zabiegilekarze`.`IdZabiegu` = `zabiegi`.`IdZabiegu`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `widoktriplewhere`
--

/*!50001 DROP VIEW IF EXISTS `widoktriplewhere`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `widoktriplewhere` AS select `l`.`Imie` AS `Imie`,`l`.`Nazwisko` AS `Nazwisko`,`z`.`Nazwa` AS `Nazwa`,`z`.`OpisZabiegu` AS `OpisZabiegu`,`z`.`StanZwierzecia` AS `StanZwierzecia` from ((`lekarze` `l` join `zabiegi` `z`) join `zabiegilekarze` `zl`) where `l`.`IdLekarza` = `zl`.`IdLekarza` and `z`.`IdZabiegu` = `zl`.`IdZabiegu` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `widokwhere`
--

/*!50001 DROP VIEW IF EXISTS `widokwhere`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `widokwhere` AS select `z`.`Imie` AS `ImieZwierzecia`,`z`.`Gatunek` AS `GatunekZwierzecia`,count(`w`.`IdWizyty`) AS `LiczbaWizyt` from (`zwierzeta` `z` join `wizyty` `w`) where `z`.`IdZwierzecia` = `w`.`IdZwierzecia` group by `z`.`IdZwierzecia` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `widokwhereorderby`
--

/*!50001 DROP VIEW IF EXISTS `widokwhereorderby`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `widokwhereorderby` AS select `leki`.`Nazwa` AS `Nazwa`,`leki`.`Cena` AS `Cena` from `leki` where `leki`.`Cena` < 100 order by `leki`.`Cena` */;
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

-- Dump completed on 2025-03-11 23:36:05
