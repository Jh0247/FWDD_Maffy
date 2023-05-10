-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 01, 2023 at 02:21 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maffy`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

DROP TABLE IF EXISTS `assessment`;
CREATE TABLE IF NOT EXISTS `assessment` (
  `assessment_id` int NOT NULL AUTO_INCREMENT,
  `course_id` int NOT NULL,
  `assessment_title` varchar(50) NOT NULL,
  `assessment_content` text NOT NULL,
  `assessment_date_posted` date NOT NULL,
  PRIMARY KEY (`assessment_id`),
  UNIQUE KEY `assessment_id` (`assessment_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int NOT NULL AUTO_INCREMENT,
  `friend_list_id` int NOT NULL,
  `chat_content` int NOT NULL,
  `chat_datetime` datetime NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `friend_list_id` (`friend_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `assessment_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment_word` varchar(255) NOT NULL,
  `comment_date_posted` date NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `assessment_id` (`assessment_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `course_title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_date_posted` date NOT NULL,
  `course_image` longblob NOT NULL,
  `course_click` int NOT NULL,
  `course_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`course_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `feedback_content` text NOT NULL,
  PRIMARY KEY (`feedback_id`),
  UNIQUE KEY `feedback_id` (`feedback_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend_list`
--

DROP TABLE IF EXISTS `friend_list`;
CREATE TABLE IF NOT EXISTS `friend_list` (
  `friend_list_id` int NOT NULL AUTO_INCREMENT,
  `first_user_id` int NOT NULL,
  `second_user_id` int NOT NULL,
  `friend_status` int NOT NULL,
  PRIMARY KEY (`friend_list_id`),
  UNIQUE KEY `friend_list_id` (`friend_list_id`),
  KEY `first_user_id` (`first_user_id`,`second_user_id`),
  KEY `second_user_id` (`second_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `note_id` int NOT NULL AUTO_INCREMENT,
  `assessment_id` int NOT NULL,
  `note_title` varchar(50) NOT NULL,
  `note_content` text NOT NULL,
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `note_id` (`note_id`),
  KEY `assessment_id` (`assessment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `practice`
--

DROP TABLE IF EXISTS `practice`;
CREATE TABLE IF NOT EXISTS `practice` (
  `practice_id` int NOT NULL AUTO_INCREMENT,
  `assessment_id` int NOT NULL,
  `practice_title` varchar(50) NOT NULL,
  `practice_desc` varchar(255) NOT NULL,
  `practice_question` varchar(255) NOT NULL,
  `practice_answer` varchar(50) NOT NULL,
  PRIMARY KEY (`practice_id`),
  UNIQUE KEY `practice_id` (`practice_id`),
  KEY `assessment_id` (`assessment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE IF NOT EXISTS `privilege` (
  `privilege_id` int NOT NULL AUTO_INCREMENT,
  `user_privilege` varchar(10) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`privilege_id`, `user_privilege`) VALUES
(1, 'admin'),
(2, 'teacher'),
(3, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `privilege_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_image` longblob,
  `user_desc` text,
  `user_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_last_login` datetime DEFAULT NULL,
  `user_support_doc` longblob,
  `user_active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `privilege_id` (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `privilege_id`, `username`, `password`, `user_image`, `user_desc`, `user_email`, `user_last_login`, `user_support_doc`, `user_active`) VALUES
(1, 1, 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessment`
--
ALTER TABLE `assessment`
  ADD CONSTRAINT `assessment_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`friend_list_id`) REFERENCES `friend_list` (`friend_list_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`assessment_id`) REFERENCES `assessment` (`assessment_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `friend_list`
--
ALTER TABLE `friend_list`
  ADD CONSTRAINT `friend_list_ibfk_1` FOREIGN KEY (`first_user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `friend_list_ibfk_2` FOREIGN KEY (`second_user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`assessment_id`) REFERENCES `assessment` (`assessment_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `practice`
--
ALTER TABLE `practice`
  ADD CONSTRAINT `practice_ibfk_1` FOREIGN KEY (`assessment_id`) REFERENCES `assessment` (`assessment_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`privilege_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
