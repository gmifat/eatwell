-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 26 juin 2020 à 10:07
-- Version du serveur :  5.7.26
-- Version de PHP : 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eatwell`
--

-- --------------------------------------------------------

--
-- Structure de la table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `street_name` varchar(100) NOT NULL,
  `complementary_address_1` varchar(100) DEFAULT NULL,
  `complementary_address_2` varchar(100) DEFAULT NULL,
  `postal_code` varchar(5) NOT NULL,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `addresses`
--

INSERT INTO `addresses` (`id`, `first_name`, `last_name`, `street_name`, `complementary_address_1`, `complementary_address_2`, `postal_code`, `city`) VALUES
(4, '', '', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(5, '', '', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(6, '', '', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(7, 'fatma', 'gmiden', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(8, 'fatma', 'gmiden', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(9, 'fatma', 'gmiden', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(10, 'fatma', 'gmiden', '', '', '', '', ''),
(11, 'fatma', 'gmiden', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(12, 'fatma', 'gmiden', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(13, 'fatma', 'gmiden', 'qsdqsdqsd', '', '', '95800', 'qsdqsdsqd'),
(14, 'fatma', 'gmiden', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(15, 'fatma', 'gmiden', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(16, 'fatma', 'gmiden', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche'),
(17, 'fatma', 'gmiden', '20 allée du Président Barbicane', '', '', '95800', 'Courdimanche');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `color` varchar(9) NOT NULL DEFAULT '#B66590',
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `icon`, `thumbnail`, `color`, `parent_id`) VALUES
(1, 'Légumes', 'Les légumes sont une source irremplaçable de minéraux et de nutriments', '1.png', '1.png', '#b68b65', NULL),
(2, 'Fruits', 'Les fruits bio sont pleins de vitamines et sont extrêmement utiles', '2.png', '2.png', '#8b65b6', NULL),
(3, 'Jus', 'Le jus frais peut ajouter de l\'énergie et de la bonne humeur à votre journée', '3.png', '3.png', '#B66590', NULL),
(4, 'Jus de fruits', '', '4.png', '4.png', '#B66590', 3),
(5, 'Jus de légumes', '', '5.png', '5.png', '#B66590', 3),
(6, 'Jus mixte', '', '6.png', '6.png', '#B66590', 3);

-- --------------------------------------------------------

--
-- Structure de la table `discount_types`
--

DROP TABLE IF EXISTS `discount_types`;
CREATE TABLE IF NOT EXISTS `discount_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `symbol` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `discount_types`
--

INSERT INTO `discount_types` (`id`, `code`, `name`, `symbol`) VALUES
(1, 'percent', 'Pourcentage', '%'),
(2, 'fix', 'Fixe', '€');

-- --------------------------------------------------------

--
-- Structure de la table `favored_products`
--

DROP TABLE IF EXISTS `favored_products`;
CREATE TABLE IF NOT EXISTS `favored_products` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`product_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `home_page_images`
--

DROP TABLE IF EXISTS `home_page_images`;
CREATE TABLE IF NOT EXISTS `home_page_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src_image` int(11) NOT NULL,
  `short_description` varchar(100) DEFAULT NULL,
  `link` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src_image` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `src_image`, `position`, `product_id`) VALUES
