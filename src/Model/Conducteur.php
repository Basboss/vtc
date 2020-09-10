<?php

namespace Model;

class Conducteur extends Model {
    private $conducteur;

    public function __construct($conducteur)
    {
        $this->conducteur = $conducteur;
    }

    public function addVehicule($vehicule)
    {
        $sql = 'INSERT INTO association_vehicule_conducteur(id_vehicule, id_conducteur) 
        VALUES (:id_vehicule, :id_conducteur)';

        var_dump($this->conducteur);
        var_dump($vehicule);

        $query = self::getDb()->prepare($sql);

        return $query->execute([
            'id_vehicule' => $vehicule,
            'id_conducteur' => $this->conducteur,
        ]);
    }
}