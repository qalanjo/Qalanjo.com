-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2011 at 04:00 PM
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
-- Table structure for table `gift_avail_transaction_items`
--

CREATE TABLE IF NOT EXISTS `gift_avail_transaction_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gift_avail_transaction_id` int(11) DEFAULT NULL,
  `gift_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Dumping data for table `gift_avail_transaction_items`
--

