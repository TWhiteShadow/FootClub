<?php

namespace App\Model;
class FormValidator {
    public $errors = [];

    public function validateName($name, $fieldName) {
        if (empty($name)) {
            $this->errors[$fieldName] = '<p class="error">Veuillez saisir un ' . $fieldName . '.</p>';
        } elseif (strlen($name) > 20) {
            $this->errors[$fieldName] = '<p class="error">Le ' . $fieldName . ' ne doit pas dépasser 20 caractères.</p>';
        }
    }

    public function validateDate($date, $fieldName) {
        if (empty($date)) {
            $this->errors[$fieldName] = '<p class="error">Veuillez saisir une ' . $fieldName . '.</p>';
        }
    }

    public function validateImage($file, $fieldName) {
        if ($file['error'] == 4) {
            $this->errors[$fieldName] = '<p class="error">Veuillez sélectionner une ' . $fieldName . '.</p>';
        } elseif ($file['error'] == 1 || $file['error'] == 2) {
            $this->errors[$fieldName] = '<p class="error">Le fichier dépasse la taille maximale autorisée.</p>';
        } else {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
                $this->errors[$fieldName] = '<p class="error">Seules les images de type JPG, JPEG, PNG ou GIF sont autorisées.</p>';
            }
        }
    }

    public function hasErrors() {
        return !empty($this->errors);
    }
}
