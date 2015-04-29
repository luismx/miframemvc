<?php
/**
 * Luis Perera
 */
class indexController extends usuariosController {
	private $_modelo;

	function __construct() {
		parent::__construct();
		$this->_view->errores = array();
		$this->_modelo        = $this->loadModel('index');
		$this->_view->tipo    = $this->_modelo->getColumna('tipos', 'nombre', Session::get('usuario', 'id_tipo'));
	}

	public function index() {
		$datos = $this->_modelo->getDatosUsuario(Session::get('usuario', 'id'));
		$this->_view->datosUsuario = array_pop($datos);
		$this->_view->renderizar('index');
	}

	public function cerrar() {
		Session::destroy();
		header('location:'.BASE_URL);
	}

	public function editar() {
		if ($this->_req->getArgs() and count($this->_req->getArgs()) > 0) {
			$this->_view->tipos        = $this->_modelo->getTipos();
			$miVariable                = $this->_req->getArgs();
			$datos = $this->_modelo->getDatosUsuario($miVariable[0]);
			$this->_view->datosUsuario = array_pop($datos);
			$tipoUsuario               = Session::get('usuario', 'id_tipo');

			if ($tipoUsuario == 4) {
				if (isset($_POST['guardar']) and $_POST['guardar'] == 1) {
					$datosGuardados            = $this->guardar($_POST, 'usuarios', $miVariable[0]);
					$datos = $this->_modelo->getDatosUsuario($miVariable[0]);
					$this->_view->datosUsuario = array_pop($datos);
				}
			} else {
				if ($miVariable[0] != Session::get('usuario', 'id')) {
					$this->_funciones->redireccionar('usuarios');
				} else {
					if (isset($_POST['guardar']) and $_POST['guardar'] == 1) {
						$datosGuardados = $this->guardar($_POST, 'usuarios', $miVariable[0]);
						$datos = $this->_modelo->getDatosUsuario($miVariable[0]);
						$this->_view->datosUsuario = array_pop($datos);
					}
				}
			}
		}
		if ($this->_view->datosUsuario == 0) {
			$this->_view->mensaje = "Datos guardados";
		}

		$this->_view->renderizar('editar');
	}

	public function guardar($post, $tabla, $id) {
		$errores = array();
		if (is_array($post) and count($post) > 0) {
			$columnas = $this->_modelo->getCampos($tabla);

			if (count($columnas) > 0) {
				foreach ($columnas as $llaveColumna => $valorColumna) {
					$actualizado = "";

					foreach ($post as $llavePost => $valorPost) {
						if ($valorPost != "" and $llavePost == $llaveColumna) {
							if ($llavePost == 'clave') {
								$actualizado = $this->_modelo->updateColumna('usuarios', 'clave', $this->_funciones->gethash('sha1', $valorPost, HASH_KEY), $id);
							} elseif ($llavePost == 'usuario') {
								$exite = $this->_modelo->getUsuario($valorPost, Session::get('usuario', 'id_tipo'));

								if (!$exite) {
									$actualizado = $this->_modelo->updateColumna('usuarios', 'usuario', $valorPost, $id);
								}
							} elseif ($llavePost == 'fecha_nacimiento') {
								$actualizado = $this->_modelo->updateColumna('usuarios', 'fecha_nacimiento', $this->_funciones->cambiarFecha($valorPost, 'db'), $id);
							} elseif ($llavePost == 'email') {
								$email = $this->_funciones->validarEmail($valorPost);

								if ($email) {
									$actualizado = $this->_modelo->updateColumna('usuarios', 'email', $valorPost, $id);
								} else {
									$this->_view->errores[$llavePost] = "Email inválido";
								}
							} else {
								$actualizado = $this->_modelo->updateColumna('usuarios', $llavePost, $valorPost, $id);
							}
							if ($actualizado == 0) {
								$this->_view->errores[$llavePost] = "Error en el valor $valorPost, verifique su información";
							}
						}
					}
				}
			}

			$this->_modelo->updateSession($id);

			if (isset($_FILES['img']) and $_FILES['img']['name'] != "") {
				$nombre = Session::get('usuario', 'rfc').Session::get('usuario', 'usuario').Session::get('usuario', 'id_tipo');
				$img    = $this->guardarImagen($nombre);
				if ($img) {
					$this->_modelo->updateColumna('usuarios', 'img', $nombre.'.png', $id);
				} else {
					$this->_view->errores['img'] = "Error en la imagen";
				}
			}

			if (count($errores) > 0) {
				return var_dump($errores);
			} else {

				return 0;
			}
		}
	}

	public function guardarImagen($nombre) {
		if (isset($_FILES) and count($_FILES) > 0) {
			return $this->_funciones->recortarImagen('img', $nombre, '80', '50');
		}
	}
}
?>