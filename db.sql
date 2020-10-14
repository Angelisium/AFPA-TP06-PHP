CREATE DATABASE IF NOT EXISTS `TP06`;

CREATE TABLE `TP06`.`mes_categorie` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`categorie` VARCHAR(20) BINARY NOT NULL,
	`chemin` VARCHAR(50) BINARY NOT NULL,
	`passwd` VARCHAR(20) BINARY NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `TP06`.`mes_categorie` (`categorie`, `chemin`, `passwd`) VALUES
("animaux",		"/Applications/MAMP/htdocs/AFPA-TP06-PHP/images/animaux/",		"ok"),
("trains",		"/Applications/MAMP/htdocs/AFPA-TP06-PHP/images/trains/",		"passe"),
("monuments",	"/Applications/MAMP/htdocs/AFPA-TP06-PHP/images/monuments/",	"passepas"),
("montres",		"/Applications/MAMP/htdocs/AFPA-TP06-PHP/images/montres/",		"lutin");

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
	CONSTRAINT `in_categorie` FOREIGN KEY (`categorie`) REFERENCES `mes_categorie`(`id`)
) ENGINE = InnoDB;