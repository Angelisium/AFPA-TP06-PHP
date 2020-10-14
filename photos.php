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
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Photo</title>
	</head>
	<body></body>
</html>