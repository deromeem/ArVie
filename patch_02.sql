USE `arvie`;
ALTER TABLE `arvie_arvie_groupes` CHANGE `parent` `groupe_parent` int(11) DEFAULT NULL;
ALTER TABLE `arvie_arvie_publications` CHANGE `parent` `publication_parent` int(11) DEFAULT NULL;
ALTER TABLE `arvie_arvie_metier_groupe_map`
  ADD FOREIGN KEY (`metier`) REFERENCES `arvie_arvie_metiers` (`id`),
  ADD FOREIGN KEY (`groupe`) REFERENCES `arvie_arvie_groupes` (`id`);