-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mar. 24 oct. 2023 à 09:24
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
-- Base de données : `coopConsommateur`
--
CREATE DATABASE IF NOT EXISTS `coopConsommateur` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `coopConsommateur`;

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
(11, 'ade adherent', '0843954235', 'ade@ade.ade', 41000, '2343242523', '2023-10-21', NULL, 0.000, 0);

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
-- Structure de la table `Demandes`
--

CREATE TABLE `Demandes` (
  `IdDemande` int(11) NOT NULL,
  `ObjetDemande` varchar(64) NOT NULL,
  `PrixProposeDemande` float DEFAULT NULL,
  `MotifDemande` varchar(255) NOT NULL,
  `IdProducteurDemande` int(11) NOT NULL,
  `IdProduitProducteurDemande` int(11) NOT NULL,
  `EtatDemande` varchar(8) NOT NULL DEFAULT 'Opened'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Demandes`
--

INSERT INTO `Demandes` (`IdDemande`, `ObjetDemande`, `PrixProposeDemande`, `MotifDemande`, `IdProducteurDemande`, `IdProduitProducteurDemande`, `EtatDemande`) VALUES
(1, 'Prix', 0.3, 'Le producteur prod demande changement de prix sur tomates du jardin actuellement 0.20 pour 0.25', 7, 1, 'Accepted');

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
  `PrixPanier` int(11) NOT NULL,
  `IdAdherentsPanier` int(11) NOT NULL,
  `IsBundlePanier` tinyint(1) NOT NULL DEFAULT 0
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
  `CoordonneesGPSProducteur` varchar(255) NOT NULL,
  `SommeVentesProducteur` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Producteur`
--

INSERT INTO `Producteur` (`IdProducteur`, `RaisonSocialeProducteur`, `NomPrenomProducteur`, `PhoneProducteur`, `MailProducteur`, `CodePostalProducteur`, `CoordonneesGPSProducteur`, `SommeVentesProducteur`) VALUES
(7, NULL, 'prodprod', '0943850653', 'prod@prod.prod', '41000', '3123123', 0);

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
(1, 'Pomme Gala', 1, 1),
(2, 'Carotte Orange', 2, 2),
(3, 'Ananas Victoria', 3, 3),
(4, 'Patate Douce', 4, 1),
(5, 'Mangue Alphonso', 1, 2),
(6, 'Brocoli', 2, 3),
(7, 'Poire Williams', 3, 1),
(8, 'Tomate Roma', 4, 2),
(9, 'Papaye Solo', 1, 3),
(10, 'Courgette Verte', 2, 1),
(11, 'Pomelo Rose', 3, 2),
(12, 'Figue Noire', 4, 3),
(13, 'Banane Cavendish', 1, 1),
(14, 'Épinard Frais', 2, 2),
(15, 'Kiwi Hayward', 3, 3),
(16, 'Aubergine Longue', 4, 1),
(17, 'Pastèque Sugar Baby', 1, 2),
(18, 'Chou-fleur', 2, 3),
(19, 'Raisin Thompson', 3, 1),
(20, 'Poivron Rouge', 4, 2),
(21, 'Litchi', 1, 3),
(22, 'Pomme de Terre Russet', 2, 1),
(23, 'Melon Charentais', 3, 2),
(24, 'Courge Butternut', 4, 3),
(25, 'Orange Navel', 1, 1),
(26, 'Poivron Jaune', 2, 2),
(27, 'Cerise Griotte', 3, 3),
(28, 'Asperge Verte', 4, 1),
(29, 'Fraise Gariguette', 1, 2),
(30, 'Haricot Vert', 2, 3),
(31, 'Pêche de Vigne', 3, 1),
(32, 'Ail Rose', 4, 2),
(33, 'Citron Jaune', 1, 3),
(34, 'Oignon Jaune', 2, 1),
(35, 'Abricot Bergeron', 3, 2),
(36, 'Concombre', 4, 3),
(37, 'Poireau', 1, 1),
(38, 'Céleri', 2, 2),
(39, 'Rhubarbe', 3, 3),
(40, 'Pomme Granny Smith', 4, 1),
(41, 'Champignon de Paris', 1, 2),
(42, 'Poivre Rouge', 2, 3),
(43, 'Mûre', 3, 1),
(44, 'Pamplemousse Ruby Red', 4, 2),
(45, 'Poivre Vert', 1, 3),
(46, 'Cassis', 2, 1),
(47, 'Artichaut Violet', 3, 2),
(48, 'Ratatouille', 4, 3),
(49, 'Noix', 1, 1),
(50, 'Cerfeuil', 2, 2),
(51, 'Prune Jaune', 2, 1),
(52, 'Gingembre', 1, 2),
(53, 'Aubergine Graffiti', 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ProduitProducteur`
--

CREATE TABLE `ProduitProducteur` (
  `IdProduitProducteur` int(11) NOT NULL,
  `IsValidateProduitProducteur` tinyint(1) NOT NULL DEFAULT 0,
  `DesignationProduitProducteur` varchar(50) NOT NULL,
  `PrixProduitProducteur` varchar(50) NOT NULL,
  `DateModifPrixProduitProducteur` varchar(32) DEFAULT NULL,
  `DetailsProduitProducteur` varchar(255) NOT NULL,
  `QuantiteProduitProducteur` int(11) NOT NULL,
  `ImageProduitProducteur` varchar(128) DEFAULT NULL,
  `IdProducteurProduitProducteur` int(11) NOT NULL,
  `IdProduitProduitProducteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ProduitProducteur`
--

INSERT INTO `ProduitProducteur` (`IdProduitProducteur`, `IsValidateProduitProducteur`, `DesignationProduitProducteur`, `PrixProduitProducteur`, `DateModifPrixProduitProducteur`, `DetailsProduitProducteur`, `QuantiteProduitProducteur`, `ImageProduitProducteur`, `IdProducteurProduitProducteur`, `IdProduitProduitProducteur`) VALUES
(1, 1, 'Tomate du Jardin', '0.3', '2023-10-23 18:37', 'Le bonnes tomates du jardin bio au bord de la route 44', 150, NULL, 3, 1),
(3, 1, 'abricot de l&#039;abricoter', '0.20', NULL, 'MA LUBULULE', 450, NULL, 37, 35);

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
(37, 'prod.prod', '$argon2id$v=19$m=65536,t=4,p=1$R0VBRzNEOS8xYmpscmRveQ$/D3mCfK8v3eK1/CnMUJyy2r/JbKT9+SUMvvRwkdsJBA', 'prod@prod.prod', 'Producteur'),
(38, 'ade.ade', '$argon2id$v=19$m=65536,t=4,p=1$ZlFiTXJpNC85cS9vNFIyaA$h+fHK4rEQGMsuF4gqVb6+BGIfZgS/ewqSVZPLzcJWwM', 'ade@ade.ade', 'Adherent');

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
-- Index pour la table `Demandes`
--
ALTER TABLE `Demandes`
  ADD PRIMARY KEY (`IdDemande`),
  ADD KEY `IdProducteurDemande` (`IdProducteurDemande`),
  ADD KEY `IdProduitProducteurDemande` (`IdProduitProducteurDemande`) USING BTREE;

--
-- Index pour la table `ModeReglement`
--
ALTER TABLE `ModeReglement`
  ADD PRIMARY KEY (`IdModeReglement`);

--
-- Index pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD PRIMARY KEY (`IdPanier`),
  ADD KEY `IdAdherentsPanier` (`IdAdherentsPanier`) USING BTREE;

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
  MODIFY `IdAdherents` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT pour la table `Demandes`
--
ALTER TABLE `Demandes`
  MODIFY `IdDemande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `IdProducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `Produit`
--
ALTER TABLE `Produit`
  MODIFY `IdProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `ProduitProducteur`
--
ALTER TABLE `ProduitProducteur`
  MODIFY `IdProduitProducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
