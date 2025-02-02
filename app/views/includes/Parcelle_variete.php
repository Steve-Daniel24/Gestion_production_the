
<!-- Deuxième fichier pour la gestion des variétés de thé -->

<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <div class="content-wrapper">

            <section class="content-header">
                <h1>
                    Gestion des Variétés de Thé
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Gestion</li>
                    <li class="active">Variétés de Thé</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box" style="height: 60vh;" style="height: 60vh;">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ajouter une Variété de Thé</h3>
                            </div>
                            <form action="<?php echo Flight::get('flight.base_url')?>add_variete.php" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="text" class="form-control" name="nom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="surface_pied">Surface par Pied</label>
                                        <input type="number" class="form-control" name="surface_pied" step="0.01" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="rendement_pied">Rendement par Pied</label>
                                        <input type="number" class="form-control" name="rendement_pied" step="0.01" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="prix_vente">Prix de Vente</label>
                                        <input type="number" class="form-control" name="prix_vente" step="0.01" required>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Ajouter</button>
                                </div>
                            </form>
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
