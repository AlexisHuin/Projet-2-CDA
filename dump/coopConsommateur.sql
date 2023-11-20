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
(1, 'ade ade', '0254477889', 'ade@ade.ade', 41000, '52564562', '2023-11-02', NULL, 15.00, 0);

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
(1, 15.00, "En cours", 1);

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
(20, 1, 'Abricot Bergeron biographique', '1.40', NULL, 'Abricot Bergeron Biologique', 20, 'assets/images/655776f0669ce.jpg', 1, 35),
(21, 1, 'Abricot Bergeron Bio', '1.40', NULL, 'Abricot Bergeron Bio', 20, 'assets/images/655776f0669ce.jpg', 1, 35),
(22, 1, 'Ail rose sud de loire', '3.00', NULL, 'ail rose sud de loire', 30, 'assets/images/6557773017d56.jpg', 1, 32),
(24, 1, 'Ananas Victoria', '4.00', NULL, 'BIO', 50, 'assets/images/65577770702d4.jpg', 1, 3),
(25, 1, 'Artichaud violet', '2.00', NULL, 'Bio violet', 40, 'assets/images/655777a0c23c6.jpg', 1, 47),
(26, 1, 'Asperge Verte Bio', '9.00', NULL, 'bon avec de la creme', 70, 'assets/images/655777ee61f3a.jpg', 1, 28),
(27, 1, 'Aubergine Bio Longue', '9.00', NULL, 'Bio Aubergine', 10, 'assets/images/65577813ec8e9.jpg', 1, 16),
(28, 1, 'Banane Cavendish Bio', '12.00', NULL, 'BIO Banane', 60, 'assets/images/65577851efe94.jpg', 1, 13),
(29, 1, 'Brocoli Bio', '4.00', NULL, 'BIO', 60, 'assets/images/6557787507fac.jpg', 1, 6),
(30, 1, 'Carotte orange bio', '6.00', NULL, 'BIO Carotte', 80, 'assets/images/655778a5ed3c3.jpg', 1, 2),
(31, 1, 'du bon cassis sa mere', '4.00', NULL, 'Cassis Bio', 90, 'assets/images/655778c74ae2b.jpg', 1, 46),
(32, 1, 'aromate pot au feu', '2.60', NULL, 'bon pot au feu', 90, 'assets/images/655778f61f970.jpg', 1, 50),
(33, 1, 'Cerise rouge bio', '8.00', NULL, 'Cerise Bio cueillis ce matin', 90, 'assets/images/6557791fb048f.jpg', 1, 27),
(34, 1, 'Champignons de Paris', '12.00', NULL, 'Fait dans les caves de monthou', 90, 'assets/images/6557794b08bd4.jpg', 1, 41),
(35, 1, 'chou-fleur Bio', '7.00', NULL, 'Chou fleur fort en gout', 90, 'assets/images/655779a7b09a3.jpg', 1, 18),
(36, 1, 'Citron Jaune bio', '7.00', NULL, 'Bio Citron', 60, 'assets/images/655779f98c0d3.jpg', 1, 33),
(37, 1, 'Concombre Bio', '5.50', NULL, 'Bio Concombre', 90, 'assets/images/65577a4eae4b9.jpg', 1, 36),
(38, 1, 'Courge butternut bio', '4.00', NULL, 'Pour les soupes', 110, 'assets/images/65577ae81290b.jpg', 1, 24),
(39, 1, 'Courgette verte Bio', '6.00', NULL, 'Producteur du coin', 50, 'assets/images/65577b1db120c.jpg', 1, 10),
(40, 1, 'C&eacute;leri Bio', '6.00', NULL, 'Céleri Bio', 110, 'assets/images/65577ba234375.png', 1, 38),
(41, 1, 'Figue noir Bio', '2.70', NULL, 'Figue noir Bio', 45, 'assets/images/65577bf962584.jpg', 1, 12),
(42, 1, 'Fraise Gariguette Bio', '9.00', NULL, 'Fraise Bio', 90, 'assets/images/655895f3721fa.jpg', 1, 29),
(43, 1, 'Gingembre Bio', '3.00', NULL, 'Epices', 60, 'assets/images/6558963489c46.jpg', 1, 52),
(44, 1, 'Haricot Vert Bio', '8.00', NULL, 'Haricot Vert Bio', 90, 'assets/images/6558968d16775.jpg', 1, 30),
(45, 1, 'Kiwi Bio', '4.00', NULL, 'Kiwi Bio Vert', 100, 'assets/images/655896c44050c.jpg', 1, 15),
(46, 1, 'Litchi Bio', '4.00', NULL, 'Sucré et amer', 120, 'assets/images/6558cc821a3e6.jpg', 1, 21),
(47, 1, 'Mangue Alphonso Bio', '12.00', NULL, 'Bio du sud de l&#039;europe', 123, 'assets/images/6558ccafaae57.jpg', 1, 5),
(48, 1, 'Melon Charentais', '5.90', NULL, 'Du sud du cher', 120, 'assets/images/6558ccdbd7ebd.jpg', 1, 23),
(49, 1, 'Mure Bio', '25.00', NULL, 'Bio Mûre', 330, 'assets/images/6558cd0532a95.jpg', 1, 43),
(50, 1, 'Noix Bio', '10.00', NULL, 'De mon noyers sans Vers', 450, 'assets/images/6558cd2ee35d7.jpg', 1, 49),
(51, 1, 'Oignon Jaune Bio', '15.50', NULL, 'Bio Ca pique les yeux', 120, 'assets/images/6558cd5dafd5a.jpg', 1, 34),
(52, 1, 'Orange Navel Bio', '20.00', NULL, 'Bon pour un jus d&#039;orange', 50, 'assets/images/6558cd8c03b00.jpg', 1, 25),
(53, 1, 'Papaye Bio', '30.00', NULL, 'BIO', 40, 'assets/images/6558cdb8293e1.jpg', 1, 9),
(54, 1, 'Past&egrave;que Bio', '12.50', NULL, 'C&#039;est sans pepins', 50, 'assets/images/6558cdffa519b.jpg', 1, 17),
(55, 1, 'Patate Douce', '12.00', NULL, 'Bon pour les frites', 50, 'assets/images/6558cec9c4e3c.jpg', 1, 4),
(56, 1, 'Poire Williams Bio', '11.00', NULL, 'c&#039;est bon pour la goute', 70, 'assets/images/6558cf07f3b5d.jpg', 1, 7),
(57, 1, 'Poireau', '6.00', NULL, 'Poireaux de mon jardin', 30, 'assets/images/6558cf2c7cca0.jpg', 1, 37),
(58, 1, 'Poivron Jaune Bio', '3.60', NULL, 'C&#039;est pour les Brochettes', 30, 'assets/images/6558cf5f913f7.jpg', 1, 26),
(59, 1, 'Poivron Rouge Bio', '3.50', NULL, 'c&#039;est epice', 40, 'assets/images/6558cf86bf69c.jpg', 1, 20),
(60, 1, 'Pomelo Rose Bio', '9.50', NULL, 'galère a enlever la peau', 20, 'assets/images/6558cfc0c0928.jpg', 1, 11),
(61, 1, 'Pomme Gala Bio', '3.00', NULL, 'Coupe Faim', 40, 'assets/images/6558cff891fb9.jpg', 1, 1),
(62, 1, 'Pomme granny smith Bio', '5.00', NULL, 'Bio Pomme', 40, 'assets/images/6558d0394709e.jpg', 1, 40),
(63, 1, 'Pomme de terre Russet', '6.00', NULL, 'ca vient de mon jardin', 50, 'assets/images/6558d06e20b08.jpg', 1, 22),
(64, 1, 'Prune Jaune Bio', '3.90', NULL, 'Bon pour la bruler', 60, 'assets/images/6558d09ba3507.jpg', 1, 51),
(65, 1, 'Peche de vigne Bio', '2.60', NULL, 'C&#039;est hyper sucre', 30, 'assets/images/6558d0dee5088.jpg', 1, 31),
(66, 1, 'Raisin Thomson Bio', '6.20', NULL, 'Ca vient d&#039;un vigneron locale', 70, 'assets/images/6558d1088e09a.jpg', 1, 19),
(67, 1, 'Rhubarbe Bio', '1.90', NULL, 'Rhubarbe Bio', 50, 'assets/images/6558d138331bd.jpg', 1, 39),
(68, 1, 'Tomate Roma Bio', '5.50', NULL, 'Bio certification', 30, 'assets/images/6558d172ce935.jpeg', 1, 8),
(69, 1, '&Eacute;pinard fraiche Bio', '3.60', NULL, 'bon avec crème', 50, 'assets/images/6558d1af45752.jpg', 1, 14);

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

