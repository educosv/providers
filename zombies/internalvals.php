<?php

require_once "../app/config/config.php";
require_once "../app/controllers/HomeController.php";
require_once "../app/controllers/{$_SESSION['session_providers']['level']}Controller.php";
require_once '../app/config/languages/'.$_SESSION['lang']['lancode'].'.php';

/*
|--------------------------------------------------------------------------
| Acciones de alerta de bienvenida
|--------------------------------------------------------------------------
*/

if (isset($_POST['carta_checker']))
{
	$files = $model->file_list($_SESSION['session_providers']['id']);

	if ($files) {
		if (in_array('Carta_de_compromiso', $files['filename'])) {
			$res = false;
		}else {
			$res = true;
		}
	}else {
		$res = true;
	}

	echo json_encode($res);
}

if (isset($_POST['cuestionario_checker']))
{
	echo json_encode($model->homologacion_abierta($_SESSION['session_providers']['id']));
}

if (isset($_POST['add_carta_noti']))
{
	echo json_encode($model->add_carta_noti($_SESSION['session_providers']['id'], "Notificación inicial, carta enviada"));
}


/*
|--------------------------------------------------------------------------
| Pestañas de perfil personal
|--------------------------------------------------------------------------
|
| Recordatrorio de pestaña seleccionada
|
*/

if (isset($_POST['usrprofileselecttab'])) {
	$_SESSION['tab_selected'] = $_POST['usrprofileselecttab'];
	echo $_POST['usrprofileselecttab'];
}

if (isset($_POST['selecttab'])) {
	$res = (isset($_SESSION['tab_selected'])) ? $_SESSION['tab_selected'] : 'info';
	echo $res;
}


/*
|--------------------------------------------------------------------------
| Actualición de perfil de usuario
|--------------------------------------------------------------------------
|
| Edición de perfil de usuario
|
*/

