<?php

namespace App;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class App
{

    private Environment $twig;
    private FilesystemLoader $loader;
    private array $routes = [];

    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT . DS . 'templates');
        $this->twig = new Environment($this->loader, [
            'cache' => ROOT . DS . 'var' . DS . 'cache',
            'debug' => true,
        ]);

    }

    public function addRoute(string $name, string $class, string $method): static
    {
        $this->routes[$name] = ['class' => $class, 'method' => $method];
        return $this;
    }

    public function run(): void
    {
        try {
            if(isset($_GET['id'])) {
                $class = $this->routes[$_GET['id']]['class'];
                $method = $this->routes[$_GET['id']]['method'];
                $controller = new $class($this->twig);
                echo $controller->$method();
            } else {
                echo $this->twig->render('main.html.twig');
            }
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            echo $e->getMessage();
        }
    }

}