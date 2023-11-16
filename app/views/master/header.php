<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="dist/img/icono.ico">

  <title><?= APP_NAME ?></title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <script src="https://kit.fontawesome.com/76dbbc43b7.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="plugins/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="dist/css/thistyle.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= URL ?>?req=home" class="nav-link"><?= LANG['home'] ?></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= URL ?>?req=info" class="nav-link"><?= LANG['info_sys'] ?></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a href="<?= URL ?>?event=logout" class="nav-link text-dark">
          <strong>
            <i class="fa-solid fa-arrow-right-from-bracket fa-xs"></i>
            <?= LANG['logout'] ?>
          </strong>
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= URL ?>?req=home" class="brand-link bg-dark">
      <img src="dist/img/logo-header.png" alt="<?= APP_NAME ?>" class="brand-image" style="opacity: .9">
      <span class="brand-text font-weight-light text-light"><strong><?= APP_NAME ?></strong></span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="data:imge/png;base64,<?= $_SESSION['session_providers']['pic'] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= URL ?>?req=profile" class="d-block">Mi perfil</a>
        </div>
      </div>
