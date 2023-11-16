<?php require_once APP . "/views/master/header.php"; ?>

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

<?php $provider = $model->info_provider($_SESSION['val']); ?>
<?php $seller = $model->info_seller($provider['idprovider']); ?>
<?php $homologaciones = $model->list_homos($_SESSION['val']); ?>

<?php $pic = $model->pic_provprofile(); ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-id-badge"></i> <?= $provider['name'] ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= URL ?>?req=home"><?= LANG['home'] ?></a></li>
            <li class="breadcrumb-item active">Perfil de proveedor</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <div class="card card-dark card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="data:image/png;base64,<?= $pic ?>" alt="profile picture">
              </div>

              <h3 class="profile-username text-center"><?= $provider['name'] ?></h3>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Razón social:</b> <br>
                  <a class="float-left"><?= $provider['reason'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Giro o actividad</b> <br>
                  <a class="float-left"><?= $provider['activity'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Rubro</b> <br>
                  <a class="float-left"><?= $provider['branch'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Página web</b> <br>
                  <a class="float-left"><?= $provider['website'] ?></a>
                </li>
                <li class="list-group-item">
                  <?php if ($provider['approved'] == 0): ?>
                    <button class="btn btn-success btn-block" onclick="aprobar(<?= $_SESSION['val'] ?>);">Aprobar proveedor</button>
                  <?php else: ?>
                    <button class="btn btn-danger btn-block" onclick="desaprobar(<?= $_SESSION['val'] ?>);">Desaprobar proveedor</button>
                  <?php endif ?>
                  <a href="<?= URL ?>?req=providers_list" class="btn btn-dark btn-block"><?= LANG['back'] ?></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card card-dark card-outline">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link profile-info-tab" href="#info" data-toggle="tab">Datos Generales</a></li>
                <li class="nav-item"><a class="nav-link profile-general-tab" href="#general" data-toggle="tab">Registros</a></li>
                <li class="nav-item"><a class="nav-link profile-docs-tab" href="#docs" data-toggle="tab">Documentos</a></li>
                <li class="nav-item"><a class="nav-link profile-homologaciones-tab" href="#homologaciones" data-toggle="tab">Homologaciones</a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="info">
                  <h4><i class="fa-solid fa-caret-right"></i> Datos generales</h4>
                  <hr>
                  <div class="row">
                    <div class="col-12">
                      <strong>Nombre de la empresa</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['name'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Razón social</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['reason'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Tipo de proveedor</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['type'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Rubro</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['branch'] ?></p>
                    </div>
                  </div>
                  <hr>
                  <h4><i class="fa-solid fa-caret-right"></i> Información adicional</h4>
                  <hr>
                  <div class="row">
                    <div class="col-12">
                      <strong>Dirección</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['address'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Giro o Actividad</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['activity'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Número de teléfono</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['tel'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Correo electrónico</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['email'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Sitio web</strong>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <p><?= $provider['website'] ?></p>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="general">
                  <h4><i class="fa-solid fa-caret-right"></i> Registros</h4>
                  <hr>
                  <div class="row">
                    <div class="col-12">
                      <strong>Registro IVA</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['iva'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Registro NIT</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['nit'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Representante legal</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['legal'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Productos y servicios</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $provider['prodservice'] ?></p>
                    </div>
                  </div>
                  <hr>
                  <h4><i class="fa-solid fa-caret-right"></i> Ejecutivo de ventas</h4>
                  <hr>
                  <div class="row">
                    <div class="col-12">
                      <strong>Nombre</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $seller['name'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Teléfono fijo</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $seller['tel'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Teléfono móvil</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <p><?= $seller['cell'] ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <strong>Correo electrónico</strong>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <p><?= $seller['email'] ?></p>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="docs">
                  <div class="row">
                    <div class="col-12">
                      <table class="table table-striped <?= LANG['datable'] ?>">
                        <thead class="bg-dark">
                          <tr>
                            <th scope="col">Nombre del documento</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $files = $model->file_list($provider['iduser']); ?>
                          <?php if ($files): ?>
                            <?php foreach ($files['idfile'] as $key => $value): ?>
                              <tr>
                                <td><?= $files['filename'][$key] ?></td>
                                <td>
                                  <a href="internal_data?downloadfile=<?= $value ?>" class="btn btn-link text-blue">
                                    <i class="fa-solid fa-download"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php endforeach ?>
                          <?php else: ?>
                            <tr><td colspan="2">Sin datos</td><tr>
                          <?php endif ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="homologaciones">
                  <div class="row">
                    <div class="col-12">
                      <button type="button" class="btn btn-success" id="add_h" value="<?= $_SESSION['val'] ?>">Nueva homologación</button>
                    </div>
                  </div>
                  <div class="row mt-4 mb-4">
                    <div class="col-12">
                      <h4>Historial de homologaciones</h4>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-12">
                      <table class="table table-striped <?= LANG['datable'] ?>">
                        <thead class="bg-dark">
                          <tr>
                            <th>No</th>
                            <th>Fecha de solicitud</th>
                            <th>Fecha de recepción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($homologaciones): ?>
                            <?php foreach ($homologaciones['shipdate'] as $i => $shipdate): ?>
                            <tr>
                              <td><?= $i +1 ?></td>
                              <td><?= date("d/m/Y", strtotime($shipdate)) ?></td>
                              <td>
                                <?php $recepdate = (is_null($homologaciones['recepdate'][$i])) ? '-' : date("d/m/Y", strtotime($homologaciones['recepdate'][$i])); ?>
                                <?= $recepdate ?>
                              </td>
                              <td><?= $homologaciones['status'][$i] ?></td>
                              <td>
                                <a href="#docs" class="btn btn-sm btn-primary profile-docs-tab" data-toggle="tab"><i class="fa-solid fa-eye"></i></a>
                                <!-- <button type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></button> -->
                              </td>
                            </tr>
                            <?php endforeach ?>
                          <?php else: ?>
                          <tr>
                            <td colspan="5">Sin datos</td>
                          </tr>
                          <?php endif ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<?php require_once APP . "/views/master/footer_js.php"; ?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/datatable.js"></script>

<script src="dist/js/provider_profile.js"></script>
<script src="dist/js/aprobaciones.js"></script>

<?php require_once APP . "/views/master/footer_end.php"; ?>