<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php  ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li class=""><a href="<?php echo Flight::get('flight.base_url')?>/"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>
      <li class="header">MANAGE</li>
      <li class=""><a href="<?php echo Flight::get('flight.base_url')?>/Cueilleur"><i class="fa fa-dashboard"></i> <span>Cueilleur</span></a></li>
      <li><a href="<?php echo Flight::get('flight.base_url')?>/Parcelle"><i class="fa fa-calendar"></i> <span> Parcelle</span></a></li>
      <li><a href="<?php echo Flight::get('flight.base_url')?>/Variete"><i class="fa fa-file-text"></i> Varieté de thé</a></li>
      <li class="header">PRINTABLES</li>
      <li><a href="<?php echo Flight::get('flight.base_url')?>/Depense"><i class="fa fa-files-o"></i> <span>Depense</span></a></li>
      <li><a href="<?php echo Flight::get('flight.base_url')?>/Salaire"><i class="fa fa-clock-o"></i> <span>Salaire</span></a></li>
      <li><a href="<?php echo Flight::get('flight.base_url')?>/Cueilletes/Form"><i class="fa fa-clock-o"></i> <span>Saisir Cueilletes</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
