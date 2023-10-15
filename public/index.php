<?php 

use Router\Router;

require '../vendor/autoload.php';
require '../src/views/header.html.php';

$url = isset($_GET['url']) ? $_GET['url'] : '/';

$router = new Router($url);

$router->get("/", '/Controller/BlogController@index');

$router->run();




?>