if (isset($_POST['updtinfousr']))
{
	$name = (isset($_POST['name'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['name'])) : null;
	$position = (isset($_POST['position'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['position'])) : null;
	$region = (isset($_POST['region'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['region'])) : null;
	$level = (isset($_POST['level'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['level'])) : null;
	$status = (isset($_POST['status'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['status'])) : null;
	$idlang = (isset($_POST['language'])) ? preg_replace('([^0-9 ])', '', trim($_POST['language'])) : null;

	$res = $objHome->updtusr($name, $position, $level, $status, $idlang, $region);

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Actualición de perfil de usuario para usuarios y proveedores
|--------------------------------------------------------------------------
|
| Edición de perfil de usuario
|
*/

if (isset($_POST['updtinfousrusers']))
{
	$name = (isset($_POST['name'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['name'])) : null;
	$position = (isset($_POST['position'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['position'])) : null;
	$idlang = (isset($_POST['language'])) ? preg_replace('([^0-9 ])', '', trim($_POST['language'])) : null;

	$res = $objHome->updtusrusers($name, $position, $idlang);

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Update PicProfile
|--------------------------------------------------------------------------
|
| Actualización de imagen de perfil
|
*/


if (isset($_POST['picprofile']))
	echo $model->update_pic($_POST['id']);


/*
|--------------------------------------------------------------------------
| Actualización de contraseña
|--------------------------------------------------------------------------
|
| Comprobacion y actualización de contraseña
|
*/


if (isset($_POST['updtpwd']))
{
	$iduser = (isset($_SESSION['val'])) ? $_SESSION['val'] : $_SESSION['session_providers']['id'];

	if (isset($_POST['currentPass']))
		$res = $objHome->updatePass($_POST['pass1'], $_POST['pass2'], $iduser, $_POST['currentPass']);
	else
		$res = $objHome->updatePass($_POST['pass1'], $_POST['pass2'], $iduser);

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Validación de eliminación
|--------------------------------------------------------------------------
|
| Comprobaciones de campos en registro local de usuario
|
*/


if (isset($_POST['valphrase']))
{
	$frase = $objController->userDeletePhrase($_SESSION['val']);
	echo (trim($_POST['phrase']) == $frase) ? json_encode(true) : json_encode(false);
}

if (isset($_POST['deluser'])) { echo json_encode($objController->userdel(trim($_POST['phrase']), $_SESSION['val'])); }


/*
|--------------------------------------------------------------------------
| Nuevo registro de proveedor
|--------------------------------------------------------------------------
|
| Validación de datos para crear un nuevo registro de proveedor
|
*/

if (isset($_POST['verifica_provider']))
{
	$nit = (isset($_POST['nit'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['nit'])) : null;

	$anit = str_split($nit);

	$thisnit = '';

	foreach ($anit as $i => $number) {
	    $thisnit .= $number;
	    if ($i == 3 || $i == 9 || $i == 12) { $thisnit .= '-'; }
	}

	echo (!$model->existe_provider($thisnit)) ? json_encode(true) : json_encode(false);
}

if (isset($_POST['addprovider']))
{
	$info_provider['id'] = $_SESSION['session_providers']['id'];
	$info_provider['name'] = (isset($_POST['name'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['name'])) : null;
	$info_provider['reason'] = (isset($_POST['reason'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['reason'])) : null;
	$info_provider['provtype'] = (isset($_POST['provtype'])) ? preg_replace('([^A-Za-zÁ-ź])', '', trim($_POST['provtype'])) : null;
	$info_provider['branch'] = (isset($_POST['branch'])) ? preg_replace('([^0-9])', '', trim($_POST['branch'])) : null;

	$info_provider['dir'] = (isset($_POST['dir'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['dir'])) : null;
	$info_provider['activity'] = (isset($_POST['activity'])) ? preg_replace('([^A-Za-zÁ-ź0-9-])', '', trim($_POST['activity'])) : null;
	$info_provider['tel'] = (isset($_POST['tel'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['tel'])) : null;
	$info_provider['email'] = (isset($_POST['email'])) ? preg_replace('([^A-Za-z0-9-.@])', '', trim($_POST['email'])) : null;
	$info_provider['website'] = (isset($_POST['website']) && empty($_POST['website'])) ? 'pendiente' : preg_replace('([^A-Za-z0-9-.])', '', trim($_POST['website']));

	$info_provider['iva'] = (isset($_POST['iva']) && empty($_POST['iva'])) ? 'pendiente' : preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['iva']));

	$nit = (isset($_POST['nit'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['nit'])) : null;

	$anit = str_split($nit);

	$info_provider['nit'] = '';

	foreach ($anit as $i => $number) {
	    $info_provider['nit'] .= $number;
	    if ($i == 3 || $i == 9 || $i == 12) { $info_provider['nit'] .= '-'; }
	}

	$info_provider['legal'] = (isset($_POST['legal'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['legal'])) : null;
	$info_provider['prodservice'] = (isset($_POST['prodservice'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['prodservice'])) : null;

	$info_executive['sellername'] = (isset($_POST['sellername'])) ? preg_replace('([^A-Za-zÁ-ź])', '', trim($_POST['sellername'])) : null;
	$info_executive['sellertel'] = (isset($_POST['sellertel']) && empty($_POST['sellertel'])) ? 'pendiente' : preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['sellertel']));
	$info_executive['sellercell'] = (isset($_POST['sellercell'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['sellercell'])) : null;
	$info_executive['sellermail'] = (isset($_POST['sellermail'])) ? preg_replace('([^A-Za-z0-9-.@])', '', trim($_POST['sellermail'])) : null;

	$res = $model->add_provider($info_provider, $info_executive);

	echo json_encode($res);
}

if (isset($_POST['inicia_revision']))
{
	$info_provider['id'] = $_SESSION['session_providers']['id'];
	$info_provider['name'] = (isset($_POST['name'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['name'])) : null;
	$info_provider['reason'] = (isset($_POST['reason'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['reason'])) : null;
	$info_provider['iva'] = (isset($_POST['iva'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['iva'])) : null;
	$nit = (isset($_POST['nit'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['nit'])) : null;

	$anit = str_split($nit);

	$info_provider['nit'] = '';

	foreach ($anit as $i => $number) {
	    $info_provider['nit'] .= $number;
	    if ($i == 3 || $i == 9 || $i == 12) { $info_provider['nit'] .= '-'; }
	}

	echo json_encode($objHome->notifica_revision($info_provider));
}


/*
|--------------------------------------------------------------------------
| Actualización de registro del proveedor
|--------------------------------------------------------------------------
|
| Validación de datos para actualizar un registro del proveedor
|
*/

if (isset($_POST['updateprovider']))
{
	$info_provider['id'] = $_SESSION['session_providers']['id'];
	$info_provider['name'] = (isset($_POST['name'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['name'])) : null;
	$info_provider['reason'] = (isset($_POST['reason'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['reason'])) : null;
	$info_provider['provtype'] = (isset($_POST['provtype'])) ? preg_replace('([^A-Za-zÁ-ź ])', '', trim($_POST['provtype'])) : null;
	$info_provider['branch'] = (isset($_POST['branch'])) ? preg_replace('([^0-9])', '', trim($_POST['branch'])) : null;

	$info_provider['dir'] = (isset($_POST['dir'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['dir'])) : null;
	$info_provider['activity'] = (isset($_POST['activity'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['activity'])) : null;
	$info_provider['tel'] = (isset($_POST['tel'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['tel'])) : 'pendiente';
	$info_provider['email'] = (isset($_POST['email'])) ? preg_replace('([^A-Za-z0-9-.@])', '', trim($_POST['email'])) : null;
	$info_provider['website'] = (isset($_POST['website'])) ? preg_replace('([^A-Za-z0-9-. ])', '', trim($_POST['website'])) : 'pendiente';

	$info_provider['iva'] = (isset($_POST['iva'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['iva'])) : 'pendiente';
	$info_provider['nit'] = (isset($_POST['nit'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['nit'])) : null;
	$info_provider['legal'] = (isset($_POST['legal'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['legal'])) : null;
	$info_provider['prodservice'] = (isset($_POST['prodservice'])) ? preg_replace('([^A-Za-zÁ-ź0-9- ])', '', trim($_POST['prodservice'])) : null;

	$info_executive['sellername'] = (isset($_POST['sellername'])) ? preg_replace('([^A-Za-zÁ-ź ])', '', trim($_POST['sellername'])) : null;
	$info_executive['sellertel'] = (isset($_POST['sellertel'])) ? preg_replace('([^0-9-])', '', trim($_POST['sellertel'])) : 'pendiente';
	$info_executive['sellercell'] = (isset($_POST['sellercell'])) ? preg_replace('([^0-9-])', '', trim($_POST['sellercell'])) : null;
	$info_executive['sellermail'] = (isset($_POST['sellermail'])) ? preg_replace('([^A-Za-z0-9-.@ ])', '', trim($_POST['sellermail'])) : null;

	$res = $model->update_provider($info_provider, $info_executive);

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Subida de archivos
|--------------------------------------------------------------------------
|
| obtencion de datos de archivos del proveedor
|
*/

if (isset($_POST['uploadfile']))
{
	if (isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 120000000)
	{
		echo json_encode(false);
	}
	else
	{
		$provider = $model->info_provider($_SESSION['session_providers']['id']);

		$archivo = $_FILES['archivo']['name'];
		$nombre = $_POST['filename'];
		$id = $provider['idprovider'];
		$nombre = strtr($nombre, " ", "_");
		$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	    $nuevoNombre = $nombre.'.'.$extension;

		$ruta = "files/".$id."/";

		if (!is_dir($ruta)) {
			$folder = mkdir($ruta, 0777, true);
			$dir = ($folder) ? true : false;
		}else {
			$dir = true;
		}

		if ($dir)
		{
			$destino = $ruta.$nuevoNombre;

			if (file_exists($destino))
			{
				echo json_encode(false);
			}
			else
			{
				opendir($ruta);

				if (move_uploaded_file($_FILES['archivo']['tmp_name'], $destino))
				{
					$res = $model->add_file($nombre, $destino, $_SESSION['session_providers']['id']);

					echo json_encode($res);
				}
				else
				{
					echo json_encode(false);
				}
			}
		}
		else
		{
			echo json_encode(false);
		}
	}
}

if (isset($_POST['uploadcarta']))
{
	if (isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 120000000)
	{
		echo json_encode(false);
	}
	else
	{
		$provider = $model->info_provider($_SESSION['session_providers']['id']);

		$archivo = $_FILES['archivo']['name'];
		$nombre = "Carta de compromiso";
		$id = $provider['idprovider'];
		$nombre = strtr($nombre, " ", "_");
		$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	    $nuevoNombre = $nombre.'.'.$extension;

		$ruta = "files/".$id."/";

		if (!is_dir($ruta)) {
			$folder = mkdir($ruta, 0777, true);
			$dir = ($folder) ? true : false;
		}else {
			$dir = true;
		}

		if ($dir)
		{
			$destino = $ruta.$nuevoNombre;

			if (file_exists($destino))
			{
				echo json_encode(false);
			}
			else
			{
				opendir($ruta);

				if (move_uploaded_file($_FILES['archivo']['tmp_name'], $destino))
				{
					$res = $model->add_file($nombre, $destino, $_SESSION['session_providers']['id']);

					echo json_encode($res);
				}
				else
				{
					echo json_encode(false);
				}
			}
		}
		else
		{
			echo json_encode(false);
		}
	}
}

if (isset($_POST['add_quiz']))
{
	if (isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 120000000)
	{
		echo json_encode(false);
	}
	else
	{
		$provider = $model->info_provider($_SESSION['session_providers']['id']);

		$archivo = $_FILES['archivo']['name'];
		$nombre = "Cuestionario de homologacion";
		$id = $provider['idprovider'];
		$nombre = strtr($nombre, " ", "_");
		$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	    $nuevoNombre = $nombre.'.'.$extension;

		$ruta = "files/".$id."/";

		if (!is_dir($ruta)) {
			$folder = mkdir($ruta, 0777, true);
			$dir = ($folder) ? true : false;
		}else {
			$dir = true;
		}

		if ($dir)
		{
			$destino = $ruta.$nuevoNombre;

			if (file_exists($destino))
			{
				echo json_encode(false);
			}
			else
			{
				opendir($ruta);

				if (move_uploaded_file($_FILES['archivo']['tmp_name'], $destino))
				{
					$res = $model->add_file($nombre, $destino, $_SESSION['session_providers']['id']);

					$res = $model->finalizar_homologacion($_SESSION['session_providers']['id']);

					echo json_encode($res);
				}
				else
				{
					echo json_encode(false);
				}
			}
		}
		else
		{
			echo json_encode(false);
		}
	}
}


/*
|--------------------------------------------------------------------------
| Descarga de archivos
|--------------------------------------------------------------------------
|
| obtencion de datos para descargar ficheros
|
*/

if (isset($_GET['downloadfile']))
{
	$ruta = $model->get_route_file($_GET['downloadfile']);

	$nombre = $ruta;
	$n = strpos($nombre, "/");
	$nombre = substr($nombre, $n+1);
	$n = strpos($nombre, "/");
	$nombre = substr($nombre, $n+1);

	$file = file($ruta);
	$file2 = implode("", $file);
	header ("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename = ".$nombre);

	echo $file2;
}


/*
|--------------------------------------------------------------------------
| Eliminar archivo
|--------------------------------------------------------------------------
|
| eliminar fichero
|
*/

if (isset($_POST['delfile']))
{
	$ruta = $model->get_route_file($_POST['idfile']);

	$res = (unlink($ruta)) ? $model->delete_file($_POST['idfile']) : false;

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Información de Proveedor
|--------------------------------------------------------------------------
|
| obtencion de datos de proveedores
|
*/

if (isset($_POST['getinfoprovider'])) {
	$info = $model->info_provider($_POST['id']);
	echo json_encode($info);
}


/*
|--------------------------------------------------------------------------
| Homologaciones
|--------------------------------------------------------------------------
|
| Creación de un nuevo proceso de homologación
|
*/

if (isset($_POST['add_h']))
{
	$iduser = (isset($_POST['add_h'])) ? preg_replace('([^0-9])', '', trim($_POST['add_h'])) : null;

	if ($objHome->agregar_homologacion($iduser))
		echo json_encode(true);
	else
		echo json_encode(false);
}


/*
|--------------------------------------------------------------------------
| Editar proveedor
|--------------------------------------------------------------------------
|
| Validación de datos para editar un proveedor
|
*/

if (isset($_POST['editprovider']))
{
	$name = (isset($_POST['ename'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['ename'])) : null;
	$type = (isset($_POST['etype'])) ? preg_replace('([^0-9])', '', trim($_POST['etype'])) : null;
	$contact = (isset($_POST['econtact'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['econtact'])) : null;
	$tel = (isset($_POST['etel'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['etel'])) : null;
	$id = (isset($_POST['editprov'])) ? preg_replace('([^0-9])', '', trim($_POST['editprov'])) : null;

	$res = $model->edit_provider($name, $type, $contact, $tel, $id);

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Eliminar proveedor
|--------------------------------------------------------------------------
|
| Validación de datos para eliminar un proveedor
|
*/

if (isset($_POST['deleteprovider']))
{
	$id = (isset($_POST['deleteprovider'])) ? preg_replace('([^0-9])', '', trim($_POST['deleteprovider'])) : null;

	$res = $model->remove_provider($id);

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Listar actividades
|--------------------------------------------------------------------------
|
| Validación de datos para listar actividades de un proyecto
|
*/

if (isset($_POST['get_activities'])) {
	$id = (isset($_POST['id'])) ? preg_replace('([^0-9])', '', trim($_POST['id'])) : null;

	if (!is_null($id))
		echo json_encode($model->activities_list($id));
	else
		echo json_encode(false);
}


/*
|--------------------------------------------------------------------------
| Seleccionar productos
|--------------------------------------------------------------------------
|
| Validación de datos para selecconar los productos
|
*/

if (isset($_POST['prod_list']))
{
	$productos = $model->product_list();

	echo json_encode($productos);
}


/*
|--------------------------------------------------------------------------
| Seleccionar productos
|--------------------------------------------------------------------------
|
| Validación de datos para selecconar los productos
|
*/

if (isset($_POST['prods_selected']))
{
	$_SESSION['productos'] = explode(',', $_POST['list']);

	if (empty($_SESSION['productos']))
	{
		$res = false;
	}
	else
	{
		$res = true;
		$_SESSION['view'] = 'prod_req';
	}

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Comentarios del sistema
|--------------------------------------------------------------------------
|
| Control de comentarios al sistema
|
*/


if (isset($_POST['newComment']))
{
	$model->insert_comment(preg_replace('([^A-Za-zÁ-ź0-9-.¡!:\) ])', '', trim($_POST['comment'])), $_SESSION['session_providers']['id']);

	load_view();
}

if (isset($_GET['delComment']))
{
	$model->del_comment(preg_replace('([^A-Za-z0-9- ])', '', trim($_GET['delComment'])), $_SESSION['session_providers']['id']);

	load_view();
}


/*
|--------------------------------------------------------------------------
| Soporte técnico (Cliente)
|--------------------------------------------------------------------------
|
| Obtener Solicitud de soporte técnico
|
*/


if (isset($_POST['newreqsupport'])) {
	$subject = preg_replace('([^A-Za-zÁ-ź0-9-.¡!:\) ])', '', trim($_POST['subject']));
	$mssg = preg_replace('([^A-Za-zÁ-ź0-9-.¡!:\) ])', '', trim($_POST['mssg']));
	if (!empty($subject) && !empty($mssg)) {
		echo json_encode($model->new_support_request($subject, $mssg, $_SESSION['session_providers']['id']));
	}else {
		echo json_encode(false);
	}
}


/*
|--------------------------------------------------------------------------
| Soporte técnico (Sudo)
|--------------------------------------------------------------------------
|
| Obtener Solicitud de soporte técnico
|
*/


if (isset($_POST['getsupportreq'])) {
	$info = $sudo_m->getsupportreq($_POST['id']);
	echo json_encode($info);
}


if (isset($_POST['savesupportres'])) {
	$id = $_POST['id'];
	$response = preg_replace('([^A-Za-zÁ-ź0-9-.¡!:\) ])', '', trim($_POST['response']));
	if (!empty($response))
		echo json_encode($sudo_m->savesupportres($id, $response));
	else
		echo json_encode(false);
}


/*
|--------------------------------------------------------------------------
| Acciones para los rubros
|--------------------------------------------------------------------------
*/

if (isset($_POST['infobranch']))
{
	$branches = $model->branch_list();

	$i = array_search($_POST['id'], $branches['idbranch']);

	$data = [
		'idbranch' => $branches['idbranch'][$i],
		'branch' => $branches['branch'][$i],
		'idstatus' => $branches['idstatus'][$i],
		'status' => $branches['status'][$i]
	];

	echo json_encode($data);
}


if (isset($_POST['ch_branch_status']))
{
	$id = (isset($_POST['id'])) ? preg_replace('([^0-9])', '', trim($_POST['id'])) : null;
	$status = (isset($_POST['status'])) ? preg_replace('([^0-9])', '', trim($_POST['status'])) : null;

	$status = (!is_null($status)) ? ($status == 1) ? 2 : 1 : null;

	$data = ['id' => $id, 'status' => $status];

	if (!in_array(null, $data)) {
		echo json_encode($model->ch_branch_status($data));
	}else {
		echo json_encode(false);
	}
}


if (isset($_POST['new_branch']))
{
	$branch = (isset($_POST['branch'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['branch'])) : null;

	$res = $model->new_branch(['branch' => $branch]);

	echo json_encode($res);
}


if (isset($_POST['editbranch']))
{
	$branch = (isset($_POST['branch'])) ? preg_replace('([^A-Za-zÁ-ź0-9 ])', '', trim($_POST['branch'])) : null;
	$id = (isset($_POST['id'])) ? preg_replace('([^0-9])', '', trim($_POST['id'])) : null;

	$data = [
		'branch' => $branch,
		'id' => $id
	];

	$res = (!in_array(null, $data)) ? $model->edit_branch($data) : false;

	echo json_encode($res);
}


/*
|--------------------------------------------------------------------------
| Personalización de reportes
|--------------------------------------------------------------------------
|
| Manejo de campos y presentación de tablas
|
|--------------------------------------------------------------------------
| Para usuarios
|--------------------------------------------------------------------------
*/

if (isset($_POST['custom_table_users']))
{
	if (!isset($_SESSION['custom_users_fields']))
		$table = "<div class='alert alert-dismissible alert-dark'>".LANG['no_fields_selected']."</div>";
	else
		$table = $objHome->show_table_report('custom_users_fields', $sudo_m->datareport('users'));

	echo $table;
}

if (isset($_POST['add_field_users']))
{
	$_SESSION['custom_users_fields'][] = $_POST['add_field_users'];

	echo json_encode(true);
}

if (isset($_POST['remove_field_users']))
{
	$key = array_search($_POST['remove_field_users'], $_SESSION['custom_users_fields']);

	if ($key === 0 || $key) {
		unset($_SESSION['custom_users_fields'][$key]);
		echo json_encode(true);
	}else {
		echo json_encode(false);
	}
}

if (isset($_POST['print_users']))
{
	if (isset($_SESSION['custom_users_fields']) && count($_SESSION['custom_users_fields']) > 0)
		echo true;
	else
		echo false;
}

/*
|--------------------------------------------------------------------------
| Personalización de reportes
|--------------------------------------------------------------------------
|
| Manejo de campos y presentación de tablas
|
|--------------------------------------------------------------------------
| Para soportes
|--------------------------------------------------------------------------
*/

if (isset($_POST['custom_table_supports']))
{
	if (!isset($_SESSION['custom_supports_fields']))
		$table = "<div class='alert alert-dismissible alert-dark'>".LANG['no_fields_selected']."</div>";
	else
		$table = $objHome->show_table_report('custom_supports_fields', $sudo_m->datareport('supports'));

	echo $table;
}

if (isset($_POST['add_field_supports']))
{
	$_SESSION['custom_supports_fields'][] = $_POST['add_field_supports'];

	echo json_encode(true);
}

if (isset($_POST['remove_field_supports']))
{
	$key = array_search($_POST['remove_field_supports'], $_SESSION['custom_supports_fields']);

	if ($key === 0 || $key) {
		unset($_SESSION['custom_supports_fields'][$key]);
		echo json_encode(true);
	}else {
		echo json_encode(false);
	}
}

if (isset($_POST['print_supports']))
{
	if (isset($_SESSION['custom_supports_fields']) && count($_SESSION['custom_supports_fields']) > 0)
		echo true;
	else
		echo false;
}

// ************************************************************************************
// ************************************************************************************
// ************************************************************************************

/*
|--------------------------------------------------------------------------
| Dashboard chart
|--------------------------------------------------------------------------
|
| Presentación de gráfica en dashboard
|
*/

if (isset($_POST['get_dash_chart']))
{
	$date = preg_replace('([^0-9-])', '', trim($_POST['date']));

	$chart = $model->charts($_SESSION['session_providers']['id'], $date);

	$res = $chart;

	echo json_encode($res);
}

if (isset($_POST['aprobar']))
{
	echo json_encode($model->aprobar_proveedor($_SESSION['val']));
}

if (isset($_POST['desaprobar']))
{
	echo json_encode($model->desaprobar_proveedor($_SESSION['val']));
}