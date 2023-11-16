<?php require_once APP."/views/master/header.php"; ?>

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-money-check-edit"></i> <?= LANG['new_user'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?request=home"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active"><?= LANG['new_user'] ?></li>
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
          <!-- left column -->
          <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <!-- general form elements -->
            <div class="card card-primary card-outline">
              <!-- form start -->
              <form id="register-form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name"><?= LANG['full_name'] ?></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="<?= LANG['full_name'] ?>" autofocus required>
                  </div>
                  <div class="form-group">
                    <label for="position"><?= LANG['label_position'] ?></label>
                    <input type="text" class="form-control" id="position" name="position" placeholder="<?= LANG['position'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="region"><?= LANG['region'] ?></label>
                    <select name="region" id="region" class="form-control">
                      <?php $regions = $model->region_list(); ?>
                      <?php foreach ($regions['idregion'] as $key => $val): ?>
                        <option value="<?= $val ?>"><?= $regions['region'][$key] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="level"><?= LANG['level'] ?></label>
                    <select name="level" id="level" class="form-control">
                      <?php $levels = $model->level_list(); ?>
                      <?php foreach ($levels['id'] as $key => $val): ?>
                        <option value="<?= $val ?>"><?= $levels['level'][$key] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="language"><?= LANG['lang'] ?></label>
                    <select name="language" id="language" class="form-control" <?= $disabled ?>>
                      <?php $langs = $model->lang_list(); ?>
                      <?php foreach ($langs['idlang'] as $key => $val): ?>
                        <option value="<?= $val ?>"><?= $langs['language'][$key] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="email"><?= LANG['email'] ?></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="<?= LANG['email'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="email2"><?= LANG['repeat_email'] ?></label>
                    <input type="email" class="form-control" id="email2" name="email2" placeholder="<?= LANG['repeat_email'] ?>" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" id="btn_register" class="btn btn-primary btn-block" disabled><?= LANG['register_user'] ?></button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="dist/js/register.js" type="module"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>
