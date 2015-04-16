<?php
/**
 *@Dev Luis Perera
 **/

class facturasController extends Controller {

	function __construct() {
		parent::__construct();
		$this->_funciones->redireccionarInicio();
	}

	public function index() {}
}
?>