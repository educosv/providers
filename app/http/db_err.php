<?php require_once '../config/config.php'; ?>
<?php $message = (isset($_GET['val'])) ? $_GET['val'] : 'No hay errores registrados'; ?>

<!DOCTYPE html>
<html lang="es-SV">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="dist/img/icono.ico">

  <title><?= APP_NAME ?></title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.css">

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DB Error Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DB Error Page</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger"> <i class="fas fa-database"></i></h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> ¡Ups! Algo salió mal.</h3>

          <p>
            Por el momento <strong> No hay conexión con la base de datos</strong>, trabajaremos para solucionarlo de inmediato.
          </p>
          <p>
            <strong>
              Detalles del error:
            </strong>
          </p>
          <p>
            <?= $message ?>
          </p>
          <p>
            Mientras tanto, puedes volver dando click en el siguiente botón.
          </p>
          <a href="<?= URL ?>?req=home" class="btn btn-sm btn-danger">
            <i class="fas fa-home"></i> Volver a inicio
          </a>
        </div>
      </div>
    </section>
  </div>
</div>


<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>