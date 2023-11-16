<?php

require_once APP.'/models/Model.php';

class Controller extends Model
{
	public function actions($action, $value = '')
	{
		switch ($action)
		{
			case 'forgot':
				$_SESSION['gestion'] = 'forget';
			break;

			case 'register':
				$_SESSION['gestion'] = 'register';
			break;

			case 'reset':
				if (strlen($value) == 50)
				{
					if (parent::token_validator($value))
					{
						$_SESSION['gestion'] = 'reset';
						$_SESSION['token'] = $value;
					}
					else
					{
						session_destroy();
					}
				}
			break;

			case 'delRegister':
				if (strlen($value) == 50)
				{
					if (parent::token_validator($value))
					{
						parent::del_register($value);
						session_destroy();
					}
					else
					{
						session_destroy();
					}
				}
			break;

			case 'delrestore':
				if (strlen($value) == 50)
				{
					if (parent::token_validator($value))
					{
						parent::del_restore($value);
						session_destroy();
					}
					else
					{
						session_destroy();
					}
				}
			break;

			case 'login':
				session_destroy();
			break;

			case 'resetpass':
				$this->resetPass($_SESSION['email']);
			break;

			case 'sessiondel':
				$this->delCookie();
			break;

			case 'selectlang':
				$this->selectlang($value);
			break;
		}

		load_view();
	}

	public function getmailusr($email)
	{
		$arr = str_split($email);
		$user = '';
		foreach ($arr as $value) {
			if ($value == '@') {
				break;
			}else {
				$user .= $value;
			}
		}
		return $user;
	}

	public function userDeletePhrase($iduser)
	{
		$user = parent::user_info($iduser);
		$email = $user['email'];
		$arr = str_split($email);
		$user = '';
		foreach ($arr as $value) { if ($value == '@') { break; } else { $user .= $value; } }
		$phrase = "delete.{$user}";
		return $phrase;
	}

	public function userdel($frase, $iduser)
	{
		$phrase = $this->userDeletePhrase($iduser);

		if ($frase == $phrase)
			return parent::deleteuser($iduser);
		else
			return false;
	}

