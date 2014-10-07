-- phpMyAdmin SQL Dump
-- version 2.11.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2011 at 08:41 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cw1011`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(11) NOT NULL auto_increment,
  `vehicle_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `good` varchar(40) NOT NULL,
  `status_id` int(11) default '1',
  `notes` varchar(400) default NULL,
  `referred_as` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `vehicle_id`, `venue_id`, `date`, `good`, `status_id`, `notes`, `referred_as`) VALUES
(1, 1, 1, '2010-11-10', 'beverage', 1, 'in time, as usual', '1'),
(2, 2, 2, '2010-11-12', 'beverage', 2, 'great delivery, thanks', '2'),
(3, 4, 3, '2011-01-08', 'software', 4, 'great system', '3'),
(4, 2, 5, '2010-12-27', 'beverage', 1, 'whatever delivery', '4');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL auto_increment,
  `referred_as` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `referred_as`) VALUES
(1, 'booked'),
(2, 'in progress'),
(3, 'delivered'),
(4, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(40) default NULL,
  `category` varchar(40) default NULL,
  `address` varchar(40) default NULL,
  `town` varchar(40) default NULL,
  `phone` varchar(40) default NULL,
  `referred_as` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `category`, `address`, `town`, `phone`, `referred_as`) VALUES
(1, 'Coca Cola', 'Beverage', '1, Oxford Street', 'Reading', '018732423', 'Coca Cola'),
(2, 'Microsoft', 'ITC', '3, Cambridge Road', 'Reading', '057463456', 'Microsoft'),
(3, 'Oracle', 'ITC', '5, Leicester Avenue', 'London', '020212121', 'Oracle'),
(4, 'Bromuri', 'Chemicals', '3, Whatever Close', 'Manchester', '0161233212', 'Bromuri');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(11) NOT NULL auto_increment,
  `make` varchar(40) default NULL,
  `model` varchar(40) default NULL,
  `color` varchar(40) default NULL,
  `supplier_id` int(11) NOT NULL,
  `referred_as` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `make`, `model`, `color`, `supplier_id`, `referred_as`) VALUES
(1, 'Fiat', 'Multipla', 'Green', 1, 'AC54 3PL'),
(2, 'Citroen', 'C5', 'White', 1, 'R323 KLE'),
(3, 'Fiat', 'Ducato', 'Blue', 2, 'S65 KYP'),
(4, 'Ford', 'Transit', 'Red', 1, 'FORD CC 1');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(40) NOT NULL,
  `site` varchar(40) NOT NULL,
  `sport` varchar(40) NOT NULL,
  `referred_as` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `name`, `site`, `sport`, `referred_as`) VALUES
(1, 'Tatami 1', 'Martial Arts', 'Judo', 'Martial Arts'),
(2, 'Tatami 2', 'Martial Arts', 'Judo', 'Martial Arts'),
(3, 'Football pitch', 'East Site', 'Football', 'Stadium'),
(4, 'Tennis 1', 'Tennis Courts', 'Tennis', 'Tennis Courts'),
(5, 'Tennis 2', 'Tennis Courts', 'Tennis', 'Tennis Courts'),
(6, 'Basket Ball 1', 'Indoor Team Games', 'Basket Ball', 'Basket');
