-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 03:21 PM
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
  `vegetarian` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('FOOD','DRINK') NOT NULL DEFAULT 'FOOD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`dish_id`, `dish_name`, `unit_price`, `restaurant_id`, `dish_description`, `image_url`, `date_added`, `times_ordered`, `cuisine_type`, `vegetarian`, `type`) VALUES
(1, 'Margherita Pizza', 9.99, 1, 'Classic pizza with tomato sauce, mozzarella cheese, and fresh basil', 'https://www.dominos.com.au/ManagedAssets/AU/product/P301/AU_P301_en_hero_4055.jpg?v-1013096145', '2025-05-03 00:00:00', 0, 'Southern European', 0, 'FOOD'),
(2, 'Pepperoni Pizza', 11.99, 1, 'Traditional favorite with tomato sauce, mozzarella, and pepperoni', 'https://www.dominos.com.my/ManagedAssets/MY/product/PXBP/MY_PXBP_en_menu_12818.jpg?v-1509882796', '2025-05-03 00:05:00', 0, 'Southern European', 0, 'FOOD'),
(3, 'Hawaiian Pizza', 12.99, 1, 'Tomato sauce, mozzarella, ham, and pineapple', 'https://www.dominos.com.my/ManagedAssets/MY/product/PXAC/MY_PXAC_en_menu_12818.jpg?v-550141400', '2025-05-03 00:07:00', 0, 'North American', 0, 'FOOD'),
(4, 'Meat Lovers Pizza', 14.99, 1, 'Loaded with pepperoni, sausage, ham, bacon, and mozzarella', 'https://www.dominos.com.my/ManagedAssets/MY/product/PQMT/MY_PQMT_en_menu_12818.jpg?v-1837451965', '2025-05-03 00:11:00', 0, 'North American', 0, 'FOOD'),
(5, 'Veggie Pizza', 12.99, 1, 'Tomato sauce, mozzarella, mushrooms, onions, green peppers, and black olives', 'https://www.dominos.com.my/ManagedAssets/MY/product/PGGS/MY_PGGS_en_menu_12818.jpg?v-70774985', '2025-05-03 00:14:00', 0, 'Southern European', 1, 'FOOD'),
(6, 'BBQ Chicken Pizza', 13.99, 1, 'BBQ sauce, mozzarella, grilled chicken, red onions, and cilantro', 'https://www.dominos.com.my/ManagedAssets/MY/product/PXBQ/MY_PXBQ_en_menu_12818.jpg?v700923379', '2025-05-03 00:17:00', 0, 'North American', 0, 'FOOD'),
(7, 'Buffalo Chicken Pizza', 13.99, 1, 'Spicy buffalo sauce, mozzarella, chicken, and red onions', 'https://copykat.com/wp-content/uploads/2024/06/Dominos-Buffalo-Chicken-Pizza-Pin-2.jpg', '2025-05-03 00:20:00', 0, 'North American', 0, 'FOOD'),
(8, 'Four Cheese Pizza', 12.99, 1, 'Tomato sauce with mozzarella, parmesan, asiago, and provolone cheeses', 'https://www.dominos.com.my/ManagedAssets/MY/product/PGQG/MY_PGQG_en_menu_12818.jpg?v1421213676', '2025-05-03 00:25:00', 0, 'Southern European', 1, 'FOOD'),
(9, 'White Pizza', 11.99, 1, 'Garlic sauce, mozzarella, ricotta, and spinach', 'https://www.dominos.com.au/ManagedAssets/AU/product/P369/AU_P369_en_hero_4055.jpg?v-1685948689', '2025-05-03 00:27:00', 0, 'Southern European', 1, 'FOOD'),
(10, 'Deluxe Pizza', 15.99, 1, 'Tomato sauce, mozzarella, pepperoni, sausage, mushrooms, onions, and green peppers', 'https://www.dominos.jp/ManagedAssets/JP/product/1047/JP_1047_en_hero_13790.jpg?v-1951151055', '2025-05-03 00:31:00', 0, 'North American', 0, 'FOOD'),
(11, 'ExtravaganZZa Pizza', 16.99, 1, 'Tomato sauce, mozzarella, pepperoni, sausage, ham, bacon, beef, mushrooms, onions, green peppers, and black olives', 'https://www.dominos.com.my/ManagedAssets/MY/product/PXEX/MY_PXEX_en_menu_12818.jpg?v1486015645', '2025-05-03 00:32:00', 0, 'North American', 0, 'FOOD'),
(12, 'Spinach & Feta Pizza', 12.99, 1, 'Garlic sauce, mozzarella, spinach, feta cheese, and tomatoes', 'https://www.thedietchefs.com/wp-content/uploads/2023/12/Dominos-Spinach-and-Feta-Pizza.jpg', '2025-05-03 00:36:00', 0, 'Southern European', 1, 'FOOD'),
(13, 'Philly Cheese Steak Pizza', 14.99, 1, 'American cheese sauce, mozzarella, steak, mushrooms, onions, and green peppers', 'https://pkgiftshop.com/user_files/product_images/1672086305-fWcuJi.jpg', '2025-05-03 00:37:00', 0, 'North American', 0, 'FOOD'),
(14, 'Pacific Veggie Pizza', 13.99, 1, 'Tomato sauce, mozzarella, roasted red peppers, spinach, onions, mushrooms, tomatoes, black olives, and feta', 'https://www.thedietchefs.com/wp-content/uploads/2023/12/Dominos-Pacific-Veggie-Pizza.jpg', '2025-05-03 00:43:00', 0, 'North American', 1, 'FOOD'),
(15, 'Chicken Bacon Ranch Pizza', 14.99, 1, 'Ranch sauce, mozzarella, grilled chicken, bacon, and tomatoes', 'https://www.dominos.com.au/ManagedAssets/AU/product/P025/AU_P025_en_hero_4055.jpg?v687172778', '2025-05-03 00:44:00', 0, 'North American', 0, 'FOOD'),
(30, 'Ultimate Beef Burger', 15.90, 2, 'Juicy grilled beef patty with premium beef streaky, grilled onions, BBQ sauce, cheese, and pickles.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/e2463767-319f-4905-8fcc-08e4a6a2e60d.jpeg', '2025-05-04 05:09:56', 0, 'North American', 0, 'FOOD'),
(31, 'Mac n\' Cheese Chicken Burger', 18.90, 2, 'Grilled chicken patty topped with signature fried mac and cheese and turkey strips.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/0681934e-b721-4485-ba50-8877467604d0.png', '2025-05-04 05:09:56', 0, 'Fusion', 0, 'FOOD'),
(32, 'Mac n\' Cheese Beef Burger', 19.90, 2, 'Grilled beef patty with signature fried mac and cheese and crispy turkey strips.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/7e59d73a-de22-464b-ab24-c7a0af11fda6.png', '2025-05-04 05:09:56', 0, 'Fusion', 0, 'FOOD'),
(33, 'Nasi Lemak Burger', 16.90, 2, 'Coconut-marinated chicken thigh, over-easy fried egg, and homemade sweet-spicy sambal.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/697fff93-f104-434d-b5ed-ce8c8407c016.png', '2025-05-04 05:09:56', 0, 'Fusion', 0, 'FOOD'),
(34, 'Spicy Chicken Burger', 13.90, 2, 'Crispy chicken thigh with our special spicy sauce. A popular choice.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/c3f4105b-a7a8-48c2-90cd-7a9483c4bdd8.png', '2025-05-04 05:09:56', 0, 'North American', 0, 'FOOD'),
(35, 'Crispy Chicken Burger', 13.90, 2, 'Crispy chicken thigh, sliced cheese, and homemade sour cream and onion sauce.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/620c7edc-f054-4b73-8298-288fe43d197f.jpeg', '2025-05-04 05:09:56', 0, 'North American', 0, 'FOOD'),
(36, 'Aloha Burger', 15.90, 2, 'Grilled chicken patty topped with a pineapple ring and Coney Island sauce.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/cf2f5759-2373-490f-86fb-bc235513847e.png', '2025-05-04 05:09:56', 0, 'Fusion', 0, 'FOOD'),
(37, 'Cheesy Tots Beef Burger', 16.90, 2, 'Grilled beef patty with tater puffs and nacho cheese sauce.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/21434270-5be0-44c7-bbe8-4c4d16e38d33.png', '2025-05-04 05:09:56', 0, 'North American', 0, 'FOOD'),
(38, 'Cheesy Tots Chicken Burger', 15.90, 2, 'Grilled chicken patty with tater tots and nacho cheese sauce.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/91902500-ed58-4446-8e9a-9c9fe599c22f.png', '2025-05-04 05:09:56', 0, 'North American', 0, 'FOOD'),
(39, 'Prawn Katsu Burger', 15.90, 2, 'Patty made from minced chicken and prawn, topped with Thousand Island sauce.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/1e0a92e1-2cf6-4252-9bbc-b45b5e61d80e.png', '2025-05-04 05:09:56', 0, 'East Asian', 0, 'FOOD'),
(40, 'Fish Burger', 15.90, 2, 'Fresh premium dory fish, sliced cheese, and tartar sauce.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/87bfd5b6-2e57-4fc5-8f0e-d68dc4cd243d.jpeg', '2025-05-04 05:09:56', 0, 'North American', 0, 'FOOD'),
(41, 'Korean Burger', 14.90, 2, 'Korean fried chicken thigh covered in sweet-spicy yangnyeom sauce, with pickled white radish.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/9d2dcae5-8780-4cce-97b8-e608720e85ca.jpeg', '2025-05-04 05:09:56', 0, 'East Asian', 0, 'FOOD'),
(42, 'Mozzarella Chicken Burger', 18.90, 2, 'Grilled chicken patty stuffed with premium mozzarella cheese and topped with marinara sauce. Best eaten hot!', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/c9e2ad0c-7c78-481f-8809-f8bf96b0df31.jpeg', '2025-05-04 05:09:56', 0, 'Southern European', 0, 'FOOD'),
(43, 'Mozzarella Beef Burger', 19.90, 2, 'Grilled beef patty stuffed with premium mozzarella cheese and topped with marinara sauce. Best eaten hot!', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/c6513e1e-744d-47be-91f3-b0ba02bd6437.jpeg', '2025-05-04 05:09:56', 0, 'Southern European', 0, 'FOOD'),
(44, 'Spicy Kahwin Burger', 19.90, 2, 'Grilled beef patty, deep-fried chicken thigh, double cheese, spicy mayo, and Korean yangnyeom sauce.', 'https://weeat.asia/bizimg/resources/seller/1587015897175894424/images/productIcon/1e238612-b31c-47e9-9410-adee1f2dad7c.jpeg', '2025-05-04 05:09:56', 0, 'Fusion', 0, 'FOOD'),
(45, 'Big Mac', 5.99, 20, 'Two all-beef patties, special sauce, lettuce, cheese, pickles, onions on a sesame seed bun.', 'https://s7d1.scene7.com/is/image/mcdonalds/DC_202302_0005-999_BigMac_1564x1564-1:nutrition-calculator-tile', '2025-05-04 05:12:13', 0, 'North American', 0, 'FOOD'),
(46, 'Quarter Pounder with Cheese', 6.49, 20, '100% pure beef patty, two slices of cheese, onions, pickles, ketchup, and mustard on a sesame seed bun.', 'https://s7d1.scene7.com/is/image/mcdonaldsstage/DC_202201_0007-005_QuarterPounderwithCheese_1564x1564?wid=1000&hei=1000&dpr=off', '2025-05-04 05:12:13', 0, 'North American', 0, 'FOOD'),
(47, 'Filet-O-Fish', 4.59, 20, 'Breaded white fish fillet, tartar sauce, and a slice of cheese on a steamed bun.', 'https://s7d1.scene7.com/is/image/mcdonalds/DC_202302_5926-999_Filet-O-Fish_HalfSlice_Alt_1564x1564-1?wid=1000&hei=1000&dpr=off', '2025-05-04 05:12:13', 0, 'North American', 0, 'FOOD'),
(48, 'Chicken McNuggets (6-piece)', 4.29, 20, 'Six pieces of breaded and seasoned chicken, served with your choice of dipping sauce.', 'https://s7d1.scene7.com/is/image/mcdonalds/mcdonalds-Chicken-McNuggets-6-pieces-2:product-header-desktop?wid=829&hei=455&dpr=off', '2025-05-04 05:12:13', 0, 'North American', 0, 'FOOD'),
(49, 'McChicken', 3.89, 20, 'Breaded chicken patty, mayonnaise, and shredded lettuce on a toasted bun.', 'https://www.mcdonalds.com.sg/sites/default/files/2023-02/1200x1200_MOP_BBPilot_McChicken.png', '2025-05-04 05:12:13', 0, 'North American', 0, 'FOOD'),
(50, 'Egg McMuffin', 3.19, 20, 'Egg, Canadian bacon, and American cheese on a toasted English muffin.', 'https://s7d1.scene7.com/is/image/mcdonaldsstage/DC_202004_0046_EggMcMuffin_1564x1564?wid=1000&hei=1000&dpr=off', '2025-05-04 05:12:13', 0, 'North American', 0, 'FOOD'),
(51, 'Sausage McMuffin', 2.79, 20, 'Sausage patty and American cheese on a toasted English muffin.', 'https://s7d1.scene7.com/is/image/mcdonaldsstage/DC_201907_0083_SausageEggMcMuffin_1564x1564:product-header-mobile?wid=1313&hei=1313&dpr=off', '2025-05-04 05:12:13', 0, 'North American', 0, 'FOOD'),
(52, 'Hotcakes', 3.49, 20, 'Three fluffy pancakes served with butter and syrup.', 'https://s7d1.scene7.com/is/image/mcdonaldsstage/DC_202405_0031_3HotCakes_1564x1564:product-header-mobile?wid=1313&hei=1313&dpr=off', '2025-05-04 05:12:13', 0, 'North American', 1, 'FOOD'),
(53, 'Hash Browns', 1.29, 20, 'Crispy, golden hash browns.', 'https://s7d1.scene7.com/is/image/mcdonalds/mcdonalds-Hash-Brown-New:product-header-desktop?wid=829&hei=455&dpr=off', '2025-05-04 05:12:13', 0, 'North American', 1, 'FOOD'),
(54, 'McCafé Coffee', 1.99, 20, 'Freshly brewed coffee available in various sizes and flavors.', 'https://s7d1.scene7.com/is/image/mcdonalds/mcdonalds-White-Coffee-Regular-jan-new-promo:product-header-desktop?wid=829&hei=455&dpr=off', '2025-05-04 05:12:13', 0, 'North American', 1, 'DRINK'),
(55, 'Vegetarian Mushroom Chicken with Rice', 12.90, 23, 'Crispy mushroom and chicken with rice, offering a savory and satisfying flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:58:45.281Z_m8uavt_lweiqx4u', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(56, 'Vegetarian Curry Chicken with Rice', 13.90, 23, 'A hearty and flavorful vegetarian dish featuring plant-based chicken simmered in aromatic curry sauce, served with steamed rice for a satisfying meal.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:58:57.398Z_faqvd2_lweirg4j', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(57, 'Vegetarian Minced Meat Rice', 10.90, 23, 'Minced vegetarian meat served over a bed of fragrant rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:59:09.394Z_r8e1ow_lwek7smp', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(58, 'Vegetarian Curry Lamb with Rice', 14.90, 23, 'A curry with lamb-flavored vegetarian meat, served with rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:59:19.930Z_y9rmhy_lweis570', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(59, 'Vegetarian Minced Meat with Noodle', 9.90, 23, 'Minced vegetarian meat mixed with noodles for a tasty and fulfilling dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:00:21.786Z_a13cfs_lwekbcp4', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(60, 'Vegetarian Mushroom Chicken with Noodle', 12.90, 23, 'Crispy mushroom chicken served with noodles, perfect for a light yet satisfying meal.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:00:32.639Z_yu8m3i_lwejpue4', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(61, 'Vegetarian Curry Chicken with Noodle', 13.90, 23, 'A hearty vegetarian curry chicken dish served with noodles for extra flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:00:44.285Z_2863h0_lwejtf4r', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(62, 'Vegetarian Curry Lamb with Noodle', 14.90, 23, 'Rich vegetarian curry lamb served over noodles for a hearty meal.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:00:55.066Z_50wqf2_lwejvfuz', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(63, 'Vegetarian Stew Beef Noodle Soup', 14.90, 23, 'A comforting stew with beef-flavored vegetarian meat and noodles in a savory broth.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2024-09-01T13:29:16.659Z_sor6hq_m0ks50wd', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(64, 'Vegetarian Minced Meat with Vermicelli', 9.90, 23, 'Minced vegetarian meat served with vermicelli noodles for a flavorful experience.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:01:10.682Z_zxvgie_lwekazo3', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(65, 'Vegetarian Mushroom Chicken with Vermicelli', 12.90, 23, 'Crispy mushroom chicken served with vermicelli noodles, combining texture and flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:01:21.921Z_x14bex_lwejqddk', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(66, 'Vegetarian Curry Chicken with Vermicelli', 13.90, 23, 'A fragrant vegetarian curry chicken with vermicelli noodles for a light meal.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:01:32.571Z_vb3w76_lwejry0o', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(67, 'Vegetarian Curry Lamb with Vermicelli', 14.90, 23, 'Vegetarian curry lamb served with vermicelli noodles for a satisfying dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:01:42.933Z_b9cgq2_lwejwz93', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(68, 'Vegetarian Stew Beef Vermicelli Soup', 14.90, 23, 'Stew with vegetarian beef and vermicelli noodles in a rich broth.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2024-09-01T13:31:58.053Z_jklui4_m0ks5dpa', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(69, 'Coriander Egg Pancake', 7.90, 23, 'Soft egg pancake with a hint of coriander for a unique taste.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:59:31.611Z_iozmox', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(70, 'Vegetable Egg Pancake', 7.90, 23, 'A flavorful egg pancake with mixed vegetables for a wholesome meal.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:59:41.292Z_9b1krq', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(71, 'Steam Vegetarian Dumplings', 10.90, 23, 'Soft and steamed vegetarian dumplings with a savory filling.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:59:50.934Z_6pcv7x', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(72, 'Fried Vegetarian Dumplings', 10.90, 23, 'Crispy fried vegetarian dumplings filled with savory vegetables.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:00:01.388Z_5ey0yh_lzb9b7c6', '2025-05-04 05:29:29', 0, 'Southeast Asian', 1, 'FOOD'),
(73, '經典肉燥拌麵 Classic Minced Pork with Noodle', 9.90, 23, 'A savory noodle dish with minced pork and traditional seasonings.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:30:57.670Z_0m0r93_lwepkpa9', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(74, '黃金抄手拌麵 Crispy Wonton with Noodle', 10.90, 23, 'Crispy wontons served with a bed of noodles in a flavorful sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:31:11.252Z_5mo8so_lwep9zqz', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(75, '香燜牛肉拌麵 Stew Beef Special with Noodle', 17.90, 23, 'Tender stew beef served with noodles in a rich broth.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:31:46.018Z_97vkc6_lwenxk3n', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(76, '香濃咖喱雞拌麵 Curry Chicken with Noodle', 14.90, 23, 'Spicy curry chicken with noodles in a creamy sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:32:03.437Z_iyxakt_lwenzpff', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(77, '醬汁鳳梨雞拌麵 Pineapple Chicken with Noodle', 14.90, 23, 'Sweet and tangy pineapple chicken served with noodles.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:32:19.802Z_i610dq_lwenu5w6', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(78, '醬汁雞排拌麵 Fried Chicken Chop with Noodle', 16.90, 23, 'Crispy fried chicken chop served with noodles and savory sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:32:45.076Z_qd7dyb_lweonsec', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(79, '香菇醬魚柳拌麵 Fried Fish Fillet with Noodle', 16.90, 23, 'Fried fish fillet served with noodles and mushroom sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:33:34.524Z_pd4uox_lweop0dd', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(80, '紅燒排骨拌麵 Stew Pork Ribs with Noodle', 15.90, 23, 'Tender stew pork ribs served over a bowl of noodles.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:33:51.122Z_qrka5j_lwentab3', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(81, '香醋燜豬肉拌麵 Stew Vinegar Pork Special with Noodle', 15.90, 23, 'Pork simmered in a tangy vinegar sauce, served with noodles.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:34:03.586Z_v3wv3j_lwenwbbm', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(82, '香茅酸辣雞拌麵 Lemongrass Hot & Sour Chicken with Noodle', 14.90, 23, 'A spicy and sour chicken dish with a fragrant lemongrass flavor, served with noodles.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:34:19.354Z_n70ira_lwen14fa', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(83, '經典肉燥Q粉 Classic Minced Pork with Vermicelli', 9.90, 23, 'Vermicelli noodles topped with savory minced pork.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:42:52.079Z_d941n9_lwepj9sw', '2025-05-04 05:52:00', 0, 'East Asian', 0, 'FOOD'),
(84, '黃金抄手Q粉 Crispy Wonton with Vermicelli', 10.90, 23, 'Crispy wontons paired with vermicelli in a savory sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:43:18.131Z_dpegm2', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(85, '香燜牛肉Q粉 Stew Beef Special with Vermicelli', 17.90, 23, 'Tender stew beef served with vermicelli in a rich broth.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:43:54.881Z_3xaukw_lweno64j', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(86, '香濃咖喱雞Q粉 Curry Chicken with Vermicelli', 14.90, 23, 'Spicy curry chicken with vermicelli in a creamy sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:44:39.753Z_lve79j_lwenmix4', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(87, '醬汁鳳梨雞Q粉 Pineapple Chicken with Vermicelli', 14.90, 23, 'Sweet and tangy pineapple chicken served with vermicelli.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:45:04.503Z_ajhig9_lweni4zg', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(88, '醬汁雞排Q粉 Fried Chicken Chop with Vermicelli', 16.90, 23, 'Crispy fried chicken chop served with vermicelli and savory sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:45:24.015Z_yy8qg3_lweor9rd', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(89, '香菇醬魚柳Q粉 Fried Fish Fillet with Vermicelli', 16.90, 23, 'Fried fish fillet served with vermicelli and mushroom sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:45:47.001Z_eoiyw9_lweouuzj', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(90, '紅燒排骨Q粉 Stew Pork Ribs with Vermicelli', 15.90, 23, 'Tender stew pork ribs served over vermicelli.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:46:12.698Z_tdvw5l_lwenlp69', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(91, '香醋燜豬肉Q粉 Stew Vinegar Pork Special with Vermicelli', 15.90, 23, 'Pork simmered in a tangy vinegar sauce, served with vermicelli.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:46:37.305Z_yuh1ni_lwenjia4', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(92, '香茅酸辣雞Q粉 Lemongrass Hot & Sour Chicken with Vermicelli', 14.90, 23, 'Spicy and sour chicken with a fragrant lemongrass flavor, served with vermicelli.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:46:51.811Z_sca8cn_lwengduk', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(93, '白飯 White Rice', 2.00, 23, 'Steamed white rice served as a side dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:51:56.594Z_5spbww_lwek2itd', '2025-05-04 05:54:17', 0, 'East Asian', 1, 'FOOD'),
(94, '壹禾豐醬汁雞排飯 Fried Chicken Chop with Rice', 16.90, 23, 'Crispy fried chicken chop served with steamed rice and savory sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:52:10.433Z_uoegzg_lweosi7h', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(95, '壹禾豐香菇醬魚柳飯 Fried Fish Fillet with Rice', 16.90, 23, 'Fried fish fillet served with rice and mushroom sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:52:26.031Z_vwecla_lweomsc3', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(96, '壹禾豐肉燥飯 Special Minced Pork Rice', 10.90, 23, 'Minced pork served over a bowl of steamed rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:52:40.241Z_lv2omb_lwep8krh', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(97, '香燜牛肉飯 Stew Beef Special with Rice', 17.90, 23, 'Tender stew beef served with steamed rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:53:09.051Z_w3l5s5_lweo64rf', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(98, '香濃咖喱雞飯 Curry Chicken with Rice', 14.90, 23, 'Spicy curry chicken served with steamed rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:53:20.740Z_q7lbc6_lweo94ov', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(99, '醬汁鳳梨雞飯 Pineapple Chicken with Rice', 14.90, 23, 'Sweet and tangy pineapple chicken served over rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:53:32.209Z_zqti0o_lweo5941', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(100, '紅燒排骨飯 Stew Pork Ribs with Rice', 15.90, 23, 'Tender stew pork ribs served over rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:53:44.973Z_dmbyup_lweo2kuz', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(101, '滷肉飯 Braised Pork Rice', 14.90, 23, 'Slow-braised pork served with steamed rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:53:56.495Z_29oiyp_lwejk3lq', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(102, '香醋燜豬肉飯 Stew Vinegar Pork Special with Rice', 15.90, 23, 'Pork simmered in a tangy vinegar sauce, served with rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:54:07.889Z_nbawhp_lweo7ukc', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(103, '香茅酸辣雞飯 Lemongrass Hot & Sour Chicken with Rice', 14.90, 23, 'Spicy and sour chicken with a lemongrass flavor, served with rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:54:18.624Z_ypzo66_lwemzsik', '2025-05-04 05:54:17', 0, 'East Asian', 0, 'FOOD'),
(104, '麻婆豆腐飯 Minced Pork Mapo Tofu Rice', 10.90, 23, 'A spicy and savory dish featuring minced pork and tofu in a rich, flavorful sauce, served with rice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:54:28.510Z_bazxh9_lweppqnx', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(105, '特色川菜麵 Xi-Chuan Vegetables Noodle Soup', 10.90, 23, 'A hearty noodle soup with fresh vegetables and a bold, spicy broth.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:50:51.383Z_92ai5i_lxlodcg5', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(106, '藥膳雞湯麵 Herbs Chicken Noodle Soup', 12.90, 23, 'Noodles served in a soothing and aromatic herbal chicken broth, packed with nutrients.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:51:15.175Z_h48254_lwhd4hld', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(107, '壹禾豐紅燒牛肉麵 Special Stew Beef Noodle Soup', 18.90, 23, 'A rich and savory stew with tender beef, served with noodles in a flavorful broth.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:51:34.886Z_3ptkaa_m8y0n781', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(108, '台式酸辣湯面 Sour & Spicy Noodle Soup', 11.90, 23, 'A tangy and spicy soup with noodles, featuring a perfect balance of sour and spicy flavors.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:51:58.479Z_sn7o42_lxloeb2d', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(109, '西紅柿清湯麵 Diced Tomatoes Light Soup With Noodle', 9.90, 23, 'A light and refreshing noodle soup made with diced tomatoes and a simple broth.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T12:52:17.044Z_s8tv7l_lwhd3ama', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(110, '特色川菜Q粉 Xi-Chuan Vegetables Vermicelli', 10.90, 23, 'Vermicelli noodles served with vegetables in a spicy and savory broth, typical of Sichuan cuisine.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:48:53.056Z_3d81ru_lxloiu58', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(111, '藥膳雞湯Q粉 Herbs Chicken Vermicelli Soup', 12.90, 23, 'Vermicelli noodles in a herbal chicken broth, offering a soothing and nourishing experience.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:49:08.740Z_kc9jrz_lwhd1aqc', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(112, '壹禾豐紅燒牛肉Q粉 Special Stew Beef Vermicelli Soup', 18.90, 23, 'Tender beef in a rich stew served with vermicelli noodles, bringing deep flavors and a satisfying meal.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:49:41.032Z_ha8wug_lwhd27xb', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(113, '台式酸辣湯Q粉 Sour & Spicy Vermicelli Soup', 11.90, 23, 'A sour and spicy soup with vermicelli noodles, providing a bold and refreshing flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:49:55.409Z_8w4qmm_lwhd1uu7', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(114, '西紅柿清湯Q粉 Diced Tomatoes Light Soup With Vermicelli', 9.90, 23, 'A light soup with diced tomatoes and vermicelli noodles in a simple, fresh broth.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T13:50:10.755Z_meelbc_lwhd2j3m', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(115, '參鬚紅棗燉雞湯 Red Dates Ginseng Chicken Soup', 12.90, 23, 'A nourishing soup made with chicken, ginseng, and red dates, known for its health benefits.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:04:01.292Z_zwkp38_lwhg77ub', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(116, '十全燉烏雞湯 Ten Treasure Black Chicken Soup', 13.90, 23, 'A rich and nutritious soup made with black chicken and a blend of ten different herbs.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:04:11.052Z_k0ey9u', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(117, '白蘿蔔吊片排骨湯 Radish Soup with Pork Ribs', 12.90, 23, 'A hearty soup with tender pork ribs and radish, known for its comforting and refreshing taste.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:04:36.690Z_f2g1bo_lwhg806y', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(118, '素菇肉骨茶 Veggie Mushroom Bak Kut Teh', 11.90, 23, 'A vegetarian version of the traditional Bak Kut Teh with mushrooms and herbs for a savory broth.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:04:49.013Z_wrauss_lwhg8cvr', '2025-05-04 05:56:29', 0, 'Southeast Asian', 1, 'FOOD'),
(119, '養生羅宋排骨湯 Healthy Mix Vegetable Soup with Pork Ribs', 14.90, 23, 'A healthy mix of vegetables and tender pork ribs in a flavorful broth, perfect for a light yet satisfying meal.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:05:03.462Z_0d1h7j', '2025-05-04 05:56:29', 0, 'East Asian', 0, 'FOOD'),
(120, '黑豆花生燉烏雞湯 Black Chicken Soup with Black Bean and Peanut', 13.90, 23, 'A nutritious black chicken soup made with black beans and peanuts, offering a rich, savory flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:05:14.133Z_nxgvb3_lwhg0hkk', '2025-05-04 05:57:14', 0, 'East Asian', 0, 'FOOD'),
(121, '蔥花蛋餅 Spring Onion Egg Pancake', 7.90, 23, 'A crispy pancake with spring onions and a soft, savory egg filling, perfect for a quick snack.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:06:37.083Z_uep4v7', '2025-05-04 05:57:14', 0, 'East Asian', 1, 'FOOD'),
(122, '傳統五香肉捲 Traditional Homemade Meat Roll', 10.90, 23, 'A traditional meat roll seasoned with five spices, providing a flavorful, aromatic bite.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:06:48.158Z_84fmiv', '2025-05-04 05:57:14', 0, 'East Asian', 0, 'FOOD'),
(123, '藥材茶葉蛋 Traditional Herbs Tea Egg', 2.00, 23, 'A soft-boiled egg steeped in a flavorful herbal tea, offering a savory and aromatic taste.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:07:01.248Z_mjr32l', '2025-05-04 05:57:14', 0, 'East Asian', 1, 'FOOD'),
(124, '壹禾豐醬汁炸雞排 Fried Chicken Chop with Special Sauce', 14.90, 23, 'A crispy fried chicken chop served with a special sauce, making for a rich and savory dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:07:11.642Z_xw9pmf_lwg1urmx', '2025-05-04 05:57:14', 0, 'East Asian', 0, 'FOOD'),
(125, '壹禾豐香菇醬炸魚柳 Fried Fish Fillet with Mushroom Sauce', 14.90, 23, 'Crispy fried fish fillet topped with a savory mushroom sauce, creating a delicious contrast in flavors.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:07:22.631Z_0ugrn0_lwg1s3te', '2025-05-04 05:57:14', 0, 'East Asian', 0, 'FOOD'),
(126, '荷包蛋 Fried Egg', 1.50, 23, 'A simple and classic fried egg, perfect as a side or for enhancing any dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:07:34.361Z_9cpwvz', '2025-05-04 05:57:14', 0, 'East Asian', 1, 'FOOD'),
(127, '豬肉高麗菜煎餃 (6颗）Fried Pork and Cabbage Dumpling (6pcs)', 9.90, 23, 'Fried dumplings stuffed with pork and cabbage, delivering a crispy, savory bite.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:08:03.677Z_74bi4a_m0ks1q0i', '2025-05-04 05:57:14', 0, 'East Asian', 0, 'FOOD'),
(128, '豬肉韭菜煎餃 (6颗）Fried Pork and Leek Dumpling（6pcs）', 9.90, 23, 'Fried dumplings filled with a tasty mixture of pork and leek, offering a delicious savory flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:08:18.906Z_hki1ls_m0ks29jx', '2025-05-04 05:57:14', 0, 'East Asian', 0, 'FOOD'),
(129, '豬肉高麗菜蒸餃 (6颗） Poached Pork and Cabbage Dumpling (6pcs)', 9.90, 23, 'Steamed dumplings with a soft dough, filled with pork and cabbage, offering a juicy and savory taste.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:08:31.255Z_n7y6xi', '2025-05-04 05:57:14', 0, 'East Asian', 0, 'FOOD'),
(130, '豬肉韭菜蒸餃 (6颗)  Poached Pork and Leek Dumpling (6pcs)', 9.90, 23, 'Steamed dumplings filled with pork and leek, offering a tender texture and savory flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:08:45.778Z_ncrp5v', '2025-05-04 05:57:14', 0, 'East Asian', 0, 'FOOD'),
(131, '酥炸黃金抄手 Crispy Fried Wonton', 8.90, 23, 'Crispy fried wontons with a savory filling, offering a crunchy and flavorful bite.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:08:56.744Z_1iu62m_lwei59wy', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(132, '壹禾豐紅油抄手 Spicy Poached Wonton', 8.90, 23, 'Tender wontons poached in a spicy, flavorful red oil, creating a savory and spicy dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:09:05.556Z_3qe6hq_lwei5qb1', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(133, '壹禾豐清湯抄手 Traditional Wonton Soup', 8.90, 23, 'Traditional wonton soup with a light broth and delicate wontons, offering a comforting taste.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:09:18.256Z_b3i2m4_lwehp9q3', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(134, '牛肉高丽菜煎饺 (6颗) Fried Beef and Cabbage Dumpling (6pcs)', 12.90, 23, 'Fried dumplings filled with beef and cabbage, delivering a crispy and savory bite.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2024-07-24T12:53:27.046Z_rgz4x5_m0ks2y7b', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(135, '牛肉高丽菜蒸饺 (6颗) Poached Beef and Cabbage Dumpling (6pcs)', 12.90, 23, 'Steamed dumplings filled with beef and cabbage, offering a tender and savory taste.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2024-07-24T12:56:27.642Z_otha6n_m0ks3gp9', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(136, '酥炸金雞塊 Fried Chicken Nuggets', 7.90, 23, 'Crispy and tender chicken nuggets, perfect for dipping in your favorite sauce.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:11:01.722Z_nf6n8c_lwejhfq0', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(137, '南乳炸雞翅 Traditional Beancurd Fried Chicken Wings', 11.90, 23, 'Crispy fried chicken wings marinated in beancurd, offering a savory and flavorful experience.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:11:11.344Z_yac1ra_lwej5i1l', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(138, '原味椒鹽炸雞翅 Salted-Pepper Fried Chicken Wings', 11.90, 23, 'Classic salted pepper fried chicken wings with a perfect balance of salt and spice.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:11:22.316Z_83d6wx_lwej5r21', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(139, '甜不辣 Fried Seafood Tempura', 8.90, 23, 'Crispy fried seafood tempura with a light batter, offering a crunchy texture and savory flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:11:31.732Z_u31340_lzb8renv', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(140, '甘梅地瓜棒 Sweet Potato Fries with Plum Powder', 8.90, 23, 'Sweet potato fries seasoned with plum powder, offering a sweet and tangy twist on a classic favorite.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:11:41.550Z_0ky2fr', '2025-05-04 05:58:37', 0, 'East Asian', 1, 'FOOD'),
(141, '鹽酥雞 Salted Popcorn Chicken', 8.90, 23, 'Crispy popcorn chicken seasoned with salt, creating a simple yet flavorful snack.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:11:51.333Z_n3hg4d_lwekgefp', '2025-05-04 05:58:37', 0, 'East Asian', 0, 'FOOD'),
(142, '炸杏鮑菇 Fried King Oyster Mushroom', 7.90, 23, 'Golden fried king oyster mushrooms with a crispy exterior and a tender, juicy interior.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:12:02.883Z_vm9o3p', '2025-05-04 05:58:37', 0, 'East Asian', 1, 'FOOD'),
(143, '牛奶脆脆卷 Crispy Milk Roll', 9.90, 23, 'Crispy rolls filled with a creamy milk filling, offering a sweet and crispy treat.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:12:13.307Z_g06w52_lwejgibv', '2025-05-04 05:58:37', 0, 'East Asian', 1, 'FOOD'),
(144, '白茶芋球 White Taro Ball', 13.90, 23, 'Soft and chewy white taro balls, offering a sweet and satisfying dessert.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2024-09-01T13:41:26.351Z_75b34f_m0ks4hsv', '2025-05-04 05:58:37', 0, 'East Asian', 1, 'FOOD'),
(145, '凉拌黃瓜 Cucumber in Vinegar Sauce', 7.90, 23, 'Fresh cucumber slices in a tangy vinegar sauce, offering a refreshing and light side dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:09:45.002Z_vy08m4', '2025-05-04 05:58:37', 0, 'East Asian', 1, 'FOOD'),
(146, '凉拌木耳 Black Fungus in Vinegar Sauce', 7.90, 23, 'Black fungus marinated in a tangy vinegar sauce, creating a light and refreshing dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:10:02.492Z_vc4kjq', '2025-05-04 05:58:37', 0, 'East Asian', 1, 'FOOD'),
(147, '凉拌海帶 Seaweed in Vinegar Sauce', 7.90, 23, 'Seaweed marinated in a zesty vinegar sauce, offering a light, refreshing, and healthy side dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:10:17.998Z_9cbg51', '2025-05-04 05:58:37', 0, 'East Asian', 1, 'FOOD'),
(148, '三色拼盤 Mini Snacks Platter', 19.90, 23, 'A platter featuring fried seafood tempura, sweet potato fries with plum powder, and salted popcorn chicken.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:12:43.444Z_3qwz6p_lwg1m7j1', '2025-05-04 05:59:26', 0, 'East Asian', 0, 'FOOD'),
(149, '八色拼盤 Jumbo Snacks Platter', 49.90, 23, 'A large platter with a variety of snacks: fried seafood tempura, sweet potato fries, salted popcorn chicken, fried wonton, fried mushroom, dumplings, crispy milk roll, and white taro ball.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:13:14.977Z_gtbj6j', '2025-05-04 05:59:26', 0, 'East Asian', 0, 'FOOD'),
(150, '龜苓膏 Homemade Gui-Ling-Gao', 5.90, 23, 'A traditional Chinese herbal jelly, made from a mix of various herbs with a cooling effect.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:14:10.208Z_zyg9nz', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'FOOD'),
(151, '四季豆花 Four Season Beancurd', 10.90, 23, 'A smooth and creamy tofu dessert topped with a seasonal assortment of ingredients.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:14:39.996Z_oz8ggy_lzb8qzpi', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'FOOD'),
(152, '奶酥吐司 Milky Butter Toast', 5.90, 23, 'Toasty bread topped with rich butter and a creamy milky glaze, perfect for a sweet snack.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:14:51.154Z_jfi9b8', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'FOOD'),
(153, '花生奶油吐司 Peanut Butter Toast', 5.90, 23, 'Crispy toast spread with creamy peanut butter, offering a deliciously nutty flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:15:03.470Z_74ij83', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'FOOD'),
(154, '綜合口味吐司 Mix Flavours Toast', 7.90, 23, 'A variety of flavored toasts, offering a diverse mix of toppings for an exciting snack.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:15:39.932Z_bhrf9g', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'FOOD'),
(155, '鐵觀音 Tie-guan-yin (HOT)', 6.00, 23, 'A traditional Chinese tea, known for its robust flavor and aromatic floral notes.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:24:13.710Z_2jce1y', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(156, '普洱茶 Pu’er Tea (HOT)', 6.00, 23, 'A unique fermented tea from Yunnan, with earthy flavors and a smooth finish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:24:26.399Z_d3nqgt', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(157, '茉莉花茶 Jasmine Tea (HOT)', 6.00, 23, 'A fragrant green tea infused with jasmine flowers, offering a delicate floral flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:24:37.266Z_mj4r0s', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(158, '西湖龍井 Lung-Jing Tea (HOT)', 6.00, 23, 'A famous Chinese green tea, known for its fresh, slightly sweet flavor with a hint of chestnut.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:24:48.800Z_5q0tme', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(159, '桂花烏龍茶 Osmanthus Oolong Tea', 7.90, 23, 'Oolong tea infused with osmanthus flowers, offering a fragrant and floral taste.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:21:41.631Z_hjokt4', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(160, '白桃烏龍茶 Peach Oolong Tea', 7.90, 23, 'A fragrant oolong tea with a refreshing peach flavor, perfect for a light, aromatic tea experience.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:21:54.542Z_0ke57r', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(161, '金桔綠茶 Lime Green Tea (Pot)', 7.90, 23, 'A refreshing green tea with a zesty lime twist, served in a pot for a relaxing drink.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:22:05.574Z_gdrx4t', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(162, '養生菊花茶 Chrysanthemum Tea', 10.90, 23, 'A traditional herbal tea made with chrysanthemum flowers, known for its cooling properties and mild sweetness.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:22:16.588Z_044ytj', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(163, '玫瑰四物茶 Rose Siwu Tea', 10.90, 23, 'A herbal tea made with rose petals and traditional Chinese herbs, offering a calming and aromatic experience.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:22:30.847Z_5ergrg_lwhc06d9', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(164, '壹禾豐特色奶茶 Yi-He-Feng Milk Tea Special', 9.90, 23, 'A special milk tea blend with a rich, creamy taste and a touch of sweetness, perfect for tea lovers.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:22:42.763Z_8dapft_lwhc81ph', '2025-05-04 05:59:26', 0, 'East Asian', 0, 'DRINK'),
(165, '養顏愛妃茶 Apple Tea with Red Dates Wolfberry', 10.90, 23, 'A nourishing tea made with apples, red dates, and wolfberries, known for its health benefits and natural sweetness.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:22:54.343Z_s8fr22_lwhc2tq5', '2025-05-04 05:59:26', 0, 'East Asian', 1, 'DRINK'),
(166, '枸杞紅棗養生茶 Red Dates Wolfberry Tea', 10.90, 23, 'Red Dates Wolfberry Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:23:07.019Z_uc6b4o', '2025-05-04 06:00:32', 0, 'East Asian', 0, 'DRINK'),
(167, '蜜香水果茶 Honey Fruit Tea', 11.90, 23, 'Honey Fruit Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:23:20.270Z_m694pf', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(168, '超級水果茶 Supreme Fruit Tea', 17.90, 23, 'Supreme Fruit Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:23:38.988Z_ilq9ar_lwhc54bp', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(169, '黑咖啡 Black Coffee (HOT)', 4.90, 23, 'Black Coffee (HOT)', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:18:52.240Z_17x74r', '2025-05-04 06:00:32', 0, 'Western European', 0, 'DRINK'),
(170, '奶咖啡 Milky Coffee (HOT)', 5.90, 23, 'Milky Coffee (HOT)', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:19:12.348Z_68syw8_lwhby8zu', '2025-05-04 06:00:32', 0, 'Western European', 0, 'DRINK'),
(171, '三色咖啡 3 Layer Coffee (HOT)', 6.90, 23, '3 Layer Coffee (HOT)', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:20:15.280Z_yrgs84_lwhbw3nv', '2025-05-04 06:00:32', 0, 'Western European', 0, 'DRINK'),
(172, '美祿紅茶 Milo Black Tea (HOT)', 5.90, 23, 'Milo Black Tea (HOT)', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:20:35.849Z_gmw856_lweiv390', '2025-05-04 06:00:32', 0, 'Southeast Asian', 0, 'DRINK'),
(173, '巧克力 Chocolate (HOT)', 6.90, 23, 'Chocolate (HOT)', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:20:57.134Z_vrvlut', '2025-05-04 06:00:32', 0, 'Western European', 0, 'DRINK'),
(174, '冷萃黑咖啡 Cold Brew Black Coffee', 6.90, 23, 'Cold Brew Black Coffee', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:19:30.221Z_z6v2b9', '2025-05-04 06:00:32', 0, 'Western European', 0, 'DRINK'),
(175, '冷萃奶咖啡 Cold Brew Milky Coffee', 7.90, 23, 'Cold Brew Milky Coffee', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:19:40.551Z_6jlay9', '2025-05-04 06:00:32', 0, 'Western European', 0, 'DRINK'),
(176, '三色咖啡 冷 3 Layer Coffee (ICE)', 7.90, 23, '3 Layer Coffee (ICE)', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-10-28T05:43:43.061Z_ani3i6', '2025-05-04 06:00:32', 0, 'Western European', 0, 'DRINK'),
(177, '美禄红茶 Milo Black Tea (ICE)', 6.90, 23, 'Milo Black Tea (ICE)', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-10-28T03:31:49.774Z_9r76ni_lwekvgbx', '2025-05-04 06:00:32', 0, 'Southeast Asian', 0, 'DRINK'),
(178, '巧克力冰 Chocolate (ICE)', 7.90, 23, 'Chocolate (ICE)', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-10-28T05:45:00.903Z_17o97g_lwekvwf5', '2025-05-04 06:00:32', 0, 'Western European', 0, 'DRINK'),
(179, '茉香綠茶 Jasmine Green Tea', 5.90, 23, 'Jasmine Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:25:24.938Z_jyg4wr_lwhaoyqb', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(180, '百香綠茶 Passion Fruit Green Tea', 6.90, 23, 'Passion Fruit Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:25:37.321Z_dzrped_lwhaqpy3', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(181, '蜂蜜茉香綠茶 Honey Jasmine Green Tea', 6.90, 23, 'Honey Jasmine Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:25:49.034Z_3kookg_lwhar4kg', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(182, '梅子情人茶 Lover Plum Green Tea', 6.90, 23, 'Lover Plum Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:26:02.239Z_j38rbf_lwhasi4s', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(183, '金桔綠茶 Lime Green Tea', 6.90, 23, 'Lime Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:26:53.252Z_3joqdq_lwhatvw7', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(184, '泡沫綠奶茶 Shake Milk Green Tea', 7.90, 23, 'Shake Milk Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:27:05.180Z_s3zw8m_lwhbsu2u', '2025-05-04 06:00:32', 0, 'East Asian', 0, 'DRINK'),
(185, '珍珠綠奶 Sago Milk Green Tea', 8.90, 23, 'Sago Milk Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:27:17.626Z_fuw0pj_lwhb2flg', '2025-05-04 06:00:32', 0, 'East Asian', 0, 'DRINK'),
(186, '翡翠綠珍珠 Sago Mint Milk Green Tea', 8.90, 23, 'Sago Mint Milk Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:27:28.920Z_a85kq0_lwhazkth', '2025-05-04 06:00:32', 0, 'East Asian', 0, 'DRINK'),
(187, '珍珠極品綠茶 Sago Honey Lemon Green Tea', 7.90, 23, 'Sago Honey Lemon Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:27:40.966Z_z1pdne_lwhbue3x', '2025-05-04 06:00:32', 0, 'East Asian', 0, 'DRINK'),
(188, '青檸蜜綠茶 Honey Lime Green Tea', 7.90, 23, 'Honey Lime Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:28:00.334Z_py368m_lwhb3xu9', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(189, '養樂多綠茶 Yakult Green Tea', 7.90, 23, 'Yakult Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:28:14.659Z_187o79_lwhb610r', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(190, '白桃綠茶 Peach Green Tea', 6.90, 23, 'Peach Green Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:28:28.979Z_2hdq9y_lwhb72l3', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(191, '泡沫紅茶 Shake Black Tea', 5.90, 23, 'Shake Black Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:29:08.770Z_cvvbno', '2025-05-04 06:00:32', 0, 'East Asian', 0, 'DRINK'),
(192, '百香紅茶 Passion Fruit Black Tea', 6.90, 23, 'Passion Fruit Black Tea', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:29:19.781Z_l3larf', '2025-05-04 06:00:32', 0, 'East Asian', 1, 'DRINK'),
(193, 'Honey Peach Black Tea 蜂蜜白桃紅茶', 6.90, 23, 'A sweet and fragrant black tea infused with honey and peach flavors.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:29:30.607Z_n3tsyj', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK');
INSERT INTO `dishes` (`dish_id`, `dish_name`, `unit_price`, `restaurant_id`, `dish_description`, `image_url`, `date_added`, `times_ordered`, `cuisine_type`, `vegetarian`, `type`) VALUES
(194, 'Lemon Black Tea 檸檬紅茶', 6.90, 23, 'Refreshing black tea with a zesty lemon twist.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:29:42.701Z_nc27h4', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(195, 'Shake Milk Tea 泡沫奶茶', 7.90, 23, 'A smooth and frothy milk tea with a shake for added texture.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:30:06.955Z_tcw9ja', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(196, 'Cincao Milk Tea 仙草奶茶', 8.90, 23, 'Milk tea with the unique and herbal taste of cincao (grass jelly).', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:30:17.923Z_fq8du9', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(197, 'Sago Milk Tea 珍珠奶茶', 8.90, 23, 'Classic milk tea with chewy sago pearls for added texture.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:30:29.985Z_2lwdc2', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(198, 'Red Bean Milk Tea 相思紅豆奶茶', 8.90, 23, 'Creamy milk tea with sweet red bean paste for a comforting flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:30:42.679Z_6hl2ao', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(199, 'Kanten Brown Sugar Fresh Milk 寒天黑糖鮮奶', 8.90, 23, 'Rich brown sugar syrup blended with fresh milk and kanten jelly for a smooth finish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:30:54.986Z_67pe5f_lwhc99vb', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(200, 'Honey Lemon Tea 檸檬蜜汁', 6.90, 23, 'Sweet honey and tangy lemon come together in this refreshing drink.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:33:35.048Z_izdiky_lwhbmj1q', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(201, 'Concentrated Orange Juice 濃縮柳橙汁', 8.90, 23, 'A tangy and concentrated orange juice perfect for citrus lovers.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:33:47.414Z_wg1n6d', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(202, 'Ice Blended Kiwi 奇異果沙冰', 7.90, 23, 'A refreshing ice-blended kiwi drink, perfect for a cool treat.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:33:59.606Z_p31iuu', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(203, 'Ice Blended Passion Fruit 百香果沙冰', 7.90, 23, 'A deliciously tropical ice-blended drink with the vibrant flavor of passion fruit.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:34:14.151Z_y7ayan_lwhbr8pc', '2025-05-04 06:06:06', 0, 'East Asian', 1, 'DRINK'),
(204, 'Ice Blended Mango 芒果沙冰', 7.90, 23, 'A refreshing ice-blended mango drink, perfect for a tropical treat.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:34:26.132Z_ycsmgi_lwhbquss', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(205, 'Ice Blended Peach 白桃沙冰', 7.90, 23, 'A smooth and refreshing ice-blended peach drink for a sweet escape.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:34:39.151Z_emuy6x_lzb9gnu7', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(206, 'Papaya Milk 木瓜鮮奶', 9.90, 23, 'A creamy and smooth milk drink infused with the natural sweetness of papaya.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:34:59.621Z_r0sbqz_lzb8n9a8', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(207, 'Honeydew Milk 蜜瓜鮮奶', 9.90, 23, 'A refreshing and creamy milk drink with the light flavor of honeydew melon.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:35:13.009Z_6fq77l_lwhcdw18', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(208, 'Watermelon Milk 西瓜鮮奶', 9.90, 23, 'A refreshing milk drink with the vibrant taste of watermelon.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:35:27.386Z_3wencr', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(209, 'Lemon Pear Juice 檸檬秋梨飲', 7.90, 23, 'A tangy and sweet drink made with lemon and pear for a zesty flavor.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:35:41.442Z_xu06s0_lzb6kste', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(210, 'Sakura Kanten Sparkling Drinks 櫻花寒天氣泡飲', 8.90, 23, 'A sparkling drink with the delicate flavor of sakura and kanten jelly.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:35:55.805Z_8q2pwo', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(211, 'Grape Kanten Sparkling Drinks 葡萄寒天氣泡飲', 8.90, 23, 'A refreshing sparkling drink with grape flavor and kanten jelly.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:36:08.195Z_y5nq1y_lwhbokru', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(212, 'Watermelon Green Tea Lemon Juice 西瓜綠茶檸檬汁', 8.90, 23, 'A zesty watermelon juice combined with refreshing green tea and lemon.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:36:20.712Z_efmj2g_lzb9h16z', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(213, 'Yakult Fruit Jasmine Tea 水果茉莉養樂多', 8.90, 23, 'A unique blend of jasmine tea, fruity flavors, and yakult for a tangy twist.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-09-23T14:36:36.340Z_ezn684_lzb9hkot', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(214, 'Braised Tofu 豆干 (2pcs)', 1.50, 23, 'Two pieces of savory braised tofu, a perfect savory snack or side dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-10-22T07:02:43.800Z_4l0zvh', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'FOOD'),
(215, 'Braised Egg 卤蛋 (1pc)', 2.00, 23, 'A single piece of deliciously braised egg, full of flavor and richness.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-10-22T07:03:57.949Z_e5ow6l', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'FOOD'),
(216, 'Minced Pork 肉燥', 2.00, 23, 'A savory minced pork topping, perfect for adding rich flavor to any dish.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-11-08T10:06:40.369Z_013kfv', '2025-05-04 06:08:52', 0, 'East Asian', 0, 'FOOD'),
(217, 'Ice Water 冰开水', 0.50, 23, 'A refreshing glass of cold ice water to quench your thirst.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-10-17T15:40:50.525Z_lyvtlo', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(218, 'Warm Water 温开水', 0.50, 23, 'A soothing glass of warm water for a calming refreshment.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-10-17T15:41:29.629Z_efjag7', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK'),
(219, 'Hot Water 热开水', 0.50, 23, 'A comforting glass of hot water, simple and pure.', 'https://image.feedme.cc/menu/65091b9e8fed74001b9d3bd4/item_2023-10-17T15:42:02.594Z_r46vpl', '2025-05-04 06:08:52', 0, 'East Asian', 1, 'DRINK');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `delivery_type` enum('DINE-IN','TAKEAWAY','','') NOT NULL DEFAULT 'DINE-IN',
  `table_number` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('PENDING','COMPLETED','CANCELLED','') NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `grand_total`, `created_at`, `delivery_type`, `table_number`, `address`, `status`) VALUES
(1, 1, 60.84, '2025-05-05 16:20:48', 'DINE-IN', 15, NULL, 'COMPLETED'),
(2, 1, 65.44, '2025-05-05 16:21:04', 'TAKEAWAY', NULL, 'uosm', 'PENDING'),
(3, 2, 94.91, '2025-05-05 18:15:37', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'CANCELLED'),
(4, 2, 21.55, '2025-05-05 18:44:46', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'COMPLETED'),
(5, 2, 79.73, '2025-05-05 21:44:38', 'DINE-IN', 2, NULL, 'CANCELLED'),
(6, 1, 19.46, '2025-05-06 00:52:01', 'DINE-IN', 17, NULL, 'PENDING'),
(7, 2, 62.55, '2025-05-06 01:17:30', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'COMPLETED'),
(8, 2, 90.14, '2025-05-06 01:40:47', 'DINE-IN', 56, NULL, 'CANCELLED'),
(9, 2, 51.72, '2025-05-06 04:47:29', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'CANCELLED'),
(10, 2, 66.53, '2025-05-06 04:57:42', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'COMPLETED'),
(11, 2, 66.53, '2025-05-06 04:58:16', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'CANCELLED'),
(12, 2, 39.87, '2025-05-06 05:04:07', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'CANCELLED'),
(13, 2, 39.87, '2025-05-06 05:05:47', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'PENDING'),
(14, 2, 39.87, '2025-05-06 05:06:38', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'CANCELLED'),
(15, 2, 39.87, '2025-05-06 05:07:22', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'CANCELLED'),
(16, 2, 39.87, '2025-05-06 05:09:14', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'CANCELLED'),
(17, 2, 39.87, '2025-05-06 05:09:59', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'CANCELLED'),
(18, 2, 62.36, '2025-05-06 05:11:00', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'COMPLETED'),
(19, 2, 62.45, '2025-05-06 05:12:08', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'PENDING'),
(20, 2, 39.87, '2025-05-06 05:12:29', 'DINE-IN', 15, NULL, 'PENDING'),
(21, 2, 11.39, '2025-05-06 05:13:17', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'PENDING'),
(22, 2, 13.67, '2025-05-06 05:13:30', 'TAKEAWAY', NULL, '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', 'COMPLETED');

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
(1, 1, 36, 1),
(2, 1, 6, 1),
(3, 1, 45, 1),
(4, 1, 215, 1),
(5, 1, 214, 1),
(6, 1, 7, 1),
(7, 2, 150, 1),
(8, 2, 120, 1),
(9, 2, 169, 1),
(10, 2, 104, 1),
(11, 2, 84, 1),
(12, 2, 74, 1),
(13, 3, 1, 1),
(14, 3, 36, 2),
(15, 3, 6, 2),
(16, 3, 45, 2),
(17, 3, 214, 1),
(18, 4, 31, 1),
(19, 5, 1, 2),
(20, 5, 2, 2),
(21, 5, 3, 2),
(22, 6, 47, 1),
(23, 6, 46, 1),
(24, 6, 45, 1),
(25, 7, 1, 1),
(26, 7, 2, 1),
(27, 7, 3, 1),
(28, 7, 32, 1),
(29, 8, 33, 1),
(30, 8, 6, 1),
(31, 8, 45, 1),
(32, 8, 7, 1),
(33, 8, 214, 1),
(34, 8, 201, 3),
(35, 9, 1, 1),
(36, 9, 2, 1),
(37, 9, 36, 1),
(38, 9, 45, 1),
(39, 9, 214, 1),
(40, 10, 1, 1),
(41, 10, 2, 1),
(42, 10, 3, 1),
(43, 10, 36, 1),
(44, 10, 45, 1),
(45, 10, 214, 1),
(46, 11, 1, 1),
(47, 11, 2, 1),
(48, 11, 3, 1),
(49, 11, 36, 1),
(50, 11, 45, 1),
(51, 11, 214, 1),
(52, 12, 1, 1),
(53, 12, 2, 1),
(54, 12, 3, 1),
(55, 13, 1, 1),
(56, 13, 2, 1),
(57, 13, 3, 1),
(58, 14, 1, 1),
(59, 14, 2, 1),
(60, 14, 3, 1),
(61, 15, 1, 1),
(62, 15, 2, 1),
(63, 15, 3, 1),
(64, 16, 1, 1),
(65, 16, 2, 1),
(66, 16, 3, 1),
(67, 17, 1, 1),
(68, 17, 2, 1),
(69, 17, 3, 1),
(70, 18, 32, 1),
(71, 18, 31, 1),
(72, 18, 30, 1),
(73, 19, 31, 1),
(74, 19, 36, 1),
(75, 19, 6, 1),
(76, 19, 45, 1),
(77, 20, 1, 1),
(78, 20, 2, 1),
(79, 20, 3, 1),
(80, 21, 1, 1),
(81, 22, 2, 1);

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
(2, 'Burger Bandit', ' 27, Jalan Eko Botani 3/7, Taman Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', '12:00:00', '22:00:00', '018-358 6779', 4.50, 'MEDIUM', 'https://ecobotaniccity.ecoworld.my/wp-content/uploads/2023/08/thumbnail_burger-scaled.jpg', 'We are a gourmet fast-serve selling homemade burgers and delicious beverages!'),
(20, 'McDonald\'s', 'Jln Kampung Lalang, Educity, 79100 Iskandar Puteri, Johor Darul Ta\'zim', '00:00:00', '00:00:00', '07-510 3667', 3.80, 'LOW', 'https://external-preview.redd.it/ydtFoz1DJGWi-nYkdUJwyjS8KoT4JgSEbYqAPt4Ftco.png?format=pjpg&auto=webp&s=52688b57369fdbd5d1eb59f75fb83a904ff95df2', 'It\'s Finger Lickin\' Good'),
(23, 'Yi He Feng', '3, EKO GALLERIA, B0104, BLOK B, TAMAN, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', '11:00:00', '22:00:00', '07-585 6629', 3.90, 'MEDIUM', 'https://i.imgur.com/Dsxsh8G.png', 'Traditional Chinese cuisine integrated with Creative dishes.');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `restaurant_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 2, 5, 'The Ultimate Beef Burger was hands down one of the juiciest burgers I\'ve had in ages. Packed with flavor and cooked perfectly. Burger Bandit really knows how to steal your taste buds—in the best way!', '2025-05-06 23:53:33'),
(2, 2, 2, 4, 'Tried the Mac n\' Cheese Chicken Burger and wow, it’s like my two favorite comfort foods had a baby. Super cheesy, crispy chicken, and totally satisfying.', '2025-05-05 05:30:03'),
(3, 1, 2, 5, 'The Nasi Lemak Burger blew me away. Sambal was spot on, and the crunch from the anchovies? Genius. Never thought nasi lemak and burgers would work so well together.', '2025-05-04 17:53:33'),
(4, 2, 2, 4, 'The Spicy Chicken Burger brought the heat! If you like spicy, you’ll love it. Bun was soft, chicken was crisp, and the sauce had a nice kick.', '2025-05-03 17:24:44'),
(5, 1, 2, 5, 'Loved the Aloha Burger! The pineapple added just the right touch of sweetness to the savory patty. Definitely ordering it again.', '2025-05-02 17:53:33'),
(6, 2, 2, 4, 'Tried the Cheesy Tots Chicken Burger and it was packed with cheesy flavor and a nice crunch from the tots. Could’ve used a bit more sauce, but still awesome.', '2025-05-01 17:33:50'),
(7, 1, 2, 5, 'I wasn’t sure what to expect from the Prawn Katsu Burger, but it was fantastic. Crunchy, juicy prawn patty and a nice tangy slaw. Really unique!', '2025-05-22 17:53:33'),
(8, 2, 2, 4, 'The Korean Burger had that perfect sweet-spicy glaze, and the pickled veggies gave a nice zing. Felt like I was eating Korean BBQ in burger form.', '2025-05-14 17:53:33'),
(9, 1, 2, 5, 'Both the Mozzarella Chicken and Mozzarella Beef Burgers were loaded with gooey cheese. If you\'re a cheese lover, these are a must-try.', '2025-05-01 17:53:33'),
(10, 2, 2, 4, 'The Spicy Kahwin Burger had a bold blend of spices and textures. Loved the mix of ingredients, though it was slightly messy to eat. Worth it though.', '2025-05-07 08:53:33'),
(11, 2, 20, 5, 'The Big Mac is timeless. The sauce is perfect, and it’s the go-to burger for anyone craving something filling and delicious. Definitely my favorite!', '2025-05-06 19:52:05'),
(12, 3, 20, 3, 'The Chicken McNuggets are good, but sometimes they can be a bit too greasy. I like them, but they could use a little more seasoning.', '2025-05-06 19:52:05'),
(13, 8, 20, 2, 'Had the McChicken, and it was dry. The bun wasn’t as fresh as I expected, and the mayo didn’t have enough flavor. Disappointing compared to other places.', '2025-05-06 19:52:05'),
(14, 9, 20, 4, 'The McFlurry with Oreo is a solid choice for dessert. It’s sweet, creamy, and has a nice balance of Oreo chunks. Always a crowd favorite!', '2025-05-06 19:52:05'),
(15, 10, 20, 1, 'The fries were soggy, and my burger tasted bland. I expected better from McDonald\'s, especially at this location. Not coming back anytime soon.', '2025-05-06 19:52:05'),
(16, 2, 20, 4, 'The Egg McMuffin is the perfect breakfast sandwich. The egg is fluffy, and the sausage has just the right spice. Can’t go wrong with this one!', '2025-05-06 19:52:05'),
(17, 3, 20, 3, 'The Filet-O-Fish is okay, but the fish filet didn’t taste as fresh as I’d hoped. It’s decent, but not my go-to McDonald’s order.', '2025-05-06 19:52:05'),
(18, 8, 20, 5, 'I love the McCafé iced coffee. It’s the perfect pick-me-up for a long day. I love the caramel flavor, and it’s a great alternative to other coffee shops.', '2025-05-06 19:52:05'),
(19, 9, 20, 4, 'The Quarter Pounder with Cheese is a great choice. The beef patty is juicy, and the cheese is melty. A hearty burger for a quick meal.', '2025-05-06 19:52:05'),
(20, 10, 20, 2, 'I ordered a Happy Meal for my kid, and the toy was missing. Not a huge deal, but the food quality was also below average. Not happy with this visit.', '2025-05-06 19:52:05'),
(27, 8, 20, 5, 'I love McDonald\'s so much!', '2025-05-06 20:00:46'),
(30, 8, 1, 4, 'Domino\'s Pizza is perfect for parties!', '2025-05-06 20:09:01'),
(31, 8, 20, 3, 'McDonald\'s is sometimes just what I need for a quick snack when I\'m on the go.', '2025-05-06 20:10:57');

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
  `pfp_url` text DEFAULT 'assets/pfp.png',
  `phone_number` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `orders_made` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `role`, `created_at`, `pfp_url`, `phone_number`, `address`, `restaurant_id`, `orders_made`) VALUES
(1, 'admin1', 'admin1@gmail.com', '$2y$10$kAy5ipaP0huv39qdGn0cGeElZWXe1tc8ovmbZ57rgSUBBZtZW6IvC', 'ADMIN', '2025-05-02 15:17:37', 'https://www.shutterstock.com/image-vector/user-account-avatar-icon-pictogram-600nw-1860375778.jpg', NULL, NULL, NULL, 0),
(2, 'customer1', 'customer1@gmail.com', '$2y$10$ldV/tfl/Gk0HutNuNWiVlOvNUt6NbjSpzVvMvzE6VdnjB7N9Qy5/a', 'USER', '2025-05-02 18:29:56', 'https://static.vecteezy.com/system/resources/previews/013/336/605/non_2x/corporate-profile-icon-business-man-profile-icon-illustration-free-vector.jpg', '123456789', '3, Eko Galleria, C0301, C0302, C0401, Blok C, Taman, Persiaran Eko Botani, 79100 Iskandar Puteri, Johor Darul Ta\'zim', NULL, 400),
(3, 'customer2', 'customer2@gmail.com', '$2y$10$wlToP9X5h.vUd4yUmOTtzOCDEjXpPGoO5m3H8YAI7Q2wgCvG36dMe', 'USER', '2025-05-03 19:26:26', 'assets/pfp.png', NULL, NULL, NULL, 0),
(4, 'mcDonalds', 'mcDonalds@gmail.com', '$2y$10$YEmt2.ZW6cC01liWtdxWsuk8Hgh6J12aN7sFLMaYID6imFjKuMrP6', 'SELLER', '2025-05-05 23:18:08', 'https://external-preview.redd.it/ydtFoz1DJGWi-nYkdUJwyjS8KoT4JgSEbYqAPt4Ftco.png?format=pjpg&auto=webp&s=52688b57369fdbd5d1eb59f75fb83a904ff95df2', NULL, NULL, 20, 0),
(5, 'yiHeFeng', 'yiHeFeng@gmail.com', '$2y$10$jxLjNEv0WZHUJYutopgpFu7gX8uHLcKE6H9ofDxKT4sS90nUSlDti', 'SELLER', '2025-05-05 23:25:00', 'https://i.imgur.com/Dsxsh8G.png', NULL, NULL, 23, 0),
(6, 'burgerBandit', 'burgerBandit@gmail.com', '$2y$10$.RnInvzEtEbfq4okOP0iu.NJrg1deeEWrikoiQ5M0xt0uUBil2.Ve', 'SELLER', '2025-05-05 23:25:23', 'https://ecobotaniccity.ecoworld.my/wp-content/uploads/2023/08/thumbnail_burger-scaled.jpg', NULL, NULL, 2, 0),
(7, 'dominosPizza', 'dominosPizza@gmail.com', '$2y$10$PwrJzAAEA4cw.XSso8bhN./NgI/HWHoMionbetA2eOn78NaM7fm76', 'SELLER', '2025-05-05 23:25:44', 'https://assets.nst.com.my/images/articles/dominos_1661312345.jpg', NULL, NULL, 1, 0),
(8, 'customer3', 'customer3@gmail.com', '$2y$10$aI60iSzyZR96Xq42S2zyK.twi4WnbUSf5qH8AZReYl7Nd0zzM.D6i', 'USER', '2025-05-06 19:49:22', 'assets/pfp.png', NULL, NULL, NULL, 0),
(9, 'customer4', 'customer4@gmail.com', '$2y$10$AI3yS.ieNsVpZztR5WjYruyXi6YCrpjDb8dvO3BrQIaMTZ5NikLqm', 'USER', '2025-05-06 19:49:31', 'assets/pfp.png', NULL, NULL, NULL, 0),
(10, 'customer5', 'customer5@gmail.com', '$2y$10$Mlfe8zHYkbp5SxWz3a9on.NHOMKT06vmBNxlpD9FDAYaftehWbmJq', 'USER', '2025-05-06 19:49:39', 'assets/pfp.png', NULL, NULL, NULL, 0);

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

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
  MODIFY `dish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
