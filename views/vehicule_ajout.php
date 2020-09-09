
<?php

require 'partials/header.php'; ?>

<div class="container">
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Marque</th>
            <th>Modele</th>
            <th>Couleur</th>
            <th>Immatriculation</th>
            <th>Modification</th>
            <th>Suppression</th>
        </thead>
        <tbody>
            <?php foreach($vehicules as $vehicule) { ?>
            <tr>
                <td><?= $vehicule->id_vehicule; ?></td>
                <td><?= $vehicule->marque; ?></td>
                <td><?= $vehicule->modele; ?></td>
                <td><?= $vehicule->couleur; ?></td>
                <td><?= $vehicule->immatriculation; ?></td>
                <td><a href="#">Modifier</a></td>
                <td><a href="#">Supprimer</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <form method="POST" action="">
        <label for="">Marque</label>
        <input type="text" name="marque" class="form-control">
        
        <?php
        // Si une erreur est présente sur le marque
        // on affiche l'erreur
        if(isset($errors['marque'])) { ?>
            <div class="text-danger">
                <?= $errors['marque']; ?>
            </div>
        <?php } ?>

        <label for="">Modele</label>
        <input type="text" name="modele" class="form-control">

        <label for="">Couleur</label>
        <input type="text" name="couleur" class="form-control">

        <label for="">Immatriculation</label>
        <input type="text" name="immatriculation" class="form-control">

        <button class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php require 'partials/footer.php';