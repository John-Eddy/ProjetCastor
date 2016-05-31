-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 31 Mai 2016 à 16:26
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Contenu de la table `fiche_frais`
--

INSERT INTO `fiche_frais` (`id`, `mois`, `dateModif`, `montantValide`, `idVisiteur`, `idEtatFicheFrais`, `dateCreation`, `annee`) VALUES
(31, '04', '2016-04-28 10:39:19', 0, 6, 3, '2016-05-31 10:34:10', '2016'),
(34, '03', '2016-03-31 10:44:58', 0, 6, 3, '2016-03-02 10:44:58', '2016'),
(35, '05', '2016-05-31 11:52:41', 0, 6, 1, '2016-05-31 10:47:04', '2016'),
(36, '04', '2016-04-28 10:56:53', 0, 9, 3, '2016-04-07 10:56:30', '2016'),
(37, '03', '2016-03-23 10:57:51', 0, 9, 3, '2016-03-02 10:57:37', '2016'),
(38, '03', '2016-03-31 11:04:08', 0, 10, 3, '2016-03-02 11:04:08', '2016'),
(39, '04', '2016-04-29 11:05:44', 0, 10, 3, '2016-04-01 11:05:16', '2016'),
(40, '05', '2016-05-31 11:07:57', 0, 10, 1, '2016-05-31 11:07:50', '2016'),
(41, '05', '2016-05-31 11:08:48', 0, 9, 1, '2016-05-31 11:08:40', '2016');

-- --------------------------------------------------------

--
-- Structure de la table `frais_forfait`
--

CREATE TABLE IF NOT EXISTS `frais_forfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelleFraisForfait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `frais_forfait`
--

INSERT INTO `frais_forfait` (`id`, `libelleFraisForfait`, `montant`) VALUES
(1, 'Kilometres', 1.05),
(2, 'Repas Midi', 10),
(3, 'Nuitée', 15),
(4, 'Test', 100);

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
  `date` datetime NOT NULL,
  `montant` double NOT NULL,
  `comentaire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idVisiteur` (`idFraisForfait`),
  KEY `idEtatLigneFrais` (`idEtatLigneFrais`),
  KEY `idFraisForfait` (`idFraisForfait`),
  KEY `idFiche` (`idFicheFrais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;

--
-- Contenu de la table `ligne_frais_forfait`
--

