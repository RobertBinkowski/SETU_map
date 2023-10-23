-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
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
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `campus` int unsigned DEFAULT NULL,
  `location` int unsigned DEFAULT NULL,
  `details` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_buildings_campuses` (`campus`),
  KEY `FK_buildings_details` (`details`),
  KEY `FK_buildings_locations` (`location`),
  CONSTRAINT `FK_buildings_campuses` FOREIGN KEY (`campus`) REFERENCES `campuses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_buildings_details` FOREIGN KEY (`details`) REFERENCES `details` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_buildings_locations` FOREIGN KEY (`location`) REFERENCES `locations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.buildings: ~4 rows (approximately)
REPLACE INTO `buildings` (`id`, `enabled`, `campus`, `location`, `details`) VALUES
	(7, 1, 1, 38, 5),
	(8, 1, 1, 23, 7),
	(9, 1, 1, 39, 9),
	(10, 1, 1, 42, 10);

-- Dumping structure for table setu_map.campuses
CREATE TABLE IF NOT EXISTS `campuses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `coordinates` int unsigned DEFAULT NULL,
  `entrance` int unsigned DEFAULT NULL,
  `details` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coordinates` (`coordinates`),
  KEY `FK_campuses_details` (`details`),
  KEY `FK_campuses_coordinates_2` (`entrance`),
  CONSTRAINT `FK_campuses_coordinates` FOREIGN KEY (`coordinates`) REFERENCES `coordinates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_campuses_details` FOREIGN KEY (`details`) REFERENCES `details` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_campuses_locations` FOREIGN KEY (`entrance`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.campuses: ~2 rows (approximately)
REPLACE INTO `campuses` (`id`, `enabled`, `coordinates`, `entrance`, `details`) VALUES
	(1, 1, 1, 24, 1),
	(2, 1, 34, 39, 8);

-- Dumping structure for table setu_map.connections
CREATE TABLE IF NOT EXISTS `connections` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `location_one` int unsigned DEFAULT NULL,
  `location_two` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_connections_locations` (`location_one`) USING BTREE,
  KEY `FK_connections_locations_2` (`location_two`),
  CONSTRAINT `FK_connections_locations` FOREIGN KEY (`location_one`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_connections_locations_2` FOREIGN KEY (`location_two`) REFERENCES `locations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.connections: ~26 rows (approximately)
REPLACE INTO `connections` (`id`, `enabled`, `location_one`, `location_two`) VALUES
	(19, 1, 23, 24),
	(20, 1, 24, 25),
	(21, 1, 25, 26),
	(22, 1, 27, 28),
	(23, 1, 29, 30),
	(24, 1, 31, 32),
	(25, 1, 32, 33),
	(26, 1, 33, 34),
	(27, 1, 35, 36),
	(28, 1, 37, 36),
	(29, 1, 34, 37),
	(30, 1, 26, 27),
	(31, 1, 28, 29),
	(32, 1, 30, 31),
	(33, 1, 34, 35),
	(35, 1, 23, 38),
	(36, 1, 38, 39),
	(37, 1, 42, 41),
	(38, 1, 41, 27),
	(39, 1, 43, 44),
	(40, 1, 30, 44),
	(41, 1, 30, 45),
	(42, 1, 45, 43),
	(44, 1, 46, 30),
	(45, 1, 30, 47),
	(46, 1, 47, 31);

-- Dumping structure for table setu_map.coordinates
CREATE TABLE IF NOT EXISTS `coordinates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `altitude` double DEFAULT '0',
  `zoom` double DEFAULT '18',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.coordinates: ~27 rows (approximately)
REPLACE INTO `coordinates` (`id`, `latitude`, `longitude`, `altitude`, `zoom`) VALUES
	(1, 52.82717415175186, -6.936027335901612, 0, 18),
	(19, 52.828642433770405, -6.936628150726521, 0, 18),
	(20, 52.828519268531124, -6.936118531025419, 0, 18),
	(21, 52.82821783634481, -6.936193632873731, 0, 18),
	(22, 52.82768303215769, -6.936488675849241, 0, 18),
	(23, 52.82747559118584, -6.9365905997862365, 0, 18),
	(24, 52.827320009800545, -6.936681794865472, 0, 18),
	(25, 52.827312895995135, -6.936579172921357, 0, 18),
	(26, 52.82724546019239, -6.936064886825768, 0, 18),
	(27, 52.827161186568276, -6.935646462242317, 0, 18),
	(28, 52.82694726048065, -6.935673284330999, 0, 18),
	(29, 52.82686946891486, -6.935565995976269, 0, 18),
	(30, 52.82682084911555, -6.935222673241129, 0, 18),
	(31, 52.82661664536423, -6.935211944405655, 0, 18),
	(32, 52.82684677968196, -6.935147571392817, 0, 18),
	(33, 52.826814366471524, -6.935415792279644, 0, 18),
	(34, 52.33441852199082, -6.4719176599641015, 0, 18),
	(35, 52.33433020916646, -6.469401695849877, 0, 18),
	(36, 52.82700249967997, -6.936533418319218, 0, 18),
	(37, 52.827449427829684, -6.936874807774945, 0, 18),
	(38, 52.827444843974554, -6.937151712554527, 0, 18),
	(39, 52.82739212960581, -6.937053088934402, 0, 18),
	(40, 52.82698645601723, -6.936233754261966, 0, 18),
	(41, 52.827195023136476, -6.936374103259836, 0, 18),
	(42, 52.82731191196332, -6.936180649235745, 0, 18),
	(43, 52.82742634082414, -6.936192934862755, 0, 18),
	(44, 52.82724482893389, -6.936305587690987, 0, 18);

-- Dumping structure for table setu_map.details
CREATE TABLE IF NOT EXISTS `details` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT '0',
  `abbreviation` varchar(1000) DEFAULT '0',
  `info` text,
  `size` double DEFAULT '0',
  `src` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.details: ~10 rows (approximately)
REPLACE INTO `details` (`id`, `name`, `abbreviation`, `info`, `size`, `src`) VALUES
	(1, 'Carlow', 'SETU', 'This campus is located on the south of Carlow town', 0, 'images/IMG20230830181347.jpg'),
	(5, 'Liblary Building', 'LRC', 'This location is a Liblary', 0, 'images/asdklsadsadsa.png'),
	(6, 'A3131', 'Unum Room', 'Final Year Software development students room', 0, 'images/IMG20230830104233.jpg'),
	(7, 'Canteen', 'Canteen', '', 0, NULL),
	(8, 'Wexford', 'SETU', 'This is a SETU Wexford Campus', 0, 'images/Screenshot 2023-09-04 221057.png'),
	(9, 'Burrin Building', 'C', '', 0, NULL),
	(10, 'Haughton Building', 'N', NULL, 0, 'images/sdkjshfd.png'),
	(11, 'NB', '0', NULL, 0, 'images/osdfbnkjdsv.png'),
	(12, 'C123', 'C223', 'Computer Room', 0, 'images/sadkjasdknfne.png'),
	(13, 'Reception', 'Reception', 'This location allows you to avail of all administrative requirements.', 0, 'images/reception.png');

-- Dumping structure for table setu_map.floors
CREATE TABLE IF NOT EXISTS `floors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `floor` int DEFAULT NULL,
  `building` int unsigned DEFAULT NULL,
  `details` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_floors_buildings` (`building`) USING BTREE,
  KEY `FK_floors_details` (`details`),
  CONSTRAINT `FK_floors_buildings` FOREIGN KEY (`building`) REFERENCES `buildings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_floors_details` FOREIGN KEY (`details`) REFERENCES `details` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.floors: ~5 rows (approximately)
REPLACE INTO `floors` (`id`, `enabled`, `floor`, `building`, `details`) VALUES
	(3, 1, 2, 7, 5),
	(4, 1, 1, 7, 5),
	(5, 1, 0, 7, 5),
	(6, 1, 0, 9, 10),
	(7, 1, 1, 9, 9);

-- Dumping structure for table setu_map.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.images: ~1 rows (approximately)
REPLACE INTO `images` (`id`, `src`, `name`) VALUES
	(1, 'images/image.png', NULL);

-- Dumping structure for table setu_map.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `coordinates` int unsigned DEFAULT NULL,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `type` enum('Location','Stairs','Elevator') DEFAULT 'Location',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `coordinates` (`coordinates`),
  CONSTRAINT `coordinates` FOREIGN KEY (`coordinates`) REFERENCES `coordinates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.locations: ~25 rows (approximately)
REPLACE INTO `locations` (`id`, `coordinates`, `enabled`, `type`) VALUES
	(23, 1, 1, 'Location'),
	(24, 19, 1, 'Location'),
	(25, 20, 1, 'Location'),
	(26, 21, 1, 'Location'),
	(27, 22, 1, 'Location'),
	(28, 23, 1, 'Location'),
	(29, 24, 1, 'Location'),
	(30, 25, 1, 'Location'),
	(31, 26, 1, 'Location'),
	(32, 27, 1, 'Location'),
	(33, 28, 1, 'Location'),
	(34, 28, 1, 'Location'),
	(35, 30, 1, 'Stairs'),
	(36, 31, 1, 'Location'),
	(37, 32, 1, 'Elevator'),
	(38, 33, 1, 'Location'),
	(39, 35, 1, 'Location'),
	(40, 37, 1, 'Location'),
	(41, 38, 1, 'Location'),
	(42, 39, 1, 'Location'),
	(43, 40, 1, 'Location'),
	(44, 41, 1, 'Stairs'),
	(45, 42, 1, 'Elevator'),
	(46, 43, 1, 'Location'),
	(47, 44, 1, 'Location');

-- Dumping structure for table setu_map.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `type` enum('Warning','Error','Info','General') DEFAULT 'General',
  `info` longtext,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11504 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.logs: ~1 rows (approximately)
REPLACE INTO `logs` (`id`, `title`, `type`, `info`, `date`) VALUES
	(11503, 'asddsa', 'General', NULL, '2023-08-08 23:26:32');

-- Dumping structure for table setu_map.privileges
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `users` int unsigned DEFAULT NULL,
  `logs` int unsigned DEFAULT NULL,
  `searches` int unsigned DEFAULT NULL,
  `details` int unsigned DEFAULT NULL,
  `images` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_privileges_value` (`users`),
  KEY `FK_privileges_value_2` (`logs`),
  KEY `FK_privileges_value_3` (`searches`),
  KEY `FK_privileges_value_4` (`details`),
  KEY `FK_privileges_value_5` (`images`),
  CONSTRAINT `FK_privileges_value` FOREIGN KEY (`users`) REFERENCES `privilege_values` (`id`),
  CONSTRAINT `FK_privileges_value_2` FOREIGN KEY (`logs`) REFERENCES `privilege_values` (`id`),
  CONSTRAINT `FK_privileges_value_3` FOREIGN KEY (`searches`) REFERENCES `privilege_values` (`id`),
  CONSTRAINT `FK_privileges_value_4` FOREIGN KEY (`details`) REFERENCES `privilege_values` (`id`),
  CONSTRAINT `FK_privileges_value_5` FOREIGN KEY (`images`) REFERENCES `privilege_values` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.privileges: ~1 rows (approximately)
REPLACE INTO `privileges` (`id`, `name`, `users`, `logs`, `searches`, `details`, `images`) VALUES
	(1, 'Admin', 3, 3, 3, 3, 3);

-- Dumping structure for table setu_map.privilege_values
CREATE TABLE IF NOT EXISTS `privilege_values` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.privilege_values: ~3 rows (approximately)
REPLACE INTO `privilege_values` (`id`, `value`) VALUES
	(1, 'none'),
	(2, 'read'),
	(3, 'write');

-- Dumping structure for table setu_map.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `type` enum('room','toilet','office') NOT NULL DEFAULT 'room',
  `building` int unsigned DEFAULT NULL,
  `details` int unsigned DEFAULT NULL,
  `location` int unsigned DEFAULT NULL,
  `floor` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_rooms_buildings` (`building`),
  KEY `FK_rooms_locations` (`location`),
  KEY `FK_rooms_floors` (`floor`),
  KEY `FK_rooms_details` (`details`),
  CONSTRAINT `FK_rooms_buildings` FOREIGN KEY (`building`) REFERENCES `buildings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_rooms_details` FOREIGN KEY (`details`) REFERENCES `details` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_rooms_floors` FOREIGN KEY (`floor`) REFERENCES `floors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_rooms_locations` FOREIGN KEY (`location`) REFERENCES `locations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.rooms: ~4 rows (approximately)
REPLACE INTO `rooms` (`id`, `enabled`, `type`, `building`, `details`, `location`, `floor`) VALUES
	(5, 1, 'room', 7, 6, 36, 3),
	(6, 1, 'room', 10, 11, 41, 6),
	(7, 1, 'room', 9, 12, 43, 7),
	(9, 1, 'room', 8, 13, 46, 3);

-- Dumping structure for table setu_map.search
CREATE TABLE IF NOT EXISTS `search` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `search` varchar(50) DEFAULT '0',
  `location` int unsigned DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__locations` (`location`),
  CONSTRAINT `FK__locations` FOREIGN KEY (`location`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.search: ~0 rows (approximately)

-- Dumping structure for table setu_map.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created` date DEFAULT NULL,
  `campus` int unsigned DEFAULT NULL,
  `privileges` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_users_campuses` (`campus`),
  KEY `FK_users_privileges` (`privileges`),
  CONSTRAINT `FK_users_campuses` FOREIGN KEY (`campus`) REFERENCES `campuses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_users_privileges` FOREIGN KEY (`privileges`) REFERENCES `privileges` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table setu_map.users: ~1 rows (approximately)
REPLACE INTO `users` (`id`, `enabled`, `email`, `name`, `password`, `created`, `campus`, `privileges`) VALUES
	(8, 1, 'admin@admin.com', 'Admin', 'pass', '2023-09-04', 1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
