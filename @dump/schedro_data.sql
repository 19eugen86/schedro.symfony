-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2016 at 02:58 PM
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

--
-- Dumping data for table `carriers`
--

INSERT INTO `carriers` (`id`, `name`, `description`) VALUES
  (1, 'Новая Почта', 'Сегодня "Нова Пошта" является абсолютным лидером экспресс-доставки, благодаря инновационным подходам и постоянной работе над эффективностью. Предугадывая желания клиентов, компания постоянно предлагает новые продукты и услуги.\r\n\r\nОператор не просто перевозит посылки и грузы, но и развивает рынок электронной коммерции, разрабатывая комплексные решения, которые помогают бизнесу расширить географию сбыта или сосредоточиться на основной деятельности.'),
  (2, 'Интайм', 'Интайм – профессиональная служба доставки, работающая на рынке с 2002 года.\r\n\r\nСтав одним из пионеров в сегменте маршрутных автомобильных грузоперевозок, компания во многом способствовала его становлению и развитию. Большинство сервисов, существующих на данном рынке, в свое время были впервые внедрены именно в Интайм. Компания и сегодня не прекращает наращивать портфель предоставляемых услуг, постоянно совершенствуя уровень обслуживания.\r\n\r\n    В настоящее время Интайм – это более 2000 пунктов выдачи грузов по всей Украине, из которых 548 стационарных отделения и 1477 Почтоматов. Успешное сотрудничество с крупными компаниями, а также компаниями малого и среднего бизнеса, доставка грузов в торговые сети Украины, дополнительные опции для постоянных клиентов – вот далеко не полный перечень причин, по которым Интайм является надежным партнером по перевозке товаров.\r\n\r\nКомпания несет материальную ответственность за качество сервиса и осуществляет доставку грузов «до Двери» получателя в любой населенный пункт Украины.');

--
-- Dumping data for table `carriers_drivers`
--

INSERT INTO `carriers_drivers` (`id`, `carrier_id`, `full_name`, `phone_number`) VALUES
  (1, 1, 'Иванов И. И.', '+38 (099) 123 45 67');

--
-- Dumping data for table `carriers_vehicles`
--

INSERT INTO `carriers_vehicles` (`id`, `carrier_id`, `brand`, `model`, `registration_number`) VALUES
  (1, 1, 'Ford', 'Transit', 'AX 0001 AA');

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
  (8, 'США'),
  (9, 'Канада'),
  (10, 'Мексика'),
  (11, 'Чили'),
  (12, 'Египет');

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
  (12, 8, 'Вашингтон'),
  (13, 1, 'Луцк'),
  (14, 1, 'Полтава'),
  (15, 9, 'Торонто'),
  (16, 12, 'Каир'),
  (17, 1, 'Херсон');

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
  (1, 1, 'Харьковский филиал', 'Контактное лицо: Кухарев Роман Алексеевич, директор филиала', 'ул. Овощная, 15, с. Васищево, Харьковский р-н, Харьковская обл., 62495 Тел.: (057) 766-37-63, 766-37-64, 766-37-65', 'branch'),
  (2, 1, 'РЦ ХЖК', '376-21-28,\r\n784-94-20,\r\n784-93-93', '61019, Украина, г. Харьков пр. Ильича, 120', 'distribution_center'),
  (3, 1, 'Харьковский жиркомбинат', 'Производство маргарина, линия рафинации масел, дезодорационные линии, освоено производство мягких наливных маргаринов.', '61019, Украина, г. Харьков  пр. Ильича, 120', 'factory'),
  (4, 2, 'Киевский филиал', 'Контактное лицо: Нимак Илья Владимирович, директор филиала', 'ул. Семьи Хохловых, 11/2, г. Киев, 04119 Тел.: (044) 393-03-63', 'branch'),
  (5, 14, 'Полтавский филиал', 'Контактное лицо: Васильев Юрий Владимирович, директор филиала', 'ул. Половка, 66-Б, г. Полтава, 36034 Тел.: (0532 ) 613-702, 613-703', 'branch'),
  (7, 3, 'РЦ ЛЖК', 'РЦ ЛЖК', 'РЦ ЛЖК', 'distribution_center');

--
-- Dumping data for table `fos_user_group`
--

INSERT INTO `fos_user_group` (`id`, `name`, `roles`) VALUES
  (1, 'Администрация', 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}'),
  (2, 'Пользователи', 'a:1:{i:0;s:9:"ROLE_USER";}');