INSERT INTO `ligne_frais_forfait` (`id`, `quantite`, `idFicheFrais`, `idEtatLigneFrais`, `idFraisForfait`, `date`, `montant`, `comentaire`) VALUES
(34, 25, 31, 1, 1, '2016-04-15 00:00:00', 26.25, NULL),
(35, 10, 31, 1, 2, '2016-04-17 00:00:00', 100, NULL),
(36, 1, 31, 1, 3, '2016-04-14 00:00:00', 15, NULL),
(37, 70, 34, 1, 1, '2016-03-31 00:00:00', 73.5, NULL),
(38, 10, 34, 1, 1, '2016-03-31 00:00:00', 10.5, NULL),
(39, 3, 34, 1, 3, '2016-02-26 00:00:00', 45, NULL),
(40, 5, 34, 1, 2, '2016-03-14 00:00:00', 50, NULL),
(41, 50, 35, 3, 1, '2016-05-31 00:00:00', 52.5, NULL),
(45, 5, 36, 1, 2, '2016-04-16 00:00:00', 50, NULL),
(46, 100, 36, 1, 1, '2016-05-31 00:00:00', 105, NULL),
(47, 100, 37, 1, 1, '2016-05-31 00:00:00', 105, NULL),
(48, 3, 37, 1, 3, '2016-05-31 00:00:00', 45, NULL),
(49, 10, 37, 1, 2, '2016-05-31 00:00:00', 100, NULL),
(55, 200, 38, 1, 1, '2016-03-31 00:00:00', 210, NULL),
(56, 10, 38, 1, 2, '2016-05-14 00:00:00', 100, NULL),
(57, 5, 39, 1, 3, '2016-05-31 00:00:00', 75, NULL),
(58, 100, 39, 1, 1, '2016-05-31 00:00:00', 105, NULL),
(59, 10, 40, 3, 2, '2016-05-31 00:00:00', 100, NULL),
(60, 10, 41, 3, 1, '2016-05-31 00:00:00', 10.5, NULL),
(61, 10, 35, 3, 1, '2016-05-31 00:00:00', 10.5, NULL);

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
  `justificatif_id` int(11) DEFAULT NULL,
  `comentaire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EC01626D4B85A991` (`justificatif_id`),
  KEY `idEtatLigneFrais` (`idEtatLigneFrais`),
  KEY `idEtatLigneFrais_2` (`idEtatLigneFrais`),
  KEY `idFicheFrais` (`idFicheFrais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=85 ;

--
-- Contenu de la table `ligne_frais_hors_forfait`
--

INSERT INTO `ligne_frais_hors_forfait` (`id`, `date`, `montant`, `libelleLigneHorsForfait`, `idFicheFrais`, `idEtatLigneFrais`, `justificatif_id`, `comentaire`) VALUES
(81, '2016-05-31', 10, 'Péage', 31, 2, NULL, NULL),
(83, '2016-05-31', 50, 'Billet de train', 39, 2, NULL, NULL),
(84, '2016-05-31', 50, 'Billet de train', 40, 3, NULL, NULL);

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
  UNIQUE KEY `UNIQ_4EA587B8A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_username` (`username_canonical`),
  UNIQUE KEY `UNIQ_email` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(6, 'utilisateur', 'utilisateur', NULL, '00000', 'ville', 'utilisateur', 'utilisateur', 'utilisateur@utilisateur.fr', 'utilisateur@utilisateur.fr', 1, '4qw3q0p6yewww408gso84gg0400wss0', '$2y$13$4qw3q0p6yewww408gso84eZmvFG8EmQX/SecdLRruV3wCEp7Ma5FO', '2016-05-31 11:32:25', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_UTILISATEUR";}', 0, NULL),
(8, 'administrateur', 'administrateur', NULL, '00000', 'ville', 'administrateur', 'administrateur', 'administrateur@administrateur.fr', 'administrateur@administrateur.fr', 1, '1toobk12ap7o0w4s888cwo8g4kok80c', '$2y$13$1toobk12ap7o0w4s888cwe.zawnFR667iSPN7ZORvX.JBJtIaoaI.', '2016-05-31 10:35:35', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL),
(9, 'utilisateur2', 'utilisateur2', NULL, '00000', 'ville', 'utilisateur2', 'utilisateur2', 'utilisateur2@utilisateur.fr', 'utilisateur2@utilisateur.fr', 1, 'q6xv7sxijmok0g4wkg4swowcg80kk0g', '$2y$13$q6xv7sxijmok0g4wkg4swerqVVuWhTFXHGCMtVG.zDB.u.NHgjsM.', '2016-05-31 11:08:39', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_UTILISATEUR";}', 0, NULL),
(10, 'utilisateur3', 'utilisateur3', NULL, '00000', 'ville', 'utilisateur3', 'utilisateur3', 'utilisateur3@utilisateur.fr', 'utilisateur3@utilisateur.fr', 1, 'hazf4oabd4gso0soww0sk44wgs408cc', '$2y$13$hazf4oabd4gso0soww0skusrMHDOgry31dJwiWf/iJ8lEuH3QUVpO', '2016-05-31 11:00:00', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_UTILISATEUR";}', 0, NULL),
(11, 'comptable', 'comptable', NULL, '00000', 'Ville', 'comptable', 'comptable', 'comptable@comptable.fr', 'comptable@comptable.fr', 1, 'ayutaokky9cs0scwwwgc80co8cwc8g8', '$2y$13$ayutaokky9cs0scwwwgc8un5nSlOojVuo.jmcSpMiSYz4hRNlnFmm', '2016-05-31 11:09:00', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_COMPTABLE";}', 0, NULL);

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
