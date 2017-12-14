--
-- Base de données : `arvie`
--

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_abonnements`
--

CREATE TABLE `#__arvie_abonnements` (
  `id` int(11) NOT NULL,
  `abonne` int(11) NOT NULL,
  `suivi` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_discussions`
--

CREATE TABLE `#__arvie_discussions` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_evenements`
--

CREATE TABLE `#__arvie_evenements` (
  `id` int(11) NOT NULL,
  `date_event` datetime NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_groupes`
--

CREATE TABLE `#__arvie_groupes` (
  `id` int(11) NOT NULL,
  `groupe_parent` int(11) DEFAULT NULL,
  `nom` varchar(40) NOT NULL,
  `est_groupe_interet` tinyint(1) NOT NULL DEFAULT '0',
  `est_public` tinyint(1) NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `#__arvie_groupes`
--

INSERT INTO `#__arvie_groupes` (`id`, `groupe_parent`, `nom`, `alias`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, NULL, 'Arvie', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(2, 1, 'Louis Armand', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(3, 2, 'BTS', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(4, 3, 'SIO 1', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(5, 1, 'sport', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(6, 5, 'basket', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(7, 3, 'SIO 2', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_groupe_utilisateur_map`
--

CREATE TABLE `#__arvie_groupe_utilisateur_map` (
  `id` int(11) NOT NULL,
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
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_messages`
--

CREATE TABLE `#__arvie_messages` (
  `id` int(11) NOT NULL,
  `auteur` int(11) NOT NULL,
  `discussion` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_metiers`
--

CREATE TABLE `#__arvie_metiers` (
  `id` int(11) NOT NULL,
  `label` varchar(40) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `#__arvie_metiers`
--

INSERT INTO `#__arvie_metiers` (`id`, `label`, `alias`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, 'Informatique', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(2, 'Economie', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_metier_groupe_map`
--

CREATE TABLE `#__arvie_metier_groupe_map` (
  `id` int(11) NOT NULL,
  `metier` int(11) NOT NULL,
  `groupe` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `#__arvie_metier_groupe_map`
--

INSERT INTO `#__arvie_metier_groupe_map` (`id`, `metier`, `groupe`, `alias`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, 1, 4, '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(2, 1, 7, '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_parrains`
--

CREATE TABLE `#__arvie_parrains` (
  `id` int(11) NOT NULL,
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
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_publications`
--

CREATE TABLE `#__arvie_publications` (
  `id` int(11) NOT NULL,
  `publication_parent` int(11) DEFAULT NULL,
  `groupe` int(11) NOT NULL,
  `auteur` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `date_publi` datetime NOT NULL,
  `est_public` tinyint(1) NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `#__arvie_publications`
--

INSERT INTO `#__arvie_publications` (`id`, `publication_parent`, `groupe`, `auteur`, `titre`, `texte`, `date_publi`, `est_public`, `alias`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, NULL, 1, 1, 'Projet ArVie', 'Le projet ArVie est actuellement développé par les étudiants TSIO2 SLAM au Lycée Louis-Armand.\r\n\r\nLes contributions faites à domicile doivent rester exceptionnelles afin de respecter la dynamique de groupe.', '2017-12-07 11:46:00', 1, '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_roles`
--

CREATE TABLE `#__arvie_roles` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_utilisateurs`
--

CREATE TABLE `#__arvie_utilisateurs` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `mobile` varchar(40) DEFAULT NULL,
  `date_naiss` date NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `#__arvie_utilisateurs`
--

INSERT INTO `#__arvie_utilisateurs` (`id`, `email`, `prenom`, `nom`, `mobile`, `date_naiss`, `alias`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, 'emmanuel.derome@gmail.com', 'Emmanuel', 'Derome', NULL, '1960-10-03', '', 1, '2017-10-19 16:32:12', '07', '2017-10-19 16:32:12', 416, 0),
(2, 'f.salimou@hotmail.fr', 'Salimou', 'Fofana', NULL, '1998-03-01', '', 1, '2017-10-19 16:32:12', '06', '2017-10-19 16:32:12', 416, 0),
(3, 'gregory.brugnet@gmail.com', 'Gregory', 'Brugnet', NULL, '1996-10-01', '', 1, '2017-10-19 16:32:12', '06', '2017-10-19 16:32:12', 416, 0),
(4, 'n.peugnet@free.fr', 'Nicolas', 'Peugnet', NULL, '1996-05-09', '', 1, '2017-10-19 16:32:12', '06', '2017-10-19 16:32:12', 416, 0),
(5, 'rahari.anja@gmail.com', 'Anja', 'Raharijaonarivelo', 0, '1997-06-15', 'raharijaonarivelo', '07', '2017-10-19 16:32:12', 416, '2017-11-16 15:58:09', 416, 0);

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_utilisateur_discu_map`
--

CREATE TABLE `#__arvie_utilisateur_discu_map` (
  `id` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `discussion` int(11) NOT NULL,
  `est_admin` tinyint(1) NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `#__arvie_utilisateur_even_map`
--

CREATE TABLE `#__arvie_utilisateur_even_map` (
  `id` int(11) NOT NULL,
  `participant` int(11) NOT NULL,
  `evenement` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Index pour la table `#__arvie_abonnements`
--
ALTER TABLE `#__arvie_abonnements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suivi` (`suivi`),
  ADD KEY `abonne` (`abonne`);

--
-- Index pour la table `#__arvie_discussions`
--
ALTER TABLE `#__arvie_discussions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `#__arvie_evenements`
--
ALTER TABLE `#__arvie_evenements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `#__arvie_groupes`
--
ALTER TABLE `#__arvie_groupes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`groupe_parent`);

--
-- Index pour la table `#__arvie_groupe_utilisateur_map`
--
ALTER TABLE `#__arvie_groupe_utilisateur_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupe` (`groupe`),
  ADD KEY `role` (`role`),
  ADD KEY `utilisateur` (`utilisateur`);

--
-- Index pour la table `#__arvie_messages`
--
ALTER TABLE `#__arvie_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auteur` (`auteur`),
  ADD KEY `discussion` (`discussion`);

--
-- Index pour la table `#__arvie_metiers`
--
ALTER TABLE `#__arvie_metiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `#__arvie_metier_groupe_map`
--
ALTER TABLE `#__arvie_metier_groupe_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `metier` (`metier`),
  ADD KEY `groupe` (`groupe`);

--
-- Index pour la table `#__arvie_parrains`
--
ALTER TABLE `#__arvie_parrains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filleuil` (`filleul`),
  ADD KEY `parrain` (`parrain`),
  ADD KEY `filleul` (`filleul`);

--
-- Index pour la table `#__arvie_publications`
--
ALTER TABLE `#__arvie_publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auteur` (`auteur`),
  ADD KEY `parent` (`publication_parent`),
  ADD KEY `groupe` (`groupe`);

--
-- Index pour la table `#__arvie_roles`
--
ALTER TABLE `#__arvie_roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `#__arvie_utilisateurs`
--
ALTER TABLE `#__arvie_utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `#__arvie_utilisateur_discu_map`
--
ALTER TABLE `#__arvie_utilisateur_discu_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discussion` (`discussion`),
  ADD KEY `utilisateur` (`utilisateur`);

--
-- Index pour la table `#__arvie_utilisateur_even_map`
--
ALTER TABLE `#__arvie_utilisateur_even_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evenement` (`evenement`),
  ADD KEY `participant` (`participant`);

--
-- AUTO_INCREMENT pour la table `#__arvie_abonnements`
--
ALTER TABLE `#__arvie_abonnements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `#__arvie_discussions`
--
ALTER TABLE `#__arvie_discussions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `#__arvie_groupes`
--
ALTER TABLE `#__arvie_groupes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `#__arvie_groupe_utilisateur_map`
--
ALTER TABLE `#__arvie_groupe_utilisateur_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `#__arvie_messages`
--
ALTER TABLE `#__arvie_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `#__arvie_metiers`
--
ALTER TABLE `#__arvie_metiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `#__arvie_metier_groupe_map`
--
ALTER TABLE `#__arvie_metier_groupe_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `#__arvie_parrains`
--
ALTER TABLE `#__arvie_parrains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `#__arvie_publications`
--
ALTER TABLE `#__arvie_publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `#__arvie_roles`
--
ALTER TABLE `#__arvie_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `#__arvie_utilisateurs`
--
ALTER TABLE `#__arvie_utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `#__arvie_utilisateur_discu_map`
--
ALTER TABLE `#__arvie_utilisateur_discu_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `#__arvie_utilisateur_even_map`
--
ALTER TABLE `#__arvie_utilisateur_even_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour la table `#__arvie_abonnements`
--
ALTER TABLE `#__arvie_abonnements`
  ADD CONSTRAINT `#__arvie_abonnements_ibfk_1` FOREIGN KEY (`abonne`) REFERENCES `#__arvie_utilisateurs` (`id`),
  ADD CONSTRAINT `#__arvie_abonnements_ibfk_2` FOREIGN KEY (`suivi`) REFERENCES `#__arvie_utilisateurs` (`id`);

--
-- Contraintes pour la table `#__arvie_evenements`
--
ALTER TABLE `#__arvie_evenements`
  ADD CONSTRAINT `#__arvie_evenements_ibfk_1` FOREIGN KEY (`id`) REFERENCES `#__arvie_publications` (`id`);

--
-- Contraintes pour la table `#__arvie_groupes`
--
ALTER TABLE `#__arvie_groupes`
  ADD CONSTRAINT `#__arvie_groupes_ibfk_1` FOREIGN KEY (`groupe_parent`) REFERENCES `#__arvie_groupes` (`id`);

--
-- Contraintes pour la table `#__arvie_groupe_utilisateur_map`
--
ALTER TABLE `#__arvie_groupe_utilisateur_map`
  ADD CONSTRAINT `#__arvie_groupe_utilisateur_map_ibfk_1` FOREIGN KEY (`groupe`) REFERENCES `#__arvie_groupes` (`id`),
  ADD CONSTRAINT `#__arvie_groupe_utilisateur_map_ibfk_2` FOREIGN KEY (`role`) REFERENCES `#__arvie_roles` (`id`),
  ADD CONSTRAINT `#__arvie_groupe_utilisateur_map_ibfk_3` FOREIGN KEY (`utilisateur`) REFERENCES `#__arvie_utilisateurs` (`id`);

--
-- Contraintes pour la table `#__arvie_messages`
--
ALTER TABLE `#__arvie_messages`
  ADD CONSTRAINT `#__arvie_messages_ibfk_1` FOREIGN KEY (`auteur`) REFERENCES `#__arvie_utilisateurs` (`id`),
  ADD CONSTRAINT `#__arvie_messages_ibfk_2` FOREIGN KEY (`discussion`) REFERENCES `#__arvie_discussions` (`id`);

--
-- Contraintes pour la table `#__arvie_metier_groupe_map`
--
ALTER TABLE `#__arvie_metier_groupe_map`
  ADD CONSTRAINT `#__arvie_metier_groupe_map_ibfk_1` FOREIGN KEY (`metier`) REFERENCES `#__arvie_metiers` (`id`),
  ADD CONSTRAINT `#__arvie_metier_groupe_map_ibfk_2` FOREIGN KEY (`groupe`) REFERENCES `#__arvie_groupes` (`id`);

--
-- Contraintes pour la table `#__arvie_parrains`
--
ALTER TABLE `#__arvie_parrains`
  ADD CONSTRAINT `#__arvie_parrains_ibfk_1` FOREIGN KEY (`filleul`) REFERENCES `#__arvie_utilisateurs` (`id`),
  ADD CONSTRAINT `#__arvie_parrains_ibfk_2` FOREIGN KEY (`parrain`) REFERENCES `#__arvie_utilisateurs` (`id`);

--
-- Contraintes pour la table `#__arvie_publications`
--
ALTER TABLE `#__arvie_publications`
  ADD CONSTRAINT `#__arvie_publications_ibfk_1` FOREIGN KEY (`auteur`) REFERENCES `#__arvie_utilisateurs` (`id`),
  ADD CONSTRAINT `#__arvie_publications_ibfk_2` FOREIGN KEY (`publication_parent`) REFERENCES `#__arvie_publications` (`id`),
  ADD CONSTRAINT `#__arvie_publications_ibfk_3` FOREIGN KEY (`groupe`) REFERENCES `#__arvie_groupes` (`id`);

--
-- Contraintes pour la table `#__arvie_utilisateur_discu_map`
--
ALTER TABLE `#__arvie_utilisateur_discu_map`
  ADD CONSTRAINT `#__arvie_utilisateur_discu_map_ibfk_1` FOREIGN KEY (`utilisateur`) REFERENCES `#__arvie_utilisateurs` (`id`),
  ADD CONSTRAINT `#__arvie_utilisateur_discu_map_ibfk_2` FOREIGN KEY (`discussion`) REFERENCES `#__arvie_discussions` (`id`);

--
-- Contraintes pour la table `#__arvie_utilisateur_even_map`
--
ALTER TABLE `#__arvie_utilisateur_even_map`
  ADD CONSTRAINT `#__arvie_utilisateur_even_map_ibfk_1` FOREIGN KEY (`evenement`) REFERENCES `#__arvie_evenements` (`id`),
  ADD CONSTRAINT `#__arvie_utilisateur_even_map_ibfk_2` FOREIGN KEY (`participant`) REFERENCES `#__arvie_utilisateurs` (`id`);
