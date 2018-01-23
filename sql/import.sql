-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2015 at 03:56 PM
-- Server version: 5.5.41
-- PHP Version: 5.5.23-1+deb.sury.org~precise+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `university_adm`
--

-- --------------------------------------------------------

--
-- Table structure for table `activite`
--

CREATE SCHEMA IF NOT EXISTS `university_adm` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `university_adm`;

CREATE TABLE IF NOT EXISTS `university_adm`.`activite` (
  `id_act` int(100) NOT NULL AUTO_INCREMENT,
  `titre_act` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ordre` int(1) NOT NULL,
  `indicA` varchar(2) CHARACTER SET utf8 NOT NULL DEFAULT 'No',
  `ad_act` varchar(100) CHARACTER SET utf8 NOT NULL,
  `utilisateur_creation` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_act`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `activite`
--

INSERT INTO `university_adm`.`activite` (`id_act`, `titre_act`, `ordre`, `indicA`, `ad_act`, `utilisateur_creation`, `date_creation`) VALUES
(1, 'Activite n°1', 1, 'Ok', 'ACTIVITY1_DUMMY.zip', '', '0000-00-00'),
(2, 'Activité n°2', 2, 'Ok', 'ACTIVITY2_DUMMY.zip', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `activites_par_module`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`activites_par_module` (
  `id_act` int(100) NOT NULL,
  `code_semestre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `code_module` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_act`,`code_module`,`code_semestre`),
  UNIQUE KEY `id_act` (`id_act`),
  KEY `fk_activites_module` (`code_module`,`code_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`administrateur` (
  `id_admin` int(100) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(100) NOT NULL,
  `nom_admin` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom_admin` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(100) CHARACTER SET utf8 NOT NULL,
  `addresse_postale` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date_entree` date NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `fk_admin_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `university_adm`.`administrateur` (`id_admin`, `id_utilisateur`, `nom_admin`, `prenom_admin`, `email`, `telephone`, `addresse_postale`, `date_entree`) VALUES
(1, 2, '', 'Administrateur', 'rodc87@gmail.com', 'telephone', 'addresse', '2015-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`categorie` (
  `id_cat` int(1) NOT NULL,
  `categorie` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `university_adm`.`categorie` (`id_cat`, `categorie`) VALUES
(1, 'Mathématiques appliquées'),
(2, 'Informatique'),
(3, 'Ingénierie des systèmes d''information'),
(4, 'Gestion et organisation'),
(5, 'Expression et communication'),
(6, 'Professionnalisation');

-- --------------------------------------------------------

--
-- Table structure for table `centre`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`centre` (
  `id_centre` int(3) NOT NULL AUTO_INCREMENT,
  `nom_centre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ville` varchar(40) CHARACTER SET utf8 NOT NULL,
  `pays` varchar(40) CHARACTER SET utf8 NOT NULL,
  `id_corr` int(2) NOT NULL DEFAULT '0',
  `correspondant` varchar(40) CHARACTER SET utf8 NOT NULL,
  `resp_admin` varchar(40) CHARACTER SET utf8 NOT NULL,
  `nature` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_centre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `centre`
--

INSERT INTO `university_adm`.`centre` (`id_centre`, `nom_centre`, `ville`, `pays`, `id_corr`, `correspondant`, `resp_admin`, `nature`) VALUES
(1, 'Université de Picardie Jules Verne', 'Amiens', 'France', 5, 'Correspondant', 'Resp_admin', 'centre de référence'),
(2, 'Université Claude Bernard Lyon 1', 'Lyon', 'France', 2, 'Correspondant', 'Resp_admin', 'centre de référence'),
(3, 'Université de Rennes 1', 'Rennes', 'France', 0, 'Correspondant', 'Resp_admin', 'centre de référence'),
(4, 'Université Paul Sabatier Toulouse 3', 'Toulouse', 'France', 44, 'Correspondant', 'Resp_admin', 'centre de référence'),
(5, 'Université d''Orléans', 'Orléans', 'France', 95, '', 'Resp_admin', 'centre de référence'),
(6, 'Université de Bordeaux', 'Bordeaux', 'France', 132, '', 'Resp_admin', 'centre de référence'),
(7, 'Université de Nantes', 'Nantes', 'France', 89, '', 'Resp_admin', 'centre de référence'),
(8, 'Université de Ouagadougou', 'Ouagadougou', 'Burkina Faso', 47, 'Correspondant', 'Resp_admin', 'centre associé'),
(9, 'Université Abdelmalek Essaâdi Tanger-Tétouan', 'Tétouan', 'Maroc', 48, 'Correspondant', 'Resp_admin', 'centre associé'),
(10, 'Ecole Supérieure de Management Appliqué Marrakech', 'Marrakech', 'Maroc', 166, 'Correspondant', 'Resp_admin', 'centre associé'),
(11, 'Université Sidi Mohamed Ben Abdallah Fès', 'Fès', 'Maroc', 49, 'Correspondant', 'Resp_admin', 'centre associé'),
(12, 'Université de Djibouti', 'Djibouti', 'Djibouti', 0, 'Correspondant', 'Resp_admin', 'centre associé'),
(13, 'Universidad San Martin de Porres Lima', 'Lima', 'Pérou', 6, 'Correspondant', 'Resp_admin', 'centre associé'),
(14, 'Ecole Supérieure d''Infotronique de Haïti', 'Port au Prince', 'Haïti', 0, 'Correspondant', 'Resp_admin', 'centre associé'),
(15, 'Centre de Rabat', 'Rabat', 'Maroc', 11, 'Correspondant', 'Resp_admin', 'centre associé de Lyon');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`documents` (
  `id_document` int(100) NOT NULL AUTO_INCREMENT,
  `nom_document` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description_document` varchar(250) CHARACTER SET utf8 NOT NULL,
  `type_document` varchar(100) CHARACTER SET utf8 NOT NULL,
  `document` blob,
  `utilisateur_creation` date NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_document`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`etudiant` (
  `id_etudiant` int(100) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(100) NOT NULL,
  `nom_etudiant` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom_etudiant` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(100) CHARACTER SET utf8 NOT NULL,
  `addresse_postale` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date_entree` date NOT NULL,
  `niveau_etudes` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_etudiant`),
  KEY `fk_etu_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `university_adm`.`etudiant` (`id_etudiant`, `id_utilisateur`, `nom_etudiant`, `prenom_etudiant`, `email`, `telephone`, `addresse_postale`, `date_entree`, `niveau_etudes`) VALUES
(1, 5, 'Etudiant1 Nom', 'Etudiant1 Prenom', 'rodc87@gmail.com', 'telephone', 'Addresse', '2015-05-01', 'M2-EMIAGE'),
(2, 6, 'Etudiant2 Nom', 'Etudiant2 Prenom', 'rodc87@gmail.com', 'telephone', 'Addresse', '2015-05-01', 'M2-EMIAGE');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant_centre`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`etudiant_centre` (
  `id_etudiant` int(100) NOT NULL,
  `id_centre` int(3) NOT NULL,
  PRIMARY KEY (`id_etudiant`,`id_centre`),
  KEY `fk_etu_centre` (`id_centre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `university_adm`.`etudiant_centre` (`id_etudiant`, `id_centre`) VALUES
(1,2),
(2,1);

--
-- Table structure for table `etudiant_choix_modules`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`etudiant_choix_modules` (
  `id_etudiant` int(100) NOT NULL,
  `code_semestre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `code_module` varchar(50) CHARACTER SET utf8 NOT NULL,
  `date_inscription_choix` date NOT NULL,
  PRIMARY KEY (`id_etudiant`,`code_semestre`,`code_module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etudiant_choix_modules`
--

INSERT INTO `university_adm`.`etudiant_choix_modules` (`id_etudiant`, `code_semestre`, `code_module`, `date_inscription_choix`) VALUES
(1, '2015S2', 'A402', '2015-06-01'),
(1, '2015S2', 'C107', '2015-06-01'),
(1, '2015S2', 'C307', '2015-06-01'),
(1, '2015S2', 'C409', '2015-06-01'),
(1, '2015S2', 'D111', '2015-06-01'),
(2, '2015S1', 'A402', '2015-05-21'),
(2, '2015S1', 'C107', '2015-05-21'),
(2, '2015S2', 'C107', '2015-05-30'),
(2, '2015S2', 'C307', '2015-05-30'),
(2, '2015S2', 'C409', '2015-05-30'),
(2, '2015S2', 'D111', '2015-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant_examens`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`etudiant_examens` (
  `id_etudiant` int(100) NOT NULL,
  `code_semestre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `code_module` varchar(50) CHARACTER SET utf8 NOT NULL,
  `copie_examen` blob,
  `presence_examen` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id_centre` int(3) NOT NULL,
  `date_inscription_examen` date NOT NULL,
  `date_upload_examen` date NOT NULL,
  `date_correction_examen` date NOT NULL,
  `correcteur_examen` varchar(50) CHARACTER SET utf8 NOT NULL,
  `note_examen` int(100) NOT NULL,
  `note_apres_pv` int(100) NOT NULL,
  PRIMARY KEY (`id_etudiant`,`code_semestre`,`code_module`,`id_centre`),
  KEY `id_centre` (`id_centre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `examen`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`examen` (
  `code_module` varchar(50) CHARACTER SET utf8 NOT NULL,
  `code_semestre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `date_creation` date NOT NULL,
  `utilisateur_creation` varchar(50) CHARACTER SET utf8 NOT NULL,
  `date_passage` date NOT NULL,
  PRIMARY KEY (`code_module`,`code_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`module` (
  `code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nom_module` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id_cat` int(1) NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `UNQ_Categorie` (`code`,`id_cat`),
  KEY `indx_id_cat` (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `university_adm`.`module` (`code`, `nom_module`, `id_cat`) VALUES
('A102', 'Mathématiques de l''informatique', 1),
('A110', 'Mathématiques financières', 1),
('A203', 'Concepts de base des systèmes informatiques', 2),
('A204', 'Programmation en C', 2),
('A205', 'Bases d''algorithmique', 2),
('A206', 'Programmation COBOL', 2),
('A402', 'Organisations et systèmes d''information', 4),
('A403', 'Sous-système comptable', 4),
('A502', 'Anglais', 5),
('B103', 'Probablités', 1),
('B104', 'Théorie des graphes et combinatoire', 1),
('B105', 'Programmation mathématique et optimisation', 1),
('B109', 'Analyse numérique', 1),
('B112', 'Statistiques', 1),
('B208', 'Systèmes informatiques', 2),
('B209', 'Théorie des langages', 2),
('B210', 'Bases de données relationnelles', 2),
('B211C', 'Programmation orientée objet (C++)', 2),
('B211J', 'Programmation orientée objet (Java)', 2),
('B212', 'Programmation événementielle et interface homme-machine', 2),
('B213C', 'Projets de programmation (C++)', 2),
('B213J', 'Projets de programmation (Java)', 2),
('B222', 'Bases de télécommunication', 2),
('B223', 'Bases d''UNIX', 2),
('B302', 'Méthodes systémiques d''analyse et de conception', 3),
('B303', 'Gestion de projet', 3),
('B304', 'Projets de conception', 3),
('B404', 'Droit', 4),
('B405', 'Marketing', 4),
('B406', 'Gestion des ressources humaines', 4),
('B407', 'Gestion de production', 4),
('B504', 'Anglais', 5),
('B508', 'Espagnol', 5),
('B509', 'Etudes et recherches', 5),
('B602', 'Professionnalisation', 6),
('C106', 'Analyse et fouille de données', 1),
('C107', 'Processus stochastiques et simulation', 1),
('C214', 'Réseaux et protocoles', 2),
('C215', 'Bases de données avancées', 2),
('C216', 'Architecture client-serveur', 2),
('C217', 'Techniques de base de l''intelligence artificielle', 2),
('C218', 'Projet de programmation', 2),
('C224', 'UNIX avancé', 2),
('C305', 'Méthodes orientées objet d''analyse et de conception', 3),
('C306', 'Ingénierie du logiciel', 3),
('C307', 'Intégration d''applications', 3),
('C308', 'Projets', 3),
('C409', 'Analyse financière et contrôle de gestion', 4),
('C410', 'Jeu d''entreprise', 4),
('C507', 'Anglais', 5),
('C510', 'Etudes et recherche', 5),
('C603', 'Professionnalisation', 6),
('C606', 'C2i2mi (C2i niv 2 métiers de l''ingénieur)', 6),
('D111', 'Entrepôts de données', 2),
('D112', 'Théorie des jeux', 1),
('D219', 'Hauts débits et nomadisme', 2),
('D220', 'Objets répartis', 2),
('D225', 'Administration des réseaux', 2),
('D226', 'Image numérique', 2),
('D227', 'Technologies récentes des réseaux', 2),
('D228', 'Développement d\\''applications pour terminaux mobiles', 2),
('D229', 'Multimédia et réseaux', 2),
('D230', 'Géomatique', 2),
('D231', 'Outils de développement Web et multimédia', 2),
('D232', 'Analyse multidimensionnelle et datamining', 2),
('D310', 'Ingénierie et management des connaissances', 3),
('D312', 'Sécurité des systèmes d''information', 3),
('D313', 'Commerce électronique', 4),
('D314', 'Ingénierie des systèmes à base de services Web', 2),
('D316', 'Conception de jeux vidéo', 3),
('D317', 'Conduite de projets multimédias', 3),
('D318', 'Méthodologies de développement', 3),
('D412', 'Stratégie d''entreprise', 4),
('D413', 'Droit des contrats', 4),
('D414', 'Ingénierie financière et marchés boursiers', 4),
('D415', 'Marchés boursiers et informations financières', 4),
('D417', 'e-formation', 4),
('D417B', 'Fondements et outils pour l''audit informatique', 4),
('D511', 'Etudes et recherche', 5),
('D512', 'Anglais', 5),
('D604', 'Pratiques professionnelles du multimédia', 6),
('D605', 'Projet studio', 6),
('D607', 'Rapport de professionnalisation', 6),
('PP', 'Projet Professionnel', 6);

-- --------------------------------------------------------

--
-- Table structure for table `modules_contenu`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`modules_contenu` (
  `id_contenu` int(3) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `version` varchar(5) CHARACTER SET utf8 NOT NULL,
  `adzip` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id_contenu`),
  UNIQUE KEY `unq_mod_version_2` (`code`,`version`,`adzip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modules_ouverts`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`modules_ouverts` (
  `code_semestre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `code_module` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`code_module`,`code_semestre`),
  KEY `code_semestre` (`code_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules_ouverts`
--

INSERT INTO `university_adm`.`modules_ouverts` (`code_semestre`, `code_module`) VALUES
('2015S1', 'C107'),
('2015S1', 'C307'),
('2015S1', 'C409'),
('2015S1', 'D111'),
('2015S2', 'A402'),
('2015S2', 'C107'),
('2015S2', 'C307'),
('2015S2', 'C409'),
('2015S2', 'D111');

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`personnel` (
  `id_personnel` int(100) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(100) NOT NULL,
  `nom_personnel` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom_personnel` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(100) CHARACTER SET utf8 NOT NULL,
  `addresse_postale` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date_entree` date NOT NULL,
  PRIMARY KEY (`id_personnel`),
  KEY `fk_personnel_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `responsable`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`responsable` (
  `id_responsable` int(100) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(100) NOT NULL,
  `nom_responsable` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom_responsable` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(100) CHARACTER SET utf8 NOT NULL,
  `addresse_postale` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date_entree` date NOT NULL,
  `etablissement` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type_responsable` varchar(50) NOT NULL,
  PRIMARY KEY (`id_responsable`),
  KEY `fk_resp_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `responsable_centre`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`responsable_centre` (
  `id_responsable` int(100) NOT NULL,
  `id_centre` int(3) NOT NULL,
  PRIMARY KEY (`id_responsable`,`id_centre`),
  KEY `fk_resp_centre` (`id_centre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `responsable_modules`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`responsable_modules` (
  `id_responsable` int(100) NOT NULL,
  `code_module` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_responsable`,`code_module`),
  KEY `fk_responsable_modules` (`code_module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semestre`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`semestre` (
  `id_semestre` int(100) NOT NULL AUTO_INCREMENT,
  `code_semestre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `utilisateur_creation` varchar(50) CHARACTER SET utf8 NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_semestre`),
  UNIQUE KEY `code_semestre` (`code_semestre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `semestre`
--

INSERT INTO `university_adm`.`semestre` (`id_semestre`, `code_semestre`, `utilisateur_creation`, `date_creation`) VALUES
(1, '2015S1', 'admin', '2015-05-01'),
(2, '2015S2', 'admin', '2015-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `tuteur`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`tuteur` (
  `id_tuteur` int(100) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(100) NOT NULL,
  `nom_tuteur` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom_tuteur` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(100) CHARACTER SET utf8 NOT NULL,
  `addresse_postale` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date_entree` date NOT NULL,
  PRIMARY KEY (`id_tuteur`),
  KEY `fk_tuteur_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tuteur_centre`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`tuteur_centre` (
  `id_tuteur` int(100) NOT NULL,
  `id_centre` int(3) NOT NULL,
  PRIMARY KEY (`id_tuteur`,`id_centre`),
  KEY `fk_tuteur_centre` (`id_centre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tuteur_modules`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`tuteur_modules` (
  `id_tuteur` int(100) NOT NULL,
  `code_semestre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `code_module` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_tuteur`,`code_semestre`,`code_module`),
  KEY `fk_tuteur_modules_ouverts` (`code_module`,`code_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`utilisateur` (
  `id_user` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` varchar(3) NOT NULL DEFAULT 'ENA',
  `id_role` int(100) NOT NULL,
  `last_update` date DEFAULT NULL,
  `user_update` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_utilisateur_role` (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `university_adm`.`utilisateur` (`id_user`, `username`, `password`, `remember_token`, `status`, `id_role`, `last_update`, `user_update`) VALUES
(2, 'admin', '$2y$10$nYq1oaFYt7jaaTOFHH1Tw.IQfSJ1uR/EsKP8H4gIe1oGMIX3rInwu', 'A3Vlt1q3R3MeBLdM3QSaNNAiqeyPPXFLbpADfpCDMcZLz8ny0l8F2POSgPp4', 'ENA', 1, '2015-04-30', 'admin'),
(5, 'user', '$2y$10$9c8ceLObfctCp67mjADbHOQouFrZ9iaSoegXdU3j45T8cT59tPRy.', '79EdrJKspwpWXkWMLMr9fq2KAbojoceLRmjS3y73KLtPFxW2insV87pNewJg', 'ENA', 2, NULL, NULL),
(6, 'user2', '$2y$10$P5AEdts82yOQ4fPFX8KEB.1sgWJf8xEkdMpM7TidofvSglz8mfXcu', 'UTC15L03ilUOY6JoKgmHEUpvKMOntvWRCrkDhMCLhwVl14IQpnNNI8aqq7Gs', 'ENA', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur_role`
--

CREATE TABLE IF NOT EXISTS `university_adm`.`utilisateur_role` (
  `id_role` int(100) NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(4) NOT NULL,
  `description_role` varchar(100) NOT NULL,
  `utilisateur_creation` varchar(50) CHARACTER SET utf8 NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `utilisateur_role`
--

INSERT INTO `university_adm`.`utilisateur_role` (`id_role`, `nom_role`, `description_role`, `utilisateur_creation`, `date_creation`) VALUES
(1, 'ADM', 'Administrateur', 'admin', '2015-04-30'),
(2, 'ETU', 'Etudiant', 'admin', '2015-04-30'),
(3, 'RESP', 'Responsable', 'admin', '2015-05-01'),
(4, 'SCOL', 'Scolarite', 'admin', '2015-05-01'),
(5, 'PERS', 'Personnel Autorise Consortium', 'admin', '2015-05-01'),
(6, 'TUT', 'Tuteur', 'admin', '2015-05-01');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activites_par_module`
--
ALTER TABLE `university_adm`.`activites_par_module`
  ADD CONSTRAINT `activites_par_module_ibfk_1` FOREIGN KEY (`id_act`) REFERENCES `activite` (`id_act`),
  ADD CONSTRAINT `fk_activites_module` FOREIGN KEY (`code_module`, `code_semestre`) REFERENCES `modules_ouverts` (`code_module`, `code_semestre`);

--
-- Constraints for table `administrateur`
--
ALTER TABLE `university_adm`.`administrateur`
  ADD CONSTRAINT `fk_admin_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_user`);

--
-- Constraints for table `etudiant`
--
ALTER TABLE `university_adm`.`etudiant`
  ADD CONSTRAINT `fk_etu_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_user`);

--
-- Constraints for table `etudiant_centre`
--
ALTER TABLE `university_adm`.`etudiant_centre`
  ADD CONSTRAINT `fk_etu_centre` FOREIGN KEY (`id_centre`) REFERENCES `centre` (`id_centre`),
  ADD CONSTRAINT `fk_etu_centre_id_etu` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

--
-- Constraints for table `etudiant_choix_modules`
--
ALTER TABLE `university_adm`.`etudiant_choix_modules`
  ADD CONSTRAINT `etudiant_choix_modules_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

--
-- Constraints for table `etudiant_examens`
--
ALTER TABLE `university_adm`.`etudiant_examens`
  ADD CONSTRAINT `etudiant_examens_ibfk_1` FOREIGN KEY (`id_centre`) REFERENCES `centre` (`id_centre`),
  ADD CONSTRAINT `etudiant_examens_ibfk_2` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `fk_et_examens` FOREIGN KEY (`id_etudiant`, `code_semestre`, `code_module`) REFERENCES `etudiant_choix_modules` (`id_etudiant`, `code_semestre`, `code_module`);

--
-- Constraints for table `examen`
--
ALTER TABLE `university_adm`.`examen`
  ADD CONSTRAINT `fk_examen_module` FOREIGN KEY (`code_module`, `code_semestre`) REFERENCES `modules_ouverts` (`code_module`, `code_semestre`),
  ADD CONSTRAINT `fk_examen_modules` FOREIGN KEY (`code_module`, `code_semestre`) REFERENCES `modules_ouverts` (`code_module`, `code_semestre`);

--
-- Constraints for table `module`
--
ALTER TABLE `university_adm`.`module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`);

--
-- Constraints for table `modules_contenu`
--
ALTER TABLE `university_adm`.`modules_contenu`
  ADD CONSTRAINT `modules_contenu_ibfk_1` FOREIGN KEY (`code`) REFERENCES `module` (`code`);

--
-- Constraints for table `modules_ouverts`
--
ALTER TABLE `university_adm`.`modules_ouverts`
  ADD CONSTRAINT `modules_ouverts_ibfk_1` FOREIGN KEY (`code_semestre`) REFERENCES `semestre` (`code_semestre`),
  ADD CONSTRAINT `modules_ouverts_ibfk_2` FOREIGN KEY (`code_module`) REFERENCES `module` (`code`);

--
-- Constraints for table `personnel`
--
ALTER TABLE `university_adm`.`personnel`
  ADD CONSTRAINT `fk_personnel_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_user`);

--
-- Constraints for table `responsable`
--
ALTER TABLE `university_adm`.`responsable`
  ADD CONSTRAINT `fk_resp_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_user`);

--
-- Constraints for table `responsable_centre`
--
ALTER TABLE `university_adm`.`responsable_centre`
  ADD CONSTRAINT `fk_resp_centre` FOREIGN KEY (`id_centre`) REFERENCES `centre` (`id_centre`),
  ADD CONSTRAINT `fk_resp_centre_id_resp` FOREIGN KEY (`id_responsable`) REFERENCES `responsable` (`id_responsable`);

--
-- Constraints for table `responsable_modules`
--
ALTER TABLE `university_adm`.`responsable_modules`
  ADD CONSTRAINT `fk_responsable_modules` FOREIGN KEY (`code_module`) REFERENCES `module` (`code`),
  ADD CONSTRAINT `responsable_modules_ibfk_1` FOREIGN KEY (`id_responsable`) REFERENCES `responsable` (`id_responsable`);

--
-- Constraints for table `tuteur`
--
ALTER TABLE `university_adm`.`tuteur`
  ADD CONSTRAINT `fk_tuteur_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_user`);

--
-- Constraints for table `tuteur_centre`
--
ALTER TABLE `university_adm`.`tuteur_centre`
  ADD CONSTRAINT `fk_tuteur_centre` FOREIGN KEY (`id_centre`) REFERENCES `centre` (`id_centre`),
  ADD CONSTRAINT `fk_tuteur_id_centre` FOREIGN KEY (`id_tuteur`) REFERENCES `tuteur` (`id_tuteur`);

--
-- Constraints for table `tuteur_modules`
--
ALTER TABLE `university_adm`.`tuteur_modules`
  ADD CONSTRAINT `fk_tuteur_modules_ouverts` FOREIGN KEY (`code_module`, `code_semestre`) REFERENCES `modules_ouverts` (`code_module`, `code_semestre`),
  ADD CONSTRAINT `tuteur_modules_ibfk_1` FOREIGN KEY (`id_tuteur`) REFERENCES `tuteur` (`id_tuteur`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `university_adm`.`utilisateur`
  ADD CONSTRAINT `fk_utilisateur_role` FOREIGN KEY (`id_role`) REFERENCES `utilisateur_role` (`id_role`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
