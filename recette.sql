-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 14 avr. 2023 à 14:30
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
(1, 'Tomate', 'https://th.bing.com/th/id/R.1165da0bd4e806763b1a3df49b87b0e7?rik=kXX66GnU7QLhwg&pid=ImgRaw&r=0'),
(2, 'Oignon ', 'https://www.roseedeschamps.fr/wp-content/uploads/2019/01/oignon-jaune.jpg'),
(3, 'Ail', 'https://img-3.journaldesfemmes.fr/Hi8QypZxkq2-fKCiH3-psDvtJgU=/910x607/smart/0a35cb5fd4db437e97449e2d13204e07/ccmcms-jdf/10663490.jpg'),
(4, 'Carotte ', 'https://th.bing.com/th/id/R.68bcfe76c2aa0824c768433e42baf37d?rik=kacwj1kfTcHkag&riu=http%3a%2f%2fprd2-bone-image.s3-website-eu-west-1.amazonaws.com%2fCAC%2fvar%2fcui%2fstorage%2fimages%2feditos%2fcarotte%2f1117808-1-fre-FR%2fcarotte.jpg&ehk=Cd4Wd%2bxORUGc'),
(5, 'Courgette', 'https://th.bing.com/th/id/R.b7662305c801dc0646d157a6e48cae39?rik=4VkmYVsoV1vG7g&riu=http%3a%2f%2fwww.laurentmariotte.com%2fwp-content%2fuploads%2f2016%2f07%2fcourgettes.jpg&ehk=1VyIi1Ug03VFOxiNQrKduVGsoBR11cUmFqKlxY1d7zw%3d&risl=&pid=ImgRaw&r=0'),
(6, 'Pois chiches ', 'https://www.nutreatif.fr/wp-content/uploads/2016/11/pois-chiche.jpg'),
(7, 'Pomme de terre ', 'https://th.bing.com/th/id/OIP.XPLHhMVvOPb0qhm7_yjtVAHaFj?pid=ImgDet&rs=1'),
(8, 'Camembert ', 'https://th.bing.com/th/id/R.4e1dd81b0be99c93e5ad11e27f1a7c88?rik=6q96UUF9f2Ki6A&pid=ImgRaw&r=0'),
(9, 'Chocolat', 'https://i.enfant.com/1800x0/smart/2019/11/26/1401-chocolat.jpg'),
(10, 'Oeuf', 'https://th.bing.com/th/id/R.0db94afd3a3493625ad120bde2728ca0?rik=2pevnTIJZOjUZw&riu=http%3a%2f%2fimages.monmenu.fr%2fimages%2f413ac1be06c32fb5539b304a227a393f0c6744cfcf12047e_full.jpg&ehk=0xl6Z%2fZmASSl47fHPnlLtts4rnr7wFa2TD2w1fvONxE%3d&risl=&pid=ImgRaw&r'),
(11, 'Coriandre ', 'https://th.bing.com/th/id/R.dd5333e13422e96a14beda577a8a97fc?rik=6w%2bsWW3LQGesIQ&pid=ImgRaw&r=0'),
(12, 'Farine ', 'https://th.bing.com/th/id/OIP.VcetNSw5vlAE3za10xUK2wHaHa?pid=ImgDet&rs=1'),
(13, 'Semoule ', 'https://img-3.journaldesfemmes.fr/oYErIcRrBEGiPX8loFzd9Zd_zEE=/1500x/smart/96361f4fa44848dd99aa2e7d17da76fe/ccmcms-jdf/19007072.jpg'),
(14, 'Fromage ', 'https://fac.img.pmdstatic.net/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2FFAC.2F2019.2F09.2F23.2Fb84ccbc3-8b18-4f61-826d-c6d1a7f5fe03.2Ejpeg/900x600/quality/65/2-gruyere.jpg'),
(15, 'Lait Concentré', 'https://www.cerfdellier.com/24477-large_default/lait-concentre-sucre-nestle-397-g.jpg');

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
(1, 'Couscous ', 'Le couscous, c\'est la recette marocaine culte, c\'est le délice oriental par excellence, c\'est le soleil dans l\'assiette, c\'est le bonheur bon comme là-bas.', 'Plats', 'https://th.bing.com/th/id/R.ad62897863908181ce541769fef665b0?rik=sKyA%2finfomn%2bHQ&pid=ImgRaw&r=0'),
(2, 'Soupe (Harira) ', 'La Harira est une soupe traditionnelle Algérienne spécifique de l’ouest D’Algérie, Oran, Mostaganem, Tlemcen, Chlef…, elle est préparée habituellement courant le mois sacré du ramadan pour la rupture du jeûne', 'Plats', 'https://www.auxdelicesdupalais.net/wp-content/uploads/2020/05/harira-alg%C3%A9rienne1.jpg'),
(3, 'Pizza au camembert ', 'Vous êtes amateurs de fromage ? Cette recette de pizza au Camembert va vous plaire. Avec son fromage et sa garniture fondante, sa pâte croustillante, c’est un vrai régal.', 'Plats ', 'https://img.cuisineaz.com/660x660/2018/07/09/i140879-pizza-au-camembert.webp'),
(4, 'Mousse au chocolat ', 'On l’aime tous cette petite douceur de n’importe quelle heure, cette gourmandise qui n’est pas que pour les enfants. Parfois trop ferme, parfois trop légère mais rarement comme il le faut à mon goût.', 'Desserts ', 'https://img.cuisineaz.com/660x660/2018/03/15/i136305-.webp'),
(5, 'Omelette au fromage ', 'Un plaisir simple qui fait toujours son petit effet : l\'omelette au fromage. Tellement bonne, tellement savoureuse, on en raffole', 'Entrée ', 'https://img.cuisineaz.com/660x660/2015/03/31/i76910-omelette-au-fromage.webp');

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
