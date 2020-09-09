<?php

namespace Controller;

use Model\Vehicule;

class VehiculeController
{
    public function ajout()
    {
        $result = false;
        $errors = [];
        // Traitement du formulaire
        if (!empty($_POST)) {
            $vehicule = new Vehicule();
            $vehicule->setMarque($_POST['marque']);
            $vehicule->setModele($_POST['modele']);
            $vehicule->setCouleur($_POST['couleur']);
            $vehicule->setImmatriculation($_POST['immatriculation']);
            $errors = $vehicule->validate();

            if (empty($errors)) {
                $result = $vehicule->save();
            }
        }

        require __DIR__.'/../../views/vehicule_ajout.php';
    }
}