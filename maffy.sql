-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2023 at 08:21 AM
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
  `assessment_id` int NOT NULL AUTO_INCREMENT COMMENT 'The assessment id to identify each assesment.	',
  `course_id` int NOT NULL COMMENT 'The reference course id from the course list table	',
  `assessment_title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The assessment title to display',
  `assessment_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The assessment content to display.',
  `assessment_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'The assessment code provided by the teacher',
  `assessment_date_posted` date NOT NULL COMMENT 'The assessment date posted to display.',
  PRIMARY KEY (`assessment_id`),
  UNIQUE KEY `assessment_id` (`assessment_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int NOT NULL AUTO_INCREMENT COMMENT 'The unique chat id to identify each chat	',
  `friend_list_id` int NOT NULL COMMENT 'The reference friend list id from the friend list table	',
  `chat_content` varchar(255) NOT NULL COMMENT 'The chat content to display',
  `chat_datetime` datetime NOT NULL COMMENT 'The chat date/time to display',
  PRIMARY KEY (`chat_id`),
  KEY `friend_list_id` (`friend_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int NOT NULL AUTO_INCREMENT COMMENT 'The unique comment id from the user',
  `assessment_id` int NOT NULL COMMENT 'The reference assessment id from the assessment table	',
  `user_id` int NOT NULL COMMENT 'The reference user id from the user table	',
  `comment_word` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The comment_word to display',
  `comment_date_posted` date NOT NULL COMMENT 'The comment posted date display',
  PRIMARY KEY (`comment_id`),
  KEY `assessment_id` (`assessment_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int NOT NULL AUTO_INCREMENT COMMENT 'The course id to identify each course.	',
  `user_id` int NOT NULL COMMENT 'The reference user id from the user table',
  `course_title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The course title to display\r\n',
  `course_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The course description to display',
  `course_date_posted` date NOT NULL COMMENT 'The course posted date display',
  `course_image` longblob NOT NULL COMMENT 'The course image display',
  `course_click` int NOT NULL COMMENT 'The course_click display the number of click from user',
  `course_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'course status\r\n1 = active\r\n2 = deactive (only viewable by admin and self author',
  PRIMARY KEY (`course_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int NOT NULL AUTO_INCREMENT COMMENT 'The unique feedback id to contain feedback details from the user',
  `user_id` int NOT NULL COMMENT 'The reference user id from the user table\r\n',
  `feedback_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The feedback content from the user to comment',
  PRIMARY KEY (`feedback_id`),
  UNIQUE KEY `feedback_id` (`feedback_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend_list`
--

DROP TABLE IF EXISTS `friend_list`;
CREATE TABLE IF NOT EXISTS `friend_list` (
  `friend_list_id` int NOT NULL AUTO_INCREMENT COMMENT 'The unique friend list id to content user friend list',
  `first_user_id` int NOT NULL COMMENT 'The reference for first user id',
  `second_user_id` int NOT NULL COMMENT 'The reference for second user id',
  `friend_status` int NOT NULL COMMENT 'friend_status\r\n- 1 = pending friend request\r\n- 2 = is friend',
  PRIMARY KEY (`friend_list_id`),
  UNIQUE KEY `friend_list_id` (`friend_list_id`),
  KEY `first_user_id` (`first_user_id`,`second_user_id`),
  KEY `second_user_id` (`second_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `note_id` int NOT NULL AUTO_INCREMENT COMMENT 'The note id to identify the note for each assessment',
  `assessment_id` int NOT NULL COMMENT 'The assessment id to reference assessment table',
  `note_title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The note title to display',
  `note_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The note content for the user to read',
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `note_id` (`note_id`),
  KEY `assessment_id` (`assessment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `practice`
--

DROP TABLE IF EXISTS `practice`;
CREATE TABLE IF NOT EXISTS `practice` (
  `practice_id` int NOT NULL AUTO_INCREMENT COMMENT 'The unique id to identify the practice id for each assessment',
  `assessment_id` int NOT NULL COMMENT 'The asssessment id to reference the assessment table data',
  `practice_title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The practice title to display',
  `practice_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The practice description to display',
  `practice_question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The practice question to ask the user',
  `practice_answer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The practice answer that match the answer with the question',
  PRIMARY KEY (`practice_id`),
  UNIQUE KEY `practice_id` (`practice_id`),
  KEY `assessment_id` (`assessment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE IF NOT EXISTS `privilege` (
  `privilege_id` int NOT NULL AUTO_INCREMENT COMMENT 'The unique id to identify user privilege',
  `user_privilege` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The data to identify user privilege ',
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'The unique code to identify user account ID',
  `privilege_id` int NOT NULL COMMENT 'The ID that identify user privilege',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The unique username for each user as their authentication',
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'The password for each user as their authentication',
  `user_image` longblob COMMENT 'User account image as their profile image',
  `user_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'A place to allow the user to store their bio or description ',
  `user_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'The unique email for the user',
  `user_last_login` datetime DEFAULT NULL COMMENT 'A section to record user last login time',
  `user_support_doc` longblob COMMENT 'This data contain the supporting document for the teacher to upload their professional document to be a teacher',
  `user_active` int NOT NULL DEFAULT '1' COMMENT 'User account active\r\n0 = pending approval\r\n1 = active\r\n2 = deactive by admin \r\n',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `privilege_id` (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
