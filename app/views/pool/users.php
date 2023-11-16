<?php require_once APP."/views/master/header.php"; ?>

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-users"></i> <?= LANG['user_list'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?request=home"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active"><?= LANG['user_list'] ?></li>
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
                      <th>No.</th>
                      <th><?= LANG['name'] ?></th>
                      <th><?= LANG['email'] ?></th>
                      <th><?= LANG['position'] ?></th>
                      <th><?= LANG['permission'] ?></th>
                      <th><?= LANG['status'] ?></th>
                      <th><?= LANG['actions'] ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $users = $model->user_list(); ?>
                    <?php if ($users): ?>
                      <?php $no = 1; ?>
                      <?php foreach ($users['id'] as $i => $val): ?>
                        <?php if ($val != $_SESSION['session_providers']['id']): ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><?= $users['name'][$i] ?></td>
                          <td><?= $users['email'][$i] ?></td>
                          <td><?= $users['position'][$i] ?></td>
                          <?php
                          switch ($users['idlvl'][$i]) {
                            case 1:
                              echo "<td><span class='badge badge-pill badge-dark'>{$users['level'][$i]}</span></td>";
                            break;

                            case 2:
                              echo "<td><span class='badge badge-pill badge-educoinfo'>{$users['level'][$i]}</span></td>";
                            break;

                            case 3:
                              echo "<td><span class='badge badge-pill badge-educowarning'>{$users['level'][$i]}</span></td>";
                            break;

                            case 4:
                              echo "<td><span class='badge badge-pill badge-educodanger'>{$users['level'][$i]}</span></td>";
                            break;
                          }
                          ?>
                          <?php
                          switch ($users['idstatus'][$i]) {
                            case 1:
                              echo "<td><span class='badge badge-pill badge-success'>{$users['status'][$i]}</span></td>";
                            break;

                            case 2:
                              echo "<td><span class='badge badge-pill badge-danger'>{$users['status'][$i]}</span></td>";
                            break;

                            default:
                              echo "<td><span class='badge badge-pill badge-dark'>desconocido</span></td>";
                            break;
                          }
                          ?>
                          <td>
                            <a href="<?= URL ?>?req=user_profile&val=<?= $val ?>" class="btn btn-sm btn-dark">
                              Ver perfil
                            </a>
                          </td>
                        </tr>
                        <?php $no++; ?>
                        <?php endif ?>
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

  </div>
</div>


<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/datatable.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>
