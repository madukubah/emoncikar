-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2020 at 03:48 PM
-- Server version: 10.1.43-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `madz5183_emoncikar`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomenclature_id` int(10) UNSIGNED NOT NULL,
  `AuFnF` varchar(5) NOT NULL DEFAULT 'AU',
  `AUpLkS` varchar(5) NOT NULL DEFAULT 'AU',
  `title` text NOT NULL,
  `location` text NOT NULL,
  `quantity` double NOT NULL,
  `unit` varchar(100) NOT NULL,
  `ceiling_budget` double NOT NULL,
  `ceiling_rpm` double NOT NULL,
  `ceiling_pln` double NOT NULL,
  `year` int(11) NOT NULL,
  `pptk_id` int(10) UNSIGNED NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `nomenclature_id`, `AuFnF`, `AUpLkS`, `title`, `location`, `quantity`, `unit`, `ceiling_budget`, `ceiling_rpm`, `ceiling_pln`, `year`, `pptk_id`, `latitude`, `longitude`, `images`) VALUES
(30, 3, 'F', 'AU', 'Administrasi Umum Satker PLP', 'KOTA KENDARI', 4, 'KAB/KOTA', 20000, 20000, 0, 2019, 1, '0', '0', 'default.jpg;default.jpg;default.jpg;default.jpg;default.jpg'),
(31, 3, 'F', 'AU', 'pembangunan', 'KOTA KENDARI', 4, 'KAB/KOTA', 30000, 30000, 0, 2019, 2, '0111', '0222', 'default.jpg;default.jpg;default.jpg;default.jpg;100_1576345552.JPG'),
(32, 3, 'F', 'AU', 'bangun bangun', 'KOTA KENDARI', 4, 'KAB/KOTA', 20000, 20000, 0, 2019, 1, '0', '0', 'default.jpg;default.jpg;default.jpg;default.jpg;100_1576514807.jpg'),
(34, 3, 'F', 'AU', 'SPAM', 'KOTA KENDARI', 4, 'KAB/KOTA', 200000, 200000, 0, 2019, 1, '0', '0', 'default.jpg;default.jpg;default.jpg;default.jpg;default.jpg'),
(35, 3, 'F', 'AU', 'Administrasi Umum Satker PLP', 'KOTA KENDARI', 4, 'KAB/KOTA', 200000, 200000, 0, 2019, 1, '0', '0', 'default.jpg;default.jpg;default.jpg;default.jpg;default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_id` int(10) UNSIGNED NOT NULL,
  `nominal` double NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `rpm_pln` int(2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `activity_id`, `nominal`, `month`, `year`, `rpm_pln`, `status`) VALUES
(3, 30, 10000, 2, 2019, 0, 0),
(4, 30, 10000, 3, 2019, 0, 0),
(7, 31, 20000, 3, 2019, 0, 1),
(8, 31, 10000, 4, 2019, 0, 1),
(10, 31, 30000, 3, 2019, 0, 0),
(11, 32, 12000, 2, 2019, 0, 0),
(12, 32, 2000, 3, 2019, 0, 0),
(13, 32, 6000, 4, 2019, 0, 0),
(15, 34, 200000, 2, 2019, 0, 0),
(16, 35, 200000, 1, 2019, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'uadmin', 'user admin');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(50) NOT NULL,
  `list_id` varchar(200) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `position` int(4) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `name`, `link`, `list_id`, `icon`, `status`, `position`, `description`) VALUES
(101, 1, 'Beranda', 'admin/', 'home_index', 'home', 1, 1, '-'),
(102, 1, 'Group', 'admin/group', 'group_index', 'home', 1, 2, '-'),
(103, 1, 'Setting', 'admin/menus', '-', 'cogs', 1, 3, '-'),
(104, 1, 'User', 'admin/user_management', 'user_management_index', 'users', 1, 4, '-'),
(106, 103, 'Menu', 'admin/menus', 'menus_index', 'circle', 1, 1, '-'),
(107, 2, 'Beranda', 'user/home', 'home_index', 'home', 1, 1, '-'),
(108, 2, 'Pengguna', 'uadmin/users', 'users_index', 'home', 0, 100, '-'),
(109, 2, 'Data Kegiatan', 'uadmin/activity', 'activity_index', 'file', 1, 2, '-'),
(110, 2, 'Tambah Kegiatan', 'uadmin/activity/add', 'activity_add', 'plus-square', 1, 3, '-'),
(111, 2, 'PPTK', 'uadmin/pptk', 'pptk_index', 'users', 1, 4, '-'),
(112, 2, 'Setting', 'uadmin/setting', '-', 'home', 1, 5, '-'),
(113, 112, 'Nomenklatur', 'uadmin/nomenclature', 'nomenclature_index', 'file', 1, 1, '-');

