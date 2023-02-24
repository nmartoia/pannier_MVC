-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 10 fév. 2023 à 09:35
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

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

CREATE TABLE `categorie` (
  `IDCATEGORIE` varchar(13) NOT NULL,
  `NOMCATEGORIE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`IDCATEGORIE`, `NOMCATEGORIE`) VALUES
('61b76bccdadb9', 'Dessert'),
('63e4f3438d1b1', 'Entrée');

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

CREATE TABLE `commander` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDUSER` varchar(13) NOT NULL,
  `QUANTITE` int(11) DEFAULT NULL,
  `IDCOMMANDE` varchar(13) NOT NULL,
  `DATE` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commander`
--

INSERT INTO `commander` (`IDPRODUIT`, `IDUSER`, `QUANTITE`, `IDCOMMANDE`, `DATE`) VALUES
('61b76b209165f', '63dfec9656f8e', 1, '63e269d329253', '2023-02-07 16:10:58'),
('61b76b209165f', '63dfec9656f8e', 2, '63e269d432f32', '2023-02-07 16:10:58'),
('61b76b209165f', '63dfec9656f8e', 3, '63e269d52e6d6', '2023-02-07 16:10:58'),
('61b76b209165f', '63dfec9656f8e', 4, '63e269d6aae86', '2023-02-07 16:10:58'),
('61b76b209165f', '63dfec9656f8e', 1, '63e38e88ad0e4', '2023-02-08 13:28:57'),
('61b76b209165f', '63dfec9656f8e', 2, '63e38f6b3f43c', '2023-02-08 13:28:57'),
('61b76b209165f', '63dfec9656f8e', 2, '63e395876ab21', '2023-02-08 13:28:57'),
('61b894616d2b4', '63dfec9656f8e', 2, '63e3992cdb48a', '2023-02-08 13:44:33'),
('63e4b2b037f03', '63dfec9656f8e', 1, '63e4b50f473ca', '2023-02-09 09:55:50'),
('61b76b209165f', '63dfec9656f8e', 1, '63e4b64a59b3b', '2023-02-09 10:01:05'),
('63e4b2b037f03', '63dfec9656f8e', 6, '63e4bde98aa09', '2023-02-09 10:33:46'),
('61b76b209165f', '63dfec9656f8e', 2, '63e4e3d6a2d2b', '2023-02-09 13:15:21'),
('63e4b2b037f03', '63dfec9656f8e', 4, '63e4fc60de931', '2023-02-09 15:45:58'),
('63e4f1a8e8bfb', '63dfec9656f8e', 2, '63e4fed47a90e', '2023-02-09 15:45:58'),
('63e4f3ee03c64', '63dfec9656f8e', 2, '63e5071fa7cff', '2023-02-09 15:45:58'),
('63e50a8d5246d', '63dfec9656f8e', 3, '63e50a99b8d18', '2023-02-09 16:00:44'),
('61b76b209165f', '63dfec9656f8e', 1, '63e5fc8a29251', '2023-02-10 09:30:57'),
('63e6018717f1d', '63dfec9656f8e', 2, '63e601c41e5f2', '2023-02-10 09:35:19');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDINGREDIENT` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`IDPRODUIT`, `IDINGREDIENT`) VALUES
('61b76b209165f', '61b764a891306'),
('61b894616d2b4', '61b89019a63fd'),
('63e4b2b037f03', '63e4b3ae3ed63'),
('63e4f1a8e8bfb', '63e4b3ae3ed63'),
('63e4f38e5d346', '63e4ca55e2f74'),
('63e4f3ee03c64', '61b764a891306'),
('63e4f3ee03c64', '63e4b3ae3ed63'),
('63e50a8d5246d', '63e4c6205496f'),
('63e50a8d5246d', '63e50a7962716'),
('63e6018717f1d', '63e60156e90c5');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `IDINGREDIENT` varchar(13) NOT NULL,
  `NOMINGREDIENT` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`IDINGREDIENT`, `NOMINGREDIENT`) VALUES
('61b764a891306', 'pomme'),
('61b89019a63fd', 'Fraise'),
('63e4b3ae3ed63', 'chocolat'),
('63e4bb7386a68', 'Vanille'),
('63e4c607cef9d', 'pistache'),
('63e4c6205496f', 'chocolat au lait'),
('63e4ca55e2f74', 'steak'),
('63e4eda111ad1', 'menthe'),
('63e50a7962716', 'cacahuete'),
('63e60156e90c5', 'du code parfait');

-- --------------------------------------------------------

--
-- Structure de la table `origine`
--

CREATE TABLE `origine` (
  `IDORIGINE` varchar(13) NOT NULL,
  `NOMORIGINE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `origine`
--

INSERT INTO `origine` (`IDORIGINE`, `NOMORIGINE`) VALUES
('61b764c4059af', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDUSER` varchar(13) NOT NULL,
  `QUANTITE` int(11) DEFAULT NULL,
  `IDCOMMANDE` varchar(13) NOT NULL,
  `DATE` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`IDPRODUIT`, `IDUSER`, `QUANTITE`, `IDCOMMANDE`, `DATE`) VALUES
