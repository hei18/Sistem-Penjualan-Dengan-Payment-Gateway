-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 09:46 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(128) NOT NULL,
  `id_cs` int(11) NOT NULL,
  `id_product` varchar(128) NOT NULL,
  `title` varchar(100) NOT NULL,
  `qty` int(2) NOT NULL,
  `selling_price` double NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_cs` int(11) NOT NULL,
  `nickname` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(20) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(128) NOT NULL,
  `request_delete` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_cs`, `nickname`, `image`, `email`, `password`, `role`, `is_active`, `date_created`, `request_delete`) VALUES
(4, 'BeatAudio User', 'default.jpg', 'bernardbear1812@gmail.com', '$2y$10$HGremNXfzR6RsuUZN7.pkeetXITGAqngOWk14QFds2RY66yS.Guwe', 'customer', 1, 1670426334, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_bank`
--

CREATE TABLE `data_bank` (
  `id_bank` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `bank_name` varchar(20) NOT NULL,
  `bank_number` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_bank`
--

INSERT INTO `data_bank` (`id_bank`, `id_user`, `bank_name`, `bank_number`) VALUES
(7, 31, 'BRI', '011201094231503'),
(8, 31, 'BCA', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id_income` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `net_income` double NOT NULL,
  `ppn_income` double NOT NULL,
  `bank_name` varchar(20) NOT NULL,
  `bank_number` varchar(20) NOT NULL,
  `date_wd` datetime NOT NULL,
  `status_income` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id_income`, `id_user`, `email`, `net_income`, `ppn_income`, `bank_name`, `bank_number`, `date_wd`, `status_income`) VALUES
(11, 31, 'gilangtria18@gmail.com', 120000, 12000, 'BCA', '1234567890', '2022-12-07 21:08:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id_history` int(11) NOT NULL,
  `id_cs` int(128) NOT NULL,
  `id_product` varchar(128) NOT NULL,
  `order_id` varchar(128) NOT NULL,
  `full_version` varchar(128) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id_history`, `id_cs`, `id_product`, `order_id`, `full_version`, `status`) VALUES
(25, 4, 'BTA00001', '459329513', 'fa47bd444686d625a0286417c85abe67.wav', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` varchar(128) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `full_version` text NOT NULL,
  `demo_version` text NOT NULL,
  `genre` varchar(50) NOT NULL,
  `thumbnail` text NOT NULL,
  `description` text NOT NULL,
  `date_release` date NOT NULL,
  `price` double NOT NULL,
  `ppn` double NOT NULL,
  `selling_price` double NOT NULL,
  `status_product` int(1) NOT NULL,
  `sales` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `id_user`, `title`, `full_version`, `demo_version`, `genre`, `thumbnail`, `description`, `date_release`, `price`, `ppn`, `selling_price`, `status_product`, `sales`) VALUES
('BTA00001', 31, 'Yellow Moon', 'fa47bd444686d625a0286417c85abe67.wav', '7cef349e2aa49bcbe26be0554b7c8a62.wav', 'Hip Hop', '1500x1500-abstract-dfg40014.jpg', '85 Bpm', '2022-12-07', 120000, 12000, 132000, 1, 0),
('BTA00002', 31, 'Narnia', 'af98f761b2181ad0bcab17d51971d56d.mp3', 'a1d223e1f339de43b089213b443a4636.wav', 'Heavy Metal', '1500x1500-abstract-dfg4003.jpg', '80BPM', '2022-12-07', 120000, 12000, 132000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id_profiles` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_cs` int(11) DEFAULT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id_profiles`, `id_user`, `id_cs`, `first_name`, `last_name`, `phone_number`, `address`) VALUES
(21, 31, NULL, 'Ultron', 'Siahaan', '081325139539', 'South East Asian'),
(22, NULL, 4, 'Nick', 'Saw', '081325139539', 'South Asian');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `order_id` varchar(100) NOT NULL,
  `id_cs` int(128) NOT NULL,
  `status_message` varchar(40) NOT NULL,
  `gross_amount` double NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `transaction_status` varchar(40) NOT NULL,
  `pdf_url` text NOT NULL,
  `status_code` int(3) NOT NULL,
  `bank` varchar(40) NOT NULL,
  `permata_va_number` varchar(200) NOT NULL,
  `va_number` varchar(200) NOT NULL,
  `bill_key` varchar(200) NOT NULL,
  `biller_code` varchar(200) NOT NULL,
  `bca_va_number` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`order_id`, `id_cs`, `status_message`, `gross_amount`, `payment_type`, `transaction_time`, `transaction_status`, `pdf_url`, `status_code`, `bank`, `permata_va_number`, `va_number`, `bill_key`, `biller_code`, `bca_va_number`) VALUES
('459329513', 4, '', 132000, 'bank_transfer', '2022-12-07 23:17:55', 'pending', 'https://app.sandbox.midtrans.com/snap/v1/transactions/709a16de-b227-45fd-b27b-f488f3c46a41/pdf', 200, 'bca', '', '60620084456', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nickname` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` text NOT NULL,
  `role` enum('admin','beatmaker') NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(128) NOT NULL,
  `request_delete` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nickname`, `image`, `email`, `password`, `role`, `is_active`, `date_created`, `request_delete`) VALUES
(28, 'BeatAudio User', 'default.jpg', 'hohegagy@givmail.com', '$2y$10$likXLUfMhXgY7qXRBUuFjOm2CPbK6myp9661nvsrZOofA4b5Lm0TS', 'beatmaker', 1, 1670152293, NULL),
(29, 'admin', 'default.jpg', 'beataudio1812@gmail.com', '$2y$10$wScqLiDukPK.PkyoEZ0RB.SBDQ6TiJ9K8c1RRJuLqqx9PvkX4/GGG', 'admin', 1, 1, NULL),
(31, 'Nick Rexus', 'default.jpg', 'gilangtria18@gmail.com', '$2y$10$0WzIHHhSKlt9cm6ydRk6vuBfKkx8eNm2vpy4braRWafroyBKXOLle', 'beatmaker', 1, 1670419335, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` text NOT NULL,
  `date_created` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_cs`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_cs`);

--
-- Indexes for table `data_bank`
--
ALTER TABLE `data_bank`
  ADD PRIMARY KEY (`id_bank`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id_income`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `id_cs` (`id_cs`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id_profiles`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_cs` (`id_cs`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `id_user` (`id_cs`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_cs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_bank`
--
ALTER TABLE `data_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profiles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_cs`) REFERENCES `customer` (`id_cs`);

--
-- Constraints for table `data_bank`
--
ALTER TABLE `data_bank`
  ADD CONSTRAINT `data_bank_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION;

--
-- Constraints for table `order_history`
--
ALTER TABLE `order_history`
  ADD CONSTRAINT `order_history_ibfk_1` FOREIGN KEY (`id_cs`) REFERENCES `customer` (`id_cs`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `profiles_ibfk_2` FOREIGN KEY (`id_cs`) REFERENCES `customer` (`id_cs`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_cs`) REFERENCES `customer` (`id_cs`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
