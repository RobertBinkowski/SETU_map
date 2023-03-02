-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for setu_map
CREATE DATABASE IF NOT EXISTS `setu_map` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `setu_map`;

-- Dumping structure for table setu_map.buildings
CREATE TABLE IF NOT EXISTS `buildings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `abbreviation` varchar(255) DEFAULT NULL,
  `info` text,
  `size` double DEFAULT NULL,
  `campus_id` int DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `layout` longtext,
  PRIMARY KEY (`id`),
  KEY `FK_building_campus` (`campus_id`),
  KEY `FK_buildings_locations` (`location_id`),
  CONSTRAINT `FK_building_campus` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`),
  CONSTRAINT `FK_buildings_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.buildings: ~5 rows (approximately)
REPLACE INTO `buildings` (`id`, `enabled`, `name`, `abbreviation`, `info`, `size`, `campus_id`, `location_id`, `layout`) VALUES
	(1, 1, 'asdsad', '12', 'asdsad', 1, 1, 1, '<svg width="75" height="47" viewBox="0 0 75 47" fill="none" xmlns="http://www.w3.org/2000/svg">\n<rect width="47" height="47" fill="#2B7448"/>\n<path d="M47 0L74.7128 46.5H19.2872L47 0Z" fill="#2B7448"/>\n</svg>\n'),
	(2, 1, 'asdsad', 'dasd', 'fdsaf', 2132, 1, 2, '<svg width="47" height="84" viewBox="0 0 47 84" fill="none" xmlns="http://www.w3.org/2000/svg">\n<rect y="37" width="47" height="47" fill="#874949"/>\n<rect width="19" height="37" fill="#51748E"/>\n</svg>\n'),
	(3, 1, '2321sdsa', 'sad', 'adsasdqwdas', 22, 1, 3, '<svg width="47" height="30" viewBox="0 0 47 30" fill="none" xmlns="http://www.w3.org/2000/svg">\n<rect width="47" height="30" fill="#51748E"/>\n</svg>\n'),
	(4, 1, 'sadasd', 'ss', '11', 22222, 1, 4, '<svg width="66" height="47" viewBox="0 0 66 47" fill="none" xmlns="http://www.w3.org/2000/svg">\n<rect width="47" height="47" fill="#874949"/>\n<rect x="47" y="5" width="19" height="37" fill="#51748E"/>\n</svg>\n'),
	(5, 1, 'sadsad', 'sad', 'asd', 222, 1, 5, '<svg width="75" height="47" viewBox="0 0 75 47" fill="none" xmlns="http://www.w3.org/2000/svg">\n<rect width="47" height="47" fill="#2B7448"/>\n<path d="M47 0L74.7128 46.5H19.2872L47 0Z" fill="#2B7448"/>\n</svg>\n');

-- Dumping structure for table setu_map.campuses
CREATE TABLE IF NOT EXISTS `campuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `abbreviation` varchar(255) DEFAULT NULL,
  `info` text,
  `size` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `width` double DEFAULT NULL,
  `layout` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.campuses: ~2 rows (approximately)
