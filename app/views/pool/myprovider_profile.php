<?php require_once APP . "/views/master/header.php"; ?>

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

<?php $provider = $model->info_provider($_SESSION['session_providers']['id']); ?>
<?php $seller = $model->info_seller($provider['idprovider']); ?>
<?php $files = $model->file_list($_SESSION['session_providers']['id']); ?>

<?php $pic = $model->pic_provprofile(); ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-id-badge"></i> Mi empresa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= URL ?>?req=home"><?= LANG['home'] ?></a></li>
            <li class="breadcrumb-item active">Mi empresa</li>
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
                  <button class="btn btn-info btn-block" data-toggle="modal" data-target="#update_register">Actualizar datos</button>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card card-dark card-outline">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="#info" id="profile-info-tab" data-toggle="tab">Datos Generales</a></li>
                <li class="nav-item"><a class="nav-link" href="#general" id="profile-general-tab" data-toggle="tab">Registros</a></li>
                <li class="nav-item"><a class="nav-link" href="#docs" id="profile-docs-tab" data-toggle="tab">Documentos</a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="info">
                  <h4>Datos generales</h4>
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
                  <h4>Información adicional</h4>
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
                  <h4>Registros</h4>
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
                  <h4>Ejecutivo de ventas</h4>
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
                      <table class="table table-striped">
                        <thead class="bg-dark">
                          <tr>
                            <td scope="col">Nombre del documento</td>
                            <td scope="col">Acciones</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($files): ?>
                            <?php if (!in_array('Carta_de_compromiso', $files['filename'])): ?>
                              <tr>
                                <td>Carta de compromiso <strong>(documento obligatorio)</strong></td>
                                <td>
                                  <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#upload_carta">Cargar</button>
                                  <a href="<?= URL ?>dist/docs/carta_de_compromiso.pdf" class="btn btn-sm btn-primary" target="_blank">Descargar</a>
                                </td>
                              </tr>
                            <?php endif ?>
                            <?php if (!in_array('Cuestionario_de_homologacion', $files['filename'])): ?>
                              <tr>
                                <td>Cuestionario de homologación <strong>(documento obligatorio)</strong></td>
                                <td>
                                  <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#upload_cuestionario">Cargar</button>
                                  <a href="<?= URL ?>dist/docs/carta_de_compromiso.pdf" class="btn btn-sm btn-primary" target="_blank">Descargar</a>
                                </td>
                              </tr>
                            <?php endif ?>
                            <?php foreach ($files['idfile'] as $key => $value): ?>
                              <tr>
                                <td><?= $files['filename'][$key] ?></td>
                                <td>
                                  <a href="internal_data?downloadfile=<?= $value ?>" class="btn btn-link text-blue">
                                    <i class="fa-solid fa-download"></i>
                                  </a>
                                  <?php if ($files['filename'][$key] != 'Cuestionario_de_homologacion'): ?>
                                  <button type="button" class="btn btn-link text-danger" onclick="delfile(<?= $value ?>);">
                                    <i class="fa-solid fa-trash-can"></i>
                                  </button>
                                  <?php endif ?>
                                </td>
                              </tr>
                            <?php endforeach ?>
                          <?php else: ?>
                            <tr>
                              <td>Carta de compromiso <strong>(documento obligatorio)</strong></td>
                              <td>
                                <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#upload_carta">Cargar</button>
                                <a href="<?= URL ?>dist/docs/carta_de_compromiso.pdf" class="btn btn-sm btn-primary" target="_blank">Descargar</a>
                              </td>
                            </tr>
                            <?php if ($model->homologacion_abierta($_SESSION['session_providers']['id'])): ?>
                            <tr>
                              <td>Cuestionario de homologación <strong>(documento obligatorio)</strong></td>
                              <td>
                                <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#upload_cuestionario">Cargar</button>
                                <a href="<?= URL ?>dist/docs/cuestionario_de_homologacion_de_proveedor.pdf" class="btn btn-sm btn-primary" target="_blank">Descargar</a>
                              </td>
                            </tr>
                            <?php endif ?>
                          <?php endif ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-12">
                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#upload_file"><i class="fa-solid fa-file-invoice"></i> Subir documento</button>
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

