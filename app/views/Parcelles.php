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
        <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
          unset($_SESSION['success']);
        }
        ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="box" style="height: 60vh;">
              <div class="box-header with-border">
                <a href="<?php echo Flight::get('flight.base_url')?>/Parcelle/ajouterForm" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>numero</th>
                    <th>surface</th>
                    <th>nom variete</th>
                    <th>Outils</th>
                  </thead>
                  <tbody>

                    <?php foreach ($Parcelles as $Parcelle): ?>
                      <tr>
                        <td><?= $Parcelle['numero'] ?></td>
                        <td><?= $Parcelle['surface'] ?></td>
                        <td><?= $Parcelle['variete_nom'] ?></td>
                        <td>
                          <a href="Parcelle/edit/<?= $Parcelle['parcelle_id'] ?>"><button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $Parcelle['parcelle_id'] ?>"><i class="fa fa-edit"></i> Edit</button></a>
                          <a href="Parcelle/delete/<?= $Parcelle['parcelle_id'] ?>"><button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $Parcelle['parcelle_id'] ?>"><i class="fa fa-trash"></i> Delete</button></a>
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