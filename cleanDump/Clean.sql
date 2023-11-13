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

-- Création de la table Admin
CREATE TABLE Admin (
  IdAdmin INT(11) PRIMARY KEY AUTO_INCREMENT,
  UsernameAdmin VARCHAR(25) UNIQUE,
  MdpAdmin VARCHAR(255)
);

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

-- Création de la table InfosReglement
CREATE TABLE InfosReglement (
  IdInfosReglement INT(11) PRIMARY KEY AUTO_INCREMENT,
  CodeCBInfosReglement VARCHAR(255),
  TitulaireInfosReglement VARCHAR(128),
  ExpirationInfosReglement VARCHAR(5),
  CVVInfosReglement VARCHAR(255),
  IdAdherentInfosReglement INT(11)
);

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
-- Création de la table Produit
CREATE TABLE Produit (
  IdProduit INT(11) PRIMARY KEY AUTO_INCREMENT,
  DesignationProduit VARCHAR(50),
  IdSaisonProduit INT(11),
  IdCategorieProduit INT(11),
  PhotoProduit VARCHAR(255)
);

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

-- Création de la table Saison
CREATE TABLE Saison (
  IdSaison INT(11) PRIMARY KEY AUTO_INCREMENT,
  NomSaison VARCHAR(16),
  DateDebutSaison DATE,
  DateFinSaison DATE
);

-- Création de la table User
CREATE TABLE User (
  IdUser INT(11) PRIMARY KEY AUTO_INCREMENT,
  UsernameUser VARCHAR(25) UNIQUE,
  MdpUser VARCHAR(255),
  EmailUser VARCHAR(255) UNIQUE,
  RoleUser VARCHAR(12)
);

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

