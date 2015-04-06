<?php
/**
 * @Dev Luis Perera
 */
class errorController extends Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		//$this->_view->titulo = "Elemento no encontrado";
		//$this->_view->texto  = "La dirección donde a la que intentas tener acceso, no existe.";
		//$this->_view->renderizar('index');
	}

	public function e404() {
		$this->_view->titulo      = "Elemento no encontrado";
		$this->_view->texto       = "La dirección donde a la que intentas tener acceso, no existe.";
		$this->_view->numeroError = "Error 404";
		$this->_view->renderizar('index');

	}

	public function e403() {
		$this->_view->titulo      = "Permisos insuficientes";
		$this->_view->texto       = "No puedes ver el contenido porqué no tienes los permisos necesarios.";
		$this->_view->numeroError = "Error 403";
		$this->_view->renderizar('index');
	}
}
?>