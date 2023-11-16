<?php require_once APP."/views/master/header.php"; ?>

<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hola <?= $_SESSION['session_providers']['name'] ?>!</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Página inicial</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>

<script>
  Swal.fire({
    icon: 'warning',
    title: '🚧 sitio en mantenimiento 🚧',
    html: `
    <p style="text-align: justify">
      Con el objetivo de brindarte un mejor servicio, te informamos que tu sesión actualmente se encuentra en mantenimiento
    <p>
    <p style="text-align: justify">
      Agradecemos tu paciencia, mantente al pendiente de nuestras noticias en IRIS, estaremos informando por este medio cuando el sitio esté nuevamente en linea.
    <p>`,
    confirmButtonText: 'Aceptar',
    allowOutsideClick: false
  }).then(()=>{
    let url = window.location.href;
    window.location.replace('<?= URL?>?event=logout');
  });
</script>

<?php require_once APP."/views/master/footer_end.php"; ?>