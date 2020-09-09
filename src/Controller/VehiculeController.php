  
<?php

namespace Controller;

use Model\Vehicule;

class VehiculeController
{
    public function ajout()
    {
        // Traitement du formulaire
        if (!empty($_POST)) {
            $vehicule = new Vehicule();
            $vehicule->setMarque($_POST['marque']);
            $vehicule->setModele($_POST['modele']);
            $vehicule->setCouleur($_POST['couleur']);
            $vehicule->setImmatriculation($_POST['immatriculation']);
            $vehicule->save();
        }

        require __DIR__.'/../../views/vehicule_ajout.php';
    }
}