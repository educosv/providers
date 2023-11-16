<?php

require_once "config.php";
require_once "Model.php";

/* For windows => [ $this->sendMail_windows() ]

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

*/

/* For Linux

1. install -> sudo apt-get install libphp-phpmailer
2. change method name -> [ $this->sendMail_linux() ]

*/

require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
require '/usr/share/php/libphp-phpmailer/class.smtp.php';


class TasksController extends Model
{
	public function autotasks($task)
	{
		$this->$task();
	}

	public function sendRegisterMail()
	{
		$mails_pendientes = parent::pendingRegisterMails();

		if ($mails_pendientes)
		{
			foreach ($mails_pendientes['id'] as $i => $id)
			{
				$token = $this->getKey(50);

				if (parent::setResetToken($mails_pendientes['email'][$i], $token))
				{
					$html = '
					<!DOCTYPE html>
					<html lang="es-SV">
						<head>
							<meta charset="utf-8">
							<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
							<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
							<title>'.APP_NAME.'</title>
						</head>
						<body>
							<div class="container-fluid">
								<div class="row mt-3">
									<div class="col-3"></div>
									<div class="col-6 border border-dark">
										<div class="container">
											<div class="row mt-3">
												<div class="col-12 text-center">
													<h3 class="display-4">Confirmación de registro</h3>
												</div>
											</div>
											<div class="row">
												<div class="col-12 text-center">
													<p>Hola '.$mails_pendientes['name'][$i].', te damos la bienvenida a '.APP_NAME.'.<p>
													<p>Para finalizar tu registro haz clic sobre el siguiente enlace:</p>
												</div>
											</div>
											<div class="row">
												<div class="col-12 text-center">
													<a href="'.URL.'?action=reset&value='.$token.'" class="btn btn-success" target="_blank">Confirmar correo electrónico</a>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-12 text-center">
													<p><strong>Si no has sido tú:</strong></p>
													<p>
														Es posible que hayan intentado utilizar tu cuenta de correo. Deberías tomar ciertas medidas para asegurarte de que tu cuenta no ha sido vulnerada. Haz clic en el siguiente botón para eliminar la solicitud de registro de nuestro sistema.
													</p>
													<p>
														<a href="'.URL.'?action=delRegister&value='.$token.'" class="btn btn-danger" target="_blank">Eliminar registro</a>
													</p>
													<p>
														Gracias por confiar en nosotros.
													</p>
													<p>
														Atentamente:<br>
														<strong>'.APP_NAME.'</strong>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="col-3"></div>
								</div>
							</div>
						</body>
					</html>
					';

					if ($this->sendMail_linux($mails_pendientes['email'][$i], 'Confirmación de registro', $html))
					{
						if (parent::mails_sent($id, $token))
							parent::savelog(3, "Confirmación de registro enviado a {$mails_pendientes['email'][$i]}, mailRegister actualizado.");
						else
							parent::savelog(4, "Confirmación de registro enviado a {$mails_pendientes['email'][$i]}, mailRegister desactualizado.");
					}
					else
					{
						parent::savelog(4, "Confirmación de registro no enviado a {$mails_pendientes['email'][$i]}, mailRegister desactualizado.");
					}
				}
				else
				{
					parent::savelog(4, "Confirmación de registro no enviado a {$mails_pendientes['email'][$i]}, token y mailRegister desactualizados.");
				}
			}
		}
	}

	public function sendSupportMail()
	{
		$supports = parent::pendingSupportMails();

		if ($supports)
		{
			foreach ($supports['idsupport'] as $i => $id)
			{
				$html = '
				<!DOCTYPE html>
				<html lang="es">
				    <head>
				        <meta charset="utf-8">
				        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
				        <title>'.APP_NAME.'</title>
				    </head>
				    <body>
				        <div class="container-fluid">
				            <div class="row">
				                <div class="col-12">
				                    <div class="container">
				                        <div class="row">
				                            <div class="col-12">
				                                <h3>Has recibido una solicitud de soporte de '.APP_NAME.'</h3>
				                            </div>
				                        </div>
				                        <div class="row mt-3">
				                            <div class="col-12">
				                                <p>
				                                   A continuación te presentamos los datos del usuario:
				                                </p>
				                                <p><strong>Datos del usuario: </strong>'.$supports['name'][$i].' | '.$supports['email'][$i].'<p>
				                                <p><strong>Asunto: </strong>'.$supports['subject'][$i].'</p>
				                                <p><strong>Mensaje: </strong>'.$supports['mssg'][$i].'</p>
				                                <p>
				                                    Atentamente: <strong>'.APP_NAME.'</strong>
				                                </p>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </body>
				</html>
				';

				if ($this->sendMail_linux(SUPPORT_MAIL, 'Confirmación de registro', $html))
				{
					if (parent::updatesupportreq($id))
						parent::savelog(3, "Solicitud de soporte por {$supports['email'][$i]} enviada.");
					else
						parent::savelog(4, "No se pudo actualizar el registro de envío en tbl_supports... Solicitud de soporte por {$supports['email'][$i]} enviada.");
				}
				else
				{
					parent::savelog(4, "No se pudo enviar la solicitud de soporte hecha por {$supports['email'][$i]}.");
				}
			}
		}
	}

