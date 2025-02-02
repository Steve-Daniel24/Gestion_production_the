CREATE DATABASE IF NOT EXISTS `gestion_the` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;


USE `gestion_the`;

DROP TABLE IF EXISTS `paiements_cueilleurs`;
DROP TABLE IF EXISTS `depenses`;
DROP TABLE IF EXISTS `cueillettes`;
DROP TABLE IF EXISTS `saisons_recolte`;
DROP TABLE IF EXISTS `configuration`;
DROP TABLE IF EXISTS `categories_depense`;
DROP TABLE IF EXISTS `cueilleurs`;
DROP TABLE IF EXISTS `parcelles`;
DROP TABLE IF EXISTS `varietes_the`;
DROP TABLE IF EXISTS `utilisateurs`;
DROP TABLE IF EXISTS `admin`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `varietes_the` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `surface_pied` decimal(4,2) NOT NULL,
  `rendement_pied` decimal(5,2) NOT NULL,
  `prix_vente` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `parcelles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(20) NOT NULL,
  `surface` decimal(10,2) NOT NULL,
  `variete_the_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parcelles_variete` (`variete_the_id`),
  CONSTRAINT `fk_parcelles_variete` FOREIGN KEY (`variete_the_id`) REFERENCES `varietes_the` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cueilleurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `genre` enum('M','F') NOT NULL,
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `categories_depense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salaire_kg` decimal(10,2) NOT NULL,
  `poids_minimal` decimal(5,2) NOT NULL,
  `bonus_pourcentage` decimal(5,2) NOT NULL,
  `malus_pourcentage` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `saisons_recolte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mois` int(2) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mois` (`mois`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cueillettes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `cueilleur_id` int(11) NOT NULL,
  `parcelle_id` int(11) NOT NULL,
  `poids` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cueillettes_cueilleur` (`cueilleur_id`),
  KEY `fk_cueillettes_parcelle` (`parcelle_id`),
  CONSTRAINT `fk_cueillettes_cueilleur` FOREIGN KEY (`cueilleur_id`) REFERENCES `cueilleurs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_cueillettes_parcelle` FOREIGN KEY (`parcelle_id`) REFERENCES `parcelles` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `depenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_depenses_categorie` (`categorie_id`),
  CONSTRAINT `fk_depenses_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories_depense` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `paiements_cueilleurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cueillette_id` int(11) NOT NULL,
  `bonus_pourcentage` decimal(5,2) DEFAULT NULL,
  `malus_pourcentage` decimal(5,2) DEFAULT NULL,
  `montant_paiement` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_paiements_cueillette` (`cueillette_id`),
  CONSTRAINT `fk_paiements_cueillette` FOREIGN KEY (`cueillette_id`) REFERENCES `cueillettes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `configuration` ADD COLUMN `actif` TINYINT(1) NOT NULL DEFAULT 0;
UPDATE `configuration` SET `actif` = 0 WHERE `actif` = 1;
INSERT INTO `configuration` (`salaire_kg`, `poids_minimal`, `bonus_pourcentage`, `malus_pourcentage`, `actif`) 
VALUES (500, 10.00, 5.00, 3.00, 1);
