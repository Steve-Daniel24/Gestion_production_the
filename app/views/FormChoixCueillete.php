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
                            <form id="form_cueillette" action="<?php echo Flight::get('flight.base_url') ?>/Cueilletes/add" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" name="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cueilleur_id">Cueilleur</label>
                                        <select class="form-control" name="cueilleur_id" required>
                                            <?php foreach ($cueilleur as $Cueilleur): ?>
                                                <option value="<?= $Cueilleur['id']; ?>"><?= $Cueilleur['nom']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="parcelle_id">Parcelle</label>
                                        <select class="form-control" name="parcelle_id" id="parcelle_id" required>
                                            <?php foreach ($parcelles as $parcelle): ?>
                                                <option value="<?= $parcelle['parcelle_id']; ?>"><?= $parcelle['numero']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="poids">Poids Cueilli (kg)</label>
                                        <input type="number" class="form-control" name="poids" id="poids" step="0.01" required>
                                        <p id="poids_error" class="text-danger" style="display:none;">Poids trop élevé par rapport à la parcelle</p>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let poidsInput = document.getElementById("poids");
            let parcelleSelect = document.getElementById("parcelle_id");
            let poidsError = document.getElementById("poids_error");
            let submitButton = document.querySelector("button[type=submit]");

            function checkPoids() {
                let poids = parseFloat(poidsInput.value);
                let parcelle_id = parcelleSelect.value;

                if (isNaN(poids) || poids <= 0) {
                    poidsError.textContent = "Veuillez entrer un poids valide.";
                    poidsError.style.display = "block";
                    submitButton.disabled = true;
                    return;
                }

                if (parcelle_id) {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", "<?php echo Flight::get('flight.base_url') ?>/Cueillettes/poidsMax", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                let response = JSON.parse(xhr.responseText);
                                if (response.status === "error") {
                                    poidsError.textContent = "Le poids dépasse la limite autorisée pour cette parcelle.";
                                    poidsError.style.display = "block";
                                    submitButton.disabled = true;
                                } else {
                                    poidsError.style.display = "none";
                                    submitButton.disabled = false;
                                }
                            } else {
                                poidsError.textContent = "Erreur de communication avec le serveur.";
                                poidsError.style.display = "block";
                                submitButton.disabled = true;
                            }
                        }
                    };

                    xhr.send("parcelle_id=" + encodeURIComponent(parcelle_id) + "&poids=" + encodeURIComponent(poids));
                } else {
                    poidsError.textContent = "Veuillez sélectionner une parcelle.";
                    poidsError.style.display = "block";
                }
            }

            poidsInput.addEventListener("keyup", checkPoids);
            poidsInput.addEventListener("change", checkPoids);
        });
    </script>

    <?php include 'includes/scripts.php'; ?>

</body>

</html>
