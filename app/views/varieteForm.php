<?php ?>

<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <div class="content-wrapper">

            <section class="content-header">
                <h1>
                    Cueilleur List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Cueilleurs</li>
                    <li class="active">Cueilleur List</li>
                </ol>
            </section>

            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box" style="height: 80vh;">
                            <!-- Modal -->
                            <div class="" id="profile">
                                <div class="" style="height: 80vh;">
                                    <div class="modal-title">
                                        <h5 class="box-title"><?= isset($variete) ? 'Modifier' : 'Ajouter' ?> une Variété</h5>
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
                                                <input type="number" id="rendement_par_pied" name="rendement_pied" value="<?= isset($variete) ? $variete['rendement_par_pied'] : '' ?>" required>
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

                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include 'includes/footer.php'; ?>

    </div>
    <?php include 'includes/scripts.php'; ?>

</body>

</html>
