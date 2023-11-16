<?php

require_once "../app/config/config.php";

if (isset($_POST['print']))
{
	$_SESSION['data_report']['side'] = (isset($_POST['side'])) ? 'l' : 'p';

	$_SESSION['data_report']['all'] = (isset($_POST['all'])) ? 1 : 0;

	$_SESSION['data_report']['initdate'] = (isset($_POST['initdate'])) ? $_POST['initdate'] : date('Y-m-d');

	$_SESSION['data_report']['finishdate'] = (isset($_POST['finishdate'])) ? $_POST['finishdate'] : date('Y-m-d');

	$_SESSION['data_report']['region'] = (isset($_POST['region'])) ? $_POST['region'] : 0;

	$_SESSION['data_report']['country'] = (isset($_POST['country'])) ? $_POST['country'] : 0;

	if ($_POST['print'] == 'pdf')
		header("Location: ".URL.$_POST['report']);
	else
		header("Location: ".URL."xls_report?xls_req={$_POST['report']}");
}
else
{
	header("Location: 404");
}