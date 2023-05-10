-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 10 mai 2023 à 11:57
-- Version du serveur : 8.0.31
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
  `imgsrc` varchar(255) NOT NULL,
  PRIMARY KEY (`idIngredient`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`idIngredient`, `name_ingredient`, `imgsrc`) VALUES
(1, 'Tomate', 'Tomate.jpeg'),
(2, 'Oignon ', 'Oignon.jpg'),
(3, 'Ail', 'Ail.webp'),
(4, 'Carotte ', 'Carotte.jpg'),
(5, 'Courgette', 'Courgette.jpeg'),
(6, 'Pois chiches ', 'Poischiches.jpeg'),
(7, 'Pomme de terre ', 'Pommedeterre.jpeg'),
(8, 'Camembert ', 'Camembert.jpeg'),
(9, 'Chocolat', 'Chocolat.webp'),
(10, 'Oeuf', 'Oeuf.webp'),
(11, 'Coriandre ', 'Coriandre.jpeg'),
(12, 'Farine ', 'Farine.jpeg'),
(13, 'Semoule ', 'Semoule.webp'),
(14, 'Fromage ', 'Fromage.jpg'),
(15, 'Lait Concentré', 'LaitConcentré.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `listeingredient`
--

DROP TABLE IF EXISTS `listeingredient`;
CREATE TABLE IF NOT EXISTS `listeingredient` (
  `idRecette` int NOT NULL,
  `idIngredient` int NOT NULL,
  KEY `fk_nom_recette` (`idRecette`),
  KEY `fk_nom_ingredient` (`idIngredient`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `listeingredient`
--

INSERT INTO `listeingredient` (`idRecette`, `idIngredient`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 13),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 11),
(3, 1),
(3, 8),
(3, 12),
(3, 14),
(4, 10),
(4, 15),
(4, 9),
(5, 10),
(5, 14);

-- --------------------------------------------------------

--
-- Structure de la table `listetags`
--

DROP TABLE IF EXISTS `listetags`;
CREATE TABLE IF NOT EXISTS `listetags` (
  `idRecette` int NOT NULL,
  `idTag` int NOT NULL,
  KEY `fk_nom_recette` (`idRecette`),
  KEY `fk_nom_tag` (`idTag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `listetags`
--

INSERT INTO `listetags` (`idRecette`, `idTag`) VALUES
(1, 1),
(1, 3),
(1, 5),
(2, 1),
(2, 3),
(2, 5),
(3, 1),
(3, 3),
(3, 7),
(4, 2),
(4, 6),
(4, 4),
(5, 1),
(5, 7),
(5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `idRecette` int NOT NULL AUTO_INCREMENT,
  `name_recette` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) NOT NULL,
  `catégorie` varchar(255) NOT NULL,
  `Imgsrc` varchar(255) NOT NULL,
  PRIMARY KEY (`idRecette`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`idRecette`, `name_recette`, `description`, `catégorie`, `Imgsrc`) VALUES
(1, 'Couscous ', 'Le couscous, c\'est la recette marocaine culte, c\'est le délice oriental par excellence, c\'est le soleil dans l\'assiette, c\'est le bonheur bon comme là-bas.', 'Plats', 'couscous.png'),
(2, 'Soupe (Harira) ', 'La Harira est une soupe traditionnelle Algérienne spécifique de l’ouest D’Algérie, Oran, Mostaganem, Tlemcen, Chlef…, elle est préparée habituellement courant le mois sacré du ramadan pour la rupture du jeûne', 'Plats', 'soupe.jpg'),
(3, 'Pizza au camembert ', 'Vous êtes amateurs de fromage ? Cette recette de pizza au Camembert va vous plaire. Avec son fromage et sa garniture fondante, sa pâte croustillante, c’est un vrai régal.', 'Plats ', 'pizza.webp'),
(4, 'Mousse au chocolat ', 'On l’aime tous cette petite douceur de n’importe quelle heure, cette gourmandise qui n’est pas que pour les enfants. Parfois trop ferme, parfois trop légère mais rarement comme il le faut à mon goût.', 'Desserts ', 'mousse.webp'),
(5, 'Omelette au fromage ', 'Un plaisir simple qui fait toujours son petit effet : l\'omelette au fromage. Tellement bonne, tellement savoureuse, on en raffole', 'Entrée ', 'omelette.webp');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `idTag` int NOT NULL AUTO_INCREMENT,
  `nomTag` varchar(255) NOT NULL,
  PRIMARY KEY (`idTag`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`idTag`, `nomTag`) VALUES
(1, 'Chaud '),
(2, 'Froid'),
(3, 'Salé '),
(4, 'Sucré '),
(5, 'plat de résistance '),
(6, 'Dessert'),
(7, 'entrée');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresse_mail` varchar(255) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `adresse_mail`) VALUES
(1, 'Zwitaadmin', 'ZwitaZouina1', 'zwitaa03@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
