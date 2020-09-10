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
            <?php foreach ($vehicules as $vehicule) { ?>
                <tr>
                    <td><?= $vehicule->id_vehicule; ?></td>
                    <td><?= $vehicule->marque; ?></td>
                    <td><?= $vehicule->modele; ?></td>
                    <td><?= $vehicule->couleur; ?></td>
                    <td><?= $vehicule->immatriculation; ?></td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal-<?= $vehicule->id_vehicule; ?>">Modifier</button>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal-<?= $vehicule->id_vehicule; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="/evalvtc/index.php/vehicule/edit?=<?= $vehicule->id_vehicule; ?>">
                                        <div class="modal-body">
                                            <label for="">Marque</label>
                                            <input type="text" name="marque" class="form-control" value="<?= $vehicule->marque; ?>">

                                            <label for="">Modele</label>
                                            <input type="text" name="modele" class="form-control" value="<?= $vehicule->modele; ?>">

                                            <label for="">Couleur</label>
                                            <input type="text" name="couleur" class="form-control" value="<?= $vehicule->couleur; ?>">

                                            <label for="">Immatriculation</label>
                                            <input type="text" name="immatriculation" class="form-control" value="<?= $vehicule->immatriculation; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button class="btn btn-primary">Confirmer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-toggle="modal"
                            data-target="#deleteModal"
                            data-id="<?= $vehicule->id_vehicule; ?>"
                            data-vehicule="<?= htmlspecialchars(json_encode($vehicule), ENT_QUOTES); ?>"
                        >
                            Supprimer
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Supprimer le véhicule
                    <span id="modal-vehicule-id"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <a href="#" class="btn btn-danger" id="modal-vehicule-url">Confirmer</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            // A l'ouverture d'une modal, on l'adapte au véhicule concerné
            $('#deleteModal').on('show.bs.modal', function (event) {
                console.log(event);

                // On récupère l'id associé au button
                var id = $(event.relatedTarget).data('id');

                console.log(id);
                $('#modal-vehicule-id').text(id);

                // Permet de récupérer TOUTES les infos de l'utilisateur dans un objet
                var vehicule = $(event.relatedTarget).data('vehicule');
                console.log(vehicule);

                $('#modal-vehicule-url').attr('href', '/evalvtc/index.php/vehicule/delete?id='+vehicule.id_vehicule);
            });
        });
    </script>


    <?php if ($result) { ?>
        <div class="alert alert-success">
            Le véhicule a été ajouté.
        </div>
    <?php } ?>
    <form method="POST" action="">
        <label for="">Marque</label>
        <input type="text" name="marque" class="form-control">

        <?php
        // Si une erreur est présente sur le champ marque
        // On affiche cette erreur
        if (isset($errors['marque'])) { ?>
            <div class="text-danger"><?= $errors['marque']; ?></div>
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