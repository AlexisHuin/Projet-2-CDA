-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 18 oct. 2023 à 18:37
-- Version du serveur : 11.1.2-MariaDB-1:11.1.2+maria~ubu2204
-- Version de PHP : 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `coop-consommateur`
--

-- --------------------------------------------------------

--
-- Structure de la table `Adherents`
--

CREATE TABLE `Adherents` (
  `IdAdherents` int(11) NOT NULL,
  `NomPrenomAdherents` varchar(50) NOT NULL,
  `PhoneAdherents` varchar(13) NOT NULL,
  `MailAdherents` varchar(128) NOT NULL,
  `CodePostalAdherents` int(5) NOT NULL,
  `CoordonneesGPSAdherents` varchar(255) NOT NULL,
  `DateDebutAdherents` date NOT NULL,
  `DateFinAdherents` date DEFAULT NULL,
  `DepenseAdherents` decimal(15,3) NOT NULL DEFAULT 0.000,
  `EtatAbonnementAdherent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Adherents`
--

INSERT INTO `Adherents` (`IdAdherents`, `NomPrenomAdherents`, `PhoneAdherents`, `MailAdherents`, `CodePostalAdherents`, `CoordonneesGPSAdherents`, `DateDebutAdherents`, `DateFinAdherents`, `DepenseAdherents`, `EtatAbonnementAdherent`) VALUES
(8, 'Bon DEULLE', '771201703', 'enfreinmickael42@gmail.com', 41110, '8435394638', '2023-09-28', NULL, 0.000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `IdAdmin` int(11) NOT NULL,
  `UsernameAdmin` varchar(25) NOT NULL,
  `MdpAdmin` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Admin`
--

INSERT INTO `Admin` (`IdAdmin`, `UsernameAdmin`, `MdpAdmin`) VALUES
(2, 'zab', '$argon2id$v=19$m=65536,t=4,p=1$Mk1lM2hCVkR6b0RqNU9QaQ$K2b9zhdKs5+jTZ7E8ah7hzy4az4H3sg+g7lTtRHmbsg'),
(3, 'zabzab', '$argon2id$v=19$m=65536,t=4,p=1$TEs0Nmd0L1hJdWwwMENVMg$hKO6MNuvVeu66qDG06nC+rW7lQe9Njx7H8r4PKcASuw');

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `IdCategorie` int(11) NOT NULL,
  `DesignationCategorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`IdCategorie`, `DesignationCategorie`) VALUES
(1, 'Fruit'),
(2, 'Legume'),
(3, 'Fruit Exotique');

-- --------------------------------------------------------

--
-- Structure de la table `Commandes`
--

CREATE TABLE `Commandes` (
  `IdCommande` int(11) NOT NULL,
  `DateCommande` date NOT NULL,
  `DescriptionCommande` varchar(1028) NOT NULL,
  `IdAdherentsCommandes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ModeReglement`
--

CREATE TABLE `ModeReglement` (
  `IdModeReglement` int(11) NOT NULL,
  `DesignationModeReglement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ModeReglement`
--

INSERT INTO `ModeReglement` (`IdModeReglement`, `DesignationModeReglement`) VALUES
(1, 'Carte Bancaire'),
(2, 'Paypal'),
(3, 'ApplePay');

-- --------------------------------------------------------

--
-- Structure de la table `Panier`
--

CREATE TABLE `Panier` (
  `IdPanier` int(11) NOT NULL,
  `DesignationPanier` varchar(255) DEFAULT NULL,
  `QuantitePanier` int(11) NOT NULL,
  `PrixPanier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Producteur`
--

CREATE TABLE `Producteur` (
  `IdProducteur` int(11) NOT NULL,
  `RaisonSocialeProducteur` varchar(50) DEFAULT NULL,
  `NomPrenomProducteur` varchar(50) NOT NULL,
  `PhoneProducteur` varchar(50) NOT NULL,
  `MailProducteur` varchar(50) NOT NULL,
  `CodePostalProducteur` varchar(50) NOT NULL,
  `CoordonneesGPSProducteur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Producteur`
--

INSERT INTO `Producteur` (`IdProducteur`, `RaisonSocialeProducteur`, `NomPrenomProducteur`, `PhoneProducteur`, `MailProducteur`, `CodePostalProducteur`, `CoordonneesGPSProducteur`) VALUES
(6, NULL, 'abc dssss', '771201703', 'a@a.fr', '41110', '6875432');

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `IdProduit` int(11) NOT NULL,
  `DesignationProduit` varchar(50) NOT NULL,
  `IdSaisonProduit` int(11) NOT NULL,
  `IdCategorieProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`IdProduit`, `DesignationProduit`, `IdSaisonProduit`, `IdCategorieProduit`) VALUES
(141, 'Carotte', 4, 1),
(142, 'Tomate', 2, 1),
(143, 'Pomme de terre', 3, 1),
(144, 'Courgette', 1, 1),
(145, 'Poivron', 2, 1),
(146, 'Aubergine', 3, 1),
(147, 'Laitue', 1, 1),
(148, 'Concombre', 2, 1),
(149, 'Radis', 3, 1),
(150, 'Patate douce', 1, 1),
(151, 'Fraise', 2, 2),
(152, 'Pomme', 3, 2),
(153, 'Banane', 1, 2),
(154, 'Raisin', 2, 2),
(155, 'Kiwi', 4, 2),
(156, 'Poire', 4, 2),
(157, 'Citron', 2, 2),
(158, 'Orange', 4, 2),
(159, 'Melon', 1, 2),
(160, 'Pastèque', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ProduitProducteur`
--

CREATE TABLE `ProduitProducteur` (
  `IdProduitProducteur` int(11) NOT NULL,
  `DesignationProduitProducteur` varchar(50) NOT NULL,
  `PrixProduitProducteur` varchar(50) NOT NULL,
  `DateModifPrixProduitProducteur` date DEFAULT NULL,
  `DetailsProduitProducteur` varchar(255) NOT NULL,
  `QuantiteProduitProducteur` int(11) NOT NULL,
  `ImageProduitProducteur` varchar(128) DEFAULT NULL,
  `IdProducteurProduitProducteur` int(11) NOT NULL,
  `IdProduitProduitProducteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Reglement`
--

CREATE TABLE `Reglement` (
  `IdReglement` int(11) NOT NULL,
  `DateReglement` date NOT NULL,
  `MontantReglement` decimal(11,3) NOT NULL,
  `EtatReglement` tinyint(1) NOT NULL,
  `IdCommandeReglement` int(11) NOT NULL,
  `IdModeReglement` int(11) NOT NULL,
  `IdAdminReglement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Saison`
--

CREATE TABLE `Saison` (
  `IdSaison` int(11) NOT NULL,
  `NomSaison` varchar(16) NOT NULL,
  `DateDebutSaison` date NOT NULL,
  `DateFinSaison` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Saison`
--

INSERT INTO `Saison` (`IdSaison`, `NomSaison`, `DateDebutSaison`, `DateFinSaison`) VALUES
(1, 'hiver', '2023-12-21', '2024-03-19'),
(2, 'printemps', '2024-03-20', '2024-06-20'),
(3, 'ete', '2024-06-21', '2024-09-21'),
(4, 'automne', '2024-09-22', '2024-12-20');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `IdUser` int(11) NOT NULL,
  `UsernameUser` varchar(25) NOT NULL,
  `MdpUser` varchar(128) NOT NULL,
  `EmailUser` varchar(255) NOT NULL,
  `RoleUser` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`IdUser`, `UsernameUser`, `MdpUser`, `EmailUser`, `RoleUser`) VALUES
(33, 'bon.deulle', '$argon2id$v=19$m=65536,t=4,p=1$VDlxT25jZEdIcHl0U0R4Sw$K/1t7PG9uzQALRYUdsz3fribVeskXlUUTAn04IzUbas', 'enfreinmickael42@gmail.com', 'Adherent'),
(34, 'abc.dssss', '$argon2id$v=19$m=65536,t=4,p=1$U1ZTL1NBS25KekhZRGJkbw$rEJxKm1JJnqFZm4xkvoc9fqBO3V3xIbk+01Z1hGiZM8', 'a@a.fr', 'Producteur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Adherents`
--
ALTER TABLE `Adherents`
  ADD PRIMARY KEY (`IdAdherents`),
  ADD UNIQUE KEY `MailAdherents` (`MailAdherents`);

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`IdAdmin`);

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`IdCategorie`) USING BTREE;

--
-- Index pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD PRIMARY KEY (`IdCommande`),
  ADD KEY `Commandes_Adherents_FK` (`IdAdherentsCommandes`);

--
-- Index pour la table `ModeReglement`
--
ALTER TABLE `ModeReglement`
  ADD PRIMARY KEY (`IdModeReglement`);

--
-- Index pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD PRIMARY KEY (`IdPanier`);

--
-- Index pour la table `Producteur`
--
ALTER TABLE `Producteur`
  ADD PRIMARY KEY (`IdProducteur`),
  ADD UNIQUE KEY `MailProducteur` (`MailProducteur`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`IdProduit`),
  ADD KEY `Produit_Saison_FK` (`IdSaisonProduit`) USING BTREE,
  ADD KEY `Produit_TypeProduit0_FK` (`IdCategorieProduit`) USING BTREE;

--
-- Index pour la table `ProduitProducteur`
--
ALTER TABLE `ProduitProducteur`
  ADD PRIMARY KEY (`IdProduitProducteur`),
  ADD KEY `ProduitProducteur_Producteur_FK` (`IdProducteurProduitProducteur`),
  ADD KEY `ProduitProducteur_Produit0_FK` (`IdProduitProduitProducteur`);

--
-- Index pour la table `Reglement`
--
ALTER TABLE `Reglement`
  ADD PRIMARY KEY (`IdReglement`),
  ADD KEY `Reglement_Commandes_FK` (`IdCommandeReglement`),
  ADD KEY `Reglement_ModeReglement0_FK` (`IdModeReglement`),
  ADD KEY `Reglement_Admin1_FK` (`IdAdminReglement`);

--
-- Index pour la table `Saison`
--
ALTER TABLE `Saison`
  ADD PRIMARY KEY (`IdSaison`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `EmailUser` (`EmailUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Adherents`
--
ALTER TABLE `Adherents`
  MODIFY `IdAdherents` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `IdAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `IdCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Commandes`
--
ALTER TABLE `Commandes`
  MODIFY `IdCommande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ModeReglement`
--
ALTER TABLE `ModeReglement`
  MODIFY `IdModeReglement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Panier`
--
ALTER TABLE `Panier`
  MODIFY `IdPanier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Producteur`
--
ALTER TABLE `Producteur`
  MODIFY `IdProducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Produit`
--
ALTER TABLE `Produit`
  MODIFY `IdProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT pour la table `ProduitProducteur`
--
ALTER TABLE `ProduitProducteur`
  MODIFY `IdProduitProducteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Reglement`
--
ALTER TABLE `Reglement`
  MODIFY `IdReglement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Saison`
--
ALTER TABLE `Saison`
  MODIFY `IdSaison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
