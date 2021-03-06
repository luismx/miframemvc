<?php
require_once 'config.php';

import('core.Controller');
import('core.Model');
import('core.Funciones');
import('core.View');
import('core.Request');
import('core.Autoload');
import('core.Session');
import('core.Database');

try {
	Session::init();
	Autoload::run(new Request);

} catch (Exception $exc) {
	echo $exc->getMessage();
	header('location:'.BASE_URL.'error/_404');
}

?>