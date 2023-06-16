-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2020 at 06:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameshopper`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Admin', 'noreplygameshopper@gmail.com', 'QWRtaW4=');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'PC'),
(2, 'PlayStation'),
(3, 'XBOX');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_contactNo` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_postcode` int(11) NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_state` varchar(255) NOT NULL,
  `customer_birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_contactNo`, `customer_address`, `customer_postcode`, `customer_city`, `customer_state`, `customer_birthday`) VALUES
(16, 'Harith Danial Poh', 'harithdanialpoh@gmail.com', 'aGFyaXRoOTY=', '0142330388', 'no 11, jalan jasa merdeka 30, taman datuk tamby chick karim,', 75350, 'Melaka', 'Melaka', '1996-03-11'),
(17, 'Adrian', 'mapplestory96@gmail.com', 'YWRyaWFuYWRyaWFu', '0123456789', 'No. 12, Jalan Melor, Taman Botanikal,', 75350, 'Melaka', 'Melaka', '2001-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order_total_price` decimal(6,2) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `payment_method` varchar(200) NOT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_total_price`, `order_status`, `payment_method`, `tracking_number`, `customer_id`) VALUES
(9, '517.00', 'Completed', 'Credit Card', 'trackingnumber01', 16),
(10, '467.00', 'Pending', 'Credit Card', NULL, 17),
(11, '79.00', 'Pending', 'Credit Card', NULL, 16);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `detail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(6,2) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`detail_id`, `product_id`, `quantity`, `subtotal`, `order_id`) VALUES
(7, 29, 1, '179.00', 9),
(8, 23, 1, '179.00', 9),
(9, 26, 1, '159.00', 9),
(10, 19, 1, '169.00', 10),
(11, 18, 1, '119.00', 10),
(12, 17, 1, '179.00', 10),
(13, 30, 1, '79.00', 11);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_release_date` date NOT NULL,
  `product_language` varchar(255) NOT NULL,
  `product_description` varchar(200) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_release_date`, `product_language`, `product_description`, `product_image`, `category_id`) VALUES
(17, 'ONE PIECE PIRATE WARRIOR 4', '179.00', '2020-03-27', 'English', 'One Piece: Pirate Warriors 4 introduces a new game mode called \"Titan mode\", where it will be more strategic gameplay.\r\nIt also features four new multiplayer player modes', 'ps4-one-piece-pirate-warrior-4-r3eng.jpg', 2),
(18, 'MOVING OUT', '119.00', '2020-04-28', 'English', 'Moving Out is a ridiculous physics-based moving simulator that brings new meaning to \"couch co-op\"! Are you ready for an exciting career in furniture? As a newly certified Furniture Arrangement & Relo', 'pre-order-ps4-moving-out-r3engchn.jpg', 2),
(19, 'BAYONETTA VANQUISH 10TH ANNIVERSARY BUNDLE', '169.00', '2020-02-18', 'English', 'From directors Hideki Kamiya & Shinji Mikami comes 2 of PlatinumGames most acclaim action adventure games', 'pre-order-ps4-bayonetta-vanquish-10th-anniversary-bundle-r3eng.jpg', 2),
(20, 'FINAL FANTASY 7 REMAKE', '189.00', '2020-04-10', 'English', 'The story of this first, standalone game in the FINAL FANTASY VII REMAKE project covers up to the party’s escape from Midgar, and goes deeper into the events occurring in Midgar than the original FINA', 'pre-order-ps4-final-fantasy-7-remake-r3chn.jpg', 2),
(21, 'RESIDENT EVIL 3 REMAKE', '229.00', '2020-04-03', 'English', 'RESIDENT EVIL 3 REMAKE', 'pre-order-ps4-resident-evil-3-remake-r3-engchn-.jpg', 2),
(22, 'GHOST OF TSUSHIMA', '159.00', '2019-08-01', 'English', 'GHOST OF TSUSHIMA', 'pre-order-ps4-ghost-of-tsushima-r3-engchn-.jpg', 2),
(23, 'FIFA 20', '179.00', '2019-09-27', 'English', 'FIFA 20 Standard Edition includes:\r\n\r\nUp to 3 Rare Gold Packs (1 Per Week For 3 Weeks)\r\nLoan Icon Player Pick - Choose 1 of 5 Loan Icon Items (Mid Version) For 5 FUT Matches\r\nSpecial Edition FUT Kits\r', 'ps4-fifa-20-r3engchn.jpg', 2),
(24, 'FIFA 20', '179.00', '2019-09-27', 'English', 'FIFA 20 Standard Edition includes:\r\n\r\nUp to 3 Rare Gold Packs (1 Per Week For 3 Weeks)\r\nLoan Icon Player Pick - Choose 1 of 5 Loan Icon Items (Mid Version) For 5 FUT Matches\r\nSpecial Edition FUT Kits\r', 'xbox fifa20.jpg', 3),
(25, 'Destiny 2', '180.00', '2018-05-26', 'English', 'Destiny 2', 'destiny2.jpg', 3),
(26, 'Halo', '159.00', '2016-06-08', 'English', 'Halo for XBOX One', 'halo.jpg', 3),
(27, 'Grand Theft Auto V', '159.00', '2013-09-17', 'English', 'Grand Theft Auto V for PC', 'pc_gtav.png', 1),
(28, 'Monster Hunter World', '169.00', '2017-12-09', 'English', 'Monster Hunter World for PC', 'pc_mhw.jpg', 1),
(29, 'NBA 2K20', '179.00', '2019-08-21', 'English', 'NBA 2K20 for PC', 'pc_nba2k20.png', 1),
(30, 'PLAYERUNKNOWN\'S BATTLEGROUND', '79.00', '2016-07-30', 'English', 'PLAYERUNKNOWN\'S BATTLEGROUND for PC', 'pc_pubg.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