('61b76b209165f', '63e38ea25f89e', 2, '63e38f8f7bcdb', '2023-02-08 13:03:27'),
('61b76b209165f', '63e390ca8a31d', 2, '63e390de8104a', '2023-02-08 13:09:02');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `IDPRODUIT` varchar(13) NOT NULL,
  `IDTYPE` varchar(13) NOT NULL,
  `IDCATEGORIE` varchar(13) NOT NULL,
  `IDORIGINE` varchar(13) NOT NULL,
  `NOMPRODUIT` varchar(30) DEFAULT NULL,
  `PRIXPRODUIT` float DEFAULT NULL,
  `POIDSPRODUIT` int(11) DEFAULT NULL,
  `EXT` varchar(11) NOT NULL,
  `uniteDePoids` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`IDPRODUIT`, `IDTYPE`, `IDCATEGORIE`, `IDORIGINE`, `NOMPRODUIT`, `PRIXPRODUIT`, `POIDSPRODUIT`, `EXT`, `uniteDePoids`) VALUES
('61b76b209165f', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'Tarte aux pommes', 5.5, 200, 'png', 'g'),
('61b894616d2b4', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'Tarte à la fraise', 8, 500, 'png', 'g'),
('63e4b2b037f03', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'gateau au chocolat', 5, 100, 'png', 'g'),
('63e4f1a8e8bfb', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'Pain au chocolat', 1, 60, 'png', 'g'),
('63e4f38e5d346', '63e4f367d5705', '63e4f3438d1b1', '61b764c4059af', 'steak', 10, 1, 'png', 'kg'),
('63e4f3ee03c64', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'pomme d\'amour au chocolat', 5, 300, 'jpg', 'g'),
('63e50a8d5246d', '61b76c36ee798', '61b76bccdadb9', '61b764c4059af', 'm&m', 7.5, 1, 'webp', 'kg'),
('63e6018717f1d', '63e4f367d5705', '61b76bccdadb9', '61b764c4059af', 'un codeur qui sait quoi faire', 100000, 90, 'jpg', 'kg');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `IDTYPE` varchar(13) NOT NULL,
  `NOMTYPE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`IDTYPE`, `NOMTYPE`) VALUES
('61b76c36ee798', 'Végétarien'),
('63e4f367d5705', 'Normal');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` varchar(13) NOT NULL,
  `code_client` varchar(6) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `permissions` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `code_client`, `password`, `permissions`) VALUES
('620d0682cc9ea', '123456', '$2y$10$zqK8nCC.bLQoxBN/jnoXqOIMOSr8JvxWuBQLqdc9zi6Mz9mY.EoZy', 1),
('620d069dbefe6', '654321', '$2y$10$QZn0QzE.FxbMu6aXpUByiuyZ6.NqeVFYPecpxZEt3uQMOeZXyS1sG', 0),
('63dfec9656f8e', '999999', '$2y$10$O.ctC.5LyIVnydViqoyIfei7QR4KYl3gdINqxHKs5pvj.5e6iuTw2', 1),
('63e38ea25f89e', '123564', '$2y$10$vF/./J8RRYcVEqZXRDj1xOm/S1VtHe460X7EXqWlvM908Xh9Pvi76', 0),
('63e38fa7075a1', '787878', '$2y$10$A1SOmClOrAPLAan9fCuTe.SpMKKSvZJ98NjQKZKc5wRnCHjBd4FYe', 0),
('63e390ca8a31d', '555555', '$2y$10$TmzkBf8b9/2rx25.dkDmZ.twiartTf6wUCLC/BTy4ZzJs6RRjqlxe', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`IDCATEGORIE`);

--
-- Index pour la table `commander`
--
ALTER TABLE `commander`
  ADD PRIMARY KEY (`IDCOMMANDE`,`IDPRODUIT`,`IDUSER`),
  ADD KEY `FK_COMMANDER` (`IDUSER`),
  ADD KEY `FK_COMMANDER2` (`IDPRODUIT`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`IDPRODUIT`,`IDINGREDIENT`),
  ADD KEY `FK_CONTENIR` (`IDINGREDIENT`);

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`IDINGREDIENT`);

--
-- Index pour la table `origine`
--
ALTER TABLE `origine`
  ADD PRIMARY KEY (`IDORIGINE`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`IDUSER`,`IDPRODUIT`,`IDCOMMANDE`) USING BTREE,
  ADD KEY `IDUSER` (`IDUSER`),
  ADD KEY `IDPRODUIT` (`IDPRODUIT`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`IDPRODUIT`),
  ADD KEY `FK_ETRE_DE_CATEGORIE` (`IDCATEGORIE`),
  ADD KEY `FK_ETRE_DE_TYPE` (`IDTYPE`),
  ADD KEY `FK_VENIR_DE` (`IDORIGINE`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`IDTYPE`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`IDPRODUIT`) REFERENCES `produit` (`IDPRODUIT`);

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
