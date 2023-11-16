<?php
require_once "../main.php";

$levels = [
	'Sudo',
	'Administrator'
];

if (in_array($_SESSION['session_providers']['level'], $levels))
{
	$arr_docs = [
		'rubros_providers' => 'Reporte de proveedores al '.date("dmY-His")
	];

	if (isset($_GET['xls_req']) && isset($arr_docs[$_GET['xls_req']])) { $view = $_GET['xls_req']; }

	if (isset($view))
	{
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$arr_docs[$view]}.xls");

		ob_start();

		include $view.'.php';

		unset($_SESSION['data_report']);
	}
	else
	{
		header("Location: ".URL);
	}
}
else
{
	header('Location: 404');
}