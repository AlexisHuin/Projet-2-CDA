SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `coopConsommateur`;
USE `coopConsommateur`;


-- Création de la table Adherent
CREATE TABLE Adherent (
  IdAdherent INT(11) PRIMARY KEY AUTO_INCREMENT,
  NomPrenomAdherent VARCHAR(50),
  PhoneAdherent VARCHAR(13),
  MailAdherent VARCHAR(128) UNIQUE,
  CodePostalAdherent INT(5),
  CoordonneesGPSAdherent VARCHAR(255),
  DateDebutAdherent DATE,
  DateFinAdherent DATE NULL DEFAULT NULL,
  DepenseAdherent DECIMAL(15,2) NOT NULL DEFAULT 0.00,
  EtatAbonnementAdherent BOOLEAN DEFAULT 0
);

INSERT INTO `Adherent` (`IdAdherent`, `NomPrenomAdherent`, `PhoneAdherent`, `MailAdherent`, `CodePostalAdherent`, `CoordonneesGPSAdherent`, `DateDebutAdherent`, `DateFinAdherent`, `DepenseAdherent`, `EtatAbonnementAdherent`) VALUES
(1, 'ade ade', '0254477889', 'ade@ade.ade', 41000, '52564562', '2023-11-02', NULL, 0.00, 0);

-- Création de la table Admin
CREATE TABLE Admin (
  IdAdmin INT(11) PRIMARY KEY AUTO_INCREMENT,
  UsernameAdmin VARCHAR(25) UNIQUE,
  MdpAdmin VARCHAR(255)
);

INSERT INTO `Admin` (`IdAdmin`, `UsernameAdmin`, `MdpAdmin`) VALUES
(1, 'zab', '$argon2id$v=19$m=65536,t=4,p=1$Mk1lM2hCVkR6b0RqNU9QaQ$K2b9zhdKs5+jTZ7E8ah7hzy4az4H3sg+g7lTtRHmbsg'),
(2, 'zabzab', '$argon2id$v=19$m=65536,t=4,p=1$TEs0Nmd0L1hJdWwwMENVMg$hKO6MNuvVeu66qDG06nC+rW7lQe9Njx7H8r4PKcASuw');


-- Création de la table Bundle
CREATE TABLE Bundle (
  IdBundle INT(11) PRIMARY KEY AUTO_INCREMENT,
  DesignationBundle VARCHAR(75) UNIQUE,
  IsValidateBundle BOOLEAN DEFAULT 0,
  IdProduitsBundle VARCHAR(20),
  QuantiteProduitsBundle VARCHAR(20),
  IdProducteurBundle INT(11),
  PrixBundle DECIMAL(15,2)
);

-- Création de la table Categorie
CREATE TABLE Categorie (
  IdCategorie INT(11) PRIMARY KEY AUTO_INCREMENT,
  DesignationCategorie VARCHAR(50) UNIQUE
);

INSERT INTO `Categorie` (`IdCategorie`, `DesignationCategorie`) VALUES
(1, 'Fruit'),
(2, 'Legume'),
(3, 'Fruit Exotique');

-- Création de la table Commandes
CREATE TABLE Commandes (
  IdCommande INT(11) PRIMARY KEY AUTO_INCREMENT,
  TotalCommande DECIMAL(11,2),
  ProduitsCommande VARCHAR(20),
  QuantitesCommande VARCHAR(20),
  ProducteursCommande VARCHAR(20),
  IdAdherentCommande INT(11)
);

-- Création de la table Demandes
CREATE TABLE Demandes (
  IdDemande INT(11) PRIMARY KEY AUTO_INCREMENT,
  ObjetDemande VARCHAR(64),
  PrixProposeDemande DECIMAL(11,2) NULL DEFAULT NULL,
  DesignationProduitDemande VARCHAR(32),
  MotifDemande VARCHAR(255),
  IdUserDemande INT(11),
  IdProduitProducteurDemande INT(11),
  EtatDemande VARCHAR(8) DEFAULT 'Opened'
);

-- Création de la table Facture
CREATE TABLE Facture (
  IdFacture INT(11) PRIMARY KEY AUTO_INCREMENT,
  MontantFacture DECIMAL(11,2),
  DatePrelevementFacture VARCHAR(12) DEFAULT "En cours",
  IdAdherentFacture INT(11)
);

