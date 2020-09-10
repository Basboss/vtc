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

// Récupérer tous les conducteurs
// $db est une instance de PDO
// On "query" ou on "prepare" une requête
// query renvoie une instance de PDOStatement
$conducteurs = $db->query('SELECT * FROM conducteur')->fetchAll();

?>

<div class="container">
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Modification</th>
            <th>Suppression</th>
        </thead>
        <tbody>
            <?php foreach($conducteurs as $conducteur) { ?>
            <tr>
                <td><?= $conducteur['id_conducteur']; ?></td>
                <td><?= $conducteur['prenom']; ?></td>
                <td><?= $conducteur['nom']; ?></td>
                <td><a href="#">Modifier</a></td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" 
                            data-target="#exampleModal" 
                            data-id="<?= $conducteur['id_conducteur']; ?>" 
                            data-user="<?= htmlspecialchars(json_encode($conducteur), ENT_QUOTES); ?>">
                        Supprimer
                    </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Supprimer le conducteur <span id="modal-conducteur-id"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <a href="#" class="btn btn-primary" id="modal-conducteur-url">Confirmer</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            // A l'ouverture d'une modal, on l'adapte au chaffeur concerné
        $('#exampleModal').on('show.bs.modal', function (event) {
                console.log(event);

                // On récupère l'id associé au button
                var id = $(event.relatedTarget).data('id');

                $('#modal-conducteur-id').texte(id);
                // Permet de récupérer TOUTES les infos de l'utilisateur dans un objet
                var user = $(event.relatedTarget).data('user');

                $('#modal-conducteur-url').attr('href', '?delete='+user.id_conducteur);
            });
        });
    </script>


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