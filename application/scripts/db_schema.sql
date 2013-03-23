DROP TABLE IF EXISTS `ass3_captcha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ass3_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word_idx` (`word`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ass2_sessions`
--

DROP TABLE IF EXISTS `ass3_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ass3_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ass2_users`
--

DROP TABLE IF EXISTS `ass3_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ass3_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `password` char(160) DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime DEFAULT NULL,
  `date_activated` datetime DEFAULT NULL,
  `is_locked` tinyint(1) DEFAULT '0',
  `num_of_failed_logins` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `ass3_activation_codes`;

CREATE TABLE `ass3_activation_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `code` varchar(40) DEFAULT NULL,
  PRIMARY KEY (id)
)

DROP TABLE IF EXISTS `ass3_stops`;

CREATE TABLE `ass3_stops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11),
  `name` varchar(256),
  `description` varchar(256),
  `longitude` decimal(10,6),
  `latitude` decimal(10,6),
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS `ass3_locations`;

CREATE TABLE `ass3_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256),
  `longitude` decimal(10,6),
  `latitude` decimal(10,6),
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS `ass3_user_stops`;

CREATE TABLE `ass3_user_stops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stop_id` int(11) NOT NULL,
  PRIMARY KEY (id)
);
