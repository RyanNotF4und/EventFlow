DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(45) NOT NULL,
  `thumb_path` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `state` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `date_event` date NOT NULL,
  `final_date_event` date NOT NULL,
  `published_date` date NOT NULL,
  `views` int NOT NULL,
  `checked` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `pageview`;
CREATE TABLE IF NOT EXISTS `pageview` (
  `page_id` varchar(45) NOT NULL,
  `user_ip` varchar(45) NOT NULL
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `ImgPerfil` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);