CREATE DATABASE IF NOT EXISTS `TP06`;

CREATE TABLE `TP06`.`mes_categorie` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`categorie` VARCHAR(20) BINARY NOT NULL,
	`chemin` VARCHAR(50) BINARY NOT NULL,
	`passwd` VARCHAR(20) BINARY NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `TP06`.`mes_categorie` (`id`, `categorie`, `chemin`, `passwd`) VALUES
(1,	"animaux",		"/AFPA-TP06-PHP/images/animaux/",		"ok"),
(2,	"montres",		"/AFPA-TP06-PHP/images/montres/",		"lutin"),
(3,	"monuments",	"/AFPA-TP06-PHP/images/monuments/",		"passepas"),
(4,	"trains",		"/AFPA-TP06-PHP/images/trains/",		"passe");

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

INSERT INTO `TP06`.`mes_photos`	(`nom_photo`, `categorie`, `titre`, `hauteur`, `largeur`, `date`, `liste_mots`) VALUES
("chat.jpg",			1,	"Chat",				390,	640,	'2020-05-11',	NULL),
("cheval.jpg",			1,	"Cheval",			447,	640,	'2016-04-13',	NULL),
("chien.jpg",			1,	"Chien",			426,	640,	'2018-09-14',	NULL),
("elephant.jpg",		1,	"Elephant",			436,	640,	'2020-05-11',	NULL),
("lion.jpg",			1,	"Lion",				404,	640,	'2018-09-14',	NULL),
("orignal.jpg",			1,	"Orignal",			426,	640,	'2016-04-13',	NULL),
("poisson.jpg",			1,	"Poisson",			426,	640,	'2018-09-24',	NULL),
("raton-laveur.jpg",	1,	"Raton-laveur",		409,	640,	'2018-09-16',	NULL),
("goucet.png",			2,	"Goucet",			361,	640,	'2018-09-14',	NULL),
("horloge.jpg",			2,	"Horloge",			360,	640,	'2018-09-16',	NULL),
("i-watch.jpg",			2,	"I-Watch",			426,	640,	'2020-05-11',	NULL),
("montre-de-poche.jpg",	2,	"Montre de poche",	426,	640,	'2018-09-24',	NULL),
("rolex.jpg",			2,	"Rolex",			329,	640,	'2018-09-14',	NULL),
("grand-canion.jpg",	3,	"Grand canion",		426,	640,	'2018-09-16',	NULL),
("inca.jpg",			3,	"Inca",				426,	640,	'2020-05-11',	NULL),
("la-place-rouge.jpg",	3,	"La place rouge",	426,	640,	'2018-09-24',	NULL),
("stonehenge.jpg",		3,	"Stonehenge",		425,	640,	'2020-05-11',	NULL),
("tajmahal.jpg",		3,	"Tajmahal",			426,	640,	'2018-09-24',	NULL),
("tour-eiffel.jpg",		3,	"Tour Eiffel",		426,	640,	'2016-04-13',	NULL),
("tower-bridge.jpg",	3,	"Tower Bridge",		424,	640,	'2016-04-13',	NULL);