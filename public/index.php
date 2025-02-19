<?php

# Konstanten definieren
define("ROOT", dirname(__DIR__));
const DS = DIRECTORY_SEPARATOR;

# Composer-Autoload einbinden
require ROOT . DS . 'vendor/autoload.php';

# Template-Engine vorbereiten
$loader = new \Twig\Loader\FilesystemLoader(ROOT . DS . 'templates');
$twig = new \Twig\Environment($loader, [
    'cache' => ROOT . DS . 'var' . DS . 'cache',
    'debug' => true,
]);

# Template laden
try {
    echo $twig->render('main.html.twig');
} catch (\Twig\Error\LoaderError|\Twig\Error\RuntimeError|\Twig\Error\SyntaxError $e) {

}

