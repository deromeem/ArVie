--
-- Base de données : `arvie`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
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

INSERT INTO `utilisateurs` (`id`, `email`, `prenom`, `nom`, `mobile`, `date_naiss`, `published`, `created`,`created_by`, `modified`, `modified_by`) VALUES
(1, 'emmanuel.derome@gmail.com', 'Emmanuel', 'Derome', NULL, '1960-10-03', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416),
(2, 'f.salimou@hotmail.fr', 'Salimou', 'Fofana', NULL, '1998-03-01', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416),
(3, 'gregory.brugnet@gmail.com', 'Gregory', 'Brugnet', NULL, '1996-10-01', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416),
(4, 'n.peugnet@free.fr', 'Nicolas', 'Peugnet', NULL, '1996-05-09', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416),
(5, 'rahari.anja@gmail.com', 'Anja', 'Raharijaonarivelo', NULL, '1997-06-15', 1, '2017-10-19 16:32:12', 416, '2017-10-19 16:32:12', 416);

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

CREATE TABLE `abonnements` (
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
  PRIMARY KEY (`abonne`,`suivi`),
  FOREIGN KEY (`abonne`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`suivi`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `parrains`
--

CREATE TABLE `parrains` (
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
  PRIMARY KEY (`parrain`,`filleul`),
  FOREIGN KEY (`filleul`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`parrain`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE `discussions` (
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

CREATE TABLE `utilisateur_discu_map` (
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
  PRIMARY KEY (`utilisateur`,`discussion`),
  FOREIGN KEY (`utilisateur`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`discussion`) REFERENCES `discussions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
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
  FOREIGN KEY (`auteur`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`discussion`) REFERENCES `discussions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `nom` varchar(40) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`parent`) REFERENCES `groupes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `parent`, `nom`) VALUES
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

CREATE TABLE `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
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
  FOREIGN KEY (`auteur`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`parent`) REFERENCES `publications` (`id`),
  FOREIGN KEY (`groupe`) REFERENCES `groupes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `publications`
--

INSERT INTO `publications` (`id`, `parent`, `groupe`, `auteur`, `texte`, `date_publi`, `public`) VALUES
(1, NULL, 1, 5, 'Salut les gars, les gens ils croient on fait pas mais si on fait !', '2017-10-19 16:32:12', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
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
  FOREIGN KEY (`id`) REFERENCES `publications` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_even_map`
--

CREATE TABLE `utilisateur_even_map` (
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
  FOREIGN KEY (`evenement`) REFERENCES `evenements` (`id`),
  FOREIGN KEY (`participant`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `metiers`
--

CREATE TABLE `metiers` (
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

INSERT INTO `metiers` (`id`, `label`) VALUES
(1, 'Informatique'),
(2, 'Economie');

-- --------------------------------------------------------

--
-- Structure de la table `metier_groupe_map`
--

CREATE TABLE `metier_groupe_map` (
  `metier` int(11) NOT NULL,
  `groupe` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`metier`,`groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `metier_groupe_map`
--

INSERT INTO `metier_groupe_map` (`metier`, `groupe`) VALUES
(1, 4),
(1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `groupes_interets`
--

CREATE TABLE `groupes_interets` (
  `id` int(11) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `proprietaire` int(11) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id`) REFERENCES `groupes` (`id`),
  FOREIGN KEY (`proprietaire`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `groupes_interets`
--

INSERT INTO `groupes_interets` (`id`, `public`, `proprietaire`) VALUES
(5, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_interet_map`
--

CREATE TABLE `utilisateur_interet_map` (
  `utilisateur` int(11) NOT NULL,
  `interet` int(11) NOT NULL,
  `date_deb` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`utilisateur`,`interet`),
  FOREIGN KEY (`interet`) REFERENCES `groupes_interets` (`id`),
  FOREIGN KEY (`utilisateur`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupes_classes`
--

CREATE TABLE `groupes_classes` (
  `id` int(11) NOT NULL,
  `annee_scolaire` int(4) NOT NULL,
  `prof_principal` int(11) DEFAULT NULL,
  `delegue_1` int(11) DEFAULT NULL,
  `delegue_2` int(11) DEFAULT NULL,
  `suppleant_1` int(11) DEFAULT NULL,
  `suppleant_2` int(11) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`annee_scolaire`),FOREIGN KEY (`id`) REFERENCES `groupes` (`id`),
  FOREIGN KEY (`prof_principal`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`delegue_1`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`delegue_2`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`suppleant_1`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`suppleant_2`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `groupes_classes`
--

INSERT INTO `groupes_classes` (`id`, `annee_scolaire`, `prof_principal`, `delegue_1`, `delegue_2`, `suppleant_1`, `suppleant_2`) VALUES
(4, 2016, 1, NULL, NULL, NULL, NULL),
(4, 2017, NULL, NULL, NULL, NULL, NULL),
(7, 2017, NULL, 3, NULL, 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_classe_map`
--

CREATE TABLE `utilisateur_classe_map` (
  `classe` int(11) NOT NULL,
  `annee_inscription` int(4) NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`utilisateur`,`classe`,`annee_inscription`),
  FOREIGN KEY (`utilisateur`) REFERENCES `utilisateurs` (`id`),
  FOREIGN KEY (`classe`,`annee_inscription`) REFERENCES `groupes_classes` (`id`, `annee_scolaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chargement des données de la table `utilisateur_classe_map`
--

INSERT INTO `utilisateur_classe_map` (`classe`, `annee_inscription`, `utilisateur`) VALUES
(4, 2016, 3),
(7, 2017, 3),
(4, 2016, 4),
(7, 2017, 4);

-- --------------------------------------------------------