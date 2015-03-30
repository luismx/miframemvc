<?php
/**
* Luis Perera
*/
class indexController extends usuariosController
{
	private $_modelo;
	function __construct()
	{
		parent::__construct();
		$this->_modelo = $this->loadModel('index');
		$this->_view->datosUsuario = array();
	}

	public function index(){
		$this->_view->renderizar('index');
	}

	public function cerrar(){
		Session::destroy();
		header('location:'.BASE_URL);
	}

	public function editar(){
		if (isset($_POST['guardar']) and $_POST['guardar'] == 1) {
			$this->guardar($_POST, 'usuarios', $id);
		}
		if ($this->_req->getArgs() and count($this->_req->getArgs()) > 0) {
			$miVariable = $this->_req->getArgs();
			$tipoUsuario = Session::get('usuario','id_tipo');
			if ($tipoUsuario == 4) {
				$datosUsuario = $this->_modelo->getDatosUsuario($miVariable);
			}else{
				if ($miVariable != Session::get('usuario','id'))
					$this->_funciones->redireccionar('usuarios');
				else{
					$datosUsuario = $this->_modelo->getDatosUsuario($miVariable);
					$this->_view->renderizar('editar');
				}
			}

		}
	}

	public function guardar($post,$tabla,$id){
		if (is_array($post) and count($post) > 0) {
			$columnas = $this->getCampos($tabla);
			if ($columnas) {
				foreach ($columnas as $nombreC => $valorC) {
					# code...
				}
			}
		}
	}
}
?>