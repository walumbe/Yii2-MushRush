-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2022 at 01:00 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MushRush`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `customer_id` int NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`customer_id`, `customer_address`, `city`, `state`, `country`, `created_by`, `deleted_at`) VALUES
(73, 'Park Road', 'Nairobi', 'Ngara', 'Kenya', NULL, NULL),
(74, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(75, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(76, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(77, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(78, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(79, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(80, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(81, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(82, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(83, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(84, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(85, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(86, 'Park Road, Ngara', 'Nairobi', 'Eastlands', 'Kenya', NULL, NULL),
(87, 'Park Road, Ngara', 'Eldoret', 'Eastlands', 'Kenya', NULL, NULL),
(88, 'Park Road, Ngara', 'Eldoret', 'Eastlands', 'Kenya', NULL, NULL),
(89, 'Park Road, Ngara', 'Eldoret', 'Eastlands', 'Kenya', NULL, NULL),
(90, 'Park Road, Ngara', 'Eldoret', 'Eastlands', 'Kenya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `paypal_order_id` varchar(255) DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_price`, `status`, `firstname`, `lastname`, `email`, `transaction_id`, `paypal_order_id`, `created_at`, `created_by`, `deleted_at`) VALUES
(73, '1.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1637197852, NULL, NULL),
(74, '4.00', 1, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', '3VR651784C315910W', '5YU425888J8241009', 1637457272, 3, NULL),
(75, '63.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1638313878, 3, NULL),
(76, '5.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1649539537, 3, NULL),
(77, '1.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1649540103, 3, NULL),
(78, '5.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1649540145, 3, NULL),
(79, '3.00', 1, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', '0Y862682HD2390917', '3NK63378UT7111304', 1649540220, 3, NULL),
(80, '1.00', 1, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', '4SU05221K29326545', '5565979952450042C', 1649540293, 3, NULL),
(81, '1.00', 1, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', '2VE88154BR2790335', '1LN07440M93286040', 1649540361, 3, NULL),
(82, '5.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1649540456, 3, NULL),
(83, '3.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1649540484, 3, NULL),
(84, '3.00', 1, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', '0HF61204FG513474M', '2YV72652VV218122N', 1649546754, 3, NULL),
(85, '1.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1649546852, 3, NULL),
(86, '3.00', 1, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', '3WG67508C0250974K', '7RV933466W2276820', 1649546873, 3, NULL),
(87, '81.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1651838350, 3, NULL),
(88, '11.00', 1, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', '1SN74214GH6958710', '9EN89878EK6835419', 1651838591, 3, NULL),
(89, '3.00', 1, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', '6WU39380S2184015F', '81W59642UV051193J', 1653602168, 3, NULL),
(90, '8.00', 0, 'Jonathan', 'Walumbe', 'nathanwalumbe@gmail.com', NULL, NULL, 1654421325, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_id` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `order_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_name`, `product_id`, `unit_price`, `order_id`, `quantity`, `created_by`, `deleted_at`) VALUES
(50, 'King Oyster', 42, '1.00', 73, 1, NULL, NULL),
(51, 'King Oyster', 42, '1.00', 74, 1, 3, NULL),
(52, 'Button Musrooms', 40, '3.00', 74, 1, 3, NULL),
(53, 'Button Musrooms', 40, '3.00', 75, 6, 3, NULL),
(54, 'Cup Mushrooms', 41, '5.00', 75, 9, 3, NULL),
(55, 'Cup Mushrooms', 41, '5.00', 76, 1, 3, NULL),
(56, 'King Oyster', 42, '1.00', 77, 1, 3, NULL),
(57, 'Cup Mushrooms', 41, '5.00', 78, 1, 3, NULL),
(58, 'Button Musrooms', 40, '3.00', 79, 1, 3, NULL),
(59, 'King Oyster', 42, '1.00', 80, 1, 3, NULL),
(60, 'King Oyster', 42, '1.00', 81, 1, 3, NULL),
(61, 'Cup Mushrooms', 41, '5.00', 82, 1, 3, NULL),
(62, 'Button Musrooms', 40, '3.00', 83, 1, 3, NULL),
(63, 'Button Musrooms', 40, '3.00', 84, 1, 3, NULL),
(64, 'King Oyster', 42, '1.00', 85, 1, 3, NULL),
(65, 'King Oyster', 42, '1.00', 86, 3, 3, NULL),
(66, 'Cup Mushrooms', 41, '5.00', 87, 16, 3, NULL),
(67, 'King Oyster', 42, '1.00', 87, 1, 3, NULL),
(68, 'Button Musrooms', 40, '3.00', 88, 2, 3, NULL),
(69, 'Cup Mushrooms', 41, '5.00', 88, 1, 3, NULL),
(70, 'Button Musrooms', 40, '3.00', 89, 1, 3, NULL),
(71, 'Button Musrooms', 40, '3.00', 90, 1, 3, NULL),
(72, 'Cup Mushrooms', 41, '5.00', 90, 1, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `status` int NOT NULL,
  `transaction_number` int NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext,
  `image` varchar(2000) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(40, 'Button Musrooms', '<p>Button, cup, and flat mushrooms are all the same type of white mushroom.&nbsp;</p>\r\n\r\n<p>They have the most delicate flavour of the three, and they&rsquo;re great raw or cooked as</p>\r\n\r\n<p>whole mushrooms.</p>\r\n', '/products/v88BLg9HkvBsCLzuo4_VJekzHzKqM-xE/mush0.jpg', '3.00', 1, 1637196924, 1637196924, 3, 3, NULL),
(41, 'Cup Mushrooms', '<p>Harvested when the mushroom cap opens partially from the stem.&nbsp;They are usually a bit larger, and they have a slightly more intense flavour than button mushrooms</p>\r\n', '/products/CvxFBrdJ_zRyTJuRmDQFxzpS4Uy5f173/mush1.webp', '5.00', 1, 1637197122, 1637197122, 3, 3, NULL),
(42, 'King Oyster', '<p>These mushrooms have a thick, fat stem that is often eaten sliced and pan-fried or barbecued. They have a meaty stem that is quite different to soft oyster mushrooms.</p>\r\n', '/products/1hgx5PO204QmQNZQ8AJGfgZwG7UTFH9T/king oyster.webp', '1.00', 1, 1637197383, 1637197383, 3, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `admin` tinyint(1) DEFAULT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `admin`, `created_at`, `updated_at`, `verification_token`, `deleted_at`) VALUES
(3, 'Jonathan', 'Walumbe', 'walumbe', 'pYDAFcnBdWCADTcDZVJr40ywvimNj4_Z', '$2y$13$/I80/xlM9WSqDIvBQg0iC.UOa1pnjALBPRCz5TzjJnA3S1kXkiWbG', NULL, 'nathanwalumbe@gmail.com', 10, NULL, 1635451983, 1637102220, 'OvIGz5hajz5pFTXj0kev3j2w0xrcjs-j_1635451983', NULL),
(5, 'adsaa', 'fdsfsf', 'ddfgdgf', 'rSMpHrB8bwSazeBoa242HHPs75x-rdNf', '$2y$13$6e1lbGpPp2IF5hFNrB6hpuxbeI0BmnOt9eJCuomya.2hUxQS.W3.q', NULL, 'jh@gmail.com', 9, NULL, 1651837724, 1651837724, 'HbLBFMbwvL3xrgK1qrsJoL2_ItrsA5CH_1651837724', NULL),
(6, 'asdafafda', 'sfdsfsfs', 'sdsad', 'DWAFhYQM7WWEUxuG-jCSvr9LjDpH0Ych', '$2y$13$CWsp20TOIYeDxfaf6G/Jnuwb9XIpImgIlE4XUhkmo16d9HzwgG0W6', NULL, 'gudujael@gmail.com', 9, NULL, 1651837789, 1651837789, 'ueWoeuvYHO_3C2EXNtgHgv8o_XYiEFw1_1651837789', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `address`, `city`, `state`, `country`, `created_by`, `deleted_at`) VALUES
(1, 3, 'Park Road, Ngara', 'Eldoret', 'Eastlands', 'Kenya', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-cart_items-product_id` (`product_id`),
  ADD KEY `idx-cart_items-created_by` (`created_by`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `idx-customer_address-customer_id` (`customer_id`),
  ADD KEY `FK_customer_address_created_by` (`created_by`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-orders-created_by` (`created_by`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-order_items-product_id` (`product_id`),
  ADD KEY `idx-order_items-order_id` (`order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-payment-created_by` (`created_by`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-products-created_by` (`created_by`),
  ADD KEY `idx-products-updated_by` (`updated_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-user_addresses-user_id` (`user_id`),
  ADD KEY `FK_user_addresses_created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk-cart_items-created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-cart_items-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `fk-customer_address-customer_id` FOREIGN KEY (`customer_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_customer_address_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk-orders-created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk-order_items-order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk-payment-created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk-products-created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-products-updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `fk-user_addresses-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_user_addresses_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