	public function sendForgetMail()
	{
		$mails_pendientes = parent::pendingForgetMails();

		if ($mails_pendientes)
		{
			foreach ($mails_pendientes['id'] as $i => $id)
			{
				$token = $this->getKey(50);

				if (parent::setResetToken($mails_pendientes['email'][$i], $token))
				{
					$html = '
					<!DOCTYPE html>
					<html lang="es-SV">
						<head>
							<meta charset="utf-8">
							<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
							<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
							<title>'.APP_NAME.'</title>
						</head>
						<body>
							<div class="container-fluid">
								<div class="row mt-3">
									<div class="col-3"></div>
									<div class="col-6 border border-dark">
										<div class="container">
											<div class="row mt-2">
					 							<div class="col-12 text-center">
													<img src="'.URL.'dist/img/logo-mail.png">
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-12 text-center">
													<h3 class="display-4">Restablecer contraseña</h3>
												</div>
											</div>
											<div class="row">
												<div class="col-12 text-center">
													<p>Recibimos una solicitud para restablecer tu contraseña, si fuiste tú, haz clic sobre el siguiente enlace:</p>
												</div>
											</div>
											<div class="row">
												<div class="col-12 text-center">
													<a href="'.URL.'?action=reset&value='.$token.'" class="btn btn-primary" target="_blank">RESTABLECER CONTRASEÑA</a>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-12 text-center">
													<p>
														Si no quieres restablecer tu contraseña, ignora este mensaje y continua ingresando con tu contraseña actual.
													</p>
													<p>
														Gracias por confiar en nosotros.
													</p>
													<p>
														Atentamente:<br>
														<strong>'.APP_NAME.'</strong>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="col-3"></div>
								</div>
							</div>
						</body>
					</html>
					';

					if ($this->sendMail_linux($mails_pendientes['email'][$i], 'Restablecer contraseña', $html))
					{
						if (parent::mails_sent($id, $token))
							parent::savelog(3, "Restablecimiento de contraseña enviado a {$mails_pendientes['email'][$i]}, forgetpass actualizado.");
						else
							parent::savelog(4, "Restablecimiento de contraseña enviado a {$mails_pendientes['email'][$i]}, forgetpass desactualizado.");
					}
					else
					{
						parent::savelog(4, "Restablecimiento de contraseña no enviado a {$mails_pendientes['email'][$i]}, forgetpass desactualizado.");
					}
				}
				else
				{
					parent::savelog(4, "Restablecimiento de contraseña no enviado a {$mails_pendientes['email'][$i]}, token y forgetpass desactualizados.");
				}
			}
		}
	}

	private function sendMail_windows($email, $asunto, $html)
	{
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host = "smtp.office365.com";
		$mail->Port = 25;
		$mail->Username = "proveedores@educo.sv";
		$mail->Password = "Jam31870";
		$mail->CharSet = "UTF-8";
		$mail->From = "proveedores@educo.sv";
		$mail->FromName = "Proveedores Educo";
		$mail->Subject = $asunto;
		$mail->addAddress($email);
		$mail->MsgHTML($html);

		return ($mail->send()) ? true : false;
	}

	private function sendMail_linux($email, $asunto, $html)
	{
		$mail = new PHPMailer;
		$mail->setFrom('educo.proveedores@educo.org');
		$mail->addAddress($email);
		$mail->Subject = $asunto;
		$mail->MsgHTML($html);
		$mail->IsSMTP();
		$mail->CharSet = "UTF-8";
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'ssl://smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Port = 465;
		$mail->Username = 'educo.providers@gmail.com';
		$mail->Password = 'Jam31870';

		return ($mail->send()) ? true : false;
	}

	private function getKey($length)
	{
	    $cadena = "ABCDFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
	    $longitudCadena = strlen($cadena);
	    $pass = "";
	    for($i=1 ; $i<=$length ; $i++){
	        $pos=rand(0,$longitudCadena-1);
	        $pass .= substr($cadena,$pos,1);
	    }
	    return $pass;
	}
}
