-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2019 at 07:54 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giftshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `Product` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'Tekstil'),
(2, 'Kozmetike'),
(3, 'Libra'),
(4, 'Ora'),
(5, 'Mbathje'),
(6, 'Aksesore'),
(11, 'Teknologji'),
(13, 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `item` text NOT NULL,
  `amount` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `dateOrdered` varchar(100) NOT NULL,
  `dateDelivered` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `name`, `contact`, `address`, `email`, `item`, `amount`, `status`, `dateOrdered`, `dateDelivered`) VALUES
(1, 'Besnik Rrmoku', '+37745479940', 'Prishtine', 'besnik@gmail.com', '(1) Llaptop Asus, ', '320', 'confirmed', '25/05/19 12:58:06 AM', '25/05/19 12:58:35 AM'),
(2, 'Ardit Konjuhi', '+37744990945', 'Prishtine', 'ardit@gmail.com', '(1) Fustan , (1) Fatrole 1 iPhone, (1) Parfum Burberry, ', '320', 'delivered', '25/05/19 01:00:36 AM', '25/05/19 01:01:04 AM'),
(3, 'Albin Berisha', '+37744852963', 'Prishtine', 'albin@gmail.com', '(1) Fatrole 2 iPhone, (2) Parfum Nina Ricci, ', '320', 'confirmed', '25/05/19 01:03:06 AM', '25/05/19 08:55:19 AM'),
(4, 'Rrezon Hazrolli', '+37744741852', 'Prishtine', 'rrezon@gmail.com', '(3) Ore iWatch, (1) Patika Polo, ', '320', 'delivered', '25/05/19 01:04:58 AM', '25/15/19 09:06:12 AM');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `imgUrl` text NOT NULL,
  `Product` text NOT NULL,
  `Description` text NOT NULL,
  `Price` double NOT NULL,
  `Category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `imgUrl`, `Product`, `Description`, `Price`, `Category`) VALUES
(1, 'kozmetike-1.jpg', 'Parfum Burberry', 'Parfum per femra', 47, 'Kozmetike'),
(2, 'kozmetike-2.jpg', 'Eveline Shadow', 'Hije per sy', 25, 'Kozmetike'),
(3, 'kozmetike-3.jpg', 'Eyelashes Pen', 'Laps per sy', 16, 'Kozmetike'),
(4, 'kozmetike-4.jpg', 'Parfum Nina Ricci', 'Parfum per femra', 78, 'Kozmetike'),
(5, 'kozmetike-5.jpg', 'Parfum Police', 'Parfum per meshkuj', 40, 'Kozmetike'),
(6, 'kozmetike-6.jpg', 'Parfum Elixir', 'Parfum per femra', 90, 'Kozmetike'),
(7, 'libra-1.jpg', 'Nje Minut Menaxher', 'Liber per Menaxhim', 22, 'Libra'),
(8, 'libra-2.jpg', 'Prilli i thyer', 'Roman', 28, 'Libra'),
(9, 'aksesore-1.jpg', 'Fatrole 1 iPhone', 'Fatrole per iPhone', 5, 'Aksesore'),
(10, 'aksesore-2.jpg', 'Fatrole 2 iPhone', 'Fatrole per iPhone', 7, 'Aksesore'),
(11, 'aksesore-3.jpg', 'Fatrole 3 iPhone', 'Fatrole per iPhone', 9, 'Aksesore'),
(12, 'mbathje-1.jpg', 'Patika Adidas', 'Patika per meshkuj', 40, 'Mbathje'),
(13, 'mbathje-2.jpg', 'Kepuce Diesel', 'Kepuce per meshkuj', 48, 'Mbathje'),
(14, 'mbathje-3.jpg', 'Patika Polo', 'Patika per meshkuj', 43, 'Mbathje'),
(15, 'ora-1.jpg', 'Ore iWatch', 'Ore per meshkuj', 13, 'Ora'),
(16, 'ora-2.jpg', 'Ore sGear', 'Ore per meshkuj', 16, 'Ora'),
(17, 'ora-3.jpg', 'Ore Lacoste', 'Ore per meshkuj', 19, 'Ora'),
(18, 'ora-4.jpg', 'Ore Diesel', 'Ore per meshkuj', 21, 'Ora'),
(19, 'teknologji-1.jpg', 'Llaptop Acer', 'Llaptop Acer 17inch', 420, 'Teknologji'),
(20, 'teknologji-2.jpg', 'Llaptop Asus', 'Llaptop Asus 15inch', 320, 'Teknologji'),
(21, 'teknologji-3.jpg', 'Llaptop Dell', 'Llaptop Dell 17inch', 400, 'Teknologji'),
(22, 'teknologji-4.jpg', 'Tablet Samsung 3', 'Tablet 10inch', 240, 'Teknologji'),
(23, 'teknologji-5.jpg', 'Llaptop Lenovo', 'Llaptop Lenovo 19inch', 600, 'Teknologji'),
(24, 'tekstil-1.jpg', 'Duks Adidas', 'Duks per meshkuj', 25, 'Tekstil'),
(25, 'tekstil-2.jpg', 'Duks Nike', 'Duks per meshkuj', 34, 'Tekstil'),
(26, 'tekstil-3.jpg', 'Fustan ', 'Fustan i zi', 36, 'Tekstil');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'user', 'user'),
(2, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
