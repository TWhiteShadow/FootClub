<?php

namespace App\Database;

final readonly class Database
{
	
	public static function Connect(){
		try {
			$user = getenv('DB_USERNAME'); // name of the user ie: lyceestvincent_csebts1g1 OR root
			$pass = getenv('DB_PASSWORD'); // password of the user
			$dbName = getenv('DB_NAME');
			$host = getenv('DB_HOST'); // name of the database
			$connexion = new \PDO("mysql:host=$host;dbname=$dbName;charset=UTF8", $user, $pass);
		} catch (\Exception $exception) {
			echo 'Erreur lors de la connexion à la base de données. : ' . $exception->getMessage();
			exit;
		}
		return $connexion;
	}
}

?>