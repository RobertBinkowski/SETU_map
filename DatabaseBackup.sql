/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP DATABASE IF EXISTS `setu_map`;
CREATE DATABASE IF NOT EXISTS `setu_map` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `setu_map`;

DROP TABLE IF EXISTS `buildings`;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `buildings`;
INSERT INTO `buildings` (`id`, `enabled`, `campus`, `location`, `details`) VALUES
	(1, 1, 1, 1, 4),
	(2, 1, 1, 2, 4),
	(3, 1, 1, 3, 4),
	(4, 1, 1, 4, 4),
	(5, 1, 1, 5, 4),
	(6, 1, 1, 6, 4);

DROP TABLE IF EXISTS `campuses`;
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
  CONSTRAINT `FK_campuses_coordinates_2` FOREIGN KEY (`entrance`) REFERENCES `coordinates` (`id`),
  CONSTRAINT `FK_campuses_details` FOREIGN KEY (`details`) REFERENCES `details` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `campuses`;
INSERT INTO `campuses` (`id`, `enabled`, `coordinates`, `entrance`, `details`) VALUES
	(1, 1, 1, 7, 1),
	(2, 1, 2, NULL, 2);

DROP TABLE IF EXISTS `connections`;
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `connections`;
INSERT INTO `connections` (`id`, `enabled`, `location_one`, `location_two`) VALUES
	(1, 1, 1, 2),
	(2, 1, 2, 3),
	(3, 1, 3, 4),
	(4, 1, 4, 1),
	(5, 1, 2, 5),
	(6, 1, 1, 4),
	(7, 1, 4, 5),
	(9, 1, 15, 16),
	(10, 1, 16, 17),
	(11, 1, 17, 18),
	(12, 1, 18, 19),
	(13, 1, 19, 20),
	(14, 1, 20, 21),
	(15, 1, 20, 22),
	(16, 1, 21, 1),
	(17, 1, 22, 1),
	(18, 1, 7, 15);

DROP TABLE IF EXISTS `coordinates`;
CREATE TABLE IF NOT EXISTS `coordinates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `altitude` double DEFAULT '0',
  `zoom` double DEFAULT '18',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `coordinates`;
INSERT INTO `coordinates` (`id`, `latitude`, `longitude`, `altitude`, `zoom`) VALUES
	(1, 52.82735955046092, -6.935937131753209, 0, 18),
	(2, 52.33433625797347, -6.471905235004469, 0, 18),
	(3, 52.828140836704954, -6.936068163719749, 0, 18),
	(4, 52.82770549485796, -6.936279074280246, 0, 18),
	(5, 52.82662290194261, -6.935216919584428, 2, 18),
	(6, 52.82858710749156, -6.936590210484819, 0, 18),
	(7, 52.82851256005763, -6.936257616590168, 0, 18),
	(8, 52.82818195685255, -6.9362200656665784, 0, 18),
	(9, 52.82748184764294, -6.936579481649507, 0, 18),
	(10, 52.827300336006246, -6.936364904943281, 0, 18),
	(11, 52.82719013214256, -6.935656801812735, 0, 18),
	(12, 52.826930827831234, -6.935678259483358, 0, 18),
	(13, 52.826878966783255, -6.935211555147317, 0, 18),
	(14, 52.82678820980034, -6.935308114665117, 0, 18),
	(15, 52.827972031625244, -6.935568012804313, 0, 18),
	(16, 52.826895927980146, -6.936445095107446, 0, 18),
	(17, 52.827020718473406, -6.936761595744542, 0, 18),
	(18, 52.826999649973715, -6.936227836195543, 0, 18);

DROP TABLE IF EXISTS `details`;
CREATE TABLE IF NOT EXISTS `details` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT '0',
  `abbreviation` varchar(1000) DEFAULT '0',
  `info` text,
  `size` double DEFAULT '0',
  `src` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `details`;
INSERT INTO `details` (`id`, `name`, `abbreviation`, `info`, `size`, `src`) VALUES
	(1, 'It Carlow', 'SETU', 'Some Info', 1231, 'random.png1'),
	(2, 'Wexford', 'SETU', NULL, 0, NULL),
	(3, 'A313', 'Unum Room', 'Unum Room', 0, 'images/image.png'),
	(4, 'LRC', 'Liblary', NULL, 0, NULL);

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `os` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `device`;

DROP TABLE IF EXISTS `floors`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `floors`;
INSERT INTO `floors` (`id`, `enabled`, `floor`, `building`, `details`) VALUES
	(1, 1, 1, 1, 1),
	(2, 1, 3, 1, NULL);

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `images`;
INSERT INTO `images` (`id`, `src`, `name`) VALUES
	(1, 'images/image.png', NULL);

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `coordinates` int unsigned DEFAULT NULL,
  `enabled` tinyint NOT NULL DEFAULT '1',
  `type` enum('Location','Stairs','Elevator') DEFAULT 'Location',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `coordinates` (`coordinates`),
  CONSTRAINT `coordinates` FOREIGN KEY (`coordinates`) REFERENCES `coordinates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `locations`;
