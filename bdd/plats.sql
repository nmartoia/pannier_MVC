-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 02 fév. 2023 à 15:33
-- Version du serveur : 8.0.27
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `plats`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `IDCATEGORIE` varchar(13) NOT NULL,
  `NOMCATEGORIE` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDCATEGORIE`)
) ;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`IDCATEGORIE`, `NOMCATEGORIE`) VALUES
('61b76bccdadb9', 'Dessert');

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

DROP TABLE IF EXISTS `commander`;
CREATE TABLE IF NOT EXISTS `commander` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDUSER` varchar(13) NOT NULL,
  `QUANTITE` int DEFAULT NULL,
  `IDCOMMANDE` varchar(13) NOT NULL,
  `DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDCOMMANDE`,`IDPRODUIT`,`IDUSER`),
  KEY `FK_COMMANDER` (`IDUSER`),
  KEY `FK_COMMANDER2` (`IDPRODUIT`)
) ;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDINGREDIENT` varchar(13) NOT NULL,
  PRIMARY KEY (`IDPRODUIT`,`IDINGREDIENT`),
  KEY `FK_CONTENIR` (`IDINGREDIENT`)
) ;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`IDPRODUIT`, `IDINGREDIENT`) VALUES
('61b76b209165f', '61b764a891306'),
('61b76b209165f', '61b89019a63fd'),
('61b894616d2b4', '61b89019a63fd');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `IDINGREDIENT` varchar(13) NOT NULL,
  `NOMINGREDIENT` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDINGREDIENT`)
) ;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`IDINGREDIENT`, `NOMINGREDIENT`) VALUES
('61b764a891306', 'Ananas'),
('61b89019a63fd', 'Fraise');

-- --------------------------------------------------------

--
-- Structure de la table `origine`
--

DROP TABLE IF EXISTS `origine`;
CREATE TABLE IF NOT EXISTS `origine` (
  `IDORIGINE` varchar(13) NOT NULL,
  `NOMORIGINE` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDORIGINE`)
) ;

--
-- Déchargement des données de la table `origine`
--

INSERT INTO `origine` (`IDORIGINE`, `NOMORIGINE`) VALUES
('61b764c4059af', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDTYPE` varchar(13) NOT NULL,
  `IDCATEGORIE` varchar(13) NOT NULL,
  `IDORIGINE` varchar(13) NOT NULL,
  `NOMPRODUIT` varchar(30) DEFAULT NULL,
  `PRIXPRODUIT` float DEFAULT NULL,
  `POIDSPRODUIT` int DEFAULT NULL,
  PRIMARY KEY (`IDPRODUIT`),
  KEY `FK_ETRE_DE_CATEGORIE` (`IDCATEGORIE`),
  KEY `FK_ETRE_DE_TYPE` (`IDTYPE`),
  KEY `FK_VENIR_DE` (`IDORIGINE`)
) ;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`IDPRODUIT`, `IDTYPE`, `IDCATEGORIE`, `IDORIGINE`, `NOMPRODUIT`, `PRIXPRODUIT`, `POIDSPRODUIT`) VALUES
('61b76b209165f', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'Tarte aux pommes', 5.5, 200),
('61b894616d2b4', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'Tarte à la fraise', 8, 500);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `IDTYPE` varchar(13) NOT NULL,
  `NOMTYPE` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDTYPE`)
) ;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`IDTYPE`, `NOMTYPE`) VALUES
('61b76c36ee798', 'Végétarien');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(13) NOT NULL,
  `code_client` varchar(6) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `permissions` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `code_client`, `password`, `permissions`) VALUES
('620d0682cc9ea', '123456', '$2y$10$zqK8nCC.bLQoxBN/jnoXqOIMOSr8JvxWuBQLqdc9zi6Mz9mY.EoZy', 1),
('620d069dbefe6', '654321', '$2y$10$QZn0QzE.FxbMu6aXpUByiuyZ6.NqeVFYPecpxZEt3uQMOeZXyS1sG', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commander`
--
ALTER TABLE `commander`
  ADD CONSTRAINT `FK_COMMANDER` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_COMMANDER2` FOREIGN KEY (`IDPRODUIT`) REFERENCES `produit` (`IDPRODUIT`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`IDINGREDIENT`) REFERENCES `ingredients` (`IDINGREDIENT`),
  ADD CONSTRAINT `FK_CONTENIR2` FOREIGN KEY (`IDPRODUIT`) REFERENCES `produit` (`IDPRODUIT`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_ETRE_DE_CATEGORIE` FOREIGN KEY (`IDCATEGORIE`) REFERENCES `categorie` (`IDCATEGORIE`),
  ADD CONSTRAINT `FK_ETRE_DE_TYPE` FOREIGN KEY (`IDTYPE`) REFERENCES `type` (`IDTYPE`),
  ADD CONSTRAINT `FK_VENIR_DE` FOREIGN KEY (`IDORIGINE`) REFERENCES `origine` (`IDORIGINE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;