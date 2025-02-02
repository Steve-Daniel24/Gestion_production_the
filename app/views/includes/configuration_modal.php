<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1> Saisie des Cueillettes </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Gestion</li>
                    <li class="active">Cueillettes</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ajouter une Cueillette</h3>
                            </div>
                            <form id="form_cueillette" action="<?php echo Flight::get('flight.base_url')?>add_cueillette.php" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" name="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cueilleur_id">Cueilleur</label>
                                        <select class="form-control" name="cueilleur_id" required>
                                            <?php
                                            include 'includes/db_connect.php';
                                            $sql = "SELECT id, nom FROM cueilleurs";
                                            $query = $conn->query($sql);
                                            while ($row = $query->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="parcelle_id">Parcelle</label>
                                        <select class="form-control" name="parcelle_id" id="parcelle_id" required>
                                            <?php
                                            $sql = "SELECT id, numero FROM parcelles";
                                            $query = $conn->query($sql);
                                            while ($row = $query->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['numero'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="poids">Poids Cueilli (kg)</label>
                                        <input type="number" class="form-control" name="poids" id="poids" step="0.01" required>
                                        <small id="poids_error" class="text-danger" style="display:none;">Poids trop élevé par rapport à la parcelle</small>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
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

    <script>
        $(document).ready(function() {
            $('#poids').on('input', function() {
                var poids = $(this).val();
                var parcelle_id = $('#parcelle_id').val();

                if (parcelle_id) {
                    $.ajax({
                        url: 'check_poids_parcelle.php',
                        method: 'POST',
                        data: {
                            parcelle_id: parcelle_id,
                            poids: poids
                        },
                        success: function(response) {
                            if (response == 'error') {
                                $('#poids_error').show();
                                $('button[type=submit]').prop('disabled', true);
                            } else {
                                $('#poids_error').hide();
                                $('button[type=submit]').prop('disabled', false);
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>