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
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>
<style>
    .content-wrapper {
      background: transparent url("dist/img/index_background.png") no-repeat fixed 0px 0px / cover !important;
    }
  </style>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand-md navbar-dark">
    <div class="container">
      <a href="<?= URL ?>?req=home" class="navbar-brand">
        <img src="dist/img/logo-white.png" alt="Educo Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
      </a>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a href="<?= URL ?>?event=logout" class="nav-link text-warning">
            <i class="fas fa-sign-out-alt"></i> <?= LANG['logout'] ?>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper">
    <?php if ($_SESSION['session_providers']['revision']): ?>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-3 col-md-3 col-lg-3 d-xs-none"></div>
          <div class="col-12 col-md-6 col-lg-6">
            <div class="jumbotron">
              <h1 class="display-5">Hola, <?= $_SESSION['session_providers']['name'] ?>!</h1>
              <p class="lead">Actualmente tienes activo el proceso de revisión de datos.</p>
              <hr class="m-y-md">
              <p>Mantente al pendiente de tu email registrado, te estaremos informando por dicho medio el estado de tu solicitud.</p>
            </div>
          </div>
          <div class="col-3 col-md-3 col-lg-3 d-xs-none"></div>
        </div>
      </div>
    </section>
    <?php else: ?>
    <section class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-3 col-lg-3 d-xs-none"></div>
          <div class="col-12 col-md-6 col-lg-6">
            <div class="row mb-2">
              <div class="col-12">
                <h1 class="m-0 text-dark">Hola <?= $_SESSION['session_providers']['name'] ?>!</h1>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-12">
                <p class="display-7 text-justify">
                  Bienvenido a nuestro sistema de proveedores, antes de entrar a conocer las funciones de nuestra plataforma, solicitamos unos minutos de su tiempo para compartirnos la información de tu empresa y así poder contactárnos contigo lo más pronto posible.
                </p>
                <p class="display-8 text-justify">
                  Recuerda que los campos marcados con asterisco en rojo (<strong class="text-danger">*</strong>) son campos abligatorios.
                </p>
              </div>
            </div>
          </div>
          <div class="col-3 col-md-3 col-lg-3 d-xs-none"></div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-3 col-md-3 col-lg-3 d-xs-none"></div>
          <div class="col-12 col-md-6 col-lg-6">
            <div class="card card-dark card-outline">
              <form id="provider-form">
                <div class="card-body">
                  <div class="form-group">
                    <legend>
                      <h3>Datos generales</h3>
                    </legend>
                  </div>
                  <div class="form-group">
                    <label for="name">Nombre Comercial.<strong class="text-danger">*</strong></label>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Nombre comercial" autocomplete="off" required autofocus>
                  </div>
                  <div class="form-group">
                    <label for="reason">Razón Social / Persona Natural.<strong class="text-danger">*</strong></label>
                    <input id="reason" type="text" class="form-control" name="reason" placeholder="Razón social" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="provtype">Tipo de proveedor.</label>
                    <select class="form-control" id="provtype" name="provtype">
                      <option value="Persona Natural">Persona Natural</option>
                      <option value="Persona Jurídica">Persona Jurídica</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="branch">Tipo de rubro.</label>
                    <select name="branch" id="branch" class="form-control">
                      <?php $branch = $model->branch_list(); ?>
                      <?php foreach ($branch['idbranch'] as $key => $val): ?>
                        <option value="<?= $val ?>"><?= $branch['branch'][$key] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <legend>
                      <h3>Dirección e información de contacto</h3>
                    </legend>
                  </div>
                  <div class="form-group">
                    <label for="dir">Dirección.<strong class="text-danger">*</strong></label>
                    <input id="dir" type="text" class="form-control" name="dir" placeholder="Dirección" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="activity">Giro o actividad de la empresa.<strong class="text-danger">*</strong></label>
                    <input id="activity" type="text" class="form-control" name="activity" placeholder="Giro o Actividad de la empresa" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="tel">Número de Teléfono.<strong class="text-danger">*</strong></label>
                    <input id="tel" type="text" class="form-control" name="tel" placeholder="0000-0000" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Correo electrónico de la empresa.<strong class="text-danger">*</strong></label>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Correo electrónico" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="website">Sitio Web.</label>
                    <input id="website" type="text" class="form-control" name="website" placeholder="www.mywebsite.com" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <legend>
                      <h3>Información de registro</h3>
                    </legend>
                  </div>
                  <div class="form-group">
                    <label for="iva">Registro IVA (sin guiones).</label>
                    <input id="iva" type="text" class="form-control" name="iva" placeholder="Registro de IVA" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="nit">NIT (sin guiones).<strong class="text-danger">*</strong></label>
                    <input id="nit" type="number" class="form-control" name="nit" min="0" max="99999999999999" placeholder="Ejemplo: 06140107901147" required>
                  </div>
                  <div class="form-group">
                    <label for="legal">Nombre y título del representante legal de la empresa.<strong class="text-danger">*</strong></label>
                    <input id="legal" type="text" class="form-control" name="legal" placeholder="Nombre del representante" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="prodservice">Productos / Servicios (Especifique).<strong class="text-danger">*</strong></label>
                    <textarea id="prodservice" class="form-control" wrap="soft" name="prodservice" rows="5" placeholder="Cantidad de caracteres permitidos: 1,000" maxlength="10000" required></textarea>
                  </div>
                  <div class="form-group">
                    <legend>
                      <h3>Ejecutivo/a de ventas</h3>
                    </legend>
                  </div>
                  <div class="form-group">
                    <label for="sellername">Nombre del ejecutivo/a de ventas.<strong class="text-danger">*</strong></label>
                    <input id="sellername" type="text" class="form-control" name="sellername" placeholder="Nombre completo" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="sellertel">Teléfono fijo.</label>
                    <input id="sellertel" type="text" class="form-control" name="sellertel" placeholder="Número de teléfono">
                  </div>
                  <div class="form-group">
                    <label for="sellercell">Teléfono movil.<strong class="text-danger">*</strong></label>
                    <input id="sellercell" type="text" class="form-control" name="sellercell" placeholder="Número de teléfono" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="sellermail">Correo electrónico.<strong class="text-danger">*</strong></label></label>
                    <input id="sellermail" type="email" class="form-control" name="sellermail" placeholder="Correo electrónico del ejecutivo de ventas" autocomplete="off" required>
                  </div>
                  <div class="form-group" style="margin-top: 30px; margin-bottom: 20px;">
                    <button type="submit" id="btn_register" class="btn btn-sm btn-success">Enviar datos</button>
                    <button type="reset" id="btn_reset" class="btn btn-sm btn-danger float-right">Limpiar form</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-3 col-md-3 col-lg-3 d-xs-none"></div>
        </div>
      </div>
    </section>
    <?php endif ?>
  </div>
</div>

<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="dist/js/newprovider.js" type="module"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>