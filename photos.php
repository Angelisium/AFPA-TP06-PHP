<?php
	foreach(parse_ini_file("config.ini") as $key => $val) {
		define($key, $val);
	} unset($key); unset($val);

	try {
		$db = new PDO("mysql:host=".DB['HOST'].";dbname=".DB['NAME'], DB['USER'], DB['PASSWORD']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}

	$requête = $db->query('SHOW TABLES FROM `TP06`');
	$TABLES = $requête->fetchAll();
	$requête->closeCursor();

	$table = $_GET['table'] ? $_GET['table'] : NULL;
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Photo</title>
	</head>
	<body>
<?php foreach($TABLES as $k => $v) { ?>
		<a href="?table=<?=$k?>"><?=$v[0]?></a>
<?php } ?>
	<!-- is_null -->
	</body>
</html>