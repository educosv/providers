<?php
require_once "main.php";

$arr_docs = [
	'user_list' => 'Reporte de usuarios al '.date("dmY-His"),
	'support_list' => 'Reporte de soportes al '.date("dmY-His"),
	'custom_user_list' => 'Reporte de usuarios al '.date("dmY-His"),
	'custom_support_list' => 'Reporte de soportes al '.date("dmY-His")
];

if (isset($_GET['xls_req']) && isset($arr_docs[$_GET['xls_req']]))
{
	$view = $_GET['xls_req'];
}

if (isset($view))
{
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename={$arr_docs[$view]}.xls");

	ob_start();

	include $view.'.php';
}
else
{
	header("Location: ".URL);
}