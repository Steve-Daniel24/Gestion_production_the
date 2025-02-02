<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>Depense List</h1>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <a href="<?php echo Flight::get('flight.base_url')?>/Depense/ajouterForm" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>Depense ID</th>
                    <th>Montant</th>
                    <th>Description</th>
                    <th>Date de dépense</th>
                    <th>Outils</th>
                  </thead>
                  <tbody>
                    <?php foreach ($Depenses as $Depense): ?>
                      <tr>
                        <td><?= $Depense['id'] ?></td>
                        <td><?= $Depense['montant'] ?></td>
                        <td><?= $Depense['categorie_id'] ?></td>
                        <td><?= $Depense['date'] ?></td>
                        <td>
                          <a href="<?php echo Flight::get('flight.base_url')?>/Depense/edit/<?= $Depense['id'] ?>"><button class="btn btn-success btn-sm edit btn-flat"><i class="fa fa-edit"></i> Edit</button></a>
                          <a href="<?php echo Flight::get('flight.base_url')?>/Depense/delete/<?= $Depense['id'] ?>"><button class="btn btn-danger btn-sm delete btn-flat"><i class="fa fa-trash"></i> Delete</button></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
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
