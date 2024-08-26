-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 07:14 AM
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
-- Database: `green_society`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_nokp` varchar(12) NOT NULL,
  `admin_name` varchar(80) NOT NULL,
  `admin_email` varchar(50) DEFAULT NULL,
  `admin_password` varchar(20) NOT NULL,
  `permission` int(2) NOT NULL DEFAULT 0 COMMENT '0 = Normal Admin\r\n1 = Top Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_nokp`, `admin_name`, `admin_email`, `admin_password`, `permission`) VALUES
('1234', 'Admin Ken', 'Admin123@gmail.com', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` varchar(50) NOT NULL,
  `event_name` varchar(80) NOT NULL,
  `event_description` varchar(255) NOT NULL,
  `event_location` varchar(100) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_type` int(2) NOT NULL DEFAULT 1 COMMENT '1 = offline\r\n2 = online\r\n3 = system',
  `event_join_type` int(2) NOT NULL DEFAULT 1 COMMENT '1 = Click Button\r\n2 = Upload File\r\n3 = Have own page\r\n4 = System',
  `fix` int(11) NOT NULL DEFAULT 0,
  `show_event` varchar(2) NOT NULL DEFAULT '0' COMMENT '0 = show\r\nelse = hide\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `event_description`, `event_location`, `event_date`, `event_type`, `event_join_type`, `fix`, `show_event`) VALUES
('E001', 'Earth Day 2025', 'Have a speak that about the earth day 2025', 'Bangunan Tun Tan Siew Sin, TAR UMT', '2025-04-22', 1, 1, 1, '0'),
('E002', 'Recycle Menu Update', 'Recycle Menu Updated! Click Item List to check more.', '', '2024-05-05', 3, 4, 1, '0'),
('E003', 'Online Self Recycle', 'Go to our specified location and put the recycle item there, and using own device to register the recycle record.', '', '2024-05-05', 2, 3, 1, '0'),
('E004', 'Clothes Donation', 'Giving A Helping Hand. Donate your old clothes that are still in good condition.', 'Bangunan Tun Tan Siew Sin, TAR UMT', '2025-02-27', 1, 1, 1, '0'),
('E005', 'Gift Exchange', 'Point Exchange is available for now! Using points to exchange the gift.', '', '2024-05-05', 2, 3, 1, '0'),
('E006', 'Ken222', 'sdhaVOIJbdsaiovn\r\nshuidvgcauiojhbv\r\ncsdbouab', 'Block D', '2024-05-06', 1, 1, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `event_approve`
--

CREATE TABLE `event_approve` (
  `no_history` varchar(40) NOT NULL,
  `member_id` varchar(12) NOT NULL,
  `event_id` varchar(50) NOT NULL,
  `point_added` int(3) NOT NULL,
  `register_datetime` datetime NOT NULL,
  `admin_id` varchar(12) DEFAULT NULL,
  `admin_approve` int(2) NOT NULL DEFAULT 0 COMMENT '0 = Not yet approve',
  `approve_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_join`
--

CREATE TABLE `event_join` (
  `no_join` varchar(50) NOT NULL,
  `member_nokp` varchar(12) NOT NULL,
  `event_id` varchar(50) NOT NULL,
  `datetime_join` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `event_join`
--

INSERT INTO `event_join` (`no_join`, `member_nokp`, `event_id`, `datetime_join`) VALUES
('E001|1', '2303484', 'E001', '2024-05-06 01:01:25'),
('E004|1', '2303484', 'E004', '2024-05-06 01:01:33'),
('E006|1', '2303484', 'E006', '2024-05-06 12:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `gift_id` varchar(50) NOT NULL,
  `gift_name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `gift_point` int(3) NOT NULL,
  `gift_stock` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gift`
--

INSERT INTO `gift` (`gift_id`, `gift_name`, `description`, `gift_point`, `gift_stock`) VALUES
('G01', 'Food Voucher', 'Food Voucher', 100, 999),
('G02', 'Pencil', 'Pencil that UNSTOPPABLE logo', 100, 999),
('G03', 'Recycle Bag', 'Recycle Bag that having recycle logo', 200, 999),
('G05', 'Table Ware', 'A set green table ware that having recycle theme\r\n', 300, 700),
('G06', 'T-shirt', 'T-shirt that having recycle theme', 250, 200);

-- --------------------------------------------------------

--
-- Table structure for table `gift_approve`
--

CREATE TABLE `gift_approve` (
  `no_gift_history` varchar(50) NOT NULL,
  `member_id` varchar(60) NOT NULL,
  `gift_id` varchar(50) NOT NULL,
  `point` int(3) NOT NULL,
  `exchange_datetime` datetime NOT NULL,
  `admin_id` varchar(50) DEFAULT NULL,
  `approve` int(2) DEFAULT 0,
  `approve_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gift_approve`
--

INSERT INTO `gift_approve` (`no_gift_history`, `member_id`, `gift_id`, `point`, `exchange_datetime`, `admin_id`, `approve`, `approve_datetime`) VALUES
('2303484|1', '2303484', 'G01', 100, '2024-05-06 01:09:09', '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` varchar(50) NOT NULL,
  `item_name` varchar(80) NOT NULL,
  `item_price` float NOT NULL,
  `item_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_price`, `item_point`) VALUES
('Item1', 'Newspaper', 0.24, 24),
('Item10', 'Glass', 0.1, 10),
('Item11', 'Used Cooking Oil', 0.8, 80),
('Item12', 'CD / VCD', 0.6, 60),
('Item2', 'Black and White Paper', 0.36, 36),
('Item3', 'Box', 0.22, 22),
('Item4', 'Magazine', 0.22, 22),
('Item5', 'Mixed Paper', 0.18, 18),
('Item6', 'Can / Metal', 0.4, 40),
('Item7', 'CD / VCD Casing', 0.2, 20),
('Item8', 'Car\'s Battery', 1, 100),
('Item9', 'Plastic', 0.4, 40);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_nokp` varchar(12) NOT NULL,
  `member_name` varchar(60) NOT NULL,
  `member_phone` varchar(11) DEFAULT NULL,
  `member_email` varchar(50) DEFAULT NULL,
  `member_address` varchar(200) DEFAULT NULL,
  `member_password` varchar(20) NOT NULL,
  `member_point` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_nokp`, `member_name`, `member_phone`, `member_email`, `member_address`, `member_password`, `member_point`) VALUES
('2303484', 'KenLam', '0163116627', 'shernoy123@gmail.com', '25, Elitis Pinggiran Ancala, Valencia Sungai Buloh, Selangor, 47000', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `point_history`
--

CREATE TABLE `point_history` (
  `no_point_history` varchar(50) NOT NULL,
  `member_id` varchar(12) NOT NULL,
  `event_id` varchar(50) NOT NULL,
  `point_get` int(3) NOT NULL,
  `datetime_history` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `point_history`
--

INSERT INTO `point_history` (`no_point_history`, `member_id`, `event_id`, `point_get`, `datetime_history`) VALUES
('123|1', '123', 'E003', 10, '2024-05-06 12:36:50'),
('2303484|1', '2303484', 'E003', 100, '2024-05-06 01:08:16'),
('2303484|2', '2303484', 'E005', 100, '2024-05-06 01:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `recycle_area`
--

CREATE TABLE `recycle_area` (
  `area_id` varchar(50) NOT NULL,
  `area_location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `recycle_area`
--

INSERT INTO `recycle_area` (`area_id`, `area_location`) VALUES
('A01', 'W.P Kuala Lumpur'),
('A02', 'W.P Kuala Lumpur'),
('A03', 'W.P Kuala Lumpur'),
('A04', 'W.P Kuala Lumpur'),
('A05', 'W.P Kuala Lumpur'),
('A06', 'W.P Kuala Lumpur'),
('A07', 'W.P Kuala Lumpur'),
('A08', 'W.P Kuala Lumpur'),
('A09', 'W.P Kuala Lumpur'),
('A10', 'W.P Kuala Lumpur'),
('B01', 'Perlis'),
('B02', 'Perlis'),
('B03', 'Perlis'),
('B04', 'Perlis'),
('B05', 'Perlis'),
('B06', 'Perlis'),
('B07', 'Perlis'),
('B08', 'Perlis'),
('B09', 'Perlis'),
('B10', 'Perlis'),
('C01', 'Kedah'),
('C02', 'Kedah'),
('C03', 'Kedah'),
('C04', 'Kedah'),
('C05', 'Kedah'),
('C06', 'Kedah'),
('C07', 'Kedah'),
('C08', 'Kedah'),
('C09', 'Kedah'),
('C10', 'Kedah'),
('D01', 'Penang'),
('D02', 'Penang'),
('D03', 'Penang'),
('D04', 'Penang'),
('D05', 'Penang'),
('D06', 'Penang'),
('D07', 'Penang'),
('D08', 'Penang'),
('D09', 'Penang'),
('D10', 'Penang'),
('E01', 'Kelantan'),
('E02', 'Kelantan'),
('E03', 'Kelantan'),
('E04', 'Kelantan'),
('E05', 'Kelantan'),
('E06', 'Kelantan'),
('E07', 'Kelantan'),
('E08', 'Kelantan'),
('E09', 'Kelantan'),
('E10', 'Kelantan'),
('F01', 'Johor'),
('F02', 'Johor'),
('F03', 'Johor'),
('F04', 'Johor'),
('F05', 'Johor'),
('F06', 'Johor'),
('F07', 'Johor'),
('F08', 'Johor'),
('F09', 'Johor'),
('F10', 'Johor'),
('G01', 'Malacca'),
('G02', 'Malacca'),
('G03', 'Malacca'),
('G04', 'Malacca'),
('G05', 'Malacca'),
('G06', 'Malacca'),
('G07', 'Malacca'),
('G08', 'Malacca'),
('G09', 'Malacca'),
('G10', 'Malacca'),
('H01', 'Negeri Sembilan'),
('H02', 'Negeri Sembilan'),
('H03', 'Negeri Sembilan'),
('H04', 'Negeri Sembilan'),
('H05', 'Negeri Sembilan'),
('H06', 'Negeri Sembilan'),
('H07', 'Negeri Sembilan'),
('H08', 'Negeri Sembilan'),
('H09', 'Negeri Sembilan'),
('H10', 'Negeri Sembilan'),
('I01', 'Selangor'),
('I02', 'Selangor'),
('I03', 'Selangor'),
('I04', 'Selangor'),
('I05', 'Selangor'),
('I06', 'Selangor'),
('I07', 'Selangor'),
('I08', 'Selangor'),
('I09', 'Selangor'),
('I10', 'Selangor'),
('J01', 'Terengganu'),
('J02', 'Terengganu'),
('J03', 'Terengganu'),
('J04', 'Terengganu'),
('J05', 'Terengganu'),
('J06', 'Terengganu'),
('J07', 'Terengganu'),
('J08', 'Terengganu'),
('J09', 'Terengganu'),
('J10', 'Terengganu'),
('K01', 'Pahang'),
('K02', 'Pahang'),
('K03', 'Pahang'),
('K04', 'Pahang'),
('K05', 'Pahang'),
('K06', 'Pahang'),
('K07', 'Pahang'),
('K08', 'Pahang'),
('K09', 'Pahang'),
('K10', 'Pahang');

-- --------------------------------------------------------

--
-- Table structure for table `temp_add_item_e003`
--

CREATE TABLE `temp_add_item_e003` (
  `no` int(3) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `quantity` int(3) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_nokp`),
  ADD UNIQUE KEY `admin_nokp` (`admin_nokp`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD UNIQUE KEY `event_id` (`event_id`);

--
-- Indexes for table `event_approve`
--
ALTER TABLE `event_approve`
  ADD PRIMARY KEY (`no_history`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `event_join`
--
ALTER TABLE `event_join`
  ADD PRIMARY KEY (`no_join`),
  ADD UNIQUE KEY `no_attendance` (`no_join`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `member_nokp` (`member_nokp`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`gift_id`),
  ADD UNIQUE KEY `name_gift` (`gift_name`);

--
-- Indexes for table `gift_approve`
--
ALTER TABLE `gift_approve`
  ADD PRIMARY KEY (`no_gift_history`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `gift_id` (`gift_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_id` (`item_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_nokp`),
  ADD UNIQUE KEY `member_nokp` (`member_nokp`);

--
-- Indexes for table `point_history`
--
ALTER TABLE `point_history`
  ADD PRIMARY KEY (`no_point_history`),
  ADD KEY `point_history_ibfk_1` (`member_id`),
  ADD KEY `point_history_ibfk_2` (`event_id`);

--
-- Indexes for table `recycle_area`
--
ALTER TABLE `recycle_area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `temp_add_item_e003`
--
ALTER TABLE `temp_add_item_e003`
  ADD PRIMARY KEY (`no`),
  ADD KEY `item_id` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
