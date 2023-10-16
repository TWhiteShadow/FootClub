<?php 

namespace Controllers;

class AddController{

    public function Add(){
        require '../src/views/ajout.html.php';
        return 'Ajout';
    }
}