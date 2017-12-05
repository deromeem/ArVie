USE `arvie`;

DROP TABLE IF EXISTS `arvie_arvie_utilisateur_classe_map`;
DROP TABLE IF EXISTS `arvie_arvie_groupes_classes`;
DROP TABLE IF EXISTS `arvie_arvie_utilisateur_interet_map`;
DROP TABLE IF EXISTS `arvie_arvie_groupes_interets`;

ALTER TABLE `arvie_arvie_abonnements` 
  ADD `id` int(11) NOT NULL AUTO_INCREMENT,
  DROP PRIMARY KEY,
  ADD INDEX( `abonne`),
  ADD INDEX( `suivi`),
  ADD PRIMARY KEY (`id`);
ALTER TABLE `arvie_arvie_parrains`
  ADD `id` int(11) NOT NULL AUTO_INCREMENT,
  DROP PRIMARY KEY,
  ADD INDEX( `parrain`),
  ADD INDEX( `filleul`),
  ADD PRIMARY KEY (`id`);
ALTER TABLE `arvie_arvie_utilisateur_discu_map`
  ADD `id` int(11) NOT NULL AUTO_INCREMENT,
  DROP PRIMARY KEY,
  ADD INDEX( `utilisateur`),
  ADD INDEX( `discussion`),
  ADD PRIMARY KEY (`id`);
ALTER TABLE `arvie_arvie_utilisateur_even_map`
  ADD `id` int(11) NOT NULL AUTO_INCREMENT,
  DROP PRIMARY KEY,
  ADD INDEX( `participant`),
  ADD INDEX( `evenement`),
  ADD PRIMARY KEY (`id`);
ALTER TABLE `arvie_arvie_metier_groupe_map`
  ADD `id` int(11) NOT NULL AUTO_INCREMENT,
  DROP PRIMARY KEY,
  ADD INDEX( `metier`),
  ADD INDEX( `groupe`),
  ADD PRIMARY KEY (`id`);

CREATE TABLE IF NOT EXISTS `arvie_arvie_roles` (
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

CREATE TABLE IF NOT EXISTS `arvie_arvie_groupe_utilisateur_map` (
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