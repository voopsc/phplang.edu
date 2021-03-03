-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 03, 2021 at 11:06 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voopsc`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_description` text DEFAULT NULL,
  `post_text` text DEFAULT NULL,
  `post_button_text` varchar(255) DEFAULT NULL,
  `post_date` varchar(255) DEFAULT NULL,
  `post_author` varchar(255) DEFAULT NULL,
  `post_category` int(22) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 1,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `post_title`, `post_description`, `post_text`, `post_button_text`, `post_date`, `post_author`, `post_category`, `url`, `sort_order`, `status`) VALUES
(1, 'Post one', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna\r\n                aliqua. Ut enim ad minim veniam, quis nostrud exercitation\r\n                ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n                 Duis aute irure dolor in reprehenderit in voluptate velit\r\n                 esse cillum dolore eu fugiat nulla pariatur. Excepteur sint\r\n                 occaecat cupidatat non proident, sunt in culpa qui officia\r\n                 deserunt mollit anim id est laborum', NULL, 'More...', NULL, NULL, NULL, 'post-one', 1, 1),
(2, 'Post one', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna\r\n                aliqua. Ut enim ad minim veniam, quis nostrud exercitation\r\n                ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n                 Duis aute irure dolor in reprehenderit in voluptate velit\r\n                 esse cillum dolore eu fugiat nulla pariatur. Excepteur sint\r\n                 occaecat cupidatat non proident, sunt in culpa qui officia\r\n                 deserunt mollit anim id est laborum', NULL, 'More...', NULL, NULL, NULL, 'post-one', 1, 1),
(3, 'Post one', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna\r\n                aliqua. Ut enim ad minim veniam, quis nostrud exercitation\r\n                ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n                 Duis aute irure dolor in reprehenderit in voluptate velit\r\n                 esse cillum dolore eu fugiat nulla pariatur. Excepteur sint\r\n                 occaecat cupidatat non proident, sunt in culpa qui officia\r\n                 deserunt mollit anim id est laborum', NULL, 'More...', NULL, NULL, NULL, 'post-one', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_role` int(11) NOT NULL DEFAULT 1,
  `is_active` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
