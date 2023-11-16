<?php

require_once "../app/config/config.php";
require_once "../app/controllers/Controller.php";

/*
|--------------------------------------------------------------------------
| Login with Firebase
|--------------------------------------------------------------------------
|
| Login de usuarios con firebase
|
*/


if (isset($_POST['localogin']))
{
	if (isset($_POST['remember']))
		$res = $objController->login($_POST['user'], 'local', $_POST['pwd'], 1);
	else
		$res = $objController->login($_POST['user'], 'local', $_POST['pwd']);

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Cookie login
|--------------------------------------------------------------------------
|
| Inicio de sesión usando acceso de cookie guardado
|
*/


if (isset($_POST['cookielogin']))
{
	$email = $model->get_cookie_token($_POST['token_login']);

	$user = (isset($_POST['user'])) ? preg_replace('([^A-Za-z0-9-_.@])', '', trim($_POST['user'])) : null;

	echo ($email === $user) ? json_encode($objController->login($user, 'cookie', null, null, $_POST['token_login'])) : json_encode(false);
}


/*
|--------------------------------------------------------------------------
| Login with Firebase
|--------------------------------------------------------------------------
|
| Login de usuarios con firebase
|
*/


if (isset($_POST['firelogin']))
{
	if ($objController->login($_POST['email'], 'social'))
	{
		echo json_encode(true);
	}
	else
	{
		$name = (isset($_POST['name'])) ? $_POST['name'] : 'Name empty';
		$_SESSION['new_name'] = $name;
		$email = (isset($_POST['email'])) ? $_POST['email'] : false;
		$_SESSION['new_email'] = $email;
		$position = (isset($_POST['position'])) ? $_POST['position'] : 'Position empty';
		$_SESSION['new_position'] = $position;

		if ($objController->newregister($name, $email, 1, 1, 2, $position, 'social'))
			echo json_encode($objController->login($email, 'social'));
		else
			echo json_encode(false);
	}
}


/*
|--------------------------------------------------------------------------
| Register with Firebase
|--------------------------------------------------------------------------
|
| Registro de usuarios con firebase
|
*/

if (isset($_POST['fireregister']))
{
	$name = (isset($_POST['name'])) ? $_POST['name'] : 'Name empty';
	$email = (isset($_POST['email'])) ? $_POST['email'] : false;

	echo json_encode($objController->newregister($name, $email, '', 1, 1, 3, 'social'));
}

/*
|--------------------------------------------------------------------------
| Registro de usuario
|--------------------------------------------------------------------------
|
| Comprobaciones de campos en registro local de usuario
|
*/

if (isset($_POST['newregister']))
{
	$name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : false;
	$position = (isset($_POST['position']) && !empty($_POST['position'])) ? $_POST['position'] : 'Empty';
	$email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : false;
	$email2 = (isset($_POST['email2']) && !empty($_POST['email2'])) ? $_POST['email2'] : false;

	if ($email == $email2) {
		if ($name && $position && $email && $email2) {
			$res = $objController->newregister($name, $email, 1, 1, 3, $position);
		}else {
			$res = false;
		}
	}else {
		$res = false;
	}

	echo json_encode($res);
}

/*
|--------------------------------------------------------------------------
| Activación de restablecimiento de contraseña
|--------------------------------------------------------------------------
|
| Ingreso de nueva contraseña
|
*/

if (isset($_POST['isavailablemail']))
{
	$email = (isset($_POST['email'])) ? preg_replace('([^A-Za-z-_.@ ])', '', trim($_POST['email'])) : null;

	$res = (!is_null($email)) ? $model->is_correct_mail($email) : false;

	echo json_encode($res);
}

if (isset($_POST['forgot-email']))
{
	// echo json_encode($objController->resetPass($_POST['forgot-email']));

	echo json_encode($objController->send_resetpass($_POST['mail']));
}


/*
|--------------------------------------------------------------------------
| Restablecer contraseña de usuario
|--------------------------------------------------------------------------
|
| Ingreso de nueva contraseña
|
*/


if (isset($_POST['restorepwd']))
{
	if (strlen($_POST['pass1']) >= 8 && strlen($_POST['pass2']) >= 8) {
		if ($_POST['pass1'] == $_POST['pass2']) {
			echo json_encode($objController->resetPassword($_POST['pass1']));
		}else {
			echo json_encode(false);
		}
	}else {
		echo json_encode(false);
	}
}

if (empty($_POST)) {
	header("Location: ".URL);
}