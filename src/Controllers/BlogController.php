<?php
namespace App\Controllers;

use Nacho\Controllers\AbstractController;

class BlogController extends AbstractController
{
    public function index($request): string
    {
        return $this->render('home.html.twig');
    }
}
