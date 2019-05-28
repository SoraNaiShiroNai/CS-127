-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2019 at 02:49 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsc 127: buy and sell`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidding_details`
--

CREATE TABLE `bidding_details` (
  `item_idnum` int(11) NOT NULL,
  `username_seller` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `username_buyer` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `starting_price` float(16,2) NOT NULL,
  `highest_bidder` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `highest_bid` float(16,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bid_details`
--

CREATE TABLE `bid_details` (
  `item_idnum` int(11) NOT NULL,
  `bidder_username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `bid` float(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `book_type`
--

CREATE TABLE `book_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(30) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `book_type`
--

INSERT INTO `book_type` (`type_id`, `type_name`) VALUES
(1, 'Textbook'),
(2, 'Graphic Novel'),
(3, 'Picture Book'),
(4, 'Anthology'),
(5, 'Cook Book'),
(6, 'Stamp Catalogue'),
(7, 'Children\'s Book'),
(8, 'Chapter Book');

-- --------------------------------------------------------

--
-- Table structure for table `item_on_auction`
--

CREATE TABLE `item_on_auction` (
  `item_idnum` int(11) NOT NULL,
  `seller_username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `book_type` int(11) NOT NULL,
  `item_name` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `author` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `item_desc` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `item_price` float(16,2) NOT NULL,
  `condition` enum('used','brandnew') COLLATE utf8mb4_bin NOT NULL,
  `in_stock` enum('available','limited','out-of-stock') COLLATE utf8mb4_bin NOT NULL,
  `item_photo` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `book_no` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `format` enum('hardcover','paperback','audiocd','ebook') COLLATE utf8mb4_bin NOT NULL,
  `highest_bidder_username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `highest_bid` float(16,2) NOT NULL,
  `status` enum('Ready','Open','Closed') COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `item_on_auction`
--

INSERT INTO `item_on_auction` (`item_idnum`, `seller_username`, `book_type`, `item_name`, `author`, `item_desc`, `item_price`, `condition`, `in_stock`, `item_photo`, `book_no`, `format`, `highest_bidder_username`, `highest_bid`, `status`) VALUES
(1, '87687', 2, 'The Cat in the Hat', 'Dr. Seuss', 'Sample book on auction', 12.95, 'brandnew', 'available', 'cith.jpg', '9788415745549', 'hardcover', 'Akabane', 0.00, 'Ready');

-- --------------------------------------------------------

--
-- Table structure for table `item_on_sale`
--

CREATE TABLE `item_on_sale` (
  `item_idnum` int(9) NOT NULL,
  `seller_username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `book_type` int(11) NOT NULL,
  `item_name` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `author` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `item_desc` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `item_price` double(16,2) NOT NULL,
  `condition` enum('used','brandnew') COLLATE utf8mb4_bin NOT NULL,
  `in_stock` enum('available','limited','out-of-stock') COLLATE utf8mb4_bin NOT NULL,
  `item_photo` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `book_no` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `format` enum('hardcover','paperback','audiocd','ebook') COLLATE utf8mb4_bin NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `item_on_sale`
--

INSERT INTO `item_on_sale` (`item_idnum`, `seller_username`, `book_type`, `item_name`, `author`, `item_desc`, `item_price`, `condition`, `in_stock`, `item_photo`, `book_no`, `format`, `status`) VALUES
(5, 'Takishima', 1, '2', 'w', '8', 8.00, 'brandnew', 'available', 'df337639517ca58577427742f866454976348bfc.png', '88', 'audiocd', 0),
(16, 'SoraNai_ShiroNai', 4, 'Toyota Supra GT', 'Shiro and Sora', 'The Supra was offered with a 94 kW (123 hp; 125 PS) 2.0 L 12-valve SOHC inline-6 engine (M-EU, chassis code MA45) ', 5300200.00, 'brandnew', 'available', '82cfd06d03b8f0f17aef2ea8c04ec860f37460df.png', '09393123213111', 'audiocd', 0),
(25, 'SoraNai_ShiroNai', 1, '$item_name', '', '$item_desc', 0.00, 'used', 'available', '9dd6de677c96988d0010f68b99a774ef528c081d.png', '$book_no', 'hardcover', 0),
(27, 'Takishima', 1, '$item_name', '', '$item_desc', 0.00, 'used', 'available', '90901aff0978db99bb947ec49f4d373a58f09ae7.png', '', 'hardcover', 0),
(28, 'Takishima', 1, 'Cream-O', '', 'Limited Edition Vanilla Cream-Filled Chocolate Sandwich Cookies', 4000000.00, 'used', 'available', 'dbb56390853c7c75de5edc823e559f24672e14b0.png', '', 'hardcover', 0),
(33, 'Takishima', 1, 'qweqwe', '', 'ewweqr`eqw', 123.00, 'used', 'available', 'f53edf4822ecc21221c5518f94b223b8f2bd9a47.png', '123123', 'hardcover', 0),
(38, 'Takishima', 0, '$item_na123123131me', '', '$item_desc', 31.00, '', '', '', '$book_no', '', 0),
(39, 'Takishima', 0, '32432o48u3284u', '', 'hukh3i4ukh', 0.00, '', '', '', '3h4iuh4uh', '', 0),
(40, 'SoraNai_ShiroNai', 0, '$item_name', '', '$item_desc', 0.00, '', 'limited', '', '$book_no', 'ebook', 0),
(41, 'Takishima', 6, '98', '', 'asd', 798.98, 'brandnew', 'available', '', '7987', 'hardcover', 0),
(42, 'Takishima', 0, 'lllllllllll', '', 'lll', 0.00, 'brandnew', 'limited', '', 'll', 'audiocd', 0),
(43, 'Takishima', 1, 'llllllllllls', '', 'lll', 0.00, 'brandnew', 'available', '', 'll', 'hardcover', 0),
(44, 'Takishima', 0, '88', '', '8', 8.00, 'used', 'out-of-stock', '', '88', 'paperback', 0),
(45, 'Takishima', 7, '2', '', '8', 8.00, 'brandnew', 'available', '', '88', 'hardcover', 0),
(46, 'Takishima', 1, '2', '', '8', 8.00, 'brandnew', 'available', '', '88', 'audiocd', 0),
(47, 'Takishima', 8, 'Love is War', 'Kaguya sama', 'A Book about the love of two highschool kids', 1000.00, 'brandnew', 'limited', '', 'ISBN990139', 'ebook', 0),
(48, 'Takishima', 8, 'Love is War', 'Kaguya sama', 'A Book about the love of two highschool kids', 1000.00, 'brandnew', 'limited', '', 'ISBN990139', 'ebook', 0),
(49, 'Takishima', 1, 'SSSSSSSSSSSSSSSSSS', '', '', 0.00, 'brandnew', 'available', '6e1a545da8bd43db36ec3f3ae0b356ce4793d9d8.png', '', 'hardcover', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE `purchase_history` (
  `username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `item_name` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `price` float(16,2) NOT NULL,
  `date_purchased` date NOT NULL,
  `method` enum('SALE','AUCTION') COLLATE utf8mb4_bin NOT NULL,
  `seller_username` varchar(20) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `purchase_history`
--

INSERT INTO `purchase_history` (`username`, `item_name`, `price`, `date_purchased`, `method`, `seller_username`) VALUES
('Dororo', '$item_na123123131me', 31.00, '2019-05-27', 'SALE', 'Takishima'),
('Dororo', '$item_na123123131me', 31.00, '2019-05-27', 'SALE', 'Takishima'),
('Dororo', '$item_na123123131me', 31.00, '2019-05-27', 'SALE', 'Takishima'),
('Dororo', 'Toyota Supra GT', 5300200.00, '2019-05-27', 'SALE', 'SoraNai_ShiroNai'),
('Dororo', '$item_name', 0.00, '2019-05-27', 'SALE', 'SoraNai_ShiroNai'),
('Dororo', '$item_name', 0.00, '2019-05-27', 'SALE', 'Takishima'),
('Dororo', '2', 8.00, '2019-05-27', 'SALE', 'Takishima'),
('Dororo', 'Cream-O', 4000000.00, '2019-05-27', 'SALE', 'Takishima'),
('Dororo', 'qweqwe', 123.00, '2019-05-27', 'SALE', 'Takishima'),
('sora', 'Cream-O', 4000000.00, '2019-05-28', 'SALE', 'Takishima'),
('sora', 'Cream-O', 4000000.00, '2019-05-28', 'SALE', 'Takishima');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `username_seller` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `username_buyer` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `transaction_date` datetime NOT NULL,
  `location` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `contact_no` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `message` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `item_idnum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(535) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `default_delivery_addr` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `contact_no` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `email_addr` varchar(40) COLLATE utf8mb4_bin NOT NULL,
  `email_notif` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `last_name`, `first_name`, `default_delivery_addr`, `contact_no`, `email_addr`, `email_notif`) VALUES
('87687', '123', '78', '8768', '78', '8798', '78@.c0m', 0),
('Akabane', '5ebda91a2b0a161b5afb6a607546cbbe', 'Akabane', 'Karma', 'Gugikaouka Gakuen', '123456789', 'karma@gugikaokagakuen.com', 0),
('Dororo', '827ccb0eea8a706c4c34a16891f84e7b', 'Kazuto', 'Kirigaya', 'Aincrad', '022514005', 'kirito@yahoo.com', 0),
('SoraNai_ShiroNai', 'd35b28074534789d53ca21b7c1dfb4b8', 'Nai', 'Sora', 'Elkia Castle', '022514005', '7laharl@gmail.com', 0),
('Takishima', '80e0b2a2c1a1d6d47f9a9ff573c08c42', 'Takishima', 'Kei', 'studio gakuen', '00000000001', 'jgbuenaventura@up.edu.ph', 0),
('sora', 'shiro', 'Buenaventura', 'Fhilippe', 'St. Jamess', '8472014723', 'jgbuenaventura@up.edu.ph', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidding_details`
--
ALTER TABLE `bidding_details`
  ADD PRIMARY KEY (`item_idnum`),
  ADD KEY `username_seller` (`username_seller`),
  ADD KEY `username_buyer` (`username_buyer`),
  ADD KEY `highest_bidder` (`highest_bidder`),
  ADD KEY `starting_price` (`starting_price`);

--
-- Indexes for table `bid_details`
--
ALTER TABLE `bid_details`
  ADD KEY `item_idnum` (`item_idnum`),
  ADD KEY `bidder_username` (`bidder_username`);

--
-- Indexes for table `book_type`
--
ALTER TABLE `book_type`
  ADD PRIMARY KEY (`type_id`) USING BTREE;

--
-- Indexes for table `item_on_auction`
--
ALTER TABLE `item_on_auction`
  ADD PRIMARY KEY (`item_idnum`),
  ADD KEY `item_on_auction_ibfk_1` (`book_type`),
  ADD KEY `item_on_auction_ibfk_2` (`seller_username`),
  ADD KEY `item_on_auction_ibfk_3` (`highest_bidder_username`);

--
-- Indexes for table `item_on_sale`
--
ALTER TABLE `item_on_sale`
  ADD PRIMARY KEY (`item_idnum`),
  ADD KEY `username` (`seller_username`) USING BTREE,
  ADD KEY `type_id` (`book_type`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD KEY `username` (`username`),
  ADD KEY `seller_username` (`seller_username`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD UNIQUE KEY `item_idnum` (`item_idnum`) USING BTREE,
  ADD KEY `username_seller` (`username_seller`) USING BTREE,
  ADD KEY `transaction_date` (`transaction_date`) USING BTREE,
  ADD KEY `username_buyer` (`username_buyer`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_type`
--
ALTER TABLE `book_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_on_auction`
--
ALTER TABLE `item_on_auction`
  MODIFY `item_idnum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_on_sale`
--
ALTER TABLE `item_on_sale`
  MODIFY `item_idnum` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidding_details`
--
ALTER TABLE `bidding_details`
  ADD CONSTRAINT `bidding_details_ibfk_1` FOREIGN KEY (`username_seller`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `bidding_details_ibfk_2` FOREIGN KEY (`username_buyer`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `bidding_details_ibfk_3` FOREIGN KEY (`highest_bidder`) REFERENCES `user` (`username`);

--
-- Constraints for table `item_on_auction`
--
ALTER TABLE `item_on_auction`
  ADD CONSTRAINT `item_on_auction_ibfk_1` FOREIGN KEY (`book_type`) REFERENCES `book_type` (`type_id`),
  ADD CONSTRAINT `item_on_auction_ibfk_2` FOREIGN KEY (`seller_username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `item_on_auction_ibfk_3` FOREIGN KEY (`highest_bidder_username`) REFERENCES `user` (`username`);

--
-- Constraints for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD CONSTRAINT `purchase_history_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`username_seller`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
