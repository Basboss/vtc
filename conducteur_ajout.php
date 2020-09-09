<?php

require 'partials/header.php'; 

require 'config.php';

// Traitement
$name = $prenom = null;
$result = false;
$errors = [];

if(!empty($_POST)) {
    $nom = sanitize($_POST['nom']);
    $prenom = sanitize($_POST['prenom']);

    // On vérifie les erreurs
    if(strlen($nom) < 2) {
        $errors['nom'] = 'Le nom est trop court';
    }

    if(strlen($prenom)) {
        $errors['prenom'] = 'Le prénom est trop court';
    }
    
    // On fait la requête SQL
    $query = $db->prepare('INSERT INTO conducteur(nom, prenom) VALUES (:nom, :prenom)');

    if(!empty($errors)) {
        $result = $query->execute([
            'nom' => $nom,
            'prenom' => $prenom
        ]);
    }
}

?>

<div class="container">
    <?php if($result) { ?>
        <div class="alert alert-success">
            Le conducteur a été ajouté.
        </div>
    <?php } ?>
    <form method="POST" action="">
        <label for="">Nom</label>
        <input type="text" name="nom" class="form-control">
        <?php if (isset($error['nom'])) { ?>
            <div class='text-danger'><?php $errors['nom']; ?></div>
        <?php } ?>
        
        <label for="">Prénom</label>
        <input type="text" name="prenom" class="form-control">
        <?php if (isset($error['prenom'])) { ?>
            <div class='text-danger'><?php $errors['prenom']; ?></div>
        <?php } ?>

        <button class="btn-btn-primary">
            Ajouter le conducteur
        </button>
    </form>
</div>


<?php
require 'partials/footer.php';