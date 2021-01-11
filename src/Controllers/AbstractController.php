<?php

namespace Blog\Controllers;

use Blog\Blog;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractController
{
    protected Blog $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    protected function render(string $file, array $args = []): string
    {
        try {
            return $this->blog->getTwig()->render($file, $args);
        } catch (LoaderError | SyntaxError | RuntimeError $e) {
            return '';
        }
    }
}
