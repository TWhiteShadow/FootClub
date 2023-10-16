<?php

try {
	$user = "root"; // name of the user ie: lyceestvincent_csebts1g1 OR root
	$pass = ""; // password of the user
	$dbName = "footclub"; // name of the database
	$connexion = new \PDO("mysql:host=127.0.0.1;dbname=$dbName;charset=UTF8", $user, $pass);
} catch (\Exception $exception) {
	echo 'Erreur lors de la connexion à la base de données. : ' . $exception->getMessage();
	exit;
}

?>