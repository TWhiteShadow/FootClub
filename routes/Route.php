<?php

namespace Router;

require '../vendor/autoload.php';


class Route
{
    private $path;
    public $action;
    private $matches;

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url)
    {
        $path = preg_replace('#:([\w]+)#','([^/]+)', $this->path);
        $pathToMatch = "#^$path#";

        if(preg_match($pathToMatch, $url, $matches))
        {
            $this -> matches = $matches;
            return true;
        }else{
            return false;
        }
    }

    public function execute(){
        $params = explode("@", $this->action);
        $controllerClass =  $params[0];
        $controller = new $controllerClass();
        $method = $params[1];
        
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method;
    }
}