REPLACE INTO `campuses` (`id`, `enabled`, `name`, `abbreviation`, `info`, `size`, `height`, `width`, `layout`) VALUES
	(1, 1, 'Carlow', 'SETU', NULL, 2000.2, 1000, 1000, NULL),
	(2, 1, 'Wexford', NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table setu_map.connections
CREATE TABLE IF NOT EXISTS `connections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `distance` double DEFAULT NULL,
  `location_one` int DEFAULT NULL,
  `location_two` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_connections_locations` (`location_one`) USING BTREE,
  KEY `FK_connections_locations_2` (`location_two`),
  CONSTRAINT `FK_connections_locations` FOREIGN KEY (`location_one`) REFERENCES `locations` (`id`),
  CONSTRAINT `FK_connections_locations_2` FOREIGN KEY (`location_two`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.connections: ~7 rows (approximately)
REPLACE INTO `connections` (`id`, `enabled`, `distance`, `location_one`, `location_two`) VALUES
	(1, 1, 12, 1, 2),
	(2, 1, NULL, 2, 3),
	(3, 1, NULL, 3, 4),
	(4, 1, NULL, 4, 5),
	(5, 1, NULL, 2, 5),
	(6, 1, NULL, 1, 4),
	(7, 1, NULL, 4, 5);

-- Dumping structure for table setu_map.floors
CREATE TABLE IF NOT EXISTS `floors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `floor` int DEFAULT NULL,
  `size` double DEFAULT NULL,
  `building_id` int DEFAULT NULL,
  `layout` longtext,
  PRIMARY KEY (`id`),
  KEY `FK_floors_buildings` (`building_id`),
  CONSTRAINT `FK_floors_buildings` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.floors: ~1 rows (approximately)
REPLACE INTO `floors` (`id`, `enabled`, `floor`, `size`, `building_id`, `layout`) VALUES
	(1, 1, NULL, 3, 1, '<svg width="184" height="138" viewBox="0 0 184 138" fill="none" xmlns="http://www.w3.org/2000/svg">\n<rect width="184" height="138" fill="#747474"/>\n</svg>\n');

-- Dumping structure for table setu_map.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `campus_id` int DEFAULT NULL,
  `building_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_image_campus` (`campus_id`),
  KEY `FK_image_building` (`building_id`),
  KEY `FK_image_room` (`room_id`),
  CONSTRAINT `FK_image_building` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`),
  CONSTRAINT `FK_image_campus` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`),
  CONSTRAINT `FK_image_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.images: ~1 rows (approximately)
REPLACE INTO `images` (`id`, `enabled`, `name`, `info`, `src`, `campus_id`, `building_id`, `room_id`) VALUES
	(1, 1, 'sadsad', 'sadsad', 'asdsadds', 1, 1, 1);

-- Dumping structure for table setu_map.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `geo_longitude` double DEFAULT NULL,
  `geo_latitude` double DEFAULT NULL,
  `x` double DEFAULT NULL,
  `y` double DEFAULT NULL,
  `z` double DEFAULT '0',
  `type` enum('Location','Stairs','Elevator') DEFAULT 'Location',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.locations: ~5 rows (approximately)
REPLACE INTO `locations` (`id`, `enabled`, `geo_longitude`, `geo_latitude`, `x`, `y`, `z`, `type`) VALUES
	(1, 1, NULL, NULL, 10, 10, 0, 'Location'),
	(2, 1, NULL, NULL, 55, 11, 0, 'Location'),
	(3, 1, NULL, NULL, 20, 15, 0, 'Location'),
	(4, 1, NULL, NULL, 23, 23, 0, 'Location'),
	(5, 1, NULL, NULL, 12, 50, 0, 'Location');

-- Dumping structure for table setu_map.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `type` enum('Warning','Error','Info','General') DEFAULT 'General',
  `info` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.logs: ~1 rows (approximately)
REPLACE INTO `logs` (`id`, `title`, `type`, `info`) VALUES
	(1, 'Test\r\n', 'General', 'Test');

-- Dumping structure for table setu_map.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `type` enum('room','toilet','office') NOT NULL DEFAULT 'room',
  `name` varchar(255) DEFAULT 'room',
  `info` text,
  `size` double DEFAULT NULL,
  `building_id` int DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `floor_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_room_building` (`building_id`),
  KEY `FK_room_location` (`location_id`),
  KEY `FK_rooms_floors` (`floor_id`),
  CONSTRAINT `FK_room_building` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`),
  CONSTRAINT `FK_room_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `FK_rooms_floors` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.rooms: ~2 rows (approximately)
REPLACE INTO `rooms` (`id`, `enabled`, `type`, `name`, `info`, `size`, `building_id`, `location_id`, `floor_id`) VALUES
	(1, 1, 'room', 'A313', 'UNUM room', 12, NULL, 3, NULL),
	(2, 0, 'room', '!!!!!!!\r\nasdsadsadsadsadsad', '213\r\n', 2, NULL, 1, NULL);

-- Dumping structure for table setu_map.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `privileges` enum('all','room','building','none','campus') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'none',
  `created` date DEFAULT NULL,
  `campus_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `campus_id` (`campus_id`),
  CONSTRAINT `FK_users_campus` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.users: ~4 rows (approximately)
REPLACE INTO `users` (`id`, `enabled`, `email`, `username`, `password`, `privileges`, `created`, `campus_id`) VALUES
	(1, 1, 'test@test.com', 'Hello Theasdasdsare', 'pass', 'all', '2023-01-08', 1),
	(2, 1, 'test@test.com', 'Hello Theasdasdsare', 'pass', 'all', '2023-01-08', 1),
	(6, 1, 'test@test.com', 'Hello Theasdasdsare', 'pass', 'all', NULL, 1),
	(7, 1, 'test@test.com', 'Hello Theasdasdsare', 'pass', 'all', NULL, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
