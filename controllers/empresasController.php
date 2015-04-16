<?php
/*
 *Luis Perera
 */
class empresasController extends Controller {

	function __construct() {
		parent::__construct();
		$this->_funciones->redireccionarInicio();
	}

	public function index() {}
}
?>