	public function login($email, $accesstype, $pass = null, $remember = null, $cookie_token = null)
	{
		if (strlen($email) != 0)
		{
			switch ($accesstype)
			{
				case 'local':
					$info = (strlen($pass) != 0) ? parent::info_login($email, $pass) : false;
				break;

				case 'social':
					$info = parent::info_login($email, "$2y$10$7yBh9vkVZSOkfKF8VTnrVegtPDoPzP/djiXc4/bzbZXlP1.z.6ZHW");
				break;

				case 'cookie':
					$info = parent::info_login($email, null, trim($cookie_token));
				break;

				default:
					$info = false;
				break;
			}

			if($info)
			{
				if ($info === 'firstIn')
				{
					$key = $this->getKey(50);

					if (parent::set_reset_token($email, $key))
					{
						$_SESSION['gestion'] = 'reset';
						$_SESSION['token'] = $key;
					}
				}
				else
				{
					if (!is_null($remember))
					{
						$token = $this->getKey(100);

						if (parent::set_cookie_token($email, $token)) {
							setcookie('MONSTER', $token, strtotime( '+365 days' ));
						}
					}
				}

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

	public function newregister($name, $email, $region, $lang, $level, $position = '', $accesstype = null)
	{
		if (parent::available_mail($email))
		{
			$pwd = password_hash($this->getKey(8), PASSWORD_DEFAULT, ['cost' => 10]);

			if (parent::register_user($name, $email, $position, $region, $lang, $level, $pwd, $accesstype))
			{
				$token = $this->getKey(50);

				if (parent::set_token_register($email, $token))
				{
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
							<h3 style="font-size: 20px !important;">Confirmación de registro</h3>
							<p style="margin-top: 30px;">Hola '.$name.',</p>
							<p style="margin-top: 30px;">Te informamos que has sido registrado en <strong>'.APP_NAME.' Educo.</strong></p>
							<p style="margin-top: 30px;">Te damos la bienvenida a nuestra aplicación, para finalizar tu registro, haz clic sobre el siguiente enlace:</p>
							<a href="'.URL.'?action=reset&value='.$token.'" target="_blank">Confirmar correo electrónico</a>
							<p style="margin-top: 30px;"><strong>¿No deseas registrarte?</strong></p>
							<p>
								Si no deseas registrarte, haz clic en el siguiente enlace para eliminar tus datos de nuestros registros.
							</p>
							<p>
								<a href="'.URL.'?action=delregister&value='.$token.'" target="_blank" style="color: #DD0000;">Eliminar solicitud de registro</a>
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

					if (mail($email, 'Confirmación de registro', $html, $headers))
					{
						parent::savelog(3, "Confirmación de registro enviado a {$email}, token actualizado.");
						return true;
					}
					else
					{
						parent::savelog(4, "Confirmación de registro no enviado a {$email}, token desactualizado.");
						return true;
					}
				}
				else
				{
					parent::savelog(4, "Confirmación de registro no enviado a {$email}, token desactualizados.");
					return true;
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

	public function delCookie()
	{
		if (isset($_COOKIE['MONSTER']))
		{
			parent::pst("DELETE FROM tbl_cookies WHERE sessiontoken = :cmonster", ['cmonster' => $_COOKIE['MONSTER']], false);
			setcookie('MONSTER', '', 1);
		}

	}

	public function resetPass($email)
	{
		$data = parent::is_correct_mail($email);

		if ($data)
			return (parent::recovery_req_on($data)) ? true : false;
		else
			return false;
	}

	public function send_resetpass($email)
	{
		$data = parent::is_correct_mail($email);

		if ($data)
		{
			$token = $this->getKey(50);

			$html = '
			<!DOCTYPE html>
				<html lang="es-SV">
					<head>
						<meta charset="utf-8">
						<title>'.APP_NAME.' Educo</title>
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
						<h3 style="font-size: 20px !important;">Restablecimiento de contraseña</h3>
						<p style="margin-top: 30px;">Hola '.$data['name'].',</p>
						<p style="margin-top: 30px;">Recibimos una solicitud para restablecer tu contraseña, si fuiste tú, haz clic sobre el siguiente enlace:</p>
						<a href="'.URL.'?action=reset&value='.$token.'" target="_blank">Restablecer mi contraseña</a>
						<p style="margin-top: 30px;"><strong>¿No has solicitado restablecer tu contraseña?</strong></p>
						<p>
							Es posible que hayan intentado utilizar tu cuenta de correo. Te recomendamos tomar medidas preventivas para asegurarte de que tu cuenta no ha sido vulnerada. Haz clic en el siguiente botón para eliminar la solicitud de registro de nuestro sistema.
						</p>
						<p>
							<a href="'.URL.'?action=delrestore&value='.$token.'" target="_blank" style="color: #DD0000;">Eliminar solicitud de restablecimiento</a>
						</p>
						<p style="margin-top: 30px;">
							Gracias por confiar en nosotros.
						</p>
						<p style="margin-top: 30px;">Atentamente:</p>
						<p style="margin-top: 10px;">
							<strong>Fundación Educo</strong>
						</p>
						<hr style="margin-top: 30px;">
						<p>Este es un mensaje automático enviado desde nuestro sistema de control de proveedores Educo, por favor no respondas a este correo.</p>
					</body>
				</html>
			';

			$headers = "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

			$headers .= "From: proveedores@educo.org"."\r\n";

			if (mail($data['email'], 'Restablecimiento de contraseña', $html, $headers))
			{
				if (parent::mails_sent($data['iduser'], $token))
					parent::savelog(3, "Restablecimiento de contraseña enviado a {$data['email']}, forgetpass actualizado.");
				else
					parent::savelog(4, "Restablecimiento de contraseña enviado a {$data['email']}, forgetpass desactualizado.");

				return true;
			}
			else
			{
				parent::savelog(4, "Restablecimiento de contraseña no enviado a {$data['email']}, forgetpass desactualizado.");

				return false;
			}
		}
		else
		{
			return false;
		}

	}

	public function resetPassword($pass)
	{
		$arr_pass = str_split($pass);

		$banco = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789abcdefghijklmnñopqrstuvwxyz_@-$!';

		$arr_banco = str_split($banco);

		$x = true;

		foreach ($arr_pass as $valor_pass)
	        if (!in_array($valor_pass, $arr_banco)) { $x = false; }

		if ($x)
		{
			$password = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 12]);

			return parent::recover_password($password, $_SESSION['token']);
		}
	}

	protected function getKey($length)
	{
	    $cadena = "ABCDFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
	    $longitudCadena = strlen($cadena);
	    $pass = "";
	    for($i=1 ; $i<=$length ; $i++)
	    {
	        $pos = rand(0,$longitudCadena-1);
	        $pass .= substr($cadena,$pos,1);
	    }
	    return $pass;
	}

	public function date_time($request, $date = null)
    {
        date_default_timezone_set("America/El_Salvador");
        setlocale(LC_TIME, "spanish");

        switch ($request)
        {
        	case 'format':
        		$date = str_replace("/", "-", $date);
        		return strftime("%d/%B/%Y", strtotime(date('d-M-Y', strtotime($date))));
        		break;

            case 'date':
                return strftime("%d/%B/%Y", strtotime(date('d-M-Y', time())));
                break;

            case 'datadate':
                return date('Y-m-d', time());
                break;

            case 'time':
                return date('H:i:s', time());
                break;

            default:
                return false;
                break;
        }
    }

    public function selectlang($lang = null)
    {
    	$langs = parent::lang_list();

    	$lanicon = null;

    	foreach ($langs['idlang'] as $key => $val)
    	{
    		if ($langs['lancode'][$key] == $lang)
    		{
    			$lanicon = $langs['lanicon'][$key];
    			break;
    		}
    	}

    	if (!is_null($lang) && !is_null($lanicon))
    	{
    		$_SESSION['lang']['lanicon'] = $lanicon;
    		$_SESSION['lang']['lancode'] = $lang;
    	}
    }

    protected function sendMail($email, $asunto, $html)
	{
		require_once 'plugins/phpMailer/PHPMailerAutoload.php';

		$mensaje = $html;
		$mail = new PHPMailer;
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = MAIL_SMTP_SECURE;
		$mail->Host = MAIL_HOST;
		$mail->Port = MAIL_PORT;
		$mail->Username = MAIL_USERNAME;
		$mail->Password = MAIL_PASSWORD;
		$mail->CharSet = MAIL_ENCRYPTION;
		$mail->From = MAIL_FROM_ADDRESS;
		$mail->FromName = MAIL_FROM_NAME;
		$mail->Subject = $asunto;
		$mail->addAddress($email);
		$mail->MsgHTML($mensaje);

		return ($mail->Send()) ? true : false;
	}
}

$objController = new Controller;

$model = new Model;

if (isset($_GET['action']))
{
	if (isset($_GET['value']))
		$objController->actions($_GET['action'], $_GET['value']);
	else
		$objController->actions($_GET['action']);
}