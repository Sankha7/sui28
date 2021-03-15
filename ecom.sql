-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 06:38 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `return_refund` longtext NOT NULL,
  `policy` longtext NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `link` varchar(100) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `tagline` varchar(50) NOT NULL,
  `spublick` varchar(255) DEFAULT NULL,
  `sprivatek` varchar(255) DEFAULT NULL,
  `tngmid` varchar(255) DEFAULT NULL,
  `tngsk` varchar(255) DEFAULT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `username`, `password`, `description`, `return_refund`, `policy`, `address`, `contact`, `link`, `company_name`, `logo`, `tagline`, `spublick`, `sprivatek`, `tngmid`, `tngsk`, `activate`) VALUES
(1, 'merchant', 'merchant', 'This is something', 'This is something', 'This is something', 'This is something', 9852145214, '', 'supercomnet', '27259671_wanglei-2.png', 'We accept Paypal', 'pk_test_51INEBOGL278dL0CplDj741hNu9yUVlA7rg2bkE8SD17oJO8T3BNcctWA2NDarisomflErlFwt1BUFz60dJPilybH00m0L9jCAz', 'sk_test_51INEBOGL278dL0CpmQ9ORPrssWb0rGgXN8NQCDBFU4hJjxHFIdh6xnqaOyByExVu9ydfHdExETDWm264Q7eu2tkp00MRd8nfat', 'JT01', '7jYcp4FxFdf0', 0),
(3, 'arpan123', 'arpan123', '', '', '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, 0),
(10, 'bibek', '12345', '', '', '', '', 0, 'https://projects.dotlinkertech.com/ecomproj/bibek', '', '', '', NULL, NULL, NULL, NULL, 0),
(12, 'supercomnet', 'supercomnet123', '', '', '', '', 0, 'https://projects.dotlinkertech.com/ecomproj/supercomnet', '', '', '', NULL, NULL, NULL, NULL, 0),
(13, 'dotlin', 'dotlin123', '', '', '', '', 0, 'http://sui28.com/?id=dotlin', '', '', '', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `merchant_id`, `category`, `status`) VALUES
(18, 1, 'Seafood', 1),
(19, 1, 'Combo', 1),
(20, 1, 'Hot Deals', 1),
(21, 1, 'Deal of the day', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `callback` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `callback`, `email`, `message`, `datetime`) VALUES
(5, 123456, '', '', '2021-03-09 12:25:01'),
(6, 0, 'test@email.com', 'test', '2021-03-09 12:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_postal` varchar(255) NOT NULL,
  `customer_phone` bigint(15) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `order_notes` text NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `txn_id` varchar(50) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `merchant_id`, `customer_name`, `customer_address`, `customer_postal`, `customer_phone`, `customer_email`, `order_notes`, `product_id`, `total`, `payment_status`, `txn_id`, `payment_method`, `modified`) VALUES
(6, 'ORD6034dfa0028ee', 1, 'Arpan Nag', '91/4/1 Bose Pukur Road', '700042', 8017008190, 'nag.arpan13@gmail.com', 'test', '23,', '7800.00', 'paid', 'pi_1INyaEGL278dL0Cp2o5lHb3i', 'FPX', '2021-02-23 11:58:32'),
(7, 'ORD6034e1e9183d9', 1, 'Arpan', 'Bose Pukur', '700042', 0, 'arpan@email.com', 'test', '23,25,', '12800.00', 'paid', 'pi_1INyjeGL278dL0CpOsTjMHIT', 'FPX', '2021-02-23 12:07:42'),
(11, 'ORD6034fa794b438', 1, 'Arpan Nag', '91/4/1 Bose Pukur Road', '700042', 8017008190, 'nag.arpan13@gmail.com', '', '23,', '78.00', 'pending', '', 'FPX', NULL),
(12, 'ORD6034fbb916590', 1, 'Arpan Nag', '91/4/1 Bose Pukur Road', '700042', 8017008190, 'nag.arpan13@gmail.com', '', '26,', '3500.00', 'paid', 'pi_1IO0SEGL278dL0Cp43DiE4jx', 'FPX', '2021-02-23 13:57:53'),
(13, 'ORD60379a0be28ea', 1, 'Arpan', 'Bose Pukur', '700042', 0, 'arpan@email.com', '', '21,', '2800.00', 'paid', 'pi_1IOj61GL278dL0Cp0Iwtt72t', 'FPX', '2021-02-25 13:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `delivery` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `merchant_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `status`, `delivery`) VALUES
(21, 18, 1, 'Chinese pomfret 500-600g', 30, 28, 100, '20790271_dou-chang-1024x922.jpg', 'Chinese pomfret 500-600g', 'Chinese pomfret 500-600g', '', '', '', 1, 1),
(22, 18, 1, 'Soon Hock 1-1.4KG +Fried Garlic', 40, 38, 100, '78684115_soonhock-garlic-1024x1024.jpg', 'Soon Hock 1-1.4kg', 'Soon Hock 1-1.4kg', '', '', '', 1, 1),
(23, 19, 1, 'Open Work Package', 80, 78, 100, '65995497_akred-grouperboston-1024x768.jpg', 'Red Grouper 1kg. Angka Prawn 800g. Boston Lobster 2 Piece', 'Red Grouper 1kg. Angka Prawn 800g. Boston Lobster 2 Piece', '', '', '', 1, 0),
(24, 20, 1, 'Angka Prawn x 2 box', 55, 50, 100, '68654193_2-ak-prawn-698x1024.jpg', 'Angka Prawn 800g x 2', 'Angka Prawn 800g x 2', '', '', '', 1, 1),
(25, 20, 1, 'Chinese pomfret + Angka Prawn 800g', 55, 50, 100, '66218260_ak-chinese-768x1024.jpg', 'hinese pomfret 500-600g. Angka Prawn 800g', 'hinese pomfret 500-600g. Angka Prawn 800g', '', '', '', 1, 1),
(26, 18, 1, 'Big AngKa Prawn 800g', 40, 35, 100, '33463406_big-AK-prwan-768x1024.jpg', 'Big AngKa Prawn 800g', 'Big AngKa Prawn 800g', '', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'super_admin', 'super@admin.com', 'super@admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(22) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `email`, `password`, `mobile`, `added_on`) VALUES
(1, 'u143gh', 'Souvik Sarkar', 'souvik@gmail.com', '123', 9804191249, '2021-02-14'),
(2, 'u602d23c52b4ab', 'Arpan Nag', 'nag.arpan13@gmail.com', 'arpan1234', 8017008190, '2021-02-17'),
(3, 'u602d272fad0dc', 'Souvik Sarkar', 'souvik@email.com', 'souvik1234', 1234567890, '2021-02-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
