<?php

require 'autoload.php';

// On doit récupérer l'url pour savoir quel contrôleur on va afficher ?
// http://localhost/vtc/index.php/vehicule/ajout -> "/vehicule/ajout"

$scriptName = '/'.basename($_SERVER['SCRIPT_NAME']);
$base = str_replace($scriptName, '', $_SERVER['SCRIPT_NAME']);
$url = str_replace([$scriptName, $base], '', $_SERVER['REQUEST_URI']);

if ('/vehicule/ajout' === $url) {
    $controller = new Controller\VehiculeController();
    $controller->ajout();
}

if ('/' === $url) {
    require 'partials/header.php';
    require 'partials/footer.php';
}