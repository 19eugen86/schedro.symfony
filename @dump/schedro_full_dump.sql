-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2016 at 12:00 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schedro`
--
CREATE DATABASE IF NOT EXISTS `schedro` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `schedro`;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carriers`
--

CREATE TABLE `carriers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carriers_drivers`
--

CREATE TABLE `carriers_drivers` (
  `id` int(11) NOT NULL,
  `carrier_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carriers_vehicles`
--

CREATE TABLE `carriers_vehicles` (
  `id` int(11) NOT NULL,
  `carrier_id` int(11) DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registration_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(1, 1, 'Харьков');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(2, 1, 'Киев');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(3, 1, 'Львов');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(4, 2, 'Бухарест');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(5, 2, 'Брашов');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(6, 5, 'Варшава');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(7, 5, 'Краков');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(8, 3, 'Стамбул');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(9, 3, 'Анталья');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(10, 4, 'Берлин');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(11, 6, 'Мадрид');
INSERT INTO `cities` (`id`, `country_id`, `name`) VALUES(12, 8, 'Вашингтон');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `city_id`, `name`, `description`, `address`) VALUES(1, 1, 'Бисквит-Шоколад', 'Один из крупнейших в Украине производителей кондитерской продукции и объединяет ряд предприятий, обеспечивающих все основные технологические этапы производства, от заготовки сырья до выпуска готовых изделий. В состав корпорации входят два производственных предприятия: ПАО «Харьковская бисквитная фабрика» и ПАО «Кондитерская фабрика «Харьковчанка» .', '61017, Украина, г. Харьков, ул. Лозовская, 8');
INSERT INTO `clients` (`id`, `city_id`, `name`, `description`, `address`) VALUES(2, 3, 'Львовськая кондитерськая фабрика „Світоч“', 'Кондитерская фабрика во Львове, контрольным пакетом акций которой владеет швейцарская корпорация «Nestlé». Это одно из самых старых предприятий в кондитерской отрасли Украины, один из основных украинских производителей.', '79000, Украина, г. Львов, ул. Ткацкая, 10');
INSERT INTO `clients` (`id`, `city_id`, `name`, `description`, `address`) VALUES(3, 2, 'Киевская кондитерская фабрика ROSHEN', 'Киевская кондитерская фабрика ROSHEN, сертифицированная в соответствии с международными стандартами качества ISO 9001:2008 и безопасности продуктов питания ISO 22000:2005, специализируется на производстве шоколадной продукции (шоколадных конфет, плиточного шоколада) и бисквитной продукции. ', '03039, Украина, г. Киев, ул. Науки, 1');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES(1, 'Украина');
INSERT INTO `countries` (`id`, `name`) VALUES(2, 'Румыния');
INSERT INTO `countries` (`id`, `name`) VALUES(3, 'Турция');
INSERT INTO `countries` (`id`, `name`) VALUES(4, 'Германия');
INSERT INTO `countries` (`id`, `name`) VALUES(5, 'Польша');
INSERT INTO `countries` (`id`, `name`) VALUES(6, 'Испания');
INSERT INTO `countries` (`id`, `name`) VALUES(7, 'Австрия');
INSERT INTO `countries` (`id`, `name`) VALUES(8, 'США');

-- --------------------------------------------------------

--
-- Table structure for table `distribution_centers`
--

CREATE TABLE `distribution_centers` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factories`
--

CREATE TABLE `factories` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_category_id`, `name`) VALUES(1, 1, 'Майонез Провансаль 67%');
INSERT INTO `products` (`id`, `product_category_id`, `name`) VALUES(2, 1, 'Майонез Золотой 50%');
INSERT INTO `products` (`id`, `product_category_id`, `name`) VALUES(3, 2, 'Кетчуп BBQ');
INSERT INTO `products` (`id`, `product_category_id`, `name`) VALUES(4, 2, 'Tabasco Garlic');
INSERT INTO `products` (`id`, `product_category_id`, `name`) VALUES(5, 3, 'Горчица Козацкая');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`) VALUES(1, 'Майонезы');
INSERT INTO `product_categories` (`id`, `name`) VALUES(2, 'Кетчупы');
INSERT INTO `product_categories` (`id`, `name`) VALUES(3, 'Горчицы');
INSERT INTO `product_categories` (`id`, `name`) VALUES(5, 'Маргарины');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('weight','area','volume') COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_modifiable` tinyint(1) NOT NULL,
  `is_visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `short_name`, `type`, `is_modifiable`, `is_visible`) VALUES(1, 'килограмм', 'кг', 'weight', 0, 1);
INSERT INTO `units` (`id`, `name`, `short_name`, `type`, `is_modifiable`, `is_visible`) VALUES(2, 'тонна', 'т', 'weight', 0, 1);
INSERT INTO `units` (`id`, `name`, `short_name`, `type`, `is_modifiable`, `is_visible`) VALUES(3, 'квадратный метр', 'м²', 'area', 0, 1);
INSERT INTO `units` (`id`, `name`, `short_name`, `type`, `is_modifiable`, `is_visible`) VALUES(4, 'кубический метр', 'м³', 'volume', 0, 1);
INSERT INTO `units` (`id`, `name`, `short_name`, `type`, `is_modifiable`, `is_visible`) VALUES(5, 'грамм', 'г', 'weight', 0, 1);
INSERT INTO `units` (`id`, `name`, `short_name`, `type`, `is_modifiable`, `is_visible`) VALUES(6, 'поддон', 'под.', 'weight', 1, 1);
INSERT INTO `units` (`id`, `name`, `short_name`, `type`, `is_modifiable`, `is_visible`) VALUES(7, 'ящик', 'ящ.', 'weight', 1, 1);
INSERT INTO `units` (`id`, `name`, `short_name`, `type`, `is_modifiable`, `is_visible`) VALUES(8, 'пачка', 'п.', 'weight', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `units_proportions`
--

CREATE TABLE `units_proportions` (
  `id` int(11) NOT NULL,
  `unit_1_id` int(11) DEFAULT NULL,
  `unit_2_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `is_modifiable` tinyint(1) NOT NULL,
  `ratio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units_proportions`
