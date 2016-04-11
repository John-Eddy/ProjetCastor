-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2016 at 09:43 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gsb`
--

-- --------------------------------------------------------

--
-- Table structure for table `etat_fiche_frais`
--

CREATE TABLE IF NOT EXISTS `etat_fiche_frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `etat_fiche_frais`
--

INSERT INTO `etat_fiche_frais` (`id`, `libelle`) VALUES
(1, 'Fiche créée, saisie en cours'),
(2, 'Saisie clôturée'),
(3, 'Validée et mise en paiement'),
(4, 'Remboursé');

-- --------------------------------------------------------

--
-- Table structure for table `etat_ligne_frais`
--

CREATE TABLE IF NOT EXISTS `etat_ligne_frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelleEtatLigneFrais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `etat_ligne_frais`
--

INSERT INTO `etat_ligne_frais` (`id`, `libelleEtatLigneFrais`) VALUES
(1, 'Valide'),
(2, 'Non valide'),
(3, 'Enregistré');

-- --------------------------------------------------------

--
-- Table structure for table `fiche_frais`
--

CREATE TABLE IF NOT EXISTS `fiche_frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mois` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `dateModif` datetime NOT NULL,
  `montantValide` double NOT NULL,
  `idVisiteur` int(11) DEFAULT NULL,
  `idEtatFicheFrais` int(11) DEFAULT NULL,
  `dateCreation` datetime NOT NULL,
  `annee` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEtatFicheFrais` (`idEtatFicheFrais`),
  KEY `idVisiteur` (`idVisiteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `fiche_frais`
--

INSERT INTO `fiche_frais` (`id`, `mois`, `dateModif`, `montantValide`, `idVisiteur`, `idEtatFicheFrais`, `dateCreation`, `annee`) VALUES
(11, '03', '2016-04-06 10:49:34', 154, 1, 2, '2016-03-22 11:50:52', '2016'),
(12, '02', '2016-04-06 10:43:18', 551, 1, 2, '2016-02-03 00:00:00', '2016'),
(13, '04', '2016-04-05 14:05:53', 0, 2, 1, '2016-04-05 14:05:53', '2016'),
(14, '04', '2016-04-06 10:52:36', 0, 1, 1, '2016-04-06 09:11:24', '2016');

-- --------------------------------------------------------

--
-- Table structure for table `frais_forfait`
--

CREATE TABLE IF NOT EXISTS `frais_forfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelleFraisForfait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `frais_forfait`
--

INSERT INTO `frais_forfait` (`id`, `libelleFraisForfait`, `montant`) VALUES
(1, 'Kilometres', 1),
(2, 'Repas Midi', 10),
(3, 'Nuitée', 15);

-- --------------------------------------------------------

--
-- Table structure for table `justificatif`
--

CREATE TABLE IF NOT EXISTS `justificatif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idlignefrais` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_90D3C5DCAFC41D3B` (`idlignefrais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ligne_frais_forfait`
--

CREATE TABLE IF NOT EXISTS `ligne_frais_forfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` double NOT NULL,
  `idFicheFrais` int(11) DEFAULT NULL,
  `idEtatLigneFrais` int(11) DEFAULT NULL,
  `idFraisForfait` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `montant` double NOT NULL,
  `comentaire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idVisiteur` (`idFraisForfait`),
  KEY `idEtatLigneFrais` (`idEtatLigneFrais`),
  KEY `idFraisForfait` (`idFraisForfait`),
  KEY `idFiche` (`idFicheFrais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `ligne_frais_forfait`
--

INSERT INTO `ligne_frais_forfait` (`id`, `quantite`, `idFicheFrais`, `idEtatLigneFrais`, `idFraisForfait`, `date`, `montant`, `comentaire`) VALUES
(11, 444, NULL, 3, 1, '2016-03-23 00:00:00', 444, NULL),
(12, 444, NULL, 3, 1, '2016-03-23 00:00:00', 444, NULL),
(13, 444, NULL, 3, 1, '2016-03-23 00:00:00', 444, NULL),
(14, 444, NULL, 3, 1, '2016-03-23 00:00:00', 444, NULL),
(15, 1, 12, 1, 3, '2016-03-23 00:00:00', 45, NULL),
(16, 456, 12, 1, 1, '2016-03-23 00:00:00', 456, NULL),
(17, 3, 12, 2, 2, '2016-03-24 00:00:00', 23456, NULL),
(18, 345, 12, 2, 1, '2016-03-24 00:00:00', 345, NULL),
(22, 3, 11, 2, 2, '2016-03-31 00:00:00', 30, NULL),
(23, 120, 11, 1, 1, '2016-03-31 00:00:00', 120, NULL),
(24, 56, 14, 3, 1, '2016-04-06 00:00:00', 56, 'Test Commentaire modif 2'),
(25, 34, 14, 3, 1, '2016-04-06 00:00:00', 34, 'Test 2');

-- --------------------------------------------------------

--
-- Table structure for table `ligne_frais_hors_forfait`
--

CREATE TABLE IF NOT EXISTS `ligne_frais_hors_forfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `montant` double NOT NULL,
  `libelleLigneHorsForfait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idFicheFrais` int(11) DEFAULT NULL,
  `idEtatLigneFrais` int(11) DEFAULT NULL,
  `justificatif_id` int(11) DEFAULT NULL,
  `comentaire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EC01626D4B85A991` (`justificatif_id`),
  KEY `idEtatLigneFrais` (`idEtatLigneFrais`),
  KEY `idEtatLigneFrais_2` (`idEtatLigneFrais`),
  KEY `idFicheFrais` (`idFicheFrais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

--
-- Dumping data for table `ligne_frais_hors_forfait`
--

INSERT INTO `ligne_frais_hors_forfait` (`id`, `date`, `montant`, `libelleLigneHorsForfait`, `idFicheFrais`, `idEtatLigneFrais`, `justificatif_id`, `comentaire`) VALUES
(75, '2016-01-01', 34, 'Péage', 11, 1, NULL, NULL),
(77, '2016-03-08', 50, 'Test', 12, 1, NULL, NULL),
(78, '2016-04-06', 46, 'test', 14, 3, NULL, 'Test commentaire');

-- --------------------------------------------------------

--
-- Table structure for table `visiteur`
--

CREATE TABLE IF NOT EXISTS `visiteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4EA587B892FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_4EA587B8A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_username` (`username_canonical`),
  UNIQUE KEY `UNIQ_email` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'Rahmani', 'Eddy', NULL, '38260', 'Champier', 'e.rahmani', 'e.rahmani', 'rahmanieddy@gmail.com', 'rahmanieddy@gmail.com', 1, 'l5arkn7zrdw4o8og88wwgogoccg4swk', '$2y$13$l5arkn7zrdw4o8og88wwgecTDDG65Oy0KOX92aUYQwSqTZUytpeXe', '2016-04-06 10:51:33', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_UTILISATEUR";}', 0, NULL),
(2, 'Vigier', 'cedric', NULL, '69120', 'VAULX EN VELIN', 'c.vigier', 'c.vigier', 'vigier.e@wanadoo.fr', 'vigier.e@wanadoo.fr', 1, '8m7f628zcrs4ogwwwkgkww4wsco84ww', '$2y$13$8m7f628zcrs4ogwwwkgkwuWCUEniOghSgM9CfwxTvIvtGfGfacIWa', '2016-04-11 21:32:45', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL),
(3, 'Abdelkassa', 'Liza', NULL, '69007', 'Lyon', 'l.abdelkassa', 'l.abdelkassa', 'liza@email.fr', 'liza@email.fr', 1, 'lkhzlphanb40c8gskcwokscgo40gs4o', '$2y$13$lkhzlphanb40c8gskcwokeqOAympM29Mml3.Gci4ukNU3cstswMNK', '2016-04-06 10:47:59', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_COMPTABLE";}', 0, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  ADD CONSTRAINT `FK_5FC0A6A71D06ADE3` FOREIGN KEY (`idVisiteur`) REFERENCES `visiteur` (`id`),
  ADD CONSTRAINT `FK_5FC0A6A77D5B89BE` FOREIGN KEY (`idEtatFicheFrais`) REFERENCES `etat_fiche_frais` (`id`);

--
-- Constraints for table `justificatif`
--
ALTER TABLE `justificatif`
  ADD CONSTRAINT `FK_90D3C5DCAFC41D3B` FOREIGN KEY (`idlignefrais`) REFERENCES `ligne_frais_hors_forfait` (`id`);

--
-- Constraints for table `ligne_frais_forfait`
--
ALTER TABLE `ligne_frais_forfait`
  ADD CONSTRAINT `FK_BD293ECF4134ACE6` FOREIGN KEY (`idFraisForfait`) REFERENCES `frais_forfait` (`id`),
  ADD CONSTRAINT `FK_BD293ECF8DE322B7` FOREIGN KEY (`idEtatLigneFrais`) REFERENCES `etat_ligne_frais` (`id`),
  ADD CONSTRAINT `FK_BD293ECFD1E09AE6` FOREIGN KEY (`idFicheFrais`) REFERENCES `fiche_frais` (`id`);

--
-- Constraints for table `ligne_frais_hors_forfait`
--
ALTER TABLE `ligne_frais_hors_forfait`
  ADD CONSTRAINT `FK_EC01626D4B85A991` FOREIGN KEY (`justificatif_id`) REFERENCES `justificatif` (`id`),
  ADD CONSTRAINT `FK_EC01626D8DE322B7` FOREIGN KEY (`idEtatLigneFrais`) REFERENCES `etat_ligne_frais` (`id`),
  ADD CONSTRAINT `FK_EC01626DD1E09AE6` FOREIGN KEY (`idFicheFrais`) REFERENCES `fiche_frais` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
