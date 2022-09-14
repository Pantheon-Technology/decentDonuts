-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 29, 2021 at 10:52 PM
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
-- Database: `cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `image`, `quantity`) VALUES
(1, 'Donut', '5', 'donut1.jpg','9'),
(2, 'Donut', '5', 'donut2.jpg','10'),
(3, 'Donut', '5', 'donut3.jpg','10'),
(4, 'Donut', '5', 'donut4.jpg','10');
COMMIT;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders`(
  `orderId` INT(100) NOT NULL PRIMARY KEY auto_increment,
  `customerName` VARCHAR(100) NULL,
  `phoneNumber` CHAR(11) NULL,
  `roomNumber` VARCHAR(100) NULL,
  `postcode` VARCHAR(100) NULL,
  `orderStatus` VARCHAR(3) NOT NULL,
  `paid` BOOLEAN,
  `isDelivery` BOOLEAN,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `itemOrder`;
CREATE TABLE IF NOT EXISTS `itemOrder`(
  `orderId` INT NOT NULL,
  `donutId` INT NOT NULL,
  `quantity` INT NOT NULL
);

SELECT * FROM `orders`;
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`(
  `adminID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(200) NOT NULL,
  `password` VARCHAR(300) NOT NULL
);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
