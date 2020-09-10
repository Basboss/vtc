<?php

require 'partials/header.php';
require 'autoload.php';

use Model\Conducteur;
use Model\Model;
use Model\Vehicule;

// Tous les véhicules
$vehicules = Vehicule::findAll();

// Récupère tous les conducteurs
$conducteurs = Conducteur::findAll();

// On doit insérer l'id du véhicule et du conducteur dans la
// table d'association
if (!empty($_POST)) {
    $conducteur = new Conducteur($_POST['id_conducteur']);
    $conducteur->addVehicule($_POST['id_vehicule']);

    // (new Conducteur())->attachToVehicule();
}

// Exercice 5

$countConducteurs = Model::getDb()->query('SELECT COUNT(id_conducteur) FROM conducteur')->fetchColumn();
var_dump($countConducteurs);
$countVehicules = Model::getDb()->query('SELECT COUNT(id_vehicule) FROM vehicule')->fetchColumn();
var_dump($countVehicules);
$countAssociations = Model::getDb()->query('SELECT COUNT(id_association) FROM association_vehicule_conducteur')->fetchColumn();
var_dump($countAssociations);

$vehiculesWithoutConducteurs = Model::getDb()->query(
    'SELECT * FROM vehicule v
    LEFT JOIN association_vehicule_conducteur avc ON v.id_vehicule = avc.id_vehicule
    WHERE avc.id_conducteur IS NULL'
)->fetchAll(PDO::FETCH_OBJ);
echo '<pre>';
var_dump($vehiculesWithoutConducteurs);
echo '</pre>';

$conducteursWithoutVehicules = Model::getDb()->query(
    'SELECT * FROM conducteur c
    LEFT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur
    WHERE avc.id_vehicule IS NULL'
)->fetchAll(PDO::FETCH_OBJ);
echo '<pre>';
var_dump($conducteursWithoutVehicules);
echo '</pre>';

$vehiculesDePhilippe = Model::getDb()->query(
    'SELECT * FROM vehicule v
    INNER JOIN association_vehicule_conducteur avc ON v.id_vehicule = avc.id_vehicule
    INNER JOIN conducteur c ON c.id_conducteur = avc.id_conducteur
    WHERE c.prenom = "Philippe" AND c.nom = "Pandre"'
)->fetchAll(\PDO::FETCH_OBJ);
echo '<pre>';
var_dump($vehiculesDePhilippe);
echo '</pre>';

$conducteursAndVehicules = Model::getDb()->query(
    'SELECT * FROM conducteur c
    LEFT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur
    LEFT JOIN vehicule v ON v.id_vehicule = avc.id_vehicule'
)->fetchAll(PDO::FETCH_OBJ);
echo '<pre>';
var_dump($conducteursAndVehicules);
echo '</pre>';

$vehiculesAndConducteurs = Model::getDb()->query(
    'SELECT * FROM vehicule v
    LEFT JOIN association_vehicule_conducteur avc ON v.id_vehicule = avc.id_vehicule
    LEFT JOIN conducteur c ON c.id_conducteur = avc.id_conducteur'
)->fetchAll(PDO::FETCH_OBJ);
echo '<pre>';
var_dump($vehiculesAndConducteurs);
echo '</pre>';

$allVehiculesAndConducteurs = Model::getDb()->query(
    'SELECT * FROM conducteur c
    LEFT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur
    LEFT JOIN vehicule v ON v.id_vehicule = avc.id_vehicule
    UNION
    SELECT * FROM conducteur c
    RIGHT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur
    RIGHT JOIN vehicule v ON v.id_vehicule = avc.id_vehicule'
)->fetchAll(PDO::FETCH_OBJ);
echo '<pre>';
var_dump($allVehiculesAndConducteurs);
echo '</pre>';


?>

<form method="POST" action="">
    <label>Véhicule</label>
    <select name="id_vehicule">
        <?php foreach ($vehicules as $vehicule) { ?>
            <option value="<?= $vehicule->id_vehicule; ?>">
                <?= $vehicule->immatriculation; ?>
            </option>
        <?php } ?>
    </select>

    <label>Conducteur</label>
    <select name="id_conducteur">
        <?php foreach ($conducteurs as $conducteur) { ?>
            <option value="<?= $conducteur->id_conducteur; ?>">
                <?= $conducteur->prenom; ?>
            </option>
        <?php } ?>
    </select>

    <button>Associer</button>
</form>

<?php require 'partials/footer.php';