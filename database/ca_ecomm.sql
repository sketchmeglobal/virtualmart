-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 11:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ca_ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `common_settings`
--

CREATE TABLE `common_settings` (
  `csid` int(11) NOT NULL,
  `customer_signup_bonus` double(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `common_settings`
--

INSERT INTO `common_settings` (`csid`, `customer_signup_bonus`) VALUES
(1, 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`id`, `user_id`, `product_id`, `order_id`, `quantity`, `created_date`, `modified_date`, `status`) VALUES
(1, 1, '50', 1, 1, '2023-01-07 09:02:15', '2023-01-07 09:02:15', 1),
(2, 1, '50', 1, 1, '2023-01-07 09:21:24', '2023-01-07 09:21:24', 1),
(3, 1, '50', 1, 1, '2023-01-07 09:23:24', '2023-01-07 09:23:24', 1),
(4, 31, '50', 2, 1, '2023-01-07 09:47:53', '2023-01-07 09:47:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE `tbl_brands` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_title` varchar(120) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brands`
--

INSERT INTO `tbl_brands` (`id`, `logo`, `brand_name`, `brand_title`, `website`, `created_date`, `modified_date`, `status`) VALUES
(1, '', '', NULL, NULL, '2022-12-29 06:27:46', '2022-12-29 06:27:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartid` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL DEFAULT 0,
  `cosultant_id` bigint(20) NOT NULL DEFAULT 0 COMMENT 'this is user_id for consultant user_type',
  `product_qty` int(11) NOT NULL DEFAULT 1,
  `coupon_id` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) DEFAULT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=user deleted, 1 = active, 2 = order placed',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartid`, `user_id`, `product_id`, `cosultant_id`, `product_qty`, `coupon_id`, `coupon_code`, `cart_status`, `added_on`, `updated_on`) VALUES
(2, 1, 50, 0, 1, 0, NULL, 2, '2023-01-07 08:58:23', '2023-01-07 09:23:24'),
(3, 31, 50, 30, 1, 0, NULL, 2, '2023-01-07 09:47:26', '2023-01-07 09:47:53'),
(4, 31, 50, 0, 1, 0, NULL, 1, '2023-01-07 10:28:31', '2023-01-07 10:28:31'),
(5, 30, 50, 30, 1, 0, NULL, 1, '2023-01-07 11:11:02', '2023-01-07 11:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_charges`
--

CREATE TABLE `tbl_charges` (
  `charges_id` int(11) NOT NULL,
  `vendor_charge` double(15,2) NOT NULL DEFAULT 0.00,
  `withdrawal_charges` double(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_charges`
--

INSERT INTO `tbl_charges` (`charges_id`, `vendor_charge`, `withdrawal_charges`) VALUES
(1, 0.00, 3.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_child_category`
--

CREATE TABLE `tbl_child_category` (
  `tccid` int(11) NOT NULL,
  `tc_parent_cat_id` bigint(20) NOT NULL DEFAULT 0,
  `tc_name` varchar(255) DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `show_slider` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tc_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_child_category`
--

INSERT INTO `tbl_child_category` (`tccid`, `tc_parent_cat_id`, `tc_name`, `feature_image`, `show_slider`, `created_date`, `modified_date`, `tc_status`) VALUES
(1, 1, 'Face Makeup', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(2, 5, 'Bath & Body', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(3, 2, 'Eye Makeup', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(4, 2, 'Lip Makeup', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(5, 2, 'Nails', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(6, 2, 'brushes & Tools', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(7, 3, 'Cleanser', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(8, 3, 'Toner & Face Mists', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(9, 3, 'Moisturzers', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(10, 3, 'Masks', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(11, 3, 'Sunscreen', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(12, 3, 'eye care', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(13, 3, 'Lip care', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(14, 3, 'Body Care', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(15, 3, 'Bath & Shower', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(16, 3, 'Hand & Foot Care', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(17, 3, 'Aromatheraphy', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(18, 4, 'Sampoo & Conditiner', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(19, 4, 'Nourishment', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(20, 4, 'Hair Styling & Tools', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(21, 4, 'Hair Accessories', '202212241151371a29e54e32639031a15ffef5c5a76d12dbbab906.jpg', 1, '2022-12-23 19:52:45', '2022-12-24 06:23:55', 1),
(22, 5, 'Dental Care', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(23, 5, 'Hair Care', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(24, 6, 'Fragnance for Women', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(25, 6, 'Fragnance for Men', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(26, 8, 'Baby Skin Care', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(27, 8, 'Hair', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(28, 8, 'Maternity', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(29, 7, 'Health Supplement', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(30, 7, 'Health Food & Drinks', NULL, 1, '2022-12-23 19:52:45', '2022-12-24 06:39:25', 1),
(31, 9, 'Basamati', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(32, 10, 'Panner', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(33, 10, 'Milk', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(34, 11, 'birthday cake', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(35, 11, 'muffins', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(36, 9, 'baskathi', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(37, 9, 'gobinda vog', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(38, 12, 'conflower', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(39, 12, 'atta', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(40, 2, 'foundation', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(41, 2, 'lip stick', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(42, 2, 'powder', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(43, 2, 'eye brow pallet', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(44, 2, 'blush pallet', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(45, 2, 'eye shadow pallet', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(46, 3, 'cream', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(47, 3, 'essential oil', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(48, 3, 'musk', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(49, 3, 'scrub', NULL, 0, '2022-12-23 19:52:45', '2022-12-23 19:52:45', 1),
(50, 11, 'muffins', '2022122411444171d87d4cee5705fd5ea81800f6daecef4f548641.jpg', 1, '2022-12-23 20:18:59', '2022-12-24 06:15:57', 1),
(52, 13, 'Oil', '20221224132359f0178f95bed3b706b9a883af0f8869b4071183d8.jpg', 1, '2022-12-24 07:53:59', '2022-12-24 07:53:59', 1),
(53, 13, 'Fruits', '20221224140052c71bfc29321f67778cd1fc698248f2792e190e4f.jpg', 1, '2022-12-24 08:30:52', '2022-12-24 08:30:52', 1),
(54, 14, 'sprite', NULL, 1, '2022-12-24 12:09:38', '2022-12-24 12:09:38', 1),
(55, 14, 'cocacola', NULL, 1, '2022-12-24 12:09:59', '2022-12-24 12:09:59', 1),
(56, 14, 'limca', NULL, 1, '2022-12-24 12:10:30', '2022-12-24 12:10:30', 1),
(57, 14, 'mirinda', NULL, 1, '2022-12-24 12:11:10', '2022-12-24 12:11:10', 1),
(58, 14, 'tropicana', NULL, 1, '2022-12-24 12:12:00', '2022-12-24 12:12:00', 1),
(59, 14, 'tang', NULL, 1, '2022-12-24 12:12:11', '2022-12-24 12:12:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_child_coupon_code`
--

CREATE TABLE `tbl_child_coupon_code` (
  `cccid` int(11) NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `allow_type` enum('ALLOW','DISALLOW') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_child_coupon_code`
--

INSERT INTO `tbl_child_coupon_code` (`cccid`, `coupon_id`, `product_id`, `allow_type`, `created_at`) VALUES
(1, 2, 50, 'DISALLOW', '2023-01-07 11:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_commission_added`
--

CREATE TABLE `tbl_commission_added` (
  `caid` int(11) NOT NULL,
  `consultant_id` bigint(20) DEFAULT NULL,
  `order_hdr_id` bigint(20) NOT NULL,
  `purchase_usr_id` bigint(20) NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `product_price` double(255,2) DEFAULT NULL,
  `total_price` double(255,2) DEFAULT NULL,
  `commission_amt` double(255,2) NOT NULL,
  `commission_percen` double(255,2) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_commission_added`
--

INSERT INTO `tbl_commission_added` (`caid`, `consultant_id`, `order_hdr_id`, `purchase_usr_id`, `product_id`, `product_qty`, `product_price`, `total_price`, `commission_amt`, `commission_percen`, `added_on`, `update_on`) VALUES
(1, 30, 2, 31, 50, 1, 256.00, 256.00, 25.60, 10.00, '2023-01-07 09:47:53', '2023-01-07 09:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_commission_set`
--

CREATE TABLE `tbl_commission_set` (
  `csid` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `commission` double NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_commission_set`
--

INSERT INTO `tbl_commission_set` (`csid`, `user_id`, `commission`, `added_on`) VALUES
(1, 18, 10, '2022-12-24 09:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupons`
--

CREATE TABLE `tbl_coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `allowed_products` text DEFAULT NULL,
  `disallowed_products` text DEFAULT NULL,
  `coupon_type` enum('FIXED','PERCENTAGE') NOT NULL DEFAULT 'PERCENTAGE',
  `amount` double(30,2) NOT NULL DEFAULT 0.00,
  `max_limit` int(11) DEFAULT NULL COMMENT 'total customers used',
  `left_limit` int(11) NOT NULL DEFAULT 0,
  `expiary_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=inactive, 1=active, 2=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_coupons`
--

INSERT INTO `tbl_coupons` (`coupon_id`, `coupon_code`, `allowed_products`, `disallowed_products`, `coupon_type`, `amount`, `max_limit`, `left_limit`, `expiary_date`, `created_at`, `updated_at`, `status`) VALUES
(1, 'TEST001', '', '', 'PERCENTAGE', 10.00, 10, 9, '2023-01-31', '2023-01-07 09:01:11', '2023-01-07 09:02:15', 1),
(2, 'TEST0005', '', '50', 'FIXED', 5.00, 10, 10, '2023-01-07', '2023-01-07 11:15:10', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_front_about`
--

CREATE TABLE `tbl_front_about` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `info1` text NOT NULL,
  `info2` text NOT NULL,
  `info3` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_front_about`
--

INSERT INTO `tbl_front_about` (`id`, `content`, `info1`, `info2`, `info3`, `created_date`, `modified_date`, `status`) VALUES
(1, 'Who We Are\r\n\r\nSed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, uctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis.\r\nsignature', 'Design Quality\r\n\r\nSed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero\r\neu augue.', 'Professional Support\r\n\r\nSed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero\r\neu augue.', 'Progressing Together\r\n\r\nSed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero\r\neu augue.', '2022-12-24 18:08:07', '2022-12-24 18:08:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_front_images`
--

CREATE TABLE `tbl_front_images` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `position` enum('Left','Right','Bottom') NOT NULL,
  `front_image` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_front_images`
--

INSERT INTO `tbl_front_images` (`id`, `category`, `position`, `front_image`, `created_date`, `modified_date`, `status`) VALUES
(1, 1, 'Left', '202212241511278b163dcb4668148d6d5fd74778da564fda582f1e.png', '2022-12-24 08:45:50', '2022-12-24 10:00:45', 1),
(2, 5, 'Right', '202212241511498b163dcb4668148d6d5fd74778da564fda582f1e.png', '2022-12-24 09:06:59', '2022-12-24 10:06:09', 1),
(3, 3, 'Bottom', '20221224151207d9ee7ca29cdba77e8851d966f8567e19d0b8aacf.png', '2022-12-24 09:07:55', '2022-12-24 10:00:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kyc`
--

CREATE TABLE `tbl_kyc` (
  `kyc_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `bank_name` varchar(100) NOT NULL,
  `bank_ifsc` varchar(20) NOT NULL,
  `bank_ac_no` varchar(50) NOT NULL,
  `bank_branch` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kyc`
--

INSERT INTO `tbl_kyc` (`kyc_id`, `user_id`, `bank_name`, `bank_ifsc`, `bank_ac_no`, `bank_branch`, `added_on`, `updated_on`) VALUES
(1, 30, 'PNB', '1', '1', '1', '2023-01-07 09:49:28', '2023-01-07 09:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

CREATE TABLE `tbl_newsletter` (
  `id` int(11) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newsletter`
--

INSERT INTO `tbl_newsletter` (`id`, `email_id`, `created_date`, `modified_date`, `status`) VALUES
(1, 'demo@demo.om', '2022-12-26 10:18:46', '2022-12-26 10:18:46', 1),
(2, 'abc@anc.com', '2022-12-26 10:56:30', '2022-12-26 10:56:30', 1),
(38, 'sd@sd.com', '2022-12-26 11:01:29', '2022-12-26 11:01:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_dtl`
--

CREATE TABLE `tbl_order_dtl` (
  `order_dtl_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `consultant_id` bigint(20) NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL DEFAULT 0,
  `order_id` longtext DEFAULT NULL,
  `order_hdr_id` bigint(20) NOT NULL DEFAULT 0,
  `merge_p_id` varchar(255) DEFAULT NULL,
  `coupon_id` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_actual_amt` double(30,2) DEFAULT NULL,
  `coupon_type` enum('FIXED','PERCENTAGE') DEFAULT NULL,
  `discount_amt` double(30,2) DEFAULT NULL,
  `product_qty` bigint(20) NOT NULL DEFAULT 0,
  `product_price` double(255,2) NOT NULL DEFAULT 0.00,
  `total_paid_amnt` double(255,2) NOT NULL DEFAULT 0.00,
  `cgst` double(15,2) NOT NULL DEFAULT 0.00,
  `igst` double(15,2) NOT NULL DEFAULT 0.00,
  `sgst` double(15,2) NOT NULL DEFAULT 0.00,
  `f_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `street_addrs` varchar(255) DEFAULT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=pending, 1=order_placed, 2=order_delivered, 3=order_cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order_dtl`
--

INSERT INTO `tbl_order_dtl` (`order_dtl_id`, `user_id`, `consultant_id`, `product_id`, `order_id`, `order_hdr_id`, `merge_p_id`, `coupon_id`, `coupon_code`, `coupon_actual_amt`, `coupon_type`, `discount_amt`, `product_qty`, `product_price`, `total_paid_amnt`, `cgst`, `igst`, `sgst`, `f_name`, `l_name`, `company`, `country`, `street_addrs`, `apartment`, `town`, `state`, `zip`, `notes`, `phone`, `email`, `added_on`, `updated_on`, `order_status`) VALUES
(1, 1, 0, 50, 'OD0000100000001', 1, '50', 0, NULL, NULL, NULL, NULL, 1, 256.00, 256.00, 9.00, 3.00, 6.00, 'CA', 'Ecomm', 'Company', 'India', 'Kolkata', '32', 'Kolkata, Dunlop', 'West Bengal', '7000125', '', '9330887842', 'test@gmail.com', '2023-01-07 09:23:24', '2023-01-07 09:23:24', 1),
(2, 31, 30, 50, 'OD0003100030002', 2, '50', 0, NULL, NULL, NULL, NULL, 1, 256.00, 256.00, 9.00, 3.00, 6.00, 'Sayub', 'Ali', 'Company', 'India', 'Kolkata', '32', 'Kolkata, Dunlop', 'West Bengal', '7000125', '', '9330887842', 'test@gmail.com', '2023-01-07 09:47:53', '2023-01-07 09:47:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_hdr`
--

CREATE TABLE `tbl_order_hdr` (
  `order_hdr_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `consultant_id` bigint(20) NOT NULL DEFAULT 0,
  `products_id` varchar(255) DEFAULT NULL,
  `order_id` longtext DEFAULT NULL,
  `order_dtl_id` varchar(255) DEFAULT NULL,
  `coupon_id` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_actual_amt` double(30,2) DEFAULT NULL,
  `coupon_type` enum('FIXED','PERCENTAGE') DEFAULT NULL,
  `discount_amt` double(30,2) DEFAULT NULL,
  `pay_amnt` double(255,2) NOT NULL DEFAULT 0.00,
  `total_amt` double(255,2) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=pending, 1=order_placed, 2=order_delivered, 3=order_cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order_hdr`
--

INSERT INTO `tbl_order_hdr` (`order_hdr_id`, `user_id`, `consultant_id`, `products_id`, `order_id`, `order_dtl_id`, `coupon_id`, `coupon_code`, `coupon_actual_amt`, `coupon_type`, `discount_amt`, `pay_amnt`, `total_amt`, `added_on`, `updated_on`, `order_status`) VALUES
(1, 1, 0, '50', 'OD0000100000001', '1', 0, '', 0.00, '', 0.00, 256.00, 256.00, '2023-01-07 09:23:24', '2023-01-07 09:23:24', 1),
(2, 31, 30, '50', 'OD0003100030002', '2', 0, '', 0.00, '', 0.00, 256.00, 256.00, '2023-01-07 09:47:53', '2023-01-07 09:47:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parent_category`
--

CREATE TABLE `tbl_parent_category` (
  `p_cid` int(11) NOT NULL,
  `p_c_name` varchar(255) DEFAULT NULL,
  `p_c_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_parent_category`
--

INSERT INTO `tbl_parent_category` (`p_cid`, `p_c_name`, `p_c_status`) VALUES
(2, 'Makeup', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_dtl`
--

CREATE TABLE `tbl_product_dtl` (
  `pdid` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `pd_images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_dtl`
--

INSERT INTO `tbl_product_dtl` (`pdid`, `product_id`, `pd_images`) VALUES
(1, 50, '20230107142418f246cf4c354028f7b2e4f702d65044ff68e0ea41.png,202301071424182908b1b7d102052e17cb6e351217ca5a2298ae33.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_hdr`
--

CREATE TABLE `tbl_product_hdr` (
  `phid` int(11) NOT NULL,
  `show_trending_today` int(11) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `vendor_id` int(11) DEFAULT NULL,
  `ph_title` varchar(255) NOT NULL,
  `p_cat_id` bigint(20) NOT NULL,
  `p_cat_name` varchar(255) NOT NULL,
  `c_cat_id` bigint(20) NOT NULL,
  `c_cat_name` varchar(255) DEFAULT NULL,
  `ph_price` double NOT NULL DEFAULT 0,
  `ph_dp` double(15,2) NOT NULL DEFAULT 0.00,
  `ph_shipping_charge` double(15,2) NOT NULL DEFAULT 0.00,
  `ph_tax` double(15,2) NOT NULL DEFAULT 0.00,
  `ph_bonus` double(15,2) NOT NULL DEFAULT 0.00,
  `ph_short_desc` text NOT NULL,
  `ph_desc` longtext NOT NULL,
  `ph_feature_img` varchar(555) DEFAULT NULL,
  `opening_stock` int(11) NOT NULL DEFAULT 1,
  `ph_qty` int(11) NOT NULL COMMENT 'current stock',
  `ph_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=inactive, 1=active, 2=deleted',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_hdr`
--

INSERT INTO `tbl_product_hdr` (`phid`, `show_trending_today`, `vendor_id`, `ph_title`, `p_cat_id`, `p_cat_name`, `c_cat_id`, `c_cat_name`, `ph_price`, `ph_dp`, `ph_shipping_charge`, `ph_tax`, `ph_bonus`, `ph_short_desc`, `ph_desc`, `ph_feature_img`, `opening_stock`, `ph_qty`, `ph_status`, `created_at`, `updated_at`) VALUES
(50, 1, 1, 'Maybline Fit Me', 2, 'Makeup', 43, 'eye brow pallet', 256, 0.00, 0.00, 0.00, 0.00, '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro animi provident vitae qui tempora est omnis sunt perferendis quo. Ipsa soluta sit maiores eos odit voluptates dicta et, corrupti officia!</p>\r\n', '{\"Model Number\":\"1699\",\"Skin Type\":\"Woman\"}', '20230107142418a5dd19bf9f94caf84769d150bf049e0a0348143f.jpg', 50, 46, 1, '2023-01-07 08:54:18', '2023-01-07 09:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_signup_bonus_history`
--

CREATE TABLE `tbl_signup_bonus_history` (
  `hid` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `bonus_amt` double(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `muted_text` varchar(100) NOT NULL,
  `header` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `button_label` varchar(100) NOT NULL DEFAULT 'Discover Now',
  `slider_image` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `muted_text`, `header`, `category`, `button_label`, `slider_image`, `created_date`, `modified_date`, `status`) VALUES
(1, 'New Arrivals', 'New Way To  Dress Up for Winter Collection', '4', 'Discover Now', '202212241046378ffe387e0bff78007b8ce5e1c8640d47b21a6c98.jpg', '2022-12-24 05:16:37', '2022-12-24 06:34:15', 1),
(2, 'Spring Collection', 'New Way To  Dress Up for Spring Collection', '3', 'Discover Now', '20221224105710b8b4b94bd00a62f3ec0f6112ca9fb272c692191a.jpg', '2022-12-24 05:17:02', '2022-12-24 06:34:26', 1),
(3, 'Seasonal Beauty', 'New Way To  Dress Up for New Collection', '2', 'Discover Now', '20221224110104d721386050b73e9345ad6e4c44dbe75071ca4926.jpg', '2022-12-24 05:17:12', '2022-12-24 06:34:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `cartid` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL DEFAULT 0,
  `product_qty` int(11) NOT NULL DEFAULT 1,
  `cart_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deleted, 1 = active',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`cartid`, `user_id`, `product_id`, `product_qty`, `cart_status`, `added_on`, `updated_on`) VALUES
(12, 28, 32, 15, 1, '2022-12-30 12:08:57', '2022-12-30 12:09:15'),
(13, 1, 32, 10, 1, '2023-01-05 07:02:32', '2023-01-05 07:02:41'),
(14, 1, 20, 1, 1, '2023-01-05 07:05:56', '2023-01-05 07:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdrawal`
--

CREATE TABLE `tbl_withdrawal` (
  `withdrawal_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `txn_id` varchar(255) DEFAULT NULL,
  `request_amt` double(30,2) NOT NULL DEFAULT 0.00,
  `tds` double(15,2) NOT NULL DEFAULT 0.00,
  `imps` double(15,2) NOT NULL DEFAULT 0.00,
  `admin` double(15,2) NOT NULL DEFAULT 0.00,
  `gst` double(15,2) NOT NULL DEFAULT 0.00,
  `payout` double(30,2) NOT NULL DEFAULT 0.00,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `withdrawal_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved, 2=rejected, 3=deleted',
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_withdrawal`
--

INSERT INTO `tbl_withdrawal` (`withdrawal_id`, `user_id`, `txn_id`, `request_amt`, `tds`, `imps`, `admin`, `gst`, `payout`, `added_on`, `updated_on`, `withdrawal_status`, `remarks`) VALUES
(1, 30, NULL, 25.00, 0.00, 0.00, 0.00, 0.00, 24.25, '2023-01-07 09:49:49', '2023-01-07 09:49:49', 0, NULL),
(3, 30, NULL, 200.00, 2.00, 4.00, 4.00, 4.00, 186.00, '2023-01-09 08:45:40', '2023-01-09 08:45:40', 0, NULL),
(4, 30, NULL, 200.00, 2.00, 4.00, 4.00, 4.00, 186.00, '2023-01-09 08:46:10', '2023-01-09 08:46:10', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdrawal_setting`
--

CREATE TABLE `tbl_withdrawal_setting` (
  `wsid` int(11) NOT NULL,
  `min_withdrawal` double(15,2) NOT NULL,
  `imps` double(15,2) NOT NULL,
  `tds` double(15,2) NOT NULL,
  `admin` double(15,2) NOT NULL,
  `gst` double(15,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_withdrawal_setting`
--

INSERT INTO `tbl_withdrawal_setting` (`wsid`, `min_withdrawal`, `imps`, `tds`, `admin`, `gst`, `updated_at`) VALUES
(1, 200.00, 2.00, 1.00, 2.00, 3.00, '2023-01-10 07:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(555) DEFAULT NULL,
  `ewallet` double(255,2) NOT NULL DEFAULT 0.00,
  `bonus_wallet` double(30,2) NOT NULL DEFAULT 0.00,
  `comission` double NOT NULL DEFAULT 0 COMMENT 'this is comission for user affilate system per product wise percentage comission',
  `role` int(11) NOT NULL DEFAULT 0 COMMENT '1=admin,0=user,2=consultant',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deleted, 1=activated, 2=inactive',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_type` enum('SUPERADMIN','ADMIN','VENDOR','CONSULTANT','USER') NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `vendor_id`, `profile_image`, `f_name`, `l_name`, `contact`, `email`, `pass`, `ewallet`, `bonus_wallet`, `comission`, `role`, `status`, `created_on`, `updated_on`, `user_type`) VALUES
(1, NULL, '', 'CA', 'Ecomm', '9090909090', 'admin@gmail.com', 'c42dac5ac71c9c29e97d25f5712f1f27', 0.00, 0.00, 0, 1, 1, '0000-00-00 00:00:00', '2023-01-05 08:07:48', 'ADMIN'),
(29, 1, '2023010714163904301dcf658c068360e02f6fbd0f1e1479d9e083.png', 'Sayub', 'Ali', '000', 'vendor@gmail.com', 'c42dac5ac71c9c29e97d25f5712f1f27', 0.00, 0.00, 0, 0, 1, '2023-01-07 08:46:39', '2023-01-07 08:46:39', 'VENDOR'),
(30, 6, NULL, 'Sayub', 'test', '303030', '303030@gmail.com', 'c42dac5ac71c9c29e97d25f5712f1f27', 100.00, 0.00, 10, 0, 1, '2023-01-07 09:37:52', '2023-01-09 08:46:10', 'CONSULTANT'),
(31, NULL, NULL, 'Sayub', 'Ali', '4040', '4040@gmail.com', 'c42dac5ac71c9c29e97d25f5712f1f27', 0.00, 0.00, 0, 0, 1, '2023-01-06 18:30:00', '2023-01-07 09:47:26', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `gst` varchar(20) DEFAULT NULL,
  `main_person_name` varchar(100) DEFAULT NULL,
  `main_person_email` varchar(120) DEFAULT NULL,
  `main_person_contact` varchar(100) DEFAULT NULL,
  `about` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `company_name`, `logo`, `email`, `contact`, `website`, `gst`, `main_person_name`, `main_person_email`, `main_person_contact`, `about`, `created_date`, `modified_date`, `status`) VALUES
(1, 'VENDOR 1', '2023010714063604301dcf658c068360e02f6fbd0f1e1479d9e083.png', 'vendor1@gmail.com', '909030301010', '', NULL, 'Vendor a1', 'vendor.a1@gmail.com', '202000000', '', '2023-01-07 08:36:36', '2023-01-07 08:36:36', 1),
(2, 'VENDOR 2', '202301071414105464dfd4a88cd64c0fc48637ae41ab47c04b0277.png', 'vendor1@gmail.comm', '9090303010101', 'www.meyogesh.io', NULL, 'Vendor a1', 'vendor.a1@gmail.com', '202000000', '', '2023-01-07 08:44:10', '2023-01-07 08:45:37', 1),
(3, 'VENDOR 2', '20230107141429aefc3892e45d1a6bac427ab1068964f69a9d9be8.png', 'vendor2@gmail.com', '909030301', 'www.meyogesh.io', NULL, 'Vendor a1', 'vendor.a1@gmail.com', '202000000', '', '2023-01-07 08:44:29', '2023-01-07 08:45:40', 1),
(4, 'VENDOR 3', '20230107141450e19dff4f25144811bafe3fea0b034a4e74e6892e.png', 'vendor3@gmail.com', '90902', 'www.meyogesh.io', NULL, 'Vendor a1', 'vendor.a1@gmail.com', '202000000', '', '2023-01-07 08:44:50', '2023-01-07 08:45:42', 1),
(5, 'VENDOR 4', '20230107141511ff7673639341d60dbe64eb8753546a41d0e9c46e.png', 'vendor5@gmail.com', '90905', 'www.meyogesh.io', NULL, 'Vendor a1', 'vendor.a1@gmail.com', '202000000', '', '2023-01-07 08:45:11', '2023-01-07 08:45:44', 1),
(6, 'Vendor Company', NULL, 'test@gmail.in', '10102020', NULL, NULL, NULL, NULL, NULL, 'Nothing found...', '2023-01-07 09:37:52', '2023-01-07 09:37:52', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `common_settings`
--
ALTER TABLE `common_settings`
  ADD PRIMARY KEY (`csid`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `tbl_charges`
--
ALTER TABLE `tbl_charges`
  ADD PRIMARY KEY (`charges_id`);

--
-- Indexes for table `tbl_child_category`
--
ALTER TABLE `tbl_child_category`
  ADD PRIMARY KEY (`tccid`);

--
-- Indexes for table `tbl_child_coupon_code`
--
ALTER TABLE `tbl_child_coupon_code`
  ADD PRIMARY KEY (`cccid`);

--
-- Indexes for table `tbl_commission_added`
--
ALTER TABLE `tbl_commission_added`
  ADD PRIMARY KEY (`caid`);

--
-- Indexes for table `tbl_commission_set`
--
ALTER TABLE `tbl_commission_set`
  ADD PRIMARY KEY (`csid`);

--
-- Indexes for table `tbl_coupons`
--
ALTER TABLE `tbl_coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `tbl_front_about`
--
ALTER TABLE `tbl_front_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_front_images`
--
ALTER TABLE `tbl_front_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kyc`
--
ALTER TABLE `tbl_kyc`
  ADD PRIMARY KEY (`kyc_id`);

--
-- Indexes for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_dtl`
--
ALTER TABLE `tbl_order_dtl`
  ADD PRIMARY KEY (`order_dtl_id`);

--
-- Indexes for table `tbl_order_hdr`
--
ALTER TABLE `tbl_order_hdr`
  ADD PRIMARY KEY (`order_hdr_id`);

--
-- Indexes for table `tbl_parent_category`
--
ALTER TABLE `tbl_parent_category`
  ADD PRIMARY KEY (`p_cid`);

--
-- Indexes for table `tbl_product_dtl`
--
ALTER TABLE `tbl_product_dtl`
  ADD PRIMARY KEY (`pdid`);

--
-- Indexes for table `tbl_product_hdr`
--
ALTER TABLE `tbl_product_hdr`
  ADD PRIMARY KEY (`phid`);

--
-- Indexes for table `tbl_signup_bonus_history`
--
ALTER TABLE `tbl_signup_bonus_history`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `tbl_withdrawal`
--
ALTER TABLE `tbl_withdrawal`
  ADD PRIMARY KEY (`withdrawal_id`);

--
-- Indexes for table `tbl_withdrawal_setting`
--
ALTER TABLE `tbl_withdrawal_setting`
  ADD PRIMARY KEY (`wsid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ufp` (`product_id`),
  ADD KEY `ufu` (`user_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `common_settings`
--
ALTER TABLE `common_settings`
  MODIFY `csid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_charges`
--
ALTER TABLE `tbl_charges`
  MODIFY `charges_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_child_category`
--
ALTER TABLE `tbl_child_category`
  MODIFY `tccid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_child_coupon_code`
--
ALTER TABLE `tbl_child_coupon_code`
  MODIFY `cccid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_commission_added`
--
ALTER TABLE `tbl_commission_added`
  MODIFY `caid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_commission_set`
--
ALTER TABLE `tbl_commission_set`
  MODIFY `csid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_coupons`
--
ALTER TABLE `tbl_coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_front_about`
--
ALTER TABLE `tbl_front_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_front_images`
--
ALTER TABLE `tbl_front_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kyc`
--
ALTER TABLE `tbl_kyc`
  MODIFY `kyc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_order_dtl`
--
ALTER TABLE `tbl_order_dtl`
  MODIFY `order_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_order_hdr`
--
ALTER TABLE `tbl_order_hdr`
  MODIFY `order_hdr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_parent_category`
--
ALTER TABLE `tbl_parent_category`
  MODIFY `p_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_product_dtl`
--
ALTER TABLE `tbl_product_dtl`
  MODIFY `pdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_product_hdr`
--
ALTER TABLE `tbl_product_hdr`
  MODIFY `phid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=458;

--
-- AUTO_INCREMENT for table `tbl_signup_bonus_history`
--
ALTER TABLE `tbl_signup_bonus_history`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_withdrawal`
--
ALTER TABLE `tbl_withdrawal`
  MODIFY `withdrawal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_withdrawal_setting`
--
ALTER TABLE `tbl_withdrawal_setting`
  MODIFY `wsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
