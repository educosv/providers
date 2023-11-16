<?php require_once APP."/views/master/header.php"; ?>

<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= LANG['support_logs'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?request=home"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active"><?= LANG['support_logs'] ?></li>
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
          <div class="col-12">
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped <?= LANG['datable'] ?>">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th><?= LANG['full_name'] ?></th>
                      <th><?= LANG['email'] ?></th>
                      <th><?= LANG['position'] ?></th>
                      <th><?= LANG['level'] ?></th>
                      <th><?= LANG['subject'] ?></th>
                      <th><?= LANG['status'] ?></th>
                      <th><?= LANG['actions'] ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $support = $model->support_list(); ?>
                    <?php if ($support): ?>
                      <?php $no = 1; ?>
                      <?php foreach ($support['idsupport'] as $i => $val): ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><?= $support['name'][$i] ?></td>
                          <td><?= $support['email'][$i] ?></td>
                          <td><?= $support['position'][$i] ?></td>
                          <td><?= $support['level'][$i] ?></td>
                          <td><?= $support['subject'][$i] ?></td>
                          <td>
                            <?php if ($support['idstatus'][$i] == 5): ?>
                            <span class="badge badge-warning"><?= $support['status'][$i] ?></span>
                            <?php else: ?>
                            <span class="badge badge-success"><?= $support['status'][$i] ?></span>
                            <?php endif ?>
                          </td>
                          <td>
                            <?php if ($support['idstatus'][$i] == 5): ?>
                            <button type="button" class="btn btn-sm btn-primary" onclick="getmssg(<?= $val ?>);">
                              <?= LANG['set_answer'] ?>
                            </button>
                            <?php else: ?>
                            <button type="button" class="btn btn-sm btn-warning" onclick="getmssg(<?= $val ?>);">
                              <?= LANG['edit_answer'] ?>
                            </button>
                            <?php endif ?>
                          </td>
                        </tr>
                        <?php $no++; ?>
                      <?php endforeach ?>
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="modal-request">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="name"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="subject"></p>
            <p id="mssg"></p>
            <div class="form-group">
              <label for="response">Respuesta:</label>
              <textarea id="response" class="form-control"></textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?= LANG['close'] ?></button>
            <button type="button" class="btn btn-primary" id="sendres"><?= LANG['send_answer'] ?></button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/datatable.js"></script>
<script src="dist/js/sudosupports.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>