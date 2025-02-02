<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <div class="content-wrapper">

      <section class="content-header">
        <h1>
          Liste des Catégories de Dépenses
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
          <li>Catégories de Dépenses</li>
          <li class="active">Liste des Catégories</li>
        </ol>
      </section>

      <section class="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Erreur!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Succès!</h4>
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
                <a href="<?php echo Flight::get('flight.base_url')?>/CategorieDepense/ajouterForm" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nouvelle Catégorie</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>Catégorie ID</th>
                    <th>Nom</th>
                    <th>Outils</th>
                  </thead>
                  <tbody>

                    <?php foreach ($CategoriesDepense as $categorie): ?>
                      <tr>
                        <td><?= $categorie['id'] ?></td>
                        <td><?= $categorie['nom'] ?></td>
                        <td>
                          <a href="<?php echo Flight::get('flight.base_url')?>/CategorieDepense/edit/<?= $categorie['id'] ?>"><button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $categorie['id'] ?>"><i class="fa fa-edit"></i> Modifier</button></a>
                          <a href="<?php echo Flight::get('flight.base_url')?>/CategorieDepense/delete/<?= $categorie['id'] ?>"><button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $categorie['id'] ?>"><i class="fa fa-trash"></i> Supprimer</button></a>
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
