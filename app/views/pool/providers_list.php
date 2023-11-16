<?php require_once APP."/views/master/header.php"; ?>

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-users"></i> Proveedores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?request=home"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active">Proveedores</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-dark card-outline">
              <div class="card-body">
                <table class="table table-striped <?= LANG['datable'] ?>">
                  <thead class="bg-dark">
                    <tr>
                      <th>no.</th>
                      <th>nombre</th>
                      <th>rubro</th>
                      <th>tipo de proveedor</th>
                      <th>homologación</th>
                      <th>estado</th>
                      <th>acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $providers = $model->providers_list(); ?>
                    <?php if ($providers): ?>
                      <?php $no = 1; ?>
                      <?php foreach ($providers['iduser'] as $i => $val): ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><?= $providers['name'][$i] ?></td>
                          <td><?= $providers['branch'][$i] ?></td>
                          <td><?= $providers['type'][$i] ?></td>
                          <td>
                            <?php if ($providers['hstatus'][$i] == 4): ?>
                              <span class="badge badge-pill badge-educodanger">Pendiente</span>
                            <?php else: ?>
                              <span class="badge badge-pill badge-educosuccess">Finalizado</span>
                            <?php endif ?>
                          </td>
                          <td>
                            <?php if ($providers['approved'][$i] == 0): ?>
                              <span class="badge badge-pill badge-educowarning">Pendiente de aprobación</span>
                            <?php else: ?>
                              <span class="badge badge-pill badge-educosuccess">Aprobado</span>
                            <?php endif ?>
                          </td>
                          <td>
                            <button type="button" class="btn btn-sm btn-primary" onclick="getinfo(<?= $val ?>, 'info');" data-toggle="tooltip" data-bs-placement="top" title="Ver información">
                              <i class="fa-solid fa-eye"></i>
                            </button>
                            <a href="<?= URL ?>?req=provider_profile&val=<?= $val ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-bs-placement="top" title="Abrir perfil">
                              <i class="fa-regular fa-folder-open"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="getinfo(<?= $val ?>, 'del');" data-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                              <i class="fa-solid fa-trash-can"></i>
                            </button>
                          </td>
                        </tr>
                        <?php $no++; ?>
                      <?php endforeach ?>
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="info-provider">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-dark">
            <h5 class="modal-title" id="exampleModalLabel">Información del proveedor</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <div class="form-row">
                <div class="col-12 col-md-8">
                  <div class="form-group">
                    <label for="info_name">Nombre de la empresa</label>
                    <input type="text" class="form-control" id="info_name" disabled>
                  </div>
                </div>
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="info_reason">Razón social</label>
                    <input type="text" class="form-control" id="info_reason" disabled>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label for="info_type">Tipo de proveedor</label>
                    <input type="text" class="form-control" id="info_type" disabled>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label for="info_branch">Rubro</label>
                    <input type="text" class="form-control" id="info_branch" disabled>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="info_activity">Giro/actividad</label>
                    <input type="text" class="form-control" id="info_activity" disabled>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="info_address">Dirección</label>
                    <input type="text" class="form-control" id="info_address" disabled>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="info_tel">Número de teléfono</label>
                    <input type="text" class="form-control" id="info_tel" disabled>
                  </div>
                </div>
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="info_email">Correo electrónico</label>
                    <input type="text" class="form-control" id="info_email" disabled>
                  </div>
                </div>
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="info_website">Sitio web</label>
                    <input type="text" class="form-control" id="info_website" disabled>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-12">
                  <button type="button" class="btn btn-dark float-right" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-dark"></div>
        </div>
      </div>
    </div>

  </div>
</div>


<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/datatable.js"></script>

<script src="dist/js/providers_list.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>
