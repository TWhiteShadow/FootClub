<?php

namespace App\Model;

class PlayerRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPlayers() {
        $players = [];

        try {
            $stmt = $this->db->prepare("SELECT * FROM player");
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                // Create a new Player object for each row of data
                $player = new Player(
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
}