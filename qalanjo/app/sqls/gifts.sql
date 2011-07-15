-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2011 at 03:58 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qalanjo4`
--

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE IF NOT EXISTS `gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `gift_type_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `picture_path` varchar(255) DEFAULT '',
  `created` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Dumping data for table `gifts`
--

