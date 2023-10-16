<?php
namespace App\Model;
class PlayerInsertion {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertPlayer($firstname, $lastname, $birthdate, $picture) {
        try {
            // Prepare the SQL statement for insertion
            $stmt = $this->db->prepare("INSERT INTO player (firstname, lastname, birthdate, picture) VALUES (:firstname, :lastname, :birthdate, :picture)");

            // Bind parameters
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':picture', $picture);

            // Execute the SQL statement
            $stmt->execute();

            // Return the last inserted player ID
            return $this->db->lastInsertId();
        } catch (\Exception $e) {
            // Handle any database errors
            return false;
        }
    }
}


