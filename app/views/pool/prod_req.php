<?php require_once APP."/views/master/header.php"; ?>

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Compra de productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?request=home"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active">Nueva solicitud</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="row">
              <div class="col-12">
                <h3>Indicaciones</h3>
                <p>
                  Selecciona los datos relevantes a tu solicitud, luego en breves palabras describa el servicio que desea solicitar. Posteriormente da clic en <strong class="text-blue">Enviar solicitud</strong>
                </p>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12">
                <form id="service-form">
                  <div class="form-row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="proyecto">Proyecto</label>
                        <?php $projects = $model->projects_list(); ?>
                        <select class="form-control select2" id="proyecto">
                          <option value="0">Selecciona un proyecto</option>
                          <?php foreach ($projects['idproject'] as $i => $id): ?>
                          <option value="<?= $id ?>">
                            <?= $projects['codproject'][$i] ?> | <?= $projects['shortname'][$i] ?>
                          </option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="actividad">Actividad</label>
                        <select class="form-control select2" id="actividad">
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-12 col-md-8">
                      <div class="form-group">
                        <label for="financiador">Financiador</label>
                        <?php $funders = $model->funders_list(); ?>
                        <select class="form-control select2" id="financiador">
                          <?php foreach ($funders['idfunder'] as $i => $id): ?>
                          <option value="<?= $id ?>">
                            <?= $funders['codfunder'][$i] ?> | <?= $funders['name'][$i] ?>
                          </option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-md-4">
                      <div class="form-group">
                      <label for="precio">Precio presupuestado</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="text" id="precio" class="form-control" placeholder="00.00">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="ccoste">Centro de coste</label>
                        <?php $ccoste = $model->cost_centers(); ?>
                        <select class="form-control select2" id="ccoste">
                          <?php foreach ($ccoste['idcostcenter'] as $i => $id): ?>
                          <option value="<?= $id ?>">
                            <?= $ccoste['idcostcenterregion'][$i] ?> | <?= $ccoste['name'][$i] ?>
                          </option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="ccontable">Cuenta contable</label>
                        <?php $ccontables = $model->accounts_list(); ?>
                        <select class="form-control select2" id="ccontable">
                          <?php foreach ($ccontables['idaccount'] as $i => $id): ?>
                            <option value="<?= $id ?>">
                              <?= $ccontables['account'][$i] ?> <?= $ccontables['description'][$i] ?>
                            </option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-12">
                      <label>
                        Periodo de realización
                        <a tabindex="0" class="btn btn-link" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="Nota" data-content="Si es un evento establezca su fecha exacta en inicio y fin, si es una consultoría, establezca el periodo de contratación."><i class="fa-solid fa-circle-info"></i></a>
                      </label>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <div class="form-group">
                        <label for="initd">Fecha inicial</label>
                        <input type="date" name="initd" id="initd" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <div class="form-group">
                        <label for="endd">Fecha final</label>
                        <input type="date" name="endd" id="endd" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-row mt-4">
                    <div class="col-12">
                      <div class="form-group">
                        <label>¿La solicitud está prevista en el presupuesto?</label>
                      </div>
                      <div class="form-group">
                        <div class="icheck-primary d-inline mr-3">
                          <input type="radio" id="pspt1" name="pspt" checked>
                          <label for="pspt1">Si</label>
                        </div>
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="pspt0" name="pspt">
                          <label for="pspt0">No</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-row mt-2">
                    <div class="col-12">
                      <div class="form-group">
                        <label>¿Están requeridos los fondos?</label>
                      </div>
                      <div class="form-group">
                        <div class="icheck-primary d-inline mr-3">
                          <input type="radio" id="fondos1" name="fondos" checked>
                          <label for="fondos1">Si</label>
                        </div>
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="fondos0" name="fondos">
                          <label for="fondos0">No</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-row mt-2">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="servicio">Describa el servicio</label>
                        <textarea class="form-control" id="servicio" rows="3" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="justificacion">Justificación de la compra/contratación</label>
                        <textarea class="form-control" id="justificacion" rows="3" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea class="form-control" id="observaciones" rows="3" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-12">
                      <button type="button" class="btn btn-success" id="init-service">Iniciar solicitud</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>


<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/datatable.js"></script>

<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script src="dist/js/nueva_solicitud.js"></script>

<script>
  $(()=>{
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  })
</script>

<?php require_once APP."/views/master/footer_end.php"; ?>