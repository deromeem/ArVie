--
-- Structure de la table `annuaire_pays`
--
CREATE TABLE IF NOT EXISTS `annuaire_pays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pays` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `annuaire_pays`
--
INSERT INTO `annuaire_pays` (`id`, `pays`, `published`) VALUES
(1, '-', 0),
(2, 'France', 1),
(3, 'Allemagne', 1),
(4, 'Belgique', 1),
(5, 'Espagne', 1),
(6, 'Italie', 1),
(7, 'Royaume-Uni', 1);

--
-- Structure de la table `annuaire_entreprises`
--
CREATE TABLE IF NOT EXISTS `annuaire_entreprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT 'Logo.png',
  `activite` varchar(255) NOT NULL,
  `codeAPE_NAF` varchar(5) NOT NULL,
  `numSIREN` varchar(9) NOT NULL,
  `numTVAintra` varchar(13) NOT NULL,
  `siteWeb` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `adrRue` varchar(50) NOT NULL,
  `adrVille` varchar(50) NOT NULL,
  `adrCP` varchar(10) NOT NULL,
  `pays_id` int(11) NOT NULL DEFAULT '1',
  `commentaire` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_annuaire_pays_id` FOREIGN KEY (`pays_id`) REFERENCES `annuaire_pays` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `annuaire_entreprises`
--
INSERT INTO `annuaire_entreprises` (`id`, `nom`, `alias`, `logo`, `activite`, `codeAPE_NAF`, `numSIREN`, `numTVAintra`, `siteWeb`, `tel`, `adrRue`, `adrVille`, `adrCP`, `pays_id`, `commentaire`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, '-', '', 'Logo.png', '-', '', '', '', '', '', '', '', '', 1, '', 0, '2015-12-17 10:57:13', 0, '2016-01-20 18:59:22', 540, 0),
(2, 'MonEntreprise', 'monentreprise', 'Logo.png', 'Services numériques', '', '', '', '', '', '', '', '', 1, '', 1, '2016-03-02 16:17:38', 540, '0000-00-00 00:00:00', 0, 0);

--
-- Structure de la table `annuaire_civilites`
--
CREATE TABLE IF NOT EXISTS `annuaire_civilites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` varchar(20) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `annuaire_civilites`
--
INSERT INTO `annuaire_civilites` (`id`, `civilite`, `published`) VALUES
(1, '-', 0),
(2, 'M.', 1),
(3, 'Mme', 1),
(4, 'Mlle', 1);

--
-- Structure de la table `annuaire_typescontacts`
--
CREATE TABLE IF NOT EXISTS `annuaire_typescontacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeContact` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `annuaire_typescontacts`
--
INSERT INTO `annuaire_typescontacts` (`id`, `typeContact`, `published`) VALUES
(1, '-', 0);

--
-- Structure de la table `annuaire_contacts`
--
CREATE TABLE IF NOT EXISTS `annuaire_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `prenom` varchar(50) NOT NULL,
  `civilites_id` int(11) NOT NULL DEFAULT '1',
  `typescontacts_id` int(11) NOT NULL DEFAULT '1',
  `entreprises_id` int(11) NOT NULL DEFAULT '1',
  `fonction` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `commentaire` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_annuaire_civilites_id` FOREIGN KEY (`civilites_id`) REFERENCES `annuaire_civilites` (`id`),
  CONSTRAINT `fk_annuaire_typescontacts_id` FOREIGN KEY (`typescontacts_id`) REFERENCES `annuaire_typescontacts` (`id`),
  CONSTRAINT `fk_annuaire_entreprises_id` FOREIGN KEY (`entreprises_id`) REFERENCES `annuaire_entreprises` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `annuaire_contacts`
--

INSERT INTO `annuaire_contacts` (`id`, `nom`, `alias`, `prenom`, `civilites_id`, `typescontacts_id`, `entreprises_id`, `fonction`, `email`, `mobile`, `tel`, `commentaire`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, '-', '', '', 1, 1, 1, '', '', '', '', '', 0, '2015-12-17 10:57:13', 0, '0000-00-00 00:00:00', 0, 0),
(2, 'DUPONT', 'dupont', 'Pierre', 2, 1, 1, '', '', '', '', '', 1, '2016-03-02 16:15:35', 540, '0000-00-00 00:00:00', 0, 0),
(3, 'SMITH', 'smith', 'Léa', 3, 1, 1, '', '', '', '', '', 1, '2016-03-02 16:16:17', 540, '0000-00-00 00:00:00', 0, 0);