(1, '4_1.jpg', 1, 4),
(2, '4_2.png', 2, 4),
(3, '2_1.png', 1, 2),
(4, '2_2.png', 2, 2),
(5, '2_3.png', 3, 2),
(6, '2_4.png', 4, 2),
(7, '5_1.jpg', 1, 5),
(8, '5_2.jpg', 2, 5),
(9, '5_3.jpg', 3, 5),
(10, '6_1.jpg', 1, 6),
(11, '6_2.jpg', 2, 6),
(12, '6_3.jpg', 3, 6),
(13, '7_1.jpg', 1, 7),
(14, '7_2.jpg', 2, 7),
(15, '7_3.jpg', 3, 7),
(16, '1_1.jpg', 1, 1),
(17, '1_2.jpg', 2, 1),
(18, '1_3.jpg', 3, 1),
(19, '4_1.jpg', 1, 4),
(20, '4_2.jpg', 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `registration_date`) VALUES
(1, 'test1@monmail.com', '2020-05-11 22:00:00'),
(3, 'test3@monmail.com', '2020-05-12 22:00:00'),
(4, 'gmiden.fatma@gmail.com', '2020-06-19 09:40:39'),
(5, 'gmifat@gmail.com', '2020-06-21 00:45:59');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `order_amount` int(11) NOT NULL,
  `delivery_amount` int(11) NOT NULL,
  `delivery_address_id` int(11) NOT NULL,
  `billing_address_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_address_id` (`delivery_address_id`),
  KEY `billing_address_id` (`billing_address_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `user_id`, `first_name`, `last_name`, `email`, `phone_number`, `order_amount`, `delivery_amount`, `delivery_address_id`, `billing_address_id`) VALUES
(2, '2020-06-20 00:11:06', 3, 'Gmiden', 'Fatma', 'gmiden.fatma@gmail.com', '0650913625', 24, 1000, 4, NULL),
(3, '2020-06-20 00:14:27', 3, 'Gmiden', 'Fatma', 'gmiden.fatma@gmail.com', '0650913625', 295, 1000, 5, NULL),
(4, '2020-06-20 00:16:36', 2, 'Gmiden', 'fatma', 'gmiden.fatma@gmail.com', '0650913625', 1990, 1000, 6, NULL),
(5, '2020-06-20 20:06:28', 2, 'fatma', 'gmiden', 'gmifat@gmail.com', '0787947398', 410, 1000, 7, NULL),
(6, '2020-06-21 00:33:54', 2, 'fatma', 'gmiden', 'gmifat@gmail.com', '0787947398', 295, 1000, 12, 13),
(7, '2020-06-21 00:47:31', 2, 'fatma', 'gmiden', 'gmifat@gmail.com', '0787947398', 4200, 1000, 14, NULL),
(8, '2020-06-21 04:16:55', 2, 'fatma', 'gmiden', 'gmifat@gmail.com', '0787947398', 3035, 1000, 15, NULL),
(9, '2020-06-21 13:59:13', 2, 'fatma', 'gmiden', 'gmifat@gmail.com', '0787947398', 1180, 1000, 16, NULL),
(10, '2020-06-21 14:18:06', 2, 'fatma', 'gmiden', 'gmifat@gmail.com', '0787947398', 4000, 1000, 17, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `name`, `short_description`) VALUES
(1, 2, 1, 1, 3, 'Fraise Française Barquette 250g Bio', 'Fraise Française Barquette 250g Bio'),
(2, 2, 6, 3, 6, 'Jus de fruits rouge', 'Pour une bonne matinee Fruits Rouge'),
(3, 2, 5, 1, 4, 'Jus de pomme', 'Pour une meilleur sante. Pomme'),
(4, 3, 1, 1, 295, 'Fraise Française Barquette 250g Bio', 'Fraise Française Barquette 250g Bio'),
(5, 4, 1, 2, 295, 'Fraise Française Barquette 250g Bio', 'Fraise Française Barquette 250g Bio'),
(6, 4, 6, 1, 580, 'Jus de fruits rouge', 'Pour une bonne matinee Fruits Rouge'),
(7, 4, 5, 2, 410, 'Jus de pomme', 'Pour une meilleur sante. Pomme'),
(8, 5, 5, 1, 410, 'Jus de pomme', 'Pour une meilleur sante. Pomme'),
(9, 6, 1, 1, 295, 'Fraise Française Barquette 250g Bio', 'Fraise Française Barquette 250g Bio'),
(10, 7, 5, 6, 410, 'Jus de pomme', 'Pour une meilleur sante. Pomme'),
(11, 7, 6, 3, 580, 'Jus de fruits rouge', 'Pour une bonne matinee Fruits Rouge'),
(12, 8, 1, 3, 295, 'Fraise Française Barquette 250g Bio', 'Fraise Française Barquette 250g Bio'),
(13, 8, 6, 3, 580, 'Jus de fruits rouge', 'Pour une bonne matinee Fruits Rouge'),
(14, 8, 5, 1, 410, 'Jus de pomme', 'Pour une meilleur sante. Pomme'),
(15, 9, 1, 4, 295, 'Fraise Française Barquette 250g Bio', 'Fraise Française Barquette 250g Bio'),
(16, 10, 1, 8, 295, 'Fraise Française Barquette 250g Bio', 'Fraise Française Barquette 250g Bio'),
(17, 10, 5, 4, 410, 'Jus de pomme', 'Pour une meilleur sante. Pomme');

-- --------------------------------------------------------

--
-- Structure de la table `origins`
--

DROP TABLE IF EXISTS `origins`;
CREATE TABLE IF NOT EXISTS `origins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `origins`
--

INSERT INTO `origins` (`id`, `name`, `description`, `image`, `position`) VALUES
(1, 'France', 'France', '1.png', 1),
(2, 'U.E', 'Union européen', '2.png', 2),
(3, 'H.U.E', 'Hors union européen ', '3.png', 3);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `long_description` text NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `quantity` float NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT NULL,
  `is_home_page` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_in_bulk` tinyint(1) NOT NULL DEFAULT '0',
  `discount` int(11) DEFAULT NULL,
  `discount_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unity_id` (`unit_id`,`origin_id`,`category_id`),
  KEY `size_id` (`size_id`) USING BTREE,
  KEY `discount_type` (`discount_type_id`),
  KEY `products_ibfk_1` (`category_id`),
  KEY `products_ibfk_3` (`origin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `reference`, `name`, `short_description`, `long_description`, `thumbnail`, `quantity`, `price`, `unit_price`, `unit_id`, `origin_id`, `category_id`, `size_id`, `is_new`, `is_home_page`, `is_deleted`, `is_in_bulk`, `discount`, `discount_type_id`) VALUES
