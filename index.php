<?php

require __DIR__ . '/vendor/autoload.php';

use Blog\Helpers\Request;
use Blog\Blog;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

if (isset($_SERVER['REDIRECT_URL'])) {
    $path = $_SERVER['REDIRECT_URL'];
} else {
    $path = $_SERVER['REQUEST_URI'];
}

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return substr($haystack, 0, $length) === $needle;
}

function endswith($string, $test)
{
    $length = strlen($test);
    if (!$length) {
        return true;
    }
    return substr($string, -$length) === $test;
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
    foreach ($routes as $route) {
        if ($route['route'] === $path) {
            return $route;
        }
    }
}

$loader = new FilesystemLoader('src/templates');
$twig = new Environment($loader);

function getContent($route)
{
    global $twig;
    $request = new Request();
    $blog = new Blog($request, $twig);
    $controllerDir = $route['controller'];
    $cnt = new $controllerDir($blog);
    $function = $route['function'];
    if (!method_exists($cnt, $function)) {
        header('Http/1.1 404');
        return "${function} does not exist in ${controllerDir}";
    }
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
