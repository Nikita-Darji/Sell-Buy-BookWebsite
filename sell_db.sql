-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 12:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sell_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(50) NOT NULL,
  `r_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

CREATE TABLE `img` (
  `img_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `img_name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`img_id`, `r_id`, `img_name`, `price`, `author`, `detail`, `img`) VALUES
(18, 48, 'commerce', 500, 'A.R.Varma', 'Good Book you have to read.\r\n\r\n', 'red_queen.jpg'),
(19, 48, 'helle', 190, 'nikita', 'it\'s a good to read.', 'shattered.jpg'),
(22, 50, 'be well be', 569, 'Ghori Shah', 'The story is about a lovely girl.', 'be_well_bee.jpg'),
(23, 50, 'nightshade', 999, 'Harsh varma', 'Story of a fox.\r\n', 'nightshade.jpg'),
(24, 49, 'Darknet', 899, 'charles cage', 'good book you should read.', 'darknet.jpg'),
(25, 49, 'freefall', 389, 'geeta patel', 'You will love this. Must read.', 'freefall.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `user_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(10) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 'nikita darji', 'nikitadarji@gmail.com', 2147483647, 'i just want u to update your site.'),
(6, 'nike', 'n@gmail.com', 123456789, 'hey, this is nice website');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(50) NOT NULL,
  `r_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `r_id`, `name`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 51, 'niku', 'cash on delivery', 'flat no. 454, ultan faliya, vapi, dadra and nagar haveli - 362230', ', helle (1) ', 190, '05-Apr-2024', 'completed'),
(4, 49, 'nike', 'cash on delivery', 'flat no. 234, dhanu, anand,  - ', ', commerce (1) , Darknet (1) , be well be (2) ', 2537, '07-Apr-2024', 'completed'),
(5, 49, 'nike', 'cash on delivery', 'flat no. 123, dhanu, ana,  - ', ', freefall (1) ', 389, '07-Apr-2024', 'completed'),
(7, 48, '', 'cash on delivery', 'flat no. , , ,  - ', ', helle (1) , freefall (1) ', 579, '08-Apr-2024', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `r_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `phn` bigint(10) NOT NULL,
  `user` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`r_id`, `name`, `email`, `pass`, `phn`, `user`) VALUES
(44, 'nikitadarji', 'nikitadarji@gmail.com', '123456', 123456789, 'admin'),
(48, 'niki', 'niki@gmail.com', '123456', 1234567895, 'user'),
(49, 'nikitadarji', 'n@gmail.com', '147258', 9876546787, 'user'),
(50, 'heena', 'heena@gmail.com', 'heena2', 8529637418, 'user'),
(51, 'niku', 'niku@gmail.com', '123456', 1234567890, 'user'),
(52, 'rahul', 'rahul123@gmail.com', 'rahul1', 1234567890, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `seller_info`
--

CREATE TABLE `seller_info` (
  `info_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `method` varchar(20) NOT NULL DEFAULT 'pending',
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller_info`
--

INSERT INTO `seller_info` (`info_id`, `r_id`, `name`, `method`, `address`) VALUES
(23, 48, 'nikita darji', 'credit card', 'flat no. 123, ultan faliya, silvassa, India - 147852'),
(24, 48, 'niki darji', 'credit card', 'flat no. 123, frggg, fjfufhhf, India - 147852'),
(39, 50, 'heena', 'credit card', 'flat no. 123, gandhi chowk, mumbai, India - 756856'),
(40, 49, 'nike', 'paypal', 'flat no. 34, dhanu, anand, india - 897564');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `r_id` (`r_id`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `r_id` (`r_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `r_id` (`r_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `seller_info`
--
ALTER TABLE `seller_info`
  ADD PRIMARY KEY (`info_id`),
  ADD KEY `r_id_fk` (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `seller_info`
--
ALTER TABLE `seller_info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `r_id_fk3` FOREIGN KEY (`r_id`) REFERENCES `registration` (`r_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `r_id_fk2` FOREIGN KEY (`r_id`) REFERENCES `registration` (`r_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `r_id_fk4` FOREIGN KEY (`r_id`) REFERENCES `registration` (`r_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `seller_info`
--
ALTER TABLE `seller_info`
  ADD CONSTRAINT `r_id_fk` FOREIGN KEY (`r_id`) REFERENCES `registration` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
