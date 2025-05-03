-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 01:09 PM
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
-- Database: `grub`
--

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `dish_id` int(11) NOT NULL,
  `dish_name` varchar(100) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `dish_description` varchar(255) NOT NULL,
  `image_url` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `times_ordered` int(11) NOT NULL DEFAULT 0,
  `cuisine_type` enum('East Asian','Southeast Asian','South Asian','Middle Eastern','African','Southern European','Western European','Northern European','Eastern European','Latin American & Caribbean','North American','Oceanian & Pacific Islander','Fusion') NOT NULL,
  `vegetarian` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`dish_id`, `dish_name`, `unit_price`, `restaurant_id`, `dish_description`, `image_url`, `date_added`, `times_ordered`, `cuisine_type`, `vegetarian`) VALUES
(1, 'Margherita Pizza', 9.99, 1, 'Classic pizza with tomato sauce, mozzarella cheese, and fresh basil', 'https://www.dominos.com.au/ManagedAssets/AU/product/P301/AU_P301_en_hero_4055.jpg?v-1013096145', '2025-05-03 00:00:00', 0, 'Southern European', 0),
(2, 'Pepperoni Pizza', 11.99, 1, 'Traditional favorite with tomato sauce, mozzarella, and pepperoni', 'https://www.dominos.com.my/ManagedAssets/MY/product/PXBP/MY_PXBP_en_menu_12818.jpg?v-1509882796', '2025-05-03 00:05:00', 0, 'Southern European', 0),
(3, 'Hawaiian Pizza', 12.99, 1, 'Tomato sauce, mozzarella, ham, and pineapple', 'https://www.dominos.com.my/ManagedAssets/MY/product/PXAC/MY_PXAC_en_menu_12818.jpg?v-550141400', '2025-05-03 00:07:00', 0, 'North American', 0),
(4, 'Meat Lovers Pizza', 14.99, 1, 'Loaded with pepperoni, sausage, ham, bacon, and mozzarella', 'https://www.dominos.com.my/ManagedAssets/MY/product/PQMT/MY_PQMT_en_menu_12818.jpg?v-1837451965', '2025-05-03 00:11:00', 0, 'North American', 0),
(5, 'Veggie Pizza', 12.99, 1, 'Tomato sauce, mozzarella, mushrooms, onions, green peppers, and black olives', 'https://www.dominos.com.my/ManagedAssets/MY/product/PGGS/MY_PGGS_en_menu_12818.jpg?v-70774985', '2025-05-03 00:14:00', 0, 'Southern European', 1),
(6, 'BBQ Chicken Pizza', 13.99, 1, 'BBQ sauce, mozzarella, grilled chicken, red onions, and cilantro', 'https://www.dominos.com.my/ManagedAssets/MY/product/PXBQ/MY_PXBQ_en_menu_12818.jpg?v700923379', '2025-05-03 00:17:00', 0, 'North American', 0),
(7, 'Buffalo Chicken Pizza', 13.99, 1, 'Spicy buffalo sauce, mozzarella, chicken, and red onions', 'https://copykat.com/wp-content/uploads/2024/06/Dominos-Buffalo-Chicken-Pizza-Pin-2.jpg', '2025-05-03 00:20:00', 0, 'North American', 0),
(8, 'Four Cheese Pizza', 12.99, 1, 'Tomato sauce with mozzarella, parmesan, asiago, and provolone cheeses', 'https://www.dominos.com.my/ManagedAssets/MY/product/PGQG/MY_PGQG_en_menu_12818.jpg?v1421213676', '2025-05-03 00:25:00', 0, 'Southern European', 1),
(9, 'White Pizza', 11.99, 1, 'Garlic sauce, mozzarella, ricotta, and spinach', 'https://www.dominos.com.au/ManagedAssets/AU/product/P369/AU_P369_en_hero_4055.jpg?v-1685948689', '2025-05-03 00:27:00', 0, 'Southern European', 1),
(10, 'Deluxe Pizza', 15.99, 1, 'Tomato sauce, mozzarella, pepperoni, sausage, mushrooms, onions, and green peppers', 'https://www.dominos.jp/ManagedAssets/JP/product/1047/JP_1047_en_hero_13790.jpg?v-1951151055', '2025-05-03 00:31:00', 0, 'North American', 0),
(11, 'ExtravaganZZa Pizza', 16.99, 1, 'Tomato sauce, mozzarella, pepperoni, sausage, ham, bacon, beef, mushrooms, onions, green peppers, and black olives', 'https://www.dominos.com.my/ManagedAssets/MY/product/PXEX/MY_PXEX_en_menu_12818.jpg?v1486015645', '2025-05-03 00:32:00', 0, 'North American', 0),
(12, 'Spinach & Feta Pizza', 12.99, 1, 'Garlic sauce, mozzarella, spinach, feta cheese, and tomatoes', 'https://www.thedietchefs.com/wp-content/uploads/2023/12/Dominos-Spinach-and-Feta-Pizza.jpg', '2025-05-03 00:36:00', 0, 'Southern European', 1),
(13, 'Philly Cheese Steak Pizza', 14.99, 1, 'American cheese sauce, mozzarella, steak, mushrooms, onions, and green peppers', 'https://pkgiftshop.com/user_files/product_images/1672086305-fWcuJi.jpg', '2025-05-03 00:37:00', 0, 'North American', 0),
(14, 'Pacific Veggie Pizza', 13.99, 1, 'Tomato sauce, mozzarella, roasted red peppers, spinach, onions, mushrooms, tomatoes, black olives, and feta', 'https://www.thedietchefs.com/wp-content/uploads/2023/12/Dominos-Pacific-Veggie-Pizza.jpg', '2025-05-03 00:43:00', 0, 'North American', 1),
(15, 'Chicken Bacon Ranch Pizza', 14.99, 1, 'Ranch sauce, mozzarella, grilled chicken, bacon, and tomatoes', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1ENsTwu8bvt8P-J8Zt-bgDWeO_1Q338lxXQ&s', '2025-05-03 00:44:00', 0, 'North American', 0),
(16, 'Crispy Chicken Burger', 13.90, 2, 'Crispy chicken thigh meat, sliced cheese, homemade sour cream and onion sauce', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/620c7edc-f054-4b73-8298-288fe43d197f.jpeg', '2025-05-03 00:46:00', 0, 'North American', 0),
(17, 'Korean Burger', 14.90, 2, 'Korean fried chicken thigh covered in Yangnyeom sweet and spicy sauce, with pickled white radish', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/9d2dcae5-8780-4cce-97b8-e608720e85ca.jpeg', '2025-05-03 00:48:00', 0, 'East Asian', 0),
(21, 'Mozzarella Chicken Burger', 18.90, 2, 'Grilled chicken patty stuffed with premium mozzarella cheese, topped with marinara sauce. Eat hot or the cheese will harden!', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/c9e2ad0c-7c78-481f-8809-f8bf96b0df31.jpeg', '2025-05-03 00:52:00', 0, 'North American', 0),
(24, 'Spicy Kahwin Burger', 19.90, 2, 'Premium grilled beef patty, deep fried chicken thigh, double cheese, spicy mayo sauce and Korean yangnyeom sauce.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/1e238612-b31c-47e9-9410-adee1f2dad7c.jpeg', '2025-05-03 00:58:00', 0, 'Fusion', 0),
(26, 'Ultimate Beef Burger', 15.90, 2, 'Juicy grilled beef patty, premium streaky beef, grilled onions, BBQ sauce with cheese and pickles', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/e2463767-319f-4905-8fcc-08e4a6a2e60d.jpeg', '2025-05-03 16:53:41', 0, 'North American', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `grand_total`, `created_at`) VALUES
(1, 1, 84.29, '2025-05-03 17:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `dish_id`, `quantity`) VALUES
(1, 1, 2, 4),
(2, 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `phone_number` text NOT NULL,
  `rating` decimal(3,2) NOT NULL,
  `price_range` enum('LOW','MEDIUM','HIGH','') NOT NULL DEFAULT 'MEDIUM',
  `image_url` text NOT NULL DEFAULT '\'https://www.thefuzzyduck.co.uk/wp-content/uploads/2024/05/image-coming-soon-placeholder-01-660x660.png\'',
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurant_id`, `restaurant_name`, `address`, `open_time`, `close_time`, `phone_number`, `rating`, `price_range`, `image_url`, `description`) VALUES
(1, 'Domino\'s Pizza', '70, Ground Floor, Jalan Susur Idaman, Nusa Idaman, 79100 Johor Bahru, Johor Darul Ta\'zim', '10:30:00', '23:00:00', '1-300-88-8333', 3.70, 'MEDIUM', 'https://assets.nst.com.my/images/articles/dominos_1661312345.jpg', 'We\'ll deliver in 30 minutes or less, or it\'s free!'),
(2, 'Burger Bandit', ' 27, Jalan Eko Botani 3/7, Taman Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', '12:00:00', '22:00:00', '018-358 6779', 4.50, 'MEDIUM', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/1e238612-b31c-47e9-9410-adee1f2dad7c.jpeg', 'We are a gourmet fast-serve selling homemade burgers and delicious beverages!'),
(20, 'McDonald\'s', 'Jln Kampung Lalang, Educity, 79100 Iskandar Puteri, Johor Darul Ta\'zim', '00:00:00', '00:00:00', '07-510 3667', 3.80, 'LOW', 'https://external-preview.redd.it/ydtFoz1DJGWi-nYkdUJwyjS8KoT4JgSEbYqAPt4Ftco.png?format=pjpg&auto=webp&s=52688b57369fdbd5d1eb59f75fb83a904ff95df2', 'It\'s Finger Lickin\' Good'),
(23, 'Yi He Feng', '3, EKO GALLERIA, B0104, BLOK B, TAMAN, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', '11:00:00', '22:00:00', '07-585 6629', 3.90, 'MEDIUM', 'https://i.imgur.com/Dsxsh8G.png', 'Traditional Chinese cuisine integrated with Creative dishes.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `role` enum('USER','ADMIN','SELLER') NOT NULL DEFAULT 'USER',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `pfp_url` text DEFAULT NULL,
  `phone_number` text DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `role`, `created_at`, `pfp_url`, `phone_number`, `address`) VALUES
(1, 'Admin', 'admin123@gmail.com', '$2y$10$NiFKX4vTT4OA0sI9Edx01O5DIvntYrsizdfAjeAQkwhvfQ57ZVP0u', 'ADMIN', '2025-05-02 15:17:37', 'https://www.shutterstock.com/image-vector/user-account-avatar-icon-pictogram-600nw-1860375778.jpg', NULL, NULL),
(2, 'customer1', 'customer1@gmail.com', '$2y$10$ldV/tfl/Gk0HutNuNWiVlOvNUt6NbjSpzVvMvzE6VdnjB7N9Qy5/a', 'USER', '2025-05-02 18:29:56', 'https://static.vecteezy.com/system/resources/previews/013/336/605/non_2x/corporate-profile-icon-business-man-profile-icon-illustration-free-vector.jpg', '123456789', '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`dish_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `dish_id` (`dish_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `dish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`dish_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
