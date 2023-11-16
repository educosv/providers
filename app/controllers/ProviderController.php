<?php

require_once APP.'/models/Provider.php';

class ProviderController extends Provider
{

}

$provider_m = new Provider;

$provider_c = new ProviderController;

if (isset($_GET['event']))
{
	$method_name = $_GET['event'];
	$val = (isset($_GET['val'])) ? $_GET['val']:null;

	if (method_exists($provider_c, $method_name))
	{
		if (is_null($val))
			$provider_c->$method_name();
		else
			$provider_c->$method_name($val);
	}
	if (method_exists($objHome, $method_name))
	{
		if (is_null($val))
			$objHome->$method_name();
		else
			$objHome->$method_name($val);
	}
	else
	{
		load_view('404');
	}
}