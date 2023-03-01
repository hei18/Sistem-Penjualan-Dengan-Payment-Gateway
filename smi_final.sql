-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20230129.b4b43e3f76
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2023 at 09:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smi_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(125) NOT NULL,
  `is_active` int(1) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `bill_price` double NOT NULL,
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
  `request_delete` varchar(20) DEFAULT NULL,
  `personal_pdf` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id_income` int(11) NOT NULL,
  `wd_id` varchar(100) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `net_income` double NOT NULL,
  `ppn_income` double NOT NULL,
  `bank_name` varchar(20) NOT NULL,
  `bank_number` varchar(20) NOT NULL,
  `date_wd` datetime NOT NULL,
  `date_approve` datetime DEFAULT NULL,
  `status_income` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id_income`, `wd_id`, `id_user`, `email`, `net_income`, `ppn_income`, `bank_name`, `bank_number`, `date_wd`, `date_approve`, `status_income`) VALUES
(28, 'BA-WD-1708918003', NULL, 'beatmaker@vomoto.com', 120000, 12000, 'BRI', '01235484535', '2023-01-30 08:54:48', '2023-02-11 00:14:46', 1),
(29, 'BA-WD-639346195', NULL, 'beatmaker@vomoto.com', 120000, 12000, 'BRI', '02135432154132', '2023-01-30 22:29:04', '2023-02-11 00:14:46', 1),
(30, 'BA-WD-113209835', NULL, 'beatmaker@vomoto.com', 120000, 12000, 'BCA', '12345678910', '2023-02-11 00:14:21', '2023-02-11 00:14:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id_history` int(11) NOT NULL,
  `id_cs` int(128) NOT NULL,
  `id_product` varchar(128) NOT NULL,
  `order_id` varchar(128) NOT NULL,
  `title` varchar(120) NOT NULL,
  `full_version` varchar(128) NOT NULL,
  `genre` varchar(60) NOT NULL,
  `bill_price` double NOT NULL,
  `qty` int(10) NOT NULL,
  `subtotal` double NOT NULL,
  `file_token` varchar(128) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(60) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `id_cs` int(128) NOT NULL,
  `gross_amount` double NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `settlement_time` datetime DEFAULT NULL,
  `transaction_status` varchar(40) NOT NULL,
  `pdf_url` text NOT NULL,
  `status_code` int(3) NOT NULL,
  `bank` varchar(40) NOT NULL,
  `va_number` varchar(200) NOT NULL,
  `biller_code` varchar(200) NOT NULL,
  `transaction_id` text NOT NULL,
  `button_handle` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `role` varchar(10) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(128) NOT NULL,
  `request_delete` varchar(20) DEFAULT NULL,
  `personal_pdf` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` text NOT NULL,
  `date_created` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id_admin`);

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
  ADD PRIMARY KEY (`id_transaction`),
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
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_cs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `data_bank`
--
ALTER TABLE `data_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profiles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_cs`) REFERENCES `customer` (`id_cs`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE;

--
-- Constraints for table `data_bank`
--
ALTER TABLE `data_bank`
  ADD CONSTRAINT `data_bank_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_cs`) REFERENCES `customer` (`id_cs`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
