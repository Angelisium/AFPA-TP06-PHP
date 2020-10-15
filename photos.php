<?php
	/**
	 * Tous  les  noms  de  variable  utilisés  dans ce script  sont valide  car
	 * commençant par une lettre¹ ou un souligné (_), suivi de lettres, chiffres
	 * ou soulignés.
	 * 
	 * ¹: Une lettre pouvant être a à z, A à Z, et les octets de 128 à 255.
	 * 
	 * Exemple :
	 *		=> 'è' est un caractère ASCII (étendu) 232.
	 *		=> 'ê' est un caractère ASCII (étendu) 234.
	 * 
	 * Cf. https://www.php.net/manual/fr/language.variables.basics.php
	 */

	foreach(parse_ini_file("config.ini") as $k => $v) {
		define($k, $v);
	}

	# Fonction qui sert à supprimer les paramètre vide de l'URL.
	function redirige_sans(string $a): void {
		unset($_GET[$a]);
		$paramètres = count($_GET)>0 ? '?' : '';
		header('Location: ' . $_SERVER['PHP_SELF'] . $paramètres . http_build_query($_GET));
		exit();
	}

	# Connexion à la base de données
	try {
		$db = new PDO("mysql:host=".DB['HOST'].";dbname=".DB['NAME'], DB['USER'], DB['PASSWORD']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}

	# Récupération de la liste de toutes les tables dans la DB pour l'affichage.
	$requête = $db->query('SHOW TABLES FROM `TP06`');
	$tables = $requête->fetchAll();
	$requête->closeCursor();

	# Détermination des variables $lignes et $entête
	# $ligne => La liste de toute les valeurs dans la table
	# $entête => La liste des noms de colonne
	$tid = isset($_GET['table']) ? $_GET['table'] : NULL;
	if(!is_null($tid) && isset($tables[$tid])) {
		try {
			$requête = $db->query("SELECT * FROM `" . $tables[$tid][0] . "`");
			$lignes = $requête->fetchAll();
			$entête = array_keys($lignes[0]);
			$requête->closeCursor();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	} elseif(!is_null($tid)) {
		redirige_sans('table');
	}

	# Récupération de toutes les catégories
	$requête = $db->query('SELECT * FROM `mes_categorie`');
	$catégories = $requête->fetchAll();
	$requête->closeCursor();

	# Création de la requête SQL pour l'affichage des images
	# $sql => La requêtes SQL au format string
	# $filtres => La liste des filtres (WHERE)
	# $variables => Les valeurs associées aux filtres
	$sql = 'SELECT * FROM `mes_photos`';
	$filtres = array();
	$variables = array();

	# Ajout d'un filtre par categorie
	$sid = isset($_GET['show']) ? intval($_GET['show']) : NULL;
	if(!is_null($sid) && isset($catégories[$sid-1]) && $catégories[$sid-1]['id'] == $sid) {
		$filtres[] = '`categorie` = :categorie';
		$variables[':categorie'] = $sid;
	} elseif(!is_null($sid)) {
		redirige_sans('show');
	}

	# Ajout d'un filtre par date
	$date = isset($_GET['date']) ? $_GET['date'] : NULL;
	if(!is_null($date) && strtotime($date) != false) {
		$filtres[] = '`date` = :date';
		$variables[':date'] = $date;
	} elseif(!is_null($date)) {
		redirige_sans('date');
	}

	# Ajout des filtre par tags
	$tags = isset($_GET['tags']) ? preg_replace('#[^a-z ]#', '', $_GET['tags']) : NULL;
	if(!is_null($tags) && strlen($tags)>0) {
		$tags = explode(' ', $tags);
		foreach($tags as $tag) {
			$filtres[] = "`liste_mots` LIKE '%" . $tag . "%'";
		}
		$tags = implode(' ', $tags);
	} elseif(!is_null($tags)) {
		redirige_sans('tags');
	}

	# Construction de la requête SQL
	$filtres = implode(' AND ', $filtres);
	if(strlen($filtres)>0) {
		$sql.= ' WHERE ' . $filtres;
	}

	try {
		$requête = $db->prepare($sql);
		$requête->execute($variables);
		$images = $requête->fetchAll();
		$requête->closeCursor();
	} catch (Exception $e) {
		echo $e->getMessage();
	}

	require "page.html";
?>