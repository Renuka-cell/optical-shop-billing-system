-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2026 at 11:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing_system_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `created_at`) VALUES
(1, 'Rahul', '9876543210', 'rahul@gmail.com', '2026-06-20 12:58:08'),
(2, 'Renuka Biradar', '9010299087', 'biradarrenuka1101@gmail.com', '2026-06-21 15:09:28'),
(3, 'Shradha Bajaj', '8877665544', 'shradha@gmail.com', '2026-06-22 04:08:52'),
(4, 'Harshada Sahu', '9327634682', 'harshada@gmail.com', '2026-06-22 04:15:50'),
(5, 'Aadar Nehi', '6574839399', 'aadar@gmail.com', '2026-06-23 06:42:48'),
(6, 'Devika Narwade', '7632459812', 'devika@gmail.com', '2026-06-23 07:45:31'),
(7, 'John', '1111111111', 'John@gmail.com', '2026-06-23 08:21:55'),
(8, 'Preeti', '9972465389', 'preeti@gmail.com', '2026-06-23 08:30:36'),
(9, 'Sushmita Kehr', '7653910355', 'sushmita@gmail.com', '2026-06-23 09:07:03');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `invoice_number` varchar(100) DEFAULT NULL,
  `frame_type` varchar(100) DEFAULT 'Not Required',
  `frame_quantity` int(11) DEFAULT 0,
  `frame_price` decimal(10,2) DEFAULT 0.00,
  `glass_type` varchar(100) DEFAULT 'Not Required',
  `glass_quantity` decimal(10,2) DEFAULT 0.00,
  `glass_price` decimal(10,2) DEFAULT 0.00,
  `lens_type` varchar(200) DEFAULT 'Not Required',
  `total_amount` decimal(12,2) DEFAULT 0.00,
  `paid_amount` decimal(12,2) DEFAULT 0.00,
  `due_amount` decimal(12,2) DEFAULT 0.00,
  `payment_status` enum('PAID','PENDING','PARTIAL') DEFAULT 'PENDING',
  `payment_mode` enum('Cash','UPI','Card','Net Banking') DEFAULT 'Cash',
  `right_sph` varchar(20) DEFAULT NULL,
  `right_cyl` varchar(20) DEFAULT NULL,
  `right_axis` varchar(20) DEFAULT NULL,
  `right_add` varchar(20) DEFAULT NULL,
  `left_sph` varchar(20) DEFAULT NULL,
  `left_cyl` varchar(20) DEFAULT NULL,
  `left_axis` varchar(20) DEFAULT NULL,
  `left_add` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `created_by`, `invoice_number`, `frame_type`, `frame_quantity`, `frame_price`, `glass_type`, `glass_quantity`, `glass_price`, `lens_type`, `total_amount`, `paid_amount`, `due_amount`, `payment_status`, `payment_mode`, `right_sph`, `right_cyl`, `right_axis`, `right_add`, `left_sph`, `left_cyl`, `left_axis`, `left_add`, `date`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 'INV-2026-002', 'Metal', 2, 700.00, 'Single Vision', 1.00, 300.00, 'Photochromic', 1700.00, 1000.00, 700.00, 'PARTIAL', 'UPI', '+3.00', '+2.50', '-2', '0', '+1.75', '+4.50', '0', '-1', '2026-06-21', '2026-06-21 15:09:28', '2026-06-23 07:43:24'),
