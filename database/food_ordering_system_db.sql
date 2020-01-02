-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2019 at 03:37 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_ordering_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_cart`
--

CREATE TABLE `food_cart` (
  `id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_image` text NOT NULL,
  `food_prize` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `total_prize` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `cat_id` int(100) NOT NULL,
  `cat_title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`cat_id`, `cat_title`, `created_at`) VALUES
(12, 'Fries', '2019-12-02 00:41:33'),
(20, 'Soups', '2019-12-03 03:08:30'),
(21, 'Others', '2019-12-05 20:10:45'),
(22, 'Fast Foods', '2019-12-06 14:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `food_menu`
--

CREATE TABLE `food_menu` (
  `food_id` int(100) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `food_image` text NOT NULL,
  `food_prize` varchar(100) NOT NULL,
  `food_status` varchar(100) NOT NULL,
  `food_cat_id` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_menu`
--

INSERT INTO `food_menu` (`food_id`, `food_name`, `food_image`, `food_prize`, `food_status`, `food_cat_id`, `created_at`) VALUES
(1, 'Food Name 45', 'f14.jpg', '12.00', 'available', 22, '2019-12-06 23:41:11'),
(6, 'Better name', 'f10.jpg', '44.88', 'available', 22, '2019-12-06 23:41:04'),
(8, 'Soup', 'f7.jpeg', '104.00', 'available', 20, '2019-12-06 23:40:54'),
(9, 'Food Name 23', 'f9.jpg', '112.00', 'available', 12, '2019-12-06 23:40:47'),
(10, 'Food Name 6', 'f8.jpg', '333.99', 'available', 12, '2019-12-06 23:40:33'),
(11, 'Soup Dish', 'f7.jpeg', '104.00', 'available', 20, '2019-12-06 23:40:25'),
(13, 'Food Name 5', 'f5.jpg', '12.00', 'available', 12, '2019-12-06 23:40:07'),
(14, 'Food Name4', 'f3.jpg', '104.00', 'available', 12, '2019-12-06 23:40:01'),
(15, 'Food Name 3', 'f7.jpeg', '52.00', 'available', 12, '2019-12-06 23:39:52'),
(16, 'Food Name 2', 'f2.jpg', '12.43', 'available', 12, '2019-12-06 23:39:45'),
(17, 'Food Name1', 'f1.jpeg', '12.00', 'available', 12, '2019-12-06 23:39:37'),
(18, 'Food Name1212', 'f13.jpg', '1200.00', 'available', 21, '2019-12-06 23:39:30'),
(19, 'Food Name12', 'f11.jpeg', '12', 'available', 12, '2019-12-06 23:39:17'),
(20, 'Food Name124', 'f9.jpg', '120', 'available', 12, '2019-12-06 23:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `phone`, `state`, `address`, `role`, `password`, `created_at`) VALUES
(1, 'Admin', 'Manager', 'admin@gmail.com', '0900004433', 'Enugu', 'Ugwuaji Awkunanaw', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '2019-12-17 11:31:53'),
(2, 'Goals', 'Updates', 'leofizzy@gmail.com', '070 6253 8602', 'Enugu', '23 Agbani Road', 'subscriber', '827ccb0eea8a706c4c34a16891f84e7b', '2019-12-17 11:32:26'),
(13, 'John', 'Doe', 'johndoe@gmail.com', '07023412321', 'Anambra', 'Igbariam', 'subscriber', '827ccb0eea8a706c4c34a16891f84e7b', '2019-12-17 12:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_items`
--

CREATE TABLE `user_items` (
  `id` int(100) NOT NULL,
  `userOrderId` varchar(100) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `itemImage` text NOT NULL,
  `itemPrize` varchar(100) NOT NULL,
  `itemQty` varchar(100) NOT NULL,
  `itemTotalPrize` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `orderId` int(11) NOT NULL,
  `userId` int(100) NOT NULL,
  `orderNumber` varchar(100) NOT NULL,
  `orderUserName` varchar(100) NOT NULL,
  `orderUserAddress` varchar(100) NOT NULL,
  `orderUserPhone` varchar(100) NOT NULL,
  `orderAmount` varchar(100) NOT NULL,
  `orderStatus` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_cart`
--
ALTER TABLE `food_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `food_menu`
--
ALTER TABLE `food_menu`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_items`
--
ALTER TABLE `user_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`orderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_cart`
--
ALTER TABLE `food_cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `food_menu`
--
ALTER TABLE `food_menu`
  MODIFY `food_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_items`
--
ALTER TABLE `user_items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
