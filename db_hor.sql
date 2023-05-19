-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 21, 2017 at 06:16 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- Data Model Inspiration:
-- https://vertabelo.com/blog/a-database-model-for-a-hotel-reservation-booking-app-and-channel-manager/

--
-- Database: `db_hor`
--

-- --------------------------------------------------------

-- #######################################################
-- ##################### HOMESTAYS #######################
-- #######################################################

-- --------------------------------------------------------

--
-- Table structure for table `homestay`
--

CREATE TABLE IF NOT EXISTS `homestay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `homestay_name` varchar(128) NOT NULL,
  `description` text,
  `city_id` int(11) NOT NULL,
  `is_open` boolean NOT NULL,
  `category_id` int(11) NOT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `photo` varchar(128),
  PRIMARY KEY (`id`),
  KEY (`city_id`),
  KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- NOTE:
-- use CHARSET=latin1 if you don't need to support non-Latin1 languages
-- reference: https://stackoverflow.com/questions/12449336/utf-8-vs-latin1

--
-- Dumping data for table `homestay`
--

INSERT INTO `homestay` (`id`, `homestay_name`, `description`, `city_id`, `is_open`, `category_id`, `current_price`, `photo`) VALUES
(1, 'Amaryllis', '', 1, 1, 1, 200.00, '1.jpg'),
(2, 'Bougenville', '', 1, 1, 1, 200.00, '2.jpg'),
(3, 'Celosia', '', 1, 1, 1, 200.00, '3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'placeholder category');

-- --------------------------------------------------------

-- #######################################################
-- #################### RESERVATIONS #####################
-- #######################################################

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_id` int(11) NOT NULL,
  `homestay_id` int(11) NOT NULL,
  `person_count` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(128) NOT NULL,
  `ts_created` timestamp NOT NULL,
  `ts_updated` timestamp NOT NULL,
  `discount_percent` decimal(5,2),
  `total_price` decimal(10,2) NOT NULL,
  `proof_of_payment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`guest_id`),
  KEY (`homestay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `guest_id`, `homestay_id`, `person_count`, `start_date`, `end_date`, `status`, `ts_created`, `ts_updated`, `discount_percent`, `total_price`, `proof_of_payment`) VALUES
(1, 1, 1, 2, '2008-11-11', '2008-11-12', 'Pending', '2008-11-11 13:23:44', '2008-11-11 13:23:44', 0.0, 200.00, 'pop1.pdf'),
(2, 2, 2, 2, '2008-11-11', '2008-11-12', 'Check In', '2008-11-11 13:23:44', '2008-11-11 13:23:44', 0.0, 200.00, 'pop2.pdf'),
(3, 3, 3, 2, '2008-11-11', '2008-11-12', 'Check Out', '2008-11-11 13:23:44', '2008-11-11 13:23:44', 0.0, 200.00, 'pop3.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `homestay_reserved`
--

-- CREATE TABLE `homestay_reserved` (
--   `id` int(11) NOT NULL,
--   `reservation_id` int(11) NOT NULL,
--   `homestay_id` int(11) NOT NULL,
--   `price` decimal(10,2) NOT NULL,
--   PRIMARY KEY (`id`),
--   KEY (`reservation_id`),
--   KEY (`homestay_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homestay_reserved`
--

-- INSERT INTO `homestay_reserved` (`id`, `reservation_id`, `homestay_id`, `price`) VALUES
-- (1, 2, 1, 100.00),
-- (2, 2, 2, 180.00);

-- --------------------------------------------------------

-- #######################################################
-- ###################### GUESTS #########################
-- #######################################################

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255),
  `address` varchar(255),
  `details` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `full_name`, `email`, `phone`, `address`, `details`) VALUES
(1, 'William Bradley Pitt', 'bpitt@gmail.com', '555', 'Shawnee, Oklahoma, United States', ''),
(2, 'Angelina Jolie Voight', 'ajolie@gmail.com', '556', 'Los Angeles, California, United States', ''),
(3, 'Edgar Allan Poe', 'eap@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_guest`
--

CREATE TABLE IF NOT EXISTS `invoice_guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `invoice_amount` decimal(10,2) NOT NULL,
  `ts_issued` timestamp NOT NULL,
  `ts_paid` timestamp,
  `ts_cancelled` timestamp,
  PRIMARY KEY (`id`),
  KEY (`guest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_guest`
--

-- --------------------------------------------------------

-- #######################################################
-- ################# COUNTRIES & CITIES ##################
-- #######################################################

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(128) NOT NULL,
  `postal_code` varchar(16) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`, `postal_code`, `country_id`) VALUES
(1, 'Kuala Lumpur', 43200, 1); -- a placeholder

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`) VALUES
(1, 'Malaysia');


-- --------------------------------------------------------

-- #######################################################
-- ################## ADMINS & STAFFS ####################
-- #######################################################

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'murniyati', 'murniyati', '1234'),
(2, 'faiz', 'faiz', '1234'),
(3, 'faiz', 'faiz2', '1234'),
(4, 'zaman', 'zaman', '1234'),
(5, 'MOHAMAD FAIZ HANAFI HASHIM', 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nokp` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `nokp`, `username`, `password`) VALUES
(1, 'MOHAMAD FAIZ HANAFI HASHIM', 1234, 'admin', '1234'),
(2, 'Aiman', 4321, 'aiman', '1234'),
(3, '020302110319', 5678, 'sarah', '1234');

-- --------------------------------------------------------

-- #######################################################
-- ################### TRANSACTIONS ######################
-- #######################################################

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

-- CREATE TABLE `transaction` (
--   `id` int(11) NOT NULL,
--   `guest_id` int(11) NOT NULL,
--   `homestay_id` int(11) NOT NULL,
--   `status` varchar(20) NOT NULL,
--   `days` int(11) NOT NULL,
--   `checkin` date NOT NULL,
--   `checkout` date NOT NULL,
--   `price` decimal(10,2) NOT NULL,
--   PRIMARY KEY (`id`),
--   KEY (`guest_id`),
--   KEY (`homestay_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

-- INSERT INTO `transaction` (`id`, `guest_id`, `homestay_id`, `status`, `days`, `checkin`, `checkout`, `price`) VALUES
-- (1, 1, 1, 'Pending', 2, '2023-05-15', '2023-05-17', 200.00),
-- (2, 2, 2, 'Check In', 1, '2023-05-15', '2023-05-16', 200.00),
-- (3, 3, 3, 'Check Out', 1, '2023-05-15', '2023-05-16', 200.00);