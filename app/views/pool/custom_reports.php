<?php require_once APP."/views/master/header.php"; ?>

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

<?php $users = (isset($_SESSION['custom_users_fields'])) ? $_SESSION['custom_users_fields'] : false; ?>
<?php $supports = (isset($_SESSION['custom_supports_fields'])) ? $_SESSION['custom_supports_fields'] : false; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= LANG['custom_reports'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?request=home"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active"><?= LANG['reports'] ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h4><?= LANG['select_report'] ?></h4>
                <div class="row">
                  <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link active" id="usuarios-tab" data-toggle="pill" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="true"><?= LANG['user_list'] ?></a>
                      <a class="nav-link" id="soportes-tab" data-toggle="pill" href="#soportes" role="tab" aria-controls="soportes" aria-selected="false"><?= LANG['support_list'] ?></a>
                    </div>
                  </div>
                  <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                      <div class="tab-pane text-left fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                        <div class="row">
                          <div class="col-12">
                            <button type="button" id="users_nombre" class="btn btn-sm btn-primary"><?= LANG['name'] ?></button>
                            <button type="button" id="users_email" class="btn btn-sm btn-secondary"><?= LANG['email'] ?></button>
                            <button type="button" id="users_cargo" class="btn btn-sm btn-success"><?= LANG['position'] ?></button>
                            <button type="button" id="users_permiso" class="btn btn-sm btn-danger"><?= LANG['permission'] ?></button>
                            <button type="button" id="users_registro" class="btn btn-sm btn-warning"><?= LANG['register_type'] ?></button>
                            <button type="button" id="users_idioma" class="btn btn-sm btn-light"><?= LANG['language'] ?></button>
                            <button type="button" id="users_imagen" class="btn btn-sm btn-info"><?= LANG['image'] ?></button>
                            <button type="button" id="users_estado" class="btn btn-sm btn-dark"><?= LANG['status'] ?></button>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-12">
                            <span class="badge bg-dark btn" id="users_badge_nombre">
                              <?= LANG['name'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="users_badge_email">
                              <?= LANG['email'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="users_badge_cargo">
                              <?= LANG['position'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="users_badge_permiso">
                              <?= LANG['permission'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="users_badge_registro">
                              <?= LANG['register_type'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="users_badge_idioma">
                              <?= LANG['language'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="users_badge_imagen">
                              <?= LANG['image'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="users_badge_estado">
                              <?= LANG['status'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                          </div>
                        </div>
                        <div class="row mt-4">
                          <div class="col-12" id="table_users"></div>
                        </div>
                        <div class="row mt-3" id="print_users">
                          <div class="col-12">
                            <form action="pdf_report" method="get">
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" id="hr_users" name="horizontal">
                                  <label for="hr_users" class="custom-control-label"><?= LANG['hr_report'] ?></label>
                                </div>
                              </div>
                              <a href="<?= URL ?>xls_report?xls_req=custom_user_list" class="btn btn-sm btn-success" title="Imprimir en formato XLS"><?= LANG['print_xls'] ?></a>
                              <button type="submit" class="btn btn-sm btn-danger" name="pdf_req" value="custom_user_list"><?= LANG['print_pdf'] ?></button>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="soportes" role="tabpanel" aria-labelledby="soportes-tab">
                        <div class="row">
                          <div class="col-12">
                            <button type="button" id="supports_nombre" class="btn btn-sm btn-primary"><?= LANG['name'] ?></button>
                            <button type="button" id="supports_email" class="btn btn-sm btn-secondary"><?= LANG['email'] ?></button>
                            <button type="button" id="supports_cargo" class="btn btn-sm btn-success"><?= LANG['position'] ?></button>
                            <button type="button" id="supports_permiso" class="btn btn-sm btn-danger"><?= LANG['permission'] ?></button>
                            <button type="button" id="supports_registro" class="btn btn-sm btn-warning"><?= LANG['register_type'] ?></button>
                            <button type="button" id="supports_idioma" class="btn btn-sm btn-light"><?= LANG['language'] ?></button>
                            <button type="button" id="supports_imagen" class="btn btn-sm btn-info"><?= LANG['image'] ?></button>
                            <button type="button" id="supports_estado" class="btn btn-sm btn-dark"><?= LANG['status'] ?></button>
                            <button type="button" id="supports_asunto" class="btn btn-sm btn-primary"><?= LANG['subject'] ?></button>
                            <button type="button" id="supports_mensaje" class="btn btn-sm btn-secondary"><?= LANG['message'] ?></button>
                            <button type="button" id="supports_respuesta" class="btn btn-sm btn-success"><?= LANG['response'] ?></button>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-12">
                            <span class="badge bg-dark btn" id="supports_badge_nombre">
                              <?= LANG['name'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_email">
                              <?= LANG['email'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_cargo">
                              <?= LANG['position'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_permiso">
                              <?= LANG['permission'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_registro">
                              <?= LANG['register_type'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_idioma">
                              <?= LANG['language'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_imagen">
                              <?= LANG['image'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_estado">
                              <?= LANG['status'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_asunto">
                              <?= LANG['subject'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_mensaje">
                              <?= LANG['message'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                            <span class="badge bg-dark btn" id="supports_badge_respuesta">
                              <?= LANG['response'] ?> <span class="badge badge-light bg-secondary">X</span>
                            </span>
                          </div>
                        </div>
                        <div class="row mt-4">
                          <div class="col-12" id="table_supports"></div>
                        </div>
                        <div class="row mt-3" id="print_supports">
                          <div class="col-12">
                            <form action="pdf_report" method="get">
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" id="hr_supports" name="horizontal">
                                  <label for="hr_supports" class="custom-control-label"><?= LANG['hr_report'] ?></label>
                                </div>
                              </div>
                              <a href="<?= URL ?>xls_report?xls_req=custom_support_list" class="btn btn-sm btn-success" title="Imprimir en formato XLS"><?= LANG['print_xls'] ?></a>
                              <button type="submit" class="btn btn-sm btn-danger" name="pdf_req" value="custom_support_list"><?= LANG['print_pdf'] ?></button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php require_once APP."/views/master/footer_js.php"; ?>

<!-- Custom reports -->

<script>
  var showtable = (id, data) => {
    let table = document.getElementById(id);
    $.ajax({
      type: 'post',
      url: 'internal_data',
      data: data
    }).done(function(res){
      table.innerHTML = res;
    });

    $.ajax({
      type: 'post',
      url: 'internal_data',
      data: 'print_users'
    }).done(function(res){
      if (res)
        $('#print_users').show();
      else
        $('#print_users').hide();
    });

    $.ajax({
      type: 'post',
      url: 'internal_data',
      data: 'print_supports'
    }).done(function(res){
      if (res)
        $('#print_supports').show();
      else
        $('#print_supports').hide();
    });
  }

  $(document).ready(() => {

    showtable('table_users', 'custom_table_users');
    showtable('table_supports', 'custom_table_supports');

    /***** Para usuarios *****/

    <?php if ($users && count($users) > 0): ?>

      $('#print_users').show();

      //--------------------------------------------- nombre
      <?php if (in_array('nombre', $users)): ?>
        $('#users_badge_nombre').show();
        $('#users_nombre').hide();
      <?php else: ?>
        $('#users_badge_nombre').hide();
      <?php endif ?>
      //--------------------------------------------- email
      <?php if (in_array('email', $users)): ?>
        $('#users_badge_email').show();
        $('#users_email').hide();
      <?php else: ?>
        $('#users_badge_email').hide();
      <?php endif ?>
      //--------------------------------------------- cargo
      <?php if (in_array('cargo', $users)): ?>
        $('#users_badge_cargo').show();
        $('#users_cargo').hide();
      <?php else: ?>
        $('#users_badge_cargo').hide();
      <?php endif ?>
      //--------------------------------------------- permiso
      <?php if (in_array('permiso', $users)): ?>
        $('#users_badge_permiso').show();
        $('#users_permiso').hide();
      <?php else: ?>
        $('#users_badge_permiso').hide();
      <?php endif ?>
      //--------------------------------------------- registro
      <?php if (in_array('tipo_registro', $users)): ?>
        $('#users_badge_registro').show();
        $('#users_registro').hide();
      <?php else: ?>
        $('#users_badge_registro').hide();
      <?php endif ?>
      //--------------------------------------------- idioma
      <?php if (in_array('idioma', $users)): ?>
        $('#users_badge_idioma').show();
        $('#users_idioma').hide();
      <?php else: ?>
        $('#users_badge_idioma').hide();
      <?php endif ?>
      //--------------------------------------------- imagen
      <?php if (in_array('imagen', $users)): ?>
        $('#users_badge_imagen').show();
        $('#users_imagen').hide();
      <?php else: ?>
        $('#users_badge_imagen').hide();
      <?php endif ?>
      //--------------------------------------------- estado
      <?php if (in_array('estado', $users)): ?>
        $('#users_badge_estado').show();
        $('#users_estado').hide();
      <?php else: ?>
        $('#users_badge_estado').hide();
      <?php endif ?>

    <?php else: ?>

      $('#print_users').hide();
      $('#users_badge_nombre').hide();
      $('#users_badge_email').hide();
      $('#users_badge_cargo').hide();
      $('#users_badge_permiso').hide();
      $('#users_badge_registro').hide();
      $('#users_badge_idioma').hide();
      $('#users_badge_imagen').hide();
      $('#users_badge_estado').hide();

    <?php endif ?>

    /***** Para soportes *****/

    <?php if ($supports && count($supports) > 0): ?>

      $('#print_supports').show();

      //--------------------------------------------- nombre
      <?php if (in_array('nombre', $supports)): ?>
        $('#supports_badge_nombre').show();
        $('#supports_nombre').hide();
      <?php else: ?>
        $('#supports_badge_nombre').hide();
      <?php endif ?>
      //--------------------------------------------- email
      <?php if (in_array('email', $supports)): ?>
        $('#supports_badge_email').show();
        $('#supports_email').hide();
      <?php else: ?>
        $('#supports_badge_email').hide();
      <?php endif ?>
      //--------------------------------------------- cargo
      <?php if (in_array('cargo', $supports)): ?>
        $('#supports_badge_cargo').show();
        $('#supports_cargo').hide();
      <?php else: ?>
        $('#supports_badge_cargo').hide();
      <?php endif ?>
      //--------------------------------------------- permiso
      <?php if (in_array('permiso', $supports)): ?>
        $('#supports_badge_permiso').show();
        $('#supports_permiso').hide();
      <?php else: ?>
        $('#supports_badge_permiso').hide();
      <?php endif ?>
      //--------------------------------------------- registro
      <?php if (in_array('tipo_registro', $supports)): ?>
        $('#supports_badge_registro').show();
        $('#supports_registro').hide();
      <?php else: ?>
        $('#supports_badge_registro').hide();
      <?php endif ?>
      //--------------------------------------------- idioma
      <?php if (in_array('idioma', $supports)): ?>
        $('#supports_badge_idioma').show();
        $('#supports_idioma').hide();
      <?php else: ?>
        $('#supports_badge_idioma').hide();
      <?php endif ?>
      //--------------------------------------------- imagen
      <?php if (in_array('imagen', $supports)): ?>
        $('#supports_badge_imagen').show();
        $('#supports_imagen').hide();
      <?php else: ?>
        $('#supports_badge_imagen').hide();
      <?php endif ?>
      //--------------------------------------------- estado
      <?php if (in_array('estado', $supports)): ?>
        $('#supports_badge_estado').show();
        $('#supports_estado').hide();
      <?php else: ?>
        $('#supports_badge_estado').hide();
      <?php endif ?>
      //--------------------------------------------- asunto
      <?php if (in_array('asunto', $supports)): ?>
        $('#supports_badge_asunto').show();
        $('#supports_asunto').hide();
      <?php else: ?>
        $('#supports_badge_asunto').hide();
      <?php endif ?>
      //--------------------------------------------- mensaje
      <?php if (in_array('mensaje', $supports)): ?>
        $('#supports_badge_mensaje').show();
        $('#supports_mensaje').hide();
      <?php else: ?>
        $('#supports_badge_mensaje').hide();
      <?php endif ?>
      //--------------------------------------------- respuesta
      <?php if (in_array('respuesta', $supports)): ?>
        $('#supports_badge_respuesta').show();
        $('#supports_respuesta').hide();
      <?php else: ?>
        $('#supports_badge_respuesta').hide();
      <?php endif ?>

    <?php else: ?>

      $('#print_supports').hide();
      $('#supports_badge_nombre').hide();
      $('#supports_badge_email').hide();
      $('#supports_badge_cargo').hide();
      $('#supports_badge_permiso').hide();
      $('#supports_badge_registro').hide();
      $('#supports_badge_idioma').hide();
      $('#supports_badge_imagen').hide();
      $('#supports_badge_estado').hide();
      $('#supports_badge_asunto').hide();
      $('#supports_badge_mensaje').hide();
      $('#supports_badge_respuesta').hide();

    <?php endif ?>

  });
</script>

<script src="dist/js/custom_reports_add.js"></script>
<script src="dist/js/custom_reports_remove.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>