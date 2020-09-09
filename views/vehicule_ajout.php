
<?php

require 'partials/header.php'; ?>

<div class="container">
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