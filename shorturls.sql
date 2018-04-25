-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2018 at 04:34 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shorturls`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `code` varchar(12) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100000007 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `url`, `code`, `created`) VALUES
(100000000, 'http://www.google.com', 'goog123', '2014-12-12 14:27:33'),
(100000001, 'http://www.google.co.uk', '1njcht', '2014-12-12 14:46:16'),
(100000002, 'https://github.com/mikecao/shorty/blob/master/shorty.php', '1njchu', '2018-04-24 14:50:47'),
(100000003, 'http://www.eggslab.net/how-to-make-basic-url-shortener-in-php-and-mysqli/', '1njchv', '2018-04-24 14:52:20'),
(100000004, 'http://devlup.com/programming/php/create-url-shortener-php/853/', '1njchw', '2018-04-24 15:47:43'),
(100000005, 'https://www.startutorial.com/articles/view/how-to-create-your-own-url-shortening-service', '1njchx', '2018-04-24 15:48:15'),
(100000006, 'https://www.quora.com/in/How-can-I-make-a-URL-shortener-with-PHP', '1njchy', '2018-04-24 15:50:16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
