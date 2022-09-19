<?php


namespace App\Controllers;


use Nacho\Controllers\AbstractController;
use Nacho\Nacho;

class GalleryController extends AbstractController
{
    private string $images;

    public function __construct(Nacho $nacho)
    {
        parent::__construct($nacho);
        $this->images = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/';
    }

    public function index(): string
    {
        $imageDirs = [];
        foreach (scandir($this->images) as $imgDir) {
            if ($imgDir !== '.' && $imgDir !== '..' && is_dir($this->images . $imgDir)) {
                array_push($imageDirs, $imgDir);
            }
        }

        if (!isset($_REQUEST['p'])) {
            return $this->render('gallery.html.twig', ['pages' => $imageDirs]);
        }

        $images = [];
        foreach (scandir($this->images . $_REQUEST['p']) as $image) {
            if (is_file($this->images . $_REQUEST['p'] . '/' . $image)) {
                array_push($images, 'assets/img/' . $_REQUEST['p'] . '/' . $image);
            }
        }

        return $this->render('gallery-page.html.twig', ['files' => $images, 'pages' => $imageDirs]);
    }
}