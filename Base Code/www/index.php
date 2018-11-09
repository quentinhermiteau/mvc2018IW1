<?php

spl_autoload_register(function($class) {
    $classPath = 'core/' . $class . '.class.php';
    if(file_exists($classPath)) {
        include($classPath);
    }
});

$slug = $_SERVER['REQUEST_URI'];

/*
    Différencier le controller de l'action
    donc on se retrouve avec $c et $a
    vérifier l'existence du fichier et de la class controller
    instancier le controller
    vérifier que la méthode (l'action) existe
    appel de la méthode
*/
$slug = explode('?', $slug)[0];

require 'core/Routing.class.php';

$cap = Routing::getRoute($slug);
extract($cap);

if(file_exists($controllerPath)) {
    include $controllerPath;
    
    if(class_exists($controller)) {
        $object = new $controller();
        
        if(method_exists($object, $action)) {
            $object->$action();

            $slug = Routing::getSlug($controller, $action);
        } else {
            die('The method "' . $action . '" doesn\'t exist');
        }
    } else {
        die('The class "' . $controller . '" doesn\'t exist');
    }
    
} else {
    die('Controller file "' . $controller . '" doesn\'t exist');
}
