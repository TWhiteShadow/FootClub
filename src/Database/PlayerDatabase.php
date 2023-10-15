<?php

namespace App\Database;

use App\Model\Player;

final readonly class PlayerDatabase{

    public static function add(Player $player) {
        try {
            
            $db = Database::Connect();
            // Prepare the SQL statement for insertion
            $insert = $db->prepare("INSERT INTO player (firstname, lastname, birthdate, picture) VALUES (:firstname, :lastname, :birthdate, :picture)");

            // Bind parameters
            $insert->bindParam(':firstname', $player->getFirstName());
            $insert->bindParam(':lastname', $player->getLastName());
            $insert->bindParam(':birthdate', $player->getBirthdate());
            $insert->bindParam(':picture', $player->getPhoto());

            // Execute the SQL statement
            $insert->execute();

            // Return the last inserted player ID
            return $db->lastInsertId();
        } catch (\Exception $e) {
            // Handle any database errors
            return false;
        }
    }

    public static function getPlayers(){
        $players = [];
        try {
            $db = Database::Connect();
            $select = $db->prepare("SELECT * FROM player");
            $select->execute();

            while ($row = $select->fetch()) {
                // Create a new Player object for each row of data
                $player = new Player(
                    // row id 
                    $row['lastname'], // Changed from $nom
                    $row['firstname'], // Changed from $prenom
                    new \DateTime($row['birthdate']),
                    $row['picture']
                );

                $players[] = $player;
            }
        } catch (\PDOException $e) {
            // Handle any database errors
            return false;
        }

        return $players;
    }

    public static function delete(Player $player){
      $db = Database::Connect();
      $delete = $db->prepare('DELETE FROM player WHERE ');
    }
}


