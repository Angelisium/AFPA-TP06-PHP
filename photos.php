<?php
	foreach(parse_ini_file("config.ini") as $k => $v) {
		define($k, $v);
	}

	try {
		$db = new PDO("mysql:host=".DB['HOST'].";dbname=".DB['NAME'], DB['USER'], DB['PASSWORD']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}

	// Nom de variable valide => 'ê' est un caractère ASCII (étendu) 234.
	$requête = $db->query('SHOW TABLES FROM `TP06`');
	$TABLES = $requête->fetchAll();
	$requête->closeCursor();

	$tid = isset($_GET['table']) ? $_GET['table'] : NULL;
	if(!is_null($tid) && isset($TABLES[$tid])) {
		try {
			$requête = $db->query('SELECT * FROM `' . $TABLES[$tid][0] . '`');
			$lignes = $requête->fetchAll();
			$entête = array_keys($lignes[0]);
			$requête->closeCursor();
		} catch (Exception $e) {
			echo $e;
		}
	}

	$requête = $db->query('SELECT * FROM `mes_categorie`');
	$CATÉGORIES = $requête->fetchAll();
	$requête->closeCursor();
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
		<?php foreach($TABLES as $k => $v) { ?>
			<a class="btn" href="?table=<?=$k?>"><?=$v[0]?></a>
		<?php } ?>
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
		<?php } ?>
		<form>
			<?php if(!is_null($tid) && isset($TABLES[$tid])) { ?>

			<?php } ?>
			<select name="show" id="show">
				<?php foreach($CATÉGORIES as $k => $v) { ?>
					<option value="<?=$v['id']?>"><?=$v['categorie']?></option>
				<?php } ?>
			</select>
			<button>Afficher</button>
		</form>
	</body>
</html>