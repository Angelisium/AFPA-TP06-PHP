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

	$requête = $db->query('SELECT * FROM `mes_categorie`');
	$catégories = $requête->fetchAll();
	$requête->closeCursor();

	$sid = isset($_GET['show']) ? intval($_GET['show']) : NULL;
	if(!is_null($sid) && isset($catégories[$sid-1]) && $catégories[$sid-1]['id'] == $sid) {
		try {
			$requête = $db->prepare('SELECT * FROM `mes_photos` WHERE `categorie` = ?');
			$requête->execute(array($sid));
			$images = $requête->fetchAll();
			$requête->closeCursor();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	} elseif(!is_null($sid)) {
		redirige_sans('show');
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Photo</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<h1>Images</h1>
		<section class="box">
			<h2>Tables</h2>
			<div class="group">
				<?php foreach($tables as $k => $v) { ?>
					<?php $tv = ['table' => $k]; ?>
					<a class="btn" href="?<?=http_build_query($tv + $_GET)?>"><?=$v[0]?></a>
					<?php unset($tv); ?>
				<?php } ?>
			</div>
			<?php if(isset($lignes) && isset($entête)) { ?>
				<table>
					<thead>
						<tr>
							<?php foreach($entête as $k => $v) { ?>
								<?php if(!is_int($v)) { ?>
									<th><?=$v?></th>
								<?php } ?>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach($lignes as $k => $v) {?>
							<tr>
								<?php foreach($v as $k => $v) { ?>
									<?php if(is_int($k)) {?>
										<td><?=$v?></td>
									<?php } ?>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="group">
					<?php $tv = ['table' => 'hide']; ?>
					<a class="btn" href="?<?=http_build_query($tv + $_GET)?>">hide</a>
					<?php unset($tv); ?>
				</div>
			<?php } ?>
		</section>
		<section class="box">
			<h2>Filtre</h2>
			<form class="group">
				<?php if(!is_null($tid) && isset($tables[$tid])) { ?>
					<input type="hidden" name="table" value="<?=$tid?>">
				<?php } ?>
				<select name="show" id="show">
					<option value="">Catégories</option>
					<?php foreach($catégories as $k => $v) { ?>
						<?php $selected = ($sid == $v['id']) ? 'selected' : ''; ?>
						<option value="<?=$v['id']?>" <?=$selected?>><?=$v['categorie']?></option>
						<?php unset($selected); ?>
					<?php } ?>
				</select>
				<input type="text" name="tags" id="tags">
				<button class="btn">Afficher</button>
			</form>
		</section>
		<?php if(isset($images)) { ?>
			<section class="images">
				<?php foreach($images as $k => $v) { ?>
					<?php $source = $catégories[$sid-1]['chemin'] . $v['nom_photo']; ?>
					<img src="<?=$source?>" alt="<?=$v['titre']?>">
					<?php unset($source); ?>
				<?php } ?>
			</section>
		<?php } ?>
	</body>
</html>