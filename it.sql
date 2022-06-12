-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 10:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `it`
--
-- --------------------------------------------------------
--
-- Table structure for table `tbl_admin`
--
CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `tbl_admin`
--
INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`)
VALUES (
    29,
    'Sergej Bogovic',
    'sego',
    '5a3903af365911ad64c3f0830c6c2ff6'
  ),
  (
    30,
    'Helena Manojlovic',
    'helena',
    '237391cf8685346ec9124eac31cb77fd'
  ),
  (
    31,
    'Zlatko Covic',
    'chole',
    'c35b74730319d3e696d5c99fd3ab206c'
  );
-- --------------------------------------------------------
--
-- Table structure for table `tbl_category`
--
CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `tbl_category`
--
INSERT INTO `tbl_category` (
    `id`,
    `title`,
    `image_name`,
    `featured`,
    `active`
  )
VALUES (
    12,
    'Pizza',
    'food_category_610.jpg',
    'Yes',
    'Yes'
  ),
  (
    13,
    'Burger',
    'food_category_454.jpg',
    'Yes',
    'Yes'
  ),
  (
    14,
    'Chicken',
    'food_category_869.jpg',
    'Yes',
    'Yes'
  ),
  (
    15,
    'Water',
    'food_category_699.jpg',
    'Yes',
    'Yes'
  ),
  (
    16,
    'Juices',
    'food_category_226.jpg',
    'Yes',
    'Yes'
  );
-- --------------------------------------------------------
--
-- Table structure for table `tbl_comments`
--
CREATE TABLE `tbl_comments` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `tbl_comments`
--
INSERT INTO `tbl_comments` (`id`, `id_customer`, `customer`, `comment`)
VALUES (
    10,
    8,
    'stivenbraun',
    'ovaj komentar je cenzurisan'
  ),
  (11, 6, 'sergej', 'ovaj komentar je cenzurisan'),
  (
    12,
    7,
    'drmrbazo',
    'Nazalost hrana nije ispunila moja ocekivanja :(('
  ),
  (17, 5, 'basic', 'ovaj komentar je cenzurisan'),
  (18, 5, 'basic', 'komentarisem2\r\n'),
  (19, 5, 'basic', 'Ukusno je!');
-- --------------------------------------------------------
--
-- Table structure for table `tbl_courires`
--
CREATE TABLE `tbl_courires` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `tbl_courires`
--
INSERT INTO `tbl_courires` (
    `id`,
    `username`,
    `password`,
    `email`,
    `full_name`,
    `phone`
  )
VALUES (
    3,
    'lukamagic',
    '2d11c8e371f67b5318e30e4f3e6d48e7',
    'lukamagic@gmail.com',
    'Luka Doncic',
    '+3816420172018'
  ),
  (
    4,
    'cholena',
    '8f49375bff9e964dd724c36687aa53b7',
    'cholena@gmail.com',
    'Zlatko Manojlovic',
    '+381542021202'
  );
-- --------------------------------------------------------
--
-- Table structure for table `tbl_customer`
--
CREATE TABLE `tbl_customer` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` char(40) NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint(1) NOT NULL,
  `new_password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code_password` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `new_password_expires` datetime NOT NULL,
  `banned` tinyint(1) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `tbl_customer`
--
INSERT INTO `tbl_customer` (
    `id_user`,
    `username`,
    `firstname`,
    `lastname`,
    `password`,
    `email`,
    `code`,
    `token`,
    `registration_expires`,
    `active`,
    `new_password`,
    `code_password`,
    `new_password_expires`,
    `banned`
  )
