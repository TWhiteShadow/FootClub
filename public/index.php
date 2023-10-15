<?php 

use Router\Router;

require '../vendor/autoload.php';



$router = new Router();

$router->register('/', function(){
    return 'Homepage';
});

$router->register('/Ajout', function(){
    return 'Ajout';
});

$router->run();






?>
