<?php require_once APP."/views/master/header.php"; ?>

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fa-solid fa-envelope-open-text"></i> Buzón de quejas, sugerencias y felicitaciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?request=home"><?= LANG['home'] ?></a></li>
              <li class="breadcrumb-item active">Buzón</li>
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
                <div class="row">
                  <div class="col-12">
                    <h4 class="alert-heading">Hola <?= $_SESSION['session_providers']['name'] ?>!</h4>
                    <p> bienvenido/a al buzón de quejas, sugerencias y felicitaciones. Tus opiniones son muy importantes para nosotros, por lo cual, hemos creado este espacio para que nos compartas tus apreciaciones de nuestro trabajo contigo. Por seguridad, toda la información que tu compartas en este formulario será utilizada de manera confidencial.
                    </p>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-12">
                    <form id="providerform">
                      <div class="form-row">
                        <div class="form-group col-12 col-md-7">
                          <label for="subject">Asunto:</label>
                          <input type="text" class="form-control" id="subject" name="subject" aria-describedby="asuntoHelp" placeholder="Escribe el asunto de tu mensaje" autocomplete="off" required>
                          <small id="asuntoHelp" class="form-text text-muted">Escribe brevemente el asunto de tu caso.</small>
                        </div>
                        <div class="form-group col-12 col-md-5">
                          <label for="type">Tipo de caso:</label>
                          <select name="type" id="type" class="form-control" required>
                            <option value="1">Queja</option>
                            <option value="2">Sugerencia</option>
                            <option value="3">Felicitaciones</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-12">
                          <label for="mnsj">Describe brevemente tu caso:</label>
                          <textarea class="form-control" id="mnsj" wrap="soft" name="mnsj" rows="5" placeholder="Cantidad de caracteres permitidos: 1,000" maxlength="10000" required></textarea>
                          <input type="hidden" name="name" value="<?= $_SESSION['session_providers']['name'] ?>">
                          <input type="hidden" name="email" value="<?= $_SESSION['session_providers']['email'] ?>">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-educo">
                        <i class="fas fa-edit"></i> Enviar caso
                      </button>
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
</div>


<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="dist/js/mailbox.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>