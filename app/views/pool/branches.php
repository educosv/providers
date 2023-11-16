<?php require_once APP."/views/master/header.php"; ?>

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

<?php $branches = $model->branch_list(); ?>

<?php
  $active1 = ''; $active2 = '';

  if (isset($_SESSION['tab_selected']))
  {
    switch ($_SESSION['tab_selected']) {
      case 'branch-list':
        $active1 = 'active';
      break;

      case 'new-branch':
        $active2 = 'active';
      break;

      default:
        $active1 = 'active';
      break;
    }
  }
  else
  {
    $active1 = 'active';
  }
?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fa-solid fa-cubes"></i> Rubros</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?request=home"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active">Rubros</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-dark card-outline">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link <?= $active1 ?>" href="#branch-list" id="tab-branch-list" data-toggle="tab" onclick="selecttab('branch-list');">Rubros</a></li>
                  <li class="nav-item"><a class="nav-link <?= $active2 ?> " href="#new-branch" id="tab-new-branch" data-toggle="tab" onclick="selecttab('new-branch');">Nuevo</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="<?= $active1 ?> tab-pane" id="branch-list">
                    <div class="row">
                      <div class="col-12">
                        <table class="table table-striped datable_es">
                          <thead class="bg-dark">
                            <tr>
                              <td>No</td>
                              <td>Rubro</td>
                              <td>Estado</td>
                              <td>Acciones</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($branches)): ?>
                            <?php $n = 1; ?>
                            <?php foreach ($branches['idbranch'] as $i => $id): ?>
                            <tr>
                              <td><?= $n ?></td>
                              <td><?= $branches['branch'][$i] ?></td>
                              <td>
                                <?php if ($branches['idstatus'][$i] == 2): ?>
                                <span class="badge badge-pill badge-danger"><?= $branches['status'][$i] ?></span>
                                <?php else: ?>
                                <span class="badge badge-pill badge-success"><?= $branches['status'][$i] ?></span>
                                <?php endif ?>
                              </td>
                              <td>
                                <button type="button" class="btn btn-sm btn-info" onclick="edit(<?= $id ?>);" data-toggle="tooltip" data-bs-placement="top" title="Editar registro">
                                  <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <?php $btn = ($branches['idstatus'][$i] == 1) ? ['btn-warning', 'desactivar'] : ['btn-success', 'activar']; ?>
                                <button type="button" class="btn btn-sm <?= $btn[0] ?>" onclick="change(<?= $id ?>, <?= $branches['idstatus'][$i] ?>);" data-toggle="tooltip" data-bs-placement="top" title="<?= $btn[1] ?>">
                                  <i class="fa-solid fa-rotate"></i>
                                </button>
                              </td>
                            </tr>
                            <?php $n++; ?>
                            <?php endforeach ?>
                            <?php endif ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="<?= $active2 ?> tab-pane" id="new-branch">
                    <div class="row">
                      <div class="col-12">
                        <div class="card card-dark">
                          <div class="card-header">
                            <h3 class="card-title">Nuevo rubro</h3>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12">
                                <form id="new_form">
                                  <div class="form-row">
                                    <div class="col-12">
                                      <div class="form-group">
                                        <label for="new-branch">Rubro</label>
                                        <div class="input-group">
                                          <input type="text" class="form-control" id="new-branch" name="branch" placeholder="rubro" required autofocus>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-row mt-4">
                                    <div class="col-12">
                                      <button type="submit" class="btn btn-sm btn-success" id="btn_newbranch">
                                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                                      </button>
                                      <button type="reset" class="btn btn-sm btn-danger" id="btn_cancel">
                                        <i class="fa-solid fa-ban"></i> Cancelar
                                      </button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
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
</div>

<div class="modal fade" id="edit-branch">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Editar rubro</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_form" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
          <div class="form-row">
            <div class="col-12">
              <div class="form-group">
                <label for="editbranch">Rubro</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="editbranch" name="editbranch" placeholder="rubro" required autofocus>
                </div>
              </div>
            </div>
          </div>
          <div class="form-row mt-4">
            <div class="col-12 col-sm-6 col-md-12">
              <button type="button" class="btn btn-sm btn-dark float-left" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-sm btn-info float-right" id="btn_editbranch">
                Editar rubro <i class="fa-solid fa-angle-right"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-dark">
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

<script src="dist/js/branches.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>