VALUES (
    3,
    'potus123',
    'donal',
    'trunp',
    'a0bbb2138d46f97de573ba4886715d8b',
    'potus123@gmail.com',
    '',
    '',
    '0000-00-00 00:00:00',
    0,
    '',
    '',
    '0000-00-00 00:00:00',
    0
  ),
  (
    4,
    'slanina',
    'mast',
    'meso',
    '24214c084b6c7ec4d8362d0cccf812e8',
    'slanina@gmail.com',
    '',
    '',
    '0000-00-00 00:00:00',
    0,
    '',
    '',
    '0000-00-00 00:00:00',
    1
  ),
  (
    5,
    'basic',
    'luka',
    'basic',
    'f17aaabc20bfe045075927934fed52d2',
    'palkovic44@gmail.com',
    '',
    '',
    '0000-00-00 00:00:00',
    0,
    '',
    '',
    '0000-00-00 00:00:00',
    0
  ),
  (
    6,
    'sergej',
    'Sergej',
    'Bogovic',
    '2fd0aec11e083f35f9c507eefec53766',
    'sergejbgv@gmail.com',
    '',
    '',
    '0000-00-00 00:00:00',
    0,
    '',
    '',
    '0000-00-00 00:00:00',
    0
  ),
  (
    7,
    'drmrbazo',
    'fulop',
    'bazso',
    '1ccb69905055c0501269738ebf395e5b',
    'drmrbazo@gmail.com',
    '',
    '',
    '0000-00-00 00:00:00',
    0,
    '',
    '',
    '0000-00-00 00:00:00',
    0
  ),
  (
    8,
    'stivenbraun',
    'stiven',
    'braun',
    'd915edc62f80fde25ac4e8f137971417',
    'stivenbraun@gmail.com',
    '',
    '',
    '0000-00-00 00:00:00',
    0,
    '',
    '',
    '0000-00-00 00:00:00',
    0
  ),
  (
    10,
    'goran',
    'Goran',
    'Dragic',
    '$2y$10$6B7O72eYPBdKq9jlwZFayeCcK',
    'gordandragic@gmail.com',
    '',
    '',
    '0000-00-00 00:00:00',
    1,
    '',
    '',
    '0000-00-00 00:00:00',
    NULL
  ),
  (
    11,
    'doncic',
    'Luka',
    'Doncic',
    '$2y$10$lgUlRGh/Y84Oy7mPk80kqevXv',
    'lukadoncic@gmail.com',
    '',
    '',
    '0000-00-00 00:00:00',
    1,
    '',
    '',
    '0000-00-00 00:00:00',
    NULL
  ),
  (
    12,
    'glovo',
    'Glovo',
    'Wolt',
    '$2y$10$hWj3RwG6As1Ndh6eU9OwmeBWGDYzJ3muFIAlzQQ7vdwNt8eGmPvVW',
    'glovo@hotmail.com',
    '',
    '',
    '0000-00-00 00:00:00',
    1,
    '',
    '',
    '0000-00-00 00:00:00',
    1
  );
-- --------------------------------------------------------
--
-- Table structure for table `tbl_food`
--
CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `tbl_food`
--
INSERT INTO `tbl_food` (
    `id`,
    `title`,
    `description`,
    `price`,
    `image_name`,
    `category_id`,
    `featured`,
    `active`
  )
VALUES (
    32,
    'Pizza Vesuvio',
    'Pizza with ham, cheese and ketchup. 32cm.',
    '400.00',
    'Food-Name-1009.jpg',
    12,
    'Yes',
    'Yes'
  ),
  (
    33,
    'Pizza Capriciosa',
    'Pizza with ham, cheese, ketchup and mushrooms. 32cm.',
    '500.00',
    'Food-Name-9118.jpg',
    12,
    'Yes',
    'Yes'
  ),
  (
    34,
    'Pizza Pepperoni',
    'Pizza with ham, cheese, ketchup and pepperoni. 32cm.',
    '550.00',
    'Food-Name-5351.jpg',
    12,
    'No',
    'Yes'
  ),
  (
    35,
    'Pizza Margherita',
    'Pizza with mozzarela, ketchup and basil. 32cm.',
    '450.00',
    'Food-Name-7034.jpg',
    12,
    'No',
    'Yes'
  ),
  (
    36,
    'Cheeseburger Meal',
    'Cheeseburger filled with tomatoes, pickles, salad, onions and our special spread. Comes with 200g of french fries.',
    '600.00',
    'Food-Name-7102.jpg',
    13,
    'Yes',
    'Yes'
  ),
  (
    37,
    'Double Cheeseburger Meal',
    'Double Cheeseburger filled with tomatoes, onions, pickles and our special spread. Comes with 300g of french fries.',
    '800.00',
    'Food-Name-3007.jpg',
    13,
    'No',
    'Yes'
  ),
  (
    38,
    'Hamburger',
    'Hamburger filled with tomatoes, pickles, onions and our special spread. Comes with 200g of french fries.',
    '600.00',
    'Food-Name-3862.jpg',
    13,
    'Yes',
    'Yes'
  ),
  (
    39,
    'Fishburger',
    'Fish burger filled with tomatoes, pickles, onions and our special spread. Comes with 200g of french fries.',
    '450.00',
    'Food-Name-4853.jpg',
    13,
    'No',
    'Yes'
  ),
  (
    40,
    'Chicken burger',
    'Chicken burger filled with tomatoes, pickles, onions and our special spread. Comes with 200g of french fries.',
    '500.00',
    'Food-Name-4141.jpg',
    13,
    'No',
    'Yes'
  ),
  (
    41,
    'Chicken Legs',
    'Chicken Legs. Comes with 300g of french fries and a soury cream.',
    '650.00',
    'Food-Name-6350.jpg',
    14,
    'Yes',
    'Yes'
  ),
  (
    42,
    'Grilled Chicken meal',
    'Grilled chicken. Comes with 50g of rice and 100g of potatoes. Very healthy.',
    '500.00',
    'Food-Name-7405.jpg',
    14,
    'Yes',
    'Yes'
  ),
  (
    43,
    'Coca Cola',
    'Cold drink.',
    '150.00',
    'Food-Name-878.jpg',
    16,
    'No',
    'Yes'
  ),
  (
    44,
    'Apple juice',
    '300ml of apple juice',
    '170.00',
    'Food-Name-8634.jpg',
    16,
    'No',
    'Yes'
  ),
  (
    45,
    'Orange juice',
    '300ml of orange juice.',
    '170.00',
    'Food-Name-1247.jpg',
    16,
    'No',
    'Yes'
  ),
  (
    46,
    'Bottle of Rosa',
    '2nd Best water from Serbia.',
    '100.00',
    'Food-Name-8427.jpg',
    15,
    'No',
    'Yes'
  ),
  (
    47,
    'Bottle of Prolom',
    'Best water from Serbia',
    '120.00',
    'Food-Name-4003.jpg',
    15,
    'No',
    'Yes'
  );
