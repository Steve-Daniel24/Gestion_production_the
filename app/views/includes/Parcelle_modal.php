<!-- Modal -->
<div class="" id="profile">
    <div class="modal-content" style="height: 60vh;">
        <div class="r">
            <h5 class="modal-title"><?= isset($parcelle) ? 'Modifier' : 'Ajouter' ?> une Parcelle</h5>
            <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?php echo Flight::get('flight.base_url')?><?= isset($parcelle) ? '/Parcelle/update/' . $parcelle['id'] : '/Parcelle/ajouter' ?>">

                <div class="form-group">
                    <label for="Numero">Numero</label>
                    <input type="text" id="Numero" name="numero" value="<?= isset($parcelle) ? $parcelle['numero'] : '' ?>" required>
                </div>

                <div class="form-group">
                    <label for="Surface">Surface</label>
                    <input type="number" id="Surface" name="surface" value="<?= isset($parcelle) ? $parcelle['surface'] : '' ?>" required>
                </div>

                <div class="form-group">
                    <label for="variete_the_id">Variété de Thé</label>
                    <select class="form-control" name="variete_the_id" required>
                        <?php foreach ($varietes as $variete): ?>
                            <option value="<?= $variete['id'] ?>" <?= isset($parcelle) && $parcelle['variete_the_id'] == $variete['id'] ? 'selected' : '' ?>>
                                <?= $variete['nom'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn-success"><?= isset($parcelle) ? 'Mettre à jour' : 'Enregistrer' ?></button>
                </div>

            </form>
        </div>
    </div>
</div>
