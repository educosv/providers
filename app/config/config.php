<?php

/*
|--------------------------------------------------------------------------
| Session start
|--------------------------------------------------------------------------
|
| Inicialización global de las sesiones
|
*/

session_start();

/*
|--------------------------------------------------------------------------
| URL
|--------------------------------------------------------------------------
|
| Establece la dirección específica del proyecto.
|
*/

const URL = 'https://proveedores.educosv.org/';

/*
|--------------------------------------------------------------------------
| Información de la aplicación
|--------------------------------------------------------------------------
|
| Establece el nombre público del proyecto
|
*/

const APP_NAME 	= 'Proveedores'; #Aparecerá en login, pestaña, correos y navbar
const YEAR 		= '2022';
const VERSION 	= '1.1.7';
const DEVOPS 	= [
					'name' => ['David Ramos'],
					'mail' => ['isaac.ramos@educo.org']
				];

/*
|--------------------------------------------------------------------------
| Connection params
|--------------------------------------------------------------------------
|
| Se establecen las constantes a utilizar en la clase conexión,
| estas constantes pueden ser utilizadas para otras conexiones
| dentro del framework.
|
*/

const DB_SOCKET		= '';
const DB_HOST 		= 'localhost';
const DB_USER		= 'educosvo_educo';
const DB_PWD 		= 'MyR$poi871209!';
const DB_NAME 		= 'educosvo_providers';
const DB_PORT 		= 3306;
const DB_CHARSET 	= 'utf8';


/*
|--------------------------------------------------------------------------
| Mail params
|--------------------------------------------------------------------------
|
| Se establecen las constantes para envíos de correos.
|
*/

const MAIL_SMTP_SECURE = '';
const MAIL_HOST = '';
const MAIL_PORT = 587;
const MAIL_USERNAME = '';
const MAIL_PASSWORD = '';
const MAIL_ENCRYPTION = 'utf-8';
const MAIL_FROM_ADDRESS = '';
const MAIL_FROM_NAME = 'no-reply@'.APP_NAME.'.com';

/*
|--------------------------------------------------------------------------
| Login params
|--------------------------------------------------------------------------
|
| Se establecen las constantes para inicios de sesión.
|
*/

const LC_LOGIN = true; //Local login
const FB_LOGIN = false; //Facebook login
const GL_LOGIN = false; //Google login
const MS_LOGIN = true; //Microsoft login
const TW_LOGIN = false; //Twitter login
const GH_LOGIN = false; //Github login

/*
|--------------------------------------------------------------------------
| maintenance params
|--------------------------------------------------------------------------
|
| Se establece la constante para estado de mantenimiento.
|
*/

const MNT = false;

/*
|--------------------------------------------------------------------------
| Language params
|--------------------------------------------------------------------------
|
| Para agregar más idiomas debes crear la biblioteca predeterminada en: app/
|
*/

function select_lang($lang)
{
	return 'app/config/languages/'.$lang.'.php';
}

/*
|--------------------------------------------------------------------------
| APP DIR
|--------------------------------------------------------------------------
|
| APP permite obtener una ruta de acceso absoluta sin depender
| que el directorio de trabajo sea el directorio en el que reside.
|
*/

define('APP', dirname(dirname(__FILE__)));


/*
|--------------------------------------------------------------------------
| VIEWS LIST
|--------------------------------------------------------------------------
|
| Aquí se establecerán la lista de vistas permitidas de acuerdo al permiso
| que posee el usuario. Los arreglos se establecerán de acuerdo a los niveles
| de acceso que se hayan configurado en la base de datos.
|
| Nota: La vista Master será la única que se mantendrá siempre definida.
|
*/

const VIEWS_LIST = [
	"Master" => [
		"profile",
		"info",
		"support"
	],

	"Sudo" => [
		"sudo_starter",

		"actividades",
		"centros_costo",
		"cuentas_contables",
		"custom_reports",
		"default_reports",
		"financiadores",
		"homologaciones",
		"new_product",
		"new_user",
		"nueva_solicitud",
		"product_list",
		"provider_profile",
		"providers_list",
		"proyectos",
		"rubros",
		"solicitudes",
		"support_request",
		"user_profile",
		"users",
		"branches"
	],

	"Administrator" => [
		"administrator_starter",

		"actividades",
		"centros_costo",
		"cuentas_contables",
		"custom_reports",
		"default_reports",
		"financiadores",
		"homologaciones",
		"new_product",
		"new_user",
		"nueva_solicitud",
		"product_list",
		"provider_profile",
		"providers_list",
		"proyectos",
		"rubros",
		"solicitudes",
		"support_request",
		"user_profile",
		"users",
		"branches",
		"admin_reports"
	],

	"Provider" => [
		"provider_starter",

		"mailbox",
		"myprovider_profile",
		"register"
	],

	"Employee" => [
		"employee_starter"
	]
];

/*
|--------------------------------------------------------------------------
| load_view
|--------------------------------------------------------------------------
|
| Carga la vista solicitada.
|
*/

function load_view($req = null, $val = null)
{
	if (is_null($req)) {
		$url = URL;
	}elseif (is_null($val)) {
		$url = URL.$req;
	}else {
		$url = URL.$req.'?val='.$val;
	}

	header("Location: {$url}");
}

/* Definimos la zona horaria */

date_default_timezone_set('America/El_Salvador');