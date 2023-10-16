<?php

namespace App\Model;

class Player {
    private string $lastName; // Changed from $nom
    private string $name; // Changed from $prenom
    private \DateTime $dateDeNaissance;
    private string $photo;

    // ##### NEED TO add array that shows the teams associated with this player (without using PlayerHasTeam)

    public function __construct(
        string $lastName, // Changed from $nom
        string $name, // Changed from $prenom
        \DateTime $dateDeNaissance,
        string $photo
    )
    {
        $this->lastName = $lastName; // Changed from $nom
        $this->name = $name; // Changed from $prenom
        $this->dateDeNaissance = $dateDeNaissance;
        $this->photo = $photo;
    }

    // Getter for lastName (formerly nom)
    public function getLastName(): string { // Changed from getNom
        return $this->lastName;
    }

    // Setter for lastName (formerly nom)
    public function setLastName(string $lastName): void { // Changed from setNom
        $this->lastName = $lastName;
    }

    // Getter for name (formerly prenom)
    public function getName(): string { // Changed from getPrenom
        return $this->name;
    }

    // Setter for name (formerly prenom)
    public function setName(string $name): void { // Changed from setPrenom
        $this->name = $name;
    }

    // Getter for dateDeNaissance
    public function getDateDeNaissance(): \DateTime {
        return $this->dateDeNaissance;
    }

    // Setter for dateDeNaissance
    public function setDateDeNaissance(\DateTime $dateDeNaissance): void {
        $this->dateDeNaissance = $dateDeNaissance;
    }

    // Getter for photo
    public function getPhoto(): string {
        return $this->photo;
    }

    // Setter for photo
    public function setPhoto(string $photo): void {
        $this->photo = $photo;
    }
}
