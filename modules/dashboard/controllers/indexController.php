<?php

/*
 * @Dev Luis Perera
 */

class indexController extends dashboardController {
	private $_modelo;

	function __construct() {
		parent::__construct();
		$this->_modelo = $this->loadModel('index', 'dashboard');
		$this->_funciones->redireccionarInicio();
	}

	public function index() {
		//var_dump($_SESSION);
		$tipo = Session::get('usuario', 'id_tipo');
		if (isset($tipo)) {
			switch ($tipo) {
				case '1':
					$this->_view->renderizar('cliente');
					break;
				case '2':
					$this->_view->renderizar('comisionista');
					break;
				case '1':
					$this->_view->renderizar('operador');
					break;
				case '1':
					$this->_view->renderizar('administrador');
					break;
			}
		}
	}
}
