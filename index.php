<?php

# Konstante: Stammverzeichnis
use App\App;
use App\Controller\LoginController;

const ROOT = __DIR__;
const DS = DIRECTORY_SEPARATOR;

# Composer-Autoload einbinden
require_once ROOT . DS . "vendor" . DS . "autoload.php";

$app = new App();

# Routen hinzufügen
$app->addRoute('login', LoginController::class, 'index');

# App starten
$app->run();