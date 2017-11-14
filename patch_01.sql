USE `arvie`;
ALTER TABLE `arvie_arvie_parrains` CHANGE `filleuil` `filleul` INT(11) NOT NULL;
ALTER TABLE `arvie_arvie_evenements` ADD `titre` varchar(255) NOT NULL AFTER `id`;