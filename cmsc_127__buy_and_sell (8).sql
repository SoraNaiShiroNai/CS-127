-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2019 at 03:19 PM
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

--
-- Dumping data for table `bid_details`
--

INSERT INTO `bid_details` (`item_idnum`, `bidder_username`, `bid`) VALUES
(1, 'Takishima', 200.00),
(9, 'Takishima', 99090192.00),
(8, 'Takishima', 440110.00),
(7, 'Takishima', 3000100.00),
(9, 'Akabane', 99090288.00),
(7, 'Akabane', 3000200.00),
(6, 'Akabane', 530400.00);

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
(14, 'Takishima', 8, 'Maybe You Should Talk to Someo', 'Lori Gottlieb', 'A therapist, her therapist and our lives revealed', 800.00, 'used', 'limited', 'MaybeYouShouldTalktoSomeone.jpg', 'ISBN03888132', 'hardcover', 'Akabane', 800.00, 'Ready'),
(15, 'Takishima', 1, 'Differential Equations', 'Richard Bronson PH D', 'A crash course on mastering differential equations', 900.00, 'used', 'limited', 'DifferentialEquations.jpg', 'ISBN1112939121', 'hardcover', 'SoraNai_ShiroNai', 900.00, 'Ready');

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
(52, 'Takishima', 1, 'Of Mice and Men', 'John Steinback 1937', 'tells the story of two displaced migrant ranchworkers, who move from place to place in California search of new job opportunities during the Great Depressionin the United States.', 350.00, 'brandnew', 'available', 'OfMiceAndMen.jpg', 'ISBN3881823', 'hardcover', 0),
(53, 'Takishima', 2, 'To Kill a Mockingbird', 'Harper Lee 1960', 'the primary themes of To Kill a Mockingbird involve racial injustice and the destruction of innocence.', 450.00, 'used', 'available', 'toKillaMockingBird.jpg', 'ISBN0002103', 'paperback', 0),
(54, 'Takishima', 3, 'Into the Magic Shop', 'James Doty', 'Extraordinary things happen when we harmess the power of both the brain and the heart', 700.00, 'brandnew', 'limited', 'IntotheMagicShop.jpg', 'ISBN99100302', 'hardcover', 0),
(55, 'SoraNai_ShiroNai', 2, 'The Second Mountain', 'David Brooks', 'The quest for a moral life', 600.00, 'brandnew', 'available', 'TheSecondMountain.jpg', 'ISBN8000312', 'paperback', 0),
(56, 'SoraNai_ShiroNai', 2, 'Bad Blood', 'John Carreyrou', 'Secrets and Lies in a Silicon Valley Startup', 500.00, 'brandnew', 'available', 'BadBlood.jpg', 'ISBN0039132', 'hardcover', 0),
(57, 'SoraNai_ShiroNai', 2, 'The Alchemist', 'Paulo Coelho', 'Follow the journey of an Andalusian shepherd boy named Santiago', 400.00, 'brandnew', 'available', 'TheAlchemist.jpg', 'ISBN900013255', 'paperback', 0),
(58, 'Akabane', 1, 'Man Search for Meaning', 'Viktor Frankl', 'The classic tribute to hope from the holocaust', 400.00, 'used', 'out-of-stock', 'MansSearchforMeaning.jpg', 'ISBN44001222', 'hardcover', 0),
(59, 'Akabane', 1, 'After Dark', 'Haruki Murakami 2004', 'Novel of encounters set in Tokyo during the spooky hours between midnight and dawn', 459.00, 'brandnew', 'limited', 'afterDark.jpg', 'ISBN00004012', 'paperback', 0),
(60, 'Akabane', 1, 'The Subtle Art of Not Giving a', 'Mark Manson', 'A counterintuitive approach to living a good life', 200.00, 'brandnew', 'available', 'TheSubtleArtofNotGivingaFck.jpg', 'ISBN0000000001', 'hardcover', 0),
(61, 'Dororo', 2, 'Milk and Honey', 'Rupi Kaur', 'A Collection of poetry and prose about survival', 200.00, 'used', 'available', 'milkandhoney.jpg', 'ISBN27731323', 'ebook', 0),
(62, 'Dororo', 2, 'Where the Crawdads Sing', 'Peeps', 'Describes the life and adventures of a girl named Kya in the swaps of North Carolina', 700.00, 'brandnew', 'available', 'WheretheCrawdadsSing.jpg', 'ISBN848122488', 'audiocd', 0),
(63, 'Dororo', 1, 'Unfreedom of the Press', 'Mark Levin', 'how those entrusted with news reporting today are destroying freedom of the press from within: 渡ot government oppression or suppression', 800.00, 'used', 'limited', 'UnfreedomofthePress.jpg', 'ISBN813003123', 'audiocd', 0);

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
  `seller_username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `delivery_status` tinyint(1) NOT NULL,
  `delivery_address` varchar(200) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sale_history`
--

CREATE TABLE `sale_history` (
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `item_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float(16,2) NOT NULL,
  `date_sold` date NOT NULL,
  `buyer_username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` enum('SALE','AUCTION') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `sale_history`
--
ALTER TABLE `sale_history`
  ADD KEY `username` (`username`);

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
  MODIFY `item_idnum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `item_on_sale`
--
ALTER TABLE `item_on_sale`
  MODIFY `item_idnum` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
-- Constraints for table `sale_history`
--
ALTER TABLE `sale_history`
  ADD CONSTRAINT `sale_history_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`username_seller`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
