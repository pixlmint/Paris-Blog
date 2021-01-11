<?php
namespace Blog\Controllers;

class BlogController extends AbstractController
{
    public function index($request): string
    {
        return $this->render('home.html.twig');
    }
}
