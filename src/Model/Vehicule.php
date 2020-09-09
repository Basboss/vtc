<?php

namespace Model;

class Vehicule extends Model {
    protected $marque;
    protected $modele;
    protected $couleur;
    protected $immatriculation;

    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    public function setModele($modele)
    {
        $this->modele = $modele;
    }

    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;
    }
}