--
-- Dumping data for table `fos_user_user`
--

INSERT INTO `fos_user_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `created_at`, `updated_at`, `date_of_birth`, `firstname`, `lastname`, `website`, `biography`, `gender`, `locale`, `timezone`, `phone`, `facebook_uid`, `facebook_name`, `facebook_data`, `twitter_uid`, `twitter_name`, `twitter_data`, `gplus_uid`, `gplus_name`, `gplus_data`, `token`, `two_step_code`) VALUES
  (1, 'admin', 'admin', 'admin@schedro.ua', 'admin@schedro.ua', 1, '3nba2h6st340k0sgso8gk4k4ow8wg88', '$2y$13$3nba2h6st340k0sgso8gkuE6hxdFnFKjwKagAUmEtiaDu/anIBALS', '2016-02-17 14:53:26', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '2016-02-03 15:33:44', '2016-02-17 14:53:26', '1986-12-30 00:00:00', 'Евгений', 'Едленко', NULL, NULL, 'm', NULL, 'Europe/Kiev', '+38 (096) 671 99 65', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL),
  (2, 'user', 'user', 'user@schedro.ua', 'user@schedro.ua', 1, 'gddll0uy4r48s4k88wsscssg0c04884', '$2y$13$gddll0uy4r48s4k88wsscevS7jpBa4qy3ZPtMNtuF6nnMTtR0yXgm', '2016-02-17 14:14:25', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-02-03 15:39:22', '2016-02-17 14:14:25', NULL, 'Юрий', 'Едленко', NULL, NULL, 'm', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL),
  (3, 'testuser1', 'testuser1', 'testuser1@test.com', 'testuser1@test.com', 1, 'j0k61rpenkocow08g84w0wscswwgso8', '$2y$13$j0k61rpenkocow08g84w0uC1m40ZOeQhbjr6dlyR3KwhBRywcQ/by', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-02-12 14:26:54', '2016-02-12 14:26:54', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL),
  (4, 'testuser2', 'testuser2', 'testuser2@test.test', 'testuser2@test.test', 1, 'fqtdoan8228sssw80ccow844csggsws', '$2y$13$fqtdoan8228sssw80ccowuHR/bZgvgWQmIHQG1epPlYdiMimyunHe', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2016-02-17 14:46:54', '2016-02-17 14:46:54', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL);

--
-- Dumping data for table `fos_user_user_group`
--

INSERT INTO `fos_user_user_group` (`user_id`, `group_id`) VALUES
  (1, 1),
  (2, 2);

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`) VALUES
  (1, 'Майонезы'),
  (2, 'Кетчупы'),
  (3, 'Горчицы'),
  (5, 'Маргарины');

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
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `department_id`, `name`) VALUES
  (1, 1, 'ХФ - Склад - 1'),
  (2, 1, 'ХФ - Склад - 2'),
  (3, 4, 'КФ - Склад - 1'),
  (4, 2, 'ХРЦ - Склад - 1'),
  (5, 5, 'ПФ - Склад - 1'),
  (6, 2, 'ХРЦ - Склад - 2'),
  (7, 4, 'КФ - Склад - 2'),
  (8, 5, 'ПФ - Склад - 2');

--
-- Dumping data for table `warehouse_cells`
--

INSERT INTO `warehouse_cells` (`id`, `warehouse_id`, `product_category_id`, `name`, `area`, `volume`) VALUES
  (1, 1, 5, 'Харьковский филиал - Камера #1', '10.00', NULL),
  (2, 1, 1, 'Харьковский филиал - Камера #2', '50.00', NULL),
  (3, 1, 2, 'Харьковский филиал - Камера #3', '100.00', NULL),
  (4, 1, 3, 'Харьковский филиал - Камера #4', '200.00', NULL),
  (6, 2, 1, 'Камера #1', '200.00', NULL),
  (7, 3, 5, 'Камера #1', '200.00', NULL),
  (8, 4, 1, 'РЦ ХЖК - Камера #1', '200.00', NULL),
  (9, 4, 2, 'РЦ ХЖК - Камера #2', '100.00', NULL),
  (12, 4, 3, 'РЦ ХЖК - Камера #3', '50.00', NULL),
  (13, 4, 5, 'РЦ ХЖК - Камера #4', '10.00', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
