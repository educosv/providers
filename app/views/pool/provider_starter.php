<?php require_once APP."/views/master/header.php"; ?>

<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <h1 class="m-0 text-dark">Hola <?= $_SESSION['session_providers']['name'] ?>!</h1>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <p>
              Te damos la bienvenida a nuestro sistema de control de proveedores, a continuación, te presentamos nuestro <strong>listado de requisitos para precalificación.</strong> Agradecemos tu valioso apoyo de cargar los siguientes documentos en <a href="<?= URL ?>?req=myprovider_profile" class="btn-link text-blue"><strong>tu perfil de empresa</strong></a>.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="content mb-4">
      <div class="container-fluid">
        <div class="row mb-4">
          <div class="col-12">
            <h4>Requisitos</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-3">
            <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
              <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-juridica" role="tab" aria-controls="home">
                Personas juridicas
              </a>
              <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-natural" role="tab" aria-controls="profile">
                Personas naturales
              </a>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="list-juridica" role="tabpanel" aria-labelledby="list-home-list">
                <ol class="list-group">
                  <li class="list-group-item list-hover">
                    Fotocopia de Testimonio de Escritura Pública de Constitución de la Sociedad y sus modificaciones (si las hubiese), ambas debidamente inscritas en el registro de comercio.
                  </li>
                  <li class="list-group-item list-hover">
                    Fotocopia de Credencial vigente donde conste la elección del representante legal debidamente inscrita en el Registro de Comercio.
                  </li>
                  <li class="list-group-item list-hover">
                    Fotocopia del poder si actúan por medio de apoderado.
                  </li>
                  <li class="list-group-item list-hover">
                    Fotocopia de DUI, pasaporte o carné de extranjero del representante legal o apoderado.
                  </li>
                  <li class="list-group-item list-hover">
                    Fotocopia del NIT de la sociedad y del representante o apoderado.
                  </li>
                  <li class="list-group-item list-hover">
                    Fotocopia de Tarjeta de contribuyente IVA.
                  </li>
                  <li class="list-group-item list-hover">
                    Matricula de Comercio vigente, o constancia si aún se encuentra en trámite extendida por Registro de Comercio.
                  </li>
                  <li class="list-group-item list-hover">
                    Presentar 3 referencias de sus clientes.
                  </li>
                </ol>
              </div>
              <div class="tab-pane fade" id="list-natural" role="tabpanel" aria-labelledby="list-profile-list">
                <ol class="list-group">
                  <li class="list-group-item list-hover">
                    Fotocopia de DUI.
                  </li>
                  <li class="list-group-item list-hover">
                    Fotocopia de NIT.
                  </li>
                  <li class="list-group-item list-hover">
                    Fotocopia de tarjeta de contribuyente IVA.
                  </li>
                  <li class="list-group-item list-hover">
                    Matricula de Comercio vigente, o constancia si aún se encuentra en trámite extendida por Registro de Comercio.
                  </li>
                  <li class="list-group-item list-hover">
                    Presentar 3 referencias de sus clientes.
                  </li>
                </ol>
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

<script src="dist/js/welcome_provider.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>