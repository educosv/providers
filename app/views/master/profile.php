<?php require_once APP . "/views/master/header.php"; ?>

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

<?php $disabled = (isset($_SESSION['updateInfoUser'])) ? '' : 'disabled'; ?>

<?php $lvl = $model->level_list(); ?>

<?php $fotos = $model->thumbnail_profile(); ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-id-badge"></i> <?= LANG['my_user'] ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= URL ?>?req=home"><?= LANG['home'] ?></a></li>
            <li class="breadcrumb-item active"><?= LANG['my_user'] ?></li>
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
                <img class="profile-user-img img-fluid img-circle" src="data:image/png;base64,<?= $_SESSION['session_providers']['pic'] ?>" alt="User profile picture" data-toggle="modal" data-target="#picProfile">
              </div>

              <h3 class="profile-username text-center"><?= $_SESSION['session_providers']['name'] ?></h3>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b><?= LANG['label_position'] ?></b> <br>
                  <a class="float-left"><?= $_SESSION['session_providers']['position'] ?></a>
                </li>
                <li class="list-group-item">
                  <b><?= LANG['level'] ?></b> <br>
                  <a class="float-left"><?= $_SESSION['session_providers']['level'] ?></a>
                </li>
                <li class="list-group-item">
                  <?php if (!isset($_SESSION['updateInfoUser'])) : ?>
                  <a href="<?= URL ?>?event=upInfo&val=on" class="btn btn-primary btn-block"><?= LANG['update_info'] ?></a>
                  <?php else : ?>
                  <a href="<?= URL ?>?event=upInfo&val=off" class="btn btn-warning btn-block"><?= LANG['finish_update'] ?></a>
                  <?php endif ?>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card card-dark card-outline">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="#info" id="profile-info-tab" data-toggle="tab"><?= LANG['information'] ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#access" id="profile-access-tab" data-toggle="tab"><?= LANG['access'] ?></a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="info">
                  <form id="user-profile-form">
                    <div class="form-group row">
                      <label for="name" class="col-sm-2 col-form-label"><?= LANG['full_name'] ?></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['session_providers']['name'] ?>" placeholder="<?= LANG['full_name'] ?>" <?= $disabled ?> autofocus>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="position" class="col-sm-2 col-form-label"><?= LANG['label_position'] ?></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="position" name="position" value="<?= $_SESSION['session_providers']['position'] ?>" placeholder="<?= LANG['position'] ?>" <?= $disabled ?>>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="language" class="col-sm-2 col-form-label"><?= LANG['lang'] ?></label>
                      <div class="col-sm-10">
                        <?php $langs = $model->lang_list(); ?>
                        <select id="language" name="language" class="form-control" <?= $disabled ?>>
                          <?php foreach ($langs['idlang'] as $i => $val): ?>
                            <?php $selected = ($val == $_SESSION['session_providers']['idlang']) ? 'selected' : ''; ?>
                            <option value="<?= $val ?>" <?= $selected ?>><?= $langs['language'][$i] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <?php if (isset($_SESSION['updateInfoUser'])) : ?>
                    <div class="form-group row">
                      <div class="col-12">
                        <button type="submit" class="btn btn-success float-right"><?= LANG['update_info'] ?></button>
                      </div>
                    </div>
                    <?php endif ?>
                  </form>
                </div>

                <div class="tab-pane" id="access">
                  <form class="form-horizontal">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label"><?= LANG['account'] ?></label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputName" value="<?= $_SESSION['session_providers']['email'] ?>" disabled="true">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_pwd">
                          <i class="fas fa-key"></i> <?= LANG['update_pass'] ?>
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
  </section>
</div>

<div class="modal fade" id="modal_pwd">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-key"></i> <?= LANG['update_pass'] ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form id="password-form">
            <div class="form-group">
              <label for="pass1"><?= LANG['new_pass'] ?></label>
              <input type="password" class="form-control" name="pass1" id="pass1" placeholder="<?= LANG['new_pass'] ?>" onkeyup="validapass1()" required>
              <small id="mnsj" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="pass2"><?= LANG['repeat_pass'] ?></label>
              <input type="password" class="form-control" name="pass2" id="pass2" placeholder="<?= LANG['repeat_pass'] ?>" onkeyup="validapass2()" required>
              <small id="mnsj2" class="form-text text-muted"></small>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="button" class="btn btn-default float-left" data-dismiss="modal"><?= LANG['close'] ?></button>
                <button type="submit" class="btn btn-dark float-right" id="btn_pass"><?= LANG['restore_pass'] ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer bg-dark justify-content-between">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="picProfile">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-users"></i> Seleccionar imagen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless">
          <tbody>
            <?php $r = round(count($fotos['id']) / 4); $y = 3; $x = 0; ?>
            <?php for ($i = 0; $i <= $r; $i++): ?>
              <tr>
              <?php for ($j = $x; $j <= $y; $j++): ?>
                <?php if ($j != count($fotos['id'])): ?>
                <td>
                  <img src="data:image/png;base64,<?= $fotos['pic'][$j] ?>" class="w-75 imgProfile" onclick="picprofile(<?= $fotos['id'][$j] ?>);">
                </td>
                <?php else: ?>
                <?php break; ?>
                <?php endif ?>
              <?php endfor ?>
              </tr>
              <?php $x = $j; $y += ($i == $r) ? 3 : 4; ?>
            <?php endfor ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer bg-primary justify-content-between">
      </div>
    </div>
  </div>
</div>


<?php require_once APP . "/views/master/footer_js.php"; ?>

<script src="dist/js/usrprofilesettings.js"></script>
<script src="dist/js/pwdvalidate.js"></script>
<script src="dist/js/updtpwd.js"></script>
<script src="dist/js/updtusr-users.js"></script>

<?php require_once APP . "/views/master/footer_end.php"; ?>