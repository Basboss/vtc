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

        // Récupérer tous les véhicules
        $vehicules = Vehicule::findAll();

        // Pour la suppression, on crée une méthode delete sur la classe Véhicule
        // Pour la modification, on crée une méthode update sur la classe Véhicule

        require __DIR__.'/../../views/vehicule_ajout.php';
    }

    public function delete()
    {
        // Pour arrêter le script
        // die('test');
        if (isset($_GET['id'])) {
            Vehicule::delete($_GET['id']);

            // On redirige vers la liste des véhicules
            header('Location: /evalvtc/index.php/vehicule/ajout');
        }
    }

    public function edit()
    {
        if(!empty($_POST)) {
            $vehicule = new Vehicule;
            $vehicule->setMarque($_POST['marque']);
            $vehicule->setModele($_POST['modele']);
            $vehicule->setCouleur($_POST['couleur']);
            $vehicule->setImmatriculation($_POST['immatriculation']);
            $errors = $vehicule->validate();

            if (empty($errors)) {
                $vehicule->update($_GET['id']);
            }
        }

        header('Location: /evalvtc/index.php/vehicule/ajout');

    }
}