-- --------------------------------------------------------

--
-- Table structure for table `nomenclature`
--

CREATE TABLE `nomenclature` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(5) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nomenclature`
--

INSERT INTO `nomenclature` (`id`, `code`, `name`) VALUES
(3, 2412, 'cipta karya | Pembinaan dan Pengembangan Kawasan Permukiman'),
(4, 2413, 'cipta karya | Pembinaan dan Pengembangan Penataan Bangunan dan Lingkungan'),
(5, 2414, 'cipta karya | Pembinaan dan Pengembangan Penyehatan Lingkungan Permukiman'),
(6, 2415, 'cipta karya | Pembinaan dan Pengembangan Sistem Penyediaan Air Minum');

-- --------------------------------------------------------

--
-- Table structure for table `physical`
--

CREATE TABLE `physical` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_id` int(10) UNSIGNED NOT NULL,
  `progress` int(3) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physical`
--

INSERT INTO `physical` (`id`, `activity_id`, `progress`, `month`, `year`, `status`) VALUES
(5, 30, 100, 2, 2019, 0),
(8, 31, 30, 3, 2019, 1),
(9, 31, 70, 4, 2019, 1),
(11, 31, 100, 3, 2019, 0),
(12, 32, 30, 2, 2019, 0),
(13, 32, 30, 3, 2019, 0),
(14, 32, 30, 4, 2019, 0),
(15, 32, 10, 5, 2019, 0),
(17, 34, 100, 2, 2019, 0),
(18, 35, 100, 1, 2019, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pptk`
--

CREATE TABLE `pptk` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pptk`
--

INSERT INTO `pptk` (`id`, `name`, `description`) VALUES
(1, 'alan', '-'),
(2, 'alin', '-');

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_id` int(10) UNSIGNED NOT NULL,
  `report_date` date NOT NULL,
  `problem_description` text NOT NULL,
  `problem_date` date NOT NULL,
  `solution` text NOT NULL,
  `authorities` text NOT NULL,
  `settlement_date` date NOT NULL,
  `required_support` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `activity_id`, `report_date`, `problem_description`, `problem_date`, `solution`, `authorities`, `settlement_date`, `required_support`) VALUES
(3, 32, '2019-12-16', 'yuhu', '2019-12-16', 'yihi', 'yaha', '2019-12-16', 'ehe\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` text NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `image`, `address`) VALUES
(1, '127.0.0.1', 'admin@fixl.com', '$2y$12$XpBgMvQ5JzfvN3PTgf/tA.XwxbCOs3mO0a10oP9/11qi1NUpv46.u', 'admin@fixl.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1578140233, 1, 'Admin', 'istrator', '081342989185', 'USER_1_1571554027.jpeg', 'admin'),
(13, '::1', 'admin@admin.com', '$2y$10$L5hzKcil32fXqus1bnBuNuxLrWq/6cOU8q1o0E2ahM6iddz4Wio06', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1568678256, 1578139234, 1, 'admin', '.', '00', 'USER_13_1576516704.png', 'jln mutiara no 8');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(29, 13, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomenclature_id` (`nomenclature_id`),
  ADD KEY `pptk_id` (`pptk_id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomenclature`
--
ALTER TABLE `nomenclature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physical`
--
ALTER TABLE `physical`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `pptk`
--
ALTER TABLE `pptk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `nomenclature`
--
ALTER TABLE `nomenclature`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `physical`
--
ALTER TABLE `physical`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pptk`
--
ALTER TABLE `pptk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`nomenclature_id`) REFERENCES `nomenclature` (`id`),
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`pptk_id`) REFERENCES `pptk` (`id`);

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`);

--
-- Constraints for table `physical`
--
ALTER TABLE `physical`
  ADD CONSTRAINT `physical_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`);

--
-- Constraints for table `problem`
--
ALTER TABLE `problem`
  ADD CONSTRAINT `problem_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
