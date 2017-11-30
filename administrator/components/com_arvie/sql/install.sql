--
-- Base de données : `arvie`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `#__arvie_utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `mobile` int(12) DEFAULT NULL,
  `date_naiss` date NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `utilisateurs`
--

INSERT INTO `#__arvie_utilisateurs` (`id`, `email`, `prenom`, `nom`, `mobile`, `date_naiss`, `published`, `created`,`created_by`, `modified`, `modified_by`) VALUES
(1, 'emmanuel.derome@gmail.com', 'Emmanuel', 'Derome', NULL, '1960-10-03', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416),
(2, 'f.salimou@hotmail.fr', 'Salimou', 'Fofana', NULL, '1998-03-01', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416),
(3, 'gregory.brugnet@gmail.com', 'Gregory', 'Brugnet', NULL, '1996-10-01', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416),
(4, 'n.peugnet@free.fr', 'Nicolas', 'Peugnet', NULL, '1996-05-09', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416),
(5, 'rahari.anja@gmail.com', 'Anja', 'Raharijaonarivelo', NULL, '1997-06-15', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416);

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

CREATE TABLE `#__arvie_abonnements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abonne` int(11) NOT NULL,
  `suivi` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`abonne`) REFERENCES `#__arvie_utilisateurs` (`id`),
  FOREIGN KEY (`suivi`) REFERENCES `#__arvie_utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `parrains`
--

CREATE TABLE `#__arvie_parrains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parrain` int(11) NOT NULL,
  `filleul` int(11) NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`filleul`) REFERENCES `#__arvie_utilisateurs` (`id`),
  FOREIGN KEY (`parrain`) REFERENCES `#__arvie_utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE `#__arvie_discussions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_discu_map`
--

CREATE TABLE `#__arvie_utilisateur_discu_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` int(11) NOT NULL,
  `discussion` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`utilisateur`) REFERENCES `#__arvie_utilisateurs` (`id`),
  FOREIGN KEY (`discussion`) REFERENCES `#__arvie_discussions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `#__arvie_messages` (
  `id` int (11) NOT NULL AUTO_INCREMENT,
  `auteur` int(11) NOT NULL,
  `discussion` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`auteur`) REFERENCES `#__arvie_utilisateurs` (`id`),
  FOREIGN KEY (`discussion`) REFERENCES `#__arvie_discussions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `#__arvie_groupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupe_parent` int(11) DEFAULT NULL,
  `nom` varchar(40) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`groupe_parent`) REFERENCES `#__arvie_groupes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `groupes`
--

INSERT INTO `#__arvie_groupes` (`id`, `groupe_parent`, `nom`) VALUES
(1, NULL, 'Arvie'),
(2, 1, 'Louis Armand'),
(3, 2, 'BTS'),
(4, 3, 'SIO 1'),
(5, 1, 'sport'),
(6, 5, 'basket'),
(7, 3, 'SIO 2');

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `#__arvie_publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_parent` int(11) DEFAULT NULL,
  `groupe` int(11) NOT NULL,
  `auteur` int(11) NOT NULL,
  `texte` text NOT NULL,
  `date_publi` datetime NOT NULL,
  `public` tinyint(1) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`auteur`) REFERENCES `#__arvie_utilisateurs` (`id`),
  FOREIGN KEY (`publication_parent`) REFERENCES `#__arvie_publications` (`id`),
  FOREIGN KEY (`groupe`) REFERENCES `#__arvie_groupes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `publications`
--

INSERT INTO `#__arvie_publications` (`id`, `publication_parent`, `groupe`, `auteur`, `texte`, `date_publi`, `public`) VALUES
(1, NULL, 1, 5, 'Salut les gars, les gens ils croient on fait pas mais si on fait !', '2017-10-19 16:32:12', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `#__arvie_evenements` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `date_event` datetime NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id`) REFERENCES `#__arvie_publications` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_even_map`
--

CREATE TABLE `#__arvie_utilisateur_even_map` (
  `participant` int(11) NOT NULL,
  `evenement` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`participant`,`evenement`),
  FOREIGN KEY (`evenement`) REFERENCES `#__arvie_evenements` (`id`),
  FOREIGN KEY (`participant`) REFERENCES `#__arvie_utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `metiers`
--

CREATE TABLE `#__arvie_metiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(40) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `metiers`
--

INSERT INTO `#__arvie_metiers` (`id`, `label`) VALUES
(1, 'Informatique'),
(2, 'Economie');

-- --------------------------------------------------------

--
-- Structure de la table `metier_groupe_map`
--

CREATE TABLE `#__arvie_metier_groupe_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metier` int(11) NOT NULL,
  `groupe` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`metier`) REFERENCES `#__arvie_metiers` (`id`),
  FOREIGN KEY (`groupe`) REFERENCES `#__arvie_groupes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `metier_groupe_map`
--

INSERT INTO `#__arvie_metier_groupe_map` (`metier`, `groupe`) VALUES
(1, 4),
(1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `#__arvie_roles` (
  `id` int (11) NOT NULL AUTO_INCREMENT,
  `label` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_utilisateur_map`
--

CREATE TABLE `#__arvie_groupe_utilisateur_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` int(11) NOT NULL,
  `groupe` int(11) NOT NULL,
  `date_deb` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `role` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`groupe`) REFERENCES `arvie_arvie_groupes` (`id`),
  FOREIGN KEY (`role`) REFERENCES `arvie_arvie_roles` (`id`),
  FOREIGN KEY (`utilisateur`) REFERENCES `arvie_arvie_utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;