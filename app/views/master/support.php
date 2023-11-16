<?php require_once APP . "/views/master/header.php"; ?>

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= LANG['support'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?req=home"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active"><?= LANG['support'] ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title"><?= LANG['support_title'] ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="support-form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="subject"><?= LANG['subject'] ?></label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="<?= LANG['subject'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="mssg"><?= LANG['comments'] ?></label>
                    <textarea class="form-control" id="mssg" name="mssg" rows="3" placeholder="<?= LANG['comments'] ?>." required></textarea>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-dark"><?= LANG['send'] ?></button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>

          <div class="col-md-8">
          <div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title"><?= LANG['history_msg'] ?></h3>
            </div>
            <div class="direct-chat-messages" style="height: 320px !important;">
            <?= $objHome->historysupportreq($_SESSION['session_providers']['id']); ?>
            </div>
          </div>
          <!-- /.card -->
        </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- SweetAlert2 -->

<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="dist/js/supportreq.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>
