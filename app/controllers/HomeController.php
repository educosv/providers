<?php

require_once 'Controller.php';

class HomeController extends Controller
{
	public function reqviews($req, $val = null)
	{
		$_SESSION['view'] = $req;

		switch ($req)
		{
			case 'home':
				unset($_SESSION['view']);
			break;

			case 'logout':
				parent::outputs($_SESSION['session_providers']['id']);
				session_destroy();
			break;

			default:
				if (is_null($val))
					unset($_SESSION['val']);
				else
					$_SESSION['val'] = $val;
			break;
		}

		load_view();
	}

	public function agregar_homologacion($iduser)
	{
		if (parent::validar_homologaciones($iduser))
		{
			$user = parent::user_info($iduser);

			$html = '
			<!DOCTYPE html>
			<html lang="es-SV">
				<head>
					<meta charset="utf-8">
					<title>'.APP_NAME.'</title>
					<style>
					html {
						font-family: sans-serif;
						line-height: 1.15;
						-webkit-text-size-adjust: 100%;
						-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
					}
					h1, h2, h3, h4, h5, h6 {
					  margin-top: 0;
					  margin-bottom: 0.5rem;
					}
					p{
						font-size: 16px !important;
					}
					a{
						font-size: 16px !important;
					}
					</style>
				</head>
				<body>
					<div style="width: 9% !important;">
						<img src="'.URL.'dist/img/logo-mail.png" style="width: 100% !important;" alt="logo">
					</div>
					<h1 style="font-size: 30px !important;">'.APP_NAME.' Educo</h1>
					<h3 style="font-size: 20px !important;">Proceso de homologación</h3>
					<p style="margin-top: 30px;">Hola '.$user['name'].',</p>
					<p style="margin-top: 30px;">Te informamos que has sido seleccionado/a en <strong>'. strtolower(APP_NAME) .' educo.</strong> para participar en nuestro proceso de homologación el cual es necesario para registrarse en nuestra base de proveedores.</p>
					<p style="margin-top: 30px;">Por lo tanto, agradeceremos tu colaboración en llenar el siguiente documento y colgarlo en tu perfil de proveedor de nuestra plataforma</p>

					<p style="margin-top: 30px;">Para descargar el documento, haz clic sobre el siguiente enlace:</p>
					<a href="'.URL.'dist/docs/cuestionario_de_homologacion_de_proveedor.pdf" target="_blank">Cuestionario de homologación de proveedor</a>
					<p style="margin-top: 30px;">
						Gracias por confiar en nosotros.
					</p>
					<p style="margin-top: 30px;">Atentamente:</p>
					<p style="margin-top: 10px;">
						<strong>Fundación EDUCO</strong>
					</p>
					<hr style="margin-top: 30px;">
					<p>Este es un mensaje automático, por favor no respondas a este correo.</p>
				</body>
			</html>
			';

			$headers = "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

			$headers .= "From: proveedores@educo.org"."\r\n";

			if (mail($user['email'], 'Educo - Proceso de homologación', $html, $headers))
			{
				parent::iniciar_homologacion($iduser, date('Y-m-d'));
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function notifica_revision($data)
	{
		$user = parent::user_info($data['id']);

		$html = '
		<!DOCTYPE html>
		<html lang="es-SV">
			<head>
				<meta charset="utf-8">
				<title>'.APP_NAME.'</title>
				<style>
				html {
					font-family: sans-serif;
					line-height: 1.15;
					-webkit-text-size-adjust: 100%;
					-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
				}
				h1, h2, h3, h4, h5, h6 {
				  margin-top: 0;
				  margin-bottom: 0.5rem;
				}
				p{
					font-size: 16px !important;
				}
				a{
					font-size: 16px !important;
				}
				</style>
			</head>
			<body>
				<div style="width: 9% !important;">
					<img src="https://proveedores.educosv.org/dist/img/logo-mail.png" style="width: 100% !important;" alt="logo">
				</div>
				<h1 style="font-size: 30px !important;">'.APP_NAME.' Educo</h1>
				<h3 style="font-size: 20px !important;">Revisión de registro de proveedor</h3>
				<p style="margin-top: 30px;">Hola,</p>
				<p style="margin-top: 30px;">Te informamos que el usuario <strong>'.$user['name'].'</strong> con cuenta <strong>'.$user['email'].'</strong> ha solicitado una revisión de registro en <strong>'.APP_NAME.' Educo.</strong></p>
				<p style="margin-top: 30px;">A continuación, te presentamos los datos solicitados para revisión:</p>
				<p style="margin-top: 30px;">
					<ul>
						<li><strong>Nombre Comercial:</strong>'.$data['name'].'</li>
						<li><strong>Razón Social/Persona Natural:</strong>'.$data['reason'].'</li>
						<li><strong>Registro IVA:</strong>'.$data['iva'].'</li>
						<li><strong>NIT:</strong>'.$data['nit'].'</li>
					</ul>
				</p>
				<p style="margin-top: 30px;">
					Gracias por confiar en nosotros.
				</p>
				<p style="margin-top: 30px;">Atentamente:</p>
				<p style="margin-top: 10px;">
					<strong>Fundación EDUCO</strong>
				</p>
				<hr style="margin-top: 30px;">
				<p>Este es un mensaje automático, por favor no respondas a este correo.</p>
			</body>
		</html>
		';

		$headers = "MIME-Version: 1.0"."\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

		$headers .= "From: proveedores@educo.org"."\r\n";

		if (mail('isaac.ramos@educo.org', 'Proveedores - revisión de registro', $html, $headers)) {
			parent::activar_revision($data['id']);
			$_SESSION['session_providers']['revision'] = 1;
			return true;
		}else {
			return false;
		}
	}

	public function updtusr($name, $position, $level, $status, $lang, $region)
	{
		$data = [$name, $position, $level, $status, $lang, $region];

		$flag = true; foreach ($data as $val) { if (is_null($val)) { $flag = false; break; } }

		return (parent::update_user($data)) ? true : false;
	}

	public function updtusrusers($name, $position, $lang)
	{
		$data = [$name, $position, $lang];

		$flag = true; foreach ($data as $val) { if (is_null($val)) { $flag = false; break; } }

		return (parent::update_user_users($data)) ? true : false;
	}

	public function updatePass($pass, $password, $iduser, $current_pass = null)
	{
		$validation = (!is_null($current_pass)) ? parent::pass_validator($current_pass, $iduser) : true;

		if ($validation)
		{
			if (strlen($pass) >= 8 && strlen($password) >= 8)
			{
				if ($pass == $password)
				{
					$arr_pass = str_split($pass);

					$banco = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789abcdefghijklmnñopqrstuvwxyz_@-$!';

					$arr_banco = str_split($banco);

					$x = true;

					foreach ($arr_pass as $valor_pass) { $x = (!in_array($valor_pass, $arr_banco)) ? false : true; }

					if ($x)
					{
						$password = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 12]);

						return (parent::update_password($password, $iduser)) ? true : false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}

	}

	public function historysupportreq($iduser)
	{
		$body = "";
		$list = parent::history_request($iduser);
		if ($list) {
			foreach ($list['subject'] as $index => $value) {
				$class = ($list['idstatus'][$index] == 5) ? 'badge-warning' : 'badge-success';
				$body .= "
				<div class='card-body p-0'>
					<div class='mailbox-read-info'>
						<div class='row'>
							<div class='col-8'>
								<h5>". LANG['subject'].": {$value}</h5>
								<h6 class='mt-2'>From: {$_SESSION['session_providers']['email']}</h6>
							</div>
							<div class='col-4'>
								<span class='badge {$class} float-right'>{$list['status'][$index]}</span>
							</div>
						</div>
					</div>
					<div class='mailbox-read-message'>
						<p><strong>".LANG['body_msg'].":</strong></p>
						<p>{$list['mssg'][$index]}</p>
						<hr>
						<p><strong>".LANG['answer'].":</strong></p>
						<p>{$list['response'][$index]}</p>
					</div>
				</div>
				<div class='card-footer bg-dark'></div>
				";
			}
		}

		return $body;
	}

	public function menu_active_class($view)
	{
		if (isset($_SESSION['view'])) {
			if ($_SESSION['view'] == $view)
				return 'active';
			else
				return '';
		}else {
			return '';
		}
	}

	public function menu_treeview_class()
	{
		if (isset($_SESSION['view']))
		{
			$views = func_get_args();
			$class = '';
			foreach ($views as $view) {
				if ($_SESSION['view'] == $view) {
					$class = 'menu-open';
					break;
				}
			}
			return $class;
		}
		else
		{
			return '';
		}
	}

	public function show_table_report($custom_name, $array_fields)
	{
		$users_indexes = [];

		if ($array_fields)
		{
			foreach ($array_fields as $key => $value) { $users_indexes[] = $key; }

			$datable = [];

			foreach ($_SESSION[$custom_name] as $field)
			{
				if (in_array($field, $users_indexes))
				{
					$datable['fields'][] = $field;
					$datable[$field] = $array_fields[$field];
				}
			}

			if (!empty($datable))
			{
				$content = '<table class="table table-bordered table-striped table-responsive">';
				$content .= '<thead><tr>';
				foreach ($datable['fields'] as $val)
				{
					switch ($val) {
						case 'nombre':
							$field = LANG['name'];
							break;

						case 'email':
							$field = LANG['email'];
							break;

						case 'cargo':
							$field = LANG['position'];
							break;

						case 'permiso':
							$field = LANG['permission'];
							break;

						case 'tipo_registro':
							$field = LANG['register_type'];
							break;

						case 'idioma':
							$field = LANG['language'];
							break;

						case 'imagen':
							$field = LANG['image'];
							break;

						case 'estado':
							$field = LANG['status'];
							break;

						case 'asunto':
							$field = LANG['subject'];
							break;

						case 'mensaje':
							$field = LANG['message'];
							break;

						case 'respuesta':
							$field = LANG['response'];
							break;

						default:
							$field = $val;
							break;
					}
				    $content .= "<th>{$field}</th>";
				}
				$content .= '</tr></thead><tbody>';
				foreach ($datable[$datable['fields'][0]] as $key => $value)
				{
					$content .= '<tr>';
					foreach ($datable['fields'] as $field)
					{
					    if ($field != 'fields')
					    {
					    	if ($field == 'imagen')
					    		$content .= "<td><img src='data:image/png;base64,".base64_encode($datable[$field][$key])."' width='50' alt='User profile picture'></td>";
					    	else
					    		$content .= "<td>{$datable[$field][$key]}</td>";
					    }
					}
					$content .= '</tr>';
				}
				$content .= '</tbody></table>';
			}
			else
			{
				$content = "<div class='alert alert-dismissible alert-dark'>".LANG['no_fields_selected']."</div>";
			}
		}
		else
		{
			$content = "<div class='alert alert-dismissible alert-danger'>".LANG['empty_table']."</div>";
		}

		return $content;
	}

	public function showComments()
	{
		$comments = parent::get_comments();

		if ($comments)
		{
			foreach ($comments['id'] as $key => $value)
			{
				echo '
				<div class="direct-chat-msg">
					<div class="direct-chat-infos clearfix">
						<span class="direct-chat-name float-left">
						'.$_SESSION['session_providers']['name'].'
						</span>
						<span class="direct-chat-timestamp float-right">
						'.date_format(date_create($comments['date'][$key]), 'd-M-Y').'
						'.$comments['time'][$key].'
						</span>
					</div>
					<img class="direct-chat-img" src="data:image/png;base64,'.$_SESSION['session_providers']['pic'].'">
					<div class="direct-chat-text">
						'.$comments['comment'][$key].'
					</div>';

				if ($_SESSION['session_providers']['id'] == $comments['idUser'][$key])
				{
					echo '
					<a href="'.URL.'internal_data?delComment='.$value.'" class="text-sm text-danger">'.LANG['delete'].'</a>';
				}
				echo '</div>';
			}
		}
	}

	public function upInfo($val)
	{
		if ($val === 'on')
			$_SESSION['updateInfoUser'] = true;
		else
			unset($_SESSION['updateInfoUser']);

		load_view();
	}

	public function logout()
	{
		parent::pst("INSERT INTO tbl_outputs(iduser) VALUES (:iduser)", ['iduser' => $_SESSION['session_providers']['id']], false);
		session_destroy();
		load_view();
	}
}

$objHome = new HomeController;

if (isset($_GET['req']))
{
	if (isset($_GET['val']))
		$objHome->reqviews($_GET['req'], $_GET['val']);
	else
		$objHome->reqviews($_GET['req']);
}