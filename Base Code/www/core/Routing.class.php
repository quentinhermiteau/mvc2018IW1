<?php

class Routing {
    public static $routeFile = 'routes.yml';

    public static function getRoute($slug) {
        $routes = yaml_parse_file(self::$routeFile);

        if(isset($slug, $routes)) {
            if(empty($routes[$slug]['controller']) || empty($routes[$slug]['action'])) {
                die('Error append in routes.yml file');
            }

            $controller = ucfirst($routes[$slug]['controller']) . 'Controller';
            $controllerPath = 'controllers/' . $controller . '.class.php';
            $action = $routes[$slug]['action'] . 'Action';
        } else {
            return null;
        }


        return ['controller' => $controller, 'action' => $action, 'controllerPath' => $controllerPath];
    }

    public static function getSlug($controller, $action) {
        $routes = yaml_parse_file(self::$routeFile);

        $controller = explode('Controller', $controller)[0]; //UsersController -> Users
        $action = explode('Action', $action)[0]; // addAction -> add
        
        foreach($routes as $slug => $values) {
            if(!empty($values['controller']) && !empty($values['action']) && $values['controller'] == $controller && $values['action'] == $action) {
                return $slug;
            }
        }

        return null;
    }
}