-- --------------------------------------------------------
--
-- Table structure for table `tbl_order`
--
CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `food` varchar(255) NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10, 2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `tbl_order`
--
INSERT INTO `tbl_order` (
    `id`,
    `food`,
    `price`,
    `qty`,
    `total`,
    `order_date`,
    `status`,
    `customer_name`,
    `customer_contact`,
    `customer_address`
  )
VALUES (
    4,
    'Pizza Capriciosa',
    '500.00',
    2,
    '1000.00',
    '0000-00-00 00:00:00',
    'Delivered',
    'basic',
    '+381695432345',
    'Kireska 90J'
  ),
  (
    5,
    'Pizza Capriciosa',
    '500.00',
    1,
    '500.00',
    '0000-00-00 00:00:00',
    'Delivered',
    'basic',
    '+381634567123',
    'Petra Lekovica 3'
  ),
  (
    6,
    'Pizza Capriciosa',
    '500.00',
    1,
    '500.00',
    '0000-00-00 00:00:00',
    'Delivered',
    'drmrbazo',
    '+38164361457',
    'Bore Stankovica 10'
  ),
  (
    7,
    'Hamburger',
    '600.00',
    1,
    '600.00',
    '0000-00-00 00:00:00',
    'Delivered',
    '',
    '+381691234567',
    'Dedinjska 12'
  ),
  (
    8,
    'Pizza Capriciosa',
    '500.00',
    1,
    '500.00',
    '0000-00-00 00:00:00',
    'Delivered',
    'basic',
    '+381691234567',
    'Evgenija Kumicica 25'
  ),
  (
    9,
    'Cheeseburger Meal',
    '600.00',
    2,
    '1200.00',
    '0000-00-00 00:00:00',
    'Delivered',
    'sergej',
    '+381671234987',
    'Petra Lekovica 23'
  ),
  (
    10,
    'Grilled Chicken meal',
    '500.00',
    18,
    '9000.00',
    '0000-00-00 00:00:00',
    'Delivered',
    'basic',
    '+3812525252',
    'Antuna Suturovica 5'
  ),
  (
    11,
    'Chicken Legs',
    '650.00',
    4,
    '2600.00',
    '0000-00-00 00:00:00',
    'Delivered',
    'basic',
    '+381652035',
    'Marka Oreskovica 16'
  );
-- --------------------------------------------------------
--
-- Table structure for table `tbl_user`
--
CREATE TABLE `tbl_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
-- --------------------------------------------------------
--
-- Table structure for table `user_email_failure`
--
CREATE TABLE `user_email_failure` (
  `id_user_email_failure` int(11) NOT NULL,
  `id_user_web` int(11) NOT NULL,
  `date_time_added` datetime NOT NULL,
  `date_time_tried` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Indexes for dumped tables
--
--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tbl_courires`
--
ALTER TABLE `tbl_courires`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
ADD PRIMARY KEY (`id_user`);
--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 32;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 19;
--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 20;
--
-- AUTO_INCREMENT for table `tbl_courires`
--
ALTER TABLE `tbl_courires`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 13;
--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 48;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 12;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;