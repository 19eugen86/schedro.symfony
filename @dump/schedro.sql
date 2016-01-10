-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2016 at 04:52 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `schedro`
--
CREATE DATABASE IF NOT EXISTS `schedro` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `schedro`;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES
(1, 1, 'Харьков'),
(2, 1, 'Киев'),
(3, 1, 'Львов'),
(4, 2, 'Бухарест'),
(5, 2, 'Брашов'),
(6, 5, 'Варшава'),
(7, 5, 'Краков'),
(8, 3, 'Стамбул'),
(9, 3, 'Анталья'),
(10, 4, 'Берлин');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `city_id`, `name`, `description`, `address`) VALUES
(1, 1, 'Бисквит-Шоколад', 'Один из крупнейших в Украине производителей кондитерской продукции и объединяет ряд предприятий, обеспечивающих все основные технологические этапы производства, от заготовки сырья до выпуска готовых изделий. В состав корпорации входят два производственных предприятия: ПАО «Харьковская бисквитная фабрика» и ПАО «Кондитерская фабрика «Харьковчанка» .', '61017, Украина, г. Харьков, ул. Лозовская, 8'),
(2, 3, 'Львовськая кондитерськая фабрика „Світоч“', 'Кондитерская фабрика во Львове, контрольным пакетом акций которой владеет швейцарская корпорация «Nestlé». Это одно из самых старых предприятий в кондитерской отрасли Украины, один из основных украинских производителей.', '79000, Украина, г. Львов, ул. Ткацкая, 10'),
(3, 2, 'Киевская кондитерская фабрика ROSHEN', 'Киевская кондитерская фабрика ROSHEN, сертифицированная в соответствии с международными стандартами качества ISO 9001:2008 и безопасности продуктов питания ISO 22000:2005, специализируется на производстве шоколадной продукции (шоколадных конфет, плиточного шоколада) и бисквитной продукции. ', '03039, Украина, г. Киев, ул. Науки, 1');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Украина'),
(2, 'Румыния'),
(3, 'Турция'),
(4, 'Германия'),
(5, 'Польша'),
(6, 'Испания');

-- --------------------------------------------------------

--
-- Table structure for table `distribution_centers`
--

DROP TABLE IF EXISTS `distribution_centers`;
CREATE TABLE IF NOT EXISTS `distribution_centers` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factories`
--

DROP TABLE IF EXISTS `factories`;
CREATE TABLE IF NOT EXISTS `factories` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_category_id`, `name`) VALUES
(1, 1, 'Майонез Провансаль 67%'),
(2, 1, 'Майонез Золотой 50%'),
(3, 2, 'Кетчуп BBQ'),
(4, 2, 'Tabasco Garlic'),
(5, 3, 'Горчица Козацкая');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`) VALUES
(1, 'Майонезы'),
(2, 'Кетчупы'),
(3, 'Горчицы');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `roles` enum('ROLE_USER','ROLE_ADMIN') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ROLE_USER'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_active`, `roles`) VALUES
(1, 'admin', '$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 'admin@schedro.ua', 1, 'ROLE_ADMIN'),
(2, 'user', '$2y$13$TncZcL9Iy5s3./kjxOG15eH7gAvm7dMXmfve0yOrwblXTwYDL/dYC', 'user@schedro.ua', 1, 'ROLE_USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_D760D16F8BAC62AF` (`city_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_D95DB16BF92F3E70` (`country_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_C82E748BAC62AF` (`city_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distribution_centers`
--
ALTER TABLE `distribution_centers`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_C7FC95838BAC62AF` (`city_id`);

--
-- Indexes for table `factories`
--
ALTER TABLE `factories`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_B308924A8BAC62AF` (`city_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`), ADD KEY `IDX_B3BA5A5ABE6903FD` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`), ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `distribution_centers`
--
ALTER TABLE `distribution_centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `factories`
--
ALTER TABLE `factories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
ADD CONSTRAINT `FK_D760D16F8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
ADD CONSTRAINT `FK_D95DB16BF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
ADD CONSTRAINT `FK_C82E748BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `distribution_centers`
--
ALTER TABLE `distribution_centers`
ADD CONSTRAINT `FK_C7FC95838BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `factories`
--
ALTER TABLE `factories`
ADD CONSTRAINT `FK_B308924A8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `FK_B3BA5A5ABE6903FD` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
