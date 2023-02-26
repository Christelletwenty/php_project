-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 26 fév. 2023 à 10:53
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `my_website`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(9, 'user', '$2y$10$8hNzyjQDMJSnftizNJV8WuhRvmnyP1rPEjitPX0EYcsPPD62MEswm'),
(10, 'admin', '$2y$10$HeRn/k312bGUf.eo5Gc3PeEMF3dlhfgMhLd05qZLn7pyaskqAMpJ.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Base de données :  `my_website`
--

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `name`, `description`) VALUES
(1, 'The last of us ', "Le titre se déroule dans un univers post-apocalyptique après une pandémie provoquée par un champignon, le cordyceps, qui prend le contrôle de ses hôtes humains. Les deux personnages principaux se nomment Joel et Ellie et doivent survivre ensemble alors qu\'ils traversent les États-Unis en ruines."),
(2, 'Hogwarts Legacy', "Hogwarts Legacy : L'Héritage de Poudlard est un jeu de rôle et d'action-aventure en monde ouvert situé dans le monde des sorciers des années 1800, qui place les joueurs au cœur de leur propre aventure."),
(3, 'Outlast', "Outlast est un jeu vidéo d'horreur dans lequel le joueur ne dispose que d'une caméra et n'a pas la possibilité de se défendre ou d'attaquer ses agresseurs. Il est donc contraint de courir ou de se cacher pour survivre. Il peut se dissimuler dans des casiers ou sous des lits."),
(4, 'Sims', "Les Sims est une série de jeux vidéo de simulation de vie de type bac à sable, développée par Maxis et édité par Electronic Arts."),
(5, 'Super Mario Galaxy', "L'histoire de Super Mario Galaxy est centrée la quête de Mario et pour délivrer la princesse Peach, kidnappée par le maléfique. Bowser le jeu est composé de nombreux niveaux correspondants à des galaxies constituées de plusieurs petites planètes, et la gravité est un élément essentiel du gameplay."),
(6, 'Zelda Breath of the Wild', "Breath of the Wild est un jeu d'action-aventure se déroulant dans un monde ouvert médiéval-fantastique centré sur l'exploration, la résolution d'énigmes et les combats en temps réel, à l'instar du premier opus, The Legend of Zelda. Le joueur contrôle Link, qui doit parcourir le royaume d'Hyrule."),
(7, 'LABYRINTHINE', "Labyrinthine est un jeu d'horreur coopératif qui pourrait bien vous pousser à ne plus jamais mettre les pieds dans un labyrinthe de haies.");
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Base de données :  `my_website`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `gameId`, `userId`, `note`, `text`) VALUES
(1, 1, 9, 5, 'Super expérience'),
(2, 1, 10, 2, "Je suis content d'avoir testé ce jeu"),
(3, 1, 9, 5, 'ce jeux était incroyable, longue durée de vie');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
