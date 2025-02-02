<!-- Modal -->
<div class="" id="profile">
  <div class="modal-content" style="height: 60vh;">
    <div class="">
      <h5 class="modal-title"><?= isset($cueilleur) ? 'Modifier' : 'Ajouter' ?> un Cueilleur</h5>
      <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">&times;</button>
    </div>
    <div class="modal-body">
      <form method="post" action="<?php echo Flight::get('flight.base_url')?><?= isset($cueilleur) ? '/Cueilleur/update/' . $cueilleur['id'] : '/Cueilleur/ajouter' ?>">

        <div class="form-group">
          <label for="nom">Nom</label>
          <input type="text" id="nom" name="nom" value="<?= isset($cueilleur) ? $cueilleur['nom'] : '' ?>" required>
        </div>

        <div class="form-group">
          <label for="genre">Genre</label>
          <select id="genre" name="genre" required>
            <option value="Homme" <?= isset($cueilleur) && $cueilleur['genre'] == 'Homme' ? 'selected' : '' ?>>Homme</option>
            <option value="Femme" <?= isset($cueilleur) && $cueilleur['genre'] == 'Femme' ? 'selected' : '' ?>>Femme</option>
            <option value="Autre" <?= isset($cueilleur) && $cueilleur['genre'] == 'Autre' ? 'selected' : '' ?>>Autre</option>
          </select>
        </div>

        <div class="form-group">
          <label for="date_naissance">Date de naissance</label>
          <input type="date" id="date_naissance" name="date_naissance" value="<?= isset($cueilleur) ? $cueilleur['date_naissance'] : '' ?>" required>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn-success"><?= isset($cueilleur) ? 'Mettre à jour' : 'Enregistrer' ?></button>
        </div>

      </form>
    </div>
  </div>
</div>