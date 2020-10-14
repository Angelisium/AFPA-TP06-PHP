<?php
	foreach(parse_ini_file("config.ini") as $key => $val) {
		define($key, $val);
	} unset($key); unset($val);
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