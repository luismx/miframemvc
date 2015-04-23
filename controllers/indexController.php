<?php
class indexController extends Controller {
	private $_modelo;
	public function __construct() {
		parent::__construct();
		$this->_modelo = $this->loadModel('index');
	}

	public function index() {
		var_dump($_SESSION);
		if (isset($_POST['sesion']) and $_POST['sesion'] == 1) {
			$error = $this->login();
			if ($error) {
				$this->_view->error = "No es posible iniciar sesión, verifique su informacion";
				$this->_view->renderizar('index');
			}
		} else {

			$this->_view->renderizar('index');
		}
	}

	public function login() {
		function clean($str) {return htmlentities(strip_tags($str), ENT_QUOTES);}
		extract(array_map('clean', $_POST));

		$hash   = $this->_funciones->getHash('sha1', $claveUsuario, HASH_KEY);
		$select = "SELECT * FROM usuarios WHERE id_tipo = : id_tipo AND usuario = :nombre AND clave = :hash";
		$data   = array(':id_tipo' => $tipoUsuario, ':nombre' => $nombreUsuario, ':clave' => $hash);
		$datos  = $this->_modelo->getDatosUsuario($select, $data);

		if ($datos) {
			$update = $this->_modelo->setDato('session_id', session_id(), $datos['id']);

			if ($update) {
				$sesion = $this->guardarSesion($datos);
				if ($sesion) {
					if ($datos['status'] == 1) {
						$this->_funciones->redireccionar('dashboard');
					} else {

						$this->_funciones->redireccionar('empresas');
					}
				}
			}
		} else {
			return true;
		}
	}

	public function guardarSesion($arr) {
		foreach ($arr as $llave => $valor) {
			if ($llave != 'clave') {
				$_SESSION['usuario'][$llave] = $valor;
			}

			if ($llave == 'session_id') {
				$_SESSION['usuario'][$llave] = session_id();

			}
		}

		if (isset($_SESSION['usuario']) and count($_SESSION['usuario']) > 0) {
			return true;
		} else {

			return false;
		}
	}
}
