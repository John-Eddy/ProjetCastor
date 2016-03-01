-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 01 Mars 2016 à 09:25
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat_fiche_frais`
--

CREATE TABLE IF NOT EXISTS `etat_fiche_frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `etat_fiche_frais`
--

INSERT INTO `etat_fiche_frais` (`id`, `libelle`) VALUES
(1, 'Fiche créée, saisie en cours'),
(2, 'Saisie clôturée'),
(3, 'Validée et mise en paiement'),
(4, 'Remboursé');

-- --------------------------------------------------------

--
-- Structure de la table `etat_ligne_frais`
--

CREATE TABLE IF NOT EXISTS `etat_ligne_frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelleEtatLigneFrais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `etat_ligne_frais`
--

INSERT INTO `etat_ligne_frais` (`id`, `libelleEtatLigneFrais`) VALUES
(1, 'Valide'),
(2, 'Non valide'),
(3, 'Enregistré');

-- --------------------------------------------------------

--
-- Structure de la table `fiche_frais`
--

CREATE TABLE IF NOT EXISTS `fiche_frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mois` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `dateModif` datetime NOT NULL,
  `montantValide` double NOT NULL,
  `idVisiteur` int(11) DEFAULT NULL,
  `idEtatFicheFrais` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEtatFicheFrais` (`idEtatFicheFrais`),
  KEY `idVisiteur` (`idVisiteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `fiche_frais`
--

INSERT INTO `fiche_frais` (`id`, `mois`, `dateModif`, `montantValide`, `idVisiteur`, `idEtatFicheFrais`) VALUES
(2, '022016', '2016-02-29 17:19:55', 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `frais_forfait`
--

CREATE TABLE IF NOT EXISTS `frais_forfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelleFraisForfait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `frais_forfait`
--

INSERT INTO `frais_forfait` (`id`, `libelleFraisForfait`, `montant`) VALUES
(1, 'Kilometres', 1),
(2, 'Repas Midi', 10),
(3, 'Nuitée', 15);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_frais_forfait`
--

CREATE TABLE IF NOT EXISTS `ligne_frais_forfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` double NOT NULL,
  `idFicheFrais` int(11) DEFAULT NULL,
  `idEtatLigneFrais` int(11) DEFAULT NULL,
  `idFraisForfait` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idVisiteur` (`idFraisForfait`),
  KEY `idEtatLigneFrais` (`idEtatLigneFrais`),
  KEY `idFraisForfait` (`idFraisForfait`),
  KEY `idFiche` (`idFicheFrais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ligne_frais_forfait`
--

INSERT INTO `ligne_frais_forfait` (`id`, `quantite`, `idFicheFrais`, `idEtatLigneFrais`, `idFraisForfait`) VALUES
(1, 67, 2, 3, 1),
(2, 5, 2, 3, 2),
(3, 2, 2, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_frais_hors_forfait`
--

CREATE TABLE IF NOT EXISTS `ligne_frais_hors_forfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `montant` double NOT NULL,
  `libelleLigneHorsForfait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idFicheFrais` int(11) DEFAULT NULL,
  `idEtatLigneFrais` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEtatLigneFrais` (`idEtatLigneFrais`),
  KEY `idEtatLigneFrais_2` (`idEtatLigneFrais`),
  KEY `idFicheFrais` (`idFicheFrais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ligne_frais_hors_forfait`
--

INSERT INTO `ligne_frais_hors_forfait` (`id`, `date`, `montant`, `libelleLigneHorsForfait`, `idFicheFrais`, `idEtatLigneFrais`) VALUES
(1, '2016-02-04', 34, 'Pneu', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
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
  UNIQUE KEY `UNIQ_4EA587B8A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'Rahmani', 'Eddy', NULL, '38260', 'Champier', 'e.rahmani', 'e.rahmani', 'rahmanieddy@gmail.com', 'rahmanieddy@gmail.com', 1, 'l5arkn7zrdw4o8og88wwgogoccg4swk', '$2y$13$l5arkn7zrdw4o8og88wwgecTDDG65Oy0KOX92aUYQwSqTZUytpeXe', '2016-02-29 10:24:21', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  ADD CONSTRAINT `FK_5FC0A6A71D06ADE3` FOREIGN KEY (`idVisiteur`) REFERENCES `visiteur` (`id`),
  ADD CONSTRAINT `FK_5FC0A6A77D5B89BE` FOREIGN KEY (`idEtatFicheFrais`) REFERENCES `etat_fiche_frais` (`id`);

--
-- Contraintes pour la table `ligne_frais_forfait`
--
ALTER TABLE `ligne_frais_forfait`
  ADD CONSTRAINT `FK_BD293ECF4134ACE6` FOREIGN KEY (`idFraisForfait`) REFERENCES `frais_forfait` (`id`),
  ADD CONSTRAINT `FK_BD293ECF8DE322B7` FOREIGN KEY (`idEtatLigneFrais`) REFERENCES `etat_ligne_frais` (`id`),
  ADD CONSTRAINT `FK_BD293ECFD1E09AE6` FOREIGN KEY (`idFicheFrais`) REFERENCES `fiche_frais` (`id`);

--
-- Contraintes pour la table `ligne_frais_hors_forfait`
--
ALTER TABLE `ligne_frais_hors_forfait`
  ADD CONSTRAINT `FK_EC01626D8DE322B7` FOREIGN KEY (`idEtatLigneFrais`) REFERENCES `etat_ligne_frais` (`id`),
  ADD CONSTRAINT `FK_EC01626DD1E09AE6` FOREIGN KEY (`idFicheFrais`) REFERENCES `fiche_frais` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
