<?php

namespace Model;

abstract class Model {
    private static $db;

    // On définit une méthode statiques
    // pour instancier une seule fois la connexion à la BDD
    public static function getDb()
    {
        if(null === self::$db) {
            self::$db = new \PDO('mysql:host=localhost;dbname=vtc_2', 'root', '');
        }

        return self::$db;
    }

    public static function findAll()
    {
        $table = strtolower(substr(strrchr(get_called_class(), '\\'), 1));
        $sql = "SELECT * FROM $table";

        return self::getDB()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
    }

    // Permet de réaliser un INSERT du modèle
    public function save() 
    {
        // Model\Vehicule -> \Vehicule -> Vehicule
        $table = strtolower(substr(strrchr(get_called_class(), '\\'), 1));
        // On récupère toutes les propriétés soit les colonnes
        $properties = get_object_vars($this);
        // ['marque' => 'A', 'modele', =>'B'] => 'A, B'
        // 'marque, modele'
        $columns = implode(', ', array_flip($properties));
        $values = str_replace(', ', ', ', $columns);

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $query = self::$db->prepare($sql);
        
        return $query->execute($properties);

    }
    
}