(1, '052020', 'Fraise Française Barquette 250g Bio', 'Fraise Française Barquette 250g Bio', 'Fraise Française Barquette 250g Bio Fraise Française Barquette 250g Bio Fraise Française Barquette 250g Bio Fraise Française Barquette 250g Bio', '1.jpg', 8, 295, 1180, 4, 1, 2, 1, 0, 0, 0, 0, NULL, NULL),
(2, '052021', 'Mangue bio (à la pièce)', 'Mangue bio (à la pièce) Mangue bio (à la pièce)', 'Mangue bio (à la pièce) Mangue bio (à la pièce) Mangue bio (à la pièce) Mangue bio (à la pièce) Mangue bio (à la pièce) Mangue bio (à la pièce)', '2.png', 0, 195, 195, 3, 3, 2, 1, 0, 1, 0, 0, 10, 1),
(3, '052022', 'Jus de pamplemousse rose 1l', 'Jus de pamplemousse rose 1l', 'Jus de pamplemousse rose 1l Jus de pamplemousse rose 1l Jus de pamplemousse rose 1l Jus de pamplemousse rose 1l Jus de pamplemousse rose 1l', '3.jpg', 5, 580, 580, 2, 1, 4, 2, 0, 0, 0, 0, NULL, NULL),
(4, '020202', 'Tomates Cerises Espagne bio, barquette 250g', 'Tomates Cerises Espagne bio, barquette 250g', 'Tomates Cerises Espagne bio, barquette 250g Tomates Cerises Espagne bio, barquette 250g Tomates Cerises Espagne bio, barquette 250g', '4.jpg', 18, 150, 600, 1, 2, 1, 2, 0, 0, 0, 1, NULL, NULL),
(5, 'j01', 'Jus de pomme', 'Pour une meilleur sante. Pomme', 'Pour une meilleur sante. Pomme Pour une meilleur sante. Pomme', '5.jpg', 2, 420, 420, 2, 1, 4, 2, 1, 0, 0, 0, 10, 2),
(6, 'j02', 'Jus de fruits rouge', 'Pour une bonne matinee Fruits Rouge', 'Pour une bonne matinee Fruits Rouge Pour une bonne matinee Fruits Rouge', '6.jpg', 3, 580, 580, 2, 1, 4, 2, 1, 0, 1, 0, NULL, NULL),
(7, 'j03', 'Jus d\'ananas, épinard', 'Pour booster l\'energie Ananas, Epinard.', 'Pour booster l\'energie Ananas, Epinard. Pour booster l\'energie Ananas, Epinard.', '7.jpg', 0, 520, 520, 2, 1, 6, 2, 1, 0, 0, 0, 20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `product_recipes`
--

DROP TABLE IF EXISTS `product_recipes`;
CREATE TABLE IF NOT EXISTS `product_recipes` (
  `product_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  KEY `product_id` (`product_id`),
  KEY `recipe_id` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product_recipes`
--

INSERT INTO `product_recipes` (`product_id`, `recipe_id`) VALUES
(7, 2),
(3, 3),
(3, 2),
(5, 3),
(6, 4),
(1, 4),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`) VALUES
(2, 'Sportif', 'Desc sportif'),
(3, 'Detox', 'Desc Detox'),
(4, 'Relax', 'Desc relax');

-- --------------------------------------------------------

--
-- Structure de la table `similar_products`
--

DROP TABLE IF EXISTS `similar_products`;
CREATE TABLE IF NOT EXISTS `similar_products` (
  `product_id1` int(11) NOT NULL,
  `product_id2` int(11) NOT NULL,
  PRIMARY KEY (`product_id1`,`product_id2`),
  KEY `product_id2` (`product_id2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `similar_products`
--

INSERT INTO `similar_products` (`product_id1`, `product_id2`) VALUES
(3, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `diameter` varchar(50) DEFAULT NULL,
  `length` varchar(50) DEFAULT NULL,
  `average_weight` varchar(50) DEFAULT NULL,
  `average_number_per_kg` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `description`, `code`, `diameter`, `length`, `average_weight`, `average_number_per_kg`) VALUES
(1, 'EXTRA', 'Qualité supérieure', 'EXTRA', '30 à 45 mm exclus', '', '28', '35 à 42'),
(2, 'Catégorie I', 'Bonne qualité', 'CAT I', '40 à 45 mm exclus', '', '41', '22 à 27'),
(3, 'Catégorie II', 'Qualité marchande', 'CAT II', '30 mm si calibrés / écrat 10 mm si calibre', '', '74', '');

-- --------------------------------------------------------

--
-- Structure de la table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `symbol` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `units`
--

INSERT INTO `units` (`id`, `name`, `symbol`) VALUES
(1, 'kilogramme', 'kg'),
(2, 'litre', 'L'),
(3, 'à la pièce', 'pièce'),
(4, 'Barquette', 'barquette');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone_number` varchar(20) DEFAULT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `billing_address_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `delivery_address_id` (`delivery_address_id`),
  KEY `billing_address_id` (`billing_address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `avatar`, `first_name`, `last_name`, `created_date`, `phone_number`, `delivery_address_id`, `billing_address_id`, `is_admin`) VALUES
(2, 'gmifat@gmail.com', '$2y$10$i7IeOgRxQSic8c7FuqafJOIh55uc5na//2M1hrzKzOusNcQGVSccm', NULL, 'fatma', 'gmiden', '2020-06-20 11:03:01', '0787947398', 9, 10, 1),
(3, 'gmifat@gmail.com', '$2y$10$jEEFxlEPA2PG3u7RtxTRIuzNnNkxOMKVYss6qg/9S3kZ0JZvMXRou', NULL, 'fatma', 'gmiden', '2020-06-20 12:46:42', '', NULL, NULL, 1),
(4, 'fgmiden@gmail.com', '$2y$10$LIuUg2OlA3I.vgTvQHAj1ufsNDrg1GC8uAzboE5HNGI0PZzZ/htVS', NULL, 'fatma', 'Gmiden', '2020-06-20 12:54:14', NULL, NULL, NULL, 0),
(5, 'gmi@gmail.com', '$2y$10$2LEWprBa7FNE1A/a6sOgBeiXSNIui44IxFF0DA4.2sD4RV60Z8se6', NULL, 'fa', 'gm', '2020-06-20 22:36:05', NULL, NULL, NULL, 0),
(6, 'za@gmail.com', '$2y$10$6GjqAeSrTBPVgJVh/cAGxOF6N4yCrw.NtxPQLmVPYBm4SMPOo.d6O', NULL, 'ft', 'gd', '2020-06-20 22:38:07', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_reviews`
--

DROP TABLE IF EXISTS `user_reviews`;
CREATE TABLE IF NOT EXISTS `user_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `review` text NOT NULL,
  `datetime` timestamp NOT NULL,
  `is_validated` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `favored_products`
--
ALTER TABLE `favored_products`
  ADD CONSTRAINT `favored_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favored_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`delivery_address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`billing_address_id`) REFERENCES `addresses` (`id`);

--
-- Contraintes pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`origin_id`) REFERENCES `origins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_ibfk_5` FOREIGN KEY (`discount_type_id`) REFERENCES `discount_types` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `product_recipes`
--
ALTER TABLE `product_recipes`
  ADD CONSTRAINT `product_recipes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_recipes_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- Contraintes pour la table `similar_products`
--
ALTER TABLE `similar_products`
  ADD CONSTRAINT `similar_products_ibfk_1` FOREIGN KEY (`product_id1`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `similar_products_ibfk_2` FOREIGN KEY (`product_id2`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`delivery_address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`billing_address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD CONSTRAINT `user_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
