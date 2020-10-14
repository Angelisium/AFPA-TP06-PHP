CREATE DATABASE IF NOT EXISTS `TP06`;

CREATE TABLE `TP06`.`mes_categorie` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`categorie` VARCHAR(20) BINARY NOT NULL,
	`chemin` VARCHAR(50) BINARY NOT NULL,
	`passwd` VARCHAR(20) BINARY NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `TP06`.`mes_categorie` (`id`, `categorie`, `chemin`, `passwd`) VALUES
(1,	"animaux",		"/Applications/MAMP/htdocs/AFPA-TP06-PHP/images/animaux/",		"ok"),
(2,	"trains",		"/Applications/MAMP/htdocs/AFPA-TP06-PHP/images/trains/",		"passe"),
(3,	"monuments",	"/Applications/MAMP/htdocs/AFPA-TP06-PHP/images/monuments/",	"passepas"),
(4,	"montres",		"/Applications/MAMP/htdocs/AFPA-TP06-PHP/images/montres/",		"lutin");

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

INSERT INTO `TP06`.`mes_photos` (`nom_photo`, `categorie`, `titre`, `hauteur`, `largeur`, `date`, `liste_mots`) VALUES
("chat.jpg", 1, "Chat", 390, 640, NULL, NULL),
("cheval.jpg", 1, "Cheval", 447, 640, NULL, NULL),
("chien.jpg", 1, "Chien", 426, 640, NULL, NULL),
("elephant.jpg", 1, "Elephant", 436, 640, NULL, NULL),
("lion.jpg", 1, "Lion", 404, 640, NULL, NULL),
("orignal.jpg", 1, "Orignal", 426, 640, NULL, NULL),
("poisson.jpg", 1, "Poisson", 426, 640, NULL, NULL),
("raton-laveur.jpg", 1, "Raton-laveur", 409, 640, NULL, NULL);