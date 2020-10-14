CREATE DATABASE IF NOT EXISTS `TP06`;

CREATE TABLE `TP06`.`mes_categorie` (
	`id` INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `TP06`.`mes_photos` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`nom_photo` VARCHAR(20) BINARY NOT NULL,
	`categorie` INT NOT NULL,
	`titre` VARCHAR(50) BINARY,
	`hauteur` SMALLINT NOT NULL,
	`largeur` SMALLINT NOT NULL,
	`date` DATE DEFAULT '1000-01-01',
	`liste_mots` VARCHAR(100),
	PRIMARY KEY (`id`),
	CONSTRAINT `in_categorie` FOREIGN KEY (`categorie`) REFERENCES mes_categorie(id)
) ENGINE = InnoDB;