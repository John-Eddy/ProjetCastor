-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 16 Décembre 2015 à 13:22
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `etat_ligne_frais`
--

INSERT INTO `etat_ligne_frais` (`id`, `libelleEtatLigneFrais`) VALUES
(1, 'Valide'),
(2, 'Non valide');

-- --------------------------------------------------------

--
-- Structure de la table `fiche_frais`
--

CREATE TABLE IF NOT EXISTS `fiche_frais` (
  `idVisiteur` int(11) NOT NULL,
  `mois` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `idEtatFicheFrais` int(11) NOT NULL,
  `montantValide` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateModif` datetime NOT NULL,
  PRIMARY KEY (`idVisiteur`,`mois`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fiche_frais`
--

INSERT INTO `fiche_frais` (`idVisiteur`, `mois`, `idEtatFicheFrais`, `montantValide`, `dateModif`) VALUES
(6, '072015', 4, '', '2015-07-30 00:00:00'),
(6, '082015', 3, '', '2015-08-30 00:00:00'),
(6, '092015', 3, '', '2015-09-30 00:00:00'),
(6, '102015', 3, '', '2015-10-22 00:00:00'),
(6, '112015', 2, '', '2015-11-26 00:00:00'),
(6, '122015', 1, '', '2015-12-09 00:00:00');

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
  `idVisiteur` int(11) NOT NULL,
  `mois` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `idFraisForfait` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `idEtatLigneFrais` int(11) NOT NULL,
  PRIMARY KEY (`idVisiteur`,`mois`,`idFraisForfait`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ligne_frais_forfait`
--

INSERT INTO `ligne_frais_forfait` (`idVisiteur`, `mois`, `idFraisForfait`, `quantite`, `idEtatLigneFrais`) VALUES
(6, '112015', 1, 5, 1),
(6, '112015', 2, 7, 1),
(6, '112015', 3, 10, 1),
(6, '122015', 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_frais_hors_forfait`
--

CREATE TABLE IF NOT EXISTS `ligne_frais_hors_forfait` (
  `num` int(11) NOT NULL,
  `idVisiteur` int(11) NOT NULL,
  `mois` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `idEtatLigneFrais` int(11) NOT NULL,
  `date` date NOT NULL,
  `montant` double NOT NULL,
  `libelleLigneHorsForfait` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`num`,`idVisiteur`,`mois`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ligne_frais_hors_forfait`
--

INSERT INTO `ligne_frais_hors_forfait` (`num`, `idVisiteur`, `mois`, `idEtatLigneFrais`, `date`, `montant`, `libelleLigneHorsForfait`) VALUES
(1, 6, '112015', 1, '2015-11-12', 25, 'Péage'),
(2, 6, '112015', 2, '2015-11-11', 100, 'aaaaaaaaaaaaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE IF NOT EXISTS `visiteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `password`, `adresse`, `cp`, `ville`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(6, 'Rahmani', 'Eddy', '$2y$13$lanyk3goolwskc44w8gooeV5.ulCa/yAzAvF.iER3db3UMgxti20.', '', '38260', 'Champier', 'e.rahmani', 'e.rahmani', 'abs@abs.fr', 'abs@abs.fr', 1, 'lanyk3goolwskc44w8goos4gwg4c804', '2015-12-16 13:16:10', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_UTILISATEUR";}', 0, NULL),
(7, 'Abd', 'Liza', '$2y$13$4x8cwuvbwe4goo4gcw0s8eVO8xsTOAXRBI6S.dDR6SVsbG7skASMW', NULL, '69007', 'Lyon', 'l.abd', 'l.abd', 'l.zdf@zd.fr', 'l.zdf@zd.fr', 1, '4x8cwuvbwe4goo4gcw0s8s880cs0kos', '2015-12-14 15:46:00', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
