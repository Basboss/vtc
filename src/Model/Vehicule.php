<?php

namespace Model;

class Vehicule extends Model
{
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

    public function save()
    {
        $sql = 'INSERT INTO
            vehicule (marque, modele, couleur, immatriculation)
            VALUES (:marque, :modele, :couleur, :immatriculation)';

        $query = self::getDb()->prepare($sql);
        
        return $query->execute([
            'marque' => $this->marque,
            'modele' => $this->modele,
            'couleur' => $this->couleur,
            'immatriculation' => $this->immatriculation,
        ]);
    }

    // Cette méthode permet de valider l'objet
    // On retourne un tableau d'erreur

    public function validate()
    {
        $errors = [];

        if(empty($this->marque)) {
            $errors['marque'] = 'La marque est vide';
        }

        return $errors;
    }
}
