<?php

require __DIR__ . '/vendor/autoload.php';

use Nacho\Security\JsonUserHandler;
use Nacho\Helpers\Request;
use Nacho\Helpers\Route;
use Nacho\Nacho;

if (isset($_SERVER['REDIRECT_URL'])) {
    $path = $_SERVER['REDIRECT_URL'];
} else {
    $path = $_SERVER['REQUEST_URI'];
}

function endswith($string, $test)
{
    $length = strlen($test);
    if (!$length) {
        return true;
    }
    return substr($string, -$length) === $test;
}

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return substr($haystack, 0, $length) === $needle;
}

if (endswith($path, '/') && $path !== '/') {
    $path = substr($path, 0, strlen($path) - 1);
}

function getRoute($path)
{
    $routes = json_decode(
        file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config/routes.json'),
        true
    );
    if ($path !== '/') {
        $path = substr($path, 1, strlen($path));
    }
    foreach ($routes as $route) {
        $tmpRoute = new Route($route);
        if ($tmpRoute->match($path)) {
            return $tmpRoute;
        }
    }
    return null;
}

function getContent($route)
{
    $request = new Request($route);
    $userHandler = new JsonUserHandler();
    $nacho = new Nacho($request, $userHandler);
    $controllerDir = $route->getController();
    $cnt = new $controllerDir($nacho);
    $function = $route->getFunction();
    if (!method_exists($cnt, $function)) {
        header('Http/1.1 404');
        return "${function} does not exist in ${controllerDir}";
    }
    $request = new Request($route);
    return $cnt->$function($request);
}

$route = getRoute($path);
if (!$route) {
    $route = getRoute('/');
}
$content = getContent($route);
if ($content) {
    echo $content;
} else {
    $route = getRoute('/');
    $content = getContent($route);
    echo $content;
}
