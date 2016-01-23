-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2016 at 11:19 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `schedro`
--

--
-- Dumping data for table `carriers`
--

INSERT INTO `carriers` (`id`, `name`, `description`) VALUES
(1, 'Новая Почта', 'Lorem ipsum dolor sit amet, animal vivendo scribentur mea at, docendi luptatum neglegentur eu sit. Sit quod verear vivendo id, ludus voluptatum ea eos. Vis rebum alterum ad. In mei lucilius vulputate. Quaeque euismod vis ne, cum id ignota accommodare.'),
(2, 'DHL', 'Lorem ipsum dolor sit amet, animal vivendo scribentur mea at, docendi luptatum neglegentur eu sit. Sit quod verear vivendo id, ludus voluptatum ea eos. Vis rebum alterum ad. In mei lucilius vulputate. Quaeque euismod vis ne, cum id ignota accommodare.');

--
-- Dumping data for table `carriers_drivers`
--

INSERT INTO `carriers_drivers` (`id`, `carrier_id`, `full_name`, `phone_number`) VALUES
(1, 1, 'Иванов И. И.', '+38 (096) 123 45 67'),
(3, 2, 'John Doe', '+38 (099) 999 99 99');

--
-- Dumping data for table `carriers_vehicles`
--

INSERT INTO `carriers_vehicles` (`id`, `carrier_id`, `brand`, `model`, `registration_number`) VALUES
(1, 1, 'Ford', 'Transit', 'AX 1234 AA'),
(3, 2, 'Mercedes', 'Actros', 'AX 9999 AT');

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Украина'),
(2, 'Румыния'),
(3, 'Турция'),
(4, 'Германия'),
(5, 'Польша'),
(6, 'Испания'),
(7, 'Австрия'),
(8, 'США');

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
(10, 4, 'Берлин'),
(11, 6, 'Мадрид'),
(12, 8, 'Вашингтон');

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `city_id`, `name`, `description`, `address`) VALUES
(1, 1, 'Бисквит-Шоколад', 'Один из крупнейших в Украине производителей кондитерской продукции и объединяет ряд предприятий, обеспечивающих все основные технологические этапы производства, от заготовки сырья до выпуска готовых изделий. В состав корпорации входят два производственных предприятия: ПАО «Харьковская бисквитная фабрика» и ПАО «Кондитерская фабрика «Харьковчанка» .', '61017, Украина, г. Харьков, ул. Лозовская, 8'),
(2, 3, 'Львовськая кондитерськая фабрика „Світоч“', 'Кондитерская фабрика во Львове, контрольным пакетом акций которой владеет швейцарская корпорация «Nestlé». Это одно из самых старых предприятий в кондитерской отрасли Украины, один из основных украинских производителей.', '79000, Украина, г. Львов, ул. Ткацкая, 10'),
(3, 2, 'Киевская кондитерская фабрика ROSHEN', 'Киевская кондитерская фабрика ROSHEN, сертифицированная в соответствии с международными стандартами качества ISO 9001:2008 и безопасности продуктов питания ISO 22000:2005, специализируется на производстве шоколадной продукции (шоколадных конфет, плиточного шоколада) и бисквитной продукции. ', '03039, Украина, г. Киев, ул. Науки, 1');


--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `city_id`, `name`, `description`, `address`, `type`) VALUES
(1, 1, 'Харьковский филиал', 'Lorem Ipsum', 'Lorem Ipsum', 'branch'),
(2, 2, 'Киевский филиал', 'Lorem Ipsum', 'Lorem Ipsum', 'branch'),
(3, 3, 'Львовский филиал', 'Lorem Ipsum', 'Lorem Ipsum', 'branch');

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`) VALUES
(1, 'Майонезы'),
(2, 'Кетчупы'),
(3, 'Горчицы');

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_category_id`, `name`) VALUES
(1, 1, 'Майонез Провансаль 67%'),
(2, 1, 'Майонез Золотой 50%'),
(3, 2, 'Кетчуп BBQ'),
(4, 2, 'Tabasco Garlic'),
(5, 3, 'Горчица Козацкая');

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `short_name`, `type`, `is_modifiable`, `is_visible`) VALUES
(1, 'килограмм', 'кг', 'weight', 0, 1),
(2, 'тонна', 'т', 'weight', 0, 1),
(3, 'квадратный метр', 'м²', 'area', 0, 1),
(4, 'кубический метр', 'м³', 'volume', 0, 1),
(5, 'грамм', 'г', 'weight', 0, 1),
(6, 'поддон', 'под.', 'weight', 1, 1),
(7, 'ящик', 'ящ.', 'weight', 1, 1),
(8, 'пачка', 'п.', 'weight', 1, 1);

--
-- Dumping data for table `units_proportions`
--

INSERT INTO `units_proportions` (`id`, `unit_1_id`, `unit_2_id`, `product_id`, `is_modifiable`, `ratio`) VALUES
(1, 6, 1, 1, 1, '1000.00'),
(2, 8, 5, 2, 1, '450.00'),
(4, 8, 5, 5, 1, '150.00');

--
-- Dumping data for table `users_categories`
--

INSERT INTO `users_categories` (`id`, `name`) VALUES
(1, 'Администрация');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `category_id`, `username`, `password`, `email`, `phone`, `fullname`, `is_active`, `roles`) VALUES
(1, 1, 'admin', '$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 'admin@schedro.ua', '+38 (096) 671 99 65', 'Едленко Евгений Юрьевич', 1, 'ROLE_ADMIN'),
(2, 1, 'user', '$2y$13$TncZcL9Iy5s3./kjxOG15eH7gAvm7dMXmfve0yOrwblXTwYDL/dYC', 'user@schedro.ua', '+38 (098) 775 51 83', 'Едленко Татьяна Геннадьевна', 1, 'ROLE_USER');

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `department_id`, `name`) VALUES
(1, 1, 'ХФ - Склад #1'),
(2, 1, 'ХФ - Склад #2'),
(3, 2, 'КФ - Склад #1'),
(4, 3, 'ЛФ - Склад #1');

--
-- Dumping data for table `warehouse_cells`
--

INSERT INTO `warehouse_cells` (`id`, `warehouse_id`, `product_category_id`, `name`, `area`, `volume`) VALUES
(1, 1, 1, 'ХФ - Склад #1 - Камера #1', '100.00', NULL),
(2, 1, 2, 'ХФ - Склад #1 - Камера #2', '100.00', NULL);