INSERT INTO `Facture` (`IdFacture`, `MontantFacture`, `DatePrelevementFacture`, `IdAdherentFacture`) VALUES
(1, 0.00, "En cours", 1);

-- Création de la table InfosReglement
CREATE TABLE InfosReglement (
  IdInfosReglement INT(11) PRIMARY KEY AUTO_INCREMENT,
  CodeCBInfosReglement VARCHAR(255),
  TitulaireInfosReglement VARCHAR(128),
  ExpirationInfosReglement VARCHAR(5),
  CVVInfosReglement VARCHAR(255),
  IdAdherentInfosReglement INT(11)
);

INSERT INTO `InfosReglement` (`IdInfosReglement`, `CodeCBInfosReglement`, `TitulaireInfosReglement`, `ExpirationInfosReglement`, `CVVInfosReglement`, `IdAdherentInfosReglement`) VALUES
(1, '$argon2i$v=19$m=65536,t=4,p=1$NEswVjFlUnRuWUNMLmU4ZQ$X323MZYjFKFz/IvOvGviuw4URxeQh8fFaIpi6d+l0mY', 'Kevin', '06-24', '$argon2i$v=19$m=65536,t=4,p=1$MkRBYldnbktkWjhqdTRBUA$DxI0ZtpwjyxsNmE3o0ec362pvogDePj3pn6V7aq7F/c', 1);


-- Création de la table Notifications
CREATE TABLE Notifications (
  IdNotification INT(11) PRIMARY KEY AUTO_INCREMENT,
  IdDestinataireNotification INT(11),
  MotifNotification VARCHAR(255),
  IsReadNotification BOOLEAN DEFAULT 0,
  DateEnvoiNotification VARCHAR(64)
);

-- Création de la table Panier
CREATE TABLE Panier (
  IdPanier INT(11) PRIMARY KEY AUTO_INCREMENT,
  ProduitPanier INT(11),
  QuantitePanier INT(11),
  PrixPanier DECIMAL(11,2),
  IdProducteurProduitPanier INT(11),
  IdAdherentsPanier INT(11)
);

-- Création de la table Producteur
CREATE TABLE Producteur (
  IdProducteur INT(11) PRIMARY KEY AUTO_INCREMENT,
  RaisonSocialeProducteur VARCHAR(50),
  NomPrenomProducteur VARCHAR(50),
  PhoneProducteur VARCHAR(50),
  MailProducteur VARCHAR(50) UNIQUE,
  CodePostalProducteur VARCHAR(50),
  CoordonneesGPSProducteur VARCHAR(255),
  SommeVentesProducteur DECIMAL(12,2) DEFAULT 0.00
);

INSERT INTO `Producteur` (`IdProducteur`, `RaisonSocialeProducteur`, `NomPrenomProducteur`, `PhoneProducteur`, `MailProducteur`, `CodePostalProducteur`, `CoordonneesGPSProducteur`, `SommeVentesProducteur`) VALUES
(1, 'Hello', 'prod prod', '0943850653', 'prod@prod.prod', '41000', '3123123', 0.00),
(2, 'Yo', 'aaa aaa', '0254477889', 'aaa@aaa.aaa', '41000', '0256464', 0.00);

-- Création de la table Produit
CREATE TABLE Produit (
  IdProduit INT(11) PRIMARY KEY AUTO_INCREMENT,
  DesignationProduit VARCHAR(50),
  IdSaisonProduit INT(11),
  IdCategorieProduit INT(11),
  PhotoProduit VARCHAR(255)
);

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

-- Création de la table ProduitProducteur
CREATE TABLE ProduitProducteur (
  IdProduitProducteur INT(11) PRIMARY KEY AUTO_INCREMENT,
  IsValidateProduitProducteur BOOLEAN DEFAULT 0,
  DesignationProduitProducteur VARCHAR(50),
  PrixProduitProducteur VARCHAR(50),
  DateModifPrixProduitProducteur VARCHAR(32) NULL DEFAULT NULL,
  DetailsProduitProducteur VARCHAR(255),
  QuantiteProduitProducteur INT(11),
  ImageProduitProducteur VARCHAR(128) NULL DEFAULT NULL,
  IdProducteurProduitProducteur INT(11),
  IdProduitProduitProducteur INT(11)
);


