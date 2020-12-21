-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 déc. 2020 à 06:48
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blissim`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Box', 'Découvrez nos box'),
(2, 'Noël', 'Découvrez nos produits spécial Noël'),
(3, 'Maquillage', 'Sélection maquillage');

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `firstName`, `lastName`, `email`) VALUES
(1, 'Aaaaa', 'Aaaaaa', 'aaa@aaa'),
(2, 'Bbb', 'Bbbbb', 'bbb@bbb'),
(3, 'Ccc', 'Cccc', 'ccc@ccc'),
(4, 'Ddd', 'Dddd', 'ddd@ddd');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderDate` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalPrice` float NOT NULL,
  `id_customer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_customer` (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `orderDate`, `status`, `totalPrice`, `id_customer`) VALUES
(1, '2020-12-11 12:46:38', 'shipped', 50, 1),
(2, '2020-12-11 12:46:38', 'confirmed', 50, 2),
(3, '2020-12-11 13:12:44', 'confirmed', 25, 4),
(4, '2020-12-20 11:25:28', 'confirmed', 222, 1);

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `priceEach` float NOT NULL,
  `quantityOrdered` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_order` (`id_order`),
  KEY `id_product` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_details`
--

INSERT INTO `order_details` (`id`, `id_order`, `id_product`, `priceEach`, `quantityOrdered`) VALUES
(1, 2, 3, 13.9, 3),
(2, 1, 2, 16, 1),
(3, 4, 6, 25, 2);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `createdAt` datetime NOT NULL,
  `priceHt` float NOT NULL,
  `stockQuantity` int(11) DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `id_category`, `name`, `description`, `createdAt`, `priceHt`, `stockQuantity`, `img`) VALUES
(1, 3, 'Gloss embellisseur lèvres', 'Le gloss embellisseur Bloomy illumine à merveille vos lèvres et leur apporte de la brillance comme personne. On adore sa formule vegan à 85% d’origine naturelle pour des lèvres glamours sans risque pour votre santé.\r\nLe secret : une composition enrichie en huile de graines de ricin et d’argan pour une bouche fraîche et hydratée.', '2020-12-11 12:20:08', 14.9, 200, ''),
(2, 3, 'Pinceau applicateur de masque', 'Véritable outil d’institut, le pinceau masque Bachca est indispensable pour appliquer facilement et rapidement les masques de soin et les gommages. Grâce à sa spatule en silicone, l’application est homogène et précise, sans gaspillage et sans produits sur les doigts.', '2020-12-11 12:20:08', 16, 200, ''),
(3, 1, 'La box de décembre', 'En décembre, place à une merveilleuse histoire beauté et au mois le plus festif de l’année… 5 miniatures beauté se nichent dans une trousse assortie à votre sapin.', '2020-12-11 12:25:34', 13.9, 500, ''),
(4, 1, 'La box de janvier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2020-12-11 12:25:34', 13.9, 500, ''),
(5, 2, 'Coffret The Ritual of Ayurveda M', 'Offrez une expérience unique à un proche ou à vous même. Rééquilibrez votre corps, votre âme et votre esprit avec The Ritual of Ayurveda et ses produits à la délicate senteur de roses indienne et d’huile d’amande douce.\r\n\r\nLe coffret The Ritual of Ayurveda Taille M se compose de :\r\n– Un Gommage pour le corps 125 ml\r\n– Une Mousse de douche 200 ml\r\n– Une Crème corps 70 ml\r\n– Une Gel lavant pour les mains 300 ml', '2020-12-11 12:27:48', 29.9, 60, ''),
(6, 2, 'PRODUCT_1', 'Test ', '2020-12-11 13:11:53', 25, 9, '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);

--
-- Contraintes pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
