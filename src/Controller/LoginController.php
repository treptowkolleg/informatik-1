<?php

namespace App\Controller;

use Twig\Environment;

class LoginController
{

    public function __construct(private Environment $twig)
    {
    }

    public function index(): string
    {
        $post = $_POST ?? null;

        return $this->twig->render('login/login.html.twig', [
            'post' => $post
        ]);
    }

}