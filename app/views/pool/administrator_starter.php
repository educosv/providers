<?php require_once APP."/views/master/header.php"; ?>

<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php $name = explode(' ', $_SESSION['session_providers']['name']); ?>
            <h1 class="m-0 text-dark"><?= LANG['starter_message'] ?> <?= $name[0] ?>!</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active"><?= LANG['starter_page'] ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-educo">
              <span class="info-box-icon bg-turquesa elevation-1 text-light"><i class="fas fa-door-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Último inicio de sesión</span>
                <span class="info-box-number">
                  <?= $_SESSION['session_providers']['llogin'] ?>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-educo">
              <span class="info-box-icon bg-turquesa elevation-1 text-light"><i class="fa-solid fa-cart-arrow-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Compras realizadas</span>
                <span class="info-box-number">{ próximamente }</span>
              </div>
            </div>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-educo">
              <span class="info-box-icon bg-turquesa elevation-1 text-light"><i class="fa-solid fa-clipboard-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de solicitudes</span>
                <span class="info-box-number">{ próximamente }</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-educo">
              <span class="info-box-icon bg-turquesa elevation-1 text-light"><i class="fa-solid fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de proveedores</span>
                <span class="info-box-number">{ próximamente }</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>


<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/datatable.js"></script>

<script src="dist/js/dashboard.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>
