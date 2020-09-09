<?php

require 'partials/header.php';
require 'autoload.php';
require 'src/Model/Model.php';

use Model\Vehicule;

$vehicule = new Vehicule();
$vehicule->setMarque('Renault');
$vehicule->setModele('Megane');
$vehicule->setCouleur('bleu');
$vehicule->setImmatriculation('AA-000-ZZ');

$vehicule->save();


require 'partials/footer.php';