(3, 3, NULL, 'INV-2026-003', 'Plastic', 2, 600.00, 'Single Vision', 1.00, 800.00, 'Progressive', 2000.00, 500.00, 1500.00, 'PARTIAL', 'Card', '+2.00', '+1.75', '0', '0', '-4.75', '+1.00', '-1', '-1', '2026-06-22', '2026-06-22 04:08:52', '2026-06-23 06:46:11'),
(4, 4, NULL, 'INV-2026-004', 'Metal', 1, 700.00, 'Single Vision', 2.00, 200.00, 'Progressive', 1100.00, 500.00, 600.00, 'PARTIAL', 'UPI', '+1.75', '', '-1', '', '', '', '', '', '2026-06-22', '2026-06-22 04:15:50', '2026-06-23 06:46:11'),
(5, 2, NULL, 'INV-2026-005', 'Metal', 1, 500.00, 'Not Required', 0.00, 0.00, 'CR', 500.00, 20.00, 480.00, 'PARTIAL', 'Cash', '+1.50', '', '', '0', '', '', '-1', '', '2026-06-22', '2026-06-22 05:09:18', '2026-06-23 06:46:11'),
(6, 2, NULL, 'INV-2026-006', 'Metal', 1, 600.00, 'Progressive', 1.00, 300.00, '', 900.00, 30.00, 870.00, 'PARTIAL', 'Cash', '+2.25', '', '', '', '', '', '', '', '2026-06-22', '2026-06-22 06:39:20', '2026-06-23 06:46:11'),
(7, 2, NULL, 'INV-2026-007', 'Metal', 1, 600.00, 'Progressive', 1.00, 300.00, '', 900.00, 30.00, 870.00, 'PARTIAL', 'Cash', '+2.25', '', '', '', '', '', '', '', '2026-06-22', '2026-06-22 06:55:28', '2026-06-23 06:46:11'),
(11, 7, 1, 'INV-2026-008', 'Metal', 1, 600.00, 'Not Required', 0.00, 0.00, 'Not Required', 600.00, 40.00, 560.00, 'PARTIAL', 'Cash', '+3.00', '+2.25', '', '', '', '', '', '', '2026-06-23', '2026-06-23 08:24:38', '2026-06-23 08:24:38'),
(12, 8, 1, 'INV-2026-012', 'Metal', 1, 800.00, 'Single Vision', 1.00, 400.00, 'Not Required', 1200.00, 100.00, 1100.00, 'PARTIAL', 'UPI', '+2.50', '', '-1', '', '', '', '', '', '2026-06-23', '2026-06-23 08:30:36', '2026-06-23 08:30:36'),
(13, 2, 1, 'INV-2026-013', 'Plastic', 1, 600.00, 'Not Required', 0.00, 0.00, 'Blue Cut', 600.00, 500.00, 100.00, 'PARTIAL', 'Card', '+2.00', '+3.25', '', '', '', '', '', '', '2026-06-23', '2026-06-23 08:54:26', '2026-06-23 08:54:26'),
(14, 9, 1, 'INV-2026-014', 'Supra', 4, 600.00, 'Bifocal', 1.00, 500.00, 'Photochromic', 2900.00, 500.00, 2400.00, 'PARTIAL', 'Cash', '+2.50', '+3.75', '-1', '0', '+1.00', '+0.50', '', '0', '2026-06-23', '2026-06-23 09:07:03', '2026-06-23 09:09:12'),
(15, 3, 7, 'INV-2026-015', 'Three-pic', 1, 900.00, 'Not Required', 0.00, 0.00, 'Not Required', 900.00, 200.00, 700.00, 'PARTIAL', 'Cash', '+2.00', '', '', '', '', '', '', '', '2026-06-23', '2026-06-23 09:11:31', '2026-06-23 09:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `shop_details`
--

CREATE TABLE `shop_details` (
  `id` int(11) NOT NULL,
  `shop_name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `gst_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_details`
--

INSERT INTO `shop_details` (`id`, `shop_name`, `address`, `phone`, `email`, `gst_number`, `created_at`) VALUES
(1, 'Nayan Opticals Shop', 'Navi mumbai', '9898989898', 'nayanopticals@gmail.com', 'GST12345678910', '2026-06-22 05:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin123', 'admin', '2026-06-18 11:23:21'),
(2, 'Rohan_1', 'Rohan1@12345', 'staff', '2026-06-21 09:32:00'),
(4, 'Dipali', 'dipali@1234', 'staff', '2026-06-21 22:42:15'),
(6, 'Balaji', 'balaji@1234', 'staff', '2026-06-21 22:42:58'),
(7, 'Dinesh', 'dinesh@123', 'staff', '2026-06-23 03:40:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`),
  ADD KEY `fk_invoice_customer` (`customer_id`),
  ADD KEY `fk_invoice_user` (`created_by`);

--
-- Indexes for table `shop_details`
--
ALTER TABLE `shop_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shop_details`
--
ALTER TABLE `shop_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_invoice_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_invoice_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