INSERT INTO `locations` (`id`, `coordinates`, `enabled`, `type`) VALUES
	(1, 3, 1, 'Location'),
	(2, 4, 1, 'Location'),
	(3, 15, 1, 'Location'),
	(4, 16, 1, 'Location'),
	(5, 17, 1, 'Location'),
	(6, 18, 1, 'Location'),
	(7, 5, 1, 'Location'),
	(15, 7, 1, 'Location'),
	(16, 8, 1, 'Location'),
	(17, 9, 1, 'Location'),
	(18, 10, 1, 'Location'),
	(19, 11, 1, 'Location'),
	(20, 12, 1, 'Location'),
	(21, 13, 1, 'Stairs'),
	(22, 14, 1, 'Location');

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `type` enum('Warning','Error','Info','General') DEFAULT 'General',
  `info` longtext,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `device` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_logs_device` (`device`),
  CONSTRAINT `FK_logs_device` FOREIGN KEY (`device`) REFERENCES `device` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11504 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `logs`;
INSERT INTO `logs` (`id`, `title`, `type`, `info`, `date`, `device`) VALUES
	(11503, 'asddsa', 'General', NULL, '2023-08-08 23:26:32', NULL);

DROP TABLE IF EXISTS `privileges`;
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

DELETE FROM `privileges`;
INSERT INTO `privileges` (`id`, `name`, `users`, `logs`, `searches`, `details`, `images`) VALUES
	(1, 'Admin', 3, 3, 3, 3, 3);

DROP TABLE IF EXISTS `privilege_values`;
CREATE TABLE IF NOT EXISTS `privilege_values` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `privilege_values`;
INSERT INTO `privilege_values` (`id`, `value`) VALUES
	(1, 'none'),
	(2, 'read'),
	(3, 'write');

DROP TABLE IF EXISTS `rooms`;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `rooms`;
INSERT INTO `rooms` (`id`, `enabled`, `type`, `building`, `details`, `location`, `floor`) VALUES
	(1, 1, 'room', 6, 3, 7, 2),
	(2, 1, 'room', 5, 1, 1, 1),
	(3, 1, 'room', 2, 2, 3, 1);

DROP TABLE IF EXISTS `search`;
CREATE TABLE IF NOT EXISTS `search` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `search` varchar(50) DEFAULT '0',
  `location` int unsigned DEFAULT NULL,
  `device` int unsigned DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__locations` (`location`),
  KEY `FK__device` (`device`),
  CONSTRAINT `FK__device` FOREIGN KEY (`device`) REFERENCES `device` (`id`),
  CONSTRAINT `FK__locations` FOREIGN KEY (`location`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `search`;

DROP TABLE IF EXISTS `users`;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELETE FROM `users`;
INSERT INTO `users` (`id`, `enabled`, `email`, `name`, `password`, `created`, `campus`, `privileges`) VALUES
	(1, 1, 'admin@test.com', 'Admin', 'pass', '2023-01-08', 1, 1),
	(2, 1, 'test@test.com', '', 'pass', '2023-01-08', 1, NULL),
	(6, 1, 'test@test.com', '', 'pass', NULL, 1, NULL),
	(7, 1, 'test@test.com', '', 'pass', NULL, 1, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
