<?php
/**
 * @Dev Luis Perera
 */
class errorController extends Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->_funciones->redireccionar();
	}
	#mensaje de error para elementos no encontrados
	public function _404() {
		$this->_view->titulo      = "Elemento no encontrado";
		$this->_view->texto       = "El recurso al que intentas tener acceso, no existe.";
		$this->_view->numeroError = "Error 404";
		$this->_view->renderizar('index');

	}
	#mensaje de error para permisos insuficientes
	public function _403() {
		$this->_view->titulo      = "Permisos insuficientes";
		$this->_view->texto       = "No puedes ver el contenido porqué no tienes los permisos necesarios.";
		$this->_view->numeroError = "Error 403";
		$this->_view->renderizar('index');
	}
}
?>