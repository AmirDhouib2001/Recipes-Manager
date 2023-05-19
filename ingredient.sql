-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 19 mai 2023 à 10:00
-- Version du serveur : 8.0.32
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `idIngredient` int NOT NULL AUTO_INCREMENT,
  `name_ingredient` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `imgsrc` varchar(255) ,
  PRIMARY KEY (`idIngredient`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`idIngredient`, `name_ingredient`, `imgsrc`) VALUES
(1, 'Tomate', 'Tomate'),
(2, 'Oignon ', 'Oignon'),
(3, 'Ail', 'Ail'),
(4, 'Carotte ', 'Carotte'),
(5, 'Courgette', 'Courgette'),
(6, 'Pois chiches ', 'Poischiches'),
(7, 'Pomme de terre ', 'Pommedeterre'),
(8, 'Camembert ', 'Camembert'),
(9, 'Chocolat', 'Chocolat'),
(10, 'Oeuf', 'Oeuf'),
(11, 'Coriandre ', 'Coriandre'),
(12, 'Farine ', 'Farine'),
(13, 'Semoule ', 'Semoule'),
(14, 'Fromage ', 'Fromage'),
(15, 'Lait Concentré', 'LaitConcentré');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
