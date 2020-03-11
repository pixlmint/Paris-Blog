<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

include_once '../src/Helpers/Request.php';
include_once '../src/Helpers/Router.php';
require_once '../vendor/autoload.php';

$loader = new FilesystemLoader('../src/templates');
global $twig;
$twig = new Environment($loader);

$router = new Router(new Request);

$router->get('/', function () use ($twig) {
    $template = $twig->load('home.html.twig');
    return $template->render();
});

$router->get('/gallery', function ($request) use ($router, $twig) {
    $imageDirs = array_filter(glob('img/*'), 'is_dir');
    $imageDirs = array_map(function($fileName) {
        $split = explode('/', $fileName);
        return end($split);
    }, $imageDirs);

    header('Location: /gallery/' . $imageDirs[0]);
});

$galleryPages = scandir('img');

foreach ($galleryPages as $page) {
    $router->get("/gallery/{$page}", function ($request) use ($router, $twig) {
        $dir = explode('/', $router->getRoute());
        $dir = end($dir);
        $pages = scandir('img');

        $images = array_filter(glob("img/{$dir}/*"), 'is_file');

        $template = $twig->load('gallery-page.html.twig');
        return $template->render(['pages' => $pages, 'files' => $images]);
    });
}