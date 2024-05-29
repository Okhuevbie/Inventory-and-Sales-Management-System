-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 11:25 AM
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
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `user_id` bigint(12) NOT NULL,
  `user` varchar(50) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `user`, `activity`, `time`) VALUES
(1, 0, 'John Okhuevbie Toluwani', 'Online', '2024-05-23 08:39:41'),
(2, 16, 'John Okhuevbie Toluwani', 'Logged into Central Warehouse', '2024-05-23 08:40:15'),
(3, 0, 'John Okhuevbie Toluwani', 'Offline', '2024-05-23 08:40:51'),
(4, 0, 'System Administrator ', 'Online', '2024-05-23 08:41:39'),
(5, 1, 'System Administrator ', 'Logged into Central Warehouse', '2024-05-23 08:41:54'),
(6, 1, 'System Administrator ', 'Added a Product Category: Television', '2024-05-23 08:42:29'),
(7, 1, 'System Administrator ', 'Added a Product: Samsung 50/80', '2024-05-23 08:43:15'),
(8, 1, 'System Administrator ', 'Updated Samsung 50/80 Product ( PURPOSE: Product Description || PRODUCT QUANTITY ADDED: 0)', '2024-05-23 09:27:19'),
(9, 1, 'System Administrator ', 'Updated Samsung 50/80 Product ( PURPOSE: Damaged || PRODUCT QUANTITY ADDED: -2)', '2024-05-23 10:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

CREATE TABLE `finances` (
  `id` int(11) NOT NULL,
  `table_name` varchar(55) NOT NULL,
  `item_id` bigint(15) NOT NULL,
  `category` varchar(24) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incoming_products`
--

CREATE TABLE `incoming_products` (
  `id` int(11) NOT NULL,
  `supply_id` varchar(15) NOT NULL,
  `product_id` bigint(15) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `batch_no` varchar(100) NOT NULL,
  `production_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `available_quantity` int(11) NOT NULL,
  `supplied_quantity` int(11) NOT NULL,
  `damaged` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_categories`
--

CREATE TABLE `inventory_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_history`
--

CREATE TABLE `inventory_history` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `date_taken` date NOT NULL,
  `quantity_taken` int(11) NOT NULL,
  `date_returned` date NOT NULL,
  `quantity_returned` int(11) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(12) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `delivery_date` date NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `discount` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `order_type` varchar(20) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Pending',
  `added_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` bigint(15) NOT NULL,
  `product_price_id` bigint(15) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `available` int(11) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `id` int(11) NOT NULL,
  `order_id` bigint(15) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 2,
  `tracking_id` varchar(50) NOT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `metric_units` varchar(50) NOT NULL DEFAULT 'Units',
  `cost_price` int(11) NOT NULL,
  `unit_price` int(11) DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `alert_quantity` int(11) NOT NULL DEFAULT 1,
  `expiry_date` date DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_update`
--

CREATE TABLE `product_update` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purpose` varchar(20) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returned_orders`
--

CREATE TABLE `returned_orders` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_returned` int(11) NOT NULL,
  `good_condition` int(11) NOT NULL,
  `damaged` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `address` varchar(160) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `type`, `address`, `country`, `state`, `city`, `status`, `added_date`, `updated_date`) VALUES
(1, 'Ajigbotoluwani IT Consult', 'Warehouse', 'No. 135, Zone 3 Gwarandok,Opposite COCIN Church', 'Nigeria', 'Plateau', 'Jos South', 'Active', '2023-08-01 11:18:24', '2023-08-22 17:40:12'),
(2, 'Js Enterprise', 'Warehouse', 'No. 136, Zone 3 Gwarandok,Opposite COCIN Church', 'Nigeria', 'Plateau', 'Jos South', 'Active', '2023-08-06 19:45:47', '2023-12-15 19:11:40'),
(3, 'JayMikee Ventures', 'Warehouse', 'No. 136, Zone 3 Gwarandok,Opposite COCIN Church', 'Nigeria', 'Plateau', 'Jos South', 'Active', '2023-08-06 19:46:20', '2023-12-15 19:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `phone` bigint(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(160) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `other_name` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone` bigint(15) NOT NULL,
  `residential_address` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(80) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `other_name`, `gender`, `date_of_birth`, `phone`, `residential_address`, `email`, `password`, `status`, `added_date`, `updated_date`) VALUES
(1, 'System', 'Administrator', '', '', '0000-00-00', 0, '', 'admin@wharehouse.com', '$2y$12$WmvliVBvn.dcZMuH6M3ZJuTbeXnKJ0a2ecwjbQuTPyUevbLwENi6G', 'Active', '2021-12-15 16:39:32', '2024-04-26 09:18:22'),
(16, 'John', 'Okhuevbie', 'Toluwani', 'Male', '1998-07-18', 8138450009, 'No. 135, Zone 3 Gwarandok,Opposite COCIN Church', 'johnotoluwani@gmail.com', '$2y$12$P6hsBF3EWtVQyE6rPQ8OCOT6LjnrP1zTSjOmrdZox2FhNavx/iYN2', 'Active', '2023-08-01 11:19:50', '2023-12-15 18:13:34'),
(20, 'Bitrus', 'Mariyom', '', 'Male', '0000-00-00', 8148635332, '', 'bitrus@warehouse.com', '$2y$12$NNKhbZ3B8cPAUxt3eziuCu48.vIYtrUMxuvf5MBbuyFAFaF3WH.Vy', 'Active', '2023-08-22 17:46:19', '2023-12-15 18:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `user_id` bigint(15) NOT NULL,
  `store_id` bigint(15) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'Active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `store_id`, `role`, `status`, `added_date`, `updated_date`) VALUES
(1, 1, 0, '0', 'Active', '2021-12-15 16:41:43', '2021-12-15 16:41:43'),
(20, 16, 0, '2', 'Active', '2023-12-15 18:14:46', '2023-12-15 18:14:46'),
(21, 20, 0, '3', 'Active', '2023-12-15 18:15:05', '2023-12-15 18:15:05'),
(22, 20, 1, '3', 'Active', '2023-12-15 18:44:15', '2023-12-15 18:44:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incoming_products`
--
ALTER TABLE `incoming_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_history`
--
ALTER TABLE `inventory_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_update`
--
ALTER TABLE `product_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returned_orders`
--
ALTER TABLE `returned_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incoming_products`
--
ALTER TABLE `incoming_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_history`
--
ALTER TABLE `inventory_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_update`
--
ALTER TABLE `product_update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returned_orders`
--
ALTER TABLE `returned_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