INSERT INTO `ProduitProducteur` (`IdProduitProducteur`, `IsValidateProduitProducteur`, `DesignationProduitProducteur`, `PrixProduitProducteur`, `DateModifPrixProduitProducteur`, `DetailsProduitProducteur`, `QuantiteProduitProducteur`, `ImageProduitProducteur`, `IdProducteurProduitProducteur`, `IdProduitProduitProducteur`) VALUES
(1, 1, 'Carotte', '2.99', '2023-10-30 10:53', 'Super sucré', 8, 'assets/images/Carotte.png', 1, 19),
(2, 1, 'Brocoli', '1', '2023-10-30 10:53', 'Super salé', 13, 'assets/images/Brocoli.jpg', 1, 35),
(3, 1, 'Pomme de terre', '0.99', '2023-10-30 10:53', 'Super poivré', 141, 'assets/images/PommeDeTerre.jpg', 1, 4),
(4, 1, 'Courgette', '2.99', '2023-10-30 10:53', 'Bio', 252, 'assets/images/Courgette.jpg', 1, 46),
(5, 1, 'Tomate', '2.50', '2023-10-30 10:53', 'Bio', 171, 'assets/images/Tomate.jpg', 1, 47),
(6, 1, 'Poivron', '3.20', '2023-10-30 10:53', 'Saveur douce et texture ferme', 185, 'assets/images/Poivron.jpg', 1, 9),
(7, 1, 'Oignon', '1.68', '2023-10-30 10:53', 'OGM', 240, 'assets/images/Oignons.jpg', 1, 7),
(8, 1, 'Ail', '2.10', '2023-10-30 10:53', 'Forte saveur', 39, 'assets/images/Ail.jpg', 1, 27),
(9, 1, 'Épinard', '4.50', '2023-10-30 10:53', 'Riche en fer et en vitamines', 36, 'assets/images/Epinard.jpg', 1, 52),
(10, 1, 'Asperge', '7.40', '2023-10-30 10:53', 'Bio', 175, 'assets/images/Asperge.jpg', 1, 33),
(11, 1, 'Haricot vert', '1.45', '2023-10-30 10:53', 'Cuisson rapide', 92, 'assets/images/Haricotvert.jpg', 1, 49),
(12, 1, 'Champignon', '1.10', '2023-10-30 10:53', 'Gros champignons bruns', 205, 'assets/images/ChampignonDeParis.jpg', 1, 47),
(13, 1, 'Concombre', '5.30', '2023-10-30 10:53', 'Parfait pour les salades ou les sandwichs', 220, 'assets/images/Concombre.jpg', 1, 11),
(14, 1, 'Chou-fleur', '1.2', '2023-10-30 10:53', 'Enfants', 102, 'assets/images/ChouFleur.jpg', 1, 31),
(15, 1, 'Pois', '0.90', '2023-10-30 10:53', 'Sugar Snap', 219, 'assets/images/Poire.jpg', 1, 27),
(16, 1, 'Navet', '1.70', '2023-10-30 10:53', 'Idéale pour les purées ou les ragoûts', 168, 'assets/images/Navet.jpg', 1, 22),
(17, 1, 'Radis', '2.20', '2023-10-30 10:53', 'Saveur piquante', 230, 'assets/images/Radis.jpg', 1, 2),
(18, 1, 'Aubergine', '6.50', '2023-10-30 10:53', 'Italian Eggplant', 217, 'assets/images/Aubergine.jpg', 1, 43),
(19, 1, 'Céleri', '1.60', '2023-10-30 10:53', 'Racine à la saveur de céler', 175, 'assets/images/Celeri.jpg', 1, 14),
(20, 1, 'Patate douce', '1.45', '2023-10-30 10:53', 'Riche en vitamine A', 14, 'assets/images/Patatedouce.jpg', 1, 39);

-- Création de la table Saison
CREATE TABLE Saison (
  IdSaison INT(11) PRIMARY KEY AUTO_INCREMENT,
  NomSaison VARCHAR(16),
  DateDebutSaison DATE,
  DateFinSaison DATE
);

