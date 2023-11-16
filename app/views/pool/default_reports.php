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
            <h1><?= LANG['reports'] ?></h1>
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
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h4><?= LANG['select_report'] ?></h4>
                <div class="row">
                  <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link active" id="vert-tabs-users-tab" data-toggle="pill" href="#vert-tabs-users" role="tab" aria-controls="vert-tabs-users" aria-selected="true"><?= LANG['user_list'] ?></a>
                      <a class="nav-link" id="vert-tabs-supports-tab" data-toggle="pill" href="#vert-tabs-supports" role="tab" aria-controls="vert-tabs-supports" aria-selected="false"><?= LANG['support_list'] ?></a>
                    </div>
                  </div>
                  <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                      <div class="tab-pane text-left fade show active" id="vert-tabs-users" role="tabpanel" aria-labelledby="vert-tabs-users-tab">
                        <div class="row">
                          <div class="col-12">
                            <table class="table table-bordered table-striped <?= LANG['datable'] ?>">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th><?= LANG['name'] ?></th>
                                <th><?= LANG['email'] ?></th>
                                <th><?= LANG['position'] ?></th>
                                <th><?= LANG['permission'] ?></th>
                                <th><?= LANG['register_type'] ?></th>
                                <th><?= LANG['status'] ?></th>
                              </tr>
                            </thead>
                            <?php $user_data = $model->user_list(); ?>
                            <tbody>
                              <?php if ($user_data): ?>
                              <?php foreach ($user_data['id'] as $i => $val): ?>
                              <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= $user_data['name'][$i] ?></td>
                                <td><?= $user_data['email'][$i] ?></td>
                                <td><?= $user_data['position'][$i] ?></td>
                                <td><?= $user_data['level'][$i] ?></td>
                                <td><?= $user_data['registertype'][$i] ?></td>
                                <td><?= $user_data['status'][$i] ?></td>
                              </tr>
                              <?php endforeach ?>
                              <?php endif ?>
                            </tbody>
                            </table>
                          </div>
                        </div>
                        <?php if ($user_data): ?>
                        <div class="row mt-3">
                          <div class="col-12">
                            <form action="pdf_report" method="get">
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" id="hr_users" name="horizontal">
                                  <label for="hr_users" class="custom-control-label"><?= LANG['hr_report'] ?></label>
                                </div>
                              </div>
                              <a href="<?= URL ?>xls_report?xls_req=user_list" class="btn btn-sm btn-success" title="Imprimir en formato XLS"><?= LANG['print_xls'] ?></a>
                              <button type="submit" class="btn btn-sm btn-danger" name="pdf_req" value="user_list"><?= LANG['print_pdf'] ?></button>
                            </form>
                          </div>
                        </div>
                        <?php endif ?>
                      </div>
                      <div class="tab-pane fade" id="vert-tabs-supports" role="tabpanel" aria-labelledby="vert-tabs-supports-tab">
                        <div class="row">
                          <div class="col-12">
                            <table class="table table-bordered table-striped <?= LANG['datable'] ?>">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th><?= LANG['user'] ?></th>
                                <th><?= LANG['email'] ?></th>
                                <th><?= LANG['subject'] ?></th>
                                <th><?= LANG['message'] ?></th>
                                <th><?= LANG['response'] ?></th>
                                <th><?= LANG['status'] ?></th>
                              </tr>
                            </thead>
                            <?php $data = $model->support_list(); ?>
                            <tbody>
                              <?php if ($data): ?>
                              <?php foreach ($data['idsupport'] as $i => $val): ?>
                              <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= $data['name'][$i] ?></td>
                                <td><?= $data['email'][$i] ?></td>
                                <td><?= $data['subject'][$i] ?></td>
                                <td><?= $data['mssg'][$i] ?></td>
                                <td><?= $data['response'][$i] ?></td>
                                <td><?= $data['status'][$i] ?></td>
                              </tr>
                              <?php endforeach ?>
                              <?php endif ?>
                            </tbody>
                            </table>
                          </div>
                        </div>
                        <?php if ($data): ?>
                        <div class="row mt-3">
                          <div class="col-12">
                            <form action="pdf_report" method="get">
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" id="hr_support" name="horizontal">
                                  <label for="hr_support" class="custom-control-label"><?= LANG['hr_report'] ?></label>
                                </div>
                              </div>
                              <a href="<?= URL ?>xls_report?xls_req=support_list" class="btn btn-sm btn-success" title="Imprimir en formato XLS"><?= LANG['print_xls'] ?></a>
                              <button type="submit" class="btn btn-sm btn-danger" name="pdf_req" value="support_list"><?= LANG['print_pdf'] ?></button>
                            </form>
                          </div>
                        </div>
                        <?php endif ?>
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

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/datatable.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>

