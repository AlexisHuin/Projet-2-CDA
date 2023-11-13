-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : lun. 13 nov. 2023 à 12:57
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
-- Structure de la table `Adherent`
--

CREATE TABLE `Adherent` (
  `IdAdherent` int(11) NOT NULL,
  `NomPrenomAdherent` varchar(50) NOT NULL,
  `PhoneAdherent` varchar(13) NOT NULL,
  `MailAdherent` varchar(128) NOT NULL,
  `CodePostalAdherent` int(5) NOT NULL,
  `CoordonneesGPSAdherent` varchar(255) NOT NULL,
  `DateDebutAdherent` date NOT NULL,
  `DateFinAdherent` date DEFAULT NULL,
  `DepenseAdherent` decimal(15,2) NOT NULL DEFAULT 0.00,
  `EtatAbonnementAdherent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Adherent`
--

INSERT INTO `Adherent` (`IdAdherent`, `NomPrenomAdherent`, `PhoneAdherent`, `MailAdherent`, `CodePostalAdherent`, `CoordonneesGPSAdherent`, `DateDebutAdherent`, `DateFinAdherent`, `DepenseAdherent`, `EtatAbonnementAdherent`) VALUES
(12, 'ade ade', '0254477889', 'ade@ade.ade', 41000, '52564562', '2023-11-02', NULL, 4836.00, 0);

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
-- Structure de la table `Bundle`
--

CREATE TABLE `Bundle` (
  `IdBundle` int(11) NOT NULL,
  `DesignationBundle` varchar(75) NOT NULL,
  `IsValidateBundle` tinyint(1) NOT NULL DEFAULT 0,
  `IdProduitsBundle` varchar(20) NOT NULL,
  `QuantiteProduitsBundle` varchar(20) NOT NULL,
  `IdProducteurBundle` int(11) NOT NULL,
  `PrixBundle` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `TotalCommande` int(11) NOT NULL,
  `ProduitsCommande` varchar(20) NOT NULL,
  `QuantitesCommande` varchar(20) NOT NULL,
  `ProducteursCommande` varchar(20) NOT NULL,
  `IdAdherentCommande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Commandes`
--

INSERT INTO `Commandes` (`IdCommande`, `TotalCommande`, `ProduitsCommande`, `QuantitesCommande`, `ProducteursCommande`, `IdAdherentCommande`) VALUES
(1, 4836, '17,14', '43,50', '7,7', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Demandes`
--

CREATE TABLE `Demandes` (
  `IdDemande` int(11) NOT NULL,
  `ObjetDemande` varchar(64) NOT NULL,
  `PrixProposeDemande` float DEFAULT NULL,
  `DesignationProduitDemande` varchar(32) NOT NULL,
  `MotifDemande` varchar(255) NOT NULL,
  `IdProducteurDemande` int(11) NOT NULL,
  `IdProduitProducteurDemande` int(11) NOT NULL,
  `EtatDemande` varchar(8) NOT NULL DEFAULT 'Opened'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Demandes`
--

INSERT INTO `Demandes` (`IdDemande`, `ObjetDemande`, `PrixProposeDemande`, `DesignationProduitDemande`, `MotifDemande`, `IdProducteurDemande`, `IdProduitProducteurDemande`, `EtatDemande`) VALUES
(33, 'Prix', 9, 'Aubergine du coin', 'Le producteur prod.prod souhaite modifié le prix de Aubergine du coin au prix de 9', 7, 13, 'Denied'),
(34, 'Prix', 50, 'Aubergine du coin', 'Le producteur prod.prod souhaite modifié le prix de Aubergine du coin au prix de 50', 7, 13, 'Accepted'),
(35, 'Prix', 52, 'Aubergine du coin', 'Le producteur prod.prod souhaite modifié le prix de Aubergine du coin au prix de 52', 7, 13, 'Opened'),
(36, 'Ajout Bundle', 64.088, 'Le meilleur bundle', 'Le producteur prod.prod souhaite ajouter le bundle Le meilleur bundle au prix de 64.088', 7, 1, 'Opened');

-- --------------------------------------------------------

--
-- Structure de la table `Facture`
--

CREATE TABLE `Facture` (
  `IdFacture` int(11) NOT NULL,
  `MontantFacture` decimal(11,2) NOT NULL,
  `DatePrelevementFacture` varchar(12) DEFAULT NULL,
  `IdAdherentFacture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Facture`
--

INSERT INTO `Facture` (`IdFacture`, `MontantFacture`, `DatePrelevementFacture`, `IdAdherentFacture`) VALUES
(1, 0.00, NULL, 12);

-- --------------------------------------------------------

--
-- Structure de la table `InfosReglement`
--

CREATE TABLE `InfosReglement` (
  `IdInfosReglement` int(11) NOT NULL,
  `CodeCBInfosReglement` varchar(255) NOT NULL,
  `TitulaireInfosReglement` varchar(128) NOT NULL,
  `ExpirationInfosReglement` varchar(5) NOT NULL,
  `CVVInfosReglement` varchar(255) NOT NULL,
  `IdAdherentInfosReglement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `InfosReglement`
--

INSERT INTO `InfosReglement` (`IdInfosReglement`, `CodeCBInfosReglement`, `TitulaireInfosReglement`, `ExpirationInfosReglement`, `CVVInfosReglement`, `IdAdherentInfosReglement`) VALUES
(1, '$argon2i$v=19$m=65536,t=4,p=1$NEswVjFlUnRuWUNMLmU4ZQ$X323MZYjFKFz/IvOvGviuw4URxeQh8fFaIpi6d+l0mY', 'Kevin', '06-24', '$argon2i$v=19$m=65536,t=4,p=1$MkRBYldnbktkWjhqdTRBUA$DxI0ZtpwjyxsNmE3o0ec362pvogDePj3pn6V7aq7F/c', 11);

-- --------------------------------------------------------

--
-- Structure de la table `Notifications`
--

CREATE TABLE `Notifications` (
  `IdNotification` int(11) NOT NULL,
  `IdDestinataireNotification` int(11) NOT NULL,
  `MotifNotification` varchar(255) NOT NULL,
  `IsReadNotification` tinyint(1) NOT NULL DEFAULT 0,
  `DateEnvoiNotification` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Notifications`
--

INSERT INTO `Notifications` (`IdNotification`, `IdDestinataireNotification`, `MotifNotification`, `IsReadNotification`, `DateEnvoiNotification`) VALUES
(1, 7, 'Votre demande concernant la modification du prix de Aubergine du coin à été refusée.', 1, '2023-11-01 17:25');

-- --------------------------------------------------------

--
-- Structure de la table `Panier`
--

CREATE TABLE `Panier` (
  `IdPanier` int(11) NOT NULL,
  `ProduitPanier` int(11) NOT NULL,
  `QuantitePanier` int(11) NOT NULL,
  `PrixPanier` int(11) NOT NULL,
  `IdProducteurProduitPanier` int(11) NOT NULL,
  `IdAdherentsPanier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `Panier`
--

INSERT INTO `Panier` (`IdPanier`, `ProduitPanier`, `QuantitePanier`, `PrixPanier`, `IdProducteurProduitPanier`, `IdAdherentsPanier`) VALUES
(1, 19, 5, 25, 0, 7),
(2, 19, 5, 25, 0, 13),
(17, 7, 5, 95, 7, 7),
(18, 7, 5, 95, 7, 7),
(19, 7, 120, 2280, 7, 12);

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
(7, 'Hello', 'prodprod', '0943850653', 'prod@prod.prod', '41000', '3123123', 0),
(8, NULL, 'aaaaaa', '0254477889', 'aaa@aaa.aaa', '41000', '0256464', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `IdProduit` int(11) NOT NULL,
  `DesignationProduit` varchar(50) NOT NULL,
  `IdSaisonProduit` int(11) NOT NULL,
  `IdCategorieProduit` int(11) NOT NULL,
  `PhotoProduit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`IdProduit`, `DesignationProduit`, `IdSaisonProduit`, `IdCategorieProduit`, `PhotoProduit`) VALUES
(1, 'Pomme Gala', 1, 1, 'assets/images/Pomme.jpg'),
(2, 'Carotte Orange', 2, 2, 'assets/images/Carrote.jpg'),
(3, 'Ananas Victoria', 3, 3, 'assets/images/Ananas.jpg'),
(4, 'Patate Douce', 4, 2, 'assets/images/PatateDouce.jpg'),
(5, 'Mangue Alphonso', 1, 3, 'assets/images/Mangue.jpg'),
(6, 'Brocoli', 2, 2, 'assets/images/Brocoli.jpg'),
(7, 'Poire Williams', 3, 1, 'assets/images/Poire.jpg'),
(8, 'Tomate Roma', 4, 2, 'assets/images/Tomate.jpg'),
(9, 'Papaye Solo', 1, 3, 'assets/images/Papaye.jpg'),
(10, 'Courgette Verte', 2, 2, 'assets/images/Courgette.jpg'),
(11, 'Pomelo Rose', 3, 3, 'assets/images/Pomelo.jpg'),
(12, 'Figue Noire', 4, 3, 'assets/images/Figue.jpg'),
(13, 'Banane Cavendish', 1, 3, 'assets/images/Bananas.jpg'),
(14, 'Épinard Frais', 2, 2, 'assets/images/Epinard.jpg'),
(15, 'Kiwi Hayward', 3, 3, 'assets/images/Kiwi.jpg'),
(16, 'Aubergine Longue', 4, 2, 'assets/images/Aubergine.jpg'),
(17, 'Pastèque Sugar Baby', 1, 3, 'assets/images/Pasteque.jpg'),
(18, 'Chou-fleur', 2, 2, 'assets/images/ChouFleur.jpg'),
(19, 'Raisin Thompson', 3, 1, 'assets/images/Raisin.jpg'),
(20, 'Poivron Rouge', 4, 2, 'assets/images/Poivron.jpg'),
(21, 'Litchi', 1, 3, 'assets/images/Litchi.jpg'),
(22, 'Pomme de Terre Russet', 2, 2, 'assets/images/PommeDeTerre.jpg'),
(23, 'Melon Charentais', 3, 1, 'assets/images/Melon.jpg'),
(24, 'Courge Butternut', 4, 2, 'assets/images/Butternut.jpg'),
(25, 'Orange Navel', 1, 1, 'assets/images/Orange.jpg'),
(26, 'Poivron Jaune', 2, 2, 'assets/images/Poivron.jpg'),
(27, 'Cerise Griotte', 3, 1, 'assets/images/Cerise.jpg'),
(28, 'Asperge Verte', 4, 2, 'assets/images/Asperge.jpg'),
(29, 'Fraise Gariguette', 1, 1, 'assets/images/Fraise.jpg'),
(30, 'Haricot Vert', 2, 2, 'assets/images/HaricotVert.jpg'),
(31, 'Pêche de Vigne', 3, 1, 'assets/images/Peche.jpg'),
(32, 'Ail Rose', 4, 2, 'assets/images/Ail.jpg'),
(33, 'Citron Jaune', 1, 1, 'assets/images/Citron.jpg'),
(34, 'Oignon Jaune', 2, 2, 'assets/images/Oignons.jpg'),
(35, 'Abricot Bergeron', 3, 1, 'assets/images/Abricot.jpg'),
(36, 'Concombre', 4, 2, 'assets/images/Concombre.jpg'),
(37, 'Poireau', 1, 2, 'assets/images/Poireaux.jpg'),
(38, 'Céleri', 2, 2, 'assets/images/Celeri.jpg'),
(39, 'Rhubarbe', 3, 2, 'assets/images/Rhubarde.jpg'),
(40, 'Pomme Granny Smith', 4, 1, 'assets/images/Pomme.jpg'),
(41, 'Champignon de Paris', 1, 2, 'assets/images/ChampignonDeParis.jpg'),
(43, 'Mûre', 3, 1, 'assets/images/Mûre.jpg'),
(46, 'Cassis', 2, 1, 'assets/images/Cassis.jpg'),
(47, 'Artichaut Violet', 3, 2, 'assets/images/Artichaut.jpg'),
(49, 'Noix', 1, 1, 'assets/images/Noix.jpg'),
(50, 'Cerfeuil', 2, 2, 'assets/images/Cerfeuil.jpg'),
(51, 'Prune Jaune', 2, 1, 'assets/images/PruneJaune.jpg'),
(52, 'Gingembre', 1, 2, 'assets/images/Gingembre.jpg');

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
(1, 1, 'Carotte', '2.99', '2023-10-30 10:53', 'Super sucré', 8, 'assets/images/Carotte.png', 7, 19),
(2, 1, 'Brocoli', '1', '2023-10-30 10:53', 'Super salé', 13, 'assets/images/Brocoli.jpg', 7, 35),
(3, 1, 'Pomme de terre', '0.99', '2023-10-30 10:53', 'Super poivré', 141, 'assets/images/PommeDeTerre.jpg', 7, 4),
(4, 1, 'Courgette', '2.99', '2023-10-30 10:53', 'Bio', 252, 'assets/images/Courgette.jpg', 7, 46),
(5, 1, 'Tomate', '2.50', '2023-10-30 10:53', 'Bio', 171, 'assets/images/Tomate.jpg', 7, 47),
(6, 1, 'Poivron', '3.20', '2023-10-30 10:53', 'Saveur douce et texture ferme', 185, 'assets/images/Poivron.jpg', 7, 9),
(7, 1, 'Oignon', '1.68', '2023-10-30 10:53', 'OGM', 240, 'assets/images/Oignons.jpg', 7, 7),
(8, 1, 'Ail', '2.10', '2023-10-30 10:53', 'Forte saveur', 39, 'assets/images/Ail.jpg', 7, 27),
(9, 1, 'Épinard', '4.50', '2023-10-30 10:53', 'Riche en fer et en vitamines', 36, 'assets/images/Epinard.jpg', 7, 52),
(10, 1, 'Asperge', '7.40', '2023-10-30 10:53', 'Bio', 175, 'assets/images/Asperge.jpg', 7, 33),
(11, 1, 'Haricot vert', '1.45', '2023-10-30 10:53', 'Cuisson rapide', 92, 'assets/images/Haricotvert.jpg', 7, 49),
(12, 1, 'Champignon', '1.10', '2023-10-30 10:53', 'Gros champignons bruns', 205, 'assets/images/ChampignonDeParis.jpg', 7, 47),
(13, 1, 'Concombre', '5.30', '2023-10-30 10:53', 'Parfait pour les salades ou les sandwichs', 220, 'assets/images/Concombre.jpg', 7, 11),
(14, 1, 'Chou-fleur', '1.2', '2023-10-30 10:53', 'Enfants', 102, 'assets/images/ChouFleur.jpg', 7, 31),
(15, 1, 'Pois', '0.90', '2023-10-30 10:53', 'Sugar Snap', 219, 'assets/images/Poire.jpg', 7, 27),
(16, 1, 'Navet', '1.70', '2023-10-30 10:53', 'Idéale pour les purées ou les ragoûts', 168, 'assets/images/Navet.jpg', 7, 22),
(17, 1, 'Radis', '2.20', '2023-10-30 10:53', 'Saveur piquante', 230, 'assets/images/Radis.jpg', 7, 2),
(18, 1, 'Aubergine', '6.50', '2023-10-30 10:53', 'Italian Eggplant', 217, 'assets/images/Aubergine.jpg', 7, 43),
(19, 1, 'Céleri', '1.60', '2023-10-30 10:53', 'Racine à la saveur de céler', 175, 'assets/images/Celeri.jpg', 7, 14),
(20, 1, 'Patate douce', '1.45', '2023-10-30 10:53', 'Riche en vitamine A', 14, 'assets/images/Patatedouce.jpg', 7, 39);

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
(39, 'aaa.aaa', '$argon2id$v=19$m=65536,t=4,p=1$YzFVdW5hR0UyZWN3S0lXLg$Np3u9VhGUXFZgymKDRW2DqOvRc7XFlczTQs1F2bhioQ', 'aaa@aaa.aaa', 'Producteur'),
(40, 'ade.ade', '$argon2id$v=19$m=65536,t=4,p=1$NlFxR0E0Y1RvVy5ER1RLbQ$lPYmgXuIxAh7hRu5VLLX1m/VX9ez7tlhwePdUpsJ3WM', 'ade@ade.ade', 'Adherent'),
(41, 'fueze.tea', '$argon2id$v=19$m=65536,t=4,p=1$NFBuVGNpaHQ5c2thcy8xWQ$3uN7cBfQUNeCedjte3HwBI8uMV30e3IXtX3hDmgdNEA', 'fuzetea@gmail.com', 'Adherent');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Adherent`
--
ALTER TABLE `Adherent`
  ADD PRIMARY KEY (`IdAdherent`),
  ADD UNIQUE KEY `MailAdherents` (`MailAdherent`);

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`IdAdmin`);

--
-- Index pour la table `Bundle`
--
ALTER TABLE `Bundle`
  ADD PRIMARY KEY (`IdBundle`);

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
  ADD KEY `Commandes_Adherents_FK` (`TotalCommande`),
  ADD KEY `TotalCommande` (`TotalCommande`);

--
-- Index pour la table `Demandes`
--
ALTER TABLE `Demandes`
  ADD PRIMARY KEY (`IdDemande`),
  ADD KEY `IdProducteurDemande` (`IdProducteurDemande`),
  ADD KEY `IdProduitProducteurDemande` (`IdProduitProducteurDemande`) USING BTREE;

--
-- Index pour la table `Facture`
--
ALTER TABLE `Facture`
  ADD PRIMARY KEY (`IdFacture`),
  ADD KEY `IdAdherentFacture` (`IdAdherentFacture`);

--
-- Index pour la table `InfosReglement`
--
ALTER TABLE `InfosReglement`
  ADD PRIMARY KEY (`IdInfosReglement`),
  ADD KEY `IdAdherentInfosReglement` (`IdAdherentInfosReglement`);

--
-- Index pour la table `Notifications`
--
ALTER TABLE `Notifications`
  ADD PRIMARY KEY (`IdNotification`),
  ADD KEY `IdDestinataireNotification` (`IdDestinataireNotification`);

--
-- Index pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD PRIMARY KEY (`IdPanier`),
  ADD KEY `IdAdherentsPanier` (`IdAdherentsPanier`) USING BTREE,
  ADD KEY `IdProducteurProduitPanier` (`IdProducteurProduitPanier`);

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
-- AUTO_INCREMENT pour la table `Adherent`
--
ALTER TABLE `Adherent`
  MODIFY `IdAdherent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `IdAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Bundle`
--
ALTER TABLE `Bundle`
  MODIFY `IdBundle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `IdCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Commandes`
--
ALTER TABLE `Commandes`
  MODIFY `IdCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Demandes`
--
ALTER TABLE `Demandes`
  MODIFY `IdDemande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `Facture`
--
ALTER TABLE `Facture`
  MODIFY `IdFacture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `InfosReglement`
--
ALTER TABLE `InfosReglement`
  MODIFY `IdInfosReglement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `IdNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Panier`
--
ALTER TABLE `Panier`
  MODIFY `IdPanier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `Producteur`
--
ALTER TABLE `Producteur`
  MODIFY `IdProducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Produit`
--
ALTER TABLE `Produit`
  MODIFY `IdProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `ProduitProducteur`
--
ALTER TABLE `ProduitProducteur`
  MODIFY `IdProduitProducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `Saison`
--
ALTER TABLE `Saison`
  MODIFY `IdSaison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
