--
-- Database: `schedro`
--

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

-- --------------------------------------------------------

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

-- --------------------------------------------------------

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `city_id`, `name`, `description`, `address`) VALUES
(1, 1, 'Бисквит-Шоколад', 'Один из крупнейших в Украине производителей кондитерской продукции и объединяет ряд предприятий, обеспечивающих все основные технологические этапы производства, от заготовки сырья до выпуска готовых изделий. В состав корпорации входят два производственных предприятия: ПАО «Харьковская бисквитная фабрика» и ПАО «Кондитерская фабрика «Харьковчанка» .', '61017, Украина, г. Харьков, ул. Лозовская, 8'),
(2, 3, 'Львовськая кондитерськая фабрика „Світоч“', 'Кондитерская фабрика во Львове, контрольным пакетом акций которой владеет швейцарская корпорация «Nestlé». Это одно из самых старых предприятий в кондитерской отрасли Украины, один из основных украинских производителей.', '79000, Украина, г. Львов, ул. Ткацкая, 10'),
(3, 2, 'Киевская кондитерская фабрика ROSHEN', 'Киевская кондитерская фабрика ROSHEN, сертифицированная в соответствии с международными стандартами качества ISO 9001:2008 и безопасности продуктов питания ISO 22000:2005, специализируется на производстве шоколадной продукции (шоколадных конфет, плиточного шоколада) и бисквитной продукции. ', '03039, Украина, г. Киев, ул. Науки, 1');

-- --------------------------------------------------------

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`) VALUES
(1, 'Майонезы'),
(2, 'Кетчупы'),
(3, 'Горчицы');

-- --------------------------------------------------------

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
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `short_name`, `is_weight`, `is_area`, `is_volume`, `is_modifiable`, `is_visible`) VALUES
(1, 'килограмм', 'кг', 1, 0, 0, 0, 1),
(2, 'тонна', 'т', 1, 0, 0, 0, 1),
(3, 'квадратный метр', 'м²', 0, 1, 0, 0, 1),
(4, 'кубический метр', 'м³', 0, 0, 1, 0, 1),
(5, 'грамм', 'г', 1, 0, 0, 0, 1),
(6, 'поддон', 'под.', 1, 0, 0, 1, 1),
(7, 'ящик', 'ящ.', 1, 0, 0, 1, 1),
(8, 'пачка', 'п.', 1, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_active`, `roles`) VALUES
(1, 'admin', '$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 'admin@schedro.ua', 1, 'ROLE_ADMIN'),
(2, 'user', '$2y$13$TncZcL9Iy5s3./kjxOG15eH7gAvm7dMXmfve0yOrwblXTwYDL/dYC', 'user@schedro.ua', 1, 'ROLE_USER');