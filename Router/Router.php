<?php

namespace Router;

class Router
{
    private $routes = [];
    public string $url;   
    
    public function register(string $path, callable $action):void
    {
        $this->routes[$path] = $action;
    }
}