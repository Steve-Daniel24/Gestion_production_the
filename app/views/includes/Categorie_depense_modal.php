<!-- Modal -->
<div class="modal-container" id="category">
    <div class="modal-content" style="height: 60vh;">
        <div class="modal-header">
            <h5 class="modal-title"><?= isset($categorie) ? 'Modifier' : 'Ajouter' ?> une Catégorie de Dépense</h5>
            <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?php echo Flight::get('flight.base_url')?><?= isset($categorie) ? '/CategorieDepense/update/' . $categorie['id'] : '/CategorieDepense/ajouter' ?>">

                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= isset($categorie) ? $categorie['nom'] : '' ?>" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn-success"><?= isset($categorie) ? 'Mettre à jour' : 'Enregistrer' ?></button>
                </div>

            </form>
        </div>
    </div>
</div>