<div class="modal fade" id="update_register">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title"><i class="fa-solid fa-pen-to-square"></i> Actualizar registro</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form id="provider-form">
            <div class="card-body">
              <div class="form-group">
                <legend>
                  <h3>Datos generales</h3>
                </legend>
              </div>
              <div class="form-group">
                <label for="name">Nombre Comercial.<strong class="text-danger">*</strong></label>
                <input id="name" type="text" class="form-control" name="name" value="<?= $provider['name'] ?>" placeholder="Nombre comercial" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="reason">Razón Social / Persona Natural.<strong class="text-danger">*</strong></label>
                <input id="reason" type="text" class="form-control" name="reason" value="<?= $provider['reason'] ?>" placeholder="Razón social" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="provtype">Tipo de proveedor.</label>
                <select class="form-control" id="provtype" name="provtype">
                  <?php if ($provider['type'] == 'Persona Jurídica'): ?>
                    <option value="Persona Jurídica" selected>Persona Jurídica</option>
                    <option value="Persona Natural">Persona Natural</option>
                  <?php else: ?>
                    <option value="Persona Jurídica">Persona Jurídica</option>
                    <option value="Persona Natural" selected>Persona Natural</option>
                  <?php endif ?>
                </select>
              </div>
              <div class="form-group">
                <label for="branch">Tipo de rubro.</label>
                <select name="branch" id="branch" class="form-control">
                  <?php $branch = $model->branch_list(); ?>
                  <?php foreach ($branch['idbranch'] as $key => $val): ?>
                    <?php if ($provider['branch'] == $branch['branch'][$key]): ?>
                      <option value="<?= $val ?>" selected><?= $branch['branch'][$key] ?></option>
                    <?php else: ?>
                      <option value="<?= $val ?>"><?= $branch['branch'][$key] ?></option>
                    <?php endif ?>
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
                <input id="dir" type="text" class="form-control" name="dir" value="<?= $provider['address'] ?>" placeholder="Dirección" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="activity">Giro o actividad de la empresa.<strong class="text-danger">*</strong></label>
                <input id="activity" type="text" class="form-control" name="activity" value="<?= $provider['activity'] ?>" placeholder="Giro o Actividad de la empresa" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="tel">Número de Teléfono.</label>
                <input id="tel" type="text" class="form-control" name="tel" value="<?= $provider['tel'] ?>" placeholder="0000-0000" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="email">Correo electrónico de la empresa.<strong class="text-danger">*</strong></label>
                <input id="email" type="email" class="form-control" name="email" value="<?= $provider['email'] ?>" placeholder="Correo electrónico" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="website">Sitio Web.</label>
                <input id="website" type="text" class="form-control" name="website" value="<?= $provider['website'] ?>" placeholder="www.mywebsite.com" autocomplete="off">
              </div>
              <div class="form-group">
                <legend>
                  <h3>Información de registro</h3>
                </legend>
              </div>
              <div class="form-group">
                <label for="iva">Registro IVA (sin guiones).</label>
                <input id="iva" type="text" class="form-control" name="iva" value="<?= $provider['iva'] ?>" placeholder="Registro de IVA" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="nit">NIT (sin guiones).<strong class="text-danger">*</strong></label>
                <input id="nit" type="text" class="form-control" name="nit" value="<?= $provider['nit'] ?>" placeholder="Ejemplo: 09520701961149">
              </div>
              <div class="form-group">
                <label for="legal">Nombre y título del representante legal de la empresa.<strong class="text-danger">*</strong></label>
                <input id="legal" type="text" class="form-control" name="legal" value="<?= $provider['legal'] ?>" placeholder="Nombre del representante" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="prodservice">Productos / Servicios (Especifique).<strong class="text-danger">*</strong></label>
                <textarea id="prodservice" class="form-control" wrap="soft" name="prodservice" rows="5" placeholder="Cantidad de caracteres permitidos: 1,000" maxlength="10000" required><?= $provider['prodservice'] ?></textarea>
              </div>
              <div class="form-group">
                <legend>
                  <h3>Ejecutivo/a de ventas</h3>
                </legend>
              </div>
              <div class="form-group">
                <label for="sellername">Nombre del ejecutivo/a de ventas.<strong class="text-danger">*</strong></label>
                <input id="sellername" type="text" class="form-control" name="sellername" value="<?= $seller['name'] ?>" placeholder="Nombre completo" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="sellertel">Teléfono fijo.</label>
                <input id="sellertel" type="text" class="form-control" name="sellertel" value="<?= $seller['tel'] ?>" placeholder="Número de teléfono">
              </div>
              <div class="form-group">
                <label for="sellercell">Teléfono movil.<strong class="text-danger">*</strong></label>
                <input id="sellercell" type="text" class="form-control" name="sellercell" value="<?= $seller['cell'] ?>" placeholder="Número de teléfono" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="sellermail">Correo electrónico.<strong class="text-danger">*</strong></label></label>
                <input id="sellermail" type="email" class="form-control" name="sellermail" value="<?= $seller['email'] ?>" placeholder="Correo electrónico del ejecutivo de ventas" autocomplete="off" required>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" id="btn_register" class="btn btn-success">Registrar empresa</button>
              <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer bg-dark justify-content-between">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="upload_file">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title"><i class="fa-solid fa-upload"></i> Cargar un documento</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <p class="display-8">Tamaño máximo permitido: 100MB<strong class="text-danger">*</strong></p>
          <form id="upload-form" enctype="multipart/form-data">
            <div class="form-group">
              <label for="filename">Nombre</label>
              <input type="text" class="form-control" id="filename_form" name="filename" placeholder="escribe aqui el nombre del archivo" required>
            </div>
            <div class="form-group">
              <label for="archivo">Selecciona un archivo</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="archivo_form" name="archivo" aria-describedby="fileHelp" required>
                  <label class="custom-file-label" for="archivo">Seleccionar documento</label>
                  <small id="fileHelp" class="form-text text-muted">We'll never share your files with anyone else.</small>
                </div>
              </div>
            </div>
            <div class="form-group" style="margin-top: 60px;">
              <button type="submit" id="send_form" class="btn btn-primary">Cargar archivo</button>
              <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer bg-dark justify-content-between">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="upload_carta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title"><i class="fa-solid fa-upload"></i> Cargar carta de compromiso</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <p class="display-8">Tamaño máximo permitido: 100MB<strong class="text-danger">*</strong></p>
          <form id="upload-carta" enctype="multipart/form-data">
            <div class="form-group">
              <label for="filename">Nombre</label>
              <input type="text" class="form-control" id="filename_carta" name="filename" value="Carta de compromiso" disabled>
            </div>
            <div class="form-group">
              <label for="archivo">Selecciona un archivo</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="archivo_carta" name="archivo" aria-describedby="fileHelp" required>
                  <label class="custom-file-label" for="archivo">Seleccionar documento</label>
                  <small id="fileHelp" class="form-text text-muted">We'll never share your files with anyone else.</small>
                </div>
              </div>
            </div>
            <div class="form-group mt-4">
              <button type="submit" id="send_carta" class="btn btn-sm btn-dark">Cargar carta de compromiso</button>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer bg-dark justify-content-between">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="upload_cuestionario">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title"><i class="fa-solid fa-upload"></i> Cargar Cuestionario de homologación</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="alert alert-light" role="alert">
            <h5>¿Estás seguro/a de cargar el cuestionario de homologación?</h5>
            <p>Al dar click en <i>cargar cuestionario,</i> el sistema notificará al personal encargado de tu respuesta y el documento se cargará y no se podrá editar o borrar.</p>
          </div>
          <form id="upload-cuestionario" enctype="multipart/form-data">
            <div class="form-group">
              <label for="filename">Nombre</label>
              <input type="text" class="form-control" id="filename_quiz" name="filename" value="Cuestionario de homologación" disabled>
            </div>
            <div class="form-group">
              <label for="archivo">Selecciona un archivo</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="archivo_quiz" name="archivo" aria-describedby="fileHelp" required>
                  <label class="custom-file-label" for="archivo">Seleccionar documento</label>
                  <small id="fileHelp" class="form-text text-muted">We'll never share your files with anyone else.</small>
                </div>
              </div>
            </div>
            <h6>Tamaño máximo permitido: 100MB<strong class="text-danger">*</strong></h6>
            <div class="form-group mt-4">
              <button type="submit" id="send_quiz" class="btn btn-sm btn-dark">Cargar cuestionario</button>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer bg-dark justify-content-between">
      </div>
    </div>
  </div>
</div>


<?php require_once APP . "/views/master/footer_js.php"; ?>

<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="dist/js/updateprovider.js" type="module"></script>
<script src="dist/js/uploadfile.js"></script>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/datatable.js"></script>

<script src="dist/js/myprovider_profile.js"></script>

<?php require_once APP . "/views/master/footer_end.php"; ?>