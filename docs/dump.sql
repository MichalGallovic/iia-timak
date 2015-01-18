# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.40-0ubuntu0.12.04.1)
# Database: iiaTimak
# Generation Time: 2015-01-18 13:53:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table consultations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `consultations`;

CREATE TABLE `consultations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `note` text NOT NULL,
  `day` tinyint(6) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `room_id` int(11) unsigned NOT NULL,
  `subject_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_consultations_subjects` (`subject_id`),
  KEY `fk_consultations_users` (`user_id`),
  KEY `fk_consultations_rooms` (`room_id`),
  CONSTRAINT `fk_consultations_rooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_consultations_subjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_consultations_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `consultations` WRITE;
/*!40000 ALTER TABLE `consultations` DISABLE KEYS */;

INSERT INTO `consultations` (`id`, `start_time`, `end_time`, `note`, `day`, `user_id`, `room_id`, `subject_id`)
VALUES
	(1,'11:11:00','12:00:00','trololo\n',2,40,2,4),
	(2,'08:00:00','12:00:00','som jak pan , v kabinete sam',1,42,1,8),
	(7,'16:00:00','17:00:00','pijeme fernet cez internet',4,42,5,9),
	(8,'16:56:00','17:46:00','satan je nas pan',3,54,5,6);

/*!40000 ALTER TABLE `consultations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table exercises
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exercises`;

CREATE TABLE `exercises` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject_id` int(11) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `room_id` int(11) unsigned NOT NULL,
  `day` tinyint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exercises_users` (`user_id`),
  KEY `fk_exercises_rooms` (`room_id`),
  KEY `fk_exercises_subjects` (`subject_id`),
  CONSTRAINT `fk_exercises_rooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_exercises_subjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_exercises_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `exercises` WRITE;
/*!40000 ALTER TABLE `exercises` DISABLE KEYS */;

INSERT INTO `exercises` (`id`, `start_time`, `end_time`, `subject_id`, `user_id`, `room_id`, `day`)
VALUES
	(1,'00:00:10','00:00:11',6,51,2,2),
	(3,'10:00:00','12:00:00',4,50,3,3),
	(7,'08:00:00','09:00:00',6,41,1,1);

/*!40000 ALTER TABLE `exercises` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `code`, `name`)
VALUES
	(1,'OAMM','Oddelenie aplikovanej mechaniky a mechatroniky'),
	(2,'OIKR','Oddelenie informačných, komunikačných a riadiacich systémov'),
	(3,'OAEM','Oddelenie elektroniky, mikropočítačov a PLC systémov'),
	(4,'OEAP','Oddelenie E-mobility, automatizácie a pohonov'),
	(5,'JBMNT','Oddelenie Patrika Vrbovskeho');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lectures
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lectures`;

CREATE TABLE `lectures` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) unsigned NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `room_id` int(11) unsigned NOT NULL,
  `day` tinyint(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lectures_rooms` (`room_id`),
  KEY `fk_lectures_subjects` (`subject_id`),
  KEY `fk_lectures_users` (`user_id`),
  CONSTRAINT `fk_lectures_rooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lectures_subjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lectures_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `lectures` WRITE;
/*!40000 ALTER TABLE `lectures` DISABLE KEYS */;

INSERT INTO `lectures` (`id`, `subject_id`, `start_time`, `end_time`, `user_id`, `room_id`, `day`)
VALUES
	(1,5,'11:00:00','12:00:00',40,4,1),
	(2,8,'10:00:00','11:00:00',42,1,2),
	(3,10,'16:06:00','16:56:00',51,7,5),
	(4,5,'00:00:00','00:00:00',38,1,6);

/*!40000 ALTER TABLE `lectures` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `create` tinyint(1) NOT NULL,
  `read` tinyint(1) NOT NULL,
  `update` tinyint(1) NOT NULL,
  `delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `create`, `read`, `update`, `delete`)
VALUES
	(1,'admin',1,1,1,1),
	(2,'teacher',1,1,1,1),
	(3,'nasratySysAdmin',1,1,1,1),
	(4,'bejzikovy typco',0,0,0,0);

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;

INSERT INTO `rooms` (`id`, `name`)
VALUES
	(1,'CD150'),
	(2,'DL010'),
	(3,'CD300'),
	(4,'D406'),
	(5,'CPU-a'),
	(6,'D405'),
	(7,'dungeon');

/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table subjects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `acronym` varchar(10) NOT NULL DEFAULT '',
  `lecture_duration` int(11) NOT NULL,
  `exercise_duration` int(11) NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '',
  `term` varchar(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;

INSERT INTO `subjects` (`id`, `code`, `name`, `acronym`, `lecture_duration`, `exercise_duration`, `color`, `term`)
VALUES
	(4,'38171_3I','Internetové a intranetové aplikácie','IIA',3,2,'#B69BE0','W'),
	(5,'30115_3B','Teória automatického riadenia','TAR1',2,3,'#E391AF','W'),
	(6,'39901_3B','Úvod do inžinierstva','UI',2,2,'#91E3C5','W'),
	(7,'37115_3I','Teória automatického riadenia 3','TAR3',2,3,'#E3BF91','S'),
	(8,'33115_3B','Tvorba internetových aplikácií','TIA',2,2,'#98BF49','S'),
	(9,'33171_3B','Nelineárne systémy','NS',2,3,'#BF7049','S'),
	(10,'666','Satanisticke ritualy','SR',3,2,'#666','W');

/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned DEFAULT NULL,
  `google` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `title1` varchar(255) DEFAULT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `group_id` int(11) unsigned DEFAULT NULL,
  `ldap` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_users_roles` (`role_id`),
  KEY `fk_users_groups` (`group_id`),
  CONSTRAINT `fk_users_groups` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role_id`, `google`, `firstname`, `surname`, `title1`, `title2`, `group_id`, `ldap`)
VALUES
	(37,NULL,NULL,'Katarína','Žáková','Doc. Ing.','PhD.',2,'zakova'),
	(38,NULL,NULL,'Mikuláš','Huba','Prof. Ing.','PhD.',4,'huba'),
	(39,NULL,NULL,'Danica','Rosinová','Doc. Ing.','PhD.',2,'rosinova'),
	(40,NULL,NULL,'Pavol','Bisták','Ing.','PhD.',4,'bistak'),
	(41,NULL,NULL,'Alena','Kozáková','Doc. Ing.','PhD.',2,'kozakova'),
	(42,NULL,NULL,'Peter','Ťapák','Ing.','PhD.',4,'tapak'),
	(49,1,NULL,'Michal','Gallovič','Bc.',NULL,NULL,'xgallovicm'),
	(50,1,NULL,'Jakub','Fornádel','Bc.',NULL,NULL,'xfornadelj'),
	(51,1,NULL,'Igor','Packo','Bc',NULL,NULL,'xpacko'),
	(52,1,NULL,'Jakub','Hoblík','Bc',NULL,NULL,'xhoblikj'),
	(54,3,'foxyzv','Igorko','Packo','krasavec','najsamvacsi',5,'xpacko'),
	(55,3,'palo','Pavol','Habera','naj spevacik','zapredany',5,'ldap'),
	(56,4,'a','s','d','dw','r',1,'e');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
