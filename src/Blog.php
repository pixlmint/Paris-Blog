<?php

namespace Blog;

use Blog\Helpers\RequestInterface;
use Twig\Environment;

class Blog
{
    protected RequestInterface $request;
    private Environment $twig;

    public function __construct(RequestInterface $request, Environment $twig)
    {
        $this->request = $request;
        $this->twig = $twig;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getTwig(): Environment
    {
        return $this->twig;
    }
}