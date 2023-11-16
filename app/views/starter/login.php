<?php $email = (isset($_COOKIE['MONSTER'])) ? $model->get_cookie_token($_COOKIE['MONSTER']) : null; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta property="og:url" content="<?= URL ?>">
  <meta property="og:site_name" content="Fleetsys">
  <meta property="og:description" content="Sistema de control de flota vehicular | Fundación Educo">
  <meta property="og:image" content="<?= URL ?>dist/img/logo.png">
  <meta name="author" content="Isaac Ramos">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="dist/img/icono.ico">

  <title><?= APP_NAME ?></title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="dist/css/thistyle.css">
  <link rel="stylesheet" href="plugins/flag-icon-css/css/flag-icon.min.css">
  <style>
    body {
      background: transparent url("dist/img/index_background.png") no-repeat fixed 0px 0px / cover !important;
    }
  </style>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-EZWY6TMBTH"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-EZWY6TMBTH');
  </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="dist/img/logo.png" class="w-75">
  </div>
  <div class="card card-outline card-dark mt-4">
    <div class="card-body login-card-body">
      <h5 class="login-box-msg">Iniciar sesión</h5>

      <?php if (LC_LOGIN == true): ?>

      <?php if (!isset($_COOKIE['MONSTER'])): ?>

      <form id="login_form">
        <div class="input-group mb-3">
          <input type="email" name="user" id="user" class="form-control" placeholder="email" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pwd" id="pwd" class="form-control" placeholder="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember" value="1">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <div class="col-6">
            <button type="submit" class="btn btn-educodark btn-block">Iniciar sesión</button>
          </div>
        </div>
      </form>

      <?php else: ?>

      <form id="cookie_form">
        <div class="input-group mb-3">
          <input type="text" name="user" id="user" class="form-control" value="<?= $email ?>" disabled>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="icheck-primary">
              <p class="mb-1">
                <a href="<?= URL ?>?action=sessiondel" class="text-secondary">Olvidar sesión</a>
              </p>
            </div>
          </div>
          <div class="col-6">
            <input type="hidden" name="token_login" value="<?= $_COOKIE['MONSTER'] ?>">
            <button type="submit" class="btn btn-educodark btn-block">Iniciar sesión</button>
          </div>
        </div>
      </form>

      <?php endif ?>

      <?php endif ?>

      <?php if (FB_LOGIN == true || GL_LOGIN == true || TW_LOGIN == true || MS_LOGIN == true || GH_LOGIN == true): ?>

      <div class="social-auth-links text-center mb-3">

        <?php if (LC_LOGIN == true): ?>
        <p>- O puedes -</p>
        <?php endif ?>

        <?php if (FB_LOGIN == true): ?>
        <a href="#" class="btn btn-facebook btn-block btn-flat" id="fb">
          <i class="fab fa-facebook-f mr-2"></i> Login with Facebook
        </a>
        <?php endif ?>

        <?php if (GL_LOGIN == true): ?>
        <a href="#" class="btn btn-google btn-block btn-flat" id="gl">
          <i class="fab fa-google mr-2"></i> Login with Google
        </a>
        <?php endif ?>

        <?php if (MS_LOGIN == true): ?>
        <button class="btn btn-educo btn-block btn-flat" id="ms">
          <i class="fab fa-windows mr-2"></i> Acceder con cuenta @educo.org
        </button>
        <?php endif ?>

        <?php if (TW_LOGIN == true): ?>
        <a href="#" class="btn btn-twitter btn-block btn-flat" id="tw">
          <i class="fab fa-twitter mr-2"></i> Login with Twitter
        </a>
        <?php endif ?>

        <?php if (GH_LOGIN == true): ?>
        <a href="#" class="btn btn-dark btn-block btn-flat" id="gh">
          <i class="fab fa-github mr-2"></i> Login with github
        </a>
        <?php endif ?>

      </div>

      <?php endif ?>

      <?php if (LC_LOGIN == true): ?>

      <p class="mb-1">
        <a href="<?= URL ?>?action=forgot">Perdí mi contraseña</a>
      </p>

      <?php endif ?>

      <p class="mb-0">
        <a href="<?= URL ?>?action=register">Registrate en <?= APP_NAME ?></a>
      </p>

    </div>

  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (LC_LOGIN == true): ?>
  <?php if (!isset($_COOKIE['MONSTER'])): ?>
    <script src="dist/js/localogin.js"></script>
  <?php else: ?>
    <script src="dist/js/cookielogin.js"></script>
  <?php endif ?>
<?php endif ?>
<?php if (FB_LOGIN == true || GL_LOGIN == true || TW_LOGIN == true || MS_LOGIN == true || GH_LOGIN == true): ?>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-auth.js"></script>
<script src="dist/js/sociallogin.js" type="module"></script>
<?php endif ?>

</body>
</html>