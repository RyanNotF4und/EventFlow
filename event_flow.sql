-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2023 at 02:12 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_flow`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `thumb_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `state` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `date_event` date NOT NULL,
  `published_date` date NOT NULL,
  `views` int NOT NULL,
  `checked` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `thumb_path`, `description`, `state`, `city`, `adress`, `date_event`, `published_date`, `views`, `checked`) VALUES
(1, 2, 'Evento', 'assets/Design_sem_nome.png', 'Descrição', 'MG', 'Pará de Minas', 'Endereço', '2023-03-15', '2023-03-09', 0, 'no'),
(2, 1, 'Evento', 'assets/Design_sem_nome.png', 'Descrição', 'MG', 'Pará de Minas', 'Endereço', '2023-03-15', '2023-03-09', 0, 'no'),
(3, 1, 'Evento', 'assets/Design_sem_nome.png', 'Descrição', 'MG', 'Pará de Minas', 'Endereço', '2023-03-15', '2023-03-09', 5, 'no'),
(4, 1, 'Evento', 'assets/Design_sem_nome.png', 'Descrição', 'MG', 'Pará de Minas', 'Endereço', '2023-03-15', '2023-03-09', 1, 'no'),
(5, 1, 'Evento', 'assets/Design_sem_nome.png', 'Descrição', 'MG', 'Pará de Minas', 'Endereço', '2023-03-15', '2023-03-09', 1, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `pageview`
--

DROP TABLE IF EXISTS `pageview`;
CREATE TABLE IF NOT EXISTS `pageview` (
  `page_id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pageview`
--

INSERT INTO `pageview` (`page_id`, `user_ip`) VALUES
('4', '::1'),
('3', '::1'),
('5', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `psw` varchar(255) DEFAULT NULL,
  `ImgPerfil` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `uname`, `psw`, `ImgPerfil`) VALUES
(1, 'a@a.a', 'aaaa', '123', 'assets/user-128.svg'),
(2, 'aaa@aaa', 'a5', '1', 'assets/user-128.svg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
