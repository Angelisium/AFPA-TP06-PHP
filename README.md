# TP Application PHP gestion d'images

On vous propose de réaliser une application de gestion et d'affichage d'images (ou photos).
Cette application, principalement écrite en PHP, sera interfacée avec une base de données mySQL nommée "TP06" contenant 2 tables :
- Une table "mes_photos" contenant les informations relatives à chaque photo publiée sur votre site :
	- `id` (identifiant unique) de type INT NOT NULL AUTO_INCREMENT,
	- `nom_photo` (nom relatif du fichier) de type VARCHAR(20) BINARY NOT NULL,
	- `categorie` (Clé étrangère) de type INT NOT NULL,
	- `titre` (permet d'associer un titre à la photo) de type VARCHAR(50) BINARY,
	- `hauteur` (hauteur en pixel de la photo) de type SMALLINT NOT NULL,
	- `largeur` (largeur en pixel de la photo) de type SMALLINT NOT NULL,
	- `date` (date de la prise photo) de type DATE DEFAULT '1000-01-01',
	- `liste_mots` (mots clés associés à la photo avec comme séparateur le caractère espace) de type VARCHAR(100)
- Une table "mes_categories" contenant les informations relatives aux catégories d'appartenance des photos :
	- `id` (identifiant unique) de type INT NOT NULL AUTO_INCREMENT,
	- `categorie` (nom de la categorie) de type VARCHAR(20) BINARY NOT NULL,
	- `chemin` (chemin absolu du répertoire contenant les photos de la catégorie) de type VARCHAR(50) BINARY NOT NULL,
	- `passwd` (code d'accès aux photos de la catégorie) de type VARCHAR(20) BINARY NOT NULL
