-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : sam. 18 nov. 2023 à 15:02
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

-- --------------------------------------------------------

--
-- Structure de la table `ProduitProducteur`
--

CREATE TABLE `ProduitProducteur` (
  `IdProduitProducteur` int(11) NOT NULL,
  `IsValidateProduitProducteur` tinyint(1) DEFAULT 0,
  `DesignationProduitProducteur` varchar(50) DEFAULT NULL,
  `PrixProduitProducteur` varchar(50) DEFAULT NULL,
  `DateModifPrixProduitProducteur` varchar(32) DEFAULT NULL,
  `DetailsProduitProducteur` varchar(255) DEFAULT NULL,
  `QuantiteProduitProducteur` int(11) DEFAULT NULL,
  `ImageProduitProducteur` varchar(128) DEFAULT NULL,
  `IdProducteurProduitProducteur` int(11) DEFAULT NULL,
  `IdProduitProduitProducteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ProduitProducteur`
--

INSERT INTO `ProduitProducteur` (`IdProduitProducteur`, `IsValidateProduitProducteur`, `DesignationProduitProducteur`, `PrixProduitProducteur`, `DateModifPrixProduitProducteur`, `DetailsProduitProducteur`, `QuantiteProduitProducteur`, `ImageProduitProducteur`, `IdProducteurProduitProducteur`, `IdProduitProduitProducteur`) VALUES
(21, 0, 'Abricot Bergeron Bio', '1.40', NULL, 'Abricot Bergeron Bio', 20, 'assets/images/655776f0669ce.jpg', 1, 35),
(22, 0, 'Ail rose sud de loire', '3.00', NULL, 'ail rose sud de loire', 30, 'assets/images/6557773017d56.jpg', 1, 32),
(24, 0, 'Ananas Victoria', '4.00', NULL, 'BIO', 50, 'assets/images/65577770702d4.jpg', 1, 3),
(25, 0, 'Artichaud violet', '2.00', NULL, 'Bio violet', 40, 'assets/images/655777a0c23c6.jpg', 1, 47),
(26, 0, 'Asperge Verte Bio', '9.00', NULL, 'bon avec de la creme', 70, 'assets/images/655777ee61f3a.jpg', 1, 28),
(27, 0, 'Aubergine Bio Longue', '9.00', NULL, 'Bio Aubergine', 10, 'assets/images/65577813ec8e9.jpg', 1, 16),
(28, 0, 'Banane Cavendish Bio', '12.00', NULL, 'BIO Banane', 60, 'assets/images/65577851efe94.jpg', 1, 13),
(29, 0, 'Brocoli Bio', '4.00', NULL, 'BIO', 60, 'assets/images/6557787507fac.jpg', 1, 6),
(30, 0, 'Carotte orange bio', '6.00', NULL, 'BIO Carotte', 80, 'assets/images/655778a5ed3c3.jpg', 1, 2),
(31, 0, 'du bon cassis sa mere', '4.00', NULL, 'Cassis Bio', 90, 'assets/images/655778c74ae2b.jpg', 1, 46),
(32, 0, 'aromate pot au feu', '2.60', NULL, 'bon pot au feu', 90, 'assets/images/655778f61f970.jpg', 1, 50),
(33, 0, 'Cerise rouge bio', '8.00', NULL, 'Cerise Bio cueillis ce matin', 90, 'assets/images/6557791fb048f.jpg', 1, 27),
(34, 0, 'Champignons de Paris', '12.00', NULL, 'Fait dans les caves de monthou', 90, 'assets/images/6557794b08bd4.jpg', 1, 41),
(35, 0, 'chou-fleur Bio', '7.00', NULL, 'Chou fleur fort en gout', 90, 'assets/images/655779a7b09a3.jpg', 1, 18),
(36, 0, 'Citron Jaune bio', '7.00', NULL, 'Bio Citron', 60, 'assets/images/655779f98c0d3.jpg', 1, 33),
(37, 0, 'Concombre Bio', '5.50', NULL, 'Bio Concombre', 90, 'assets/images/65577a4eae4b9.jpg', 1, 36),
(38, 0, 'Courge butternut bio', '4.00', NULL, 'Pour les soupes', 110, 'assets/images/65577ae81290b.jpg', 1, 24),
(39, 0, 'Courgette verte Bio', '6.00', NULL, 'Producteur du coin', 50, 'assets/images/65577b1db120c.jpg', 1, 10),
(40, 0, 'C&eacute;leri Bio', '6.00', NULL, 'Céleri Bio', 110, 'assets/images/65577ba234375.png', 1, 38),
(41, 0, 'Figue noir Bio', '2.70', NULL, 'Figue noir Bio', 45, 'assets/images/65577bf962584.jpg', 1, 12),
(42, 0, 'Fraise Gariguette Bio', '9.00', NULL, 'Fraise Bio', 90, 'assets/images/655895f3721fa.jpg', 1, 29),
(43, 0, 'Gingembre Bio', '3.00', NULL, 'Epices', 60, 'assets/images/6558963489c46.jpg', 1, 52),
(44, 0, 'Haricot Vert Bio', '8.00', NULL, 'Haricot Vert Bio', 90, 'assets/images/6558968d16775.jpg', 1, 30),
(45, 0, 'Kiwi Bio', '4.00', NULL, 'Kiwi Bio Vert', 100, 'assets/images/655896c44050c.jpg', 1, 15),
(46, 0, 'Litchi Bio', '4.00', NULL, 'Sucré et amer', 120, 'assets/images/6558cc821a3e6.jpg', 1, 21),
(47, 0, 'Mangue Alphonso Bio', '12.00', NULL, 'Bio du sud de l&#039;europe', 123, 'assets/images/6558ccafaae57.jpg', 1, 5),
(48, 0, 'Melon Charentais', '5.90', NULL, 'Du sud du cher', 120, 'assets/images/6558ccdbd7ebd.jpg', 1, 23),
(49, 0, 'Mure Bio', '25.00', NULL, 'Bio Mûre', 330, 'assets/images/6558cd0532a95.jpg', 1, 43),
(50, 0, 'Noix Bio', '10.00', NULL, 'De mon noyers sans Vers', 450, 'assets/images/6558cd2ee35d7.jpg', 1, 49),
(51, 0, 'Oignon Jaune Bio', '15.50', NULL, 'Bio Ca pique les yeux', 120, 'assets/images/6558cd5dafd5a.jpg', 1, 34),
(52, 0, 'Orange Navel Bio', '20.00', NULL, 'Bon pour un jus d&#039;orange', 50, 'assets/images/6558cd8c03b00.jpg', 1, 25),
(53, 0, 'Papaye Bio', '30.00', NULL, 'BIO', 40, 'assets/images/6558cdb8293e1.jpg', 1, 9),
(54, 0, 'Past&egrave;que Bio', '12.50', NULL, 'C&#039;est sans pepins', 50, 'assets/images/6558cdffa519b.jpg', 1, 17),
(55, 0, 'Patate Douce', '12.00', NULL, 'Bon pour les frites', 50, 'assets/images/6558cec9c4e3c.jpg', 1, 4),
(56, 0, 'Poire Williams Bio', '11.00', NULL, 'c&#039;est bon pour la goute', 70, 'assets/images/6558cf07f3b5d.jpg', 1, 7),
(57, 0, 'Poireau', '6.00', NULL, 'Poireaux de mon jardin', 30, 'assets/images/6558cf2c7cca0.jpg', 1, 37),
(58, 0, 'Poivron Jaune Bio', '3.60', NULL, 'C&#039;est pour les Brochettes', 30, 'assets/images/6558cf5f913f7.jpg', 1, 26),
(59, 0, 'Poivron Rouge Bio', '3.50', NULL, 'c&#039;est epice', 40, 'assets/images/6558cf86bf69c.jpg', 1, 20),
(60, 0, 'Pomelo Rose Bio', '9.50', NULL, 'galère a enlever la peau', 20, 'assets/images/6558cfc0c0928.jpg', 1, 11),
(61, 0, 'Pomme Gala Bio', '3.00', NULL, 'Coupe Faim', 40, 'assets/images/6558cff891fb9.jpg', 1, 1),
(62, 0, 'Pomme granny smith Bio', '5.00', NULL, 'Bio Pomme', 40, 'assets/images/6558d0394709e.jpg', 1, 40),
(63, 0, 'Pomme de terre Russet', '6.00', NULL, 'ca vient de mon jardin', 50, 'assets/images/6558d06e20b08.jpg', 1, 22),
(64, 0, 'Prune Jaune Bio', '3.90', NULL, 'Bon pour la bruler', 60, 'assets/images/6558d09ba3507.jpg', 1, 51),
(65, 0, 'Peche de vigne Bio', '2.60', NULL, 'C&#039;est hyper sucre', 30, 'assets/images/6558d0dee5088.jpg', 1, 31),
(66, 0, 'Raisin Thomson Bio', '6.20', NULL, 'Ca vient d&#039;un vigneron locale', 70, 'assets/images/6558d1088e09a.jpg', 1, 19),
(67, 0, 'Rhubarbe Bio', '1.90', NULL, 'Rhubarbe Bio', 50, 'assets/images/6558d138331bd.jpg', 1, 39),
(68, 0, 'Tomate Roma Bio', '5.50', NULL, 'Bio certification', 30, 'assets/images/6558d172ce935.jpeg', 1, 8),
(69, 0, '&Eacute;pinard fraiche Bio', '3.60', NULL, 'bon avec crème', 50, 'assets/images/6558d1af45752.jpg', 1, 14);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ProduitProducteur`
--
ALTER TABLE `ProduitProducteur`
  ADD PRIMARY KEY (`IdProduitProducteur`),
  ADD KEY `FK_ProduitProducteur_Producteur` (`IdProducteurProduitProducteur`),
  ADD KEY `FK_ProduitProducteur_Produit` (`IdProduitProduitProducteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ProduitProducteur`
--
ALTER TABLE `ProduitProducteur`
  MODIFY `IdProduitProducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ProduitProducteur`
--
ALTER TABLE `ProduitProducteur`
  ADD CONSTRAINT `FK_ProduitProducteur_Producteur` FOREIGN KEY (`IdProducteurProduitProducteur`) REFERENCES `Producteur` (`IdProducteur`),
  ADD CONSTRAINT `FK_ProduitProducteur_Produit` FOREIGN KEY (`IdProduitProduitProducteur`) REFERENCES `Produit` (`IdProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
