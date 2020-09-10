<?php

namespace Model;

abstract class Model
{
    private static $db;
    private const USER = 'root';

    // On définit une méthode statique
    // pour instancier une seule fois la connection à la BDD
    public static function getDb()
    {
        if (null === self::$db) {
            self::$db = new \PDO('mysql:host=localhost;dbname=vtc_2', self::USER, '', [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
            ]);
        }

        return self::$db;
    }

    public static function findAll()
    {
        $table = strtolower(substr(strrchr(get_called_class(), '\\'), 1));
        $sql = "SELECT * FROM $table";

        return self::getDb()
            ->query($sql)
            ->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function delete($id)
    {
        $table = strtolower(substr(strrchr(get_called_class(), '\\'), 1));
        $sql = "DELETE FROM $table WHERE id_$table = :id";

        return self::getDb()
            ->prepare($sql)
            ->execute(['id' => $id]);
    }

    /**
     * Permet de réaliser un INSERT du modèle
     */
    public function save()
    {
        // Model\Vehicule -> \Vehicule -> vehicule
        $table = strtolower(substr(strrchr(get_called_class(), '\\'), 1));
        // On récupère toutes les propriétés soit les colonnes
        $properties = get_object_vars($this);

        // ['marque' => 'A', 'modele' => 'B'] => 'A, B'
        // 'marque, modele'
        $columns = implode(', ', array_flip($properties));
        $values = ':'.str_replace(', ', ', :', $columns);

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $query = self::getDb()->prepare($sql);

        return $query->execute($properties);
    }
}