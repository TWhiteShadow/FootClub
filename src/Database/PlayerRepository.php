<?php

namespace App\Model;

class PlayerRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    
}