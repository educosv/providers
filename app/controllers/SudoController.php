<?php

require_once APP.'/models/Sudo.php';

class SudoController extends Sudo
{

}

$sudo_m = new Sudo;

$sudo_c = new SudoController;

if (isset($_GET['event']))
{
	$method_name = $_GET['event'];
	$val = (isset($_GET['val'])) ? $_GET['val'] : null;
	if (method_exists($sudo_c, $method_name)) {
		if (is_null($val))
			$sudo_c->$method_name();
		else
			$sudo_c->$method_name($val);
	}else if (method_exists($objHome, $method_name)) {
		if (is_null($val))
			$objHome->$method_name();
		else
			$objHome->$method_name($val);
	}else{
		load_view('404');
	}
}