--

INSERT INTO `units_proportions` (`id`, `unit_1_id`, `unit_2_id`, `product_id`, `is_modifiable`, `ratio`) VALUES(1, 6, 1, 1, 1, '1000.00');
INSERT INTO `units_proportions` (`id`, `unit_1_id`, `unit_2_id`, `product_id`, `is_modifiable`, `ratio`) VALUES(2, 8, 5, 2, 1, '450.00');
INSERT INTO `units_proportions` (`id`, `unit_1_id`, `unit_2_id`, `product_id`, `is_modifiable`, `ratio`) VALUES(4, 8, 5, 5, 1, '150.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `roles` enum('ROLE_USER','ROLE_ADMIN') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `category_id`, `username`, `password`, `email`, `phone`, `fullname`, `is_active`, `roles`) VALUES(1, 1, 'admin', '$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 'admin@schedro.ua', '+38 (096) 671 99 65', 'Едленко Ю. Г.', 1, 'ROLE_ADMIN');
INSERT INTO `users` (`id`, `category_id`, `username`, `password`, `email`, `phone`, `fullname`, `is_active`, `roles`) VALUES(2, 1, 'user', '$2y$13$TncZcL9Iy5s3./kjxOG15eH7gAvm7dMXmfve0yOrwblXTwYDL/dYC', 'user@schedro.ua', '+38 (096) 671 99 65', 'Едленко Е. Ю.', 1, 'ROLE_USER');

-- --------------------------------------------------------

--
-- Table structure for table `users_categories`
--

CREATE TABLE `users_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_categories`
--

INSERT INTO `users_categories` (`id`, `name`) VALUES(1, 'Администрация');
INSERT INTO `users_categories` (`id`, `name`) VALUES(3, 'Кладовщики');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_D760D16F8BAC62AF` (`city_id`);

--
-- Indexes for table `carriers`
--
ALTER TABLE `carriers`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carriers_drivers`
--
ALTER TABLE `carriers_drivers`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_8CCE694921DFC797` (`carrier_id`);

--
-- Indexes for table `carriers_vehicles`
--
ALTER TABLE `carriers_vehicles`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_8EC2DBC721DFC797` (`carrier_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_D95DB16BF92F3E70` (`country_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_C82E748BAC62AF` (`city_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distribution_centers`
--
ALTER TABLE `distribution_centers`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_C7FC95838BAC62AF` (`city_id`);

--
-- Indexes for table `factories`
--
ALTER TABLE `factories`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_B308924A8BAC62AF` (`city_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_B3BA5A5ABE6903FD` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `UNIQ_E9B074495E237E06` (`name`),
ADD UNIQUE KEY `UNIQ_E9B074493EE4B093` (`short_name`);

--
-- Indexes for table `units_proportions`
--
ALTER TABLE `units_proportions`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_EDED4FCA7C15BDA0` (`unit_1_id`),
ADD KEY `IDX_EDED4FCA6EA0124E` (`unit_2_id`),
ADD KEY `IDX_EDED4FCA4584665A` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
ADD KEY `IDX_1483A5E912469DE2` (`category_id`);

--
-- Indexes for table `users_categories`
--
ALTER TABLE `users_categories`
ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carriers`
--
ALTER TABLE `carriers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carriers_drivers`
--
ALTER TABLE `carriers_drivers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carriers_vehicles`
--
ALTER TABLE `carriers_vehicles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `units_proportions`
--
ALTER TABLE `units_proportions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_categories`
--
ALTER TABLE `users_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
ADD CONSTRAINT `FK_D760D16F8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `carriers_drivers`
--
ALTER TABLE `carriers_drivers`
ADD CONSTRAINT `FK_8CCE694921DFC797` FOREIGN KEY (`carrier_id`) REFERENCES `carriers` (`id`);

--
-- Constraints for table `carriers_vehicles`
--
ALTER TABLE `carriers_vehicles`
ADD CONSTRAINT `FK_8EC2DBC721DFC797` FOREIGN KEY (`carrier_id`) REFERENCES `carriers` (`id`);

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

--
-- Constraints for table `units_proportions`
--
ALTER TABLE `units_proportions`
ADD CONSTRAINT `FK_EDED4FCA4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
ADD CONSTRAINT `FK_EDED4FCA6EA0124E` FOREIGN KEY (`unit_2_id`) REFERENCES `units` (`id`),
ADD CONSTRAINT `FK_EDED4FCA7C15BDA0` FOREIGN KEY (`unit_1_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `FK_1483A5E912469DE2` FOREIGN KEY (`category_id`) REFERENCES `users_categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
