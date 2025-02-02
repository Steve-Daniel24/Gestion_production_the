<!-- Modal -->
<div class="modal-container" id="profile">
    <div class="modal-content" style="height: 60vh;">
        <div class="modal-header">
            <h5 class="modal-title"><?= isset($variete) ? 'Modifier' : 'Ajouter' ?> une Variété</h5>
            <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?php echo Flight::get('flight.base_url')?><?= isset($variete) ? '/Variete/update/' . $variete['id'] : '/Variete/ajouter' ?>">

                <div class="form-group">
                    <label for="nom">Nom de la variété</label>
                    <input type="text" id="nom" name="nom" value="<?= isset($variete) ? $variete['nom'] : '' ?>" required>
                </div>

                <div class="form-group">
                    <label for="surface_pied">Surface par pied</label>
                    <input type="number" id="surface_pied" name="surface_pied" value="<?= isset($variete) ? $variete['surface_pied'] : '' ?>" required>
                </div>

                <div class="form-group">
                    <label for="rendement_par_pied">Rendement par pied</label>
                    <input type="number" id="rendement_par_pied" name="rendement_par_pied" value="<?= isset($variete) ? $variete['rendement_par_pied'] : '' ?>" required>
                </div>

                <div class="form-group">
                    <label for="prix_vente">Prix de vente</label>
                    <input type="number" id="prix_vente" name="prix_vente" value="<?= isset($variete) ? $variete['prix_vente'] : '' ?>" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn-success"><?= isset($variete) ? 'Mettre à jour' : 'Enregistrer' ?></button>
                </div>

            </form>
        </div>
    </div>
</div>
