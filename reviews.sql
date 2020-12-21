-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 déc. 2020 à 06:45
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
-- Base de données : `reviews`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_product` int(11) DEFAULT NULL,
  `id_author` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_520_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `editedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_author` (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `code_product`, `id_author`, `content`, `createdAt`, `editedAt`) VALUES
(18, 15, 1, 'testttt', '2020-12-16 18:48:05', NULL),
(20, 2, 1, 'anais', '2020-12-16 19:06:57', NULL),
(50, 1, 1, 'essai', '2020-12-17 09:54:44', NULL),
(51, 2, 3, 'Joli t shirt!', '2020-12-18 12:14:32', NULL),
(52, 1, 3, 'test de l\'affichage\r\n', '2020-12-19 12:05:16', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(1, 'aaa', 'aaa@aaa', '$2y$10$PZ9cJBDWanE6qIYeYahlHORp1PAEgly.7nwFw5.kKbvUFOyjvTjIC'),
(2, 'bbb', 'bbb@bbb', '$2y$10$ek8Fgo0oxkWiMnnW9keAouHi33rRWdXGNdprnzWgyJd.JF.Pr1wTi'),
(3, 'anais', 'anais@anais', '$2y$10$FW7WSF8ZoMLxlztdp3fg4.havVAI9v1mYNY/ISEy.ZTV3yMlrpUfK'),
(4, 'bobo', 'bobo@bobo', '$2y$10$at/X/URx3Ocj4gWqgHiPWu4m49vDVzaH.IqkVQkJjuTaMHrGCW1u.');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
