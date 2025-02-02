<?php

$today = date('Y-m-d');
$year = date('Y');
if (isset($_GET['year'])) {
  $year = $_GET['year'];
}

?>

<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini" style="background-image: url(images/tea.png); background-repeat: repeat;">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <div class="content-wrapper modifyed-content-wrapper">

      <section class="content-header">
        <h1>
          Dashboard
        </h1>

      </section>

      <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <?php
                echo "<h3>" . $Cueilleur_count . "</h3>";
                ?>

                <p>Total Cueilleurs</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="<?php echo Flight::get('flight.base_url')?>/Cueilleur" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <?php
                echo "<h3>" . $parcelle_count . "</h3>";
                ?>

                <p>Total Parcelle</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo Flight::get('flight.base_url')?>/Parcelle" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <?php
                echo "<h3>" . $variete_count . "</h3>";
                ?>

                <p>Variété de thé</p>
              </div>
              <div class="icon">
                <i class="ion ion-clock"></i>
              </div>
              <a href="<?php echo Flight::get('flight.base_url')?>/Variete" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <?php
                echo "<h3> 15 </h3>"
                ?>

                <p>Still Pending Today</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert-circled"></i>
              </div>
              <a href="record.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        </script>

</body>

</html>