INSERT INTO `Saison` (`IdSaison`, `NomSaison`, `DateDebutSaison`, `DateFinSaison`) VALUES
(1, 'hiver', '2023-12-21', '2024-03-19'),
(2, 'printemps', '2024-03-20', '2024-06-20'),
(3, 'ete', '2024-06-21', '2024-09-21'),
(4, 'automne', '2024-09-22', '2024-12-20');

-- Création de la table User
CREATE TABLE User (
  IdUser INT(11) PRIMARY KEY AUTO_INCREMENT,
  UsernameUser VARCHAR(25) UNIQUE,
  MdpUser VARCHAR(255),
  EmailUser VARCHAR(255) UNIQUE,
  RoleUser VARCHAR(12)
);

INSERT INTO `User` (`IdUser`, `UsernameUser`, `MdpUser`, `EmailUser`, `RoleUser`) VALUES
(1, 'prod.prod', '$argon2id$v=19$m=65536,t=4,p=1$R0VBRzNEOS8xYmpscmRveQ$/D3mCfK8v3eK1/CnMUJyy2r/JbKT9+SUMvvRwkdsJBA', 'prod@prod.prod', 'Producteur'),
(2, 'aaa.aaa', '$argon2id$v=19$m=65536,t=4,p=1$YzFVdW5hR0UyZWN3S0lXLg$Np3u9VhGUXFZgymKDRW2DqOvRc7XFlczTQs1F2bhioQ', 'aaa@aaa.aaa', 'Producteur'),
(3, 'ade.ade', '$argon2id$v=19$m=65536,t=4,p=1$NlFxR0E0Y1RvVy5ER1RLbQ$lPYmgXuIxAh7hRu5VLLX1m/VX9ez7tlhwePdUpsJ3WM', 'ade@ade.ade', 'Adherent');


-- Ajout des contraintes de clé étrangère

-- Table Commandes
ALTER TABLE Commandes
ADD CONSTRAINT FK_Commandes_Adherent
FOREIGN KEY (IdAdherentCommande) REFERENCES Adherent(IdAdherent);

-- Table Demandes
ALTER TABLE Demandes
ADD CONSTRAINT FK_Demandes_User
FOREIGN KEY (IdUserDemande) REFERENCES User(IdUser);

ALTER TABLE Demandes
ADD CONSTRAINT FK_Demandes_ProduitProducteur
FOREIGN KEY (IdProduitProducteurDemande) REFERENCES ProduitProducteur(IdProduitProducteur);

-- Table Facture
ALTER TABLE Facture
ADD CONSTRAINT FK_Facture_Adherent
FOREIGN KEY (IdAdherentFacture) REFERENCES Adherent(IdAdherent);

-- Table InfosReglement
ALTER TABLE InfosReglement
ADD CONSTRAINT FK_InfosReglement_Adherent
FOREIGN KEY (IdAdherentInfosReglement) REFERENCES Adherent(IdAdherent);

-- Table Notifications
ALTER TABLE Notifications
ADD CONSTRAINT FK_Notifications_User
FOREIGN KEY (IdDestinataireNotification) REFERENCES User(IdUser);

-- Table Panier
ALTER TABLE Panier
ADD CONSTRAINT FK_Panier_ProduitProducteur
FOREIGN KEY (ProduitPanier) REFERENCES ProduitProducteur(IdProduitProducteur);

ALTER TABLE Panier
ADD CONSTRAINT FK_Panier_Producteur
FOREIGN KEY (IdProducteurProduitPanier) REFERENCES Producteur(IdProducteur);

ALTER TABLE Panier
ADD CONSTRAINT FK_Panier_Adherent
FOREIGN KEY (IdAdherentsPanier) REFERENCES Adherent(IdAdherent);

-- Table ProduitProducteur
ALTER TABLE ProduitProducteur
ADD CONSTRAINT FK_ProduitProducteur_Producteur
FOREIGN KEY (IdProducteurProduitProducteur) REFERENCES Producteur(IdProducteur);

ALTER TABLE ProduitProducteur
ADD CONSTRAINT FK_ProduitProducteur_Produit
FOREIGN KEY (IdProduitProduitProducteur) REFERENCES Produit(IdProduit);

-- Table Bundle
ALTER TABLE Bundle
ADD CONSTRAINT FK_Bundle_Producteur
FOREIGN KEY (IdProducteurBundle) REFERENCES Producteur(IdProducteur);

